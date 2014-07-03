<?php
class Sparepart_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }
	
	function __get_sparepart() {
		return 'SELECT a.*,b.pname FROM sparepart_tab a left join products_tab b ON a.spid=b.pid WHERE (a.sstatus=1 or a.sstatus=0) ORDER BY a.sid DESC';
	}
	
	function __get_recent_sparepart() {
		$this -> db -> select('a.*,b.pname FROM sparepart_tab a left join products_tab b ON a.spid=b.pid WHERE (a.sstatus=1 or a.sstatus=0) ORDER BY a.sid DESC LIMIT 0,5', FALSE);
		return $this -> db -> get() -> result();
	}
	
	function __get_sparepart_select() {
		$this -> db -> select('sid,sname FROM sparepart_tab WHERE (sstatus=1 OR sstatus=0) ORDER BY sname ASC');
		return $this -> db -> get() -> result();
	}
	
	function __get_sparepart_detail($id) {
		$this -> db -> select('* FROM sparepart_tab WHERE (sstatus=1 OR sstatus=0) AND sid=' . $id);
		return $this -> db -> get() -> result();
	}
	
	function __insert_sparepart($data) {
        return $this -> db -> insert('sparepart_tab', $data);
	}
	
	function __update_sparepart($id, $data) {
        $this -> db -> where('sid', $id);
        return $this -> db -> update('sparepart_tab', $data);
	}
	
	function __delete_sparepart($id) {
		return $this -> db -> query('update sparepart_tab set sstatus=2 where sid=' . $id);
	}
}
