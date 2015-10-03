<?php
class Customer_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }
    
    function __get_last_customer_by_area($id) {
		$this -> db -> select('SUBSTRING(ccode,4) as lastcode FROM customer_tab WHERE carea='.$id.' AND cstatus=1 ORDER BY ccode DESC LIMIT 1', FALSE);
		return $this -> db -> get() -> result();
	}
    
    function __get_suggestion($bid) {
		$this -> db -> select('cid,cname as name FROM customer_tab WHERE (cstatus=1 OR cstatus=0) AND cbid='.$bid.' ORDER BY name ASC');
		$a =  $this -> db -> get() -> result();
		$this -> db -> select('cid,ccode as name FROM customer_tab WHERE (cstatus=1 OR cstatus=0) AND cbid='.$bid.' ORDER BY name ASC');
		$b = $this -> db -> get() -> result();
		return array_merge($a,$b);
	}
	
	function __get_customer_search($keyword, $ctype, $bid) {
		if ($ctype !== false) $ctype = ' AND a.ctype=' . $ctype;
		return "SELECT a.*,b.bname,d.aname FROM customer_tab a LEFT JOIN branch_tab b ON a.cbid=b.bid LEFT JOIN area_tab d ON a.carea=d.aid WHERE (a.cstatus=1 OR a.cstatus=0) AND a.cbid=".$bid." AND (LOWER(cname) LIKE '%".$keyword."%' OR LOWER(ccode) LIKE '%".$keyword."%')".$ctype." ORDER BY a.cid DESC";
	}
    
    function __get_customer_select($bid) {
		$this -> db -> select('cid,cname FROM customer_tab WHERE (cstatus=1 OR cstatus=0) AND cbid='.$bid.' ORDER BY cname DESC');
		return $this -> db -> get() -> result();
	}

    function __get_customer_consinyasi_select($bid) {
		$this -> db -> select('cid,cname FROM customer_tab WHERE (cstatus=1 OR cstatus=0) AND cbid='.$bid.' AND ctype=1  ORDER BY cname DESC');
		return $this -> db -> get() -> result();
	}
    
	function __get_customer($bid="") {
		if ($bid != "") $bid = " AND a.cbid=" . $bid;
		else $bid = "";
		return 'SELECT a.*,b.bname,d.aname FROM customer_tab a LEFT JOIN branch_tab b ON a.cbid=b.bid LEFT JOIN area_tab d ON a.carea=d.aid WHERE (a.cstatus=1 OR a.cstatus=0)'.$bid.' ORDER BY a.cid DESC';
	}
	
	function __export_data($bid) {
		$sql = $this -> db -> query(self::__get_customer($bid));
		return $sql -> result_array(); 
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
	
	function __get_customer_tax($id) {
		$this -> db -> select('ctax FROM customer_tab WHERE (cstatus=1 OR cstatus=0) AND cid=' . $id);
		return $this -> db -> get() -> result();
	}
}
