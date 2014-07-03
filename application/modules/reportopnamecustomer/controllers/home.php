<?php
/* -*- tab-width: 2; indent-tabs-mode: nil; c-basic-offset: 2 -*- */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {
	function __construct() {
		parent::__construct();
		$this -> load -> library('pagination_lib');
		$this -> load -> model('reportopnamecustomer_model');
	}

	function index($type=1) {
		if (!$type) $type = 1;
		$pager = $this -> pagination_lib -> pagination($this -> reportopnamecustomer_model -> __get_reportopnamecustomer($type),3,10,site_url('reportopname/' . $type));
		$view['reportopnamecustomer'] = $this -> pagination_lib -> paginate();
		$view['pages'] = $this -> pagination_lib -> pages();
		$view['type'] = $type;
		$view['from'] = date('d/m/Y', strtotime('-1 month', time()));
		$view['to'] = date('d/m/Y');
		$this->load->view('reportopnamecustomer', $view);
	}
	
	function sortreport($from,$to) {
		$datesort = $this -> input -> post('datesort', TRUE);
		if ($datesort) {
			$datesort = explode(' - ', $datesort);
			$from = strtotime(str_replace('/','-',$datesort[0]));
			$to = strtotime(str_replace('/','-',$datesort[1]));
			redirect(site_url('reportopnamecustomer/sortreport/'.$from.'/'.$to));
		}
		else {
			$view['from'] = date('d/m/Y',$from);
			$view['to'] = date('d/m/Y',$to);
			$pager = $this -> pagination_lib -> pagination($this -> reportopnamecustomer_model -> __get_reportopnamecustomer($from, $to),3,10,site_url('reportopname'));
			$view['reportopnamecustomer'] = $this -> pagination_lib -> paginate();
			$view['pages'] = $this -> pagination_lib -> pages();
			$this->load->view('reportopnamecustomer', $view);
		}
	}
}
