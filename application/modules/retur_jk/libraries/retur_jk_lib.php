<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class retur_jk_lib {
    protected $_ci;

    function __construct() {
        $this->_ci = & get_instance();
        $this->_ci->load->model('retur_jk/retur_jk_model');
    }
    
    function __get_retur_jk($id='') {
		$retur_jk = $this -> _ci -> retur_jk_model -> __get_retur_jk_select();
		$res = '<option value=""></option>';
		foreach($retur_jk as $k => $v)
			if ($id == $v -> bid)
				$res .= '<option value="'.$v -> bid.'" selected>'.$v -> bname.'</option>';
			else
				$res .= '<option value="'.$v -> bid.'">'.$v -> bname.'</option>';
		return $res;
	}
}
