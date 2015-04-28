<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class spo_lib {
    protected $_ci;

    function __construct() {
        $this->_ci = & get_instance();
        $this->_ci->load->model('spo/spo_model');
    }
    
    function __get_spo($id='') {
		$spo = $this -> _ci -> spo_model -> __get_spo_select();
		$res = '<option value=""></option>';
		foreach($spo as $k => $v)
			if ($id == $v -> bid)
				$res .= '<option value="'.$v -> bid.'" selected>'.$v -> bname.'</option>';
			else
				$res .= '<option value="'.$v -> bid.'">'.$v -> bname.'</option>';
		return $res;
	}
}
