<?php
class hasil_penjualan_detail_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }
    
    function __get_hasil_penjualan_detail_select() {
		$this -> db -> select('a.tid,tnofaktur FROM transaction_tab a,transaction_detail_tab b WHERE tstatus=1  AND a.tid=b.ttid ORDER BY a.tid ASC');
		return $this -> db -> get() -> result();
	}
	
	function __get_hasil_penjualan_detail($id) {
		return "SELECT * FROM transaction_tab a, transaction_detail_tab b WHERE (a.tstatus='1' OR a.tstatus='0') AND ttype='1' AND ttypetrans='1'  AND a.tid=b.ttid AND a.tid='$id' ORDER BY b.tid DESC";
	}

	function __get_hasil_penjualan_detailxx($id) {
		$sql=$this -> db -> query( 'SELECT * FROM transaction_tab a WHERE (a.tstatus=1 OR a.tstatus=0) AND ttype=1 AND ttypetrans=1   AND a.tid=' . $id .'');
		return $sql-> result();
	}
	
	function __get_total_hasil_penjualan_detail() {
		$sql = $this -> db -> query('SELECT * FROM transaction_detail_tab WHERE (tstatus=1 OR tstatus=0)');
		return $sql -> num_rows();
	}
	
	function __get_hasil_penjualan_detail_detail($id) {
		$this -> db -> select('* FROM transaction_detail_tab WHERE (tstatus=1 OR tstatus=0) AND tid=' . $id);
		return $this -> db -> get() -> result();
	}
	
	function __insert_hasil_penjualan_detail($data) {
        return $this -> db -> insert('transaction_detail_tab', $data);
	}


	function __update_hasil_penjualan_details($id) {
	//$year=date('Y');
	
	$sql = $this -> db -> query("SELECT sum(tqty) as tqty,sum(tharga) as tharga,sum(tdisc)as tdisc,sum(ttotal)as ttotal FROM transaction_detail_tab WHERE ttid='$id' group by ttid");
	$dt=$sql-> result();
	foreach($dt as $k => $v){
	$tqtyx=$v->tqty;
	$thargax=$v->tharga;
	$tdiscx=$v->tdisc;
	$ttx=$v->ttotal;
	
	//echo "$tqtyx $thargax $tdiscx";die;
	}
	
	return $this -> db -> query("UPDATE transaction_tab set ttotalqty='$tqtyx',ttotalharga='$thargax',ttotaldisc='$tdiscx',tgrandtotal='$ttx' WHERE tid='$id' ");
	}	
	
	function __update_hasil_penjualan_detail($id, $data) {
        $this -> db -> where('tid', $id);
        return $this -> db -> update('transaction_detail_tab', $data);
	}
	
	function __delete_hasil_penjualan_detail($id) {
		return $this -> db -> query('update transaction_detail_tab set tstatus=2 where tid=' . $id);
	}
}
