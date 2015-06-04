<?php
class pembelian_kredit_detail_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }
    
    function __get_pembelian_kredit_detail_select() {
		$this -> db -> select('a.tid,tnofaktur FROM transaction_tab a,transaction_detail_tab b WHERE tstatus=1  AND a.tid=b.ttid ORDER BY a.tid ASC');
		return $this -> db -> get() -> result();
	}
	
	function __get_pembelian_kredit_detail($id) {
		return "SELECT * FROM transaction_tab a, transaction_detail_tab b WHERE (a.tstatus='1' OR a.tstatus='0') AND ttype='3' AND ttypetrans='2'  AND a.tid=b.ttid AND a.tid='$id' ORDER BY b.tid DESC";
	}

	function __get_pembelian_kredit_detailxx($id) {
		$sql=$this -> db -> query( 'SELECT *,(select cname from customer_tab b where b.cid=a.tcid)as cname FROM transaction_tab a WHERE (a.tstatus=1 OR a.tstatus=0) AND ttype=3 AND ttypetrans=2   AND a.tid=' . $id .'');
		return $sql-> result();
	}
	
	function __get_total_pembelian_kredit_detail() {
		$sql = $this -> db -> query('SELECT * FROM transaction_detail_tab WHERE (tstatus=1 OR tstatus=0)');
		return $sql -> num_rows();
	}
	
	function __get_pembelian_kredit_detail_detail($id) {
		$this -> db -> select('* FROM transaction_detail_tab WHERE (tstatus=1 OR tstatus=0) AND tid=' . $id);
		return $this -> db -> get() -> result();
	}
	
	function __insert_pembelian_kredit_detail($data) {
        return $this -> db -> insert('transaction_detail_tab', $data);
	}


	
function __update_pembelian_kredits($tid,$data) {
	//$year=date('Y');
	//print_r($data);
	        $this->db->where('tid', $tid);
			$sql=$this->db->update('transaction_tab', $data);	
	//print_r($sql);die;
	return $sql;
	
 //return $this -> db -> update('transaction_tab', $data);
	}		
	
	
	
	
	
	
	
	
	
	function __update_pembelian_kredit_details($id) {
	//$year=date('Y');
	echo "SELECT sum(tqty) as tqty,sum(tharga) as tharga,sum(ttotal)as ttotal,b.ttotaldisc FROM transaction_detail_tab a, transaction_tab b WHERE a.ttid=b.tid AND a.ttid='$id' group by ttid";
	$sql = $this -> db -> query("SELECT sum(tqty) as tqty,sum(tharga) as tharga,sum(ttotal)as ttotal,b.ttotaldisc FROM transaction_detail_tab a, transaction_tab b WHERE a.ttid=b.tid AND a.ttid='$id' group by ttid");
	$dt=$sql-> result();
	foreach($dt as $k => $v){
	$tqtyx=$v->tqty;
	$thargax=$v->ttotal;
	$tdiscx=$v->ttotaldisc;
	$ttx=$thargax-($tdiscx * $thargax/100);
	
	//echo "$tqtyx $thargax $tdiscx $ttx";die;
	}
	//echo "UPDATE transaction_tab set ttotalqty='$tqtyx',ttotalharga='$thargax',ttotaldisc='$tdiscx',tgrandtotal='$ttx' WHERE tid='$id' ";
	return $this -> db-> query("UPDATE transaction_tab set ttotalqty='$tqtyx',ttotalharga='$thargax', ttotaldisc='$tdisc',tgrandtotal='$ttx' WHERE tid='$id' ");
	}	
	
	function __update_pembelian_kredit_detail($id, $data) {
        $this -> db -> where('tid', $id);
        return $this -> db -> update('transaction_detail_tab', $data);
	}
	
	function __delete_pembelian_kredit_detail($id) {
		return $this -> db -> query('update transaction_detail_tab set tstatus=2 where tid=' . $id);
	}
}
