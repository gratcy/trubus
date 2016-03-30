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
	}

	function index() {

		if ($_POST) {
		if(!isset($_POST['typea'])){ $_POST['typea']="";}
		if(!isset($_POST['typeb'])){ $_POST['typeb']="";}
		if(!isset($_POST['typec'])){ $_POST['typec']="";}
		if(!isset($_POST['typed'])){ $_POST['typed']="";}
		if(!isset($_POST['typee'])){ $_POST['typee']="";}
		if(!isset($_POST['typef'])){ $_POST['typef']="";}
		if(!isset($_POST['typeg'])){ $_POST['typeg']="";}
		if(!isset($_POST['typeh'])){ $_POST['typeh']="";}
		if(!isset($_POST['typei'])){ $_POST['typei']="";}			
			//print_r($_POST);die;
			$branchid=$_POST['branchid'];
			$approval=$_POST['approval'];
			$typea=$_POST['typea'];
			$typeb=$_POST['typeb'];
			$typec=$_POST['typec'];
			$typed=$_POST['typed'];
			$typee=$_POST['typee'];
			$typef=$_POST['typef'];
			$typeg=$_POST['typeg'];
			$typeh=$_POST['typeh'];
			$typei=$_POST['typei'];
			$datesort=$_POST['datesort'];
			$datesortx=explode("-",$datesort);
			$dsa=explode("/",$datesortx[0]);
			$dsb=explode("/",$datesortx[1]);

			$dsza=str_replace(" ","","$dsa[2]-$dsa[1]-$dsa[0]");
			$dszb=str_replace(" ","","$dsb[2]-$dsb[1]-$dsb[0]");
			$customer=$_POST['customer'][0];
			$customerr=$_POST['customerr'][0];
			$kode_buku=$_POST['kode_buku'];
			$kode_bukux=$_POST['kode_bukux'];
			$area=$_POST['area'];
			$areax=$_POST['areax'];	
			$publisher=$_POST['publisher'];
			$publisherx=$_POST['publisherx'];			
			//echo "$status,$type[0],$dsza,$dszb,$customer,$kode_buku";die;
			// $this->print_reporting_stock() ;
			// $this -> memcachedlib -> add('__print_reporting_stock', $_POST, 3600);
			$trans['data'] = $this -> reportingstock_model -> __get_transaction_idx($branchid,$approval,$type,$dsza,$dszb,$customer,$customerr,$kode_buku,$kode_bukux,$area,$areax,$publisher,$publisherx,
			$typea,$typeb,$typec,$typed,$typee,$typef,$typeg,$typeh,$typei);
			// echo '<pre>';
			// print_r($trans[data]);
			// echo '</pre>';
			// die;
			//$view['done'] = true;
			$this->load->view('reportingx', $trans,FALSE);
		}else{
		$view['publisher'] = $this -> publisher_lib -> __get_publisher();
		$view['customer'] = $this -> customer_lib -> __get_customer();
		$view['books'] = $this -> books_lib -> __get_books();
		$view['area'] = $this -> area_lib -> __get_area();
		
		$this->load->view('reporting', $view);
		}
	}
	
	function print_reporting_stock() {
		
		$print = $this -> memcachedlib -> get('__print_reporting_stock');
		$view['books'] = array();
		if (!$print) {
			
		}
		else {
			
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
