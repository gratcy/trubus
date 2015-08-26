<?php
class Reportingstock_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }
	function __get_transaction_idx($branch,$approval,$type,$datesorta,$datesortb,$customer,$customerr,$kode_buku,$kode_bukux,$area,$areax,$publisher,$publisherx,
	$typea,$typeb,$typec,$typed,$typee,$typef,$typeg,$typeh,$typei){
	
	//echo "$typea,$typeb,$typec,$typed,$typee,$typef,$typeg,$typeh,$typei";
	
		if($typea=='ALL'){
			$tpa="";
		}else{
			$tpa="";
		}
		if($typeb=='JC'){
			$tpb="OR a.tnofaktur LIKE 'JC%'";
		}else{
			$tpb="";
		}	
		if($typec=='JK'){
			$tpc="OR a.tnofaktur LIKE 'JK%'";
		}else{
			$tpc="";
		}	
		if($typed=='HP'){
			$tpd="OR a.tnofaktur LIKE 'HP%'";
		}else{
			$tpd="";
		}
		if($typee=='RJC'){
			$tpe="OR a.tnofaktur LIKE 'RJC%'";
		}else{
			$tpe="";
		}
		if($typef=='RJK'){
			$tpf="OR a.tnofaktur LIKE 'RJK%'";
		}else{
			$tpf="";
		}
		if($typeg=='RHP'){
			$tpg="OR a.tnofaktur LIKE 'RHP%'";
		}else{
			$tpg="";
		}	
		if($typeh=='BK'){
			$tph="OR a.tnofaktur LIKE 'BK%'";
		}else{
			$tph="";
		}	
		if($typei=='RB'){
			$tpi="OR a.tnofaktur LIKE 'RB%'";
		}else{
			$tpi="";
		}		
if(($tpa=="")AND($tpb=="")AND($tpc=="")AND($tpd=="")AND($tpe=="")AND($tpf=="")AND($tpg=="")
	AND($tph=="")AND($tpi=="")){
	$tpx="";
	
}else{
	//$tpx="";
	$tpx=" AND (a.tnofaktur ='' ".$tpb.$tpc.$tpd.$tpe.$tpf.$tpg.$tph.$tpi .")";
}
	
	//echo $tpx.'xx';die;	
		if($approval=='2'){
			$appr="AND a.approval ='2'";
		}else{
			$appr="AND a.approval !='2'";
		}

		if(($kode_buku=='')OR($kode_bukux=='')){
			$kb="";
		}else{
			$kb=" AND b.tbid between '$kode_buku' AND '$kode_bukux' ";
		}		

		if(($customer=='')OR($customerr=='')){
			$cus="";
		}else{
			$cus=" AND (a.tcid  between '".$customer."'  AND '".$customerr."') ";
		}

		if(($area=='')OR($areax=='')){
			$areaz="";
			$narea="(select aname from area_tab f where f.aid=c.carea) AS narea,";
		}else{
			$areaz=" AND (c.carea  between '".$area."'  AND '".$areax."') ";
			$narea="(select aname from area_tab f where f.aid=c.carea) AS narea, ";
		}		

		if(($publisher=='')OR($publisherx=='')){
			$pubz="";
			$spub="(select pname from publisher_tab e where e.pid=d.bpublisher) AS pname,";
		}else{
			$pubz=" AND (d.bpublisher  between '".$publisher."'  AND '".$publisherx."') ";
			$spub="(select pname from publisher_tab e where e.pid=d.bpublisher) AS pname, ";
		}			
		 
		  $qur= "a.ttanggal,a.tnofaktur,b.tid,b.ttid, $spub $narea b.tqty,b.tbid AS buku ,a.tcid AS customer, a.tbid AS branch,d.bpublisher,c.carea,c.cname,d.btitle,d.bprice FROM transaction_tab a,transaction_detail_tab b,customer_tab c,books_tab d WHERE a.tbid='".$branch."' AND (a.ttanggal BETWEEN '".date('Y-m-d',strtotime($datesorta))."' AND '".date('Y-m-d',strtotime($datesortb))."')".$appr ." AND a.tstatus !=2  AND a.tid=b.ttid AND a.tcid=c.cid AND b.tbid=d.bid".$kb.$cus.$areaz.$pubz.$tpx;
		  
		  // echo $qur;
		  // die;
		 
		//$this -> db -> select($qur , FALSE);	
		$this -> db -> select("a.ttanggal,d.bcode,c.ccode,b.ttharga,b.tdisc,b.ttotal,a.tnofaktur,b.tid,b.ttid, $spub $narea b.tqty,b.tbid AS buku ,a.tcid AS customer, a.tbid AS branch,d.bpublisher,c.carea,c.cname,d.btitle,d.bprice FROM transaction_tab a,transaction_detail_tab b,customer_tab c,books_tab d WHERE a.tbid='".$branch."' AND (a.ttanggal BETWEEN '".date('Y-m-d',strtotime($datesorta))."' AND '".date('Y-m-d',strtotime($datesortb))."')".$appr ." AND a.tstatus !=2  AND a.tid=b.ttid AND a.tcid=c.cid AND b.tbid=d.bid".$kb.$cus.$areaz.$pubz.$tpx , FALSE);		
		return $this -> db -> get() -> result();		
		
	}
	function __get_transaction_ids($branchid,$date,$customer,$type) {
		if ($customer && count($customer) > 0)
		$dcustomer = " AND a.tcid IN(".implode(',',$customer).")";
		else
		$dcustomer = "";
		if ($date && count($date) > 1)
		$ddate = " AND (a.ttanggal BETWEEN '".date('Y-m-d',strtotime($date[0]))."' AND '".date('Y-m-d',strtotime($date[1]))."')";
		else
		$ddate = "";
		//~ $this -> db -> select("a.tid,a.ttanggal,a.tnofaktur,b.cname FROM transaction_tab a LEFT JOIN customer_tab b ON a.tcid=b.cid WHERE a.tbid=".$branch." AND a.tcid IN(".$customer.") AND (a.ttanggal BETWEEN '".date('Y-m-d',strtotime($date[0]))."' AND '".date('Y-m-d',strtotime($date[1]))."') AND a.tstatus !=2", FALSE);
		if (array_search(0,$type) !== false) {
			$this -> db -> select("a.tid FROM transaction_tab a WHERE a.tbid=".$branch."$dcustomer$ddate AND ((a.ttype='2' AND a.ttypetrans='1') OR (a.ttype='2' AND a.ttypetrans='2') OR (a.ttype='2' AND a.ttypetrans='4')) AND a.tstatus !=2", FALSE);
		}
		else {
			$konsinyasi = "";
			$credit = "";
			$retur = "";
			if (array_search(1,$type) !== false)
			$credit = " OR (a.ttype=2 AND a.ttypetrans=2)";
			if (array_search(2,$type) !== false)
			$konsinyasi = " OR (a.ttype=2 AND a.ttypetrans=1)";
			if (array_search(3,$type) !== false)
			$retur = " OR (a.ttype=2 AND a.ttypetrans=4)";
			
			$jenis = $konsinyasi . $credit . $retur;
			$jenis = substr($jenis, 4);
			$this -> db -> select("a.tid FROM transaction_tab a WHERE a.tbid=".$branch."$dcustomer$ddate AND (a.ttanggal BETWEEN '".date('Y-m-d',strtotime($date[0]))."' AND '".date('Y-m-d',strtotime($date[1]))."') AND (".$jenis.") AND a.tstatus !=2", FALSE);
		}
		return $this -> db -> get() -> result();
	}
	
	function __get_transaction_details_bookid($ids,$pub) {
		$ids = implode(',',$ids);
		if (is_array($pub) && count($pub) > 0)
			$this -> db -> select("a.ttid,a.tbid FROM transaction_detail_tab a LEFT JOIN books_tab b ON a.tbid=b.bid WHERE b.bpublisher IN (".implode(',',$pub).") AND a.tstatus=1 AND a.ttid IN (".$ids.")", FALSE);
		else
			$this -> db -> select("a.ttid,a.tbid FROM transaction_detail_tab a WHERE a.tstatus=1 AND a.ttid IN (".$ids.")", FALSE);
		return $this -> db -> get() -> result();
	}
	
	function __get_inventory_list($ids,$bid) {
		$ids = implode(',',$ids);
		$this -> db -> select("a.ttanggal,a.tnofaktur,a.ttypetrans,b.tqty,c.cname FROM transaction_tab a LEFT JOIN transaction_detail_tab b ON a.tid=b.ttid LEFT JOIN customer_tab c ON a.tcid=c.cid WHERE a.tid IN($ids) AND b.tbid=" . $bid, FALSE);
		return $this -> db -> get() -> result();
	}
}
