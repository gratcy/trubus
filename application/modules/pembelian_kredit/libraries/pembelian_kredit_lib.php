<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class pembelian_kredit_lib {
    protected $_ci;

    function __construct() {
        $this->_ci = & get_instance();
        $this->_ci->load->model('pembelian_kredit/pembelian_kredit_model');
    }
    
    function __get_pembelian_kredit($id='') {
		$pembelian_kredit = $this -> _ci -> pembelian_kredit_model -> __get_pembelian_kredit_select();
		$res = '<option value=""></option>';
		foreach($pembelian_kredit as $k => $v)
			if ($id == $v -> bid)
				$res .= '<option value="'.$v -> bid.'" selected>'.$v -> bname.'</option>';
			else
				$res .= '<option value="'.$v -> bid.'">'.$v -> bname.'</option>';
		return $res;
	}
}
