<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Locator_lib {
    protected $_ci;

    function __construct() {
        $this->_ci = & get_instance();
        $this->_ci->load->model('locator/locator_model');
    }
    
    function __get_locator($id='') {
		$locator = $this -> _ci -> locator_model -> __get_locator_select($this -> memcachedlib -> sesresult['ubranchid']);
		$res = '<option value=""></option>';
		foreach($locator as $k => $v)
			if ($id == $v -> lid)
				$res .= '<option value="'.$v -> lid.'" selected>'.$v -> lplaced.'</option>';
			else
				$res .= '<option value="'.$v -> lid.'">'.$v -> lplaced.'</option>';
		return $res;
	}
}
