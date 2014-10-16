<?php
/* -*- tab-width: 2; indent-tabs-mode: nil; c-basic-offset: 2 -*- */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {
	function __construct() {
		parent::__construct();
		$this -> load -> library('pagination_lib');
		$this -> load -> library('branch/branch_lib');
		$this -> load -> model('tax_model');
	}

	function index() {
		$pager = $this -> pagination_lib -> pagination($this -> tax_model -> __get_tax(),3,10,site_url('tax'));
		$view['tax'] = $this -> pagination_lib -> paginate();
		$view['pages'] = $this -> pagination_lib -> pages();
		$this->load->view('tax', $view);
	}
	
	function tax_add() {
		if ($_POST) {
			$branch = (int) $this -> input -> post('branch', TRUE);
			$from = (int) $this -> input -> post('from', TRUE);
			$to = (int) $this -> input -> post('to', TRUE);
			$year = (int) $this -> input -> post('year', TRUE);
			$desc = $this -> input -> post('desc', TRUE);
			$status = (int) $this -> input -> post('status');
			
			if (!$branch || !$from || !$to || !$year) {
				__set_error_msg(array('error' => 'Data yang anda masukkan tidak lengkap !!!'));
				redirect(site_url('tax' . '/' . __FUNCTION__));
			}
			else {
				$arr = array();
				for($i=$from;$i<=$to;++$i) {
					$arr = array('tbid' => $branch, 'ttax' => 'xxx.'.str_pad($branch, 2, "0", STR_PAD_LEFT).'.'.str_pad($i, 8, "0", STR_PAD_LEFT), 'tdate' => time(), 'tdesc' => $desc, 'tstatus' => $status);
					if (!$this -> tax_model -> __insert_tax($arr)) {
						__set_error_msg(array('error' => 'Gagal menambahkan data !!!'));
						redirect(site_url('tax'));
					}
				}
				__set_error_msg(array('info' => 'Data berhasil ditambahkan.'));
				redirect(site_url('tax'));
			}
		}
		else {
			$data['branch'] = $this -> branch_lib -> __get_branch();
			$this->load->view(__FUNCTION__, $data);
		}
	}
	
	function tax_update($id) {
		if ($_POST) {
			$id = (int) $this -> input -> post('id');
			$branch = (int) $this -> input -> post('branch', TRUE);
			$from = (int) $this -> input -> post('from', TRUE);
			$to = (int) $this -> input -> post('to', TRUE);
			$year = (int) $this -> input -> post('year', TRUE);
			$desc = $this -> input -> post('desc', TRUE);
			$status = (int) $this -> input -> post('status');
			
			if ($id) {
				$arr = array('tbid' => $branch, 'tdesc' => $desc, 'tstatus' => $status);
				if ($this -> tax_model -> __update_tax($id, $arr)) {	
					__set_error_msg(array('info' => 'Data berhasil diubah.'));
					redirect(site_url('tax'));
				}
				else {
					__set_error_msg(array('error' => 'Gagal mengubah data !!!'));
					redirect(site_url('tax'));
				}
			}
			else {
				__set_error_msg(array('error' => 'Kesalahan input data !!!'));
				redirect(site_url('tax'));
			}
		}
		else {
			$view['id'] = $id;
			$view['detail'] = $this -> tax_model -> __get_tax_detail($id);
			$view['branch'] = $this -> branch_lib -> __get_branch($view['detail'][0] -> tbid);
			$this->load->view(__FUNCTION__, $view);
		}
	}
	
	function tax_delete($id) {
		if ($this -> tax_model -> __delete_tax($id)) {
			__set_error_msg(array('info' => 'Data berhasil dihapus.'));
			redirect(site_url('tax'));
		}
		else {
			__set_error_msg(array('error' => 'Gagal hapus data !!!'));
			redirect(site_url('tax'));
		}
	}
}
