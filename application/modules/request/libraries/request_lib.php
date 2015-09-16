<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Request_lib {
    protected $_ci;

    function __construct() {
        $this->_ci = & get_instance();
        $this->_ci->load->model('request/request_model');
    }
    
    function __get_request($id='',$bid='') {
		$books = $this -> _ci -> request_model -> __get_request_select($bid);
		$res = '<option value=""></option>';
		foreach($books as $k => $v)
			if ($id == $v -> did)
				$res .= '<option value="'.$v -> did.'" selected>R'.str_pad($v -> did, 4, "0", STR_PAD_LEFT).'</option>';
			else
				$res .= '<option value="'.$v -> did.'">R'.str_pad($v -> did, 4, "0", STR_PAD_LEFT).'</option>';
		return $res;
	}
}
