<?php
class Reportstock_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }
    
	function __get_reportstock($from='', $to='') {
		$from = ($from == '' ? date('Y-m-d', strtotime('-1 month', time())) : date('Y-m-d',$from));
		$to = ($to == '' ? date('Y-m-d') : date('Y-m-d',$to));
		return "SELECT a.*,b.* FROM books_tab a JOIN inventory_tab b ON a.bid=b.ibid AND b.itype=1 WHERE a.bstatus=1 AND b.istatus=1 ORDER BY a.bid DESC";
	}
	
	function __get_total_adjustment($type, $aatype, $branch, $bid) {
		$this -> db -> select('sum(atotal) as total from adjustment_tab WHERE abcid='.$branch.' AND atype='.$type.' AND aatype='.$aatype.' AND aidid='.$bid);
		return $this -> db -> get() -> result();
	}
	
	function __get_total_receiving($branch,$bid) {
		$this -> db -> select('sum(rqty) as qty from receiving_books_tab WHERE rbcid=' . $branch .' AND rbid=' . $bid);
		return $this -> db -> get() -> result();
	}
	
	function __get_total_selling($branch, $bid) {
		$this -> db -> select('sum(b.tqty) as qty from transaction_tab a LEFT JOIN transaction_detail_tab b ON a.tid=b.ttid WHERE a.tbid=' . $branch .' AND b.tbid=' . $bid);
		return $this -> db -> get() -> result();
	}
}
