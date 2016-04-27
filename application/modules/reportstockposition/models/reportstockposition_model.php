<?php
class Reportstockposition_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }
    
	function __get_stockposition_branch($bid) {
		return "SELECT a.iid,a.ibid,a.istockbegining,a.istockin,a.istockout,a.istockretur,a.istock,b.bcode,b.btitle,b.bprice FROM inventory_tab a INNER JOIN books_tab b ON a.ibid=b.bid WHERE a.itype=1 AND a.ibcid=".$bid." AND b.bstatus=1 AND a.istatus=1";
	}
    
	function __get_stockposition_customer($bid) {
		return "SELECT a.cid,a.cname,b.iid,b.ibid,b.istockbegining,b.istockin,b.istockout,b.istock,c.bcode,c.btitle,c.bprice FROM customer_tab a INNER JOIN inventory_tab b ON a.cid=b.ibcid INNER JOIN books_tab c ON b.ibid=c.bid WHERE a.ctype=0 AND b.itype=2 AND a.cbid=".$bid." AND a.cstatus=1 AND c.bstatus=1";
	}
    
	function __get_stockposition_area($bid) {
		return "SELECT bid,bcode,btitle,bprice,aid,aname FROM books_tab, area_tab WHERE bstatus=1 AND astatus=1 AND abid=" . $bid;
	}
    
	function __get_stockposition_book($bid) {
		return "SELECT bid,bcode,btitle,bprice FROM books_tab WHERE bstatus=1";
	}
    
    function __get_stockposition_export($ibcid, $type) {
		if ($type == 'branch') $sql = $this -> db -> query(self::__get_stockposition_branch($ibcid));
		elseif ($type == 'customer') $sql = $this -> db -> query(self::__get_stockposition_customer($ibcid));
		elseif ($type == 'area') $sql = $this -> db -> query(self::__get_stockposition_area($ibcid));
		else $sql = $this -> db -> query(self::__get_stockposition_book($ibcid));
		return $sql -> result();
	}
    
	function __get_stockposition_area_detail($bid, $ibcid, $area, $ttype) {
		if ($ttype == 1) $stock = 'istockbegining';
		elseif ($ttype == 2) $stock = 'istockin';
		elseif ($ttype == 3) $stock = 'istockout';
		else $stock = 'istock';
		
		$this -> db -> select('SUM(b.'.$stock.') as total FROM customer_tab a INNER JOIN inventory_tab b ON a.cid=b.ibcid WHERE a.cbid='.$ibcid.' AND a.carea='.$area.' AND a.cstatus=1 AND a.ctype=0 AND b.itype=2 AND b.ibid=' . $bid);
		return $this -> db -> get() -> result();
	}
    
	function __get_stockposition_book_detail($bid, $ibcid, $type, $ttype) {
		if ($ttype == 1) $stock = 'istockin';
		elseif ($ttype == 2) $stock = 'istockout';
		else $stock = 'istock';
		
		if ($type == 1) $this -> db -> select($stock.' as total FROM inventory_tab WHERE istatus=1 AND itype=1 AND ibcid='.$ibcid.' AND ibid=' . $bid);
		else $this -> db -> select('SUM(b.'.$stock.') as total FROM customer_tab a INNER JOIN inventory_tab b ON a.cid=b.ibcid WHERE a.cbid='.$ibcid.' AND a.cstatus=1 AND a.ctype=0 AND b.itype=2 AND b.ibid=' . $bid);
		return $this -> db -> get() -> result();
	}
	
	function __get_stock_book_process($bid, $bcid) {
		$this -> db -> select("sum(b.tqty) as total from transaction_tab a LEFT JOIN transaction_detail_tab b ON a.tid=b.ttid where (a.tnofaktur LIKE 'JK%' OR a.tnofaktur LIKE 'JC%') AND a.tbid=".$bcid." AND b.approval<2 AND a.tstatus != 2 AND b.tstatus != 2 AND b.tbid=" . $bid);
		$tr = $this -> db -> get() -> result();
		
		$this -> db -> select("SUM(c.dqty) as total FROM distribution_tab a LEFT JOIN distribution_request_tab b ON a.ddrid=b.did LEFT JOIN distribution_book_tab c ON a.ddrid=c.ddrid WHERE a.dtype=2 AND b.dbto=".$bcid." AND a.dstatus=3 AND b.dstatus=3 AND c.dstatus=1 AND c.dbid=" . $bid);
		$tr2 = $this -> db -> get() -> result();
		
		$this -> db -> select("SUM(c.dqty) as total FROM distribution_tab a LEFT JOIN distribution_request_tab b ON a.ddrid=b.did LEFT JOIN distribution_book_tab c ON a.ddrid=c.ddrid WHERE a.dtype=2 AND b.dbfrom=".$bcid." AND a.dstatus=3 AND b.dstatus=3 AND c.dstatus=1 AND c.dbid=" . $bid);
		$tr4 = $this -> db -> get() -> result();
		
		$this -> db -> select("sum(b.tqty) as total from transaction_tab a LEFT JOIN transaction_detail_tab b ON a.tid=b.ttid where (a.tnofaktur LIKE 'RJK%' OR a.tnofaktur LIKE 'RJC%') AND a.tbid=".$bcid." AND b.approval<2 AND a.tstatus != 2 AND b.tstatus != 2 AND b.tbid=" . $bid);
		$tr3 = $this -> db -> get() -> result();
		
		$this -> db -> select("SUM(c.dqty) as total FROM distribution_tab a LEFT JOIN distribution_request_tab b ON a.ddrid=b.did LEFT JOIN distribution_book_tab c ON a.ddrid=c.ddrid WHERE a.dtype=1 AND b.dbto=".$bcid." AND a.dstatus=3 AND b.dstatus=3 AND c.dstatus=1 AND c.dbid=" . $bid);
		$tr5 = $this -> db -> get() -> result();
		
		return ($tr[0] -> total + $tr2[0] -> total + $tr4[0] -> total + $tr5[0] -> total) - $tr3[0] -> total;
	}
	
	function __get_stockposition_search($bid,$ibcid,$type) {
		if ($type == 'branch')
			return "SELECT a.iid,a.ibid,a.istockbegining,a.istockin,a.istockout,a.istock,b.bcode,b.btitle,b.bprice FROM inventory_tab a INNER JOIN books_tab b ON a.ibid=b.bid WHERE a.itype=1 AND a.ibcid=".$ibcid." AND a.ibid IN (".$bid.") AND b.bstatus=1 AND a.istatus=1";
		elseif ($type == 'customer')
			return "SELECT a.cid,a.cname,b.iid,b.ibid,b.istockbegining,b.istockin,b.istockout,b.istock,c.bcode,c.btitle,c.bprice FROM customer_tab a INNER JOIN inventory_tab b ON a.cid=b.ibcid INNER JOIN books_tab c ON b.ibid=c.bid WHERE a.ctype=0 AND b.itype=2 AND a.cbid=".$ibcid." AND c.bid IN (".$bid.") AND a.cstatus=1 AND c.bstatus=1";
		elseif ($type == 'area')
			return "SELECT bid,bcode,btitle,bprice,aid,aname FROM books_tab, area_tab WHERE bstatus=1 AND astatus=1 AND bid IN (".$bid.") AND abid=" . $bid;
		else
			return "SELECT bid,bcode,btitle,bprice FROM books_tab WHERE bstatus=1 AND bid IN (".$bid.")";
	}
}
