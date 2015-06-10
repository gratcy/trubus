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
		return "SELECT a.*,b.pname,b.pid FROM transaction_tab a LEFT JOIN publisher_tab b ON b.pid=a.tpid WHERE (a.tstatus='1' OR a.tstatus='0') AND a.ttype='3' AND a.ttypetrans='4' ORDER BY a.tid DESC";
	}
	
	function __get_retur_bk_search($keyword) {
		return "SELECT a.*,b.pname,b.pid FROM transaction_tab a LEFT JOIN publisher_tab b ON b.pid=a.tpid WHERE (b.pname LIKE '%".$keyword."%' OR a.tnofaktur LIKE '%".$keyword."%' OR a.tnospo LIKE '%".$keyword."%') AND (a.tstatus='1' OR a.tstatus='0') AND a.ttype='3' AND a.ttypetrans='4' ORDER BY a.tid DESC";
	}
	
	function __get_total_retur_bk() {
		$sql = $this -> db -> query('SELECT * FROM transaction_tab WHERE tstatus=1');
		return $sql -> num_rows();
	}

   function __get_hasil_penjualan_by_date($datefrom,$dateto) {
		$sql = $this -> db -> query("SELECT *,b.tbid as bidx,
		(select c.bcode from books_tab c where c.bid=b.tbid)as bcode,
		(select c.btitle from books_tab c where c.bid=b.tbid)as btitle
		FROM transaction_tab a,transaction_detail_tab b WHERE (a.ttanggal between '$datefrom' and '$dateto') and a.tid=b.ttid and a.ttype='3' and a.ttypetrans='4' AND a.tstatus='1' ");
		return $sql -> result();
	}

	function __get_total_retur_bk_monthly($month,$year,$id,$tnofaktur) {
	$y=date('y');
	$m=date('M');
	
	$sql = $this -> db -> query("SELECT * FROM transaction_tab WHERE YEAR(ttanggal) = '$year' AND MONTH(ttanggal) = '$month' ");

	$jum= $sql -> num_rows();
	$jumx=10000+$jum;
	$jumz=substr($jumx,1,4);
	$tnofakturnew=$tnofaktur.$jumz;	
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
