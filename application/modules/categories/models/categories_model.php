<?php
class Categories_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }
	
	function __get_categories() {
		return 'SELECT * FROM categories_tab WHERE (cstatus=1 OR cstatus=0) AND ctype=1 ORDER BY cid DESC';
	}
	
	function __get_categories_select() {
		$this -> db -> select('cid,cname FROM categories_tab WHERE (cstatus=1 OR cstatus=0) AND ctype=1 ORDER BY cname ASC');
		return $this -> db -> get() -> result();
	}
	
	function __get_categories_detail($id) {
		$this -> db -> select('* FROM categories_tab WHERE (cstatus=1 OR cstatus=0) AND ctype=1 AND cid=' . $id);
		return $this -> db -> get() -> result();
	}
	
	function __insert_categories($data) {
        return $this -> db -> insert('categories_tab', $data);
	}
	
	function __update_categories($id, $data) {
        $this -> db -> where('cid', $id);
        $this -> db -> where('ctype', 1);
        return $this -> db -> update('categories_tab', $data);
	}
	
	function __delete_categories($id) {
		return $this -> db -> query('UPDATE categories_tab SET cstatus=2 WHERE ctype=1 AND cid=' . $id);
	}
}
