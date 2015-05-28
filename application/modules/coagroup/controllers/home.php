<?php
/* -*- tab-width: 2; indent-tabs-mode: nil; c-basic-offset: 2 -*- */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {
	function __construct() {
		parent::__construct();
		$this -> load -> library('pagination_lib');
		$this -> load -> helper('coagroup');
		$this -> load -> model('coagroup_model');
	}
	
	function index() {
		$view['coagroup'] = $this -> coagroup_model -> __get_coagroup();
		$this->load->view('coagroup', $view);
	}
	
	function coagroup_add() {
		if ($_POST) {
			$name = $this -> input -> post('name', TRUE);
			$desc = $this -> input -> post('desc', TRUE);
			$class = (int) $this -> input -> post('class');
			$status = (int) $this -> input -> post('status');
			
			if (!$name) {
				__set_error_msg(array('error' => 'Nama dan Class harus di isi !!!'));
				redirect(site_url('coagroup' . '/' . __FUNCTION__));
			}
			else {
				$arr = array('cname' => $name, 'cdesc' => $desc, 'cclass' => $class, 'cstatus' => $status);
				if ($this -> coagroup_model -> __insert_coagroup($arr, 1)) {
					__set_error_msg(array('info' => 'Data berhasil ditambahkan.'));
					redirect(site_url('coagroup'));
				}
				else {
					__set_error_msg(array('error' => 'Gagal menambahkan data !!!'));
					redirect(site_url('coagroup'));
				}
			}
		}
		else
			$this->load->view(__FUNCTION__, '');
	}
	
	function coagroup_update($id) {
		if ($_POST) {
			$id = (int) $this -> input -> post('id');
			$name = $this -> input -> post('name', TRUE);
			$desc = $this -> input -> post('desc', TRUE);
			$class = (int) $this -> input -> post('class');
			$status = (int) $this -> input -> post('status');
			
			if ($id) {
				if (!$name) {
					__set_error_msg(array('error' => 'Data yang anda masukkan tidak lengkap !!!'));
					redirect(site_url('coagroup' . '/' . __FUNCTION__ . '/' . $id));
				}
				else {
					$arr = array('cname' => $name, 'cdesc' => $desc, 'cclass' => $class, 'cstatus' => $status);
					if ($this -> coagroup_model -> __update_coagroup($id, $arr)) {	
						__set_error_msg(array('info' => 'Data berhasil diubah.'));
						redirect(site_url('coagroup'));
					}
					else {
						__set_error_msg(array('error' => 'Gagal mengubah data !!!'));
						redirect(site_url('coagroup'));
					}
				}
			}
			else {
				__set_error_msg(array('error' => 'Kesalahan input data !!!'));
				redirect(site_url('coagroup'));
			}
		}
		else {
			$view['id'] = $id;
			$view['detail'] = $this -> coagroup_model -> __get_coagroup_detail($id);
			$this->load->view(__FUNCTION__, $view);
		}
	}
	
	function coagroup_delete($id) {
		if ($this -> coagroup_model -> __delete_coagroup($id)) {
			__set_error_msg(array('info' => 'Data berhasil dihapus.'));
			redirect(site_url('coagroup'));
		}
		else {
			__set_error_msg(array('error' => 'Gagal hapus data !!!'));
			redirect(site_url('coagroup'));
		}
	}
}
