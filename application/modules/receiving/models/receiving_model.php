<?php
class Receiving_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }
    	
	function __get_receiving() {
		return 'SELECT * FROM receiving_tab WHERE (rstatus=1 OR rstatus=0 OR rstatus=3) ORDER BY rid DESC';
	}
	
	function __get_receiving_detail($id) {
		$this -> db -> select('* FROM receiving_tab WHERE (rstatus=1 OR rstatus=0 OR rstatus=3) AND rid=' . $id);
		return $this -> db -> get() -> result();
	}
	
	function __insert_receiving_books($data) {
        return $this -> db -> insert('receiving_books_tab', $data);
	}
	
	function __update_receiving_books($rid, $data) {
        $this -> db -> where('rid', $rid);
        return $this -> db -> update('receiving_books_tab', $data);
	}
	
	function __delete_receiving_books($rid, $bid) {
		return $this -> db -> query('update receiving_books_tab set rstatus=2 where rrid='.$rid.' and rbid=' . $bid);
	}
	
	function __insert_receiving($data) {
        return $this -> db -> insert('receiving_tab', $data);
	}
	
	function __update_receiving($id, $data) {
        $this -> db -> where('rid', $id);
        return $this -> db -> update('receiving_tab', $data);
	}
	
	function __delete_receiving($id) {
		return $this -> db -> query('update receiving_tab set rstatus=2 where rid=' . $id);
	}
	
	function __get_books($did,$type) {
		if ($type == 1)
			$this -> db -> select('b.bid as rbid, b.bcode,b.btitle,b.bprice,b.bisbn,c.pname FROM books_tab b LEFT JOIN publisher_tab c ON b.bpublisher=c.pid WHERE b.bid IN('.$did.') AND b.bstatus=1', FALSE);
		else
			$this -> db -> select('a.rid,a.rbid,a.rqty,b.bcode,b.btitle,b.bprice,b.bisbn,c.pname FROM receiving_books_tab a LEFT JOIN books_tab b ON a.rbid=b.bid LEFT JOIN publisher_tab c ON b.bpublisher=c.pid WHERE a.rstatus=1 AND a.rrid=' . $did);
		return $this -> db -> get() -> result();
	}
}
