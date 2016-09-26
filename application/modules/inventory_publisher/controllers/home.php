<?php
/* -*- tab-width: 2; indent-tabs-mode: nil; c-basic-offset: 2 -*- */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {
	function __construct() {
		parent::__construct();
		$this -> load -> library('pagination_lib');
		$this -> load -> library('publisher/publisher_lib');
		$this -> load -> model('books/books_model');
		$this -> load -> model('inventory_publisher_model');
	}

	function index() {
		$pager = $this -> pagination_lib -> pagination($this -> inventory_publisher_model -> __get_publisher(0,1),3,10,site_url('inventory_publisher'));
		$view['publisher'] = $this -> pagination_lib -> paginate();
		$view['pages'] = $this -> pagination_lib -> pages();
		$this->load->view('inventory_publisher', $view);
	}

	function inventory_publisher_detail($pid) {
		$pager = $this -> pagination_lib -> pagination($this -> inventory_publisher_model -> __get_inventory($this -> memcachedlib -> sesresult['ubranchid'],$pid),3,10,site_url('inventory_publisher/inventory_publisher_detail/' . $pid));
		$view['pid'] = $pid;
		$view['publisher'] = $this -> publisher_model -> __get_publisher_detail($pid);
		$view['inventory_publisher'] = $this -> pagination_lib -> paginate();
		$view['pages'] = $this -> pagination_lib -> pages();
		$this->load->view('inventory_publisher_detail', $view);
	}
	
	function inventory_publisher_search_result($keyword) {
		$rkeyword = $keyword;
		$keyword = strtolower(trim(base64_decode(urldecode($keyword))));
		$pger = $this -> pagination_lib -> pagination($this -> publisher_model -> __get_publisher_search($keyword,2),3,10,site_url('inventory_publisher/inventory_publisher_search_result/' . $rkeyword));
		$view['publisher'] = $this -> pagination_lib -> paginate();
		$view['pages'] = $this -> pagination_lib -> pages();
		$this->load->view('inventory_publisher', $view);
	}
	
	function inventory_publisher_search() {
		$keyword = urlencode(base64_encode($this -> input -> post('keyword', true)));
		
		if ($keyword)
			redirect(site_url('inventory_publisher/inventory_publisher_search_result/'.$keyword));
		else
			redirect(site_url('inventory_publisher'));
	}
	
	function inventory_publisher_search_detail_result($pid, $keyword) {
		$dkeyword = strtolower(trim(base64_decode(urldecode($keyword))));
		$rw = $this -> books_model -> __get_books_search_inventory($dkeyword);

		$bid = '';
		foreach($rw as $k => $v) $bid .= $v -> bid.',';
		$bid = rtrim($bid,',');
		
		$pger = $this -> pagination_lib -> pagination($this -> inventory_publisher_model -> __get_inventory_search_detail($this -> memcachedlib -> sesresult['ubranchid'],$bid),3,10,site_url('inventory_publisher/inventory_publisher_search_detail_result/' . $pid . '/'.$keyword));
		$view['inventory_publisher'] = $this -> pagination_lib -> paginate();
		$view['pages'] = $this -> pagination_lib -> pages();
		$view['bid'] = $bid;
		$view['publisher'] = $this -> inventory_publisher_model -> __get_publisher_detail($pid);
		$this->load->view('inventory_publisher_detail', $view);
	}

	function inventory_publisher_search_detail() {
		$keyword = urlencode(base64_encode($this -> input -> post('keyword', true)));
		$pid = (int) $this -> input -> post('pid');
		if ($keyword)
			redirect(site_url('inventory_publisher/inventory_publisher_search_detail_result/'.$pid.'/'.$keyword));
		else
			redirect(site_url('inventory_publisher'));
	}
	
	function export($id, $type) {
		if ($type == 'excel') {
			ini_set('memory_limit', '-1');
			$this -> load -> library('excel');
			$data = $this -> inventory_publisher_model -> __export($this -> memcachedlib -> sesresult['ubranchid'],$id);
			$r = $this -> inventory_publisher_model -> __get_publisher_detail($id);
			
			$total = 0;
			$arr = array();
			$arr2 = array();
			$arr2[] = array('Stock publisher', '', '', '', '', '', '');
			$arr2[] = array('Name', ': ' . $r[0] -> pname, '', '', '', '', '');
			$arr2[] = array('Code', ': ' . $r[0] -> pcode, '', '', '', '', '');
			$arr2[] = array('', '', '', '', '', '', '');
			
			foreach($data as $K => $v) {
				$in = __get_stockin_publisher($this -> memcachedlib -> sesresult['ubranchid'], $v -> bid);
				$out = __get_stockselling_publisher($this -> memcachedlib -> sesresult['ubranchid'], $v -> bid);
				$return = __get_stockreturn_publisher($this -> memcachedlib -> sesresult['ubranchid'], $v -> bid);
				$begin = __get_total_stockbegining_customer($this -> memcachedlib -> sesresult['ubranchid'], $v -> bid) + $v -> istockbegining;
				$sleft = ($begin + $in) - ($out + $return);
				
				$arr[] = array($v -> bcode, $v -> btitle, $v -> bprice, $begin, $in, $out, $return, $sleft);
			}
			
			$data = array('desc' => $arr2, 'header' => array('Code', 'Title', 'Price', 'Stock Begining','Stock In','Selling','Stock Return','Stock Left'), 'data' => $arr);

			$this -> excel -> sEncoding = 'UTF-8';
			$this -> excel -> bConvertTypes = false;
			$this -> excel -> sWorksheetTitle = 'Stock publisher '.$r[0] -> pname.' ('.$r[0] -> pcode.')- PT. Niaga Swadaya';

			$this -> excel -> addArray($data);
			$this -> excel -> generateXML('publisher_stock_' . $id);
		}
	}
}
