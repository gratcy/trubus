<?php
/* -*- tab-width: 2; indent-tabs-mode: nil; c-basic-offset: 2 -*- */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {
	function __construct() {
		parent::__construct();
		$this -> load -> library('pagination_lib');
		$this -> load -> model('province_model');
	}

	function index() {
		$pager = $this -> pagination_lib -> pagination($this -> province_model -> __get_province(),3,10,site_url('province'));
		$view['province'] = $this -> pagination_lib -> paginate();
		$view['pages'] = $this -> pagination_lib -> pages();
		$this->load->view('province', $view);
	}
	
	function province_add() {
		if ($_POST) {
			$name = $this -> input -> post('name', TRUE);
			$status = (int) $this -> input -> post('status');
			
			if (!$name) {
				__set_error_msg(array('error' => 'Nama kota harus di isi !!!'));
				redirect(site_url('province' . '/' . __FUNCTION__));
			}
			else {
				$arr = array('pname' => $name, 'pstatus' => $status);
				if ($this -> province_model -> __insert_province($arr)) {
					__set_error_msg(array('info' => 'Data berhasil ditambahkan.'));
					redirect(site_url('province'));
				}
				else {
					__set_error_msg(array('error' => 'Gagal menambahkan data !!!'));
					redirect(site_url('province'));
				}
			}
		}
		else
			$this->load->view(__FUNCTION__, '');
	}
	
	function province_update($id) {
		if ($_POST) {
			$id = (int) $this -> input -> post('id');
			$name = $this -> input -> post('name', TRUE);
			$status = (int) $this -> input -> post('status');
			
			if ($id) {
				if (!$name) {
					__set_error_msg(array('error' => 'Nama kota harus di isi !!!'));
					redirect(site_url('province' . '/' . __FUNCTION__ . '/' . $id));
				}
				else {
					$arr = array('pname' => $name, 'pstatus' => $status);
					
					if ($this -> province_model -> __update_province($id, $arr)) {	
						__set_error_msg(array('info' => 'Data berhasil diubah.'));
						redirect(site_url('province'));
					}
					else {
						__set_error_msg(array('error' => 'Gagal mengubah data !!!'));
						redirect(site_url('province'));
					}
				}
			}
			else {
				__set_error_msg(array('error' => 'Kesalahan input data !!!'));
				redirect(site_url('province'));
			}
		}
		else {
			$view['id'] = $id;
			$view['detail'] = $this -> province_model -> __get_province_detail($id);
			$this->load->view(__FUNCTION__, $view);
		}
	}
	
	function province_delete($id) {
		if ($this -> province_model -> __delete_province($id)) {
			__set_error_msg(array('info' => 'Data berhasil dihapus.'));
			redirect(site_url('province'));
		}
		else {
			__set_error_msg(array('error' => 'Gagal hapus data !!!'));
			redirect(site_url('province'));
		}
	}
}
