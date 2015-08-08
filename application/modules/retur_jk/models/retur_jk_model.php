<?php
class retur_jk_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }
    
    function __get_retur_jk_select() {
		$this -> db -> select('tid,tnofaktur FROM transaction_tab WHERE tstatus=1 ORDER BY tnofaktur ASC');
		return $this -> db -> get() -> result();
	}
	
	function __get_retur_jk() {
		return "SELECT a.*,b.cname FROM transaction_tab a LEFT JOIN customer_tab b ON a.tcid=b.cid WHERE (a.tstatus='1' OR a.tstatus='0') AND a.ttype='1' AND a.ttypetrans='4' ORDER BY a.tid DESC";
	}
	
	function __get_retur_jk_search($keyword) {
		return "SELECT a.*,b.cname FROM transaction_tab a LEFT JOIN customer_tab b ON a.tcid=b.cid WHERE (a.tnofaktur LIKE '%".$keyword."%' OR b.cname LIKE '%".$keyword."%') AND (a.tstatus='1' OR a.tstatus='0') AND a.ttype='1' AND a.ttypetrans='4' ORDER BY a.tid DESC";
	}
	
	function __get_total_retur_jk() {
		$sql = $this -> db -> query('SELECT * FROM transaction_tab WHERE tstatus=1');
		return $sql -> num_rows();
	}


	function __get_total_retur_jk_monthly($month,$year,$id,$tnofaktur) {
	$y=date('y');
	$m=date('M');
	
	
	$sql = $this -> db -> query("SELECT * FROM transaction_tab WHERE YEAR(ttanggal) = '$year' AND MONTH(ttanggal) = '$month' AND tnofaktur LIKE 'RJK%'");

	$jum= $sql -> num_rows();
	$jumx=10000+$jum;
	$jumz=substr($jumx,1,4);
	$tnofakturnew=$tnofaktur.$jumz;	
	$sqlx=$this -> db -> query("UPDATE transaction_tab set tnofaktur='$tnofakturnew' WHERE tid='$id' ");
	}	

	function __get_gudang_niaga($branchid){
		
		$this -> db -> select("* FROM gudang_tab WHERE gtype='niaga' and gbcpid='".$branchid."' ");
		return $this -> db -> get() -> result();
	}

    function __get_hasil_penjualan_by_date($datefrom,$dateto) {
		$sql = $this -> db -> query("SELECT *,b.tbid as bidx,
		(select c.bcode from books_tab c where c.bid=b.tbid) as bcode,
		(select c.btitle from books_tab c where c.bid=b.tbid) as btitle,e.cname,e.ccode
		FROM transaction_tab a,transaction_detail_tab b, customer_tab e WHERE a.tcid=e.cid AND (a.ttanggal between '$datefrom' and '$dateto') and a.tid=b.ttid and a.ttype='1' and a.ttypetrans='4' AND a.tstatus='1' ");
		return $sql -> result();
	}
	
	function __get_retur_jk_detail($id) {
		$this -> db -> select('* FROM transaction_tab WHERE (tstatus=1 OR tstatus=0) AND tid=' . $id);
		return $this -> db -> get() -> result();
	}
	
	function __insert_retur_jk($data) {
        return $this -> db -> insert('transaction_tab', $data);
	}
	
	function __update_retur_jk($id, $data) {
        $this -> db -> where('tid', $id);
        return $this -> db -> update('transaction_tab', $data);
	}
	
	function __delete_retur_jk($id) {
		return $this -> db -> query('update transaction_tab set tstatus=2 where tid=' . $id);
	}
}
