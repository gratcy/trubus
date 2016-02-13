<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {
	function __construct() {
		parent::__construct();
	}

	function index() {
		$this->load->view('index', '');
	}

	function switchbranch($id) {
		$login = $this -> memcachedlib -> get('__login');
		$login['ubranchid'] = $id;
		$login['ubranch'] = __get_branch($id, 1);
		$this -> memcachedlib -> __regenerate_cache('__login', $login, false);
		redirect($_SERVER['HTTP_REFERER']);
	}
}
