<?php
class Home_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }

	function __get_total_books() {
		$sql = $this -> db -> query('SELECT * FROM books_tab WHERE (bstatus=1 OR bstatus=0)');
		return $sql -> num_rows();
	}

	function __get_total_customer($bid) {
		$sql = $this -> db -> query('SELECT * FROM customer_tab WHERE cbid='.$bid.' AND (cstatus=1 OR cstatus=0)');
		return $sql -> num_rows();
	}

	function __get_total_stock($bid) {
		$this -> db -> select('SUM(istock) as total FROM inventory_tab WHERE ibcid='.$bid.' AND itype=1 AND (istatus=1 OR istatus=0)');
		$r = $this -> db -> get() -> result();
		return $r[0] -> total;
	}

	function __get_total_order($bid) {
		$sql = $this -> db -> query("SELECT * FROM transaction_tab WHERE tbid=".$bid." AND (tnofaktur LIKE 'JC%' OR tnofaktur LIKE 'HP%') AND approval = 2 AND ttanggal='".date('Y-m-d')."'");
		return $sql -> num_rows();
	}
}
