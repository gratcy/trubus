<?php
class Request_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }
    
    function __get_request($bid="") {
		if ($bid) $bid = ' AND (a.dbfrom='.$bid.' OR a.dbto='.$bid.')';
		else $bid = '';
		return 'SELECT a.did,a.dtype,a.ddate,a.dtitle,a.ddesc,a.dldate,a.dstatus,b.bname as fbname,c.bname as tbname, (SELECT count(*) FROM distribution_book_tab d WHERE d.ddrid=a.did) as total_books, e.uemail as ucreateby, f.uemail as uupdateby FROM distribution_request_tab a LEFT JOIN branch_tab b ON a.dbfrom=b.bid LEFT JOIN branch_tab c ON a.dbto=c.bid LEFT JOIN users_tab e ON a.duid=e.uid LEFT JOIN users_tab f ON a.dluid=f.uid WHERE (a.dstatus=1 OR a.dstatus=0 OR a.dstatus=3)'.$bid.' ORDER BY a.did DESC';
	}
    
    function __get_request_book_id($did) {
		$this -> db -> select('dbid FROM distribution_book_tab WHERE did=' . $did);
		return $this -> db -> get() -> result();
	}
    
    function __get_request_type($id) {
		$this -> db -> select('dtype FROM distribution_request_tab WHERE did=' . $id);
		return $this -> db -> get() -> result();
	}
	
    function __get_suggestion() {
		$this -> db -> select('did,dtitle,dtype FROM distribution_request_tab WHERE dstatus!=2 ORDER BY did DESC');
		return $this -> db -> get() -> result();
	}
	
	function __export($bid) {
		$sql = $this -> db -> query(self::__get_request($bid));
		return $sql -> result(); 
	}
	
	function __get_request_select($bid='',$type) {
		if ($type == 3) {
			$bid = ' AND (dbto='.$bid.' OR dbfrom='.$bid.')';
			$type = '';
		}
		else {
			//~ if ($bid) $bid = ($type == 1 ? ' AND dbto='.$bid : ' AND dbfrom='.$bid);
			if ($bid) $bid = ' AND (dbto='.$bid.' OR dbfrom='.$bid.')';
			else $bid = '';
			if ($type == 1 || $type == 2) $type = ' AND dtype='.$type;
			else $type = '';
		}
		$this -> db -> select('did,dtype FROM distribution_request_tab WHERE dstatus=3'.$bid.$type.' order by did desc');
		return $this -> db -> get() -> result();
	}
	
	function __get_request_detail($id) {
		$this -> db -> select('* FROM distribution_request_tab WHERE (dstatus=1 OR dstatus=0 OR dstatus=3) AND did=' . $id);
		return $this -> db -> get() -> result();
	}
	
	function __get_request_books_detail($id) {
		$this -> db -> select('a.dtype,a.ddate,a.dtitle,a.ddesc,a.dstatus,b.bname as fbname,c.bname as tbname FROM distribution_request_tab a LEFT JOIN branch_tab b ON a.dbfrom=b.bid LEFT JOIN branch_tab c ON a.dbto=c.bid WHERE (a.dstatus=1 OR a.dstatus=0 OR a.dstatus=3) AND a.did=' . $id);
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
			$this -> db -> select('a.did,a.dbid,a.dqty,b.bcode,b.btitle,b.bprice,b.bisbn,c.pname FROM distribution_book_tab a LEFT JOIN books_tab b ON a.dbid=b.bid LEFT JOIN publisher_tab c ON b.bpublisher=c.pid WHERE a.dstatus=1 AND b.bstatus=1 AND a.ddrid=' . $did);
		return $this -> db -> get() -> result();
	}
	
	function __get_request_search($bid, $keyword) {
		return "SELECT a.did,a.dtype,a.ddate,a.dldate,a.dtitle,a.ddesc,a.dstatus,b.bname as fbname,c.bname as tbname, (SELECT count(*) FROM distribution_book_tab d WHERE d.ddrid=a.did) as total_books, e.uemail as ucreateby, f.uemail as uupdateby FROM distribution_request_tab a LEFT JOIN branch_tab b ON a.dbfrom=b.bid LEFT JOIN branch_tab c ON a.dbto=c.bid LEFT JOIN users_tab e ON a.duid=e.uid LEFT JOIN users_tab f ON a.dluid=f.uid WHERE (a.dstatus=1 OR a.dstatus=0 OR a.dstatus=3) AND (a.dbfrom=".$bid." OR a.dbto=".$bid.") AND (CONCAT('R01',LPAD(a.did,4,'0')) LIKE '%".$keyword."%' OR CONCAT('R02',LPAD(a.did,4,'0')) LIKE '%".$keyword."%' OR a.dtitle LIKE '%".$keyword."%') ORDER BY a.did DESC";
	}
}
