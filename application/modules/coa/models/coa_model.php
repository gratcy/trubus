<?php
class coa_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }
    
    function __get_coa_select() {
		$this -> db -> select('cid,cname,cparent FROM coa_tab WHERE cstatus=1 ORDER BY cname ASC');
		return $this -> db -> get() -> result();
	}
	
	function __get_coa($bid) {
		return 'SELECT a.*,b.csaldo FROM coa_tab a LEFT JOIN coa_detail_tab b ON a.cid=b.cidid AND b.cbid='.$bid.' WHERE (a.cstatus=1 OR a.cstatus=0) ORDER BY a.cname DESC';
	}
	
	function __get_coa_detail($id, $bid) {
		$this -> db -> select('a.*,b.csaldo,b.cdebet,b.ccredit FROM coa_tab a LEFT JOIN coa_detail_tab b ON a.cid=b.cidid AND b.cbid='.$bid.' WHERE (a.cstatus=1 OR a.cstatus=0) AND a.cid=' . $id);
		return $this -> db -> get() -> result();
	}
	
	function __insert_coa($data, $type) {
		if ($type == 1)
			return $this -> db -> insert('coa_tab', $data);
        else
			return $this -> db -> insert('coa_detail_tab', $data);
	}
	
	function __update_coa($id, $data, $bid, $type) {
		if ($type == 1) {
			$this -> db -> where('cid', $id);
			return $this -> db -> update('coa_tab', $data);
		}
		else {
			$this -> db -> where('cbid', $bid);
			$this -> db -> where('cidid', $id);
			return $this -> db -> update('coa_detail_tab', $data);
		}
	}
	
	function __check_coa_detail($id, $bid) {
		$sql = $this -> db -> query('SELECT * FROM coa_detail_tab WHERE cbid='.$bid.' AND cidid=' . $id);
		return $sql -> num_rows();
	}
	
	function __delete_coa($id) {
		return $this -> db -> query('update coa_tab set cstatus=2 where cid=' . $id);
	}
}
