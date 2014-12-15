<?php
class Promo_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }
    
	function __get_promo() {
		return 'SELECT a.*,b.btitle FROM promo_tab a LEFT JOIN books_tab b ON a.pbid=b.bid WHERE (a.pstatus=1 OR a.pstatus=0) ORDER BY a.pid DESC';
	}
	
	function __get_promo_detail($id) {
		$this -> db -> select('* FROM promo_tab WHERE (pstatus=1 OR pstatus=0) AND pid=' . $id);
		return $this -> db -> get() -> result();
	}
	
	function __insert_promo($data) {
        return $this -> db -> insert('promo_tab', $data);
	}
	
	function __update_promo($id, $data) {
        $this -> db -> where('pid', $id);
        return $this -> db -> update('promo_tab', $data);
	}
	
	function __delete_promo($id) {
		return $this -> db -> query('update promo_tab set pstatus=2 where pid=' . $id);
	}
}
