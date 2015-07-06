<?php
/* -*- tab-width: 2; indent-tabs-mode: nil; c-basic-offset: 2 -*- */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {
	function __construct() {
		parent::__construct();
		$this -> load -> library('publisher/publisher_lib');
		$this -> load -> library('customer/customer_lib');
		$this -> load -> model('reportcardstock_model');
		$this -> load -> model('books/books_model');
	}

	function index() {
		if ($_POST) {
			$this -> memcachedlib -> add('__print_card_stock', $_POST, 3600);
			$view['done'] = true;
		}
		$view['publisher'] = $this -> publisher_lib -> __get_publisher();
		$view['customer'] = $this -> customer_lib -> __get_customer();
		$this->load->view('reportcardstock', $view);
	}
	
	function print_card_stock() {
		$print = $this -> memcachedlib -> get('__print_card_stock');
		$view['books'] = array();
		if (!$print) {
			
		}
		else {
			$type = $print['type'];
			$datesort = explode(' - ',str_replace('/','-',$print['datesort']));
			$customer = $print['customer'];
			$publisher = $print['publisher'];
			$trans = $this -> reportcardstock_model -> __get_transaction_ids($this -> memcachedlib -> sesresult['ubranchid'],$datesort,$customer,$type);
			if ($trans) {
				$ids = array();
				foreach($trans as $k => $v)
					$ids[] = $v -> tid;
				$bookid = $this -> reportcardstock_model -> __get_transaction_details_bookid($ids,$publisher);
				$ids2 = array();
				$ids3 = array();
				foreach($bookid as $k => $v) {
					$ids2[] = $v -> tbid;
					$ids3[] = $v -> ttid;
				}
				if (count($ids2) > 0) $view['books'] = $this -> books_model -> __get_books_by_id($ids2);
			}
			$view['ids3'] = array_unique($ids3);
			$view['branch'] = $this -> memcachedlib -> sesresult['ubranchid'];
		}
		$this->load->view('print/report_card_stock', $view, false);
	}
}
