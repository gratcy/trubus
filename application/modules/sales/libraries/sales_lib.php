<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sales_lib {
    protected $_ci;

    function __construct() {
        $this->_ci = & get_instance();
        $this->_ci->load->model('sales/sales_model');
    }
    
    function __get_sales($id='') {
		$users = $this -> _ci -> sales_model -> __get_sales_select();
		$res = '<option value=""></option>';
		foreach($users as $k => $v)
			if ($id == $v -> sid)
				$res .= '<option value="'.$v -> sid.'" selected>'.$v -> sname.'</option>';
			else
				$res .= '<option value="'.$v -> sid.'">'.$v -> sname.'</option>';
		return $res;
	}

}
