<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class penjualan_konsinyasi_detail_lib {
    protected $_ci;

    function __construct() {
        $this->_ci = & get_instance();
        $this->_ci->load->model('penjualan_konsinyasi_detail/penjualan_konsinyasi_detail_model');
    }
    
    function __get_penjualan_konsinyasi_detail($id='') {
		$penjualan_konsinyasi_detail = $this -> _ci -> penjualan_konsinyasi_detail_model -> __get_penjualan_konsinyasi_detail_select();
		$res = '<option value=""></option>';
		foreach($penjualan_konsinyasi_detail as $k => $v)
			if ($id == $v -> bid)
				$res .= '<option value="'.$v -> bid.'" selected>'.$v -> bname.'</option>';
			else
				$res .= '<option value="'.$v -> bid.'">'.$v -> bname.'</option>';
		return $res;
	}
}
