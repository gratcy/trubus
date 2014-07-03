<?php
class Users_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }
    
    function __check_users($email) {
		$this -> db -> select("* FROM users_tab WHERE uemail='".$email."'");
		return $this -> db -> get() -> num_rows();
	}
    
	function __get_users() {
		return 'select a.uid,a.uemail,a.ulastlogin,a.ustatus,b.gname,c.bname from users_tab a, groups_tab b, branch_tab c where a.ubid=c.bid and a.ugid=b.gid and (a.ustatus=1 or a.ustatus=0)';
	}
	
	function __delete_users($id) {
		return $this -> db -> query('update users_tab set ustatus=2 where uid=' . $id);
	}
	
    function __update_users($uemail, $id, $gid, $bid, $ustatus) {
		return $this -> db -> query("update users_tab set uemail='".$uemail."',ugid=".$gid.", ubid=".$bid.", ustatus=".$ustatus." where uid=" . $id);
	}
	
	function __get_detail_users($id) {
		$this -> db -> select('a.uemail,a.ustatus,a.ugid,a.ubid from users_tab a where (a.ustatus=1 or a.ustatus=0) and a.uid=' . $id);
		return $this -> db -> get() -> result();
	}
	
	function __insert_users($uemail, $upass, $gid, $bid, $ustatus) {
		return $this -> db -> query("insert into users_tab (uemail,upass,ugid,ubid,ustatus) values ('".$uemail."','".md5(sha1($upass, true))."',".$gid.",".$bid.",".$ustatus.")");
	}
	
	function __get_groups() {
		$this -> db -> select('gid,gname,gstatus from groups_tab where (gstatus=1 or gstatus=0) order by gname asc');
		return $this -> db -> get() -> result();
	}
	
	function __get_detail_users_group($id) {
        $this -> db -> where('gid', $id);
		return $this -> db -> get('groups_tab') -> result();
	}
	
	function __get_users_group() {
		return 'select * from groups_tab where (gstatus = 1 or gstatus=0) order by gid desc';
	}
	
	function __delete_users_group($id) {
		return $this -> db -> query('update groups_tab set gstatus=2 where gid=' . $id);
	}
	
	function __insert_users_group($group) {
        return $this -> db -> insert('groups_tab', $group);
	}
	
	function __update_users_group($id, $group) {
        $this -> db -> where('gid', $id);
        return $this -> db -> update('groups_tab', $group);
	}
	
	function __update_permission($gid, $perm, $access) {
		return $this -> db -> query('update access_tab set aaccess='.$access.' where agid='.$gid.' and apid=' . $perm);
	}
	
	function __insert_permission($perm) {
        return $this -> db -> insert('access_tab', $perm);
	}
	
	function __get_permission($type,$gid) {
		if ($type == 1)
			$this -> db -> select('pid,pname,pparent from permission_tab');
		else
			$this -> db -> select('a.aaccess,b.pname,b.pid,b.pparent from access_tab a, permission_tab b where a.apid=b.pid and a.agid=' . $gid);
        return $this -> db -> get() -> result();
	}
}
