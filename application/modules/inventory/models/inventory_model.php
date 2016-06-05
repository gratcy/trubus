<?php
class Inventory_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }
	
	function __get_inventory($bid="") {
		if ($bid != "") $bid = " AND a.ibcid=" . $bid;
		else $bid = "";
		return 'SELECT a.iid,a.ibid,a.ibcid,a.istockbegining,a.istockin,a.istockout,a.istockretur,a.istockreject,a.istock,a.ishadow,a.istatus,b.btitle,b.bcode,b.bprice,c.bname,d.pname FROM inventory_tab a LEFT JOIN books_tab b ON a.ibid=b.bid LEFT JOIN branch_tab c ON a.ibcid=c.bid LEFT JOIN publisher_tab d ON b.bpublisher=d.pid WHERE b.bstatus=1 AND a.itype=1 AND a.istatus=1 '.$bid.' ORDER BY a.iid DESC';
	}

	function __get_inventoryxx($bid="") {
		if ($bid != "") $bid = " AND a.ibcid=" . $bid;
		else $bid = "";
		$this -> db -> select(' a.iid,a.ibid,a.ibcid,a.istockbegining,a.istockin,a.istockout,a.istockretur,a.istockreject,a.istock,a.ishadow,a.istatus,b.btitle,b.bcode,b.bprice,c.bname,d.pname FROM inventory_tab a LEFT JOIN books_tab b ON a.ibid=b.bid LEFT JOIN branch_tab c ON a.ibcid=c.bid LEFT JOIN publisher_tab d ON b.bpublisher=d.pid WHERE b.bstatus=1 AND a.itype=1 AND a.istatus=1 '.$bid.' ORDER BY a.iid DESC');
		return $this -> db -> get() -> result();

	}
	
	function __get_inventory_export($bid="") {
		if ($bid != "") $bid = " AND a.ibcid=" . $bid;
		else $bid = "";
		$this -> db -> select('a.iid,a.ibid,a.ibcid,a.istockbegining,a.istockin,a.istockout,a.istockretur,a.istockreject,a.istock,a.ishadow,a.istatus,b.btitle,b.bcode,b.bprice,c.bname FROM inventory_tab a LEFT JOIN books_tab b ON a.ibid=b.bid LEFT JOIN branch_tab c ON a.ibcid=c.bid LEFT JOIN publisher_tab d ON b.bpublisher=d.pid WHERE b.bstatus=1 AND a.itype=1 AND a.istatus=1 '.$bid.' ORDER BY a.iid DESC');
		return $this -> db -> get() -> result();
	}
	
	function __get_search($book,$bid="") {
		if ($bid != "") $bid = " AND a.ibcid=" . $bid;
		else $bid = "";
		return 'SELECT a.ishadow,a.iid,a.ibid,a.ibcid,a.istockbegining,a.istockin,a.istockout,a.istockretur,a.istockreject,a.istock,a.istatus,b.btitle,b.bcode,b.bprice,c.bname,d.pname FROM inventory_tab a LEFT JOIN books_tab b ON a.ibid=b.bid LEFT JOIN branch_tab c ON a.ibcid=c.bid LEFT JOIN publisher_tab d ON b.bpublisher=d.pid WHERE a.ibid IN('.$book.') AND b.bstatus=1 AND a.itype=1 AND a.istatus=1 '.$bid.' ORDER BY a.iid DESC';
	}

	function __get_inventory_customer_by_book($id_book) {
		$this -> db -> select('* FROM inventory_tab,customer_tab WHERE inventory_tab.ibcid=customer_tab.cid AND itype=2 AND (istatus=1 OR istatus=0) AND ibid=' . $id_book);
		return $this -> db -> get() -> result();
	}	
	
	function __get_book($id){
		$this -> db -> select('* FROM books_tab WHERE bid=' . $id);
		return $this -> db -> get() -> result();
	}
	
	function __get_stock_begining($id,$cid) {
		$this -> db -> select('istockbegining FROM inventory_tab WHERE itype=1 AND (istatus=1 OR istatus=0) AND ibcid='.$cid.' AND ibid=' . $id);
		return $this -> db -> get() -> result();
	}
	
	function __get_inventory_detail($id) {
		$this -> db -> select('* FROM inventory_tab WHERE itype=1 AND (istatus=1 OR istatus=0) AND iid=' . $id);
		return $this -> db -> get() -> result();
	}
	
	function __get_inventory_detailx($id,$cid,$isdone=true, $returPem=false) {
		if ($isdone) $approved = 'a.approval=2';
		else $approved = 'a.approval<2 AND b.approval<2';
		
		if ($isdone) $fapproved = ', 1 as approved';
		else $fapproved = ', 0 as approved';
		if ($returPem == true)
			$this -> db -> select("a.*,b.*,c.pname as cname".$fapproved." FROM transaction_tab a LEFT JOIN transaction_detail_tab b ON a.tid=b.ttid LEFT JOIN publisher_tab c ON a.tpid=c.pid WHERE a.ttype=3 AND a.ttypetrans=4 AND b.tstatus=1 AND ".$approved." AND a.tstatus=1 AND a.tbid=".$cid." and b.tbid=".$id, FALSE);
		else
			$this -> db -> select("a.*,b.*,c.cname".$fapproved." FROM transaction_tab a LEFT JOIN transaction_detail_tab b ON a.tid=b.ttid LEFT JOIN customer_tab c ON a.tcid=c.cid WHERE (a.tnofaktur NOT LIKE 'HP%' AND a.tnofaktur NOT LIKE 'RHP%' AND a.tnofaktur NOT LIKE 'PO%' AND a.tnofaktur!='' AND a.tnofaktur NOT LIKE 'RB%') AND b.tstatus=1 AND ".$approved." AND a.tstatus=1 AND a.tbid=".$cid." and b.tbid=".$id, FALSE);
		return $this -> db -> get() -> result();
	}
	
	function __insert_inventory($data) {
        return $this -> db -> insert('inventory_tab', $data);
	}
	
	function __update_inventory($id, $data) {
        $this -> db -> where('iid', $id);
        return $this -> db -> update('inventory_tab', $data);
	}
	
	function __delete_inventory($id) {
		return $this -> db -> query('update inventory_tab set istatus=2 where itype=1 AND iid=' . $id);
	}
	
	function __get_stock_process($bcid,$bid) {
		$this -> db -> select("sum(b.tqty) as total from transaction_tab a LEFT JOIN transaction_detail_tab b ON a.tid=b.ttid where (a.tnofaktur LIKE 'JK%' OR a.tnofaktur LIKE 'JC%' OR a.tnofaktur LIKE 'RB%') AND a.tbid=".$bcid." AND a.approval<2 AND b.approval<2 AND a.tstatus=1 AND b.tstatus=1 AND b.tbid=" . $bid);
		$tr = $this -> db -> get() -> result();
		
		$this -> db -> select("sum(b.tqty) as total from transaction_tab a LEFT JOIN transaction_detail_tab b ON a.tid=b.ttid where a.ttype='3' AND a.ttypetrans='4' AND a.tbid=".$bcid." AND a.approval<2 AND b.approval<2 AND a.tstatus=1 AND b.tstatus=1 AND b.tbid=" . $bid);
		$tr7 = $this -> db -> get() -> result();
		
		$this -> db -> select("SUM(c.dqty) as total FROM distribution_tab a LEFT JOIN distribution_request_tab b ON a.ddrid=b.did LEFT JOIN distribution_book_tab c ON a.ddrid=c.ddrid WHERE a.dtype=2 AND b.dbto=".$bcid." AND a.dstatus=3 AND b.dstatus=3 AND c.dstatus=1 AND c.dbid=" . $bid);
		$tr2 = $this -> db -> get() -> result();
		
		//$this -> db -> select("SUM(c.dqty) as total FROM distribution_tab a LEFT JOIN distribution_request_tab b ON a.ddrid=b.did LEFT JOIN distribution_book_tab c ON a.ddrid=c.ddrid WHERE a.dtype=2 AND b.dbfrom=".$bcid." AND a.dstatus=3 AND b.dstatus=3 AND c.dstatus=1 AND c.dbid=" . $bid);
		//$tr4 = $this -> db -> get() -> result();


		$this -> db -> select("SUM(c.dqty) as total FROM distribution_tab a LEFT JOIN distribution_request_tab b ON a.ddrid=b.did LEFT JOIN distribution_book_tab c ON a.ddrid=c.ddrid WHERE a.dtype=1 AND b.dbto=".$bcid." AND a.dstatus=3 AND b.dstatus=3 AND c.dstatus=1 AND c.dbid=" . $bid);
		$tr4 = $this -> db -> get() -> result();
	
		
		$this -> db -> select("sum(b.tqty) as total from transaction_tab a LEFT JOIN transaction_detail_tab b ON a.tid=b.ttid where (a.tnofaktur LIKE 'RJK%' OR a.tnofaktur LIKE 'RJC%') AND a.tbid=".$bcid." AND a.approval<2 AND b.approval<2 AND a.tstatus != 2 AND b.tstatus != 2 AND b.tbid=" . $bid);
		$tr3 = $this -> db -> get() -> result();
		
		$this -> db -> select("SUM(c.dqty) as total FROM distribution_tab a LEFT JOIN distribution_request_tab b ON a.ddrid=b.did LEFT JOIN distribution_book_tab c ON a.ddrid=c.ddrid WHERE a.dtype=1 AND b.dbto=".$bcid." AND a.dstatus=3 AND b.dstatus=3 AND c.dstatus=1 AND c.dbid=" . $bid);
		$tr5 = $this -> db -> get() -> result();
		
		//~ $this -> db -> select("SUM(c.dqty) as total FROM distribution_tab a LEFT JOIN distribution_request_tab b ON a.ddrid=b.did LEFT JOIN distribution_book_tab c ON a.ddrid=c.ddrid WHERE a.dtype=1 AND b.dbfrom=".$bcid." AND a.dstatus=3 AND b.dstatus=3 AND c.dstatus=1 AND c.dbid=" . $bid);
		//~ $tr3 = $this -> db -> get() -> result();
		
		$this -> db -> select("SUM(b.rqty) as total FROM receiving_tab a LEFT JOIN receiving_books_tab b ON a.rid=b.rrid WHERE a.rstatus=1 AND b.rstatus=1 AND a.rbid=$bcid AND b.rbid=" . $bid);
		$tr6 = $this -> db -> get() -> result();
		
		$out = $tr[0] -> total + $tr4[0] -> total + $tr7[0] -> total;
		$in = $tr3[0] -> total + $tr6[0] -> total;
		
		return $out-$in;
	}
}
