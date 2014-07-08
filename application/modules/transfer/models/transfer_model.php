<?php
class Transfer_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }
    
    function __get_transfer() {
		$this -> db -> select('');
		return $this -> db -> get() -> result();
	}
}
