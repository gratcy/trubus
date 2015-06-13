<?php
class Area_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }
    
	function __check_area_code($code) {
		$this -> db -> select("* FROM area_tab WHERE (astatus=1 OR astatus=0) AND acode='".$code."'");
		return $this -> db -> get() -> num_rows();
	}
    
    function __get_suggestion($bid) {
		$this -> db -> select('aid,aname as name FROM area_tab WHERE (astatus=1 OR astatus=0) AND abid='.$bid.' ORDER BY name ASC');
		$a =  $this -> db -> get() -> result();
		$this -> db -> select('aid,acode as name FROM area_tab WHERE (astatus=1 OR astatus=0) AND abid='.$bid.' ORDER BY name ASC', FALSE);
		$b = $this -> db -> get() -> result();
		return array_merge($a,$b);
	}
	
	function __get_area_search($keyword, $bid) {
		return "SELECT * FROM area_tab WHERE (astatus=1 OR astatus=0) AND abid=".$bid." AND (aname LIKE '%".$keyword."%' OR acode='".$keyword."') ORDER BY aname DESC";
	}
    
    function __get_area_select($bid) {
		$this -> db -> select('aid,aname FROM area_tab WHERE astatus=1 AND abid='.$bid.' ORDER BY aname ASC');
		return $this -> db -> get() -> result();
	}
	
	function __get_area($bid="") {
		if ($bid != "") $bid = " AND abid=" . $bid;
		else $bid = "";
		return 'SELECT * FROM area_tab WHERE (astatus=1 OR astatus=0)'.$bid.' ORDER BY aname DESC';
	}
	
	function __get_area_detail($id) {
		$this -> db -> select('* FROM area_tab WHERE (astatus=1 OR astatus=0) AND aid=' . $id);
		return $this -> db -> get() -> result();
	}
	
	function __insert_area($data) {
        return $this -> db -> insert('area_tab', $data);
	}
	
	function __update_area($id, $data) {
        $this -> db -> where('aid', $id);
        return $this -> db -> update('area_tab', $data);
	}
	
	function __delete_area($id) {
		return $this -> db -> query('update area_tab set astatus=2 where aid=' . $id);
	}
}
