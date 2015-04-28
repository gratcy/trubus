<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class retur_hp_detail_lib {
    protected $_ci;

    function __construct() {
        $this->_ci = & get_instance();
        $this->_ci->load->model('retur_hp_detail/retur_hp_detail_model');
    }
    
    function __get_retur_hp_detail($id='') {
		$retur_hp_detail = $this -> _ci -> retur_hp_detail_model -> __get_retur_hp_detail_select();
		$res = '<option value=""></option>';
		foreach($retur_hp_detail as $k => $v)
			if ($id == $v -> bid)
				$res .= '<option value="'.$v -> bid.'" selected>'.$v -> bname.'</option>';
			else
				$res .= '<option value="'.$v -> bid.'">'.$v -> bname.'</option>';
		return $res;
	}
}
