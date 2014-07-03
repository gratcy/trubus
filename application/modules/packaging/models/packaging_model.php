<?php
class Packaging_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }
	
	function __get_packaging() {
		return 'SELECT * FROM categories_tab WHERE (cstatus=1 OR cstatus=0) AND ctype=3 ORDER BY cid DESC';
	}
	
	function __get_packaging_select() {
		$this -> db -> select('cid,cname FROM categories_tab WHERE (cstatus=1 OR cstatus=0) AND ctype=3 ORDER BY cname ASC');
		return $this -> db -> get() -> result();
	}
	
	function __get_packaging_detail($id) {
		$this -> db -> select('* FROM categories_tab WHERE (cstatus=1 OR cstatus=0) AND ctype=3 AND cid=' . $id);
		return $this -> db -> get() -> result();
	}
	
	function __insert_packaging($data) {
        return $this -> db -> insert('categories_tab', $data);
	}
	
	function __update_packaging($id, $data) {
        $this -> db -> where('cid', $id);
        $this -> db -> where('ctype', 3);
        return $this -> db -> update('categories_tab', $data);
	}
	
	function __delete_packaging($id) {
		return $this -> db -> query('UPDATE categories_tab SET cstatus=2 WHERE ctype=3 AND cid=' . $id);
	}
}
