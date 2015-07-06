<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Customer_lib {
    protected $_ci;

    function __construct() {
        $this->_ci = & get_instance();
        $this->_ci->load->model('customer/customer_model');
    }
    
    function __get_customer($id='') {
		$get_customer = $this -> _ci -> memcachedlib -> get('__customer_select', true);
		
		if (!$get_customer) {
			$customer = $this -> _ci -> customer_model -> __get_customer_select($this -> _ci -> memcachedlib -> sesresult['ubranchid']);
			$this -> _ci -> memcachedlib -> set('__customer_select', $customer, 3600,true);
			$get_customer = $this -> _ci -> memcachedlib -> get('__customer_select', true);
		}
		
		$res = '';
		foreach($get_customer as $k => $v)
			if ($id == $v['cid'])
				$res .= '<option value="'.$v['cid'].'" selected>'.$v['cname'].'</option>';
			else
				$res .= '<option value="'.$v['cid'].'">'.$v['cname'].'</option>';
		return $res;
	}
	
    function __get_customer_consinyasi($id='') {
		$get_customer = $this -> _ci -> memcachedlib -> get('__customer_select_consinyasi', true);
		
		if (!$get_customer) {
			$customer = $this -> _ci -> customer_model -> __get_customer_consinyasi_select($this -> _ci -> memcachedlib -> sesresult['ubranchid']);
			$this -> _ci -> memcachedlib -> set('__customer_select_consinyasi', $customer, 3600,true);
			$get_customer = $this -> _ci -> memcachedlib -> get('__customer_select_consinyasi', true);
		}
		$res = '<option value=""></option>';
		foreach($get_customer as $k => $v)
			if ($id == $v['cid'])
				$res .= '<option value="'.$v['cid'].'" selected>'.$v['cname'].'</option>';
			else
				$res .= '<option value="'.$v['cid'].'">'.$v['cname'].'</option>';
		return $res;
	}	
	
}
