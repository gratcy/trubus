<?php
class pembayaran_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }
    
    function __get_pembayaran_select() {
		$this -> db -> select('tid,tnofaktur FROM transaction_tab WHERE tstatus=1 ORDER BY tnofaktur ASC');
		return $this -> db -> get() -> result();
	}
	
	function __get_pembayaran() {
		return "SELECT *, (select aname from area_tab where aid=invaid )as aname,
 (select cname from customer_tab where cid=invcid )as cname	FROM invoice_tab WHERE invstatus<>2 ORDER BY invno ASC";
	}
	
	function __get_invoice($id) {
		$sql=$this -> db -> query("SELECT *, (select aname from area_tab where aid=invaid )as aname,
 (select cname from customer_tab where cid=invcid )as cname	FROM invoice_tab WHERE invstatus<>2 and invid='$id' ORDER BY invno ASC");
 return $sql -> result();
	}	
	
	function __get_pembayaran_search($keyword) {
		return "SELECT a.*,b.cname FROM transaction_tab a LEFT JOIN customer_tab b ON a.tcid=b.cid WHERE (a.tnofaktur LIKE '%".$keyword."%' OR b.cname LIKE '%".$keyword."%') AND (a.tstatus='1' OR a.tstatus='0') AND a.ttype='1' AND a.ttypetrans='1' ORDER BY a.tid DESC";
	}
	
	function __get_total_pembayaran() {
		$sql = $this -> db -> query('SELECT * FROM transaction_tab WHERE tstatus=1');
		return $sql -> num_rows();
	}
	function __get_pembayaran_by_date($datefrom,$dateto) {
		$sql = $this -> db -> query("SELECT *,b.tbid as bidx,
		(select d.cname from customer_tab d where d.cid=a.tcid)as cname,
		(select d.ccode from customer_tab d where d.cid=a.tcid)as ccode,
		(select c.bcode from books_tab c where c.bid=b.tbid)as bcode,
		(select c.btitle from books_tab c where c.bid=b.tbid)as btitle
		FROM transaction_tab a,transaction_detail_tab b WHERE (a.ttanggal between '$datefrom' and '$dateto') and a.tid=b.ttid and a.ttype='1' and a.ttypetrans='1' AND a.tstatus='1' ");
		return $sql -> result();
	}

	function __get_total_pembayaran_monthly($month,$year,$id,$tnofaktur) {
		$y=date('y');
		$m=date('M');
		
		$sql = $this -> db -> query("SELECT * FROM invoice_tab WHERE YEAR(invdate) = '$year' AND MONTH(invdate) = '$month' AND invno LIKE 'INV%' ORDER BY invno DESC limit 0,1");
		
		$dt=$sql-> result();
		foreach($dt as $k => $v){
			
		$tnofakturx=$v->invno;
		$jum=substr($tnofakturx,7,4);
		$jumx=$jum+0;
		//echo $jumx;die;
		$juma=$jumx;
		}	
		echo "SELECT * FROM invoice_tab WHERE YEAR(invdate) = '$year' AND MONTH(invdate) = '$month' AND invno LIKE 'INV%' ORDER BY invno DESC limit 0,1";
		//echo $tnofakturx.$v->invno.'-'.$juma.'-'.$jum;die;
		
	//$jum= $sql -> num_rows();
	$jumx=10001+$juma;
	$jumz=substr($jumx,1,4);
	$tnofakturxx=substr($tnofakturx,0,7);
	$tnofakturnew=$tnofakturxx.$jumz;		
		
		
		
		//echo $juma.'a'.$jumx.'b'.$jumz.'c'.$tnofakturnew;die;
		
		
		
		
		//echo $tnofaktur."<br>";
		//echo $tnofakturnew;die;
		$sqlx=$this -> db -> query("UPDATE invoice_tab set invno='$tnofakturnew' WHERE invid='$id' ");
	}	

	function __get_gudang_niaga($branchid){
		
		$this -> db -> select("* FROM gudang_tab WHERE gtype='niaga' and gbcpid='".$branchid."' ");
		return $this -> db -> get() -> result();
	}


	
	function __get_pembayaran_detail($id) {
		//echo "aaa";die;
		$this -> db -> select("*, (select aname from area_tab where aid=invaid )as aname,
 (select cname from customer_tab where cid=invcid )as cname		FROM invoice_tab WHERE invstatus<>2 AND invid='$id'" );
		//echo "* FROM invoice_tab WHERE invstatus<>'2' AND invid='$id' ";die;
		
		return $this -> db -> get() -> result();
	}
	
	
	
	function __get_bayar($id) {
		$this -> db -> select(" * from pembayaran_tab where invid='$id' ");
		
		return $this -> db -> get() -> result();
	}	

	function __get_total_terima($id) {
		$this -> db -> select(" sum(pbsetor) as terima from pembayaran_tab where invid='$id' and pbstatus='3' ");
		
		return $this -> db -> get() -> result();
	}	
	function __get_total_pending($id) {
		$this -> db -> select(" sum(pbsetor) as setor from pembayaran_tab where invid='$id' and pbstatus='1' ");
		return $this -> db -> get() -> result();
	}		
	
	
	function __approve_bayar($invid,$pbid) {
		
		
		
		//echo "xxx".$invid.'-'.$pbid;die;
		
		$this -> db -> query('update pembayaran_tab set pbstatus=3 where pbid=' . $pbid);
		$sq=$this -> db -> select(" sum(pbsetor) as pbsetor from pembayaran_tab where invid='$invid' and pbstatus='3' ");
		$dtx=$sq-> get() ->result();
		//echo " sum(pbsetor) as pbsetor from pembayaran_tab where invid='$invid' and pbstatus='3' ";
		//print_r($dtx);
		foreach($dtx as $k => $v){
			
		$psetor=$v->pbsetor;

		}			
		//echo $psetor;die;
		// echo "update invoice_tab set invstatus=3,totalbayar='$psetor',totalhutang=(totalhutang - '$psetor' ) where invid='" . $invid."'";die;
		return $this -> db -> query("update invoice_tab set invstatus=3,totalbayar='$psetor',totalhutang=(invtotalall - '$psetor' ) where invid='" . $invid."'");
	}	
	
	function __get_pembayaran_detailz($area,$cust,$datefrom,$dateto) {
		
		if($cust==""){
			$naid=" AND c.aid='".$area."'";
			$ncid="";
			$gb=" c.aid ";
		}else{
			$naid="";
			$ncid=" AND b.cid='".$cust."' ";
			$gb=" b.cid ";
		}
		
		$this -> db -> select(" a.ttanggal,c.aname,SUM(a.tgrandtotal) as gtotal,  b.cid,c.aid,a.approval FROM transaction_tab a, customer_tab b, area_tab c  WHERE  a.tcid=b.cid AND a.tsbayar IS NULL
		AND b.carea = c.aid AND (a.tnofaktur LIKE 'HP%'  OR a.tnofaktur LIKE 'JC%') $naid $ncid
		AND a.approval=2  AND (a.ttanggal between '$datefrom'  AND '$dateto') group by $gb");
		
 // echo " a.ttanggal,c.aname,SUM(a.tgrandtotal) as gtotal,  b.cid,c.aid,a.approval FROM transaction_tab a, customer_tab b, area_tab c  WHERE  a.tcid=b.cid AND a.tsbayar IS NULL
		// AND b.carea = c.aid AND (a.tnofaktur LIKE 'HP%'  OR a.tnofaktur LIKE 'JC%') $naid $ncid
		// AND a.approval=2  AND (a.ttanggal between '$datefrom'  AND '$dateto') group by $gb";die;	
		
		return $this -> db -> get() -> result();
	}	
	
	
	

	function __get_pembayaran_detailzx($area,$cust,$datefrom,$dateto) {
		
		if($cust==""){
			$naid=" AND c.aid='".$area."'";
			$ncid="";
			$gb=" c.aid ";
		}else{
			$naid="";
			$ncid=" AND b.cid='".$cust."' ";
			$gb=" b.cid ";
		}
		
		$this -> db -> select(" distinct(a.tnofaktur), a.tgrandtotal, a.ttanggal,c.aname,  b.cid,c.aid,a.approval FROM transaction_tab a, customer_tab b, area_tab c  WHERE  a.tcid=b.cid AND a.tsbayar IS NULL
		AND b.carea = c.aid AND (a.tnofaktur LIKE 'HP%'  OR a.tnofaktur LIKE 'JC%') $naid $ncid
		AND a.approval=2  AND (a.ttanggal between '$datefrom'  AND '$dateto') ");
		
		
		// echo "distinct(a.tnofaktur), a.tgrandtotal, a.ttanggal,c.aname,  b.cid,c.aid,a.approval FROM transaction_tab a, customer_tab b, area_tab c  WHERE  a.tcid=b.cid AND a.tsbayar IS NULL
		// AND b.carea = c.aid AND (a.tnofaktur LIKE 'HP%'  OR a.tnofaktur LIKE 'JK%') $naid $ncid
		// AND a.approval=2  AND (a.ttanggal between '$datefrom'  AND '$dateto') ";
		
  // echo " a.ttanggal,c.aname,SUM(a.tgrandtotal) as gtotal,  b.cid,c.aid,a.approval FROM transaction_tab a, customer_tab b, area_tab c  WHERE  a.tcid=b.cid 
		 // AND b.carea = c.aid AND (a.tnofaktur LIKE 'HP%'  OR a.tnofaktur LIKE 'JC%') $naid $ncid
		 // AND a.approval=2  AND (a.ttanggal between '$datefrom'  AND '$dateto') group by $gb";die;	
		
		return $this -> db -> get() -> result();
	}		
	
	
	function __update_invtrans($tnof, $data) {
		// print_r($data);
		// echo "$tnof";die;
        $this -> db -> where('tnofaktur', $tnof);
        return $this -> db -> update('transaction_tab', $data);
	}	
	
	
	
	function __insert_pembayaran($data) {
	
		//print_r($data);die;
        return $this -> db -> insert('invoice_tab', $data);
	}
	
	function __insert_bayar($data) {
	
		
        return $this -> db -> insert('pembayaran_tab', $data);
	}	
	
	
	function __update_pembayaran($id, $data) {
        $this -> db -> where('invid', $id);
        return $this -> db -> update('invoice_tab', $data);
	}
	
	function __delete_pembayaran($id) {
		return $this -> db -> query('update invoice_tab set invstatus=2 where invid=' . $id);
	}
}
