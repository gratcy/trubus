<?php
class Categories_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }
	
	function __get_categories($type,$parent) {
		if ($type == 1) {
			return 'SELECT * FROM categories_tab WHERE (cstatus=1 OR cstatus=0) AND ctype=2 AND cparent=0 ORDER BY cid DESC';
		}
		else {
			$this -> db -> select('* FROM categories_tab WHERE (cstatus=1 OR cstatus=0) AND ctype=2 AND cparent='.$parent.' ORDER BY cid DESC');
			return $this -> db -> get() -> result();
		}
	}
	
	function __get_categories_search($keyword) {
		return "SELECT * FROM categories_tab WHERE (cstatus=1 OR cstatus=0) AND ctype=2 AND (cname LIKE '%".$keyword."%' OR cdesc LIKE '%".$keyword."%') ORDER BY cid DESC";
	}
    
    function __get_suggestion() {
		$this -> db -> select('cid,cname as name FROM categories_tab WHERE (cstatus=1 OR cstatus=0) AND ctype=2 ORDER BY cid DESC');
		return $this -> db -> get() -> result();
	}
	
	function __get_categories_select($parent) {
		$this -> db -> select('cid,cname FROM categories_tab WHERE (cstatus=1 OR cstatus=0) AND ctype=2 AND cparent='.$parent.' ORDER BY cname ASC');
		return $this -> db -> get() -> result();
	}
	
	function __get_categories_detail($id) {
		$this -> db -> select('* FROM categories_tab WHERE (cstatus=1 OR cstatus=0) AND ctype=2 AND cid=' . $id);
		return $this -> db -> get() -> result();
	}
	
	function __insert_categories($data) {
        return $this -> db -> insert('categories_tab', $data);
	}
	
	function __update_categories($id, $data) {
        $this -> db -> where('cid', $id);
        $this -> db -> where('ctype', 2);
        return $this -> db -> update('categories_tab', $data);
	}
	
	function __delete_categories($id) {
		return $this -> db -> query('UPDATE categories_tab SET cstatus=2 WHERE ctype=2 AND cid=' . $id);
	}
}
