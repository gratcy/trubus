<?php
class Opnamecustomer_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }
	
	function __insert_opnamecustomer($data) {
        return $this -> db -> insert('opname_tab', $data);
	}
    
	function __get_customer($ctype=1,$bid) {
		if ($ctype) $ctype = ' AND a.ctype=1';
		return 'SELECT a.*,b.bname,c.bname as bgname,d.aname FROM customer_tab a LEFT JOIN branch_tab b ON a.cbid=b.bid LEFT JOIN books_group_tab c ON a.cgroup=c.bid LEFT JOIN area_tab d ON a.carea=d.aid WHERE a.cbid='.$bid.' AND a.cstatus=1'.$ctype.' ORDER BY a.cid DESC';
	}
	
	function __get_opname_inventory($cid) {
		return 'SELECT a.iid,a.ibid,a.istockbegining,a.istockin,a.istockout,a.istockreject,a.istockretur,a.istock,a.istatus,b.btitle,c.cid,c.cname FROM inventory_tab a LEFT JOIN books_tab b ON a.ibid=b.bid LEFT JOIN customer_tab c ON a.ibcid=c.cid WHERE a.itype=2 AND a.istatus=1 AND a.ibcid='.$cid.' ORDER BY a.iid DESC';
	}
	
	function __get_opname_inventory_customer_detail($id) {
		$this -> db -> select('* FROM inventory_tab WHERE itype=2 AND istatus=1 AND iid=' . $id);
		return $this -> db -> get() -> result();
	}
    
	function __get_search($keyword,$ctype=1) {
		if ($ctype) $ctype = ' AND a.ctype=1';
		return "SELECT a.*,b.bname,c.bname as bgname,d.aname FROM customer_tab a LEFT JOIN branch_tab b ON a.cbid=b.bid LEFT JOIN books_group_tab c ON a.cgroup=c.bid LEFT JOIN area_tab d ON a.carea=d.aid WHERE (a.cname LIKE '%".$keyword."%' OR a.ccode LIKE '%".$keyword."%') AND a.cstatus=1".$ctype." ORDER BY a.cid DESC";
	}
}
