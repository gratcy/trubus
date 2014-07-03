<?php
class Rawmaterial_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }
	
	function __get_rawmaterial() {
		return 'SELECT a.*,b.bname,c.cname FROM raw_material_tab a left join branch_tab b ON a.rbid=b.bid left join categories_tab c ON a.rtype=c.cid WHERE (a.rstatus=1 or a.rstatus=0) and c.ctype=2 ORDER BY a.rid DESC';
	}
	
	function __get_rawmaterial_detail($id) {
		$this -> db -> select('* FROM raw_material_tab WHERE (rstatus=1 OR rstatus=0) AND rid=' . $id);
		return $this -> db -> get() -> result();
	}
	
	function __get_rawmaterial_select() {
		$this -> db -> select('rid,rname FROM raw_material_tab WHERE (rstatus=1 OR rstatus=0) ORDER BY rname ASC');
		return $this -> db -> get() -> result();
	}
	
	function __insert_rawmaterial($data) {
        return $this -> db -> insert('raw_material_tab', $data);
	}
	
	function __update_rawmaterial($id, $data) {
        $this -> db -> where('rid', $id);
        return $this -> db -> update('raw_material_tab', $data);
	}
	
	function __delete_rawmaterial($id) {
		return $this -> db -> query('update raw_material_tab set rstatus=2 where rid=' . $id);
	}
}
