<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Coagroup_lib {
    protected $_ci;

    function __construct() {
        $this->_ci = & get_instance();
        $this->_ci->load->model('coagroup/coagroup_model');
    }
    
    function __get_coagroup($id=0) {
		$coa = $this -> _ci -> coagroup_model -> __get_coagroup_select();
		$html = '';
		foreach ($coa as $k => $v) {
			if ($id == $v -> cid)
				$html.= '<option value="'.$v -> cid.'" selected>'.$v -> cname.'</option>';
			else
				$html.= '<option value="'.$v -> cid.'">'.$v -> cname.'</option>';
		}
		return $html;
	}
}
