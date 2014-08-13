<?php
class Adjustment_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }
	
	function __get_adjustmentinventory() {
		return 'SELECT a.iid,ibid,a.istockbegining,a.istockin,a.istockout,a.istockreject,a.istockretur,a.istock,a.istatus,b.btitle,c.bname FROM inventory_tab a LEFT JOIN books_tab b ON a.ibid=b.bid LEFT JOIN branch_tab c ON a.ibcid=c.bid WHERE a.itype=1 AND a.istatus=1 ORDER BY a.iid DESC';
	}
	
	function __insert_adjustment($data) {
        return $this -> db -> insert('adjustment_tab', $data);
	}
}
