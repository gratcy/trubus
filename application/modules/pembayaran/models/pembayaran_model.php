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
 (select cname from customer_tab where cid=invcid )as cname		FROM invoice_tab WHERE invstatus<>2 ORDER BY invno ASC";
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
		
		$sql = $this -> db -> query("SELECT * FROM transaction_tab WHERE YEAR(ttanggal) = '$year' AND MONTH(ttanggal) = '$month' AND tnofaktur LIKE 'HP%' ORDER BY tnofaktur DESC limit 0,1");
		// $jum= $sql -> num_rows();
		// $jumx=10000+$jum;
		// $jumz=substr($jumx,1,4);
		// $tnofakturnew=$tnofaktur.$jumz;
		
		
		
		
		$dt=$sql-> result();
		foreach($dt as $k => $v){
		$tnofakturx=$v->tnofaktur;
		$jum=substr($tnofakturx,7,4);
		$jumx=$jum+0;
		
		$juma=$jumx;
		}	
		//echo $tnofakturx.$v->tnofaktur.'-'.$juma.'-'.$jum;die;
		
	//$jum= $sql -> num_rows();
	$jumx=10001+$juma;
	$jumz=substr($jumx,1,4);
	$tnofakturnew=$tnofaktur.$jumz;		
		
		
		
		//echo $jum.$jumx.$jumz.$tnofakturnew;die;
		
		
		
		
		//echo $tnofaktur."<br>";
		//echo $tnofakturnew;die;
		$sqlx=$this -> db -> query("UPDATE transaction_tab set tnofaktur='$tnofakturnew' WHERE tid='$id' ");
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
		
		$this -> db -> select(" a.ttanggal,c.aname,SUM(a.tgrandtotal) as gtotal,  b.cid,c.aid,a.approval FROM transaction_tab a, customer_tab b, area_tab c  WHERE  a.tcid=b.cid 
		AND b.carea = c.aid AND (a.tnofaktur LIKE 'HP%'  OR a.tnofaktur LIKE 'JC%') $naid $ncid
		AND a.approval=2  AND (a.ttanggal between '$datefrom'  AND '$dateto') group by $gb");
		
 // echo " a.ttanggal,c.aname,SUM(a.tgrandtotal) as gtotal,  b.cid,c.aid,a.approval FROM transaction_tab a, customer_tab b, area_tab c  WHERE  a.tcid=b.cid 
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
		
		$this -> db -> select(" distinct(a.tnofaktur), a.tgrandtotal, a.ttanggal,c.aname,  b.cid,c.aid,a.approval FROM transaction_tab a, customer_tab b, area_tab c  WHERE  a.tcid=b.cid 
		AND b.carea = c.aid AND (a.tnofaktur LIKE 'HP%'  OR a.tnofaktur LIKE 'JC%') $naid $ncid
		AND a.approval=2  AND (a.ttanggal between '$datefrom'  AND '$dateto') ");
		
 // echo " a.ttanggal,c.aname,SUM(a.tgrandtotal) as gtotal,  b.cid,c.aid,a.approval FROM transaction_tab a, customer_tab b, area_tab c  WHERE  a.tcid=b.cid 
		// AND b.carea = c.aid AND (a.tnofaktur LIKE 'HP%'  OR a.tnofaktur LIKE 'JC%') $naid $ncid
		// AND a.approval=2  AND (a.ttanggal between '$datefrom'  AND '$dateto') group by $gb";die;	
		
		return $this -> db -> get() -> result();
	}		
	
	
	
	
	
	
	function __insert_pembayaran($data) {
	
		
        return $this -> db -> insert('invoice_tab', $data);
	}
	
	function __update_pembayaran($id, $data) {
        $this -> db -> where('invid', $id);
        return $this -> db -> update('invoice_tab', $data);
	}
	
	function __delete_pembayaran($id) {
		return $this -> db -> query('update transaction_tab set tstatus=2 where tid=' . $id);
	}
}
