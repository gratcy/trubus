<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sparepart_lib {
    protected $_ci;

    function __construct() {
        $this->_ci = & get_instance();
        $this->_ci->load->model('sparepart/sparepart_model');
    }
    
    function __get_sparepart($id='') {
		$users = $this -> _ci -> sparepart_model -> __get_sparepart_select();
		$res = '<option value=""></option>';
		foreach($users as $k => $v)
			if ($id == $v -> sid)
				$res .= '<option value="'.$v -> sid.'" selected>'.$v -> sname.'</option>';
			else
				$res .= '<option value="'.$v -> sid.'">'.$v -> sname.'</option>';
		return $res;
	}
}
