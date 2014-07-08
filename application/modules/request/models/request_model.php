<?php
class Request_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }
    
    function __get_request() {
		return 'SELECT a.did,a.ddate,a.dtitle,a.ddesc,a.dstatus,b.bname as fbname,c.bname as tbname FROM distribution_request_tab a LEFT JOIN branch_tab b ON a.dbfrom=b.bid LEFT JOIN branch_tab c ON a.dbto=c.bid WHERE (a.dstatus=1 OR a.dstatus=0 OR a.dstatus=3) ORDER BY a.did DESC';
	}
	
	function __get_request_select() {
		$this -> db -> select('did FROM distribution_request_tab WHERE dstatus=3 order by did desc');
		return $this -> db -> get() -> result();
	}
	
	function __get_request_detail($id) {
		$this -> db -> select('* FROM distribution_request_tab WHERE (dstatus=1 OR dstatus=0 OR dstatus=3) AND did=' . $id);
		return $this -> db -> get() -> result();
	}
	
	function __get_request_books_detail($id) {
		$this -> db -> select('a.ddate,a.dtitle,a.ddesc,a.dstatus,b.bname as fbname,c.bname as tbname FROM distribution_request_tab a LEFT JOIN branch_tab b ON a.dbfrom=b.bid LEFT JOIN branch_tab c ON a.dbto=c.bid WHERE (a.dstatus=1 OR a.dstatus=0 OR a.dstatus=3) AND a.did=' . $id);
		return $this -> db -> get() -> result();
	}
	
	function __insert_request_books($data) {
        return $this -> db -> insert('distribution_book_tab', $data);
	}
	
	function __update_request_books($did, $data) {
        $this -> db -> where('did', $did);
        return $this -> db -> update('distribution_book_tab', $data);
	}
	
	function __delete_request_books($did, $bid) {
		return $this -> db -> query('update distribution_book_tab set dstatus=2 where ddrid='.$did.' and dbid=' . $bid);
	}
	
	function __insert_request($data) {
        return $this -> db -> insert('distribution_request_tab', $data);
	}
	
	function __update_request($id, $data) {
        $this -> db -> where('did', $id);
        return $this -> db -> update('distribution_request_tab', $data);
	}
	
	function __delete_request($id) {
		return $this -> db -> query('update distribution_request_tab set dstatus=2 where did=' . $id);
	}
	
	function __get_books($did,$type) {
		if ($type == 1)
			$this -> db -> select('b.bid as dbid, b.bcode,b.btitle,b.bprice,b.bisbn,c.pname FROM books_tab b LEFT JOIN publisher_tab c ON b.bpublisher=c.pid WHERE b.bid IN('.$did.') AND b.bstatus=1', FALSE);
		else
			$this -> db -> select('a.did,a.dbid,a.dqty,b.bcode,b.btitle,b.bprice,b.bisbn,c.pname FROM distribution_book_tab a LEFT JOIN books_tab b ON a.dbid=b.bid LEFT JOIN publisher_tab c ON b.bpublisher=c.pid WHERE a.dstatus=1 AND a.ddrid=' . $did);
		return $this -> db -> get() -> result();
	}
}
