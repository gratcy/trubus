<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class purchase_order_lib {
    protected $_ci;

    function __construct() {
        $this->_ci = & get_instance();
        $this->_ci->load->model('purchase_order/purchase_order_model');
    }
    
    function __get_purchase_order($id='') {
		$purchase_order = $this -> _ci -> purchase_order_model -> __get_purchase_order_select();
		$res = '<option value=""></option>';
		foreach($purchase_order as $k => $v)
			if ($id == $v -> bid)
				$res .= '<option value="'.$v -> bid.'" selected>'.$v -> bname.'</option>';
			else
				$res .= '<option value="'.$v -> bid.'">'.$v -> bname.'</option>';
		return $res;
	}
}
