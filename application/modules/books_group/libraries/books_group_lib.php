<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Books_group_lib {
    protected $_ci;

    function __construct() {
        $this->_ci = & get_instance();
        $this->_ci->load->model('books_group/books_group_model');
    }
    
    function __get_books_group($id='') {
		$area = $this -> _ci -> books_group_model -> __get_books_group_select();
		$res = '<option value=""></option>';
		foreach($area as $k => $v)
			if ($id == $v -> bid)
				$res .= '<option value="'.$v -> bid.'" selected>'.$v -> bname.'</option>';
			else
				$res .= '<option value="'.$v -> bid.'">'.$v -> bname.'</option>';
		return $res;
	}
}
