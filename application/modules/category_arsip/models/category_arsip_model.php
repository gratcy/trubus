<?php
class category_arsip_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }
    
    function __get_suggestion() {
		$this -> db -> select('cid,cname as name FROM categories_tab WHERE (cstatus=1 OR cstatus=0) AND ctype=1 ORDER BY name ASC');
		return $this -> db -> get() -> result();
	}
	
	function __check_parent($id) {
		$this -> db -> select('cparent FROM categories_tab WHERE cstatus=1 and cid=' . $id);
		return $this -> db -> get() -> result();
	}
	
	function __get_category_arsip_search($keyword) {
		return "SELECT * FROM categories_tab WHERE (cstatus=1 OR cstatus=0) AND cname LIKE '%".$keyword."%' AND ctype=1 ORDER BY cname DESC";
	}
    
    function __get_category_arsip_select($type, $parent) {
		if ($type == 1)
		$this -> db -> select('cid,cname FROM categories_tab WHERE cstatus=1 AND ctype=1 AND cparent=0 ORDER BY cname ASC');
		else
		$this -> db -> select('cid,cname FROM categories_tab WHERE cstatus=1 AND ctype=1 AND cparent='.$parent.' ORDER BY cname ASC');
		return $this -> db -> get() -> result();
	}
	
	function __get_category_arsip($type, $parent) {
		if ($type == 1) {
			return 'SELECT * FROM categories_tab WHERE (cstatus=1 OR cstatus=0) AND ctype=1 AND cparent=0 ORDER BY cname DESC';
		}
		else {
			$this -> db -> select('* FROM categories_tab WHERE (cstatus=1 OR cstatus=0) AND ctype=1 AND cparent='.$parent.' ORDER BY cname DESC');
			return $this -> db -> get() -> result();
		}
	}
	
	function __get_category_arsip_detail($id) {
		$this -> db -> select('* FROM categories_tab WHERE (cstatus=1 OR cstatus=0) AND ctype=1 AND cid=' . $id);
		return $this -> db -> get() -> result();
	}
	
	function __insert_category_arsip($data) {
        return $this -> db -> insert('categories_tab', $data);
	}
	
	function __update_category_arsip($id, $data) {
        $this -> db -> where('ctype', 1);
        $this -> db -> where('cid', $id);
        return $this -> db -> update('categories_tab', $data);
	}
	
	function __delete_category_arsip($id) {
		return $this -> db -> query('update categories_tab set cstatus=2 and ctype=1 where cid=' . $id);
	}
}
