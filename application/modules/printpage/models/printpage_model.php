<?php
class Printpage_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }
    
	function __get_books_detail($id) {
		$this -> db -> select('a.*,b.pname,c.bname FROM books_tab a LEFT JOIN publisher_tab b ON a.bpublisher=b.pid LEFT JOIN books_group_tab c ON a.bgroup=c.bid WHERE (a.bstatus=1 OR a.bstatus=0) AND a.bid=' . $id);
		return $this -> db -> get() -> result();
	}
}
