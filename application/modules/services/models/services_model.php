<?php
class Services_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }
	
	function __get_services() {
		return 'SELECT a.*,b.bname,c.pname FROM services_tab a left join branch_tab b ON a.sbid=b.bid LEFT JOIN products_tab c ON a.spid=c.pid WHERE (a.sstatus=1 or a.sstatus=0) ORDER BY a.sid DESC';
	}
	
	function __get_recent_services() {
		$this -> db -> select('a.*,b.bname,c.pname FROM services_tab a left join branch_tab b ON a.sbid=b.bid LEFT JOIN products_tab c ON a.spid=c.pid WHERE (a.sstatus=1 or a.sstatus=0) ORDER BY a.sid DESC LIMIT 0,5', FALSE);
		return $this -> db -> get() -> result();
	}
	
	function __get_services_detail($id) {
		$this -> db -> select('* FROM services_tab WHERE (sstatus=1 OR sstatus=0) AND sid=' . $id);
		return $this -> db -> get() -> result();
	}
	
	function __insert_services($data) {
        return $this -> db -> insert('services_tab', $data);
	}
	
	function __update_services($id, $data) {
        $this -> db -> where('sid', $id);
        return $this -> db -> update('services_tab', $data);
	}
	
	function __delete_services($id) {
		return $this -> db -> query('update services_tab set sstatus=2 where sid=' . $id);
	}
}
