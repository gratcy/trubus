<?php
class Opname_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }
	
	function __get_opnameinventory($bid) {
		return 'SELECT a.iid,ibid,a.istockbegining,a.istockin,a.istockout,a.istockreject,a.istockretur,a.istock,a.istatus,b.btitle,c.bname FROM inventory_tab a LEFT JOIN books_tab b ON a.ibid=b.bid LEFT JOIN branch_tab c ON a.ibcid=c.bid WHERE a.itype=1 AND a.istatus=1 AND a.ibcid='.$bid.' ORDER BY a.iid DESC';
	}
	
	function __get_opnameinventory_detail($id) {
		$this -> db -> select('* FROM inventory_tab WHERE itype=1 AND istatus=1 AND iid=' . $id);
		return $this -> db -> get() -> result();
	}
	
	function __insert_opname($data) {
        return $this -> db -> insert('opname_tab', $data);
	}
	
	function __get_search($keyword,$bid) {
		return 'SELECT a.iid,ibid,a.istockbegining,a.istockin,a.istockout,a.istockreject,a.istockretur,a.istock,a.istatus,b.btitle,c.bname FROM inventory_tab a LEFT JOIN books_tab b ON a.ibid=b.bid LEFT JOIN branch_tab c ON a.ibcid=c.bid WHERE a.itype=1 AND a.ibid='.$keyword.' AND a.istatus=1 AND a.ibcid='.$bid.' ORDER BY a.iid DESC';
	}
}
