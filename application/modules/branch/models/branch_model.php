<?php
class Branch_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }
    
    function __get_suggestion() {
		$this -> db -> select('bid,bname as name FROM branch_tab WHERE (bstatus=1 OR bstatus=0) ORDER BY name ASC');
		$a =  $this -> db -> get() -> result();
		$this -> db -> select('bid,bcode as name FROM branch_tab WHERE (bstatus=1 OR bstatus=0) ORDER BY name ASC', FALSE);
		$b = $this -> db -> get() -> result();
		return array_merge($a,$b);
	}
	
	function __get_branch_search($keyword) {
		return "SELECT a.*,b.cname as city,c.pname as province FROM branch_tab a LEFT JOIN city_tab b ON a.bcity=b.cid LEFT JOIN province_tab c ON a.bprovince=c.pid WHERE (a.bstatus=1 OR a.bstatus=0) AND (a.bname='".$keyword."' OR a.bid='".substr($keyword,0)."') ORDER BY a.bid DESC";
	}
    
    function __get_branch_code($id) {
		$this -> db -> select('bcode FROM branch_tab WHERE bstatus=1 and bid='. $id);
		return $this -> db -> get() -> result();
	}
    
    function __get_branch_select() {
		$this -> db -> select('bid,bname FROM branch_tab WHERE bstatus=1 ORDER BY bname ASC');
		return $this -> db -> get() -> result();
	}
	
	function __get_branch() {
		return 'SELECT a.*,b.cname as city,c.pname as province FROM branch_tab a LEFT JOIN city_tab b ON a.bcity=b.cid LEFT JOIN province_tab c ON a.bprovince=c.pid WHERE (a.bstatus=1 OR a.bstatus=0) ORDER BY a.bid DESC';
	}
	
	function __get_total_branch() {
		$sql = $this -> db -> query('SELECT * FROM branch_tab WHERE bstatus=1');
		return $sql -> num_rows();
	}
	
	function __get_branch_detail($id) {
		$this -> db -> select('* FROM branch_tab WHERE (bstatus=1 OR bstatus=0) AND bid=' . $id);
		return $this -> db -> get() -> result();
	}
	
	function __insert_branch($data) {
        return $this -> db -> insert('branch_tab', $data);
	}
	
	function __update_branch($id, $data) {
        $this -> db -> where('bid', $id);
        return $this -> db -> update('branch_tab', $data);
	}
	
	function __delete_branch($id) {
		return $this -> db -> query('update branch_tab set bstatus=2 where bid=' . $id);
	}
}
