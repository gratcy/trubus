<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Publisher_lib {
    protected $_ci;

    function __construct() {
        $this->_ci = & get_instance();
        $this->_ci->load->model('publisher/publisher_model');
    }
    
    function __get_publisher($id='') {
		$area = $this -> _ci -> publisher_model -> __get_publisher_select();
		$res = '<option value=""></option>';
		foreach($area as $k => $v)
			if ($id == $v -> pid)
				$res .= '<option value="'.$v -> pid.'" selected>'.$v -> pname.'</option>';
			else
				$res .= '<option value="'.$v -> pid.'">'.$v -> pname.'</option>';
		return $res;
	}
}
