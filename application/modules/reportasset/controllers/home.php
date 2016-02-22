<?php
/* -*- tab-width: 2; indent-tabs-mode: nil; c-basic-offset: 2 -*- */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {
	function __construct() {
		parent::__construct();
		$this -> load -> library('pagination_lib');
		$this -> load -> model('reportasset_model');
		$this -> load -> library('branch/branch_lib');
	}

	function index() {
		$report = $this -> memcachedlib -> get('asset_' . $this -> memcachedlib -> sesresult['ubranchid'], true);
		if (!$report) {
			$stock = $this -> reportasset_model -> __get_stock_asset($this -> memcachedlib -> sesresult['ubranchid']);
			$stockcustomer = $this -> reportasset_model -> __get_stock_customer_asset($this -> memcachedlib -> sesresult['ubranchid']);

			$this -> memcachedlib -> set('asset_' . $this -> memcachedlib -> sesresult['ubranchid'], array('gudang' => $stock, 'customer' => $stockcustomer), 3600, true);
			
			$view['reportstock'] = $stock;
			$view['reportstockcustomer'] = $stockcustomer;
		}
		else {
			$view['reportstock'] = $report['gudang'];
			$view['reportstockcustomer'] = $report['customer'];
		}
		
		$this->load->view('reportasset', $view);
	}
}
