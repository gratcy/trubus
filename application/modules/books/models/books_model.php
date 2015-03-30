<?php
class Books_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }
    
    function __get_books_locator($ids) {
		if ($ids) {
			$this -> db -> select("bid,bcode,btitle,bisbn,bcover FROM books_tab WHERE (bstatus=1 OR bstatus=0) AND bid IN (".$ids.") ORDER BY btitle DESC", FALSE);
			return $this -> db -> get() -> result();
		}
		return 'SELECT bid,bcode,btitle,bisbn,bcover FROM books_tab WHERE (bstatus=1 OR bstatus=0) ORDER BY btitle DESC';
	}
    
    function __get_books_locator_search($keyword) {
		return "SELECT bid,bcode,btitle,bisbn,bcover FROM books_tab WHERE (bstatus=1 OR bstatus=0) AND (btitle LIKE '%".$keyword."%' OR bcode LIKE '%".$keyword."%') ORDER BY btitle DESC";
	}
    
    function __get_suggestion() {
		$this -> db -> select('bid,btitle as name FROM books_tab WHERE (bstatus=1 OR bstatus=0) ORDER BY btitle DESC');
		$a =  $this -> db -> get() -> result();
		$this -> db -> select('bid,bcode as name FROM books_tab WHERE (bstatus=1 OR bstatus=0) ORDER BY btitle DESC');
		$b = $this -> db -> get() -> result();
		return array_merge($a,$b);
	}
    
	function __get_books_search($keyword) {
		return "SELECT a.*,b.bname,c.pname FROM books_tab a LEFT JOIN books_group_tab b ON a.bgroup=b.bid LEFT JOIN publisher_tab c ON a.bpublisher=c.pid WHERE (a.bstatus=1 OR a.bstatus=0) AND (a.btitle='".$keyword."' OR a.bcode='".$keyword."') ORDER BY a.btitle DESC";
	}
    
    function __get_books_select() {
		$this -> db -> select('bid,btitle FROM books_tab WHERE (bstatus=1 OR bstatus=0) ORDER BY btitle DESC');
		return $this -> db -> get() -> result();
	}

    function __get_books_selectxx() {
		$this -> db -> select('* FROM books_tab WHERE (bstatus=1 OR bstatus=0) ORDER BY btitle DESC');
		return $this -> db -> get() -> result();
	}	
    
	function __get_books() {
		return 'SELECT a.*,b.bname,c.pname FROM books_tab a LEFT JOIN books_group_tab b ON a.bgroup=b.bid LEFT JOIN publisher_tab c ON a.bpublisher=c.pid WHERE (a.bstatus=1 OR a.bstatus=0) ORDER BY a.btitle DESC';
	}
	
	function __get_books_detail($id) {
		$this -> db -> select('* FROM books_tab WHERE (bstatus=1 OR bstatus=0) AND bid=' . $id);
		return $this -> db -> get() -> result();
	}
	
	function __insert_books($data) {
        return $this -> db -> insert('books_tab', $data);
	}
	
	function __update_books($id, $data) {
        $this -> db -> where('bid', $id);
        return $this -> db -> update('books_tab', $data);
	}
	
	function __delete_books($id) {
		return $this -> db -> query('update books_tab set bstatus=2 where bid=' . $id);
	}
}
