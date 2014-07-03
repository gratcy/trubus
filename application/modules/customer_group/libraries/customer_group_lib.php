<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class customer_group_lib {
    protected $_ci;

    function __construct() {
        $this->_ci = & get_instance();
        $this->_ci->load->model('customer_group/customer_group_model');
    }
    
    function __get_customer_group($id='') {
		$area = $this -> _ci -> customer_group_model -> __get_customer_group_select();
		$res = '<option value=""></option>';
		foreach($area as $k => $v)
			if ($id == $v -> cgid)
				$res .= '<option value="'.$v -> cgid.'" selected>'.$v -> cgname.'</option>';
			else
				$res .= '<option value="'.$v -> cgid.'">'.$v -> cgname.'</option>';
		return $res;
	}
}
