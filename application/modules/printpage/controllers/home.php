<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {
	function __construct() {
		parent::__construct();
	}

	function penawaran($id) {
		$this->load->view('print/penawaran', '', false);
	}

	function letter($id) {
		$this->load->view('print/letter', '', false);
	}
}
