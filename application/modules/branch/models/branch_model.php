<?php
class Branch_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }
    
    function __get_suggestion() {
		$this -> db -> select('bid,bname as name FROM branch_tab WHERE (bstatus=1 OR bstatus=0) ORDER BY name ASC');
		$a =  $this -> db -> get() -> result();
		$this -> db -> select('bid,bcode as name FROM branch_tab WHERE (bstatus=1 OR bstatus=0) ORDER BY name ASC');
		$b = $this -> db -> get() -> result();
		return array_merge($a,$b);
	}
	
	function __get_branch_search($keyword) {
		return "SELECT * FROM branch_tab WHERE (bstatus=1 OR bstatus=0) AND (bname='".$keyword."' OR bcode='".$keyword."') ORDER BY bid DESC";
	}
    
    function __get_branch_select() {
		$this -> db -> select('bid,bname FROM branch_tab WHERE bstatus=1 ORDER BY bname ASC');
		return $this -> db -> get() -> result();
	}
	
	function __get_branch() {
		return 'SELECT * FROM branch_tab WHERE (bstatus=1 OR bstatus=0) ORDER BY bid DESC';
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
