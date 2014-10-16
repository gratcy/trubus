<?php
/* -*- tab-width: 2; indent-tabs-mode: nil; c-basic-offset: 2 -*- */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {
	function __construct() {
		parent::__construct();
		$this -> load -> library('pagination_lib');
		$this -> load -> model('category_arsip_model');
	}

	function index() {
		$pager = $this -> pagination_lib -> pagination($this -> category_arsip_model -> __get_category_arsip(),3,10,site_url('category_arsip'));
		$view['category_arsip'] = $this -> pagination_lib -> paginate();
		$view['pages'] = $this -> pagination_lib -> pages();
		$this->load->view('category_arsip', $view);
	}
	
	function category_arsip_add() {
		if ($_POST) {
			$name = $this -> input -> post('name', TRUE);
			$desc = $this -> input -> post('desc', TRUE);
			$status = (int) $this -> input -> post('status');
			
			if (!$name) {
				__set_error_msg(array('error' => 'Data yang anda masukkan tidak lengkap !!!'));
				redirect(site_url('category_arsip' . '/' . __FUNCTION__));
			}
			else {
				$arr = array('ctype' => 1,'cname' => $name, 'cdesc' => $desc, 'cstatus' => $status);
				if ($this -> category_arsip_model -> __insert_category_arsip($arr)) {
					__set_error_msg(array('info' => 'Data berhasil ditambahkan.'));
					redirect(site_url('category_arsip'));
				}
				else {
					__set_error_msg(array('error' => 'Gagal menambahkan data !!!'));
					redirect(site_url('category_arsip'));
				}
			}
		}
		else {
			$this->load->view(__FUNCTION__, '');
		}
	}
	
	function category_arsip_update($id) {
		if ($_POST) {
			$id = (int) $this -> input -> post('id');
			$name = $this -> input -> post('name', TRUE);
			$desc = $this -> input -> post('desc', TRUE);
			$status = (int) $this -> input -> post('status');
			
			if ($id) {
				if (!$name) {
					__set_error_msg(array('error' => 'Data yang anda masukkan tidak lengkap !!!'));
					redirect(site_url('category_arsip' . '/' . __FUNCTION__ . '/' . $id));
				}
				else {
					$arr = array('cname' => $name, 'cdesc' => $desc, 'cstatus' => $status);
					if ($this -> category_arsip_model -> __update_category_arsip($id, $arr)) {	
						__set_error_msg(array('info' => 'Data berhasil diubah.'));
						redirect(site_url('category_arsip'));
					}
					else {
						__set_error_msg(array('error' => 'Gagal mengubah data !!!'));
						redirect(site_url('category_arsip'));
					}
				}
			}
			else {
				__set_error_msg(array('error' => 'Kesalahan input data !!!'));
				redirect(site_url('category_arsip'));
			}
		}
		else {
			$view['id'] = $id;
			$view['detail'] = $this -> category_arsip_model -> __get_category_arsip_detail($id);
			$this->load->view(__FUNCTION__, $view);
		}
	}
	
	function category_arsip_delete($id) {
		if ($this -> category_arsip_model -> __delete_category_arsip($id)) {
			__set_error_msg(array('info' => 'Data berhasil dihapus.'));
			redirect(site_url('category_arsip'));
		}
		else {
			__set_error_msg(array('error' => 'Gagal hapus data !!!'));
			redirect(site_url('category_arsip'));
		}
	}
}
