<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Publisher_lib {
    protected $_ci;

    function __construct() {
        $this->_ci = & get_instance();
        $this->_ci->load->model('publisher/publisher_model');
    }
    
    function __get_publisher($id='') {
		$pub = $this -> _ci -> publisher_model -> __get_publisher_select(1,0);
		$get_pub = $this -> _ci -> memcachedlib -> get('__publisher_select', true);
		
		if (!$get_pub) {
			$this -> _ci -> memcachedlib -> set('__publisher_select', $pub, 3600,true);
			$get_pub = $this -> _ci -> memcachedlib -> get('__publisher_select', true);
		}
		
		$res = '<option value="0">Main</option>';
		foreach($get_pub as $k => $v) {
			if ($id == $v['pid'])
				$res .= '<option value="'.$v['pid'].'" selected>'.$v['pname'].'</option>';
			else
				$res .= '<option value="'.$v['pid'].'">'.$v['pname'].'</option>';
			
			$pub2 = $this -> _ci -> publisher_model -> __get_publisher_select(2,$v['pid']);
			$get_pub2 = $this -> _ci -> memcachedlib -> get('__publisher_select_' . $v['pid'], true);
			
			if (!$get_pub2) {
				$this -> _ci -> memcachedlib -> set('__publisher_select_' . $v['pid'], $pub2, 3600,true);
				$get_pub2 = $this -> _ci -> memcachedlib -> get('__publisher_select_' . $v['pid'], true);
			}
			
			foreach($get_pub2 as $k => $v) {
				if ($id == $v['pid'])
					$res .= '<option value="'.$v['pid'].'" selected>-- '.$v['pname'].'</option>';
				else
					$res .= '<option value="'.$v['pid'].'">-- '.$v['pname'].'</option>';
			}
		}
		return $res;
	}
}
