<?php
class City_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }
    
    function __get_city_select() {
		$this -> db -> select('cid,cname FROM city_tab WHERE cstatus=1 ORDER BY cname ASC');
		return $this -> db -> get() -> result();
	}
    
	function __get_city() {
		return 'SELECT * FROM city_tab WHERE (cstatus=1 OR cstatus=0) ORDER BY cid DESC';
	}
	
	function __get_city_detail($id) {
		$this -> db -> select('* FROM city_tab WHERE (cstatus=1 OR cstatus=0) AND cid=' . $id);
		return $this -> db -> get() -> result();
	}
	
	function __insert_city($data) {
        return $this -> db -> insert('city_tab', $data);
	}
	
	function __update_city($id, $data) {
        $this -> db -> where('cid', $id);
        return $this -> db -> update('city_tab', $data);
	}
	
	function __delete_city($id) {
		return $this -> db -> query('update city_tab set cstatus=2 where cid=' . $id);
	}
}
