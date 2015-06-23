<?php
/* -*- tab-width: 2; indent-tabs-mode: nil; c-basic-offset: 2 -*- */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {
	function __construct() {
		parent::__construct();
		$this -> load -> library('pagination_lib');
		$this -> load -> library('branch/branch_lib');
		$this -> load -> library('books/books_lib');
		$this -> load -> model('inventory_shadow_model');
		$this -> load -> model('books/books_model');
	}

	function index() {
		$pager = $this -> pagination_lib -> pagination($this -> inventory_shadow_model -> __get_inventory_shadow($this -> memcachedlib -> sesresult['ubranchid']),3,10,site_url('inventory_shadow'));
		$view['inventory_shadow'] = $this -> pagination_lib -> paginate();
		$view['pages'] = $this -> pagination_lib -> pages();
		$this->load->view('inventory_shadow', $view);
	}
	
	function inventory_shadow_add() {
		if ($_POST) {
			$book = (int) $this -> input -> post('book');
			$branch = (int) $this -> input -> post('branch');
			$sbegin = (int) $this -> input -> post('sbegin');
			$sin = (int) $this -> input -> post('sin');
			$sout = (int) $this -> input -> post('sout');
			$sfinal = (int) $this -> input -> post('sfinal');
			$sreject = (int) $this -> input -> post('sreject');
			$sretur = (int) $this -> input -> post('sretur');
			$status = (int) $this -> input -> post('status');
			
			if (!$book || !$branch) {
				__set_error_msg(array('error' => 'Buku dan Cabang harus di isi !!!'));
				redirect(site_url('inventory_shadow' . '/' . __FUNCTION__));
			}
			else {
				$arr = array('ibid' => $book, 'ibcid' => $branch, 'istockbegining' => $sbegin, 'istockin' => $sin, 'istockout' => $sout, 'istockreject' => $sreject, 'istockretur' => $sretur, 'istock' => $sfinal, 'istatus' => $status);
				if ($this -> inventory_shadow_model -> __insert_inventory_shadow($arr)) {
					__set_error_msg(array('info' => 'Data berhasil ditambahkan.'));
					redirect(site_url('inventory_shadow'));
				}
				else {
					__set_error_msg(array('error' => 'Gagal menambahkan data !!!'));
					redirect(site_url('inventory_shadow'));
				}
			}
		}
		else {
			$view['branch'] = $this -> branch_lib -> __get_branch();
			$view['books'] = $this -> books_lib -> __get_books();
			$this->load->view(__FUNCTION__, $view);
		}
	}
	
	function inventory_shadow_update($id) {
		if ($_POST) {
			$id = (int) $this -> input -> post('id');
			$book = (int) $this -> input -> post('book');
			$branch = (int) $this -> input -> post('branch');
			$sbegin = (int) $this -> input -> post('sbegin');
			$sin = (int) $this -> input -> post('sin');
			$sout = (int) $this -> input -> post('sout');
			$sfinal = (int) $this -> input -> post('sfinal');
			$sreject = (int) $this -> input -> post('sreject');
			$sretur = (int) $this -> input -> post('sretur');
			$status = (int) $this -> input -> post('status');
			
			if ($id) {
				if (!$book || !$branch) {
					__set_error_msg(array('error' => 'Buku dan Cabang harus di isi !!!'));
					redirect(site_url('inventory_shadow' . '/' . __FUNCTION__ . '/' . $id));
				}
				else {
					$arr = array('ibcid' => $branch, 'istockbegining' => $sbegin, 'istockin' => $sin, 'istockout' => $sout, 'istockreject' => $sreject, 'istockretur' => $sretur, 'istock' => $sfinal, 'istatus' => $status);
					if ($this -> inventory_shadow_model -> __update_inventory_shadow($id, $arr)) {	
						__set_error_msg(array('info' => 'Data berhasil diubah.'));
						redirect(site_url('inventory_shadow'));
					}
					else {
						__set_error_msg(array('error' => 'Gagal mengubah data !!!'));
						redirect(site_url('inventory_shadow'));
					}
				}
			}
			else {
				__set_error_msg(array('error' => 'Kesalahan input data !!!'));
				redirect(site_url('inventory_shadow'));
			}
		}
		else {
			$view['id'] = $id;
			$view['detail'] = $this -> inventory_shadow_model -> __get_inventory_shadow_detail($id);
			$view['books'] = $this -> books_lib -> __get_books($view['detail'][0] -> ibid);
			$view['branch'] = $this -> branch_lib -> __get_branch($view['detail'][0] -> ibcid);
			$this->load->view(__FUNCTION__, $view);
		}
	}
	
	function card_stock($id,$cid) {
		$view['id'] = $id;
		$view['detail'] = $this -> inventory_shadow_model -> __get_inventory_shadow_detailx($id,$cid);
		$view['book'] = $this -> inventory_shadow_model -> __get_book($id);
		$this->load->view('card_stock', $view, false);
	}
	
	function inventory_shadow_search_result($keyword) {
		$rw = $this -> books_model -> __get_books_search_inventory(base64_decode(urldecode($keyword)));
		$bid = 0;
		foreach($rw as $k => $v) $bid .= $v -> bid.',';
		$bid = rtrim($bid,',');
		
		if (!$rw) {
			__set_error_msg(array('error' => 'Data tidak ditemukan.'));
			redirect(site_url('inventory_shadow'));
		}
		$pger = $this -> pagination_lib -> pagination($this -> inventory_shadow_model -> __get_search($bid, $this -> memcachedlib -> sesresult['ubranchid']),3,10,site_url('inventory_shadow/inventory_shadow_search_result/'.$keyword));
		$view['inventory_shadow'] = $this -> pagination_lib -> paginate();
		$view['pages'] = $this -> pagination_lib -> pages();
		$this->load->view('inventory_shadow', $view);
	}
	
	function inventory_shadow_search() {
		$bname = urlencode(base64_encode($this -> input -> post('bname', true)));
		
		if ($bname)
			redirect(site_url('inventory_shadow/inventory_shadow_search_result/'.$bname));
		else
			redirect(site_url('inventory_shadow'));
	}
	
	function inventory_shadow_delete($id) {
		if ($this -> inventory_shadow_model -> __delete_inventory_shadow($id)) {
			__set_error_msg(array('info' => 'Data berhasil dihapus.'));
			redirect(site_url('inventory_shadow'));
		}
		else {
			__set_error_msg(array('error' => 'Gagal hapus data !!!'));
			redirect(site_url('inventory_shadow'));
		}
	}
}
