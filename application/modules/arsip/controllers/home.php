<?php
/* -*- tab-width: 2; indent-tabs-mode: nil; c-basic-offset: 2 -*- */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {
	function __construct() {
		parent::__construct();
		$this -> load -> library('category_arsip/category_arsip_lib');
		$this -> load -> library('pagination_lib');
		$this -> load -> model('arsip_model');
	}

	function index() {
		$pager = $this -> pagination_lib -> pagination($this -> arsip_model -> __get_arsip(),3,10,site_url('arsip'));
		$view['arsip'] = $this -> pagination_lib -> paginate();
		$view['pages'] = $this -> pagination_lib -> pages();
		$this->load->view('arsip', $view);
	}
	
	function arsip_add() {
		if ($_POST) {
			$cat = (int) $this -> input -> post('cat');
			$title = $this -> input -> post('title', TRUE);
			$desc = $this -> input -> post('desc', TRUE);
			$status = (int) $this -> input -> post('status');
			
			if (!$cat || !$title) {
				__set_error_msg(array('error' => 'Data yang anda masukkan tidak lengkap !!!'));
				redirect(site_url('arsip' . '/' . __FUNCTION__));
			}
			else {
				if (!$_FILES['file']['name']) {
					__set_error_msg(array('error' => 'File arsip harus diisi !!!'));
					redirect(site_url('arsip' . '/' . __FUNCTION__));
				}
				
				$fname = time() . uniqid() . $_FILES['file']['name'];
				$fdir = __get_path_upload('arsip', 1) . $cat;
				
				if (!is_dir($fdir)) mkdir($fdir);
				
				if (move_uploaded_file($_FILES["file"]["tmp_name"], $fdir .'/'. $fname)) {
					$arr = array('acid' => $cat,'atitle' => $title, 'adesc' => $desc, 'adate' => time(), 'afile' => $fname, 'asize' => $_FILES['file']['size'], 'astatus' => $status);
					if ($this -> arsip_model -> __insert_arsip($arr)) {
						__set_error_msg(array('info' => 'Data berhasil ditambahkan.'));
						redirect(site_url('arsip'));
					}
					else {
						@unlink($fdir .'/'. $fname);
						__set_error_msg(array('error' => 'Gagal menambahkan data !!!'));
						redirect(site_url('arsip'));
					}
				}
				else {
					__set_error_msg(array('error' => 'Gagal menambahkan data !!!'));
					redirect(site_url('arsip'));
				}
			}
		}
		else {
			$view['category'] = $this -> category_arsip_lib -> __get_category_arsip();
			$this->load->view(__FUNCTION__, $view);
		}
	}
	
	function arsip_update($id) {
		if ($_POST) {
			$id = (int) $this -> input -> post('id');
			$cat = (int) $this -> input -> post('cat');
			$title = $this -> input -> post('title', TRUE);
			$desc = $this -> input -> post('desc', TRUE);
			$sfile = $this -> input -> post('sfile', TRUE);
			$status = (int) $this -> input -> post('status');
			$scat = (int) $this -> input -> post('scat');
			
			if ($id) {
				if (!$cat || !$title) {
					__set_error_msg(array('error' => 'Data yang anda masukkan tidak lengkap !!!'));
					redirect(site_url('arsip' . '/' . __FUNCTION__ . '/' . $id));
				}
				else {
					$arr = array('acid' => $cat,'atitle' => $title, 'adesc' => $desc, 'adate' => time(), 'astatus' => $status);
					if ($_FILES["file"]['name']) {
						$fname = time() . uniqid() . $_FILES['file']['name'];
						$fdir = __get_path_upload('arsip', 1) . $cat;
						
						if (!is_dir($fdir)) mkdir($fdir);
						$rarr = array('afile' => $fname, 'asize' => $_FILES['file']['size']);
						if (move_uploaded_file($_FILES["file"]["tmp_name"], $fdir .'/'. $fname)) {
							if (file_exists($fdir . '/' . $sfile)) @unlink($fdir . '/' . $sfile);
							$arr = array_merge($arr, $rarr);
						}
						else {
							__set_error_msg(array('error' => 'Gagal upload data !!!'));
							redirect(site_url('arsip' . '/' . __FUNCTION__ . '/' . $id));
						}
					}
					
					if ($this -> arsip_model -> __update_arsip($id, $arr)) {	
						__set_error_msg(array('info' => 'Data berhasil diubah.'));
						redirect(site_url('arsip'));
					}
					else {
						__set_error_msg(array('error' => 'Gagal mengubah data !!!'));
						redirect(site_url('arsip'));
					}
				}
			}
			else {
				__set_error_msg(array('error' => 'Kesalahan input data !!!'));
				redirect(site_url('arsip'));
			}
		}
		else {
			$view['id'] = $id;
			$view['detail'] = $this -> arsip_model -> __get_arsip_detail($id);
			$view['category'] = $this -> category_arsip_lib -> __get_category_arsip($view['detail'][0] -> acid);
			$this->load->view(__FUNCTION__, $view);
		}
	}
	
	function arsip_delete($id) {
		if ($this -> arsip_model -> __delete_arsip($id)) {
			__set_error_msg(array('info' => 'Data berhasil dihapus.'));
			redirect(site_url('arsip'));
		}
		else {
			__set_error_msg(array('error' => 'Gagal hapus data !!!'));
			redirect(site_url('arsip'));
		}
	}
}
