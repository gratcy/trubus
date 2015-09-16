<?php
class Reportcardstock_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }
	
	function __get_transaction_ids($branch,$date,$customer,$type) {
		if ($customer && count($customer) > 0) $dcustomer = " AND a.tcid IN(".implode(',',$customer).")";
		else $dcustomer = "";
		if ($date && count($date) > 1) $ddate = " AND (a.ttanggal BETWEEN '".date('Y-m-d',strtotime($date[0]))."' AND '".date('Y-m-d',strtotime($date[1]))."')";
		else $ddate = "";

		if (array_search(0,$type) !== false) {
			$this -> db -> select("a.tid FROM transaction_tab a WHERE a.tbid=".$branch."$dcustomer$ddate AND ((a.ttype=2 AND a.ttypetrans=1) OR (a.ttype=2 AND a.ttypetrans=2) OR (a.ttype=2 AND a.ttypetrans=4)) AND a.tstatus !=2", FALSE);
		}
		else {
			$konsinyasi = "";
			$credit = "";
			$retur = "";
			
			if (array_search(1,$type) !== false) $credit = " OR (a.ttype=2 AND a.ttypetrans=2)";
			if (array_search(2,$type) !== false) $konsinyasi = " OR (a.ttype=2 AND a.ttypetrans=1)";
			if (array_search(3,$type) !== false) $retur = " OR (a.ttype=2 AND a.ttypetrans=4 OR a.ttype=2 AND a.ttypetrans=4 OR a.ttype=1 AND a.ttypetrans=4 OR a.ttype=1 AND a.ttypetrans=3 OR a.ttype=3 AND a.ttypetrans=4)";
			
			$jenis = $konsinyasi . $credit . $retur;
			$jenis = substr($jenis, 4);
			$this -> db -> select("a.tid FROM transaction_tab a WHERE a.tbid=".$branch."$dcustomer$ddate AND (".$jenis.") AND a.tstatus !=2", FALSE);
		}
		return $this -> db -> get() -> result();
	}
	
	function __get_transaction_details_bookid($ids,$pub) {
		$ids = implode(',',$ids);
		if (is_array($pub) && count($pub) > 0)
			$this -> db -> select("a.ttid,a.tbid FROM transaction_detail_tab a LEFT JOIN books_tab b ON a.tbid=b.bid WHERE b.bpublisher IN (".implode(',',$pub).") AND a.tstatus=1 AND a.ttid IN (".$ids.")", FALSE);
		else
			$this -> db -> select("ttid,tbid FROM transaction_detail_tab WHERE tstatus=1 AND ttid IN (".$ids.")", FALSE);
		return $this -> db -> get() -> result();
	}
	
	function __get_inventory_list($ids,$bid) {
		$ids = implode(',',$ids);
		$this -> db -> select("a.ttanggal,a.tnofaktur,a.ttypetrans,b.tqty,c.cname FROM transaction_tab a LEFT JOIN transaction_detail_tab b ON a.tid=b.ttid LEFT JOIN customer_tab c ON a.tcid=c.cid WHERE a.tid IN($ids) AND b.tbid=" . $bid, FALSE);
		return $this -> db -> get() -> result();
	}
}
