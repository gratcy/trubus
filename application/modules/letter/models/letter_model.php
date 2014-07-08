<?php
class Letter_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }
	
	function __get_letter() {
		return 'SELECT * FROM letter_tab WHERE (lstatus=1 OR lstatus=0) ORDER BY lid DESC';
	}
	
	function __get_letter_detail($id) {
		$this -> db -> select('* FROM letter_tab WHERE (lstatus=1 OR lstatus=0) AND lid=' . $id);
		return $this -> db -> get() -> result();
	}
	
	function __insert_letter($data) {
        return $this -> db -> insert('letter_tab', $data);
	}
	
	function __update_letter($id, $data) {
        $this -> db -> where('lid', $id);
        return $this -> db -> update('letter_tab', $data);
	}
	
	function __delete_letter($id) {
		return $this -> db -> query('update letter_tab set lstatus=2 where lid=' . $id);
	}
}
