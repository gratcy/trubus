<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Area_lib {
    protected $_ci;

    function __construct() {
        $this->_ci = & get_instance();
        $this->_ci->load->model('area/area_model');
    }
    
    function __get_area($id='') {
		$get_area = $this -> _ci -> memcachedlib -> get('__area_select', true);
		
		if (!$get_area) {
			$area = $this -> _ci -> area_model -> __get_area_select($this -> _ci -> memcachedlib -> sesresult['ubranchid']);
			$this -> _ci -> memcachedlib -> set('__area_select', $area, 3600,true);
			$get_area = $this -> _ci -> memcachedlib -> get('__area_select', true);
		}
		
		$res = '<option value=""></option>';
		foreach($get_area as $k => $v)
			if ($id == $v['aid'])
				$res .= '<option value="'.$v['aid'].'" selected>'.$v['aname'].'</option>';
			else
				$res .= '<option value="'.$v['aid'].'">'.$v['aname'].'</option>';
		return $res;
	}
	
	
	
	
    function __get_areaz($id='') {
		$get_area = $this -> _ci -> memcachedlib -> get('__area_select', true);
		
		if (!$get_area) {
			$area = $this -> _ci -> area_model -> __get_area_select($this -> _ci -> memcachedlib -> sesresult['ubranchid']);
			$this -> _ci -> memcachedlib -> set('__area_select', $area, 3600,true);
			$get_area = $this -> _ci -> memcachedlib -> get('__area_select', true);
		}
		
		$res = '<option value=""></option>';
		foreach($get_area as $k => $v)
			if ($id == $v['aid'])
				$res .= '<option value="'.$v['aname'].'" selected>'.$v['aname'].'</option>';
			else
				$res .= '<option value="'.$v['aname'].'">'.$v['aname'].'</option>';
		return $res;
	}	
	
}
