<?php
class Publisher_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }
    
    function __get_publisher_select() {
		$this -> db -> select('pid,pname FROM publisher_tab WHERE pstatus=1 ORDER BY pname ASC');
		return $this -> db -> get() -> result();
	}
	
	function __get_publisher() {
		return 'SELECT * FROM publisher_tab WHERE (pstatus=1 OR pstatus=0) ORDER BY pname DESC';
	}
	
	function __get_publisher_detail($id) {
		$this -> db -> select('* FROM publisher_tab WHERE (pstatus=1 OR pstatus=0) AND pid=' . $id);
		return $this -> db -> get() -> result();
	}
	
	function __insert_publisher($data) {
        return $this -> db -> insert('publisher_tab', $data);
	}
	
	function __update_publisher($id, $data) {
        $this -> db -> where('pid', $id);
        return $this -> db -> update('publisher_tab', $data);
	}
	
	function __delete_publisher($id) {
		return $this -> db -> query('update publisher_tab set pstatus=2 where pid=' . $id);
	}
}
