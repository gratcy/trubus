<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {
	function __construct() {
		parent::__construct();
		$this -> load -> model('printpage_model');
		$this -> load -> library('customer/customer_lib');
	}

	function penawaran($id) {
		if ($_POST) {
			$cust = (int) $this -> input -> post('cust');
			if (!$cust) redirect(current_url());
			$view['cdetail'] = $this -> printpage_model -> __get_customer($cust);
			$view['bhname'] = $this -> printpage_model -> __get_branch_head($this -> memcachedlib -> sesresult['ubranchid']);
			$view['detail'] = $this -> printpage_model -> __get_books_detail($id);
			$view['oplah'] = $this -> printpage_model -> __get_oplah($id, $this -> memcachedlib -> sesresult['ubranchid']);
			
			$this->load->view('print/penawaran', $view, false);
		}
		else {
			$view['customer'] = $this -> customer_lib -> __get_customer();
			$this->load->view('print/penawaran_customer', $view, false);
		}
	}

	function letter($id) {
		$this->load->view('print/letter', '', false);
	}
}
