<?php
/* -*- tab-width: 2; indent-tabs-mode: nil; c-basic-offset: 2 -*- */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {
	function __construct() {
		parent::__construct();
		$this -> load -> library('pagination_lib');
		$this -> load -> model('reportopname_model');
	}

	function index($type=1) {
		if (!$type) $type = 1;
		$pager = $this -> pagination_lib -> pagination($this -> reportopname_model -> __get_reportopname($type),3,10,site_url('reportopname/' . $type));
		$view['reportopname'] = $this -> pagination_lib -> paginate();
		$view['pages'] = $this -> pagination_lib -> pages();
		$view['type'] = $type;
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
			$view['from'] = date('d/m/Y',$from);
			$view['to'] = date('d/m/Y',$to);
			$pager = $this -> pagination_lib -> pagination($this -> reportopname_model -> __get_reportopname($from, $to),3,10,site_url('reportopname'));
			$view['reportopname'] = $this -> pagination_lib -> paginate();
			$view['pages'] = $this -> pagination_lib -> pages();
			$this->load->view('reportopname', $view);
		}
	}
}
