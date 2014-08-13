<?php
/* -*- tab-width: 2; indent-tabs-mode: nil; c-basic-offset: 2 -*- */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {
	function __construct() {
		parent::__construct();
		$this -> load -> library('pagination_lib');
		$this -> load -> model('reportstock_model');
	}

	function index() {
		$pager = $this -> pagination_lib -> pagination($this -> reportstock_model -> __get_reportstock(),3,10,site_url('reportstock'));
		$view['reportstock'] = $this -> pagination_lib -> paginate();
		$view['pages'] = $this -> pagination_lib -> pages();
		$view['from'] = date('d/m/Y', strtotime('-1 month', time()));
		$view['to'] = date('d/m/Y');
		$this->load->view('reportstock', $view);
	}
	
	function sortreport($from,$to) {
		$datesort = $this -> input -> post('datesort', TRUE);
		if ($datesort) {
			$datesort = explode(' - ', $datesort);
			$from = strtotime(str_replace('/','-',$datesort[0]));
			$to = strtotime(str_replace('/','-',$datesort[1]));
			redirect(site_url('reportstock/sortreport/'.$from.'/'.$to));
		}
		else {
			$view['from'] = date('d/m/Y',$from);
			$view['to'] = date('d/m/Y',$to);
			$pager = $this -> pagination_lib -> pagination($this -> reportstock_model -> __get_reportstock($from, $to),3,10,site_url('reportstock'));
			$view['reportstock'] = $this -> pagination_lib -> paginate();
			$view['pages'] = $this -> pagination_lib -> pages();
			$this->load->view('reportstock', $view);
		}
	}
}
