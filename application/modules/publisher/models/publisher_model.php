<?php
class Publisher_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }
    
    function __get_suggestion() {
		$this -> db -> select('pid,pname as name FROM publisher_tab WHERE (pstatus=1 OR pstatus=0) ORDER BY name ASC');
		$a =  $this -> db -> get() -> result();
		$this -> db -> select('pid,pcode as name FROM publisher_tab WHERE (pstatus=1 OR pstatus=0) ORDER BY name ASC');
		$b = $this -> db -> get() -> result();
		return array_merge($a,$b);
	}
	
	function __get_publisher_search($keyword) {
		return "SELECT * FROM publisher_tab WHERE (pstatus=1 OR pstatus=0) AND (pname='".$keyword."' OR pcode='".$keyword."') ORDER BY pname DESC";
	}
    
    function __get_publisher_select($type,$id) {
		if ($type == 1)
			$this -> db -> select('pid,pname FROM publisher_tab WHERE pstatus=1 AND pparent=0 ORDER BY pname ASC');
		else
			$this -> db -> select('pid,pname FROM publisher_tab WHERE pstatus=1 AND pparent='.$id.' ORDER BY pname ASC');
		return $this -> db -> get() -> result();
	}
	
	function __get_publisher($type, $id) {
		if ($type == 2) {
			$this -> db -> select('a.*,b.cname as city,c.pname as province FROM publisher_tab a LEFT JOIN city_tab b ON a.pcity=b.cid LEFT JOIN province_tab c ON a.pprov=c.pid WHERE (a.pstatus=1 OR a.pstatus=0) AND a.pparent='.$id.' ORDER BY a.pname DESC');
			return $this -> db -> get() -> result();
		}
		else
			return 'SELECT a.*,b.cname as city,c.pname as province FROM publisher_tab a LEFT JOIN city_tab b ON a.pcity=b.cid LEFT JOIN province_tab c ON a.pprov=c.pid WHERE (a.pstatus=1 OR a.pstatus=0) AND a.pparent=0 ORDER BY a.pname DESC';
	}
	
	function __publisher_name($id) {
		$this -> db -> select('pname FROM publisher_tab WHERE (pstatus=1 OR pstatus=0) AND pid=' . $id);
		$res = $this -> db -> get() -> result();
		return $res[0] -> pname;
	}
	
	function __get_publisher_detail($id) {
		$this -> db -> select('* FROM publisher_tab WHERE (pstatus=1 OR pstatus=0) AND pid=' . $id);
		return $this -> db -> get() -> result();
	}
	
	function __insert_publisher($data) {
        return $this -> db -> insert('publisher_tab', $data);
	}
	
	function __check_parent($parent) {
		$this -> db -> select('pparent,pmcode FROM publisher_tab WHERE (pstatus=1 OR pstatus=0) AND pid=' . $parent);
		return $this -> db -> get() -> result();
	}
	
	function __get_child($parent) {
		$this -> db -> select('* FROM publisher_tab WHERE (pstatus=1 OR pstatus=0) AND pparent=' . $parent);
		return $this -> db -> get() -> result();
	}
	
	function __get_publisher_code($id) {
		$this -> db -> select('pcode FROM publisher_tab WHERE (pstatus=1 OR pstatus=0) AND pid=' . $id);
		return $this -> db -> get() -> result();
	}
	
	function __get_publisher_code_child($id) {
		$this -> db -> select('b.pcode FROM publisher_tab a LEFT JOIN publisher_tab b ON a.pparent=b.pid WHERE (a.pstatus =1 OR a.pstatus =0) AND a.pid=' . $id);
		return $this -> db -> get() -> result();
	}
	
	function __update_publisher($id, $data) {
        $this -> db -> where('pid', $id);
        return $this -> db -> update('publisher_tab', $data);
	}
	
	function __delete_publisher($id) {
		return $this -> db -> query('update publisher_tab set pstatus=2 where pid=' . $id);
	}
}
