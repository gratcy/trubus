<?php
class hasil_penjualan_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }
    
    function __get_hasil_penjualan_select() {
		$this -> db -> select('tid,tnofaktur FROM transaction_tab WHERE tstatus=1 ORDER BY tnofaktur ASC');
		return $this -> db -> get() -> result();
	}
	//2-->penjualan 2-->kredit   1->hp
	function __get_hasil_penjualan() {
		return "SELECT * FROM transaction_tab WHERE (tstatus='1' OR tstatus='0') AND ttype='1' AND ttypetrans='1' ORDER BY tid DESC";
	}
	
	function __get_total_hasil_penjualan() {
		$sql = $this -> db -> query('SELECT * FROM transaction_tab WHERE tstatus=1');
		return $sql -> num_rows();
	}


	function __get_total_hasil_penjualan_monthly($month,$year,$id,$tnofaktur) {
	$y=date('y');
	$m=date('M');
	
	$sql = $this -> db -> query("SELECT * FROM transaction_tab WHERE YEAR(ttanggal) = '$year' AND MONTH(ttanggal) = '$month'  ");
	$jum= $sql -> num_rows();
	$jumx=10000+$jum;
	$jumz=substr($jumx,1,4);
	$tnofakturnew=$tnofaktur.$jumz;
	//echo $tnofaktur."<br>";
	//echo $tnofakturnew;die;
	$sqlx=$this -> db -> query("UPDATE transaction_tab set tnofaktur='$tnofakturnew' WHERE tid='$id' ");
	}	

	function __get_gudang_niaga($branchid){
		
		$this -> db -> select("* FROM gudang_tab WHERE gtype='niaga' and gbcpid='".$branchid."' ");
		return $this -> db -> get() -> result();
	}


	
	function __get_hasil_penjualan_detail($id) {
		$this -> db -> select('* FROM transaction_tab WHERE (tstatus=1 OR tstatus=0) AND tid=' . $id);
		return $this -> db -> get() -> result();
	}
	
	function __insert_hasil_penjualan($data) {
        return $this -> db -> insert('transaction_tab', $data);
	}
	
	function __update_hasil_penjualan($id, $data) {
        $this -> db -> where('tid', $id);
        return $this -> db -> update('transaction_tab', $data);
	}
	
	function __delete_hasil_penjualan($id) {
		return $this -> db -> query('update transaction_tab set tstatus=2 where tid=' . $id);
	}
}
