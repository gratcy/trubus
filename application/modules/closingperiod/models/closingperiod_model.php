<?php
class Closingperiod_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }
    
    function __get_period_active() {
		$this -> db -> select('* from account_period_tab where astatus=1 order by aid DESC LIMIT 1');
		return $this -> db -> get() -> result();
	}
	
	function __get_period_history() {
		$this -> db -> select('* from account_period_tab where astatus=0');
		return $this -> db -> get() -> result();
	}
	
	function __insert_period($data) {
		return $this -> db -> insert('account_period_tab', $data);
	}
	
	function __update_period($id, $data) {
		$this -> db -> where('aid', $id);
		return $this -> db -> update('account_period_tab', $data);
	}
}
