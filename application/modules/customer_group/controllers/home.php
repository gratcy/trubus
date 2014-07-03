<?php
/* -*- tab-width: 2; indent-tabs-mode: nil; c-basic-offset: 2 -*- */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {
	function __construct() {
		parent::__construct();
		$this -> load -> library('pagination_lib');
		$this -> load -> model('customer_group_model');
	}

	function index() {
		$pager = $this -> pagination_lib -> pagination($this -> customer_group_model -> __get_customer_group(),3,10,site_url('customer_group'));
		$view['customer_group'] = $this -> pagination_lib -> paginate();
		$view['pages'] = $this -> pagination_lib -> pages();
		$this->load->view('customer_group', $view);
	}
	
	function customer_group_add() {
		if ($_POST) {
			$name = $this -> input -> post('name', TRUE);
			$code = $this -> input -> post('code', TRUE);
			$desc = $this -> input -> post('desc', TRUE);
			$status = (int) $this -> input -> post('status');
			
			if (!$name || !$code || !$desc) {
				__set_error_msg(array('error' => 'Data yang anda masukkan tidak lengkap !!!'));
				redirect(site_url('customer_group' . '/' . __FUNCTION__));
			}
			else {
				$arr = array('cgname' => $name, 'cgcode' => $code, 'cgdesc' => $desc, 'cgstatus' => $status);
				if ($this -> customer_group_model -> __insert_customer_group($arr)) {
					__set_error_msg(array('info' => 'Data berhasil ditambahkan.'));
					redirect(site_url('customer_group'));
				}
				else {
					__set_error_msg(array('error' => 'Gagal menambahkan data !!!'));
					redirect(site_url('customer_group'));
				}
			}
		}
		else {
			$this->load->view(__FUNCTION__, '');
		}
	}
	
	function customer_group_update($id) {
		if ($_POST) {
			$id = (int) $this -> input -> post('id');
			$name = $this -> input -> post('name', TRUE);
			$code = $this -> input -> post('code', TRUE);
			$desc = $this -> input -> post('desc', TRUE);
			$status = (int) $this -> input -> post('status');
			
			if ($id) {
				if (!$name || !$code || !$desc) {
					__set_error_msg(array('error' => 'Data yang anda masukkan tidak lengkap !!!'));
					redirect(site_url('customer_group' . '/' . __FUNCTION__ . '/' . $id));
				}
				else {
					$arr = array('cgname' => $name, 'cgcode' => $code, 'cgdesc' => $desc, 'cgstatus' => $status);
					if ($this -> customer_group_model -> __update_customer_group($id, $arr)) {	
						__set_error_msg(array('info' => 'Data berhasil diubah.'));
						redirect(site_url('customer_group'));
					}
					else {
						__set_error_msg(array('error' => 'Gagal mengubah data !!!'));
						redirect(site_url('customer_group'));
					}
				}
			}
			else {
				__set_error_msg(array('error' => 'Kesalahan input data !!!'));
				redirect(site_url('customer_group'));
			}
		}
		else {
			$view['id'] = $id;
			$view['detail'] = $this -> customer_group_model -> __get_customer_group_detail($id);
			$this->load->view(__FUNCTION__, $view);
		}
	}
	
	function customer_group_delete($id) {
		if ($this -> customer_group_model -> __delete_customer_group($id)) {
			__set_error_msg(array('info' => 'Data berhasil dihapus.'));
			redirect(site_url('customer_group'));
		}
		else {
			__set_error_msg(array('error' => 'Gagal hapus data !!!'));
			redirect(site_url('customer_group'));
		}
	}
}
