<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Category_arsip_lib {
    protected $_ci;

    function __construct() {
        $this->_ci = & get_instance();
        $this->_ci->load->model('category_arsip/category_arsip_model');
    }
    
    function __get_category_arsip($id='') {
		$area = $this -> _ci -> category_arsip_model -> __get_category_arsip_select(1,0);
		$res = '<option value="0">Main</option>';
		foreach($area as $k => $v) :
			$child = $this -> _ci -> category_arsip_model -> __get_category_arsip_select(2, $v -> cid);
			if ($id == $v -> cid)
				$res .= '<option value="'.$v -> cid.'" selected>'.$v -> cname.'</option>';
			else
				$res .= '<option value="'.$v -> cid.'">'.$v -> cname.'</option>';
			foreach($child as $key => $val) :
				if ($id == $val -> cid)
					$res .= '<option value="'.$val -> cid.'" selected>-- '.$val -> cname.'</option>';
				else
					$res .= '<option value="'.$val -> cid.'">-- '.$val -> cname.'</option>';
			endforeach;
		endforeach;
		return $res;
	}
}
