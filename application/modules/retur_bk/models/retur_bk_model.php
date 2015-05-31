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
		return "SELECT *,(select pname from publisher_tab where publisher_tab.pid=transaction_tab.tpid)as pname,
		(select pid from publisher_tab where publisher_tab.pid=transaction_tab.tpid)as pid
		FROM transaction_tab WHERE (tstatus='1' OR tstatus='0') AND ttype='3' AND ttypetrans='4'
	ORDER BY tid DESC";
	}
	
	function __get_total_retur_bk() {
		$sql = $this -> db -> query('SELECT * FROM transaction_tab WHERE tstatus=1');
		return $sql -> num_rows();
	}


	function __get_total_retur_bk_monthly($month,$year,$id,$tnofaktur) {
	$y=date('y');
	$m=date('M');
	
	$sql = $this -> db -> query("SELECT * FROM transaction_tab WHERE YEAR(ttanggal) = '$year' AND MONTH(ttanggal) = '$month' ");
	$jum= $sql -> num_rows();
	$tnofakturnew=$tnofaktur.$jum;
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
