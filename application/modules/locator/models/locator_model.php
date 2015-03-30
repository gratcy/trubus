<?php
class Locator_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }
    
    function __get_locator_books($id) {
		$this -> db -> select('lbid FROM locator_books_tab WHERE lstatus=1 AND llid=' . $id);
		return  $this -> db -> get() -> result();
	}
    
    function __get_suggestion() {
		$this -> db -> select('lid,lplaced as name FROM locator_tab WHERE (lstatus=1 OR lstatus=0) ORDER BY name ASC');
		return  $this -> db -> get() -> result();
	}
	
	function __get_locator_search($keyword) {
		return "SELECT * FROM locator_tab WHERE (lstatus=1 OR lstatus=0) AND lplaced LIKE '%".$keyword."%' ORDER BY lplaced DESC";
	}
    
    function __get_locator_select() {
		$this -> db -> select('lid,lplaced FROM locator_tab WHERE lstatus=1 ORDER BY lplaced ASC');
		return $this -> db -> get() -> result();
	}
	
	function __get_locator() {
		return 'SELECT * FROM locator_tab WHERE (lstatus=1 OR lstatus=0) ORDER BY lplaced DESC';
	}
	
	function __get_locator_detail($id) {
		$this -> db -> select('* FROM locator_tab WHERE (lstatus=1 OR lstatus=0) AND lid=' . $id);
		return $this -> db -> get() -> result();
	}
	
	function __check_locator_books($lid, $bid) {
		$this -> db -> select('lbid FROM locator_books_tab WHERE lstatus=1 AND llid=' . $lid . ' AND lbid=' . $bid);
		return  $this -> db -> get() -> result();
	}
	
	function __insert_locator($data) {
        return $this -> db -> insert('locator_tab', $data);
	}

	function __insert_locator_books($data) {
        return $this -> db -> insert('locator_books_tab', $data);
	}
	
	function __update_locator($id, $data) {
        $this -> db -> where('lid', $id);
        return $this -> db -> update('locator_tab', $data);
	}
	
	function __delete_locator($id) {
		return $this -> db -> query('update locator_tab set lstatus=2 where lid=' . $id);
	}
	
	function __delete_locator_books($lid, $id) {
		return $this -> db -> query('update locator_books_tab set lstatus=2 where llid=' . $lid . ' AND lbid=' . $id);
	}
}
