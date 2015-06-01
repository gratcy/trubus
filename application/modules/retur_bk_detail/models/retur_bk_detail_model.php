<?php
class retur_bk_detail_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }
    
    function __get_retur_bk_detail_select() {
		$this -> db -> select('a.tid,tnofaktur FROM transaction_tab a,transaction_detail_tab b WHERE tstatus=1  AND a.tid=b.ttid ORDER BY a.tid ASC');
		return $this -> db -> get() -> result();
	}
	
	function __get_retur_bk_detail($id) {

		return "SELECT *,
		(select ccode from customer_tab d where d.cid=a.tcid)as ccode,
		(select cname from customer_tab d where d.cid=a.tcid)as cname,
		(select caddr from customer_tab d where d.cid=a.tcid)as caddr,
        (select bcode from books_tab c where c.bid=b.tbid)as bcode,
		(select btitle from books_tab c where c.bid=b.tbid)as btitle
		FROM transaction_tab a, transaction_detail_tab b 
		WHERE (a.tstatus='1' OR a.tstatus='0') AND a.ttype='3' 
		AND ttypetrans='4'  AND a.tid=b.ttid AND a.tid='$id' ORDER BY b.tid DESC";
	}
	
	function __update_penjualan_stok($id){
		//$id=10;
		//echo $id;die;
		$this -> db-> query("UPDATE transaction_tab set approval='2' WHERE tid='$id' ");
		$this -> db-> query("UPDATE transaction_detail_tab set approval='2' WHERE ttid='$id' ");
		$sql = $this -> db -> query("SELECT sum(tqty) as tqty,sum(tharga*tqty) as tharga,sum(ttotal)as ttotal,b.ttotaldisc,a.tbid,b.tbid as bid,
(select (select pcategory from publisher_tab c where c.pid=d.bpublisher)from books_tab d where d.bid=a.tbid)as cat
FROM transaction_detail_tab a, transaction_tab b WHERE a.ttid=b.tid AND a.ttid='$id' group by a.tbid
");		




		$dt=$sql-> result();
		foreach($dt as $k => $v){
			
			//print_r($dt);
			$tqtyx=$v->tqty;
			$tbidx=$v->tbid;
			$bidx=$v->bid;
	
			$this -> db-> query("UPDATE inventory_tab set istockretur=(istockretur+'$tqtyx'),istock=(istockbegining+istockin+istockreject+istockretur-istockout) WHERE ibid='$tbidx' and ibcid='$bidx' and itype='1' ");
		}
		
		//echo "xx";die;
		return TRUE;


		
	}
	

	
	
	

	function __get_retur_bk_detailxx($id) {
		$sql=$this -> db -> query( 'SELECT *,(select cname from customer_tab b where b.cid=a.tcid)as cname FROM transaction_tab a WHERE (a.tstatus=1 OR a.tstatus=0) 
		AND ttype=3 AND ttypetrans=4  AND a.tid=' . $id .'');
		return $sql-> result();
	}
	
	function __get_total_retur_bk_detail() {
		$sql = $this -> db -> query('SELECT * FROM transaction_detail_tab WHERE (tstatus=1 OR tstatus=0)');
		return $sql -> num_rows();
	}
	
	function __get_retur_bk_detail_detail($id) {
		$this -> db -> select('* FROM transaction_detail_tab WHERE (tstatus=1 OR tstatus=0) AND tid=' . $id);
		return $this -> db -> get() -> result();
	}
	
	function __insert_retur_bk_detail($data) {
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
	
	
	
	
	
	
	
	
	
	function __update_retur_bk_details($id) {
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
	
	function __update_retur_bk($id, $data) {
        $this -> db -> where('tid', $id);
        return $this -> db -> update('transaction_tab', $data);
	}

	function __update_retur_bk_detail($tid, $data) {

        $this -> db -> where('tid', $tid);
        return $this -> db -> update('transaction_detail_tab', $data);
	}
	
	function __delete_retur_bk_detail($id) {
		return $this -> db -> query('delete from transaction_detail_tab  where tid=' . $id);
	}
}
