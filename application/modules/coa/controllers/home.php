<?php
/* -*- tab-width: 2; indent-tabs-mode: nil; c-basic-offset: 2 -*- */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {
	function __construct() {
		parent::__construct();
		$this -> load -> library('pagination_lib');
		$this -> load -> helper('coa');
		$this -> load -> library('coa_lib');
		$this -> load -> model('coa_model');
	}
	
	function index() {
		$pager = $this -> pagination_lib -> pagination($this -> coa_model -> __get_coa(),3,10,site_url('coa'));
		$view['coa'] = __extract_coa(__get_coa_arr($this -> pagination_lib -> paginate()));
		$view['pages'] = $this -> pagination_lib -> pages();
		$this->load->view('coa', $view);
	}
	
	function coa_add() {
		if ($_POST) {
			$name = $this -> input -> post('name', TRUE);
			$code = $this -> input -> post('code', TRUE);
			$desc = $this -> input -> post('desc', TRUE);
			$saldo = str_replace(',','',$this -> input -> post('saldo', TRUE));
			$parent = (int) $this -> input -> post('parent');
			$type = (int) $this -> input -> post('type');
			$atype = (int) $this -> input -> post('atype');
			$status = (int) $this -> input -> post('status');
			
			if (!$name || !$code) {
				__set_error_msg(array('error' => 'Nama dan Kode harus di isi !!!'));
				redirect(site_url('coa' . '/' . __FUNCTION__));
			}
			else if (!$atype) {
				__set_error_msg(array('error' => 'Jenis akun harus di isi !!!'));
				redirect(site_url('coa' . '/' . __FUNCTION__));
			}
			else {
				$arr = array('catype' => $atype, 'ctype' => $type, 'ccode' => $code, 'cname' => $name, 'csaldo' => $saldo, 'cdesc' => $desc, 'cparent' => $parent, 'cstatus' => $status);
				if ($this -> coa_model -> __insert_coa($arr)) {
					__set_error_msg(array('info' => 'Data berhasil ditambahkan.'));
					redirect(site_url('coa'));
				}
				else {
					__set_error_msg(array('error' => 'Gagal menambahkan data !!!'));
					redirect(site_url('coa'));
				}
			}
		}
		else {
			$view['scoa'] = $this -> coa_lib -> __get_coa(0);
			$this->load->view(__FUNCTION__, $view);
		}
	}
	
	function coa_update($id) {
		if ($_POST) {
			$id = (int) $this -> input -> post('id');
			$name = $this -> input -> post('name', TRUE);
			$code = $this -> input -> post('code', TRUE);
			$desc = $this -> input -> post('desc', TRUE);
			$saldo = str_replace(',','',$this -> input -> post('saldo', TRUE));
			$parent = (int) $this -> input -> post('parent');
			$type = (int) $this -> input -> post('type');
			$atype = (int) $this -> input -> post('atype');
			$status = (int) $this -> input -> post('status');
			
			if ($id) {
				if (!$name || !$code) {
					__set_error_msg(array('error' => 'Data yang anda masukkan tidak lengkap !!!'));
					redirect(site_url('coa' . '/' . __FUNCTION__ . '/' . $id));
				}
				else if (!$atype) {
					__set_error_msg(array('error' => 'Jenis akun harus di isi !!!'));
					redirect(site_url('coa' . '/' . __FUNCTION__ . '/' . $id));
				}
				else {
					$arr = array('catype' => $atype, 'ctype' => $type, 'ccode' => $code, 'cname' => $name, 'csaldo' => $saldo, 'cdesc' => $desc, 'cparent' => $parent, 'cstatus' => $status);
					if ($this -> coa_model -> __update_coa($id, $arr)) {	
						__set_error_msg(array('info' => 'Data berhasil diubah.'));
						redirect(site_url('coa'));
					}
					else {
						__set_error_msg(array('error' => 'Gagal mengubah data !!!'));
						redirect(site_url('coa'));
					}
				}
			}
			else {
				__set_error_msg(array('error' => 'Kesalahan input data !!!'));
				redirect(site_url('coa'));
			}
		}
		else {
			$view['id'] = $id;
			$view['detail'] = $this -> coa_model -> __get_coa_detail($id);
			$view['scoa'] = $this -> coa_lib -> __get_coa($view['detail'][0] -> cparent);
			$this->load->view(__FUNCTION__, $view);
		}
	}
	
	function coa_delete($id) {
		if ($this -> coa_model -> __delete_coa($id)) {
			__set_error_msg(array('info' => 'Data berhasil dihapus.'));
			redirect(site_url('coa'));
		}
		else {
			__set_error_msg(array('error' => 'Gagal hapus data !!!'));
			redirect(site_url('coa'));
		}
	}
}
