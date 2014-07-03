<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Customer_lib {
    protected $_ci;

    function __construct() {
        $this->_ci = & get_instance();
        $this->_ci->load->model('customer/customer_model');
    }
    
    function __get_customer($id='') {
		$customer = $this -> _ci -> customer_model -> __get_customer_select();
		$res = '<option value=""></option>';
		foreach($customer as $k => $v)
			if ($id == $v -> cid)
				$res .= '<option value="'.$v -> cid.'" selected>'.$v -> cname.'</option>';
			else
				$res .= '<option value="'.$v -> cid.'">'.$v -> cname.'</option>';
		return $res;
	}
	
    function __get_customer_consinyasi($id='') {
		$customer = $this -> _ci -> customer_model -> __get_customer_consinyasi_select();
		$res = '<option value=""></option>';
		foreach($customer as $k => $v)
			if ($id == $v -> cid)
				$res .= '<option value="'.$v -> cid.'" selected>'.$v -> cname.'</option>';
			else
				$res .= '<option value="'.$v -> cid.'">'.$v -> cname.'</option>';
		return $res;
	}	
	
}
