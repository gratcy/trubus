<?php
/* -*- tab-width: 2; indent-tabs-mode: nil; c-basic-offset: 2 -*- */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Session_lib {
	private $_ci;
	public $login=false;
	
	function __construct() {
		$this -> _ci =& get_instance();
		$this -> _ci -> load -> helper('cookie');
		$this -> _ci -> load -> library('session');
		
		if (isset($this -> _ci -> session -> userdata('login')['uemail']) && isset($this -> _ci -> session -> userdata('login')['uid']) && isset($this -> _ci -> session -> userdata('login')['skey']) == md5(sha1($this -> _ci -> session -> userdata('login')['ugid'].$this -> _ci -> session -> userdata('login')['uemail']) . 'mainan'))
			$this -> login = true;
		else
			$this -> login = false;
		self::__check_login();
		self::__check_remember();
	}
	
	function __check_remember() {
		if ($this -> login)
			if (isset($_COOKIE['login'])) {
				$login = json_decode($this -> _ci -> input -> cookie('login'), true);
				$this -> _ci -> session -> set_userdata(array('login' => array('uid' => $login['login']['uid'], 'uemail' => $login['login']['uemail'], 'ugid' => $login['login']['ugid'], 'permission' => $login['login']['permission'], 'skey' => $login['login']['skey'])));
			}
	}
	
	function __check_login() {
		if ($this -> _ci -> uri -> segment(1) !== 'login') {
			if (!$this -> login) redirect(site_url('login'));
		}
		else {
			if ($this -> _ci -> uri -> segment(2) !== 'logout') {
				if ($this -> login) redirect(site_url(''));
			}
		}
	}
}
