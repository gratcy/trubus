<?php
/* -*- tab-width: 2; indent-tabs-mode: nil; c-basic-offset: 2 -*- */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {
	function __construct() {
		parent::__construct();
		$this -> load -> library('pagination_lib');
		$this -> load -> library('request/request_lib');
		$this -> load -> model('request/request_model');
		$this -> load -> model('transfer_model');
	}

	function index() {
		$pager = $this -> pagination_lib -> pagination($this -> transfer_model -> __get_transfer(),3,10,site_url('transfer'));
		$view['transfer'] = $this -> pagination_lib -> paginate();
		$view['pages'] = $this -> pagination_lib -> pages();
		$this->load->view('transfer', $view);
	}
	
	function transfer_add() {
		if ($_POST) {
			$title = $this -> input -> post('title', TRUE);
			$desc = $this -> input -> post('desc', TRUE);
			$docno = $this -> input -> post('docno', TRUE);
			$waktu = $this -> input -> post('waktu', TRUE);
			$rno = (int) $this -> input -> post('rno');
			$status = (int) $this -> input -> post('status');
			
			if (!$title || !$docno || !$rno) {
				__set_error_msg(array('error' => 'Judul, Dokument No dan Request No harus di isi !!!'));
				redirect(site_url('transfer' . '/' . __FUNCTION__));
			}
			else {
				$arr = array('ddrid' => $rno, 'ddocno' => $docno, 'ddate' => strtotime($waktu), 'dtitle' => $title, 'ddesc' => $desc, 'dstatus' => $status);
				if ($this -> transfer_model -> __insert_transfer($arr)) {
					__set_error_msg(array('info' => 'Data berhasil ditambahkan.'));
					redirect(site_url('transfer'));
				}
				else {
					__set_error_msg(array('error' => 'Gagal menambahkan data !!!'));
					redirect(site_url('transfer'));
				}
			}
		}
		else {
			$view['rno'] = $this -> request_lib -> __get_request();
			$this->load->view(__FUNCTION__, $view);
		}
	}
	
	function transfer_update($id) {
		if ($_POST) {
			$id = (int) $this -> input -> post('id');
			$title = $this -> input -> post('title', TRUE);
			$desc = $this -> input -> post('desc', TRUE);
			$docno = $this -> input -> post('docno', TRUE);
			$waktu = $this -> input -> post('waktu', TRUE);
			$rno = (int) $this -> input -> post('rno');
			$app = (int) $this -> input -> post('app');
			if ($app == 1) $status = 3;
			else $status = (int) $this -> input -> post('status');
			
			if ($id) {
				if (!$title || !$docno || !$rno) {
					__set_error_msg(array('error' => 'Judul, Dokument No dan Request No harus di isi !!!'));
					redirect(site_url('transfer' . '/' . __FUNCTION__ . '/' . $id));
				}
				else {
					$arr = array('ddrid' => $rno, 'ddocno' => $docno, 'ddate' => strtotime($waktu), 'dtitle' => $title, 'ddesc' => $desc, 'dstatus' => $status);
					if ($this -> transfer_model -> __update_transfer($id, $arr)) {
						__set_error_msg(array('info' => 'Data berhasil diubah.'));
						redirect(site_url('transfer'));
					}
					else {
						__set_error_msg(array('error' => 'Gagal mengubah data !!!'));
						redirect(site_url('transfer'));
					}
				}
			}
			else {
				__set_error_msg(array('error' => 'Kesalahan input data !!!'));
				redirect(site_url('transfer'));
			}
		}
		else {
			$view['id'] = $id;
			$view['detail'] = $this -> transfer_model -> __get_transfer_detail($id);
			$view['rno'] = $this -> request_lib -> __get_request($view['detail'][0] -> ddrid);
			$this->load->view(__FUNCTION__, $view);
		}
	}
	
	function transfer_request_books($did) {
		$view['books'] = $this -> request_model -> __get_books($did, 2);
		$this->load->view('tmp/' . __FUNCTION__, $view, FALSE);
	}
	
	function transfer_detail($id) {
		$view['detail'] = $this -> transfer_model -> __get_transfer_books_detail($id);
		$view['books'] = $this -> request_model -> __get_books($view['detail'][0] -> ddrid, 2);
		$view['id'] = $id;
		if ($view['detail'][0] -> dstatus != 3) redirect(site_url('request'));
		$this->load->view(__FUNCTION__, $view);
	}
	
	function transfer_delete($id) {
		if ($this -> transfer_model -> __delete_transfer($id)) {
			__set_error_msg(array('info' => 'Data berhasil dihapus.'));
			redirect(site_url('transfer'));
		}
		else {
			__set_error_msg(array('error' => 'Gagal hapus data !!!'));
			redirect(site_url('transfer'));
		}
	}
	
	function export($type) {
		if ($type == 'excel') {
			ini_set('memory_limit', '-1');
			$this -> load -> library('excel');
			$data = $this -> transfer_model -> __export();
			$arr = array();
			foreach($data as $K => $v)
				$arr[] = array($v -> ddocno,'R'.str_pad($v -> did, 4, "0", STR_PAD_LEFT),__get_date($v -> ddate), $v -> fbname, $v -> tbname, $v -> dtitle, $v -> ddesc, $v -> total_books, ($v -> dstatus == 3 ? 'Approved' : __get_status($v -> dstatus,1)));
			
			$data = array('header' => array('Doc No.', 'Request No.', 'Date', 'Branch From','Branch To','Title','Description','Total Books','Status'), 'data' => $arr);

			$this -> excel -> sEncoding = 'UTF-8';
			$this -> excel -> bConvertTypes = false;
			$this -> excel -> sWorksheetTitle = 'Distribution Transfer - PT. Niaga Swadaya';
			
			$this -> excel -> addArray($data);
			$this -> excel -> generateXML('dist-transfer-' . date('Ymd'));
		}
	}
}
