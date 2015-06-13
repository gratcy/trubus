<?php
class Inventory_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }
	
	function __get_inventory($bid="") {
		if ($bid != "") $bid = " AND a.ibcid=" . $bid;
		else $bid = "";
		return 'SELECT a.iid,a.ibid,a.ibcid,a.istockbegining,a.istockin,a.istockout,a.istockretur,a.istockreject,a.istock,a.istatus,b.btitle,c.bname FROM inventory_tab a LEFT JOIN books_tab b ON a.ibid=b.bid LEFT JOIN branch_tab c ON a.ibcid=c.bid WHERE b.bstatus=1 AND a.itype=1 AND (a.istatus=1 OR a.istatus=0)'.$bid.' ORDER BY a.iid DESC';
	}
	
	function __get_search($book,$bid="") {
		if ($bid != "") $bid = " AND a.ibcid=" . $bid;
		else $bid = "";
		return 'SELECT a.iid,a.ibid,a.ibcid,a.istockbegining,a.istockin,a.istockout,a.istockretur,a.istockreject,a.istock,a.istatus,b.btitle,c.bname FROM inventory_tab a LEFT JOIN books_tab b ON a.ibid=b.bid LEFT JOIN branch_tab c ON a.ibcid=c.bid WHERE a.ibid='.$book.' AND b.bstatus=1 AND a.itype=1 AND (a.istatus=1 OR a.istatus=0)'.$bid.' ORDER BY a.iid DESC';
	}

	function __get_inventory_customer_by_book($id_book) {
		$this -> db -> select('* FROM inventory_tab,customer_tab WHERE inventory_tab.ibcid=customer_tab.cid AND itype=2 AND (istatus=1 OR istatus=0) AND ibid=' . $id_book);
		return $this -> db -> get() -> result();
	}	
	
	function __get_book($id){
		$this -> db -> select('* FROM books_tab WHERE bid=' . $id);
			return $this -> db -> get() -> result();
	}
	
	function __get_inventory_detail($id) {
		$this -> db -> select('* FROM inventory_tab WHERE itype=1 AND (istatus=1 OR istatus=0) AND iid=' . $id);
		return $this -> db -> get() -> result();
	}
	
	
	function __get_inventory_detailx($id,$cid) {
		$this -> db -> select("* FROM transaction_tab a, transaction_detail_tab b WHERE a.tbid='$cid' AND a.tid=b.ttid and b.tbid='$id' AND ((a.ttype='2' AND a.ttypetrans='1') OR (a.ttype='2' AND a.ttypetrans='2') OR (a.ttype='2' AND a.ttypetrans='4'))");
		return $this -> db -> get() -> result();
	}
	
	function __insert_inventory($data) {
        return $this -> db -> insert('inventory_tab', $data);
	}
	
	function __update_inventory($id, $data) {
        $this -> db -> where('iid', $id);
        return $this -> db -> update('inventory_tab', $data);
	}
	
	function __delete_inventory($id) {
		return $this -> db -> query('update inventory_tab set istatus=2 where itype=1 AND iid=' . $id);
	}
}
