<?php
/* -*- tab-width: 2; indent-tabs-mode: nil; c-basic-offset: 2 -*- */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {
	function __construct() {
		parent::__construct();
		$this -> load -> library('pagination_lib');
		$this -> load -> library('request/request_lib');
		$this -> load -> library('penjualan_konsinyasi/penjualan_konsinyasi_lib');
		$this -> load -> model('receiving/receiving_model');
		$this -> load -> model('letter_model');
	}

	function index() {
		$pager = $this -> pagination_lib -> pagination($this -> letter_model -> __get_letter(),3,10,site_url('letter'));
		$view['letter'] = $this -> pagination_lib -> paginate();
		$view['pages'] = $this -> pagination_lib -> pages();
		$this->load->view('letter', $view);
	}
	
	function letter_add() {
		if ($_POST) {
			$desc = $this -> input -> post('desc', TRUE);
			$rid = (int) $this -> input -> post('rid');
			$ltype = (int) $this -> input -> post('ltype');
			$status = (int) $this -> input -> post('status');
			
			if (!$rid) {
				__set_error_msg(array('error' => 'Data yang anda masukkan tidak lengkap !!!'));
				redirect(site_url('letter' . '/' . __FUNCTION__));
			}
			else {
				$arr = array('ltype' => $ltype, 'liid' => $rid, 'ldate' => time(), 'ldesc' => $desc, 'lstatus' => $status);
				if ($this -> letter_model -> __insert_letter($arr)) {
					__set_error_msg(array('info' => 'Data berhasil ditambahkan.'));
					redirect(site_url('letter'));
				}
				else {
					__set_error_msg(array('error' => 'Gagal menambahkan data !!!'));
					redirect(site_url('letter'));
				}
			}
		}
		else {
			$this->load->view(__FUNCTION__, '');
		}
	}
	
	function letter_update($id) {
		if ($_POST) {
			$id = (int) $this -> input -> post('id');
			$desc = $this -> input -> post('desc', TRUE);
			$rid = (int) $this -> input -> post('rid');
			$ltype = (int) $this -> input -> post('ltype');
			$app = (int) $this -> input -> post('app');
			if ($app == 1) $status = 3;
			else $status = (int) $this -> input -> post('status');

			if ($id) {
				if (!$rid) {
					__set_error_msg(array('error' => 'Data yang anda masukkan tidak lengkap !!!'));
					redirect(site_url('letter' . '/' . __FUNCTION__ . '/' . $id));
				}
				else {
					$arr = array('ltype' => $ltype, 'liid' => $rid, 'ldate' => time(), 'ldesc' => $desc, 'lstatus' => $status);
					if ($this -> letter_model -> __update_letter($id, $arr)) {	
						__set_error_msg(array('info' => 'Data berhasil diubah.'));
						redirect(site_url('letter'));
					}
					else {
						__set_error_msg(array('error' => 'Gagal mengubah data !!!'));
						redirect(site_url('letter'));
					}
				}
			}
			else {
				__set_error_msg(array('error' => 'Kesalahan input data !!!'));
				redirect(site_url('letter'));
			}
		}
		else {
			$view['id'] = $id;
			$view['detail'] = $this -> letter_model -> __get_letter_detail($id);
			$this->load->view(__FUNCTION__, $view);
		}
	}
	
	function letter_books($type,$id) {
		if ($type == 1)
			$view['books'] = $this -> request_model -> __get_books($id, 2);
		else
			$view['books'] = $this -> letter_model -> __get_books($id, 2);
		$this->load->view('tmp/' . __FUNCTION__, $view, FALSE);
	}
	
	function letter_types($type) {
		$res = '<select name="rid" class="form-control" id="rid">';
		if ($type == 1)
			$res .= $this -> request_lib -> __get_request();
		else
			$res .= $this -> penjualan_konsinyasi_lib -> __get_penjualan_konsinyasi_no();
		$res .= '</select>';
		echo $res;
	}
	
	function letter_delete($id) {
		if ($this -> letter_model -> __delete_letter($id)) {
			__set_error_msg(array('info' => 'Data berhasil dihapus.'));
			redirect(site_url('letter'));
		}
		else {
			__set_error_msg(array('error' => 'Gagal hapus data !!!'));
			redirect(site_url('letter'));
		}
	}
}
