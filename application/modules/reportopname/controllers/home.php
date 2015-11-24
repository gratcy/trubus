<?php
/* -*- tab-width: 2; indent-tabs-mode: nil; c-basic-offset: 2 -*- */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {
	function __construct() {
		parent::__construct();
		$this -> load -> library('pagination_lib');
		$this -> load -> model('reportopname_model');
	}

	function index() {
		$view['reportopname'] = $this -> reportopname_model -> __get_reportopname(strtotime('-2 months', time()),time(),$this -> memcachedlib -> sesresult['ubranchid']);
		$view['from'] = date('d/m/Y', strtotime('-1 month', time()));
		$view['to'] = date('d/m/Y');
		$this->load->view('reportopname', $view);
	}
	
	function sortreport($from,$to) {
		$datesort = $this -> input -> post('datesort', TRUE);
		if ($datesort) {
			$datesort = explode(' - ', $datesort);
			$from = strtotime(str_replace('/','-',$datesort[0]));
			$to = strtotime(str_replace('/','-',$datesort[1]));
			redirect(site_url('reportopname/sortreport/'.$from.'/'.$to));
		}
		else {
			$view['reportopname'] = $this -> reportopname_model -> __get_reportopname($from, $to, $this -> memcachedlib -> sesresult['ubranchid']);
			$view['from'] = date('d/m/Y',$from);
			$view['to'] = date('d/m/Y',$to);
			$this->load->view('reportopname', $view);
		}
	}
}
