<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class pembayaran_lib {
    protected $_ci;

    function __construct() {
        $this->_ci = & get_instance();
        $this->_ci->load->model('pembayaran/pembayaran_model');
    }
    
    function __get_pembayaran($id='') {
		$pembayaran = $this -> _ci -> pembayaran_model -> __get_pembayaran_select();
		$res = '<option value=""></option>';
		foreach($pembayaran as $k => $v)
			if ($id == $v -> bid)
				$res .= '<option value="'.$v -> bid.'" selected>'.$v -> bname.'</option>';
			else
				$res .= '<option value="'.$v -> bid.'">'.$v -> bname.'</option>';
		return $res;
	}
}
