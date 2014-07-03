<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Purchase_order_lib {
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

	function __get_purchase_order_moq($arr = array()) {
		$purchase_order = $this -> _ci -> purchase_order_model -> __get_purchase_order_select();
		$res = '';
		foreach($purchase_order as $k => $v)
			$res .= $v -> bname.' <input type="text" name="moq['.$v -> bid.']" class="form-control" style="text-align:right;" onkeyup="formatharga(this.value,this)" value="'.($arr == array() ? '0' : self::__check_moq($arr, 1)).'" />';
		return $res;
	}
	
	function __check_moq($arr, $bid) {
		foreach($arr as $k => $v)
			if ($v -> mbid == $bid) return $v -> mqty;
	}
}
