<?php
class penjualan_konsinyasi_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }
    
    function __get_penjualan_konsinyasi_select() {
		$this -> db -> select('tid,tnofaktur FROM transaction_tab WHERE tstatus=1 ORDER BY tnofaktur ASC');
		return $this -> db -> get() -> result();
	}
	
	function __get_penjualan_konsinyasi() {
		return "SELECT * FROM transaction_tab WHERE (tstatus='1' OR tstatus='0') AND ttype='1' AND ttypetrans='3' ORDER BY tid DESC";
	}
	
	function __get_total_penjualan_konsinyasi() {
		$sql = $this -> db -> query('SELECT * FROM transaction_tab WHERE tstatus=1');
		return $sql -> num_rows();
	}
	
	function __get_penjualan_konsinyasi_detail($id) {
		$this -> db -> select('* FROM transaction_tab WHERE (tstatus=1 OR tstatus=0) AND tid=' . $id);
		return $this -> db -> get() -> result();
	}
	
	function __insert_penjualan_konsinyasi($data) {
        return $this -> db -> insert('transaction_tab', $data);
	}
	
	function __update_penjualan_konsinyasi($id, $data) {
        $this -> db -> where('tid', $id);
        return $this -> db -> update('transaction_tab', $data);
	}
	
	function __delete_penjualan_konsinyasi($id) {
		return $this -> db -> query('update transaction_tab set tstatus=2 where tid=' . $id);
	}
}
