<?php
class penjualan_kredit_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }
    
    function __get_penjualan_kredit_select(){
		$this -> db -> select('tid,tnofaktur FROM transaction_tab WHERE tstatus=1 ORDER BY tnofaktur ASC');
		return $this -> db -> get() -> result();
	}
	
	function __get_penjualan_kredit() {
		$branch=$this -> memcachedlib -> sesresult['ubranchid'];
		return "SELECT a.*,b.cname FROM transaction_tab a LEFT JOIN customer_tab b ON a.tcid=b.cid WHERE (a.tstatus='1' OR a.tstatus='0') AND a.ttype='2' AND a.ttypetrans='2' and a.tbid='$branch' ORDER BY a.tid DESC";
	}
	
	function __get_penjualan_kredit_search($keyword) {
		//echo $keyword;die;
		$branch=$this -> memcachedlib -> sesresult['ubranchid'];
		return "SELECT a.*,b.cname FROM transaction_tab a LEFT JOIN customer_tab b ON a.tcid=b.cid WHERE (a.tnofaktur LIKE '%".$keyword."%' OR b.cname LIKE '%".$keyword."%' OR a.tinfo LIKE '%".$keyword."%') AND (a.tstatus='1' OR a.tstatus='0') AND a.ttype='2' AND a.ttypetrans='2' 
		and a.tbid='$branch' ORDER BY a.tid DESC";
	}
	
	function __get_total_penjualan_kredit() {
		$sql = $this -> db -> query('SELECT * FROM transaction_tab WHERE tstatus=1');
		return $sql -> num_rows();
	}

    function __get_hasil_penjualan_by_date($datefrom,$dateto) {
		$branch=$this -> memcachedlib -> sesresult['ubranchid'];
		$sql = $this -> db -> query("SELECT *,b.tbid as bidx,
		(select c.bcode from books_tab c where c.bid=b.tbid)as bcode,
		(select c.btitle from books_tab c where c.bid=b.tbid)as btitle,e.cname,e.ccode
		FROM transaction_tab a,transaction_detail_tab b, customer_tab e WHERE a.tcid=e.cid AND (a.ttanggal between '$datefrom' and '$dateto') and a.tid=b.ttid AND a.tbid='$branch'  AND a.ttype='2' and a.ttypetrans='2' AND a.tstatus=1");
		return $sql -> result();
	}
	function __get_total_penjualan_kredit_monthly($month,$year,$id,$tnofaktur) {
	$y=date('y');
	$m=date('M');
	$branch=$this -> memcachedlib -> sesresult['ubranchid'];
	$sql = $this -> db -> query("SELECT * FROM transaction_tab WHERE YEAR(ttanggal) = '$year' AND MONTH(ttanggal) = '$month' AND tnofaktur LIKE 'JC%' AND tbid='$branch' ORDER BY tnofaktur DESC limit 0,1");

		$dt=$sql-> result();
		foreach($dt as $k => $v){
		$tnofakturx=$v->tnofaktur;
		$jum=substr($tnofakturx,7,4);
		$jumx=$jum+0;
		
		$juma=$jumx;
		}	
		//echo $tnofakturx.$v->tnofaktur.'-'.$juma.'-'.$jum;die;
		
	//$jum= $sql -> num_rows();
	$jumx=10001+$jum;
	$jumz=substr($jumx,1,4);
	$tnofakturnew=$tnofaktur.$jumz;	
	
	$sqlx=$this -> db -> query("UPDATE transaction_tab set tnofaktur='$tnofakturnew' WHERE tid='$id' ");
	}	

	function __get_gudang_niaga($branchid){
		
		$this -> db -> select("* FROM gudang_tab WHERE gtype='niaga' and gbcpid='".$branchid."' ");
		return $this -> db -> get() -> result();
	}


	
	function __get_penjualan_kredit_detail($id) {
		$this -> db -> select('* FROM transaction_tab WHERE (tstatus=1 OR tstatus=0) AND tid=' . $id);
		return $this -> db -> get() -> result();
	}
	
	function __insert_penjualan_kredit($data) {
        return $this -> db -> insert('transaction_tab', $data);
	}
	
	function __update_penjualan_kredit($id, $data) {
        $this -> db -> where('tid', $id);
        return $this -> db -> update('transaction_tab', $data);
	}
	
	function __delete_penjualan_kredit($id) {
		return $this -> db -> query('update transaction_tab set tstatus=2 where tid=' . $id);
	}
}
