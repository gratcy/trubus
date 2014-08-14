<?php
/* -*- tab-width: 2; indent-tabs-mode: nil; c-basic-offset: 2 -*- */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {
	function __construct() {
		parent::__construct();
		$this -> load -> library('pagination_lib');
		$this -> load -> model('journal_model');
	}

	function index() {
		$view = '';
		//~ $pager = $this -> pagination_lib -> pagination($this -> journal_model -> __get_journal(),3,10,site_url('journal'));
		//~ $view['journal'] = $this -> pagination_lib -> paginate();
		//~ $view['pages'] = $this -> pagination_lib -> pages();
		$this->load->view('journal', $view);
	}
	
	function journal_export() {
		header('Location: ' . site_url('application/modules/journal/journal.xlsx'));
	}
}
