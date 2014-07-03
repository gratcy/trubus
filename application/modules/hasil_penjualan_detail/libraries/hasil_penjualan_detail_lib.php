<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class hasil_penjualan_detail_lib {
    protected $_ci;

    function __construct() {
        $this->_ci = & get_instance();
        $this->_ci->load->model('hasil_penjualan_detail/hasil_penjualan_detail_model');
    }
    
    function __get_hasil_penjualan_detail($id='') {
		$hasil_penjualan_detail = $this -> _ci -> hasil_penjualan_detail_model -> __get_hasil_penjualan_detail_select();
		$res = '<option value=""></option>';
		foreach($hasil_penjualan_detail as $k => $v)
			if ($id == $v -> bid)
				$res .= '<option value="'.$v -> bid.'" selected>'.$v -> bname.'</option>';
			else
				$res .= '<option value="'.$v -> bid.'">'.$v -> bname.'</option>';
		return $res;
	}
}
