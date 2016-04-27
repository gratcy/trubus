<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class pembayaran_detail_lib {
    protected $_ci;

    function __construct() {
        $this->_ci = & get_instance();
        $this->_ci->load->model('pembayaran_detail/pembayaran_detail_model');
    }
    
    function __get_pembayaran_detail($id='') {
		$pembayaran_detail = $this -> _ci -> pembayaran_detail_model -> __get_pembayaran_detail_select();
		$res = '<option value=""></option>';
		foreach($pembayaran_detail as $k => $v)
			if ($id == $v -> bid)
				$res .= '<option value="'.$v -> bid.'" selected>'.$v -> bname.'</option>';
			else
				$res .= '<option value="'.$v -> bid.'">'.$v -> bname.'</option>';
		return $res;
	}
}
