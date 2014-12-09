<?php
/* -*- tab-width: 2; indent-tabs-mode: nil; c-basic-offset: 2 -*- */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {
	function __construct() {
		parent::__construct();
		$this -> load -> library('pagination_lib');
		$this -> load -> model('city_model');
	}

	function index() {
		$pager = $this -> pagination_lib -> pagination($this -> city_model -> __get_city(),3,10,site_url('city'));
		$view['city'] = $this -> pagination_lib -> paginate();
		$view['pages'] = $this -> pagination_lib -> pages();
		$this->load->view('city', $view);
	}
	
	function city_add() {
		if ($_POST) {
			$name = $this -> input -> post('name', TRUE);
			$status = (int) $this -> input -> post('status');
			
			if (!$name) {
				__set_error_msg(array('error' => 'Nama kota harus di isi !!!'));
				redirect(site_url('city' . '/' . __FUNCTION__));
			}
			else {
				$arr = array('cname' => $name, 'cstatus' => $status);
				if ($this -> city_model -> __insert_city($arr)) {
					__set_error_msg(array('info' => 'Data berhasil ditambahkan.'));
					redirect(site_url('city'));
				}
				else {
					__set_error_msg(array('error' => 'Gagal menambahkan data !!!'));
					redirect(site_url('city'));
				}
			}
		}
		else
			$this->load->view(__FUNCTION__, '');
	}
	
	function city_update($id) {
		if ($_POST) {
			$id = (int) $this -> input -> post('id');
			$name = $this -> input -> post('name', TRUE);
			$status = (int) $this -> input -> post('status');
			
			if ($id) {
				if (!$name) {
					__set_error_msg(array('error' => 'Nama kota harus di isi !!!'));
					redirect(site_url('city' . '/' . __FUNCTION__ . '/' . $id));
				}
				else {
					$arr = array('cname' => $name, 'cstatus' => $status);
					
					if ($this -> city_model -> __update_city($id, $arr)) {	
						__set_error_msg(array('info' => 'Data berhasil diubah.'));
						redirect(site_url('city'));
					}
					else {
						__set_error_msg(array('error' => 'Gagal mengubah data !!!'));
						redirect(site_url('city'));
					}
				}
			}
			else {
				__set_error_msg(array('error' => 'Kesalahan input data !!!'));
				redirect(site_url('city'));
			}
		}
		else {
			$view['id'] = $id;
			$view['detail'] = $this -> city_model -> __get_city_detail($id);
			$this->load->view(__FUNCTION__, $view);
		}
	}
	
	function city_delete($id) {
		if ($this -> city_model -> __delete_city($id)) {
			__set_error_msg(array('info' => 'Data berhasil dihapus.'));
			redirect(site_url('city'));
		}
		else {
			__set_error_msg(array('error' => 'Gagal hapus data !!!'));
			redirect(site_url('city'));
		}
	}
}
