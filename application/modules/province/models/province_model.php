<?php
class Province_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }
    
    function __get_province_select() {
		$this -> db -> select('pid,pname FROM province_tab WHERE pstatus=1 ORDER BY pname ASC');
		return $this -> db -> get() -> result();
	}
    
	function __get_province() {
		return 'SELECT * FROM province_tab WHERE (pstatus=1 OR pstatus=0) ORDER BY pid DESC';
	}
	
	function __get_province_detail($id) {
		$this -> db -> select('* FROM province_tab WHERE (pstatus=1 OR pstatus=0) AND pid=' . $id);
		return $this -> db -> get() -> result();
	}
	
	function __insert_province($data) {
        return $this -> db -> insert('province_tab', $data);
	}
	
	function __update_province($id, $data) {
        $this -> db -> where('pid', $id);
        return $this -> db -> update('province_tab', $data);
	}
	
	function __delete_province($id) {
		return $this -> db -> query('update province_tab set pstatus=2 where pid=' . $id);
	}
}
