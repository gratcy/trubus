<?php
class penjualan_kredit_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }
    
    function __get_penjualan_kredit_select() {
		$this -> db -> select('hid,bname FROM transaction_tab WHERE tstatus=1 ORDER BY bname ASC');
		return $this -> db -> get() -> result();
	}
	
	function __get_penjualan_kredit() {
		return "SELECT * FROM transaction_tab WHERE (tstatus='1' OR tstatus='0') AND ttype='1' AND ttypetrans='2' ORDER BY tid DESC";
	}
	
	function __get_total_penjualan_kredit() {
		$sql = $this -> db -> query('SELECT * FROM transaction_tab WHERE tstatus=1');
		return $sql -> num_rows();
	}
	
	function __get_penjualan_kredit_detail($id) {
		$this -> db -> select('* FROM transaction_tab WHERE (tstatus=1 OR tstatus=0) AND hid=' . $id);
		return $this -> db -> get() -> result();
	}
	
	function __insert_penjualan_kredit($data) {
        return $this -> db -> insert('transaction_tab', $data);
	}
	
	function __update_penjualan_kredit($id, $data) {
        $this -> db -> where('hid', $id);
        return $this -> db -> update('transaction_tab', $data);
	}
	
	function __delete_penjualan_kredit($id) {
		return $this -> db -> query('update transaction_tab set tstatus=2 where hid=' . $id);
	}
}
