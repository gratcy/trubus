<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class retur_bk_lib {
    protected $_ci;

    function __construct() {
        $this->_ci = & get_instance();
        $this->_ci->load->model('retur_bk/retur_bk_model');
    }
    
    function __get_retur_bk($id='') {
		$retur_bk = $this -> _ci -> retur_bk_model -> __get_retur_bk_select();
		$res = '<option value=""></option>';
		foreach($retur_bk as $k => $v)
			if ($id == $v -> bid)
				$res .= '<option value="'.$v -> bid.'" selected>'.$v -> bname.'</option>';
			else
				$res .= '<option value="'.$v -> bid.'">'.$v -> bname.'</option>';
		return $res;
	}
}
