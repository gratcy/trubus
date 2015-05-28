<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {
	function __construct() {
		parent::__construct();
		$this -> load -> model('closingperiod_model');
	}

	function index() {
		if ($_POST) {
			$periodid = (int) $this -> input -> post('periodid');
			if ($periodid) {
				$now = time();
				if ($this -> closingperiod_model -> __update_period($periodid, array('auid' => $this -> memcachedlib -> sesresult['uid'], 'aend' => $now, 'astatus' => 0))) {				
					$this -> closingperiod_model -> __insert_period(array('auid' => $this -> memcachedlib -> sesresult['uid'], 'aname' => date('Y') .' - '. (date('Y')+1),'astart' => strtotime(date('Y-m-d',$now) . ' +1 day'), 'adesc' => 'Period ' . date('Y') .' - '. (date('Y')+1), 'astatus' => 1));
					$this -> memcachedlib -> set('__history_closing_period', $this -> closingperiod_model -> __get_period_history(), 100);
					__set_error_msg(array('info' => 'Tutup Buku berhasil dilakukan.'));
				}
			}
			redirect(site_url('closingperiod'));
		}
		else {
			$view['pactive'] = $this -> closingperiod_model -> __get_period_active();
			$history = $this -> memcachedlib -> get('__history_closing_period');
			if (count($history) > 0) $view['history'] = $history;
			$this->load->view('closingperiod', $view);
		}
	}
}
