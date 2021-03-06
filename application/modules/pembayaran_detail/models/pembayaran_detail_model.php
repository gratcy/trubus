<?php
class pembayaran_detail_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }
    
    function __get_pembayaran_detail_select() {
		$this -> db -> select('a.tid,tnofaktur FROM transaction_tab a,transaction_detail_tab b WHERE tstatus=1  AND a.tid=b.ttid ORDER BY a.tid ASC');
		return $this -> db -> get() -> result();
	}
	
	function __get_pembayaran_detail($id,$type=1) {
		$sql = "SELECT *,(select ccode from customer_tab d where d.cid=a.invcid)as ccode,(select cname from customer_tab d where d.cid=a.invcid)as cname,(select caddr from customer_tab d where d.cid=a.invcid)as caddr FROM invoice_tab a, pembayaran_tab b WHERE (a.invstatus='1' OR a.invstatus='0')   AND a.invid=b.pbid AND a.invid='$id' ORDER BY b.pbid ASC";
		
		if ($type == 1) {
			return $sql;
		}
		else {
			$sql = $this -> db -> query($sql);
			return $sql -> result();
		}
	}

	function __get_pembayaran_detailxx($id) {
		$sql=$this -> db -> query( 'SELECT *,(select cname from customer_tab b where b.cid=a.tcid)as cname, 
        (select cdisc from customer_tab b where b.cid=a.tcid)as cdisc FROM transaction_tab a WHERE (a.tstatus=1 OR a.tstatus=0) AND a.ttype=1 AND a.ttypetrans=1   AND a.tid=' . $id .'');
		return $sql-> result();
	}
	
	function __get_total_pembayaran_detail() {
		$sql = $this -> db -> query('SELECT * FROM transaction_detail_tab WHERE (tstatus=1 OR tstatus=0)');
		return $sql -> num_rows();
	}
	
	function __get_pembayaran_detail_detail($id) {
		$this -> db -> select('* FROM transaction_detail_tab WHERE (tstatus=1 OR tstatus=0) AND tid=' . $id);
		//print_r($this->db);die;
		return $this -> db -> get() -> result();
	}
	
	function __insert_pembayaran_detail($data) {
	//print_r($data);die;
        return $this -> db -> insert('transaction_detail_tab', $data);
	}
	function __insert_pembayaran_detailp($data) {
	//print_r($data);die;
        return $this -> db -> insert('trans_tab', $data);
	}

	
function __update_pembayarans($tid,$data) {

	        $this->db->where('tid', $tid);
			$sql=$this->db->update('transaction_tab', $data);	

	return $sql;

	}		
	
function __update_pembayaran_detailz($tid,$data) {
//print_r($data);die;
	        $this->db->where('tid', $tid);
			$sql=$this->db->update('transaction_detail_tab', $data);	

	return $sql;

	}	
	
	
	
	// SELECT sum(tqty) as tqty,sum(tharga*tqty) as tharga,sum(ttotal)as ttotal,(sum(tharga*tqty) -  sum(ttotal)) as ttotaldisc FROM transaction_detail_tab a, transaction_tab b WHERE a.ttid=b.tid AND a.ttid='2' group by ttid
		
	
	function __update_pembayaran_details($id) {

	$sql = $this -> db -> query("SELECT sum(tqty) as tqty,sum(tharga*tqty) as tharga,sum(ttotal)as ttotal,(sum(tharga*tqty) -  sum(ttotal)) as ttotaldisc FROM transaction_detail_tab a, transaction_tab b WHERE a.ttid=b.tid AND a.ttid='$id' group by ttid");
	$dt=$sql-> result();
	foreach($dt as $k => $v){
	$tqtyx=$v->tqty;
	$thargax=$v->tharga ;
	$ttotal=$v->ttotal;
	$tdiscx=$thargax-$ttotal;
	$ttx=$ttotal;
	
	//echo "$tqtyx $thargax $tdiscx $ttx";//die;
	}
//die;
	return $this -> db-> query("UPDATE transaction_tab set ttotalqty='$tqtyx',ttotalharga='$thargax', ttotaldisc='$tdiscx',tgrandtotal='$ttx' WHERE tid='$id' ");
	}	
	
	function __update_penjualan_approval1($id) {
		//echo "UPDATE transaction_tab set approval='1' WHERE tid='$id' ";die;
		$this -> db-> query("UPDATE transaction_detail_tab set approval='1' WHERE ttid='$id' ");
		return $this -> db-> query("UPDATE transaction_tab set approval='1' WHERE tid='$id' ");
	}		
	function __update_penjualan_approval2($id) {
		$this -> db-> query("UPDATE transaction_tab set approval='2' WHERE tid='$id' ");
		$this -> db-> query("UPDATE transaction_detail_tab set approval='2' WHERE ttid='$id' ");
		$sql = $this -> db -> query("SELECT sum(tqty) as tqty,sum(tharga*tqty) as tharga,sum(ttotal)as ttotal,b.ttotaldisc,a.tbid,b.tbid as bid,b.tcid as cid FROM transaction_detail_tab a, transaction_tab b WHERE a.ttid=b.tid AND a.ttid='$id' group by a.tbid");
		$dt=$sql-> result();
		foreach($dt as $k => $v){
			$tqtyx=$v->tqty;
			$tbidx=$v->tbid;
			$bidx=$v->bid;
			$cidx=$v->cid;
			// echo "UPDATE inventory_tab set istockout=(istockout+'$tqtyx'),istock=(istockbegining+istockin+istockreject+istockretur-istockout) WHERE ibid='$tbidx' and ibcid='$bidx'<br>";
		// print_r($dt);	
			$this -> db-> query("UPDATE inventory_tab set istockout=(istockout+'$tqtyx'),istock=(istockbegining+istockin+istockreject+istockretur-istockout) WHERE ibid='$tbidx' and ibcid='$cidx'and itype='2' ");
		}
		
		//echo "xx";die;
		return TRUE;

	}		
	
	function __update_pembayaran_detail($id, $data) {
        $this -> db -> where('tid', $id);
        return $this -> db -> update('transaction_detail_tab', $data);
	}
	
	function __delete_pembayaran_detail($id) {
				return $this -> db -> query('delete from transaction_detail_tab  where tid=' . $id);
	}
}
