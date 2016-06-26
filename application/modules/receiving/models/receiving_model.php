<?php
class Receiving_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }

	function __get_receiving($bid=0) {
		return 'SELECT a.*, (SELECT COUNT(*) FROM receiving_books_tab b WHERE b.rrid=a.rid) as total_books, c.uemail as ucreateby, d.uemail as uupdateby FROM receiving_tab a LEFT JOIN users_tab c ON a.ruid=c.uid LEFT JOIN users_tab d ON a.rluid=d.uid WHERE (a.rstatus=1 OR a.rstatus=0 OR a.rstatus=3) AND a.rbid='.$bid.' ORDER BY a.rid DESC';
	}
	
	function __export($bid=0) {
		$sql = $this -> db -> query(self::__get_receiving($bid));
		return $sql -> result(); 
	}
	
	function __get_receiving_books_detail($id) {
		$this -> db -> select('* FROM receiving_books_tab WHERE rstatus=1 AND rid=' . $id);
		return $this -> db -> get() -> result();
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
		return $this -> db -> query('update receiving_tab set rstatus=2 where rstatus!=3 AND rid=' . $id);
	}
	
	function __get_books($did,$type) {
		if ($type == 1)
			$this -> db -> select('b.bid as rbid,b.bid as rid, b.bcode,b.btitle,b.bprice,b.bisbn,c.pname FROM books_tab b LEFT JOIN publisher_tab c ON b.bpublisher=c.pid WHERE b.bid IN ('.$did.') AND b.bstatus=1 ORDER BY FIELD (b.bid, '.$did.')', FALSE);
		else
			$this -> db -> select('a.rid,a.rbid,a.rqty,b.bcode,b.btitle,b.bprice,b.bisbn,c.pname FROM receiving_books_tab a LEFT JOIN books_tab b ON a.rbid=b.bid LEFT JOIN publisher_tab c ON b.bpublisher=c.pid WHERE a.rstatus=1 AND b.bstatus=1 AND a.rrid=' . $did);
		return $this -> db -> get() -> result();
	}
	
	function __get_suggestion($bid) {
		$this -> db -> select('rid,rdocno as name FROM receiving_tab WHERE rbid='.$bid.' AND rstatus!=2');
		$a = $this -> db -> get() -> result();

		$this -> db -> select('rid,rdesc as name FROM receiving_tab WHERE rbid='.$bid.' AND rstatus!=2');
		$b = $this -> db -> get() -> result();
		
		return array_merge($a,$b);
	}

	function __get_receiving_search($bid=0, $keyword) {
		return "SELECT a.*, (SELECT COUNT(*) FROM receiving_books_tab b WHERE b.rrid=a.rid) as total_books, c.uemail as ucreateby, d.uemail as uupdateby FROM receiving_tab a LEFT JOIN users_tab c ON a.ruid=c.uid LEFT JOIN users_tab d ON a.rluid=d.uid WHERE (a.rstatus=1 OR a.rstatus=0 OR a.rstatus=3) AND a.rbid=".$bid." AND (a.rdocno LIKE '%".$keyword."%' OR a.rdesc LIKE '%".$keyword."%') ORDER BY a.rid DESC";
	}
	
	function __get_inventory_detail($book,$branch) {
		$this -> db -> select('* FROM inventory_tab WHERE itype=1 AND ibid='.$book.' AND ibcid=' . $branch);
		return $this -> db -> get() -> result();
	}
	
	function __update_inventory($bid, $branch, $data) {
        $this -> db -> where('ibid', $bid);
        $this -> db -> where('ibcid', $branch);
        $this -> db -> where('itype', 1);
        return $this -> db -> update('inventory_tab', $data);
	}
	
	function __get_inventory_shadow_detail($book,$branch) {
		$this -> db -> select('* FROM inventory_shadow_tab WHERE ibid='.$book.' AND ibcid=' . $branch);
		return $this -> db -> get() -> result();
	}
	
	function __update_inventory_shadow($bid, $branch, $data) {
        $this -> db -> where('ibid', $bid);
        $this -> db -> where('ibcid', $branch);
        return $this -> db -> update('inventory_shadow_tab', $data);
	}
	
	function __get_receiving_by_books($branch,$bid) {
		$this -> db -> select("a.riid,a.rtype,a.rdocno as tnofaktur,from_unixtime(a.rdate,'%Y-%m-%d') as ttanggal,b.rqty as tqty,d.pname as cname,12 as ttypetrans,1 as approved FROM receiving_tab a LEFT JOIN receiving_books_tab b ON a.rid=b.rrid LEFT JOIN books_tab c ON b.rbid=c.bid LEFT JOIN publisher_tab d ON c.bpublisher=d.pid WHERE a.rstatus=3 AND c.bstatus=1 AND b.rstatus=1 AND a.rbid=$branch AND b.rbid=" . $bid, FALSE);
		return $this -> db -> get() -> result();
	}
}
