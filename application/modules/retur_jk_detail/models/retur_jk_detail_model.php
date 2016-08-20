<?php
class retur_jk_detail_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }
    
    function __get_retur_jk_detail_select() {
		$this -> db -> select('a.tid,tnofaktur FROM transaction_tab a,transaction_detail_tab b WHERE tstatus=1  AND a.tid=b.ttid ORDER BY a.tid ASC');
		return $this -> db -> get() -> result();
	}
	
	function __get_retur_jk_detail($id,$type=1) {
		$sql = "SELECT *,(select ccode from customer_tab d where d.cid=a.tcid)as ccode,(select cname from customer_tab d 
		where d.cid=a.tcid)as cname,(select caddr from customer_tab d where d.cid=a.tcid)as caddr,
		(select bcode from books_tab c where c.bid=b.tbid)as bcode,(select btitle from books_tab c where c.bid=b.tbid)as btitle 
		FROM transaction_tab a, transaction_detail_tab b WHERE (b.tstatus='1' OR b.tstatus='0') AND ttype='1' 
		AND ttypetrans='4'  AND a.tid=b.ttid AND a.tid='$id'  ORDER BY b.tid ASC ";
		//echo $sql;die;
		if ($type == 1) {
			return $sql;
		}
		else {
			$sql = $this -> db -> query($sql);
			return $sql -> result();
		}
	}

	function __get_retur_jk_detailxx($id) {
		$sql=$this -> db -> query( 'SELECT *,(select cname from customer_tab b where b.cid=a.tcid)as cname,
       (select cdisc from customer_tab b where b.cid=a.tcid)as cdisc
		FROM transaction_tab a WHERE (a.tstatus=1 OR a.tstatus=0) AND ttype=1 AND ttypetrans=4   AND a.tid=' . $id .'');
		return $sql-> result();
	}
	
	function __get_total_retur_jk_detail() {
		$sql = $this -> db -> query('SELECT * FROM transaction_detail_tab WHERE (tstatus=1 OR tstatus=0)');
		return $sql -> num_rows();
	}
	
	function __get_retur_jk_detail_detail($id) {
		$this -> db -> select('* FROM transaction_detail_tab WHERE (tstatus=1 OR tstatus=0) AND tid=' . $id);
		//print_r($this->db);die;
		return $this -> db -> get() -> result();
	}
	
	function __insert_retur_jk_detail($data) {
	//print_r($data);die;
        return $this -> db -> insert('transaction_detail_tab', $data);
	}
	function __insert_retur_jk_detailp($data) {
	//print_r($data);die;
        return $this -> db -> insert('trans_tab', $data);
	}

	
function __update_retur_jks($tid,$data) {

	        $this->db->where('tid', $tid);
			$sql=$this->db->update('transaction_tab', $data);	

	return $sql;

	}		
	
function __update_retur_jk_detailz($tid,$data) {

	        $this->db->where('tid', $tid);
			$sql=$this->db->update('transaction_detail_tab', $data);	

	return $sql;

	}	
	
	
	
	
	
	
	
	function __update_retur_jk_details($id) {

	$sql = $this -> db -> query("SELECT sum(tqty) as tqty,sum(tharga*tqty) as tharga,sum(ttotal)as ttotal,b.ttotaldisc 
	FROM transaction_detail_tab a, transaction_tab b WHERE a.ttid=b.tid AND a.ttid='$id' AND a.tstatus=1 group by ttid");
	$dt=$sql-> result();
	
	//print_r($dt);die;
	
	foreach($dt as $k => $v){
	$tqtyx=$v->tqty;
	$thargax=$v->tharga ;
	$ttotal=$v->ttotal;
	$tdiscx=$thargax-$ttotal;
	$ttx=$ttotal;
	
	echo "$tqtyx $thargax $tdiscx $ttx";//die;
	}

	return $this -> db-> query("UPDATE transaction_tab set ttotalqty='$tqtyx',ttotalharga='$thargax', ttotaldisc='$tdiscx',
	tgrandtotal='$ttx' WHERE tid='$id'");
	}	
	
	function __update_penjualan_approval1($id) {
		//echo "UPDATE transaction_tab set approval='1' WHERE tid='$id' ";die;
		$this -> db-> query("UPDATE transaction_detail_tab set approval='1' WHERE ttid='$id' ");
		return $this -> db-> query("UPDATE transaction_tab set approval='1' WHERE tid='$id' ");
	}		
	function __update_penjualan_approval2($id) {
		$this -> db-> query("UPDATE transaction_tab set approval='2' WHERE tid='$id' ");
		$this -> db-> query("UPDATE transaction_detail_tab set approval='2' WHERE ttid='$id' ");
		$sql = $this -> db -> query("SELECT sum(tqty) as tqty,sum(tharga*tqty) as tharga,sum(ttotal)as ttotal,
		b.ttotaldisc,a.tbid,b.tbid as bid,b.tcid as cid FROM transaction_detail_tab a, transaction_tab b 
		WHERE a.ttid=b.tid AND a.ttid='$id' group by a.tbid");
		
		// echo "SELECT sum(tqty) as tqty,sum(tharga*tqty) as tharga,sum(ttotal)as ttotal,b.ttotaldisc,a.tbid,b.tbid as bid,
		// b.tcid as cid FROM transaction_detail_tab a, transaction_tab b WHERE a.ttid=b.tid AND a.ttid='$id' group by a.tbid";		
		
		$dt=$sql-> result();
		//echo '<pre>';
		//print_r($dt);//die;
		foreach($dt as $k => $v){
			$tqtyx=$v->tqty;
			$tbidx=$v->tbid;//buku
			$bidx=$v->bid;//cabang
			$cidx=$v->cid;
	
			$this -> db-> query("UPDATE inventory_tab set istockin=(istockin+'$tqtyx'),istock=(istock+'$tqtyx') WHERE ibid='$tbidx' and ibcid='$bidx'and itype='1' ");
			//$this -> db-> query("UPDATE inventory_tab set istockretur=(istockretur+'$tqtyx'),istock=(istockbegining+istockin-istockretur-istockout) WHERE ibid='$tbidx' and ibcid='$cidx'and itype='2' ");
			$this -> db-> query("UPDATE inventory_tab set istockout=(istockout+'$tqtyx'),istock=(istock -'$tqtyx') WHERE ibid='$tbidx' and ibcid='$cidx'and itype='2' ");
		
		}
		
		//echo "xx";die;
		return TRUE;

	}		
	
	function __update_retur_jk_detail($id, $data) {
        $this -> db -> where('tid', $id);
        return $this -> db -> update('transaction_detail_tab', $data);
	}
	
	function __delete_retur_jk_detail($id,$idd) {
		$this -> db -> query('update transaction_detail_tab set tstatus=2 where tid=' . $id);
		$sql = $this -> db -> query("SELECT sum(tqty) as tqty,sum(tharga*tqty) as tharga,sum(ttotal)as ttotal,
		sum(a.tdisc) as ttotaldisc,a.tbid,b.tbid as bid,b.tcid as cid,b.tid as btid FROM transaction_detail_tab a, transaction_tab b
		WHERE a.ttid=b.tid AND b.tid='$idd' and a.tstatus!=2");
		$dt=$sql-> result();
		foreach($dt as $k => $v){
			$tqtyx=$v->tqty;
			$thargax=$v->tharga;
			$ttotalx=$v->ttotal;
			$ttotaldiscx=$v->ttotaldisc;
			$btid=$v->btid;

	
		}				

		return $this->db->query("update transaction_tab set ttotalqty='$tqtyx',ttotalharga='$thargax',
		ttotaldisc='$ttotaldiscx',tgrandtotal='$ttotalx' where tid='$btid'");
		
		
	}
}
