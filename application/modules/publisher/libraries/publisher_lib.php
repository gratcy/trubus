<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Publisher_lib {
    protected $_ci;

    function __construct() {
        $this->_ci = & get_instance();
        $this->_ci->load->model('publisher/publisher_model');
    }
    
    function __get_publisher($id='') {
		$pub = $this -> _ci -> publisher_model -> __get_publisher_select(1,0);
		$res = '<option value="0">Main</option>';
		foreach($pub as $k => $v) {
			if ($id == $v -> pid)
				$res .= '<option value="'.$v -> pid.'" selected>'.$v -> pname.'</option>';
			else
				$res .= '<option value="'.$v -> pid.'">'.$v -> pname.'</option>';
			
			$pub2 = $this -> _ci -> publisher_model -> __get_publisher_select(2,$v -> pid);
			foreach($pub2 as $k => $v) {
				if ($id == $v -> pid)
					$res .= '<option value="'.$v -> pid.'" selected>-- '.$v -> pname.'</option>';
				else
					$res .= '<option value="'.$v -> pid.'">-- '.$v -> pname.'</option>';
			}
		}
		return $res;
	}
}
