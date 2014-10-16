<?php
class Tax_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }
    
    function __get_tax_select() {
		$this -> db -> select('tid,tname FROM tax_tab WHERE tstatus=1 ORDER BY ttax ASC');
		return $this -> db -> get() -> result();
	}
	
	function __get_tax() {
		return 'SELECT * FROM tax_tab WHERE (tstatus=1 OR tstatus=0) ORDER BY ttax DESC';
	}
	
	function __get_tax_detail($id) {
		$this -> db -> select('* FROM tax_tab WHERE (tstatus=1 OR tstatus=0) AND tid=' . $id);
		return $this -> db -> get() -> result();
	}
	
	function __insert_tax($data) {
        return $this -> db -> insert('tax_tab', $data);
	}
	
	function __update_tax($id, $data) {
        $this -> db -> where('tid', $id);
        return $this -> db -> update('tax_tab', $data);
	}
	
	function __delete_tax($id) {
		return $this -> db -> query('update tax_tab set tstatus=2 where tid=' . $id);
	}
}
