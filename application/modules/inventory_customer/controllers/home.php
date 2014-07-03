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
		$pager = $this -> pagination_lib -> pagination($this -> customer_model -> __get_customerx(),3,10,site_url('inventory_customer'));
		$view['customer'] = $this -> pagination_lib -> paginate();
		$view['pages'] = $this -> pagination_lib -> pages();
		$this->load->view('inventory_customer', $view);
	}

	function inventory_customer_detail($cid) {
		$pager = $this -> pagination_lib -> pagination($this -> inventory_customer_model -> __get_inventory($cid),3,10,site_url('inventory_customer/' . $cid));
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
			$status = (int) $this -> input -> post('status');
			
			if (!$book || !$cid) {
				__set_error_msg(array('error' => 'Buku dan Pelanggan harus di isi !!!'));
				redirect(site_url('inventory_customer' . '/' . __FUNCTION__ . '/' . $cid));
			}
			else {
				$arr = array('itype' => 2, 'ibid' => $book, 'ibcid' => $cid, 'istockbegining' => $sbegin, 'istockin' => $sin, 'istockout' => $sout, 'istockreject' => $sreject, 'istock' => $sfinal, 'istatus' => $status);
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
			$status = (int) $this -> input -> post('status');
			
			if ($id) {
				if (!$book || !$cid) {
					__set_error_msg(array('error' => 'Buku dan Pelanggan harus di isi !!!'));
					redirect(site_url('inventory_customer' . '/' . __FUNCTION__ . '/' . $id));
				}
				else {
					$arr = array('itype' => 2, 'ibid' => $book, 'ibcid' => $cid, 'istockbegining' => $sbegin, 'istockin' => $sin, 'istockout' => $sout, 'istockreject' => $sreject, 'istock' => $sfinal, 'istatus' => $status);
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
}
