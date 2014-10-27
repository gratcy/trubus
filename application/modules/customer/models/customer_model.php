<?php
class Customer_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }
    
    function __get_suggestion() {
		$this -> db -> select('cid,cname as name FROM customer_tab WHERE (cstatus=1 OR cstatus=0) ORDER BY name ASC');
		$a =  $this -> db -> get() -> result();
		$this -> db -> select('cid,ccode as name FROM customer_tab WHERE (cstatus=1 OR cstatus=0) ORDER BY name ASC');
		$b = $this -> db -> get() -> result();
		return array_merge($a,$b);
	}
	
	function __get_customer_search($keyword, $ctype) {
		if ($ctype !== false) $ctype = ' AND a.ctype=' . $ctype;
		return "SELECT a.*,b.bname,c.bname as bgname,d.aname FROM customer_tab a LEFT JOIN branch_tab b ON a.cbid=b.bid LEFT JOIN books_group_tab c ON a.cgroup=c.bid LEFT JOIN area_tab d ON a.carea=d.aid WHERE (a.cstatus=1 OR a.cstatus=0) AND (cname='".$keyword."' OR ccode='".$keyword."')".$ctype." ORDER BY a.cid DESC";
	}
    
    function __get_customer_select() {
		$this -> db -> select('cid,cname FROM customer_tab WHERE (cstatus=1 OR cstatus=0) ORDER BY cname DESC');
		return $this -> db -> get() -> result();
	}

    function __get_customer_consinyasi_select() {
		$this -> db -> select('cid,cname FROM customer_tab WHERE (cstatus=1 OR cstatus=0) AND ctype=1  ORDER BY cname DESC');
		return $this -> db -> get() -> result();
	}
    
	function __get_customer($ctype) {
		if ($ctype !== false) $ctype = ' AND a.ctype=' . $ctype;
		return 'SELECT a.*,b.bname,c.bname as bgname,d.aname FROM customer_tab a LEFT JOIN branch_tab b ON a.cbid=b.bid LEFT JOIN books_group_tab c ON a.cgroup=c.bid LEFT JOIN area_tab d ON a.carea=d.aid WHERE (a.cstatus=1 OR a.cstatus=0)'.$ctype.' ORDER BY a.cid DESC';
	}

	function __get_customerx() {
		return 'SELECT a.*,b.bname,c.bname as bgname,d.aname FROM customer_tab a LEFT JOIN branch_tab b ON a.cbid=b.bid LEFT JOIN books_group_tab c ON a.cgroup=c.bid LEFT JOIN area_tab d ON a.carea=d.aid WHERE (a.cstatus=1 OR a.cstatus=0) ORDER BY a.cid DESC';
	}
	
	function __get_customer_detail($id) {
		$this -> db -> select('* FROM customer_tab WHERE (cstatus=1 OR cstatus=0) AND cid=' . $id);
		return $this -> db -> get() -> result();
	}
	
	function __get_customer_name($id) {
		$this -> db -> select('cname FROM customer_tab WHERE (cstatus=1 OR cstatus=0) AND cid=' . $id);
		$res = $this -> db -> get() -> result();
		return $res[0] -> cname;
	}
	
	function __insert_customer($data) {
        return $this -> db -> insert('customer_tab', $data);
	}
	
	function __update_customer($id, $data) {
        $this -> db -> where('cid', $id);
        return $this -> db -> update('customer_tab', $data);
	}
	
	function __delete_customer($id) {
		return $this -> db -> query('update customer_tab set cstatus=2 where cid=' . $id);
	}
}
