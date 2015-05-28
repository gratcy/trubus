<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Coa_lib {
    protected $_ci;

    function __construct() {
        $this->_ci = & get_instance();
        $this->_ci->load->model('coa/coa_model');
    }
    
    function __get_coa($id=0, $arr=array()) {
		$coa = $this -> _ci -> coa_model -> __get_coa_select();
		
		$carr = __get_coa_arr($coa,0);
		if (!function_exists('__toSelect')) {
			function __toSelect($id, $arr, $pass = 0) {
				$html = '';
				foreach ( $arr as $v ) {
					if ($id == $v -> cid)
						$html.= '<option value="'.$v -> cid.'" selected>';
					else
						$html.= '<option value="'.$v -> cid.'">';
					$html .= str_repeat("--", $pass);
					$html .= $v -> cname . '</option>' . PHP_EOL;
					if (isset($v -> cchild)) $html.= __toSelect($id, $v -> cchild, $pass+1);
				}
				return $html;
			}
		}
		return __toSelect($id, $carr);
	}
}
