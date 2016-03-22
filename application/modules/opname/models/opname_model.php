<?php
class Opname_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }
	
	function __get_opnameinventory($bid) {
		return 'SELECT a.iid,ibid,a.istockbegining,a.istockin,a.istockout,a.istockreject,a.istockretur,a.istock,a.istatus,b.btitle,b.bcode,c.bname,d.pname FROM inventory_tab a LEFT JOIN books_tab b ON a.ibid=b.bid LEFT JOIN branch_tab c ON a.ibcid=c.bid LEFT JOIN publisher_tab d ON b.bpublisher=d.pid WHERE a.itype=1 AND a.istatus=1 AND a.ibcid='.$bid.' ORDER BY a.iid DESC';
	}
	
	function __get_opnameinventory_detail($id) {
		$this -> db -> select('* FROM inventory_tab WHERE itype=1 AND istatus=1 AND iid=' . $id);
		return $this -> db -> get() -> result();
	}
	
	function __insert_opname($data) {
        return $this -> db -> insert('opname_tab', $data);
	}
	
	function __get_search($keyword,$bid) {
		return 'SELECT a.iid,ibid,a.istockbegining,a.istockin,a.istockout,a.istockreject,a.istockretur,a.istock,a.istatus,b.btitle,b.bcode,c.bname,d.pname FROM inventory_tab a LEFT JOIN books_tab b ON a.ibid=b.bid LEFT JOIN branch_tab c ON a.ibcid=c.bid LEFT JOIN publisher_tab d ON b.bpublisher=d.pid WHERE a.itype=1 AND b.bstatus=1 AND a.ibid IN('.$keyword.') AND a.istatus=1 AND a.ibcid='.$bid.' ORDER BY a.iid DESC';
	}
	
	function __get_stock_adjustment($iid, $branch, $type) {
		if ($type == 1)
			$this -> db -> select('SUM(oadjustplus) as total FROM opname_tab WHERE otype=1 AND oidid='.$iid.' AND obid=' . $branch);
		else
			$this -> db -> select('SUM(oadjustmin) as total FROM opname_tab WHERE otype=1 AND oidid='.$iid.' AND obid=' . $branch);
		return $this -> db -> get() -> result();
	}
	
	function __get_stock_adjustment_hist($iid, $branch) {
		$this -> db -> select('iid FROM niaga_db.inventory_tab WHERE ibid='.$iid.' AND ibcid='.$branch.' AND itype=1 AND istatus=1;');
		$ck = $this -> db -> get() -> result();
		$this -> db -> select("oadjustmin, oadjustplus,from_unixtime(odate,'%Y-%m-%d') as ttanggal, 16 as ttypetrans, 'opname' as tnofaktur, 1 as approved FROM opname_tab WHERE otype=1 AND oidid=".$ck[0] -> iid." AND obid=" . $branch, FALSE);
		return $this -> db -> get() -> result();
	}
	
	function __get_inventory_by_book_id($bid, $bids) {
		return 'SELECT a.iid,a.ibid,a.ibcid,a.istockbegining,a.istockin,a.istockreject,a.istockretur,a.istockout,a.istock,a.ishadow,b.btitle,b.bcode,b.bprice FROM inventory_tab a LEFT JOIN books_tab b ON a.ibid=b.bid WHERE b.bstatus=1 AND a.itype=1 AND a.istatus=1 AND b.bid IN ('.$bids.') AND a.ibcid='.$bid;
	}
	
	function __get_inventory_by_book_idz($bid, $bids) {
		$sql='SELECT a.iid,a.ibid,a.ibcid,a.istockbegining,a.istockin,a.istockreject,a.istockretur,a.istockout,a.istock,a.ishadow,b.btitle,b.bcode,b.bprice FROM inventory_tab a LEFT JOIN books_tab b ON a.ibid=b.bid WHERE b.bstatus=1 AND a.itype=1 AND a.istatus=1 AND b.bid IN ('.$bids.') AND a.ibcid='.$bid;
		$sql = $this -> db -> query($sql);
		return $sql -> result();
	}
	
	function __get_inventory_by_book_id_search($bid, $bids, $keyword) {
		return "SELECT a.iid,a.ibid,a.ibcid,a.istockbegining,a.istockin,a.istockout,a.istockreject,a.istockretur,a.istock,a.ishadow,b.btitle,b.bcode,b.bprice FROM inventory_tab a LEFT JOIN books_tab b ON a.ibid=b.bid WHERE b.bstatus=1 AND a.itype=1 AND a.istatus=1 AND b.bid IN (".$bids.") AND (b.bcode LIKE '%".$keyword."%' OR b.btitle LIKE '%".$keyword."%') AND a.ibcid=".$bid;
	}
}
