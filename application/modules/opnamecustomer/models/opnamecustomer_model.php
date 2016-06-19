<?php
class Opnamecustomer_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }
	
	function __insert_opnamecustomer($data) {
        return $this -> db -> insert('opname_tab', $data);
	}
	
	function __get_inventory_by_book_id($bid, $bids) {
		return 'SELECT a.iid,a.ibid,a.ibcid,a.istockbegining,a.istockin,a.istockreject,a.istockretur,a.istockout,a.istock,a.ishadow,b.btitle,b.bcode,b.bprice FROM inventory_tab a LEFT JOIN books_tab b ON a.ibid=b.bid WHERE b.bstatus=1 AND a.itype=2 AND b.bid IN ('.$bids.') AND a.ibcid='.$bid;
	}
	
	function __get_inventory_by_book_id_search($bid, $bids, $keyword) {
		return "SELECT a.iid,a.ibid,a.ibcid,a.istockbegining,a.istockin,a.istockout,a.istockreject,a.istockretur,a.istock,a.ishadow,b.btitle,b.bcode,b.bprice FROM inventory_tab a LEFT JOIN books_tab b ON a.ibid=b.bid WHERE b.bstatus=1 AND a.itype=2 AND b.bid IN (".$bids.") AND (b.bcode LIKE '%".$keyword."%' OR b.btitle LIKE '%".$keyword."%') AND a.ibcid=".$bid;
	}
	
	function __get_stock_adjustment($iid, $branch, $type) {
		if ($type == 1)
			$this -> db -> select('SUM(oadjustplus) as total FROM opname_tab WHERE otype=2 AND ostatus=1 AND oidid='.$iid.' AND obid=' . $branch);
		else
			$this -> db -> select('SUM(oadjustmin) as total FROM opname_tab WHERE otype=2 AND ostatus=1 AND oidid='.$iid.' AND obid=' . $branch);
		return $this -> db -> get() -> result();
	}
    
	function __get_customer($ctype=1,$bid) {
		$ctype = ' AND a.ctype=' . $ctype;
		return 'SELECT a.*,b.bname,d.acode,d.aname FROM customer_tab a LEFT JOIN branch_tab b ON a.cbid=b.bid LEFT JOIN area_tab d ON a.carea=d.aid WHERE a.cbid='.$bid.' AND a.cstatus=1'.$ctype.' ORDER BY a.cid DESC';
	}
	
	function __get_opname_inventory($cid) {
		return 'SELECT a.iid,a.ibid,a.istockbegining,a.istockin,a.istockout,a.istockreject,a.istockretur,a.istock,a.istatus,b.bcode,b.btitle,c.cid,c.cname FROM inventory_tab a LEFT JOIN books_tab b ON a.ibid=b.bid LEFT JOIN customer_tab c ON a.ibcid=c.cid WHERE a.itype=2 AND (a.istatus=1 OR a.istatus=0) AND b.bstatus=1 AND a.ibcid='.$cid.' ORDER BY a.iid DESC';
	}
	
	function __get_opname_inventory_search($cid,$keyword) {
		return "SELECT a.iid,a.ibid,a.istockbegining,a.istockin,a.istockout,a.istockreject,a.istockretur,a.istock,a.istatus,b.bcode,b.btitle,c.cid,c.cname FROM inventory_tab a LEFT JOIN books_tab b ON a.ibid=b.bid LEFT JOIN customer_tab c ON a.ibcid=c.cid WHERE a.itype=2 AND (a.istatus=1 OR a.istatus=0) AND b.bstatus=1 AND (b.btitle LIKE '%".$keyword."%' OR b.bcode LIKE '%".$keyword."%') AND a.ibcid=".$cid." ORDER BY a.iid DESC";
	}
	
	function __get_opname_inventory_customer_detail($id) {
		$this -> db -> select('* FROM inventory_tab WHERE itype=2 AND (istatus=1 OR istatus=0) AND iid=' . $id);
		return $this -> db -> get() -> result();
	}
    
	function __get_search($keyword,$ctype=1) {
		if ($ctype) $ctype = ' AND a.cbid=' . $ctype;
		return "SELECT a.*,b.bname,d.acode,d.aname FROM customer_tab a LEFT JOIN branch_tab b ON a.cbid=b.bid LEFT JOIN area_tab d ON a.carea=d.aid WHERE (LOWER(a.cname) LIKE '%".$keyword."%' OR LOWER(a.ccode) LIKE '%".$keyword."%') AND b.bstatus=1 AND a.cstatus=1".$ctype." ORDER BY a.cid DESC";
	}
}
