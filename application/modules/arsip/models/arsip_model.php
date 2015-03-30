<?php
class Arsip_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }
    
    function __get_suggestion() {
		$this -> db -> select('aid,atitle as name FROM arsip_tab WHERE (astatus=1 OR astatus=0) ORDER BY name ASC');
		return $this -> db -> get() -> result();
	}
	
	function __get_arsip_search($keyword) {
		return "SELECT a.*,b.cname,c.bname FROM arsip_tab a LEFT JOIN categories_tab b ON a.acid=b.cid LEFT JOIN branch_tab c ON a.abid=c.bid WHERE (a.astatus=1 OR a.astatus=0) AND atitle LIKE '%".$keyword."%' ORDER BY a.aid DESC";
	}
    
	function __get_arsip() {
		return 'SELECT a.*,b.cname,c.bname FROM arsip_tab a LEFT JOIN categories_tab b ON a.acid=b.cid LEFT JOIN branch_tab c ON a.abid=c.bid WHERE (a.astatus=1 OR a.astatus=0) ORDER BY a.aid DESC';
	}
	
	function __get_arsip_detail($id) {
		$this -> db -> select('* FROM arsip_tab WHERE (astatus=1 OR astatus=0) AND aid=' . $id);
		return $this -> db -> get() -> result();
	}
	
	function __insert_arsip($data) {
        return $this -> db -> insert('arsip_tab', $data);
	}
	
	function __update_arsip($id, $data) {
        $this -> db -> where('aid', $id);
        return $this -> db -> update('arsip_tab', $data);
	}
	
	function __delete_arsip($id) {
		return $this -> db -> query('update arsip_tab set astatus=2 where aid=' . $id);
	}
}
