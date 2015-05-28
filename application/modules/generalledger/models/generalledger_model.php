<?php
class Generalledger_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }
    
	function __get_generalledger() {
		$this -> db -> select("a.*,b.gdate,b.gdocref,c.ccode,c.cname FROM gl_detail_tab a INNER JOIN gl_tab b ON a.ggid=b.gid LEFT JOIN coa_tab c ON a.gcid=c.cid WHERE a.gstatus=1 AND b.gaid=(SELECT aid FROM account_period_tab WHERE astatus=1) AND b.gstatus=1 AND b.gpdate != '' ORDER BY a.gid DESC");
		return $this -> db -> get() -> result();
	}
}
