<?php
class Opname_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }
	
	function __get_opnameinventory() {
		return 'SELECT a.iid,ibid,a.istockbegining,a.istockin,a.istockout,a.istockreject,a.istock,a.istatus,b.btitle,c.bname FROM inventory_tab a LEFT JOIN books_tab b ON a.ibid=b.bid LEFT JOIN branch_tab c ON a.ibcid=c.bid WHERE a.itype=1 AND a.istatus=1 ORDER BY a.iid DESC';
	}
	
	function __get_opnameinventory_detail($id) {
		$this -> db -> select('* FROM inventory_tab WHERE itype=1 AND istatus=1 AND iid=' . $id);
		return $this -> db -> get() -> result();
	}
	
	function __insert_opname($data) {
        return $this -> db -> insert('opname_tab', $data);
	}
}
