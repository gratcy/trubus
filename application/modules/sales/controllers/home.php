<?php
/* -*- tab-width: 2; indent-tabs-mode: nil; c-basic-offset: 2 -*- */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {
	function __construct() {
		parent::__construct();
		$this -> load -> library('pagination_lib');
		$this -> load -> library('branch/branch_lib');
		$this -> load -> model('sales_model');
	}

	function index() {
		$pager = $this -> pagination_lib -> pagination($this -> sales_model -> __get_sales(),3,10,site_url('sales'));
		$view['sales'] = $this -> pagination_lib -> paginate();
		$view['pages'] = $this -> pagination_lib -> pages();
		$this->load->view('sales', $view);
	}
	
	function sales_add() {
		if ($_POST) {
			$branch = (int) $this -> input -> post('branch');
			$code = $this -> input -> post('code', TRUE);
			$name = $this -> input -> post('name', TRUE);
			$phone1 = $this -> input -> post('phone1', TRUE);
			$phone2 = $this -> input -> post('phone2', TRUE);
			$email = $this -> input -> post('email', TRUE);
			$status = (int) $this -> input -> post('status');
			
			if (!$name || !$branch || !$phone1 || !$phone2 || !$email || !$code) {
				__set_error_msg(array('error' => 'Data yang anda masukkan tidak lengkap !!!'));
				redirect(site_url('sales' . '/' . __FUNCTION__));
			}
			else {
				$arr = array('sbid' => $branch, 'scode' => $code, 'sname' => $name, 'sphone' => $phone1 . '*' . $phone2, 'semail' => $email, 'sstatus' => $status);
				if ($this -> sales_model -> __insert_sales($arr)) {
					__set_error_msg(array('info' => 'Data berhasil ditambahkan.'));
					redirect(site_url('sales'));
				}
				else {
					__set_error_msg(array('error' => 'Gagal menambahkan data !!!'));
					redirect(site_url('sales'));
				}
			}
		}
		else {
			$view['branch'] = $this -> branch_lib -> __get_branch();
			$this->load->view(__FUNCTION__, $view);
		}
	}
	
	function sales_update($id) {
		if ($_POST) {
			$branch = (int) $this -> input -> post('branch');
			$code = $this -> input -> post('code', TRUE);
			$name = $this -> input -> post('name', TRUE);
			$phone1 = $this -> input -> post('phone1', TRUE);
			$phone2 = $this -> input -> post('phone2', TRUE);
			$email = $this -> input -> post('email', TRUE);
			$status = (int) $this -> input -> post('status');
			$id = (int) $this -> input -> post('id');
			
			if ($id) {
				if (!$name || !$branch || !$phone1 || !$phone2 || !$email || !$code) {
					__set_error_msg(array('error' => 'Data yang anda masukkan tidak lengkap !!!'));
					redirect(site_url('sales' . '/' . __FUNCTION__ . '/' . $id));
				}
				else {
					$arr = array('sbid' => $branch, 'scode' => $code, 'sname' => $name, 'sphone' => $phone1 . '*' . $phone2, 'semail' => $email, 'sstatus' => $status);
					if ($this -> sales_model -> __update_sales($id, $arr)) {	
						__set_error_msg(array('info' => 'Data berhasil diubah.'));
						redirect(site_url('sales'));
					}
					else {
						__set_error_msg(array('error' => 'Gagal mengubah data !!!'));
						redirect(site_url('sales'));
					}
				}
			}
			else {
				__set_error_msg(array('error' => 'Kesalahan input data !!!'));
				redirect(site_url('sales'));
			}
		}
		else {
			$view['id'] = $id;
			$view['detail'] = $this -> sales_model -> __get_sales_detail($id);
			$view['branch'] = $this -> branch_lib -> __get_branch($view['detail'][0] -> sbid);
			$this->load->view(__FUNCTION__, $view);
		}
	}
	
	function sales_delete($id) {
		if ($this -> sales_model -> __delete_sales($id)) {
			__set_error_msg(array('info' => 'Data berhasil dihapus.'));
			redirect(site_url('sales'));
		}
		else {
			__set_error_msg(array('error' => 'Gagal hapus data !!!'));
			redirect(site_url('sales'));
		}
	}
}
