<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rawmaterial_lib {
    protected $_ci;

    function __construct() {
        $this->_ci = & get_instance();
        $this->_ci->load->model('rawmaterial/rawmaterial_model');
    }
    
    function __get_rawmaterial($id='') {
		$users = $this -> _ci -> rawmaterial_model -> __get_rawmaterial_select();
		$res = '<option value=""></option>';
		foreach($users as $k => $v)
			if ($id == $v -> rid)
				$res .= '<option value="'.$v -> rid.'" selected>'.$v -> rname.'</option>';
			else
				$res .= '<option value="'.$v -> rid.'">'.$v -> rname.'</option>';
		return $res;
	}
}
