<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {
	function __construct() {
		parent::__construct();
		$this -> load -> model('home_model');
	}

	function index() {
		$data['total']['books'] = $this -> home_model -> __get_total_books();
		$data['total']['customer'] = $this -> home_model -> __get_total_customer($this -> memcachedlib -> sesresult['ubranchid']);
		$data['total']['stock'] = $this -> home_model -> __get_total_stock($this -> memcachedlib -> sesresult['ubranchid']);
		$data['total']['order'] = $this -> home_model -> __get_total_order($this -> memcachedlib -> sesresult['ubranchid']);
		$this->load->view('index', $data);
	}

	function switchbranch($id) {
		if ($this -> memcachedlib -> sesresult['uid'] == 26 || $this -> memcachedlib -> sesresult['uid'] == 69 || $this -> memcachedlib -> sesresult['uid'] == 28 || $this -> memcachedlib -> sesresult['uid'] == 11 || $this -> memcachedlib -> sesresult['uid'] == 22 || $this -> memcachedlib -> sesresult['uid'] == 1) {
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
