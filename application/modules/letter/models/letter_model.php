<?php
class Letter_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }

	function __get_letter() {
		return 'SELECT * FROM letter_tab WHERE (lstatus=1 OR lstatus=0 OR lstatus=3) ORDER BY lid DESC';
	}

	function __get_letter_detail($id) {
		$this -> db -> select('* FROM letter_tab WHERE (lstatus=1 OR lstatus=0 OR lstatus=3) AND lid=' . $id);
		return $this -> db -> get() -> result();
	}

	function __get_transaction_docno($id) {
		$this -> db -> select('tnofaktur FROM transaction_tab WHERE tstatus=1 AND tid=' . $id);
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

	function __get_books($id) {
		$this -> db -> select('a.tqty as dqty,b.bcode,b.btitle,b.bprice,b.bisbn,c.pname FROM transaction_detail_tab a LEFT JOIN books_tab b ON a.tbid=b.bid LEFT JOIN publisher_tab c ON b.bpublisher=c.pid WHERE a.tstatus=1 AND a.ttid=' . $id);
		return $this -> db -> get() -> result();
	}
}
