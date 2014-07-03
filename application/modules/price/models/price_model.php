<?php
class price_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }
	
	function __get_price($type) {
		return 'SELECT a.*,b.bname,c.pname FROM price_tab a left join branch_tab b ON a.pbid=b.bid left join products_tab c ON a.piid=c.pid WHERE (a.pstatus=1 or a.pstatus=0) AND a.ptype='.$type.' ORDER BY a.pid DESC';
	}
	
	function __get_price_detail($type,$id) {
		$this -> db -> select('* FROM price_tab WHERE (pstatus=1 OR pstatus=0) AND ptype='.$type.' AND pid=' . $id);
		return $this -> db -> get() -> result();
	}
	
	function __insert_price($data) {
        return $this -> db -> insert('price_tab', $data);
	}
	
	function __update_price($id, $data) {
        $this -> db -> where('pid', $id);
        return $this -> db -> update('price_tab', $data);
	}
	
	function __delete_price($id) {
		return $this -> db -> query('update price_tab set pstatus=2 where pid=' . $id);
	}
}
