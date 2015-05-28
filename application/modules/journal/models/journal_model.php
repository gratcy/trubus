<?php
class Journal_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }
	function __get_journal($bid) {
		return 'SELECT * FROM gl_tab WHERE gstatus=1 AND gbid='.$bid.' AND gaid=(SELECT aid FROM account_period_tab WHERE astatus=1) ORDER BY gid DESC';
	}
	
	function __get_journal_detail($id) {
		$this -> db -> select('* FROM gl_tab WHERE gstatus=1 AND gid=' . $id);
		return $this -> db -> get() -> result();
	}
	
	function __get_journal_child($id) {
		$this -> db -> select('* FROM gl_detail_tab WHERE gstatus=1 AND ggid=' . $id);
		return $this -> db -> get() -> result();
	}
	
	function __insert_journal($data, $type) {
		if ($type == 1)
			return $this -> db -> insert('gl_tab', $data);
        else
			return $this -> db -> insert('gl_detail_tab', $data);
	}
	
	function __update_journal($id, $data, $type) {
		if ($type == 1) {
			$this -> db -> where('gid', $id);
			return $this -> db -> update('gl_tab', $data);
		}
		else {
			$this -> db -> where('gid', $id);
			return $this -> db -> update('gl_detail_tab', $data);
		}
	}
	
	function __delete_journal($id) {
		return $this -> db -> query('update gl_tab set gstatus=0 where gid=' . $id);
	}
	
	function __delete_journal_child($id) {
		return $this -> db -> query('update gl_detail_tab set gstatus=0 where gid=' . $id);
	}
}
