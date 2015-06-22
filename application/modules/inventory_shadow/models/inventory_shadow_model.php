<?php
class inventory_shadow_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }
	
	function __get_inventory_shadow($bid="") {
		if ($bid != "") $bid = " AND a.ibcid=" . $bid;
		else $bid = "";
		return 'SELECT a.iid,a.ibid,a.ibcid,a.istockbegining,a.istockin,a.istockout,a.istockretur,a.istockreject,a.istock,a.istatus,b.btitle,(select sum(c.tqty) from transaction_detail_tab c  where c.approval<2 AND c.tbid=a.ibid ) as tqty FROM inventory_shadow_tab a LEFT JOIN books_tab b ON a.ibid=b.bid WHERE (a.istatus=1 OR a.istatus=0)'.$bid.' ORDER BY a.iid DESC';
	}
	
	function __get_search($book, $bid="") {
		if ($bid != "") $bid = " AND a.ibcid=" . $bid;
		else $bid = "";
		return 'SELECT a.iid,a.ibid,a.ibcid,a.istockbegining,a.istockin,a.istockout,a.istockretur,a.istockreject,a.istock,a.istatus,b.btitle,(select sum(c.tqty) from transaction_detail_tab c  where c.approval<2 AND c.tbid=a.ibid ) as tqty FROM inventory_shadow_tab a LEFT JOIN books_tab b ON a.ibid=b.bid WHERE (a.istatus=1 OR a.istatus=0) AND a.ibid='.$book.''.$bid.' ORDER BY a.iid DESC';
	}

	function __get_inventory_shadow_customer_by_book($id_book) {
		$this -> db -> select('* FROM inventory_shadow_tab,customer_tab WHERE inventory_shadow_tab.ibcid=customer_tab.cid AND (istatus=1 OR istatus=0) AND ibid=' . $id_book);
		return $this -> db -> get() -> result();
	}	
	
	function __get_book($id){
		$this -> db -> select('* FROM books_tab WHERE bid=' . $id);
			return $this -> db -> get() -> result();
	}
	
	function __get_inventory_shadow_detail($id) {
		$this -> db -> select('* FROM inventory_shadow_tab WHERE (istatus=1 OR istatus=0) AND iid=' . $id);
		return $this -> db -> get() -> result();
	}
	
	function __get_inventory_shadow_detailx($id,$cid) {
		$this -> db -> select("* FROM transaction_tab a, transaction_detail_tab b WHERE a.tbid='$cid' AND a.tid=b.ttid and b.tbid='$id' AND ((a.ttype='2' AND a.ttypetrans='1') OR (a.ttype='2' AND a.ttypetrans='2') OR (a.ttype='2' AND a.ttypetrans='4'))");
		return $this -> db -> get() -> result();
	}
	
	function __insert_inventory_shadow($data) {
        return $this -> db -> insert('inventory_shadow_tab', $data);
	}
	
	function __update_inventory_shadow($id, $data) {
        $this -> db -> where('iid', $id);
        return $this -> db -> update('inventory_shadow_tab', $data);
	}
	
	function __delete_inventory_shadow($id) {
		return $this -> db -> query('update inventory_shadow_tab set istatus=2 AND iid=' . $id);
	}
	
	function __get_stock_process($bcid,$bid) {
		$this -> db -> select('sum(b.tqty) as total from transaction_tab a LEFT JOIN transaction_detail_tab b ON a.tid=b.ttid where a.tbid='.$bcid.' AND b.approval<2 AND b.tbid=' . $bid);
		return $this -> db -> get() -> result();
	}
}
