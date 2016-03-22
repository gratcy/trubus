<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users_lib {
    protected $_ci;

    function __construct() {
        $this->_ci = & get_instance();
        $this->_ci->load->model('users/users_model');
    }
    
    function __get_groups($id='') {
		$users = $this -> _ci -> users_model -> __get_groups();
		$res = '<option value=""></option>';
		foreach($users as $k => $v)
			if ($id == $v -> gid)
				$res .= '<option value="'.$v -> gid.'" selected>'.$v -> gname.'</option>';
			else
				$res .= '<option value="'.$v -> gid.'">'.$v -> gname.'</option>';
		return $res;
	}
    
    function __get_user($id='') {
		$users = $this -> _ci -> users_model -> __get_users_select();
		$res = '<option value=""></option>';
		foreach($users as $k => $v)
			if ($id == $v -> uid)
				$res .= '<option value="'.$v -> uid.'" selected>'.$v -> uemail.'</option>';
			else
				$res .= '<option value="'.$v -> uid.'">'.$v -> uemail.'</option>';
		return $res;
	}
}
