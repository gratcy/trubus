<?php
class inventory_publisher_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }
	
	function __get_inventory_search_detail($cid, $bid) {
		return 'SELECT a.iid,a.istockbegining,a.istockin,a.istockout,a.istockretur,a.istockreject,a.istock,a.istatus,b.bid,b.bcode,b.bprice,b.btitle FROM inventory_tab a LEFT JOIN books_tab b ON a.ibid=b.bid WHERE a.itype=1 AND (a.istatus=1 OR a.istatus=0) AND b.bstatus=1 AND a.ibcid='.$cid.' AND a.ibid IN ('.$bid.') ORDER BY a.iid DESC';
	}
	
	function __get_publisher($id,$type) {
		if ($type == 1) {
			return 'SELECT pid,pcode,pname,pstatus FROM publisher_tab WHERE pparent=0 AND pstatus=1 ORDER BY pid ASC';
		}
		else {
			$this -> db -> select('pid,pcode,pname,pstatus FROM publisher_tab WHERE pparent='.$id.' AND pstatus=1 ORDER BY pid ASC');
			return $this -> db -> get() -> result();
		}
	}
	
	function __get_publisher_search($keyword) {
		return "SELECT pid,pcode,pname,pstatus FROM publisher_tab WHERE (pstatus=1 OR pstatus=0) AND (pname LIKE '%".$keyword."%' OR pcode LIKE '%".$keyword."%' OR pdesc LIKE '%".$keyword."%') ORDER BY pparent ASC, pid ASC";
	}
	
	function __get_publisher_detail($id) {
		$this -> db -> select('* FROM publisher_tab WHERE (pstatus=1 OR pstatus=0) AND pid=' . $id);
		return $this -> db -> get() -> result();
	}

	function __export($bid,$pid) {
		$sql = $this -> db -> query(self::__get_inventory($bid,$pid));
		return $sql -> result();
	}

	function __get_inventory_publisher_detail($id) {
		$this -> db -> select('* FROM inventory_tab WHERE itype=1 AND (istatus=1 OR istatus=0) AND iid=' . $id);
		return $this -> db -> get() -> result();
	}
	
	function __get_inventory($bid,$pid) {
		return 'SELECT a.istockbegining,b.bid,b.bcode,b.bprice,b.btitle FROM inventory_tab a LEFT JOIN books_tab b ON a.ibid=b.bid WHERE a.itype=1 AND (a.istatus=1 OR a.istatus=0) AND ibcid='.$bid.' AND b.bstatus=1 AND b.bpublisher='.$pid.' ORDER BY a.iid DESC';
	}
	
	function __get_stockselling_publisher($branch,$bid) {
		$this -> db -> select("SUM(b.tqty) as total FROM transaction_tab a LEFT JOIN transaction_detail_tab b ON a.tid=b.ttid WHERE (a.tnofaktur LIKE 'HP%' OR a.tnofaktur LIKE 'JC%' AND a.tnofaktur NOT LIKE 'RHP%') AND b.tstatus=1 AND a.approval=2 AND a.tstatus=1 AND a.tbid=".$branch." and b.tbid=".$bid, FALSE);
		$data = $this -> db -> get() -> result();
		return (int) $data[0] -> total;
	}
	
	function __get_stockreturn($branch,$bid) {
		$this -> db -> select("SUM(b.tqty) as total FROM transaction_tab a LEFT JOIN transaction_detail_tab b ON a.tid=b.ttid WHERE a.tnofaktur LIKE 'RB%' AND b.tstatus=1 AND a.approval=2 AND a.tstatus=1 AND a.tbid=".$branch." and b.tbid=".$bid, FALSE);
		$data = $this -> db -> get() -> result();
		return (int) $data[0] -> total;
	}
}
