<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Books_group_lib {
    protected $_ci;

    function __construct() {
        $this->_ci = & get_instance();
        $this->_ci->load->model('books_group/books_group_model');
    }
    
    function __get_books_group($id='') {
		$bgroup = $this -> _ci -> books_group_model -> __get_books_group_select(1,0);
		$res = '<option value="0">Main</option>';
		foreach($bgroup as $k => $v) {
			$cgroup = $this -> _ci -> books_group_model -> __get_books_group_select(2,$v -> bid);
			if ($id == $v -> bid)
				$res .= '<option value="'.$v -> bid.'" selected>'.$v -> bname.'</option>';
			else
				$res .= '<option value="'.$v -> bid.'">'.$v -> bname.'</option>';
			foreach($cgroup as $key => $val) {
				if ($id == $val -> bid)
					$res .= '<option value="'.$val -> bid.'" selected>-- '.$val -> bname.'</option>';
				else
					$res .= '<option value="'.$val -> bid.'">-- '.$val -> bname.'</option>';
			}
		}
		return $res;
	}
}
