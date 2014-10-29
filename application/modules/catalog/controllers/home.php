<?php
/* -*- tab-width: 2; indent-tabs-mode: nil; c-basic-offset: 2 -*- */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {
	function __construct() {
		parent::__construct();
		$this -> load -> library('pagination_lib');
		$this -> load -> model('catalog_model');
		$this -> load -> library('books/books_lib');
	}

	function index() {
		$pager = $this -> pagination_lib -> pagination($this -> catalog_model -> __get_catalog(),3,10,site_url('catalog'));
		$view['catalog'] = $this -> pagination_lib -> paginate();
		$view['pages'] = $this -> pagination_lib -> pages();
		$this->load->view('catalog', $view);
	}
	
	function catalog_add() {
		if ($_POST) {
			$desc = $this -> input -> post('desc', TRUE);
			$book = (int) $this -> input -> post('book');
			$status = (int) $this -> input -> post('status');
			
			if (!$book) {
				__set_error_msg(array('error' => 'Buku harus dipilih !!!'));
				redirect(site_url('catalog' . '/' . __FUNCTION__));
			}
			else {
				if (!$_FILES['file']['name']) {
					__set_error_msg(array('error' => 'File catalog harus diisi !!!'));
					redirect(site_url('catalog' . '/' . __FUNCTION__));
				}
				
				$fname = time() . uniqid() . $_FILES['file']['name'];
				$fdir = __get_path_upload('catalog', 1);
				
				if (!is_dir($fdir)) mkdir($fdir);
				
				if (move_uploaded_file($_FILES["file"]["tmp_name"], $fdir .'/'. $fname)) {
					$arr = array('cbid' => $book, 'cdesc' => $desc, 'cfile' => $fname, 'csize' => $_FILES['file']['size'], 'cstatus' => $status);
					if ($this -> catalog_model -> __insert_catalog($arr)) {
						__set_error_msg(array('info' => 'Data berhasil ditambahkan.'));
						redirect(site_url('catalog'));
					}
					else {
						@unlink($fdir .'/'. $fname);
						__set_error_msg(array('error' => 'Gagal menambahkan data !!!'));
						redirect(site_url('catalog'));
					}
				}
				else {
					__set_error_msg(array('error' => 'Gagal menambahkan data !!!'));
					redirect(site_url('catalog'));
				}
			}
		}
		else {
			$view['books'] = $this -> books_lib -> __get_books();
			$this->load->view(__FUNCTION__, $view);
		}
	}
	
	function catalog_update($id) {
		if ($_POST) {
			$id = (int) $this -> input -> post('id');
			$desc = $this -> input -> post('desc', TRUE);
			$book = (int) $this -> input -> post('book');
			$sfile = $this -> input -> post('sfile', TRUE);
			$status = (int) $this -> input -> post('status');
			
			if ($id) {
				if (!$book) {
					__set_error_msg(array('error' => 'Buku harus dipilih !!!'));
					redirect(site_url('catalog' . '/' . __FUNCTION__ . '/' . $id));
				}
				else {
					$arr = array('cbid' => $book, 'cdesc' => $desc, 'cstatus' => $status);
					if ($_FILES["file"]['name']) {
						$fname = time() . uniqid() . $_FILES['file']['name'];
						$fdir = __get_path_upload('catalog', 1);
						
						if (!is_dir($fdir)) mkdir($fdir);
						$rarr = array('cfile' => $fname, 'csize' => $_FILES['file']['size']);
						if (move_uploaded_file($_FILES["file"]["tmp_name"], $fdir. $fname)) {
							if (file_exists($dir . $sfile)) @unlink($dir . $sfile);
							$arr = array_merge($arr, $rarr);
						}
						else {
							__set_error_msg(array('error' => 'Gagal upload data !!!'));
							redirect(site_url('catalog' . '/' . __FUNCTION__ . '/' . $id));
						}
					}
					
					if ($this -> catalog_model -> __update_catalog($id, $arr)) {	
						__set_error_msg(array('info' => 'Data berhasil diubah.'));
						redirect(site_url('catalog'));
					}
					else {
						__set_error_msg(array('error' => 'Gagal mengubah data !!!'));
						redirect(site_url('catalog'));
					}
				}
			}
			else {
				__set_error_msg(array('error' => 'Kesalahan input data !!!'));
				redirect(site_url('catalog'));
			}
		}
		else {
			$view['id'] = $id;
			$view['detail'] = $this -> catalog_model -> __get_catalog_detail($id);
			$view['books'] = $this -> books_lib -> __get_books($view['detail'][0] -> cbid);
			$this->load->view(__FUNCTION__, $view);
		}
	}
	
	function catalog_delete($id) {
		if ($this -> catalog_model -> __delete_catalog($id)) {
			__set_error_msg(array('info' => 'Data berhasil dihapus.'));
			redirect(site_url('catalog'));
		}
		else {
			__set_error_msg(array('error' => 'Gagal hapus data !!!'));
			redirect(site_url('catalog'));
		}
	}
}
