<?php
class sales_order_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }
    
    function __get_sales_order_select() {
		$this -> db -> select('bid,bname FROM sales_order_tab WHERE pstatus=1 ORDER BY bname ASC');
		return $this -> db -> get() -> result();
	}
	
	function __get_sales_order() {
		return 'SELECT * FROM sales_order_tab WHERE (pstatus=1 OR pstatus=0) ORDER BY pid DESC';
	}
	
	function __get_total_sales_order() {
		$sql = $this -> db -> query('SELECT * FROM sales_order_tab WHERE pstatus=1');
		return $sql -> num_rows();
	}
	
	function __get_sales_order_detail($id) {
		$this -> db -> select('* FROM sales_order_tab WHERE (pstatus=1 OR pstatus=0) AND pid=' . $id);
		return $this -> db -> get() -> result();
	}
	
	function __insert_sales_order($data) {
        return $this -> db -> insert('sales_order_tab', $data);
	}
	
	function __update_sales_order($id, $data) {
        $this -> db -> where('pid', $id);
        return $this -> db -> update('sales_order_tab', $data);
	}
	
	function __delete_sales_order($id) {
		return $this -> db -> query('update sales_order_tab set pstatus=2 where pid=' . $id);
	}
}
