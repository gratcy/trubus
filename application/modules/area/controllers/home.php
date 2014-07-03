<?php
/* -*- tab-width: 2; indent-tabs-mode: nil; c-basic-offset: 2 -*- */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {
	function __construct() {
		parent::__construct();
		$this -> load -> library('pagination_lib');
		$this -> load -> model('area_model');
	}

	function index() {
		$pager = $this -> pagination_lib -> pagination($this -> area_model -> __get_area(),3,10,site_url('area'));
		$view['area'] = $this -> pagination_lib -> paginate();
		$view['pages'] = $this -> pagination_lib -> pages();
		$this->load->view('area', $view);
	}
	
	function area_add() {
		if ($_POST) {
			$name = $this -> input -> post('name', TRUE);
			$code = $this -> input -> post('code', TRUE);
			$desc = $this -> input -> post('desc', TRUE);
			$status = (int) $this -> input -> post('status');
			
			if (!$name || !$code || !$desc) {
				__set_error_msg(array('error' => 'Data yang anda masukkan tidak lengkap !!!'));
				redirect(site_url('area' . '/' . __FUNCTION__));
			}
			else {
				$arr = array('aname' => $name, 'acode' => $code, 'adesc' => $desc, 'astatus' => $status);
				if ($this -> area_model -> __insert_area($arr)) {
					__set_error_msg(array('info' => 'Data berhasil ditambahkan.'));
					redirect(site_url('area'));
				}
				else {
					__set_error_msg(array('error' => 'Gagal menambahkan data !!!'));
					redirect(site_url('area'));
				}
			}
		}
		else {
			$this->load->view(__FUNCTION__, '');
		}
	}
	
	function area_update($id) {
		if ($_POST) {
			$id = (int) $this -> input -> post('id');
			$name = $this -> input -> post('name', TRUE);
			$code = $this -> input -> post('code', TRUE);
			$desc = $this -> input -> post('desc', TRUE);
			$status = (int) $this -> input -> post('status');
			
			if ($id) {
				if (!$name || !$code || !$desc) {
					__set_error_msg(array('error' => 'Data yang anda masukkan tidak lengkap !!!'));
					redirect(site_url('area' . '/' . __FUNCTION__ . '/' . $id));
				}
				else {
					$arr = array('aname' => $name, 'acode' => $code, 'adesc' => $desc, 'astatus' => $status);
					if ($this -> area_model -> __update_area($id, $arr)) {	
						__set_error_msg(array('info' => 'Data berhasil diubah.'));
						redirect(site_url('area'));
					}
					else {
						__set_error_msg(array('error' => 'Gagal mengubah data !!!'));
						redirect(site_url('area'));
					}
				}
			}
			else {
				__set_error_msg(array('error' => 'Kesalahan input data !!!'));
				redirect(site_url('area'));
			}
		}
		else {
			$view['id'] = $id;
			$view['detail'] = $this -> area_model -> __get_area_detail($id);
			$this->load->view(__FUNCTION__, $view);
		}
	}
	
	function area_delete($id) {
		if ($this -> area_model -> __delete_area($id)) {
			__set_error_msg(array('info' => 'Data berhasil dihapus.'));
			redirect(site_url('area'));
		}
		else {
			__set_error_msg(array('error' => 'Gagal hapus data !!!'));
			redirect(site_url('area'));
		}
	}
}
