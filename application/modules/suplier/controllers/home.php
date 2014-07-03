<?php
/* -*- tab-width: 2; indent-tabs-mode: nil; c-basic-offset: 2 -*- */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {
	function __construct() {
		parent::__construct();
		$this -> load -> library('pagination_lib');
		$this -> load -> model('suplier_model');
	}

	function index() {
		$pager = $this -> pagination_lib -> pagination($this -> suplier_model -> __get_suplier(),3,10,site_url('suplier'));
		$view['suplier'] = $this -> pagination_lib -> paginate();
		$view['pages'] = $this -> pagination_lib -> pages();
		$this->load->view('suplier', $view);
	}
	
	function suplier_add() {
		if ($_POST) {
			$code = $this -> input -> post('code', TRUE);
			$name = $this -> input -> post('name', TRUE);
			$cp = $this -> input -> post('cp', TRUE);
			$addr = $this -> input -> post('addr', TRUE);
			$addr2 = $this -> input -> post('addr2', TRUE);
			$phone1 = $this -> input -> post('phone1', TRUE);
			$phone2 = $this -> input -> post('phone2', TRUE);
			$city = (int) $this -> input -> post('city');
			$prov = (int) $this -> input -> post('prov');
			$npwp = $this -> input -> post('npwp', TRUE);
			$status = (int) $this -> input -> post('status');
			
			if (!$code || !$addr || !$addr2 || !$name || !$cp || !$phone1 || !$phone2 || !$city || !$prov || !$npwp) {
				__set_error_msg(array('error' => 'Data yang anda masukkan tidak lengkap !!!'));
				redirect(site_url('suplier' . '/' . __FUNCTION__));
			}
			else {
				$arr = array('scode' => $code, 'sname' => $name, 'scp' => $cp, 'snpwp' => $npwp, 'saddr' => $addr . '*' . $addr2, 'sphone' => $phone1 . '*' . $phone2, 'scity' => $city, 'sprov' => $prov, 'sstatus' => $status);
				if ($this -> suplier_model -> __insert_suplier($arr)) {
					__set_error_msg(array('info' => 'Data berhasil ditambahkan.'));
					redirect(site_url('suplier'));
				}
				else {
					__set_error_msg(array('error' => 'Gagal menambahkan data !!!'));
					redirect(site_url('suplier'));
				}
			}
		}
		else {
			$this->load->view(__FUNCTION__, '');
		}
	}
	
	function suplier_update($id) {
		if ($_POST) {
			$code = $this -> input -> post('code', TRUE);
			$name = $this -> input -> post('name', TRUE);
			$cp = $this -> input -> post('cp', TRUE);
			$addr = $this -> input -> post('addr', TRUE);
			$addr2 = $this -> input -> post('addr2', TRUE);
			$phone1 = $this -> input -> post('phone1', TRUE);
			$phone2 = $this -> input -> post('phone2', TRUE);
			$city = (int) $this -> input -> post('city');
			$prov = (int) $this -> input -> post('prov');
			$npwp = $this -> input -> post('npwp', TRUE);
			$status = (int) $this -> input -> post('status');
			$id = (int) $this -> input -> post('id');
			
			if ($id) {
				if (!$code || !$addr || !$addr2 || !$name || !$cp || !$phone1 || !$phone2 || !$city || !$prov || !$npwp) {
					__set_error_msg(array('error' => 'Data yang anda masukkan tidak lengkap !!!'));
					redirect(site_url('suplier' . '/' . __FUNCTION__ . '/' . $id));
				}
				else {
					$arr = array('scode' => $code, 'sname' => $name, 'scp' => $cp, 'snpwp' => $npwp, 'saddr' => $addr . '*' . $addr2, 'sphone' => $phone1 . '*' . $phone2, 'scity' => $city, 'sprov' => $prov, 'sstatus' => $status);
					if ($this -> suplier_model -> __update_suplier($id, $arr)) {	
						__set_error_msg(array('info' => 'Data berhasil diubah.'));
						redirect(site_url('suplier'));
					}
					else {
						__set_error_msg(array('error' => 'Gagal mengubah data !!!'));
						redirect(site_url('suplier'));
					}
				}
			}
			else {
				__set_error_msg(array('error' => 'Kesalahan input data !!!'));
				redirect(site_url('suplier'));
			}
		}
		else {
			$view['id'] = $id;
			$view['detail'] = $this -> suplier_model -> __get_suplier_detail($id);
			$this->load->view(__FUNCTION__, $view);
		}
	}
	
	function suplier_delete($id) {
		if ($this -> suplier_model -> __delete_suplier($id)) {
			__set_error_msg(array('info' => 'Data berhasil dihapus.'));
			redirect(site_url('suplier'));
		}
		else {
			__set_error_msg(array('error' => 'Gagal hapus data !!!'));
			redirect(site_url('suplier'));
		}
	}
}
