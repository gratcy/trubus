<?php
class Transfer_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }
    
    function __get_transfer($bid="") {
		if ($bid) $bid = ' AND (b.dbfrom='.$bid.' OR b.dbto='.$bid.')';
		else $bid = '';
		return 'SELECT a.did,a.ddrid,a.ddocno,a.ddate,a.dtitle,a.ddesc,a.dstatus,c.bname as fbname,d.bname as tbname, (SELECT count(*) FROM distribution_book_tab e WHERE e.ddrid=a.did) as total_books FROM distribution_tab a LEFT JOIN distribution_request_tab b ON a.ddrid=b.did LEFT JOIN branch_tab c ON b.dbfrom=c.bid LEFT JOIN branch_tab d ON b.dbto=d.bid WHERE (a.dstatus=1 OR a.dstatus=0 OR a.dstatus=3)'.$bid.' ORDER BY a.did DESC';
	}
	
	function __export() {
		$sql = $this -> db -> query(self::__get_transfer());
		return $sql -> result(); 
	}
	
	function __get_transfer_detail($id) {
		$this -> db -> select('* FROM distribution_tab WHERE (dstatus=1 OR dstatus=0 OR dstatus=3) AND did=' . $id);
		return $this -> db -> get() -> result();
	}
	
	function __get_transfer_by_request($id) {
		$this -> db -> select('* FROM distribution_tab WHERE dstatus=3 AND ddrid=' . $id);
		return $this -> db -> get() -> result();
	}
	
	function __get_transfer_books_detail($id) {
		$this -> db -> select('a.did,a.ddocno,a.ddrid,a.ddate,a.dtitle,a.ddesc,a.dstatus,c.bname as fbname,d.bname as tbname FROM distribution_tab a LEFT JOIN distribution_request_tab b ON a.ddrid=b.did LEFT JOIN branch_tab c ON b.dbfrom=c.bid LEFT JOIN branch_tab d ON b.dbto=d.bid WHERE (a.dstatus=1 OR a.dstatus=0 OR a.dstatus=3) AND a.did=' . $id);
		return $this -> db -> get() -> result();
	}
	
	function __insert_transfer($data) {
        return $this -> db -> insert('distribution_tab', $data);
	}
	
	function __update_transfer($id, $data) {
        $this -> db -> where('did', $id);
        return $this -> db -> update('distribution_tab', $data);
	}
	
	function __get_transfer_by_books($branch,$bid) {
		$this -> db -> select("a.ddocno as tnofaktur,from_unixtime(a.ddate,'%Y-%m-%d') as ttanggal,c.dqty as tqty,d.bname as cname,13 as ttypetrans FROM distribution_tab a LEFT JOIN distribution_request_tab b ON a.ddrid=b.did LEFT JOIN distribution_book_tab c ON a.ddrid=c.ddrid LEFT JOIN branch_tab d ON b.dbfrom=d.bid WHERE b.dbto=".$branch." AND a.dstatus=3 AND b.dstatus=3 AND c.dstatus=1 AND c.dbid=" . $bid, FALSE);
		return $this -> db -> get() -> result();
	}
	
	function __delete_transfer($id) {
		return $this -> db -> query('update distribution_tab set dstatus=2 where did=' . $id);
	}
}
