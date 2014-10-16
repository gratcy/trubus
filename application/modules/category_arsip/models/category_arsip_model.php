<?php
class category_arsip_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }
    
    function __get_category_arsip_select() {
		$this -> db -> select('cid,cname FROM categories_tab WHERE cstatus=1 AND ctype=1 ORDER BY cname ASC');
		return $this -> db -> get() -> result();
	}
	
	function __get_category_arsip() {
		return 'SELECT * FROM categories_tab WHERE (cstatus=1 OR cstatus=0) AND ctype=1 ORDER BY cname DESC';
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
