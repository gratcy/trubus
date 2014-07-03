<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class hasil_penjualan_lib {
    protected $_ci;

    function __construct() {
        $this->_ci = & get_instance();
        $this->_ci->load->model('hasil_penjualan/hasil_penjualan_model');
    }
    
    function __get_hasil_penjualan($id='') {
		$hasil_penjualan = $this -> _ci -> hasil_penjualan_model -> __get_hasil_penjualan_select();
		$res = '<option value=""></option>';
		foreach($hasil_penjualan as $k => $v)
			if ($id == $v -> bid)
				$res .= '<option value="'.$v -> bid.'" selected>'.$v -> bname.'</option>';
			else
				$res .= '<option value="'.$v -> bid.'">'.$v -> bname.'</option>';
		return $res;
	}
}
