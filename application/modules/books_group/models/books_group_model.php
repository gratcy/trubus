<?php
class Books_group_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }
    
    function __get_books_group_select() {
		$this -> db -> select('bid,bname FROM books_group_tab WHERE bstatus=1 ORDER BY bname ASC');
		return $this -> db -> get() -> result();
	}
	
	function __get_books_group() {
		return 'SELECT * FROM books_group_tab WHERE (bstatus=1 OR bstatus=0) ORDER BY bname DESC';
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
