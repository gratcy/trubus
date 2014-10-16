<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {
	function __construct() {
		parent::__construct();
		$this -> load -> model('printpage_model');
	}

	function penawaran($id) {
		$view['detail'] = $this -> printpage_model -> __get_books_detail($id);
		$this->load->view('print/penawaran', $view, false);
	}

	function letter($id) {
		$this->load->view('print/letter', '', false);
	}
}
