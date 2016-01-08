<?php
class penjualan_kredit_detail_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }
    
    function __get_penjualan_kredit_detail_select() {
		$this -> db -> select('a.tid,tnofaktur FROM transaction_tab a,transaction_detail_tab b WHERE tstatus=1  AND a.tid=b.ttid ORDER BY a.tid ASC');
		return $this -> db -> get() -> result();
	}
	
	function __get_penjualan_kredit_detail($id,$type=1) {
		$sql = "SELECT b.tid,a.tnofaktur as tnofaktur,a.ttanggal,a.approval,a.tinfo,a.ttotalharga,
		a.ttotaldisc,a.tgrandtotal,a.tinvid,a.tsbayar,		
		b.tqty as tqty,b.tharga as tharga,b.tdisc as tdisc,b.ttotal as ttotal,b.tstatus as tstatus, (select ccode from customer_tab d where d.cid=a.tcid)as ccode,(select cname from customer_tab d where d.cid=a.tcid)as cname,(select caddr from customer_tab d where d.cid=a.tcid)as caddr,(select bcode from books_tab c where c.bid=b.tbid and c.bstatus=1 )as bcode,(select btitle from books_tab c where c.bid=b.tbid and c.bstatus=1 )as btitle FROM transaction_tab a, transaction_detail_tab b WHERE (a.tstatus='1' OR a.tstatus='0') AND ttype='2' AND ttypetrans='2'  AND a.tid=b.ttid AND a.tid='$id' ORDER BY b.tid ASC";
		if ($type == 1) {
			return $sql;
		}
		else {
			$sql = $this -> db -> query($sql);
			return $sql -> result();
		}
	}

	function __get_penjualan_kredit_detailxx($id) {
		$sql=$this -> db -> query( 'SELECT *,(select cname from customer_tab b where b.cid=a.tcid)as cname,
        (select cdisc from customer_tab b where b.cid=a.tcid)as cdisc FROM transaction_tab a WHERE (a.tstatus=1 OR a.tstatus=0) AND ttype=2 AND ttypetrans=2   AND a.tid=' . $id .'');
		return $sql-> result();
	}
	
	function __get_total_penjualan_kredit_detail() {
		$sql = $this -> db -> query('SELECT * FROM transaction_detail_tab WHERE (tstatus=1 OR tstatus=0)');
		return $sql -> num_rows();
	}
	
	function __get_penjualan_kredit_detail_detail($id) {
		$this -> db -> select('* FROM transaction_detail_tab WHERE (tstatus=1 OR tstatus=0) AND tid=' . $id);
		//print_r($this->db);die;
		return $this -> db -> get() -> result();
	}
	
	function __insert_penjualan_kredit_detail($data,$pcat) {
	$tqt=$data['tqty'];
	$tbid=$data['tbid'];
	$branchid=$this -> memcachedlib -> sesresult['ubranchid'];
		if(($branchid==1)AND($pcat==2)){
			$this -> db-> query("UPDATE inventory_tab set ishadow=(ishadow-'$tqt')  WHERE ibid='$tbid' ");
		}
		return $this -> db -> insert('transaction_detail_tab', $data);
	}
	// function __insert_penjualan_kredit_detailp($data) {
        // return $this -> db -> insert('trans_tab', $data);
	// }

	
	function __update_penjualan_kredits($tid,$data) {
		$this->db->where('tid', $tid);
		$sql=$this->db->update('transaction_tab', $data);
		return $sql;
	}		
	
	function __update_penjualan_kredit_detailz($tid,$data) {

	        $this->db->where('tid', $tid);
			$sql=$this->db->update('transaction_detail_tab', $data);	

	return $sql;

	}	

	
	function __update_penjualan_kredit_details($id) {

	$sql = $this -> db -> query("SELECT sum(tqty) as tqty,sum(tharga*tqty) as tharga,sum(ttotal)as ttotal,b.ttotaldisc FROM transaction_detail_tab a, transaction_tab b WHERE a.ttid=b.tid AND a.ttid='$id' group by ttid");
	$dt=$sql-> result();
	foreach($dt as $k => $v){
	$tqtyx=$v->tqty;
	$thargax=$v->tharga ;
	$ttotal=$v->ttotal;
	$tdiscx=$thargax-$ttotal;
	$ttx=$ttotal;
	
	echo "$tqtyx $thargax $tdiscx $ttx";
	}

	return $this -> db-> query("UPDATE transaction_tab set ttotalqty='$tqtyx',ttotalharga='$thargax', ttotaldisc='$tdiscx',tgrandtotal='$ttx' WHERE tid='$id' ");
	}	
	
	function __update_penjualan_approval1($id) {
		$this -> db-> query("UPDATE transaction_detail_tab set approval='1' WHERE ttid='$id' ");
		return $this -> db-> query("UPDATE transaction_tab set approval='1' WHERE tid='$id' ");
	}
	
	function __update_penjualan_approval2($id) {
		$this -> db-> query("UPDATE transaction_tab set approval='2' WHERE tid='$id' ");
		$this -> db-> query("UPDATE transaction_detail_tab set approval='2' WHERE ttid='$id' ");
		$sql = $this -> db -> query("SELECT sum(tqty) as tqty,sum(tharga*tqty) as tharga,sum(ttotal)as ttotal,b.ttotaldisc,a.tbid,b.tbid as bid,
		(select (select pcategory from publisher_tab c where c.pid=d.bpublisher)from books_tab d where d.bid=a.tbid)as cat
		FROM transaction_detail_tab a, transaction_tab b WHERE a.ttid=b.tid AND a.ttid='$id' group by a.tbid
		");

		$dt=$sql-> result();
		foreach($dt as $k => $v) {
			$tqtyx=$v->tqty;
			$tbidx=$v->tbid;
			$bidx=$v->bid;
			$cattx=$v->cat;			

			// if(($cattx==2)AND($bidx=='1')){
								
				// $this -> db-> query("UPDATE inventory_tab set istockout=(istockout+'$tqtyx'),istock=(istockbegining+istockin-istockretur-istockout) ,ishadow=(ishadow-'$tqtyx') WHERE ibid='$tbidx' and ibcid='1' and itype='1'");	
					
				// }
				// else{
				
				// $this -> db-> query("UPDATE inventory_tab set istockout=(istockout+'$tqtyx'), istock=(istockbegining+istockin-istockretur-istockout) WHERE ibid='$tbidx' and ibcid='$bidx' and itype='1' ");
			// }	

			$this -> db-> query("UPDATE inventory_tab set istockout=(istockout+'$tqtyx'), istock=(istockbegining+istockin-istockretur-istockout) WHERE ibid='$tbidx' and ibcid='$bidx' and itype='1' ");			
			

			
		}
		return TRUE;
	}		
	
	function __update_penjualan_kredit_detail($id, $data) {
        $this -> db -> where('tid', $id);
        return $this -> db -> update('transaction_detail_tab', $data);
	}
	
	function __delete_penjualan_kredit_detail($id) {
		return $this -> db -> query('delete from transaction_detail_tab  where tid=' . $id);
	}
}
