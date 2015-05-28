<?php
class Coagroup_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }
    
    function __get_coagroup_select() {
		$this -> db -> select('cid,cname FROM coa_group_tab WHERE cstatus=1 ORDER BY cname ASC');
		return $this -> db -> get() -> result();
	}
	
	function __get_coagroup() {
		$this -> db -> select('* FROM coa_group_tab WHERE (cstatus=1 OR cstatus=0) ORDER BY cname DESC');
		return $this -> db -> get() -> result();
	}
	
	function __get_coagroup_detail($id) {
		$this -> db -> select('* FROM coa_group_tab WHERE (cstatus=1 OR cstatus=0) AND cid=' . $id);
		return $this -> db -> get() -> result();
	}
	
	function __insert_coagroup($data, $type) {
		return $this -> db -> insert('coa_group_tab', $data);
	}
	
	function __update_coagroup($id, $data) {
		$this -> db -> where('cid', $id);
		return $this -> db -> update('coa_group_tab', $data);
	}
	
	function __delete_coagroup($id) {
		return $this -> db -> query('update coa_group_tab set cstatus=2 where cid=' . $id);
	}
}
