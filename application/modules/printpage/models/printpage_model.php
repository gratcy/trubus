<?php
class Printpage_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }
    
	function __get_books_detail($id) {
		$this -> db -> select('a.*,b.pname,c.cname FROM books_tab a LEFT JOIN publisher_tab b ON a.bpublisher=b.pid LEFT JOIN categories_tab c ON a.bcid=c.cid WHERE (a.bstatus=1 OR a.bstatus=0) AND a.bid=' . $id);
		return $this -> db -> get() -> result();
	}
	
	function __get_branch_head($id) {
		$this -> db -> select('bhname from branch_tab where bid=' . $id);
		return $this -> db -> get() -> result();
	}
	
	function __get_oplah($id,$branch) {
		$this -> db -> select('istock from inventory_tab where itype=1 AND ibcid='.$branch.' AND istatus=1 AND ibid=' . $id);
		return $this -> db -> get() -> result();
	}
	
	function __get_customer($id) {
		$this -> db -> select('a.cname,a.caddr,a.cphone,a.cemail,b.cname as city,c.pname from customer_tab a left join city_tab b ON a.ccity=b.cid LEFT JOIN province_tab c ON a.cprovince=c.pid where a.cid=' . $id);
		return $this -> db -> get() -> result();
	}
}
