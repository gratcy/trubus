<?php
/* -*- tab-width: 2; indent-tabs-mode: nil; c-basic-offset: 2 -*- */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {
	function __construct() {
		parent::__construct();
		$this -> load -> library('pagination_lib');
		$this -> load -> library('books/books_lib');
		$this -> load -> model('promo_model');
	}

	function index() {
		$pager = $this -> pagination_lib -> pagination($this -> promo_model -> __get_promo(),3,10,site_url('promo'));
		$view['promo'] = $this -> pagination_lib -> paginate();
		$view['pages'] = $this -> pagination_lib -> pages();
		$this->load->view('promo', $view);
	}
	
	function promo_add() {
		if ($_POST) {
			$title = $this -> input -> post('title', TRUE);
			$discp = $this -> input -> post('discp', TRUE);
			$discc = $this -> input -> post('discc', TRUE);
			$desc = $this -> input -> post('desc', TRUE);
			$period = $this -> input -> post('period', TRUE);
			$books = (int) $this -> input -> post('books');
			$type = (int) $this -> input -> post('type');
			$status = (int) $this -> input -> post('status');
			$caid = (int) $this -> input -> post('caid');
			$period = explode(' - ', $period);
			$from = strtotime($period[0]);
			$to = strtotime($period[1]);
			
			if (!$title || !$caid || !$books || !$from || !$to) {
				__set_error_msg(array('error' => 'Data yang anda masukkan tidak lengkap !!!'));
				redirect(site_url('promo' . '/' . __FUNCTION__));
			}
			else {
				$arr = array('pname' => $title, 'ptype' => $type, 'ppca' => $caid, 'pbid' => $books, 'pdiscp' => $discp, 'pdiscc' => $discc, 'pfrom' => $from, 'pto' => $to, 'pdesc' => $desc, 'pstatus' => $status);
				if ($this -> promo_model -> __insert_promo($arr)) {
					__set_error_msg(array('info' => 'Data berhasil ditambahkan.'));
					redirect(site_url('promo'));
				}
				else {
					__set_error_msg(array('error' => 'Gagal menambahkan data !!!'));
					redirect(site_url('promo'));
				}
			}
		}
		else {
			$view['books'] = $this -> books_lib -> __get_books('');
			$this->load->view(__FUNCTION__, $view);
		}
	}
	
	function promo_update($id) {
		if ($_POST) {
			$id = (int) $this -> input -> post('id');
			$title = $this -> input -> post('title', TRUE);
			$discp = $this -> input -> post('discp', TRUE);
			$discc = $this -> input -> post('discc', TRUE);
			$desc = $this -> input -> post('desc', TRUE);
			$period = $this -> input -> post('period', TRUE);
			$books = (int) $this -> input -> post('books');
			$caid = (int) $this -> input -> post('caid');
			$type = (int) $this -> input -> post('type');
			$status = (int) $this -> input -> post('status');
			$period = explode(' - ', $period);
			$from = strtotime($period[0]);
			$to = strtotime($period[1]);
			
			if ($id) {
				if (!$title || !$caid || !$books || !$from || !$to) {
					__set_error_msg(array('error' => 'Data yang anda masukkan tidak lengkap !!!'));
					redirect(site_url('promo' . '/' . __FUNCTION__ . '/' . $id));
				}
				else {
					$arr = array('pname' => $title, 'ptype' => $type, 'ppca' => $caid, 'pbid' => $books, 'pdiscp' => $discp, 'pdiscc' => $discc, 'pfrom' => $from, 'pto' => $to, 'pdesc' => $desc, 'pstatus' => $status);
					if ($this -> promo_model -> __update_promo($id, $arr)) {	
						__set_error_msg(array('info' => 'Data berhasil diubah.'));
						redirect(site_url('promo'));
					}
					else {
						__set_error_msg(array('error' => 'Gagal mengubah data !!!'));
						redirect(site_url('promo'));
					}
				}
			}
			else {
				__set_error_msg(array('error' => 'Kesalahan input data !!!'));
				redirect(site_url('promo'));
			}
		}
		else {
			$view['id'] = $id;
			$view['detail'] = $this -> promo_model -> __get_promo_detail($id);
			$view['books'] = $this -> books_lib -> __get_books($view['detail'][0] -> pbid);
			$this->load->view(__FUNCTION__, $view);
		}
	}
	
	function promo_delete($id) {
		if ($this -> promo_model -> __delete_promo($id)) {
			__set_error_msg(array('info' => 'Data berhasil dihapus.'));
			redirect(site_url('promo'));
		}
		else {
			__set_error_msg(array('error' => 'Gagal hapus data !!!'));
			redirect(site_url('promo'));
		}
	}
}
