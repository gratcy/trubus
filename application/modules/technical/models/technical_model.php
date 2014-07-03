<?php
class Technical_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }
	
	function __get_technical() {
		return 'SELECT a.*,b.bname FROM technical_tab a left join branch_tab b ON a.tbid=b.bid WHERE (a.tstatus=1 or a.tstatus=0) ORDER BY a.tid DESC';
	}
	
	function __get_technical_detail($id) {
		$this -> db -> select('* FROM technical_tab WHERE (tstatus=1 OR tstatus=0) AND tid=' . $id);
		return $this -> db -> get() -> result();
	}
	
	function __insert_technical($data) {
        return $this -> db -> insert('technical_tab', $data);
	}
	
	function __update_technical($id, $data) {
        $this -> db -> where('tid', $id);
        return $this -> db -> update('technical_tab', $data);
	}
	
	function __delete_technical($id) {
		return $this -> db -> query('update technical_tab set tstatus=2 where tid=' . $id);
	}
}
