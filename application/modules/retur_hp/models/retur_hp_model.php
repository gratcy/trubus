<?php
class retur_hp_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }
    
    function __get_retur_hp_select() {
		$this -> db -> select('tid,tnofaktur FROM transaction_tab WHERE tstatus=1 ORDER BY tnofaktur ASC');
		return $this -> db -> get() -> result();
	}
	//2-->penjualan 2-->kredit   1->hp
	function __get_retur_hp() {
		return "SELECT * FROM transaction_tab WHERE (tstatus='1' OR tstatus='0') AND ttype='1' AND ttypetrans='3' ORDER BY tid DESC";
	}
	
	function __get_total_retur_hp() {
		$sql = $this -> db -> query('SELECT * FROM transaction_tab WHERE tstatus=1');
		return $sql -> num_rows();
	}


	function __get_total_retur_hp_monthly($month,$year,$id,$tnofaktur) {
	$y=date('y');
	$m=date('M');
	
	$sql = $this -> db -> query("SELECT * FROM transaction_tab WHERE YEAR(ttanggal) = '$year' AND MONTH(ttanggal) = '$month' ");
	$jum= $sql -> num_rows();
	$tnofakturnew=$tnofaktur.$jum;
	$sqlx=$this -> db -> query("UPDATE transaction_tab set tnofaktur='$tnofakturnew' WHERE tid='$id' ");
	}	

	function __get_gudang_niaga($branchid){
		
		$this -> db -> select("* FROM gudang_tab WHERE gtype='niaga' and gbcpid='".$branchid."' ");
		return $this -> db -> get() -> result();
	}


	
	function __get_retur_hp_detail($id) {
		$this -> db -> select('* FROM transaction_tab WHERE (tstatus=1 OR tstatus=0) AND tid=' . $id);
		return $this -> db -> get() -> result();
	}
	
	function __insert_retur_hp($data) {
        return $this -> db -> insert('transaction_tab', $data);
	}
	
	function __update_retur_hp($id, $data) {
        $this -> db -> where('tid', $id);
        return $this -> db -> update('transaction_tab', $data);
	}
	
	function __delete_retur_hp($id) {
		return $this -> db -> query('update transaction_tab set tstatus=2 where tid=' . $id);
	}
}
