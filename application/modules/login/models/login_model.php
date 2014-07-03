<?php
class Login_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }
    
    function __get_login($uemail, $upass) {
		$this -> db -> select("a.uid,a.uemail,a.ugid,b.bname from users_tab a left join branch_tab b on a.ubid=b.bid where a.uemail='".$uemail."' and a.upass='".md5(sha1($upass, true))."' and a.ustatus=1");
		return $this -> db -> get() -> result();
	}
	
	function __get_permission($id) {
		$this -> db -> select('a.pname,a.purl,b.aaccess from permission_tab a, access_tab b where a.pid=b.apid and b.agid= ' . $id);
		return $this -> db -> get() -> result_array();
	}
	
	function __update_history_login($id, $data) {
        $this -> db -> where('uid', $id);
        return $this -> db -> update('users_tab', $data);
	}
}
