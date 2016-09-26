<?php
/* -*- tab-width: 2; indent-tabs-mode: nil; c-basic-offset: 2 -*- */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {
	function __construct() {
		parent::__construct();
		$this -> load -> library('publisher/publisher_lib');
		$this -> load -> library('customer/customer_lib');
		$this -> load -> model('reportingstock_model');
		$this -> load -> model('books/books_model');
		$this -> load -> library('books/books_lib');
		$this -> load -> library('area/area_lib');
		$this -> load -> helper('reportingstock');
	}

	function index() {
		if ($_POST) {
			$type = "";
			$branchid = $this -> input -> post('branchid');
			$approval = $this -> input -> post('approval');
			
			$typea = $this -> input -> post('typea');
			$typeb = $this -> input -> post('typeb');
			$typec = $this -> input -> post('typec');
			$typed = $this -> input -> post('typed');
			$typee = $this -> input -> post('typee');
			$typef = $this -> input -> post('typef');
			$typeg = $this -> input -> post('typeg');
			$typeh = $this -> input -> post('typeh');
			$typei = $this -> input -> post('typei');
			$rtype = (int) $this -> input -> post('rtype');
			$typej = $this -> input -> post('typej');
			$typek = $this -> input -> post('typek');
			$typel = $this -> input -> post('typel');

			$datesort = $this -> input -> post('datesort');
			$customer = $this -> input -> post('customer');
			$customerr = $this -> input -> post('customerr');
			$kode_buku = $this -> input -> post('kode_buku');
			$kode_bukux = $this -> input -> post('kode_bukux');
			$area = $this -> input -> post('area');
			$areax = $this -> input -> post('areax');
			$publisher = $this -> input -> post('publisher');
			$publisherx = $this -> input -> post('publisherx');
			
			if (!$datesort) {
				__set_error_msg(array('error' => 'Date range harus di isi !!!'));
				redirect(site_url('reportingstock'));
			}
			else {
				@ini_set('memory_limit', '-1');
				$trans['data'] = array();
				$datesortx = explode("-",$datesort);
				$dsa = explode("/",$datesortx[0]);
				$dsb = explode("/",$datesortx[1]);
				
				$dsza = str_replace(" ","","$dsa[2]-$dsa[1]-$dsa[0]");
				$dszb = str_replace(" ","","$dsb[2]-$dsb[1]-$dsb[0]");

				if ($typea || $typeb || $typec || $typed || $typee || $typef || $typeg || $typeh || $typei) {
					if ($rtype == 0)
						$trans['data'] = $this -> reportingstock_model -> __get_transaction_idx($branchid,$approval,$dsza,$dszb,$customer,$customerr,$kode_buku,$kode_bukux,$area,$areax,$publisher,$publisherx,$typea,$typeb,$typec,$typed,$typee,$typef,$typeg,$typeh,$typei);
					else
						$trans['data'] = $this -> reportingstock_model -> __get_transaction_summary($_POST);
				}
				
				if ($typej || $typea) $trans['data'] = array_merge($trans['data'],$this -> reportingstock_model -> __get_transfer_record($branchid,$dsza,$dszb,$kode_buku,$kode_bukux,$rtype,$publisher,$approval));
				if ($typek || $typea) $trans['data'] = array_merge($trans['data'],$this -> reportingstock_model -> __get_receiving_record($branchid,$dsza,$dszb,$kode_buku,$kode_bukux,$rtype,$publisher,$approval));
				if ($typel || $typea) $trans['data'] = array_merge($trans['data'],$this -> reportingstock_model -> __get_request_record($branchid,$dsza,$dszb,$kode_buku,$kode_bukux,$rtype,$publisher,$approval));
				
				$trans['pt'] = $_POST;
				//~ usort($trans['data'], '__date_compare');
				$this->load->view('reportingx', $trans,FALSE);
			}
		}
		else{
			ob_start();
			ob_start();
			$view['publisher'] = $this -> publisher_lib -> __get_publisher(0,1);
			$view['customer'] = $this -> customer_lib -> __get_customer();
			$view['books'] = $this -> books_lib -> __get_books();
			$view['area'] = $this -> area_lib -> __get_area();
			$view['done'] = false;
			$this->load->view('reporting', $view);
			ob_end_flush();
			ob_end_flush();
		}
	}
	
	function print_reporting_stock() {
		$print = $this -> memcachedlib -> get('__print_reporting_stock');
		$view['books'] = array();
		if ($print) {
			$type = $print['type'];
			$datesort = explode(' - ',str_replace('/','-',$print['datesort']));
			$customer = $print['customer'];
			$publisher = $print['publisher'];
			$trans = $this -> reportingstock_model -> __get_transaction_ids($this -> memcachedlib -> sesresult['ubranchid'],$datesort,$customer,$type);
			if ($trans) {
				$ids = array();
				foreach($trans as $k => $v)
					$ids[] = $v -> tid;
				$bookid = $this -> reportingstock_model -> __get_transaction_details_bookid($ids,$publisher);
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
		$this->load->view('print/report_reporting_stock', $view, false);
	}
}
