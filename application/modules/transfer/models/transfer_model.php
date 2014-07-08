<?php
class Transfer_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }
    
    function __get_transfer() {
		return 'SELECT a.did,a.ddrid,a.ddate,a.dtitle,a.ddesc,a.dstatus,c.bname as fbname,d.bname as tbname FROM distribution_tab a LEFT JOIN distribution_request_tab b ON a.ddrid=b.did LEFT JOIN branch_tab c ON b.dbfrom=c.bid LEFT JOIN branch_tab d ON b.dbto=d.bid WHERE (a.dstatus=1 OR a.dstatus=0) ORDER BY a.did DESC';
	}
	
	function __get_transfer_detail($id) {
		$this -> db -> select('* FROM distribution_tab WHERE (dstatus=1 OR dstatus=0) AND did=' . $id);
		return $this -> db -> get() -> result();
	}
	
	function __get_transfer_books_detail($id) {
		$this -> db -> select('a.did,a.ddrid,a.ddate,a.dtitle,a.ddesc,a.dstatus,c.bname as fbname,d.bname as tbname FROM distribution_tab a LEFT JOIN distribution_request_tab b ON a.ddrid=b.did LEFT JOIN branch_tab c ON b.dbfrom=c.bid LEFT JOIN branch_tab d ON b.dbto=d.bid WHERE (a.dstatus=1 OR a.dstatus=0) AND a.did=' . $id);
		return $this -> db -> get() -> result();
	}
	
	function __insert_transfer($data) {
        return $this -> db -> insert('distribution_tab', $data);
	}
	
	function __update_transfer($id, $data) {
        $this -> db -> where('did', $id);
        return $this -> db -> update('distribution_tab', $data);
	}
	
	function __delete_transfer($id) {
		return $this -> db -> query('update distribution_tab set dstatus=2 where did=' . $id);
	}
}
