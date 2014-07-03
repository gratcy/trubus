<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Products_lib {
    protected $_ci;

    function __construct() {
        $this->_ci = & get_instance();
        $this->_ci->load->model('products/products_model');
    }
    
    function __get_products($id='') {
		$users = $this -> _ci -> products_model -> __get_products_select();
		$res = '<option value=""></option>';
		foreach($users as $k => $v)
			if ($id == $v -> pid)
				$res .= '<option value="'.$v -> pid.'" selected>'.$v -> pname.'</option>';
			else
				$res .= '<option value="'.$v -> pid.'">'.$v -> pname.'</option>';
		return $res;
	}
}
