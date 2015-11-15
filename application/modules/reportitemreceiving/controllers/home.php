<?php
/* -*- tab-width: 2; indent-tabs-mode: nil; c-basic-offset: 2 -*- */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {
	function __construct() {
		parent::__construct();
		$this -> load -> library('publisher/publisher_lib');
		$this -> load -> library('branch/branch_lib');
		$this -> load -> model('reportitemreceiving_model');
		$this -> load -> helper('reportitemreceiving');
	}

	function index() {
		$view['done'] = false;
		$view['etype'] = '';
		
		if ($_POST) {
			$view['done'] = true;
			$view['etype'] = $this -> input -> post('etype');
			
			if (!$this -> input -> post('datesort')) {
				__set_error_msg(array('error' => 'Date range harus di isi !!!'));
				redirect(site_url('reportitemreceiving'));
			}
			else {
				$rtype = $this -> input -> post('rtype');
				$branchid = $this -> input -> post('branchid');
				$branch = $this -> input -> post('branch');
				$publisher = $this -> input -> post('publisher');
				$datesort = $this -> input -> post('datesort');
				$view['data'] = $this -> reportitemreceiving_model -> __get_reportitemreceiving($rtype,$publisher,$branch,$datesort);
				$view['pt'] = $_POST;
				$this->load->view('print/report_receiving', $view, FALSE);
				$this -> memcachedlib -> add('__report_item_receiving', $_POST, 3600);
			}
		}
		
		$view['branch'] = $this -> branch_lib -> __get_branch();
		$view['publisher'] = $this -> publisher_lib -> __get_publisher();
		$this->load->view('reportitemreceiving', $view);
	}
	
	function export($type) {
		$pt = $this -> memcachedlib -> get('__report_item_receiving');
		$view['data'] = $this -> reportitemreceiving_model -> __get_reportitemreceiving($pt['rtype'],$pt['publisher'],$pt['branch'],$pt['datesort']);
		$view['pt'] = $pt;
		$this -> memcachedlib -> delete('__report_item_receiving');
		$this->load->view('print/report_receiving', $view, FALSE);
	}
}
