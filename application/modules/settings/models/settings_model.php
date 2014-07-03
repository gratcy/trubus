<?php
class Settings_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }
    
    function __update_profile($uemail, $id) {
		return $this -> db -> query("update users_tab set uemail='".$uemail."' where uid=" . $id);
	}
	
	function __check_password($id) {
		$this -> db -> select('upass from users_tab where uid=' . $id);
		return $this -> db -> get() -> result();
	}
	
	function __update_password($password, $id) {
		return $this -> db -> query("update users_tab set upass='".md5(sha1($password, true))."' where uid=" . $id);
	}
}
