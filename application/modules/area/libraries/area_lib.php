<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Area_lib {
    protected $_ci;

    function __construct() {
        $this->_ci = & get_instance();
        $this->_ci->load->model('area/area_model');
    }
    
    function __get_area($id='') {
		$area = $this -> _ci -> area_model -> __get_area_select();
		$res = '<option value=""></option>';
		foreach($area as $k => $v)
			if ($id == $v -> aid)
				$res .= '<option value="'.$v -> aid.'" selected>'.$v -> aname.'</option>';
			else
				$res .= '<option value="'.$v -> aid.'">'.$v -> aname.'</option>';
		return $res;
	}
}
