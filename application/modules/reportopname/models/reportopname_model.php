<?php
class Reportopname_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }
    
	function __get_reportopname($from='', $to='', $bid) {
		$from = ($from == '' ? date('Y-m-d', strtotime('-1 month', time())) : date('Y-m-d',$from));
		$to = ($to == '' ? date('Y-m-d') : date('Y-m-d',$to));
		$this -> db -> select("a.*,c.btitle,c.bcode,d.bname FROM opname_tab a LEFT JOIN inventory_tab b ON a.oidid=b.iid AND b.istatus=1 LEFT JOIN books_tab c ON b.ibid=c.bid LEFT JOIN branch_tab d ON b.ibcid=d.bid WHERE b.ibcid=".$bid." AND c.bstatus=1 AND a.otype=1 AND FROM_UNIXTIME(a.odate, '%Y-%m-%d') >= '".$from."' AND FROM_UNIXTIME(a.odate, '%Y-%m-%d') <= '".$to."' ORDER BY a.oid DESC", FALSE);
		return $this -> db -> get() -> result();
	}
}
