<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tax_lib {
    protected $_ci;

    function __construct() {
        $this->_ci = & get_instance();
        $this->_ci->load->model('tax/tax_model');
    }
    
    function __get_tax($id='') {
		$tax = $this -> _ci -> tax_model -> __get_tax_select();
		$res = '<option value=""></option>';
		foreach($tax as $k => $v)
			if ($id == $v -> tid)
				$res .= '<option value="'.$v -> tid.'" selected>'.$v -> ttax.'</option>';
			else
				$res .= '<option value="'.$v -> tid.'">'.$v -> ttax.'</option>';
		return $res;
	}
}
