<?php
/* -*- tab-width: 2; indent-tabs-mode: nil; c-basic-offset: 2 -*- */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {
	function __construct() {
		parent::__construct();
		$this -> load -> library('pagination_lib');
		$this -> load -> model('generalledger_model');
		$this -> load -> model('closingperiod/closingperiod_model');
	}

	function index() {
		$view['generalledger'] = $this -> generalledger_model -> __get_generalledger();
		$this->load->view('generalledger', $view);
	}
}
