<?php
/* -*- tab-width: 2; indent-tabs-mode: nil; c-basic-offset: 2 -*- */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {
	function __construct() {
		parent::__construct();
		$this -> load -> library('pagination_lib');
		$this -> load -> model('books/books_model');
		$this -> load -> model('opname/opname_model');
		$this -> load -> model('adjustment_model');
	}

	function index() {
		$pager = $this -> pagination_lib -> pagination($this -> opname_model -> __get_opnameinventory($this -> memcachedlib -> sesresult['ubranchid']),3,10,site_url('adjustment'));
		$view['adjustment'] = $this -> pagination_lib -> paginate();
		$view['pages'] = $this -> pagination_lib -> pages();
		$this->load->view('adjustment', $view);
	}
	
	function adjustment_detail($id) {
		if ($_POST) {
			
		}
		else {
			$view['id'] = $id;
			$view['detail'] = $this -> opname_model -> __get_opnameinventory_detail($id);
			$view['books'] = $this -> books_model -> __get_books_detail($view['detail'][0] -> ibid);
			$this->load->view(__FUNCTION__, $view);
		}
		
	}
	
	function adjustment_search_result($keyword) {
		$rw = $this -> books_model -> __get_books_search_inventory(base64_decode(urldecode($keyword)));
		if (!$rw) {
			__set_error_msg(array('info' => 'Data tidak ditemukan.'));
			redirect(site_url('opname'));
		}
		$pger = $this -> pagination_lib -> pagination($this -> opname_model -> __get_search($rw[0] -> bid, $this -> memcachedlib -> sesresult['ubranchid']),3,10,site_url('opname'));
		$view['adjustment'] = $this -> pagination_lib -> paginate();
		$view['pages'] = $this -> pagination_lib -> pages();
		$this->load->view('adjustment', $view);
	}
	
	function adjustment_search() {
		$bname = urlencode(base64_encode($this -> input -> post('bname', true)));
		
		if ($bname)
			redirect(site_url('adjustment/adjustment_search_result/'.$bname));
		else
			redirect(site_url('adjustment'));
	}
}
