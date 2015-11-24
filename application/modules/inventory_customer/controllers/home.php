<?php
/* -*- tab-width: 2; indent-tabs-mode: nil; c-basic-offset: 2 -*- */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {
	function __construct() {
		parent::__construct();
		$this -> load -> library('pagination_lib');
		$this -> load -> library('customer/customer_lib');
		$this -> load -> library('books/books_lib');
		$this -> load -> model('customer/customer_model');
		$this -> load -> model('inventory_customer_model');
	}

	function index() {
		$pager = $this -> pagination_lib -> pagination($this -> customer_model -> __get_customer($this -> memcachedlib -> sesresult['ubranchid']),3,10,site_url('inventory_customer'));
		$view['customer'] = $this -> pagination_lib -> paginate();
		$view['pages'] = $this -> pagination_lib -> pages();
		$this->load->view('inventory_customer', $view);
	}

	function inventory_customer_detail($cid) {
		$pager = $this -> pagination_lib -> pagination($this -> inventory_customer_model -> __get_inventory($cid),3,10,site_url('inventory_customer/inventory_customer_detail/' . $cid));
		$view['cid'] = $cid;
		$view['customer'] = $this -> customer_model -> __get_customer_detail($cid);
		$view['inventory_customer'] = $this -> pagination_lib -> paginate();
		$view['pages'] = $this -> pagination_lib -> pages();
		$this->load->view('inventory_customer_detail', $view);
	}
	
	function inventory_customer_add($cid) {
		if ($_POST) {
			$book = (int) $this -> input -> post('book');
			$cid = (int) $this -> input -> post('cid');
			$sbegin = (int) $this -> input -> post('sbegin');
			$sin = (int) $this -> input -> post('sin');
			$sout = (int) $this -> input -> post('sout');
			$sfinal = (int) $this -> input -> post('sfinal');
			$sreject = (int) $this -> input -> post('sreject');
			$sretur = (int) $this -> input -> post('sretur');
			$status = (int) $this -> input -> post('status');
			
			if (!$book || !$cid) {
				__set_error_msg(array('error' => 'Buku dan Pelanggan harus di isi !!!'));
				redirect(site_url('inventory_customer' . '/' . __FUNCTION__ . '/' . $cid));
			}
			else {
				$arr = array('itype' => 2, 'ibid' => $book, 'ibcid' => $cid, 'istockbegining' => $sbegin, 'istockin' => $sin, 'istockout' => $sout, 'istockreject' => $sreject, 'istockretur' => $sretur, 'istock' => $sfinal, 'istatus' => $status);
				if ($this -> inventory_customer_model -> __insert_inventory_customer($arr)) {
					__set_error_msg(array('info' => 'Data berhasil ditambahkan.'));
					redirect(site_url('inventory_customer/inventory_customer_detail/' . $cid));
				}
				else {
					__set_error_msg(array('error' => 'Gagal menambahkan data !!!'));
					redirect(site_url('inventory_customer/inventory_customer_detail/' . $cid));
				}
			}
		}
		else {
			$view['customer'] = $this -> customer_lib -> __get_customer($cid);
			$view['books'] = $this -> books_lib -> __get_books();
			$this->load->view(__FUNCTION__, $view);
		}
	}
	
	function inventory_customer_update($id) {
		if ($_POST) {
			$id = (int) $this -> input -> post('id');
			$book = (int) $this -> input -> post('book');
			$cid = (int) $this -> input -> post('cid');
			$sbegin = (int) $this -> input -> post('sbegin');
			$sin = (int) $this -> input -> post('sin');
			$sout = (int) $this -> input -> post('sout');
			$sfinal = (int) $this -> input -> post('sfinal');
			$sreject = (int) $this -> input -> post('sreject');
			$sretur = (int) $this -> input -> post('sretur');
			$status = (int) $this -> input -> post('status');
			
			if ($id) {
				if (!$book || !$cid) {
					__set_error_msg(array('error' => 'Buku dan Pelanggan harus di isi !!!'));
					redirect(site_url('inventory_customer' . '/' . __FUNCTION__ . '/' . $id));
				}
				else {
					$arr = array('itype' => 2, 'ibid' => $book, 'ibcid' => $cid, 'istockbegining' => $sbegin, 'istockin' => $sin, 'istockout' => $sout, 'istockreject' => $sreject, 'istockretur' => $sretur, 'istock' => $sfinal, 'istatus' => $status);
					if ($this -> inventory_customer_model -> __update_inventory_customer($id, $arr)) {	
						__set_error_msg(array('info' => 'Data berhasil diubah.'));
						redirect(site_url('inventory_customer/inventory_customer_detail/' . $cid));
					}
					else {
						__set_error_msg(array('error' => 'Gagal mengubah data !!!'));
						redirect(site_url('inventory_customer/inventory_customer_detail/' . $cid));
					}
				}
			}
			else {
				__set_error_msg(array('error' => 'Kesalahan input data !!!'));
				redirect(site_url('inventory_customer'));
			}
		}
		else {
			$view['id'] = $id;
			$view['detail'] = $this -> inventory_customer_model -> __get_inventory_customer_detail($id);
			$view['books'] = $this -> books_lib -> __get_books($view['detail'][0] -> ibid);
			$view['customer'] = $this -> customer_lib -> __get_customer($view['detail'][0] -> ibcid);
			$this->load->view(__FUNCTION__, $view);
		}
	}
	
	function inventory_customer_search_result($keyword) {
		$keyword = strtolower(trim(base64_decode(urldecode($keyword))));
		$pger = $this -> pagination_lib -> pagination($this -> customer_model -> __get_customer_search($keyword,false,$this -> memcachedlib -> sesresult['ubranchid']),3,10,site_url('inventory_customer'));
		$view['customer'] = $this -> pagination_lib -> paginate();
		$view['pages'] = $this -> pagination_lib -> pages();
		$this->load->view('inventory_customer', $view);
	}
	
	function inventory_customer_search() {
		$keyword = urlencode(base64_encode($this -> input -> post('keyword', true)));
		
		if ($keyword)
			redirect(site_url('inventory_customer/inventory_customer_search_result/'.$keyword));
		else
			redirect(site_url('inventory_customer'));
	}
	
	function inventory_customer_search_detail_result($cid, $keyword) {
		$dkeyword = strtolower(trim(base64_decode(urldecode($keyword))));
		$rw = $this -> books_model -> __get_books_search_inventory($dkeyword);
		$bid = '';
		foreach($rw as $k => $v) $bid .= $v -> bid.',';
		$bid = rtrim($bid,',');
		$pger = $this -> pagination_lib -> pagination($this -> inventory_customer_model -> __get_inventory_search_detail($cid,$bid),3,10,site_url('inventory_customer/inventory_customer_search_detail_result/' . $cid . '/'.$keyword));
		$view['inventory_customer'] = $this -> pagination_lib -> paginate();
		$view['pages'] = $this -> pagination_lib -> pages();
		$view['cid'] = $cid;
		$view['customer'] = $this -> customer_model -> __get_customer_detail($cid);
		$this->load->view('inventory_customer_detail', $view);
	}
	
	function inventory_customer_search_detail() {
		$keyword = urlencode(base64_encode($this -> input -> post('keyword', true)));
		$cid = (int) $this -> input -> post('cid');
		if ($keyword)
			redirect(site_url('inventory_customer/inventory_customer_search_detail_result/'.$cid.'/'.$keyword));
		else
			redirect(site_url('inventory_customer'));
	}
	
	function inventory_customer_delete($id) {
		if ($this -> inventory_customer_model -> __delete_inventory_customer($id)) {
			__set_error_msg(array('info' => 'Data berhasil dihapus.'));
			redirect(site_url('inventory_customer'));
		}
		else {
			__set_error_msg(array('error' => 'Gagal hapus data !!!'));
			redirect(site_url('inventory_customer'));
		}
	}
	
	function export($id, $type) {
		if ($type == 'excel') {
			ini_set('memory_limit', '-1');
			$this -> load -> library('excel');
			$data = $this -> inventory_customer_model -> __export($id);
			$r = $this -> customer_model -> __get_customer_detail($id);
			
			$total = 0;
			$arr = array();
			$arr2 = array();
			$arr2[] = array('Stock Customer', '', '', '', '', '', '', '');
			$arr2[] = array('Name', ': ' . $r[0] -> cname, '', '', '', '', '', '');
			$arr2[] = array('Code', ': ' . $r[0] -> ccode, '', '', '', '', '', '');
			$arr2[] = array('', '', '', '', '', '', '', '');
			
			foreach($data as $K => $v) {
				$total += $v -> istock;
				$arr[] = array($v -> bcode, $v -> btitle, (int) $v -> istockbegining, (int) $v -> istockin, (int) $v -> istockout, (int) $v -> istockreject, (int) $v -> istockretur, (int) $v -> istock);
			}
			
			$arr[] = array('', '', '', '', '', '', 'Total', $total);
			$data = array('desc' => $arr2, 'header' => array('Code', 'Title', 'Stock Begining','Stock In','Stock Out','Stock Reject','Stock Retur','Stock Final'), 'data' => $arr);

			$this -> excel -> sEncoding = 'UTF-8';
			$this -> excel -> bConvertTypes = false;
			$this -> excel -> sWorksheetTitle = 'Daftar Stock Customer - PT. Niaga Swadaya';
			
			$this -> excel -> addArray($data);
			$this -> excel -> generateXML('customer_books_' . $id);
		}
	}
}
