<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class retur_bk_detail_lib {
    protected $_ci;

    function __construct() {
        $this->_ci = & get_instance();
        $this->_ci->load->model('retur_bk_detail/retur_bk_detail_model');
    }
    
    function __get_retur_bk_detail($id='') {
		$retur_bk_detail = $this -> _ci -> retur_bk_detail_model -> __get_retur_bk_detail_select();
		$res = '<option value=""></option>';
		foreach($retur_bk_detail as $k => $v)
			if ($id == $v -> bid)
				$res .= '<option value="'.$v -> bid.'" selected>'.$v -> bname.'</option>';
			else
				$res .= '<option value="'.$v -> bid.'">'.$v -> bname.'</option>';
		return $res;
	}
}
