<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class pembelian_spo_lib {
    protected $_ci;

    function __construct() {
        $this->_ci = & get_instance();
        $this->_ci->load->model('pembelian_spo/pembelian_spo_model');
    }
    
    function __get_pembelian_spo($id='') {
		$pembelian_spo = $this -> _ci -> pembelian_spo_model -> __get_pembelian_spo_select();
		$res = '<option value=""></option>';
		foreach($pembelian_spo as $k => $v)
			if ($id == $v -> bid)
				$res .= '<option value="'.$v -> bid.'" selected>'.$v -> bname.'</option>';
			else
				$res .= '<option value="'.$v -> bid.'">'.$v -> bname.'</option>';
		return $res;
	}
}
