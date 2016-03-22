<?php
class Inventory_customer_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }
	
	function __get_inventory_search_detail($cid, $bid) {
		return 'SELECT a.iid,a.ibid,a.istockbegining,a.istockin,a.istockout,a.istockretur,a.istockreject,a.istock,a.istatus,b.bcode,b.bprice,b.btitle FROM inventory_tab a LEFT JOIN books_tab b ON a.ibid=b.bid WHERE a.itype=2 AND (a.istatus=1 OR a.istatus=0) AND b.bstatus=1 AND a.ibcid='.$cid.' AND a.ibid IN ('.$bid.') ORDER BY a.iid DESC';
	}
	
	function __get_inventory($cid) {
		return 'SELECT a.iid,a.ibid,a.istockbegining,a.istockin,a.istockout,a.istockretur,a.istockreject,a.istock,a.istatus,b.bcode,b.bprice,b.btitle FROM inventory_tab a LEFT JOIN books_tab b ON a.ibid=b.bid WHERE a.itype=2 AND (a.istatus=1 OR a.istatus=0) AND b.bstatus=1 AND a.ibcid='.$cid.' ORDER BY a.iid DESC';
	}
	
	function __get_customer($ctype=1,$bid) {
		$ctype = ' AND a.ctype=' . $ctype;
		return 'SELECT a.*,b.bname,d.acode,d.aname FROM customer_tab a LEFT JOIN branch_tab b ON a.cbid=b.bid LEFT JOIN area_tab d ON a.carea=d.aid WHERE a.cbid='.$bid.' AND a.cstatus=1'.$ctype.' ORDER BY a.cid DESC';
	}

	function __export($cid) {
		$sql = $this -> db -> query(self::__get_inventory($cid));
		return $sql -> result();
	}

	function __get_inventory_customer_detail($id) {
		$this -> db -> select('* FROM inventory_tab WHERE itype=2 AND (istatus=1 OR istatus=0) AND iid=' . $id);
		return $this -> db -> get() -> result();
	}
	
	function __insert_inventory_customer($data) {
        return $this -> db -> insert('inventory_tab', $data);
	}
	
	function __update_inventory_customer($id, $data) {
        $this -> db -> where('iid', $id);
        return $this -> db -> update('inventory_tab', $data);
	}
	
	function __delete_inventory($id) {
		return $this -> db -> query('update inventory_tab set istatus=2 where itype=2 AND iid=' . $id);
	}
	
	function __get_stock_process($bcid,$bid) {
		$this -> db -> select("sum(b.tqty) as total from transaction_tab a LEFT JOIN transaction_detail_tab b ON a.tid=b.ttid where (a.tnofaktur LIKE 'JK%' OR a.tnofaktur LIKE 'RHP%') AND a.tcid=".$bcid." AND b.tbid=".$bid." AND a.approval<2 AND a.tstatus != 2 AND b.tstatus != 2");
		$tr = $this -> db -> get() -> result();
		
		$this -> db -> select("sum(b.tqty) as total from transaction_tab a LEFT JOIN transaction_detail_tab b ON a.tid=b.ttid where (a.tnofaktur LIKE 'RJK%' OR a.tnofaktur LIKE 'HP%') AND a.tcid=".$bcid." AND b.tbid=".$bid." AND a.approval<2 AND a.tstatus != 2 AND b.tstatus != 2");
		$tr2 = $this -> db -> get() -> result();
		
		return $tr[0] -> total - $tr2[0] -> total;
	}
}
