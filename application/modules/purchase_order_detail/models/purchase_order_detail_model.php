<?php
class Purchase_order_detail_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }
    
    function __get_purchase_order_detail_select() {
		$this -> db -> select('bid,bname FROM purchase_order_tab WHERE pstatus=1 ORDER BY bname ASC');
		return $this -> db -> get() -> result();
	}
	
	// function __get_purchase_order_detail() {
		// return 'SELECT * FROM purchase_order_tab WHERE (pstatus=1 OR pstatus=0) ORDER BY pid DESC';
	// }
	
	function __get_total_purchase_order_detail() {
		$sql = $this -> db -> query('SELECT * FROM purchase_order_tab WHERE pstatus=1');
		return $sql -> num_rows();
	}
	
	function __get_purchase_order_detail($id) {
	
		$this -> db -> select('* FROM purchase_order_detail_tab WHERE (pstatus=1 OR pstatus=0) AND ppid=' . $id);
		return $this -> db -> get() -> result();
	}
	
	function __insert_purchase_order_detail($data) {
        return $this -> db -> insert('purchase_order_detail_tab', $data);
	}
	
	function __update_purchase_order_detail($id, $data) {
        $this -> db -> where('pid', $id);
        return $this -> db -> update('purchase_order_detail_tab', $data);
	}
	
	function __delete_purchase_order_detail($id) {
		return $this -> db -> query('update purchase_order_tab set pstatus=2 where pid=' . $id);
	}
}
