<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Province_lib {
    protected $_ci;

    function __construct() {
        $this->_ci = & get_instance();
        $this->_ci->load->model('province/province_model');
    }
    
    function __get_province($id='') {
		$province = $this -> _ci -> province_model -> __get_province_select();
		$res = '<option value=""></option>';
		foreach($province as $k => $v)
			if ($id == $v -> pid)
				$res .= '<option value="'.$v -> pid.'" selected>'.$v -> pname.'</option>';
			else
				$res .= '<option value="'.$v -> pid.'">'.$v -> pname.'</option>';
		return $res;
	}
}
