<?php
class Transfer_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }
    
    function __get_transfer($bid="") {
		if ($bid) $bid = ' AND (b.dbfrom='.$bid.' OR b.dbto='.$bid.')';
		else $bid = '';
		return 'SELECT a.did,a.dtype,a.ddrid,a.ddocno,a.ddate,a.dldate,a.dtitle,a.ddesc,a.dstatus,b.dbfrom,b.dbto,c.bname as fbname,d.bname as tbname, (SELECT count(*) FROM distribution_book_tab e WHERE e.ddrid=a.did) as total_books, f.uemail as ucreateby, g.uemail as uupdateby FROM distribution_tab a LEFT JOIN distribution_request_tab b ON a.ddrid=b.did LEFT JOIN branch_tab c ON b.dbfrom=c.bid LEFT JOIN branch_tab d ON b.dbto=d.bid LEFT JOIN users_tab f ON a.duid=f.uid LEFT JOIN users_tab g ON a.dluid=g.uid WHERE (a.dstatus=1 OR a.dstatus=0 OR a.dstatus=3 OR a.dstatus=4)'.$bid.' ORDER BY a.did DESC';
	}
    
    function __get_suggestion() {
		$this -> db -> select('did,ddocno FROM distribution_tab WHERE dstatus!=2 ORDER BY did DESC');
		return $this -> db -> get() -> result();
	}
	
	function __export($bid) {
		$sql = $this -> db -> query(self::__get_transfer($bid));
		return $sql -> result(); 
	}
	
	function __get_transfer_detail($id) {
		$this -> db -> select('* FROM distribution_tab WHERE (dstatus=1 OR dstatus=0 OR dstatus=3 OR dstatus=4) AND did=' . $id);
		return $this -> db -> get() -> result();
	}
	
	function __get_transfer_by_request($id) {
		$this -> db -> select('* FROM distribution_tab WHERE (dstatus=3 OR dstatus=4) AND ddrid=' . $id);
		return $this -> db -> get() -> result();
	}
	
	function __get_transfer_books_detail($id) {
		$this -> db -> select('a.did,a.dtype,a.ddocno,a.ddrid,a.ddate,a.dtitle,a.ddesc,a.dstatus,c.bname as fbname,d.bname as tbname FROM distribution_tab a LEFT JOIN distribution_request_tab b ON a.ddrid=b.did LEFT JOIN branch_tab c ON b.dbfrom=c.bid LEFT JOIN branch_tab d ON b.dbto=d.bid WHERE (a.dstatus=1 OR a.dstatus=0 OR a.dstatus=3 OR a.dstatus=4) AND a.did=' . $id);
		return $this -> db -> get() -> result();
	}
	
	function __insert_transfer($data) {
        return $this -> db -> insert('distribution_tab', $data);
	}
	
	function __update_transfer($id, $data) {
        $this -> db -> where('did', $id);
        return $this -> db -> update('distribution_tab', $data);
	}
	
	function __get_transfer_out($branch,$bid,$type) {
		if ($type == 1)
			$this -> db -> select("a.ddocno as tnofaktur,from_unixtime(a.ddate,'%Y-%m-%d') as ttanggal,a.dstatus as tstatus,c.dqty as tqty,d.bname as cname,14 as ttypetrans FROM distribution_tab a LEFT JOIN distribution_request_tab b ON a.ddrid=b.did LEFT JOIN distribution_book_tab c ON a.ddrid=c.ddrid LEFT JOIN branch_tab d ON b.dbfrom=d.bid WHERE b.dbto=".$branch." AND (a.dstatus=4 OR a.dstatus=3) AND b.dstatus=3 AND c.dstatus=1 AND c.dbid=" . $bid, FALSE);
		else
			$this -> db -> select("a.ddocno as tnofaktur,from_unixtime(a.ddate,'%Y-%m-%d') as ttanggal,a.dstatus as tstatus,c.dqty as tqty,d.bname as cname,15 as ttypetrans FROM distribution_tab a LEFT JOIN distribution_request_tab b ON a.ddrid=b.did LEFT JOIN distribution_book_tab c ON a.ddrid=c.ddrid LEFT JOIN branch_tab d ON b.dbto=d.bid WHERE b.dbfrom=".$branch." AND (a.dstatus=4 OR a.dstatus=3) AND b.dstatus=3 AND c.dstatus=1 AND c.dbid=" . $bid, FALSE);
		return $this -> db -> get() -> result();
	}
	
	function __get_transfer_by_books($branch,$bid) {
		$this -> db -> select("a.ddocno as tnofaktur,from_unixtime(a.ddate,'%Y-%m-%d') as ttanggal,c.dqty as tqty,d.bname as cname,13 as ttypetrans FROM distribution_tab a LEFT JOIN distribution_request_tab b ON a.ddrid=b.did LEFT JOIN distribution_book_tab c ON a.ddrid=c.ddrid LEFT JOIN branch_tab d ON b.dbfrom=d.bid WHERE b.dbto=".$branch." AND (a.dstatus=3 OR a.dstatus=4) AND b.dstatus=3 AND c.dstatus=1 AND c.dbid=" . $bid, FALSE);
		return $this -> db -> get() -> result();
	}
	
	function __delete_transfer($id) {
		return $this -> db -> query('update distribution_tab set dstatus=2 where did=' . $id);
	}
	
	function ___get_maxid_transfer() {
		$this -> db -> select('max(did) as maxid FROM distribution_tab');
		return $this -> db -> get() -> result();
	}
	
	function __get_transfer_search($bid, $keyword) {
		return "SELECT a.did,a.ddrid,a.ddocno,a.ddate,a.dtitle,a.ddesc,a.dstatus,b.dbfrom,b.dbto,c.bname as fbname,d.bname as tbname, (SELECT count(*) FROM distribution_book_tab e WHERE e.ddrid=a.did) as total_books, f.uemail as ucreateby, g.uemail as uupdateby FROM distribution_tab a LEFT JOIN distribution_request_tab b ON a.ddrid=b.did LEFT JOIN branch_tab c ON b.dbfrom=c.bid LEFT JOIN branch_tab d ON b.dbto=d.bid LEFT JOIN users_tab f ON a.duid=f.uid LEFT JOIN users_tab g ON a.dluid=g.uid WHERE (a.dstatus=1 OR a.dstatus=0 OR a.dstatus=3 OR a.dstatus=4) AND (b.dbfrom=".$bid." OR b.dbto=".$bid.") AND (a.ddocno LIKE '%".$keyword."%' OR a.dtitle LIKE '%".$keyword."%' OR CONCAT('R01',LPAD(a.ddrid,4,'0')) LIKE '%".$keyword."%' OR CONCAT('R02',LPAD(a.ddrid,4,'0')) LIKE '%".$keyword."%') ORDER BY a.did DESC";
	}
}
