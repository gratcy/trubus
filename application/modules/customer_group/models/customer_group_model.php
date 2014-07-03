<?php
class Customer_group_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }
    
    function __get_customer_group_select() {
		$this -> db -> select('cgid,cgname FROM customer_group_tab WHERE cgstatus=1 ORDER BY cgname ASC');
		return $this -> db -> get() -> result();
	}
	
	function __get_customer_group() {
		return 'SELECT * FROM customer_group_tab WHERE (cgstatus=1 OR cgstatus=0) ORDER BY cgname DESC';
	}
	
	function __get_customer_group_detail($id) {
		$this -> db -> select('* FROM customer_group_tab WHERE (cgstatus=1 OR cgstatus=0) AND cgid=' . $id);
		return $this -> db -> get() -> result();
	}
	
	function __insert_customer_group($data) {
        return $this -> db -> insert('customer_group_tab', $data);
	}
	
	function __update_customer_group($id, $data) {
        $this -> db -> where('cgid', $id);
        return $this -> db -> update('customer_group_tab', $data);
	}
	
	function __delete_customer_group($id) {
		return $this -> db -> query('update customer_group_tab set cgstatus=2 where cgid=' . $id);
	}
}
