<?php
class Customers_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }
    
    function __get_suggestion() {
		$this -> db -> select('cid,cname as name FROM customers_tab WHERE (cstatus=1 OR cstatus=0) ORDER BY name ASC');
		$a =  $this -> db -> get() -> result();
		$this -> db -> select('cid,ccode as name FROM customers_tab WHERE (cstatus=1 OR cstatus=0) ORDER BY name ASC');
		$b = $this -> db -> get() -> result();
		return array_merge($a,$b);
	}
    
	function __get_customers() {
		return 'SELECT a.*,b.bname FROM customers_tab a left join branch_tab b ON a.cbid=b.bid WHERE (a.cstatus=1 or a.cstatus=0) ORDER BY cid DESC';
	}
    
	function __get_recent_customers() {
		$this -> db -> select('a.*,b.bname FROM customers_tab a left join branch_tab b ON a.cbid=b.bid WHERE (a.cstatus=1 or a.cstatus=0) ORDER BY cid DESC LIMIT 0,5', FALSE);
		return $this -> db -> get() -> result();
	}
	
	function __get_customers_detail($id) {
		$this -> db -> select('* FROM customers_tab WHERE (cstatus=1 OR cstatus=0) AND cid=' . $id);
		return $this -> db -> get() -> result();
	}
	
	function __insert_customers($data) {
        return $this -> db -> insert('customers_tab', $data);
	}
	
	function __update_customers($id, $data) {
        $this -> db -> where('cid', $id);
        return $this -> db -> update('customers_tab', $data);
	}
	
	function __delete_customers($id) {
		return $this -> db -> query('update customers_tab set cstatus=2 where cid=' . $id);
	}
}
