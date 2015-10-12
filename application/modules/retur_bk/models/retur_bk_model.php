<?php
class retur_bk_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }
    
    function __get_retur_bk_select() {
		$this -> db -> select('* FROM trans_all_tab WHERE status=1 ORDER BY no_spo ASC');
		return $this -> db -> get() -> result();
	}
	
	function __get_retur_bk() {
		$branch=$this -> memcachedlib -> sesresult['ubranchid'];
		return "SELECT a.*,b.pname,b.pid FROM transaction_tab a LEFT JOIN publisher_tab b ON b.pid=a.tpid WHERE (a.tstatus='1' OR a.tstatus='0') AND a.ttype='3' AND a.ttypetrans='4' and a.tbid='$branch' ORDER BY a.tid DESC";
	}
	
	function __get_retur_bk_search($keyword) {
		return "SELECT a.*,b.pname,b.pid FROM transaction_tab a LEFT JOIN publisher_tab b ON b.pid=a.tpid WHERE (b.pname LIKE '%".$keyword."%' OR a.tnofaktur LIKE '%".$keyword."%' OR a.tnospo LIKE '%".$keyword."%') AND (a.tstatus='1' OR a.tstatus='0') AND a.ttype='3' AND a.ttypetrans='4' ORDER BY a.tid DESC";
	}
	
	function __get_total_retur_bk() {
		$sql = $this -> db -> query('SELECT * FROM transaction_tab WHERE tstatus=1');
		return $sql -> num_rows();
	}

   function __get_hasil_retur_by_date($datefrom,$dateto) {
	   $branch=$this -> memcachedlib -> sesresult['ubranchid'];
		$sql = $this -> db -> query("SELECT *,b.tbid as bidx,a.tid,
		(select p.pcode from publisher_tab p where p.pid=a.tpid)as pcode,
		(select p.pname from publisher_tab p where p.pid=a.tpid)as pname,
		(select c.bcode from books_tab c where c.bid=b.tbid)as bcode,
		(select c.btitle from books_tab c where c.bid=b.tbid)as btitle
		FROM transaction_tab a,transaction_detail_tab b WHERE (a.ttanggal between '$datefrom' and '$dateto') AND a.tbid='$branch' AND a.tid=b.ttid and a.ttype='3' and a.ttypetrans='4' AND a.tstatus='1' ");
		

		return $sql -> result();
	}
	

	function __get_total_retur_bk_monthly($month,$year,$id,$tnofaktur) {
		// echo "SELECT * FROM transaction_tab WHERE YEAR(ttanggal) = '$year' AND MONTH(ttanggal) = '$month' AND tnofaktur LIKE 'RB%' ORDER BY tnofaktur DESC limit 0,1";
		// echo "mm";die;
	$y=date('y');
	$m=date('M');
	$branch=$this -> memcachedlib -> sesresult['ubranchid'];
	$sql = $this -> db -> query("SELECT * FROM transaction_tab WHERE YEAR(ttgl_spo) = '$year' AND MONTH(ttgl_spo) = '$month' AND tnospo LIKE 'RB%' AND tbid='$branch' ORDER BY tnospo DESC limit 0,1");

		$dt=$sql-> result();
		foreach($dt as $k => $v){
		$tnofakturx=$v->tnospo;
		
	//echo "aaa";die;
		
		$jum=substr($tnofakturx,6,4);		
		$jumx=$jum+0;
		//echo $jum.$jumx;die;
		$juma=$jumx;
		}	
		//echo $tnofakturx.$v->tnofaktur.'-'.$juma.'-'.$jum;die;
		
	//$jum= $sql -> num_rows();
	$jumx=10001+$juma;
//echo $tnofakturx;	
	//echo $juma.'-'.$jumx;die;
	$jumz=substr($jumx,1,4);
	$tnofakturnew=$tnofaktur.$jumz;	
	//echo $tnofakturnew.'-'.$juma;die;
	$sqlx=$this -> db -> query("UPDATE transaction_tab set tnospo='$tnofakturnew' WHERE tid='$id' ");
	}	




	
	function __get_retur_bk_detail($id) {
		$this -> db -> select('* FROM transaction_tab WHERE (tstatus=1 OR tstatus=0) AND tid=' . $id);
		return $this -> db -> get() -> result();
	}
	
	function __insert_retur_bk($data) {
        return $this -> db -> insert('transaction_tab', $data);
	}
	
	function __update_retur_bk($id, $data) {
        $this -> db -> where('tid', $id);
        return $this -> db -> update('transaction_tab', $data);
	}
	
	function __delete_retur_bk($id) {
		return $this -> db -> query('update transaction_tab set tstatus=2 where tid=' . $id);
	}
}
