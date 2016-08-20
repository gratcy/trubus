<?php
/* -*- tab-width: 2; indent-tabs-mode: nil; c-basic-offset: 2 -*- */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {
	function __construct() {
		parent::__construct();
		$this -> load -> library('pagination_lib');
		$this -> load -> library('branch/branch_lib');
		$this -> load -> library('books/books_lib');
		$this -> load -> model('inventory/inventory_model');
		$this -> load -> model('adjustment_model');
	}

	function index() {
		$pager = $this -> pagination_lib -> pagination($this -> adjustment_model -> __get_adjustmentinventory(),3,10,site_url('adjustment'));
		$view['adjustment'] = $this -> pagination_lib -> paginate();
		$view['pages'] = $this -> pagination_lib -> pages();
		$this->load->view('adjustment', $view);
	}
}
