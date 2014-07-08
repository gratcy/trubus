<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class penjualan_konsinyasi_lib {
    protected $_ci;

    function __construct() {
        $this->_ci = & get_instance();
        $this->_ci->load->model('penjualan_konsinyasi/penjualan_konsinyasi_model');
    }
    
    function __get_penjualan_konsinyasi($id='') {
		$penjualan_konsinyasi = $this -> _ci -> penjualan_konsinyasi_model -> __get_penjualan_konsinyasi_select();
		$res = '<option value=""></option>';
		foreach($penjualan_konsinyasi as $k => $v)
			if ($id == $v -> tid)
				$res .= '<option value="'.$v -> tid.'" selected>'.$v -> bname.'</option>';
			else
				$res .= '<option value="'.$v -> tid.'">'.$v -> bname.'</option>';
		return $res;
	}
    
    function __get_penjualan_konsinyasi_no($id='') {
		$penjualan_konsinyasi = $this -> _ci -> penjualan_konsinyasi_model -> __get_penjualan_konsinyasi_select();
		$res = '<option value=""></option>';
		foreach($penjualan_konsinyasi as $k => $v)
			if ($id == $v -> tid)
				$res .= '<option value="'.$v -> tid.'" selected>T'.str_pad($v -> tid, 4, "0", STR_PAD_LEFT).'</option>';
			else
				$res .= '<option value="'.$v -> tid.'">T'.str_pad($v -> tid, 4, "0", STR_PAD_LEFT).'</option>';
		return $res;
	}
}
