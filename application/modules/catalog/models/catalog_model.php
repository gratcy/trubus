<?php
class Catalog_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }
    
	function __get_catalog() {
		return 'SELECT a.*,b.btitle FROM catalog_tab a LEFT JOIN books_tab b ON a.cbid=b.bid WHERE (a.cstatus=1 OR a.cstatus=0) ORDER BY a.cid DESC';
	}
	
	function __get_catalog_detail($id) {
		$this -> db -> select('* FROM catalog_tab WHERE (cstatus=1 OR cstatus=0) AND cid=' . $id);
		return $this -> db -> get() -> result();
	}
	
	function __insert_catalog($data) {
        return $this -> db -> insert('catalog_tab', $data);
	}
	
	function __update_catalog($id, $data) {
        $this -> db -> where('cid', $id);
        return $this -> db -> update('catalog_tab', $data);
	}
	
	function __delete_catalog($id) {
		return $this -> db -> query('update catalog_tab set cstatus=2 where cid=' . $id);
	}
}
