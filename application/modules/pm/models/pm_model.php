<?php
class Pm_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }
	
	function __get_pm($uid, $type) {
		if ($type == 1) $isDel = 'a.ptdelete=0';
		else $isDel = 'a.pfdelete=0';
		return 'SELECT a.pid,a.pdate,a.psubject,a.pmsg,a.pstatus,b.uemail as ufrom,c.uemail as uto FROM pm_tab a LEFT JOIN users_tab b ON a.pfrom=b.uid RIGHT JOIN users_tab c ON a.pto=c.uid WHERE (a.pstatus=1 OR a.pstatus=0) AND '.($type == 2 ? 'a.pfrom='.$uid : 'a.pto=' . $uid).' AND '.$isDel.' ORDER BY a.pid DESC';
	}
	
	function __get_total_new_pm($uid) {
		$sql = $this -> db -> query('SELECT * FROM pm_tab WHERE pstatus=0 and pto=' . $uid);
		return $sql -> num_rows();
	}
	
	function __get_new_pm($uid) {
		$this -> db -> select('a.pid,a.pdate,a.psubject,b.uemail FROM pm_tab a LEFT JOIN users_tab b ON a.pfrom=b.uid WHERE a.pstatus=0 and a.pto=' . $uid . ' ORDER BY a.pid DESC');
		return $this -> db -> get() -> result();
	}

	function __get_suggestion() {
		$this -> db -> select('uemail,uid from users_tab where ustatus=1');
		return $this -> db -> get() -> result();
	}

	function __get_pm_detail($id, $uid) {
		$this -> db -> select('a.*,b.uemail as ufrom,c.uemail as uto FROM pm_tab a LEFT JOIN users_tab b ON a.pfrom=b.uid RIGHT JOIN users_tab c ON a.pto=c.uid WHERE (a.pstatus=1 OR a.pstatus=0) AND (a.pfrom='.$uid.' OR a.pto='.$uid.') AND a.pid=' . $id);
		return $this -> db -> get() -> result();
	}
	
	function __insert_pm($data) {
        return $this -> db -> insert('pm_tab', $data);
	}
	
	function __update_pm($id, $data) {
        $this -> db -> where('pid', $id);
        return $this -> db -> update('pm_tab', $data);
	}
	
	function __update_new_status($id) {
		return $this -> db -> query('update pm_tab set pstatus=1 WHERE pstatus=0 AND pid=' . $id);
	}
	
	function __delete_pm($id, $type) {
		if ($type == 1)
			return $this -> db -> query('update pm_tab set ptdelete=1 WHERE pid=' . $id);
		else
			return $this -> db -> query('update pm_tab set pfdelete=1 WHERE pid=' . $id);
	}
}
