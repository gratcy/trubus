<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class penjualan_kredit_lib {
    protected $_ci;

    function __construct() {
        $this->_ci = & get_instance();
        $this->_ci->load->model('penjualan_kredit/penjualan_kredit_model');
    }
    
    function __get_penjualan_kredit($id='') {
		$penjualan_kredit = $this -> _ci -> penjualan_kredit_model -> __get_penjualan_kredit_select();
		$res = '<option value=""></option>';
		foreach($penjualan_kredit as $k => $v)
			if ($id == $v -> bid)
				$res .= '<option value="'.$v -> bid.'" selected>'.$v -> bname.'</option>';
			else
				$res .= '<option value="'.$v -> bid.'">'.$v -> bname.'</option>';
		return $res;
	}
}
