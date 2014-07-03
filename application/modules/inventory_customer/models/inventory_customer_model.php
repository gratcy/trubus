<?php
class Inventory_customer_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }
	
	function __get_inventory($cid) {
		return 'SELECT a.iid,a.ibid,a.istockbegining,a.istockin,a.istockout,a.istockreject,a.istock,a.istatus,b.btitle,c.cid,c.cname FROM inventory_tab a LEFT JOIN books_tab b ON a.ibid=b.bid LEFT JOIN customer_tab c ON a.ibcid=c.cid WHERE a.itype=2 AND (a.istatus=1 OR a.istatus=0) AND a.ibcid='.$cid.' ORDER BY a.iid DESC';
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
}
