<?php
class coa_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }
    
    function __get_coa_select() {
		$this -> db -> select('cid,cname,cparent FROM coa_tab WHERE cstatus=1 ORDER BY cname ASC');
		return $this -> db -> get() -> result();
	}
	
	function __get_coa() {
		return 'SELECT * FROM coa_tab WHERE (cstatus=1 OR cstatus=0) ORDER BY cname DESC';
	}
	
	function __get_coa_detail($id) {
		$this -> db -> select('* FROM coa_tab WHERE (cstatus=1 OR cstatus=0) AND cid=' . $id);
		return $this -> db -> get() -> result();
	}
	
	function __insert_coa($data) {
        return $this -> db -> insert('coa_tab', $data);
	}
	
	function __update_coa($id, $data) {
        $this -> db -> where('cid', $id);
        return $this -> db -> update('coa_tab', $data);
	}
	
	function __delete_coa($id) {
		return $this -> db -> query('update coa_tab set cstatus=2 where cid=' . $id);
	}
}
