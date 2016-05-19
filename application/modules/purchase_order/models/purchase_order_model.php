<?php
class Purchase_order_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }
    
    function __get_purchase_order_select() {
		$this -> db -> select('tid,tnofaktur FROM transaction_tab WHERE ttype=5 and tstatus=1 ORDER BY tnofaktur ASC');
		return $this -> db -> get() -> result();
	}
	
	function __get_purchase_order() {
		if(!isset($_POST['cari'])){$_POST['cari']="";}
		if(!isset($_POST['no_po'])){$_POST['no_po']="";}
		if($_POST['cari']=='CARI'){
			$wcari=" AND tnofaktur LIKE '%$_POST[no_po]%' ";
		}else{$wcari="";}
		//echo $_POST['cari'].$wcari;die;
		return "SELECT *,(select gname from gudang_tab where gid=gd_to)as gname FROM transaction_tab WHERE  ttype='5'  and tstatus=1 $wcari ORDER BY tid DESC";
	}

	function __get_purchase_excel($date1,$date2,$tgid) {
		
		if($tgid!=""){
			
			$wgid=" AND a.gd_to='$tgid' ";
		}else{
			$wgid="";
		}
		$wcari=" AND ( a.ttanggal between '$date1' AND '$date2' ) ";
		$this -> db -> select(" a.*,b.*,(select gd.gname from gudang_tab gd where gd.gid=a.gd_to)as gname, 
		(select e.bname from branch_tab e where e.bid=a.tbid) as bname,
		(select e.baddr from branch_tab e where e.bid=a.tbid) as baddr,
		(select d.gaddress from gudang_tab d where d.gid=a.gd_to) as gaddress,
		(select d.gname from gudang_tab d where d.gid=a.gd_to) as gdto,(select c.btitle from books_tab c where c.bid=b.tbid)as btitle,
		(select c.bcode from books_tab c where c.bid=b.tbid)as bcode
		FROM transaction_tab a,transaction_detail_tab b WHERE
        a.tid=b.ttid  AND	ttype='5'  and a.tstatus=1 $wcari $wgid ORDER BY a.tid DESC");
		return $this -> db -> get() -> result();
	}

	
	function __get_total_purchase_order() {
		$sql = $this -> db -> query('SELECT * FROM transaction_tab WHERE tstatus=1');
		return $sql -> num_rows();
	}


	function __get_total_purchase_order_monthly($month,$year,$id,$tnofaktur) {
		$y=date('y');
		$m=date('M');
		$sql = $this -> db -> query("SELECT * FROM transaction_tab WHERE YEAR(ttanggal) = '$year' AND MONTH(ttanggal) = '$month' ");
		$jumm= $sql -> num_rows();
		$juma=1000+$jumm;
		$jum=substr($juma,1,3);
		$tnofakturnew=$tnofaktur.$jum;
		//echo $tnofakturnew;die;
		$sqlx=$this -> db -> query("UPDATE transaction_tab set tnofaktur='$tnofakturnew' WHERE tid='$id' ");
	}	




	
	function __get_purchase_order_detail($id) {
		$this -> db -> select('* FROM transaction_tab WHERE (tstatus=1 OR tstatus=0) AND tid=' . $id);
		return $this -> db -> get() -> result();
	}
	
	function __insert_purchase_order($data) {
        return $this -> db -> insert('transaction_tab', $data);
	}
	
	function __update_purchase_order($id, $data) {
        $this -> db -> where('tid', $id);
        return $this -> db -> update('transaction_tab', $data);
	}
	
	function __delete_purchase_order($id) {
		$this -> db -> query('DELETE FROM transaction_detail_tab WHERE ttid='.$id);
		return $this -> db -> query('update transaction_tab set tstatus=2 where tid=' . $id);
	}
}
