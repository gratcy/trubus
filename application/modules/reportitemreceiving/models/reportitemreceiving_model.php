<?php
class Reportitemreceiving_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }
    
    function __get_pb_list($ids,$type) {
		if ($type == 1) $this -> db -> select("bname as name FROM branch_tab WHERE bid IN(".implode(',',$ids).") AND bstatus=1", FALSE);
		else $this -> db -> select("pname as name FROM publisher_tab WHERE pid IN(".implode(',',$ids).") AND pstatus=1", FALSE);
		return $this -> db -> get() -> result();
	}
    
	function __get_reportitemreceiving($type,$pub,$bra,$daterange) {
		if ($type == 2) {
			if ($pub && count($pub) > 0) $pb = " AND b.riid IN(".implode(',',$pub).")";
			else $pb = "";
		}
		else {
			if ($bra && count($bra) > 0) $pb = " AND b.rbid IN(".implode(',',$bra).")";
			else $pb = "";
		}
		if ($daterange) {
			$daterange = explode(' - ', $daterange);
			$from = date('Y-m-d',strtotime(str_replace('/','-',$daterange[0])));
			$to = date('Y-m-d',strtotime(str_replace('/','-',$daterange[1])));
			$dt = " AND (from_unixtime(b.rdate, '%Y-%m-%d') >= '".$from."' AND from_unixtime(b.rdate, '%Y-%m-%d') <= '".$to."')";
		}
		else
			$dt = "";
		$this -> db -> select("a.rqty,b.rdocno,b.rdate,c.btitle,c.bcode,c.bprice,c.bisbn,d.pname FROM receiving_books_tab a LEFT JOIN receiving_tab b ON a.rrid=b.rid LEFT JOIN books_tab c ON a.rbid=c.bid LEFT JOIN publisher_tab d ON c.bpublisher=d.pid WHERE a.rstatus=1 AND b.rstatus=3$pb$dt ORDER BY b.rid DESC", FALSE);
		return $this -> db -> get() -> result();
	}
}
