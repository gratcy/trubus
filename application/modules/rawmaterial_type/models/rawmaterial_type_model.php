<?php
class Rawmaterial_type_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }
	
	function __get_rawmaterial_type() {
		return 'SELECT * FROM categories_tab WHERE (cstatus=1 OR cstatus=0) AND ctype=2 ORDER BY cid DESC';
	}
	
	function __get_rawmaterial_type_select() {
		$this -> db -> select('cid,cname FROM categories_tab WHERE (cstatus=1 OR cstatus=0) AND ctype=2 ORDER BY cname ASC');
		return $this -> db -> get() -> result();
	}
	
	function __insert_rawmaterial_type($data) {
        return $this -> db -> insert('categories_tab', $data);
	}
	
	function __update_rawmaterial_type($id, $data) {
        $this -> db -> where('cid', $id);
        $this -> db -> where('ctype', 2);
        return $this -> db -> update('categories_tab', $data);
	}
	
	function __get_rawmaterial_type_detail($id) {
		$this -> db -> select('* FROM categories_tab WHERE (cstatus=1 OR cstatus=0) AND ctype=2 AND cid=' . $id);
		return $this -> db -> get() -> result();
	}
	
	function __delete_rawmaterial_type($id) {
		return $this -> db -> query('UPDATE categories_tab SET cstatus=2 WHERE ctype=2 AND cid=' . $id);
	}
}
