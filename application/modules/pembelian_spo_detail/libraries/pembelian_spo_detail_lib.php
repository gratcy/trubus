<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class pembelian_spo_detail_lib {
    protected $_ci;

    function __construct() {
        $this->_ci = & get_instance();
        $this->_ci->load->model('pembelian_spo_detail/pembelian_spo_detail_model');
    }
    
    function __get_pembelian_spo_detail($id='') {
		$pembelian_spo_detail = $this -> _ci -> pembelian_spo_detail_model -> __get_pembelian_spo_detail_select();
		$res = '<option value=""></option>';
		foreach($pembelian_spo_detail as $k => $v)
			if ($id == $v -> bid)
				$res .= '<option value="'.$v -> bid.'" selected>'.$v -> bname.'</option>';
			else
				$res .= '<option value="'.$v -> bid.'">'.$v -> bname.'</option>';
		return $res;
	}
}
