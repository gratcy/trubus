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
		return "SELECT a.*,c.pname FROM books_tab a LEFT JOIN publisher_tab c ON a.bpublisher=c.pid LEFT JOIN categories_tab d ON a.bcid=d.cid AND d.ctype=2 WHERE (a.bstatus=1 OR a.bstatus=0) AND (a.btitle LIKE '%".$keyword."%' OR a.bcode LIKE '%".$keyword."%' OR a.bauthor LIKE '%".$keyword."%' OR c.pname LIKE '%".$keyword."%' OR d.cname LIKE '%".$keyword."%') ORDER BY a.bcode ASC";
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
		return 'SELECT a.*,c.pname FROM books_tab a LEFT JOIN publisher_tab c ON a.bpublisher=c.pid WHERE (a.bstatus=1 OR a.bstatus=0) ORDER BY a.bid DESC';
	}
	
	function __get_books_detail($id) {
		$this -> db -> select('* FROM books_tab WHERE (bstatus=1 OR bstatus=0) AND bid=' . $id);
		return $this -> db -> get() -> result();
	}
	
	function __get_total_category_book($cid) {
		$this -> db -> select('* FROM books_tab WHERE (bstatus=1 OR bstatus=0) AND bpublisher=' . $cid);
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
	
	function __export() {
		$this -> db -> select('a.*,c.pname FROM books_tab a LEFT JOIN publisher_tab c ON a.bpublisher=c.pid WHERE (a.bstatus=1 OR a.bstatus=0) ORDER BY a.bcode DESC');
		return $this -> db -> get() -> result_array();
	}
	
	function __get_books_search_inventory($keyword) {
		$this -> db -> select("a.bid FROM books_tab a LEFT JOIN publisher_tab b ON a.bpublisher=b.pid WHERE (a.btitle='".$keyword."' OR a.bcode='".$keyword."' OR b.pname LIKE '%".$keyword."%')");
		return $this -> db -> get() -> result();
	}
	
	function __get_books_by_id($ids) {
		$ids = implode(',',$ids);
		$this -> db -> select('bid,bcode,btitle FROM books_tab WHERE bid IN('.$ids.') AND bstatus=1', FALSE);
		return $this -> db -> get() -> result();
	}
}
