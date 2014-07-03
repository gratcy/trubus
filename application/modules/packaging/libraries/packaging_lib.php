<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Packaging_lib {
    protected $_ci;

    function __construct() {
        $this->_ci = & get_instance();
        $this->_ci->load->model('packaging/packaging_model');
    }
    
    function __get_packaging($id='') {
		$users = $this -> _ci -> packaging_model -> __get_packaging_select();
		$res = '<option value=""></option>';
		foreach($users as $k => $v)
			if ($id == $v -> cid)
				$res .= '<option value="'.$v -> cid.'" selected>'.$v -> cname.'</option>';
			else
				$res .= '<option value="'.$v -> cid.'">'.$v -> cname.'</option>';
		return $res;
	}

}
