<?php
/* -*- tab-width: 2; indent-tabs-mode: nil; c-basic-offset: 2 -*- */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {
	function __construct() {
		parent::__construct();
		$this -> load -> library('pagination_lib');
		$this -> load -> library('branch/branch_lib');
		$this -> load -> library('books/books_lib');
		$this -> load -> model('inventory_model');
	}

	function index() {
		$pager = $this -> pagination_lib -> pagination($this -> inventory_model -> __get_inventory(),3,10,site_url('inventory'));
		$view['inventory'] = $this -> pagination_lib -> paginate();
		$view['pages'] = $this -> pagination_lib -> pages();
		$this->load->view('inventory', $view);
	}
	
	function inventory_add() {
		if ($_POST) {
			$book = (int) $this -> input -> post('book');
			$branch = (int) $this -> input -> post('branch');
			$sbegin = (int) $this -> input -> post('sbegin');
			$sin = (int) $this -> input -> post('sin');
			$sout = (int) $this -> input -> post('sout');
			$sfinal = (int) $this -> input -> post('sfinal');
			$sreject = (int) $this -> input -> post('sreject');
			$status = (int) $this -> input -> post('status');
			
			if (!$book || !$branch) {
				__set_error_msg(array('error' => 'Buku dan Cabang harus di isi !!!'));
				redirect(site_url('inventory' . '/' . __FUNCTION__));
			}
			else {
				$arr = array('itype' => 1, 'ibid' => $book, 'ibcid' => $branch, 'istockbegining' => $sbegin, 'istockin' => $sin, 'istockout' => $sout, 'istockreject' => $sreject, 'istock' => $sfinal, 'istatus' => $status);
				if ($this -> inventory_model -> __insert_inventory($arr)) {
					__set_error_msg(array('info' => 'Data berhasil ditambahkan.'));
					redirect(site_url('inventory'));
				}
				else {
					__set_error_msg(array('error' => 'Gagal menambahkan data !!!'));
					redirect(site_url('inventory'));
				}
			}
		}
		else {
			$view['branch'] = $this -> branch_lib -> __get_branch();
			$view['books'] = $this -> books_lib -> __get_books();
			$this->load->view(__FUNCTION__, $view);
		}
	}
	
	function inventory_update($id) {
		if ($_POST) {
			$id = (int) $this -> input -> post('id');
			$book = (int) $this -> input -> post('book');
			$branch = (int) $this -> input -> post('branch');
			$sbegin = (int) $this -> input -> post('sbegin');
			$sin = (int) $this -> input -> post('sin');
			$sout = (int) $this -> input -> post('sout');
			$sfinal = (int) $this -> input -> post('sfinal');
			$sreject = (int) $this -> input -> post('sreject');
			$status = (int) $this -> input -> post('status');
			
			if ($id) {
				if (!$book || !$branch) {
					__set_error_msg(array('error' => 'Buku dan Cabang harus di isi !!!'));
					redirect(site_url('inventory' . '/' . __FUNCTION__ . '/' . $id));
				}
				else {
					$arr = array('itype' => 1, 'ibid' => $book, 'ibcid' => $branch, 'istatus' => $status);
					if ($this -> inventory_model -> __update_inventory($id, $arr)) {	
						__set_error_msg(array('info' => 'Data berhasil diubah.'));
						redirect(site_url('inventory'));
					}
					else {
						__set_error_msg(array('error' => 'Gagal mengubah data !!!'));
						redirect(site_url('inventory'));
					}
				}
			}
			else {
				__set_error_msg(array('error' => 'Kesalahan input data !!!'));
				redirect(site_url('inventory'));
			}
		}
		else {
			$view['id'] = $id;
			$view['detail'] = $this -> inventory_model -> __get_inventory_detail($id);
			$view['books'] = $this -> books_lib -> __get_books($view['detail'][0] -> ibid);
			$view['branch'] = $this -> branch_lib -> __get_branch($view['detail'][0] -> ibcid);
			$this->load->view(__FUNCTION__, $view);
		}
	}
	
	function inventory_delete($id) {
		if ($this -> inventory_model -> __delete_inventory($id)) {
			__set_error_msg(array('info' => 'Data berhasil dihapus.'));
			redirect(site_url('inventory'));
		}
		else {
			__set_error_msg(array('error' => 'Gagal hapus data !!!'));
			redirect(site_url('inventory'));
		}
	}
}
