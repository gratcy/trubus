<?php
class Books_group_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }
    
    function __get_suggestion() {
		$this -> db -> select('bid,bname as name FROM books_group_tab WHERE (bstatus=1 OR bstatus=0) ORDER BY name ASC');
		$a =  $this -> db -> get() -> result();
		$this -> db -> select('bid,bcode as name FROM books_group_tab WHERE (bstatus=1 OR bstatus=0) ORDER BY name ASC');
		$b = $this -> db -> get() -> result();
		return array_merge($a,$b);
	}
	
	function __get_books_group_search($keyword) {
		return "SELECT * FROM books_group_tab WHERE (bstatus=1 OR bstatus=0) AND (bname LIKE '%".$keyword."%' OR bcode LIKE '%".$keyword."%') ORDER BY bname DESC";
	}
    
    function __get_books_group_select($type, $parent) {
		if ($type == 1)
			$this -> db -> select('bid,bname,bparent FROM books_group_tab WHERE bstatus=1 and bparent=0 ORDER BY bname ASC');
		else
			$this -> db -> select('bid,bname,bparent FROM books_group_tab WHERE bstatus=1 and bparent='.$parent.' ORDER BY bname ASC');
		return $this -> db -> get() -> result();
	}
	
	function __check_parent($id) {
		$this -> db -> select('bparent FROM books_group_tab WHERE bstatus=1 and bid=' . $id);
		return $this -> db -> get() -> result();
	}
	
	function __get_books_group_child($parent) {
		$this -> db -> select('* FROM books_group_tab WHERE bstatus=1 and bparent='.$parent.' ORDER BY bname ASC');
		return $this -> db -> get() -> result();
	}
	
	function __get_books_group() {
		return 'SELECT * FROM books_group_tab WHERE (bstatus=1 OR bstatus=0) AND bparent=0 ORDER BY bname DESC';
	}
	
	function __get_books_group_detail($id) {
		$this -> db -> select('* FROM books_group_tab WHERE (bstatus=1 OR bstatus=0) AND bid=' . $id);
		return $this -> db -> get() -> result();
	}
	
	function __insert_books_group($data) {
        return $this -> db -> insert('books_group_tab', $data);
	}
	
	function __update_books_group($id, $data) {
        $this -> db -> where('bid', $id);
        return $this -> db -> update('books_group_tab', $data);
	}
	
	function __delete_books_group($id) {
		return $this -> db -> query('update books_group_tab set bstatus=2 where bid=' . $id);
	}
}
