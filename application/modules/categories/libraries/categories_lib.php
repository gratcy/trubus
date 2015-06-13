<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Categories_lib {
    protected $_ci;

    function __construct() {
        $this->_ci = & get_instance();
        $this->_ci->load->model('categories/categories_model');
    }
    
    function __get_categories($id='',$type) {
		$parent = $this -> _ci -> categories_model -> __get_categories_select(0);
		$res = '<option value="0">-- Main --</option>';
		foreach($parent as $k => $v) :
			if ($id == $v -> cid)
				$res .= '<option value="'.$v -> cid.'" selected>'.$v -> cname.'</option>';
			else
				$res .= '<option value="'.$v -> cid.'">'.$v -> cname.'</option>';
			$child = $this -> _ci -> categories_model -> __get_categories_select($v -> cid);
			foreach ($child as $a => $b) :
				if ($id == $b -> cid)
					$res .= '<option value="'.($type == 1 ? $v -> cid : $b -> cid).'" selected>-- '.$b -> cname.'</option>';
				else
					$res .= '<option value="'.($type == 1 ? $v -> cid : $b -> cid).'">-- '.$b -> cname.'</option>';
			endforeach;
		endforeach;
		return $res;
	}

}
