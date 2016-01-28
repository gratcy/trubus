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
		$branchid=$this -> memcachedlib -> sesresult['ubranchid'];
		return "SELECT *, (select aname from area_tab where aid=invaid )as aname,
 (select cname from customer_tab where cid=invcid )as cname	FROM invoice_tab WHERE invstatus<>2 and invbid='$branchid' ORDER BY invid DESC";
	}
	
	function __get_invoice($id) {
		$branchid=$this -> memcachedlib -> sesresult['ubranchid'];
		$sql=$this -> db -> query("SELECT *, (select aname from area_tab where aid=invaid )as aname,
 (select cname from customer_tab where cid=invcid )as cname	FROM invoice_tab WHERE invstatus<>2 and invid='$id' and invbid='$branchid' ORDER BY invno ASC");
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
		$sql = $this -> db -> query("SELECT *, (select aname from area_tab where aid=invaid )as aname,
 (select cname from customer_tab where cid=invcid )as cname	FROM invoice_tab WHERE  (invdate between '$datefrom' and '$dateto')  AND invstatus<>2 ORDER BY invno ASC");

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
		
		$this -> db -> select(" b.*,(SELECT cname FROM customer_tab WHERE invcid=cid) AS cname ,(SELECT aname FROM area_tab WHERE invaid=aid) AS aname 
		FROM invoice_tab b
		WHERE b.invid='$id' ");
		
		return $this -> db -> get() -> result();
	}
	
	function __get_bayar_detail($id) {
		
		$this -> db -> select(" a.*,(SELECT cname FROM customer_tab WHERE invcid=cid) AS cname ,(SELECT aname FROM area_tab WHERE invaid=aid) AS aname 
		FROM pembayaran_tab a,invoice_tab b
		WHERE a.invid=b.invid  AND a.invid='$id' ");
		
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
	
		$this -> db -> query('update pembayaran_tab set pbstatus=3 where pbid=' . $pbid);
		$sq=$this -> db -> select(" sum(pbsetor) as pbsetor from pembayaran_tab where invid='$invid' and pbstatus='3' ");
		$dtx=$sq-> get() ->result();

		foreach($dtx as $k => $v){
			
		$psetor=$v->pbsetor;

		}			

		return $this -> db -> query("update invoice_tab set invstatus=1,totalbayar='$psetor',totalhutang=(invtotalall - '$psetor' ) where invid='" . $invid."'");
	}	
	
	function __approve_lunas($invid) {
	
		$this -> db -> query('update transaction_tab set tsbayar=3 where tinvid=' . $invid);
	

		return $this -> db -> query("update invoice_tab set invstatus=3 where invid='" . $invid."'");
	}		
	
	
	function __get_pembayaran_faktur($invid){
		$this -> db -> select(" a.tid,a.tnofaktur,a.ttanggal,a.tgrandtotal,  a.approval, a.tstatus  FROM transaction_tab a WHERE  (a.tnofaktur LIKE 'HP%'  OR a.tnofaktur LIKE 'JC%') 
		AND a.approval='2'  AND  tinvid='$invid' AND (tsbayar is NULL or tsbayar< 1 )");

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
		
		$this -> db -> select(" a.ttanggal,c.aname,SUM(a.tgrandtotal) as gtotal,  b.cid,c.aid,a.approval FROM transaction_tab a, customer_tab b, area_tab c  WHERE  a.tcid=b.cid AND a.tsbayar IS NULL
		AND b.carea = c.aid AND (a.tnofaktur LIKE 'HP%'  OR a.tnofaktur LIKE 'JC%') $naid $ncid
		AND a.approval=2  AND (a.ttanggal between '$datefrom'  AND '$dateto') group by $gb");

		return $this -> db -> get() -> result();
	}	
	
	
	

	function __get_pembayaran_detailzx($area,$cust,$datefrom,$dateto) {
		
		if(($cust=="") AND ($area<>"")){
			$tarea=", area_tab c";
			$tcus="";
			$naid=" AND c.aid='".$area."'";
			$ncid="";
			$gba=", c.aid, c.aname ";
			$gbc="";
			
		}elseif(($cust<>"")AND($area=="")){
			$tarea="";
			$tcus=", customer_tab b";
			$naid="";
			$ncid="AND a.tcid=b.cid AND b.cid='".$cust."' ";
			$gba="";
			$gbc=", b.cid ,b.cname";
			
		}else if(($cust<>"") AND ($area<>"")){
			$bc=" AND b.carea = c.aid ";
		}else{ $bc="";}
		
		$this -> db -> select(" distinct(a.tnofaktur), a.tgrandtotal, a.ttanggal, a.approval $gba $gbc FROM transaction_tab a $tarea $tcus  WHERE  1  AND a.tsbayar IS NULL
		$bc AND (a.tnofaktur LIKE 'HP%'  OR a.tnofaktur LIKE 'JC%') $naid $ncid
		AND a.approval=2  AND (a.ttanggal between '$datefrom'  AND '$dateto') ");
		
		
		
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
	
	function __update_bayarr($id, $data) {
	$this -> db -> where('tid', $id);
	//echo $id;
	//print_r($data);die;
       return $this -> db -> update('transaction_tab', $data);
	}
	
	function __update_bayarrf($tnofaktur, $data) {
	$this -> db -> where('tnofaktur', $tnofaktur);
	// echo $tnofaktur;JC15A101713
	// print_r($data);die;
       return $this -> db -> update('transaction_tab', $data);
	}	
	
	function __update_pembayaran($id, $data) {
        $this -> db -> where('invid', $id);
        return $this -> db -> update('invoice_tab', $data);
	}
	
	
	function __update_infobayar($pbid, $data) {
		// echo $pbid;
		// print_r($data);die;
        $this -> db -> where('pbid', $pbid);
        return $this -> db -> update('pembayaran_tab', $data);
	}	
	
	function __delete_pembayaran($id) {
		return $this -> db -> query('update invoice_tab set invstatus=2 where invid=' . $id);
	}
}
