<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Branch_lib {
    protected $_ci;

    function __construct() {
        $this->_ci = & get_instance();
        $this->_ci->load->model('branch/branch_model');
    }
    
    function __get_branch($id='') {
		$branch = $this -> _ci -> branch_model -> __get_branch_select();
		$res = '<option value=""></option>';
		foreach($branch as $k => $v)
			if ($id == $v -> bid)
				$res .= '<option value="'.$v -> bid.'" selected>'.$v -> bname.'</option>';
			else
				$res .= '<option value="'.$v -> bid.'">'.$v -> bname.'</option>';
		return $res;
	}
}
