<?php
/* -*- tab-width: 2; indent-tabs-mode: nil; c-basic-offset: 2 -*- */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {
	function __construct() {
		parent::__construct();
		$this -> load -> library('pagination_lib');
		$this -> load -> model('reportstockposition_model');
		$this -> load -> helper('reportstockposition');
	}

	function index() {
		$pager = $this -> pagination_lib -> pagination($this -> reportstockposition_model -> __get_stockposition_branch($this -> memcachedlib -> sesresult['ubranchid']),3,10,site_url('reportstockposition'));
		$view['reportstockposition'] = $this -> pagination_lib -> paginate();
		$view['pages'] = $this -> pagination_lib -> pages();
		$view['branch'] = $this -> memcachedlib -> sesresult['ubranchid'];
		$this->load->view('reportstockposition', $view);
	}

	function customer() {
		$pager = $this -> pagination_lib -> pagination($this -> reportstockposition_model -> __get_stockposition_customer($this -> memcachedlib -> sesresult['ubranchid']),3,10,site_url('reportstockposition/customer'));
		$view['reportstockposition'] = $this -> pagination_lib -> paginate();
		$view['pages'] = $this -> pagination_lib -> pages();
		$view['branch'] = $this -> memcachedlib -> sesresult['ubranchid'];
		$this->load->view('reportstockposition_customer', $view);
	}

	function area() {
		$pager = $this -> pagination_lib -> pagination($this -> reportstockposition_model -> __get_stockposition_area($this -> memcachedlib -> sesresult['ubranchid']),3,10,site_url('reportstockposition/area'));
		$view['reportstockposition'] = $this -> pagination_lib -> paginate();
		$view['pages'] = $this -> pagination_lib -> pages();
		$view['branch'] = $this -> memcachedlib -> sesresult['ubranchid'];
		$this->load->view('reportstockposition_area', $view);
	}

	function book() {
		$pager = $this -> pagination_lib -> pagination($this -> reportstockposition_model -> __get_stockposition_book($this -> memcachedlib -> sesresult['ubranchid']),3,10,site_url('reportstockposition/book'));
		$view['reportstockposition'] = $this -> pagination_lib -> paginate();
		$view['pages'] = $this -> pagination_lib -> pages();
		$view['branch'] = $this -> memcachedlib -> sesresult['ubranchid'];
		$this->load->view('reportstockposition_book', $view);
	}
	
	function search() {
		$keyword = urlencode(base64_encode($this -> input -> post('keyword', true)));
		$type = (int) $this -> input -> post('type', true);
		
		if ($type == 1) $type = 'branch/';
		elseif ($type == 2) $type = 'customer/';
		elseif ($type == 3) $type = 'area/';
		else $type = 'book/';
		
		if ($keyword)
			redirect(site_url('reportstockposition/search_result/'.$type.$keyword));
		else
			redirect(site_url('reportstockposition'));
	}
	
	function search_result($type, $keyword) {
		$this -> load -> model('books/books_model');
		$rw = $this -> books_model -> __get_books_search_inventory(base64_decode(urldecode($keyword)));
		$bid = '';
		foreach($rw as $k => $v) $bid .= $v -> bid.',';
		$bid = rtrim($bid,',');
		
		if (!$rw) {
			__set_error_msg(array('info' => 'Data tidak ditemukan.'));
			redirect(site_url('inventory'));
		}
		
		$view['branch'] = $this -> memcachedlib -> sesresult['ubranchid'];
		$pager = $this -> pagination_lib -> pagination($this -> reportstockposition_model -> __get_stockposition_search($bid, $this -> memcachedlib -> sesresult['ubranchid'], $type),3,150,site_url('reportstockposition/search_result/'.$type.'/'.$keyword));
		$view['reportstockposition'] = $this -> pagination_lib -> paginate();
		$view['pages'] = $this -> pagination_lib -> pages();
		
		if ($type == 'branch')
			$this->load->view('reportstockposition', $view);
		else if ($type == 'area')
			$this->load->view('reportstockposition_area', $view);
		else if ($type == 'customer')
			$this->load->view('reportstockposition_customer', $view);
		else
			$this->load->view('reportstockposition_book', $view);
	}
	
	function export($type) {
		ini_set('memory_limit', '-1');
			redirect(site_url('reportstockposition'));
		if (!$type) redirect(site_url('reportstockposition'));
		
		$this -> load -> library('excel');
		$branch = $this -> memcachedlib -> sesresult['ubranchid'];
		$data = $this -> reportstockposition_model -> __get_stockposition_export($this -> memcachedlib -> sesresult['ubranchid'], $type);
		$arr = array();
		foreach($data as $K => $v) {
			if ($type == 'branch')
				$arr[] = array($v -> bcode, $v -> btitle, $v -> bprice, $v -> istockbegining, $v -> istockin, $v -> istockout, __get_stock_process($branch, $v -> ibid, 1), $v -> istock);
			elseif ($type == 'area')
				$arr[] = array($v -> aname, $v -> bcode, $v -> btitle, $v -> bprice, __get_stock_position_area_detail($v -> bid, $branch, $v -> aid, 1), __get_stock_position_area_detail($v -> bid, $branch, $v -> aid, 2), __get_stock_position_area_detail($v -> bid, $branch, $v -> aid, 3), 10, __get_stock_position_area_detail($v -> bid, $branch, $v -> aid, 4));
			elseif ($type == 'customer')
				$arr[] = array($v -> bcode, $v -> btitle, $v -> bprice, $v -> istockbegining, $v -> istockin, $v -> istockout, __get_stock_process($v -> cid, $v -> ibid, 2), $v -> istock);
			else
				$arr[] = array($v -> bcode, $v -> btitle, $v -> bprice, __get_stock_position_book_detail($v -> bid, $branch, 1), __get_stock_position_book_detail($v -> bid, $branch, 2), __get_stock_position_book_process($v -> bid, $branch), __get_stock_position_book_detail($v -> bid, $branch, 3));
		}

		if ($type == 'branch')
			$data = array('header' => array('Code', 'Title', 'Price','Stock Begining','Stock In','Stock Out', 'Stock Process','Stock Final'), 'data' => $arr);
		elseif ($type == 'area')
			$data = array('header' => array('Area', 'Code', 'Title', 'Price','Stock Begining','Stock In','Stock Out', 'Stock Process','Stock Final'), 'data' => $arr);
		elseif ($type == 'customer')
			$data = array('header' => array('Customer', 'Code', 'Title', 'Price','Stock Begining','Stock In','Stock Out', 'Stock Process','Stock Final'), 'data' => $arr);
		else
			$data = array('header' => array('Code', 'Title', 'Price','Stock In','Stock Out', 'Stock Process','Stock Final'), 'data' => $arr);

		$this -> excel -> sEncoding = 'UTF-8';
		$this -> excel -> bConvertTypes = false;
		$this -> excel -> sWorksheetTitle = 'Report Stock Position '.ucfirst($type).'- PT. Niaga Swadaya';
		
		$this -> excel -> addArray($data);
		$this -> excel -> generateXML('reportstockposition_' . $type);
	}
}
