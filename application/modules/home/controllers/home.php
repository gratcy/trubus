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
		if ($this -> memcachedlib -> sesresult['uid'] == 26 || $this -> memcachedlib -> sesresult['uid'] == 28 || $this -> memcachedlib -> sesresult['uid'] == 11 || $this -> memcachedlib -> sesresult['uid'] == 22 || $this -> memcachedlib -> sesresult['uid'] == 1) {
			$login = $this -> memcachedlib -> get('__login');
			$login['ubranchid'] = $id;
			$login['ubranch'] = __get_branch($id, 1);
			$this -> memcachedlib -> __regenerate_cache('__login', $login, false);
			redirect($_SERVER['HTTP_REFERER']);
		}
		else
			redirect(site_url());
	}
}
