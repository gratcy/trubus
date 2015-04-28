<?php
class spo_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }
    
    function __get_spo_select() {
		$this -> db -> select('tid,tnofaktur FROM transaction_tab WHERE tstatus=1 ORDER BY tnofaktur ASC');
		return $this -> db -> get() -> result();
	}
	
	function __get_spo() {
		return "SELECT * FROM transaction_tab WHERE (tstatus='1' OR tstatus='0') AND ttype='3' AND ttypetrans='2' ORDER BY tid DESC";
	}
	
	function __get_total_spo() {
		$sql = $this -> db -> query('SELECT * FROM transaction_tab WHERE tstatus=1');
		return $sql -> num_rows();
	}


	function __get_total_spo_monthly($month,$year,$id,$tnofaktur) {
	$y=date('y');
	$m=date('M');
	
	$sql = $this -> db -> query("SELECT * FROM transaction_tab WHERE YEAR(ttanggal) = '$year' AND MONTH(ttanggal) = '$month' ");
	$jum= $sql -> num_rows();
	$tnofakturnew=$tnofaktur.$jum;
	$sqlx=$this -> db -> query("UPDATE transaction_tab set tnofaktur='$tnofakturnew' WHERE tid='$id' ");
	}	




	
	function __get_spo_detail($id) {
		$this -> db -> select('* FROM transaction_tab WHERE (tstatus=1 OR tstatus=0) AND tid=' . $id);
		return $this -> db -> get() -> result();
	}
	
	function __insert_spo($data) {
        return $this -> db -> insert('transaction_tab', $data);
	}
	
	function __update_spo($id, $data) {
        $this -> db -> where('tid', $id);
        return $this -> db -> update('transaction_tab', $data);
	}
	
	function __delete_spo($id) {
		return $this -> db -> query('update transaction_tab set tstatus=2 where tid=' . $id);
	}
}
