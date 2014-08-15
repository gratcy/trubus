<?php
class Inventory_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }
	
	function __get_inventory() {
	//a.ibcid = c.bid --->BRANCH
	//a.ibid=b.bid --->BUKU
		return 'SELECT a.iid,ibid,a.istockbegining,a.istockin,a.istockout,a.istockretur,a.istockreject,a.istock,a.istatus,b.btitle,c.bname FROM inventory_tab a LEFT JOIN books_tab b ON a.ibid=b.bid LEFT JOIN branch_tab c ON a.ibcid=c.bid WHERE a.itype=1 AND (a.istatus=1 OR a.istatus=0) ORDER BY a.iid DESC';
	}

	function __get_inventory_customer_by_book($id_book) {
		$this -> db -> select('* FROM inventory_tab,customer_tab WHERE inventory_tab.ibcid=customer_tab.cid AND itype=2 AND (istatus=1 OR istatus=0) AND ibid=' . $id_book);
		return $this -> db -> get() -> result();
	}	
	

	
	function __get_inventory_detail($id) {
		$this -> db -> select('* FROM inventory_tab WHERE itype=1 AND (istatus=1 OR istatus=0) AND iid=' . $id);
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
