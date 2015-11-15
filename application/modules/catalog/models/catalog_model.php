<?php
class Catalog_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }
    
    function __get_catalog_books($id) {
		$this -> db -> select('cbid FROM catalog_books_tab WHERE cstatus=1 AND ccid=' . $id);
		return  $this -> db -> get() -> result();
	}
    
    function __get_suggestion($bid) {
		$this -> db -> select('cid,ctitle as name FROM catalog_tab WHERE cbid='.$bid.' AND (cstatus=1 OR cstatus=0) ORDER BY name ASC');
		return  $this -> db -> get() -> result();
	}
	
	function __get_catalog_search($bid,$keyword) {
		return "SELECT a.*,b.bname FROM catalog_tab a LEFT JOIN branch_tab b ON a.cbid=b.bid WHERE a.cbid=".$bid." AND (a.cstatus=1 OR a.cstatus=0) AND a.ctitle LIKE '%".$keyword."%' ORDER BY a.cid DESC";
	}
    
	function __get_catalog($bid) {
		return 'SELECT a.*,b.bname FROM catalog_tab a LEFT JOIN branch_tab b ON a.cbid=b.bid WHERE a.cbid='.$bid.' AND (a.cstatus=1 OR a.cstatus=0) ORDER BY a.cid DESC';
	}
	
	function __get_catalog_detail($id) {
		$this -> db -> select('* FROM catalog_tab WHERE (cstatus=1 OR cstatus=0) AND cid=' . $id);
		return $this -> db -> get() -> result();
	}
	
	function __check_catalog_books($cid, $bid) {
		$this -> db -> select('cbid FROM catalog_books_tab WHERE cstatus=1 AND ccid=' . $cid . ' AND cbid=' . $bid);
		return  $this -> db -> get() -> result();
	}
	
	function __insert_catalog($data) {
        return $this -> db -> insert('catalog_tab', $data);
	}

	function __insert_catalog_books($data) {
        return $this -> db -> insert('catalog_books_tab', $data);
	}
	
	function __update_catalog($id, $data) {
        $this -> db -> where('cid', $id);
        return $this -> db -> update('catalog_tab', $data);
	}
	
	function __delete_catalog($id) {
		return $this -> db -> query('update catalog_tab set cstatus=2 where cid=' . $id);
	}
	
	function __delete_catalog_books($cid, $id) {
		return $this -> db -> query('update catalog_books_tab set cstatus=2 where ccid=' . $cid . ' AND cbid=' . $id);
	}
}
