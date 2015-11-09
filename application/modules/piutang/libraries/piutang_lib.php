<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class piutang_lib {
    protected $_ci;

    function __construct() {
        $this->_ci = & get_instance();
        $this->_ci->load->model('piutang/piutang_model');
    }
    
    function __get_piutang($id='') {
		$piutang = $this -> _ci -> piutang_model -> __get_piutang_select();
		$res = '<option value=""></option>';
		foreach($piutang as $k => $v)
			if ($id == $v -> bid)
				$res .= '<option value="'.$v -> bid.'" selected>'.$v -> bname.'</option>';
			else
				$res .= '<option value="'.$v -> bid.'">'.$v -> bname.'</option>';
		return $res;
	}
}
