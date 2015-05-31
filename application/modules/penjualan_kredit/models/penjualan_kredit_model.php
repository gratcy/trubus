<?php
class penjualan_kredit_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }
    
    function __get_penjualan_kredit_select() {
		$this -> db -> select('tid,tnofaktur FROM transaction_tab WHERE tstatus=1 ORDER BY tnofaktur ASC');
		return $this -> db -> get() -> result();
	}
	//2-->penjualan 2-->kredit   1->hp
	function __get_penjualan_kredit() {
		return "SELECT * FROM transaction_tab WHERE (tstatus='1' OR tstatus='0') AND ttype='2' AND ttypetrans='2' ORDER BY tid DESC";
	}
	
	function __get_total_penjualan_kredit() {
		$sql = $this -> db -> query('SELECT * FROM transaction_tab WHERE tstatus=1');
		return $sql -> num_rows();
	}


	function __get_total_penjualan_kredit_monthly($month,$year,$id,$tnofaktur) {
	$y=date('y');
	$m=date('M');
	
	$sql = $this -> db -> query("SELECT * FROM transaction_tab WHERE YEAR(ttanggal) = '$year' AND MONTH(ttanggal) = '$month' ");

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
