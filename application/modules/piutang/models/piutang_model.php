<?php
class piutang_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }
    
    function __get_piutang_select() {
		$this -> db -> select(" tnofaktur, tbid,tcid,tsbayar,tstatus,approval FROM transaction_tab WHERE  approval=2 AND tstatus<>2 AND tnofaktur LIKE'JC%' OR tnofaktur LIKE'HP%' GROUP BY tcid");
		return $this -> db -> get() -> result();
	}
	
	function __get_piutang_search_cust($keyword) {
		$branchid=$this -> memcachedlib -> sesresult['ubranchid'];

		return "SELECT   tid,ttanggal,tongkos,tbid,tcid,tsbayar,tstatus,approval,cname,carea,aid,aname,tinvid, 
		SUM(tgrandtotal) AS tg
		FROM transaction_tab, customer_tab,area_tab WHERE  approval=2 AND tstatus<>2 
		AND (tnofaktur LIKE 'JC%' OR tnofaktur LIKE'HP%') 	
		AND cid=tcid AND carea=aid  AND (tsbayar <'3' OR tsbayar IS NULL) AND tbid='$branchid' AND (cname LIKE '%$keyword%')	GROUP BY tcid ";
	}	
	
	function __get_piutang_search_faktur($keyword) {
		$branchid=$this -> memcachedlib -> sesresult['ubranchid'];

		return "SELECT   tid,tongkos,ttanggal,tbid,tcid,tsbayar,tstatus,approval,cname,carea,aid,aname,tinvid, 
		SUM(tgrandtotal) AS tg
		FROM transaction_tab, customer_tab,area_tab WHERE  approval=2 AND tstatus<>2 
		AND (tnofaktur LIKE 'JC%' OR tnofaktur LIKE'HP%') 	
		AND cid=tcid AND carea=aid  AND (tsbayar <'3' OR tsbayar IS NULL) AND tbid='$branchid' AND (tnofaktur LIKE '%$keyword%' OR cname LIKE '%$keyword%')	GROUP BY tcid ";
	}
	function __get_piutang_area() {
		$branchid=$this -> memcachedlib -> sesresult['ubranchid'];
		return "SELECT   tbid,tongkos,tcid,tsbayar,tstatus,approval,cname,carea,aid,aname,tinvid, 
		SUM(tgrandtotal) AS tg
		FROM transaction_tab, customer_tab,area_tab WHERE  approval=2 AND tstatus<>2 
		AND (tnofaktur LIKE'JC%' OR tnofaktur LIKE'HP%') 	
		AND cid=tcid AND carea=aid AND tsbayar IS NULL AND tbid='$branchid' GROUP BY aid";
	}
	
	function __get_piutang_cust() {
		$branchid=$this -> memcachedlib -> sesresult['ubranchid'];
		return "SELECT   tid,ttanggal,tongkos,tbid,tcid,tsbayar,tstatus,approval,cname,carea,aid,aname,tinvid, 
		SUM(tgrandtotal) AS tg
		FROM transaction_tab, customer_tab,area_tab WHERE  approval=2 AND tstatus<>2 
		AND (tnofaktur LIKE'JC%' OR tnofaktur LIKE'HP%') 	
		AND cid=tcid AND carea=aid AND tsbayar IS NULL AND tbid='$branchid' GROUP BY tcid";
	}	

	
	function __get_piutang_cust_lunas() {
		$branchid=$this -> memcachedlib -> sesresult['ubranchid'];
			return "SELECT   tid,ttanggal,tongkos,tbid,tcid,tsbayar,tstatus,approval,cname,carea,aid,aname,tinvid, 
			SUM(tgrandtotal) AS tg
			FROM transaction_tab, customer_tab,area_tab,invoice_tab WHERE  approval=2 AND tstatus<>2 
			AND (tnofaktur LIKE'JC%' OR tnofaktur LIKE'HP%') 	
			AND cid=tcid AND carea=aid   AND tinvid=invid 
			AND tbid='$branchid' GROUP BY tcid order by ttanggal DESC";
	}	
	
	function __get_piutang_cust_lunasx() {
		$branchid=$this -> memcachedlib -> sesresult['ubranchid'];
		$this -> db -> select("   tid,ttanggal,tbid,tcid,tongkos,tsbayar,tstatus,approval,cname,carea,aid,aname,tinvid, 
		SUM(tgrandtotal) AS tg
		FROM transaction_tab, customer_tab,area_tab,invoice_tab WHERE  approval=2 AND tstatus<>2 
		AND (tnofaktur LIKE'JC%' OR tnofaktur LIKE'HP%') 	
		AND cid=tcid AND carea=aid  AND tsbayar ='3' AND tinvid=invid 
		AND invstatus='3'	AND tbid='$branchid' GROUP BY tcid order by ttanggal DESC");
		return $this -> db -> get() -> result();
	}		
	
	function __get_piutang_cust_all() {
		$branchid=$this -> memcachedlib -> sesresult['ubranchid'];
		return "SELECT   tid,ttanggal,tongkos,tbid,tcid,tsbayar,tstatus,approval,cname,carea,aid,aname,tinvid, 
		SUM(tgrandtotal) AS tg
		FROM transaction_tab, customer_tab,area_tab WHERE  approval=2 AND tstatus<>2 
		AND (tnofaktur LIKE'JC%' OR tnofaktur LIKE'HP%') 	
		AND cid=tcid AND carea=aid  AND (tsbayar <'3' OR tsbayar IS NULL) AND tbid='$branchid' GROUP BY tcid ";
	}	
	
	function __get_piutang_cust_allx() {
		$branchid=$this -> memcachedlib -> sesresult['ubranchid'];
		$this -> db -> select("   tid,ttanggal,tongkos,tbid,tcid,tsbayar,tstatus,approval,cname,carea,aid,aname,tinvid, 
		SUM(tgrandtotal) AS tg
		FROM transaction_tab, customer_tab,area_tab WHERE  approval=2 AND tstatus<>2 
		AND (tnofaktur LIKE'JC%' OR tnofaktur LIKE'HP%') 		
		AND cid=tcid AND carea=aid AND (tsbayar <'3' OR tsbayar IS NULL) AND tbid='$branchid' GROUP BY tcid");
		return $this -> db -> get() -> result();
	}
	
	function __get_piutang_custx() {
		$branchid=$this -> memcachedlib -> sesresult['ubranchid'];
		$this -> db -> select("   tid,ttanggal,tbid,tongkos,tcid,tsbayar,tstatus,approval,cname,carea,aid,aname,tinvid, 
		SUM(tgrandtotal) AS tg
		FROM transaction_tab, customer_tab,area_tab WHERE  approval=2 AND tstatus<>2 
		AND (tnofaktur LIKE'JC%' OR tnofaktur LIKE'HP%') AND tinvid IS NULL		
		AND cid=tcid AND carea=aid AND tsbayar IS NULL AND tbid='$branchid' GROUP BY tcid");
		return $this -> db -> get() -> result();
	}
	
	function __get_piutang_custy() {
		$branchid=$this -> memcachedlib -> sesresult['ubranchid'];
		$this -> db -> select("   tid,ttanggal,tbid,tcid,tongkos,tsbayar,tstatus,approval,cname,carea,aid,aname,tinvid, 
		SUM(tgrandtotal) AS tg
		FROM transaction_tab, customer_tab,area_tab,invoice_tab WHERE  approval=2 AND tstatus<>2 
		AND (tnofaktur LIKE'JC%' OR tnofaktur LIKE'HP%') AND tinvid =invid		
		AND cid=tcid AND carea=aid AND tsbayar ='1'  AND tbid='$branchid' GROUP BY tcid");
		return $this -> db -> get() -> result();
	}	

	function __get_piutang_custz() {
		$branchid=$this -> memcachedlib -> sesresult['ubranchid'];
		$this -> db -> select("   tid,ttanggal,tbid,tongkos,tcid,tsbayar,tstatus,approval,cname,carea,aid,aname,tinvid, 
		SUM(tgrandtotal) AS tg
		FROM transaction_tab, customer_tab,area_tab,invoice_tab WHERE  approval=2 AND tstatus<>2 
		AND (tnofaktur LIKE'JC%' OR tnofaktur LIKE'HP%') AND tinvid =invid		
		AND cid=tcid AND carea=aid AND tbid='$branchid' GROUP BY tcid");
		return $this -> db -> get() -> result();
	}

	
	function __get_piutang_faktur() {
		$branchid=$this -> memcachedlib -> sesresult['ubranchid'];
		$this -> db -> select("   tid,ttanggal,tongkos,tnofaktur,tbid,tcid,tsbayar,tstatus,approval,cname,carea,aid,aname,tinvid,tgrandtotal AS tg, (SELECT DATEDIFF(CURDATE(), ttanggal ) 
		FROM transaction_tab b WHERE b.tid=transaction_tab.tid)AS jdate
		FROM transaction_tab , customer_tab,area_tab WHERE  approval=2 AND tstatus<>2 
		AND (tnofaktur LIKE'JC%' OR tnofaktur LIKE'HP%') 		
		AND cid=tcid AND carea=aid AND tsbayar IS NULL AND tbid='$branchid' order by tcid asc");
		return $this -> db -> get() -> result();
	}	
	function __get_piutang_faktursr($keyword) {
		$branchid=$this -> memcachedlib -> sesresult['ubranchid'];
		$this -> db -> select("   tid,ttanggal,tongkos,tnofaktur,tbid,tcid,tsbayar,tstatus,approval,cname,carea,aid,aname,
		tinvid,tgrandtotal AS tg, (SELECT DATEDIFF(CURDATE(), ttanggal ) 
		FROM transaction_tab b WHERE b.tid=transaction_tab.tid)AS jdate
		FROM transaction_tab , customer_tab,area_tab WHERE  approval=2 AND tstatus<>2 
		AND (tnofaktur LIKE'JC%' OR tnofaktur LIKE'HP%') 		
		AND cid=tcid AND carea=aid AND tsbayar IS NULL AND tbid='$branchid' 
		AND (tnofaktur LIKE '%$keyword%' OR cname LIKE '%$keyword%')		
		order by tcid asc");
		
		/*echo " select  tid,ttanggal,tnofaktur,tbid,tcid,tsbayar,tstatus,approval,cname,carea,aid,aname,
		tinvid,tgrandtotal AS tg, (SELECT DATEDIFF(CURDATE(), ttanggal ) 
		FROM transaction_tab b WHERE b.tid=transaction_tab.tid)AS jdate
		FROM transaction_tab , customer_tab,area_tab WHERE  approval=2 AND tstatus<>2 
		AND (tnofaktur LIKE'JC%' OR tnofaktur LIKE'HP%') 		
		AND cid=tcid AND carea=aid AND tsbayar IS NULL AND tbid='$branchid' 
		AND (tnofaktur LIKE '%$keyword%' OR cname LIKE '%$keyword%')		
		order by tcid asc";
		*///die;
		return $this -> db -> get() -> result();
	}	
	
	
	function __get_sum_byfaktur($pbcid,$tnofaktur){
		$this -> db -> SELECT ("SUM(pbsetor) FROM pembayaran_tab WHERE pbstatus='3' 
		AND pbcid='$pbcid' AND info='$tnofaktur' GROUP BY info");
		return $this -> db -> get() -> result();
	}
	
	function __get_piutang_invoice() {
		$branchid=$this -> memcachedlib -> sesresult['ubranchid'];
		$this -> db -> select("tid,ttanggal,tongkos,tnofaktur,tbid,tcid,tsbayar,tstatus,approval,cname,carea,
		aid,aname,tinvid,tgrandtotal AS tg,(SELECT DATEDIFF(CURDATE(), ttanggal ) 
		FROM transaction_tab b WHERE b.tid=transaction_tab.tid)AS jdate
		FROM transaction_tab , customer_tab,area_tab,invoice_tab WHERE  approval=2 AND tstatus<>2 AND (tnofaktur LIKE'JC%' OR tnofaktur LIKE'HP%') 		
		AND cid=tcid AND carea=aid AND tsbayar ='1' AND tbid='$branchid'
		AND invid=tinvid AND invstatus='1' 
		ORDER BY tcid ASC");
		return $this -> db -> get() -> result();
	}

	function __get_piutang_invoicesr($keyword) {
		$branchid=$this -> memcachedlib -> sesresult['ubranchid'];
		$this -> db -> select("tid,ttanggal,tongkos,tnofaktur,tbid,tcid,tsbayar,tstatus,approval,cname,carea,
		aid,aname,tinvid,tgrandtotal AS tg,(SELECT DATEDIFF(CURDATE(), ttanggal ) 
		FROM transaction_tab b WHERE b.tid=transaction_tab.tid)AS jdate
		FROM transaction_tab , customer_tab,area_tab,invoice_tab WHERE  approval=2 AND tstatus<>2 AND (tnofaktur LIKE'JC%' OR tnofaktur LIKE'HP%') 		
		AND cid=tcid AND carea=aid AND tsbayar ='1' AND tbid='$branchid'
		AND invid=tinvid AND invstatus='1' AND (tnofaktur LIKE '%$keyword%' OR cname LIKE '%$keyword%')
		ORDER BY tcid ASC");
		return $this -> db -> get() -> result();
	}	
	
	function __get_faktur_lunas() {
		$branchid=$this -> memcachedlib -> sesresult['ubranchid'];
		$this -> db -> select("tid,ttanggal,tongkos,tnofaktur,tbid,tcid,tsbayar,tstatus,approval,cname,carea,
		aid,aname,tinvid,tgrandtotal AS tg,(SELECT DATEDIFF(CURDATE(), ttanggal ) 
		FROM transaction_tab b WHERE b.tid=transaction_tab.tid)AS jdate
		FROM transaction_tab , customer_tab,area_tab,invoice_tab WHERE  approval=2 AND tstatus<>2 AND (tnofaktur LIKE'JC%' OR tnofaktur LIKE'HP%') 		
		AND cid=tcid AND carea=aid  AND tbid='$branchid'
		AND invid=tinvid  ORDER BY ttanggal DESC");
		return $this -> db -> get() -> result();
	}	

	
	
	function __get_piutang_cust_id($aid) {
		$branchid=$this -> memcachedlib -> sesresult['ubranchid'];
		return "SELECT   tbid,tcid,tongkos,tsbayar,tstatus,approval,cname,carea,aid,aname,tinvid, 
		SUM(tgrandtotal) AS tg
		FROM transaction_tab, customer_tab,area_tab WHERE  approval=2 AND tstatus<>2 
		AND (tnofaktur LIKE'JC%' OR tnofaktur LIKE'HP%') AND tinvid IS NULL		
		AND cid=tcid AND carea=aid AND aid='$aid' AND tsbayar IS NULL AND tbid='$branchid' GROUP BY tcid";
	}	
	function __get_inv_area() {
		$branchid=$this -> memcachedlib -> sesresult['ubranchid'];
		return "SELECT   tbid,tcid,tsbayar,tongkos,tstatus,approval,cname,carea,aid,aname,tinvid, 
		SUM(tgrandtotal) AS tg,(select invstatus from invoice_tab where tinvid=invid) as istatus
		FROM transaction_tab, customer_tab,area_tab WHERE  approval=2 AND tstatus<>2 
		AND (tnofaktur LIKE'JC%' OR tnofaktur LIKE'HP%') AND tinvid IS NOT NULL		
		AND cid=tcid AND carea=aid  AND tbid='$branchid' GROUP BY aid";
	}

	function __get_inv_cust() {
		$branchid=$this -> memcachedlib -> sesresult['ubranchid'];
		return "SELECT   tbid,tcid,tsbayar,tongkos,tstatus,approval,cname,carea,aid,aname,tinvid, 
		SUM(tgrandtotal) AS tg,(select invstatus from invoice_tab where tinvid=invid) as istatus
		FROM transaction_tab, customer_tab,area_tab WHERE  approval=2 AND tstatus<>2 
		AND (tnofaktur LIKE'JC%' OR tnofaktur LIKE'HP%') AND tinvid IS NOT NULL		
		AND cid=tcid AND carea=aid  AND tbid='$branchid' GROUP BY tcid";
	}	

	function __get_inv_cust_id($aid) {
		$branchid=$this -> memcachedlib -> sesresult['ubranchid'];
		return "SELECT   tbid,tcid,tsbayar,tongkos,tstatus,approval,cname,carea,aid,aname,tinvid, 
		SUM(tgrandtotal) AS tg,(select invstatus from invoice_tab where tinvid=invid) as istatus
		FROM transaction_tab, customer_tab,area_tab WHERE  approval=2 AND tstatus<>2 
		AND (tnofaktur LIKE'JC%' OR tnofaktur LIKE'HP%') AND tinvid >0		
		AND cid=tcid AND carea=aid AND aid='$aid' AND tsbayar >0 AND tbid='$branchid' GROUP BY tcid";
	}
	
	function __update_piutang($id, $data) {
        $this -> db -> where('invid', $id);
        return $this -> db -> update('invoice_tab', $data);
	}
	
	function __delete_piutang($id) {
		return $this -> db -> query('update invoice_tab set invstatus=2 where invid=' . $id);
	}
}
