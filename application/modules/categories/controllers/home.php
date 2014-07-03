<?php
/* -*- tab-width: 2; indent-tabs-mode: nil; c-basic-offset: 2 -*- */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {
	function __construct() {
		parent::__construct();
		$this -> load -> library('pagination_lib');
		$this -> load -> model('categories_model');
	}

	function index() {
		$pager = $this -> pagination_lib -> pagination($this -> categories_model -> __get_categories(),3,10,site_url('categories'));
		$view['categories'] = $this -> pagination_lib -> paginate();
		$view['pages'] = $this -> pagination_lib -> pages();
		$this->load->view('categories', $view);
	}
	
	function categories_add() {
		if ($_POST) {
			$name = $this -> input -> post('name', TRUE);
			$desc = $this -> input -> post('desc', TRUE);
			$disc = (int) $this -> input -> post('disc');
			$status = (int) $this -> input -> post('status');
			
			if (!$name || !$desc || !$disc) {
				__set_error_msg(array('error' => 'Data yang anda masukkan tidak lengkap !!!'));
				redirect(site_url('categories' . '/' . __FUNCTION__));
			}
			else {
				$arr = array('cname' => $name, 'cdesc' => $desc, 'cstatus' => $status);
				if ($this -> categories_model -> __insert_categories($arr)) {
					__set_error_msg(array('info' => 'Data berhasil ditambahkan.'));
					redirect(site_url('categories'));
				}
				else {
					__set_error_msg(array('error' => 'Gagal menambahkan data !!!'));
					redirect(site_url('categories'));
				}
			}
		}
		else {
			$this->load->view(__FUNCTION__, '');
		}
	}
	
	function categories_update($id) {
		if ($_POST) {
			$name = $this -> input -> post('name', TRUE);
			$desc = $this -> input -> post('desc', TRUE);
			$disc = (int) $this -> input -> post('disc');
			$status = (int) $this -> input -> post('status');
			$id = (int) $this -> input -> post('id');
			
			if ($id) {
				if (!$name || !$desc || !$disc) {
					__set_error_msg(array('error' => 'Data yang anda masukkan tidak lengkap !!!'));
					redirect(site_url('categories' . '/' . __FUNCTION__ . '/' . $id));
				}
				else {
					$arr = array('cname' => $name, 'cdesc' => $desc, 'ctype' => 1, 'cstatus' => $status);
					if ($this -> categories_model -> __update_categories($id, $arr)) {	
						__set_error_msg(array('info' => 'Data berhasil diubah.'));
						redirect(site_url('categories'));
					}
					else {
						__set_error_msg(array('error' => 'Gagal mengubah data !!!'));
						redirect(site_url('categories'));
					}
				}
			}
			else {
				__set_error_msg(array('error' => 'Kesalahan input data !!!'));
				redirect(site_url('categories'));
			}
		}
		else {
			$view['id'] = $id;
			$view['detail'] = $this -> categories_model -> __get_categories_detail($id);
			$this->load->view(__FUNCTION__, $view);
		}
	}
	
	function categories_delete($id) {
		if ($this -> categories_model -> __delete_categories($id)) {
			__set_error_msg(array('info' => 'Data berhasil dihapus.'));
			redirect(site_url('categories'));
		}
		else {
			__set_error_msg(array('error' => 'Gagal hapus data !!!'));
			redirect(site_url('categories'));
		}
	}
}
