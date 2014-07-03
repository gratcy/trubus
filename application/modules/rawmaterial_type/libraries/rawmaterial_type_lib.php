<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rawmaterial_type_lib {
    protected $_ci;

    function __construct() {
        $this->_ci = & get_instance();
        $this->_ci->load->model('rawmaterial_type/rawmaterial_type_model');
    }
    
    function __get_rawmaterial_type($id='') {
		$users = $this -> _ci -> rawmaterial_type_model -> __get_rawmaterial_type_select();
		$res = '<option value=""></option>';
		foreach($users as $k => $v)
			if ($id == $v -> cid)
				$res .= '<option value="'.$v -> cid.'" selected>'.$v -> cname.'</option>';
			else
				$res .= '<option value="'.$v -> cid.'">'.$v -> cname.'</option>';
		return $res;
	}

}
