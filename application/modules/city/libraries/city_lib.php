<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class City_lib {
    protected $_ci;

    function __construct() {
        $this->_ci = & get_instance();
        $this->_ci->load->model('city/city_model');
    }
    
    function __get_city($id='') {
		$city = $this -> _ci -> city_model -> __get_city_select();
		$res = '<option value=""></option>';
		foreach($city as $k => $v)
			if ($id == $v -> cid)
				$res .= '<option value="'.$v -> cid.'" selected>'.$v -> cname.'</option>';
			else
				$res .= '<option value="'.$v -> cid.'">'.$v -> cname.'</option>';
		return $res;
	}
}
