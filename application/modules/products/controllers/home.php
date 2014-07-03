<?php
/* -*- tab-width: 2; indent-tabs-mode: nil; c-basic-offset: 2 -*- */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {
	function __construct() {
		parent::__construct();
		$this -> load -> library('pagination_lib');
		$this -> load -> library('categories/categories_lib');
		$this -> load -> library('packaging/packaging_lib');
		$this -> load -> library('products/products_lib');
		$this -> load -> library('branch/branch_lib');
		$this -> load -> model('products_model');
	}

	function index() {
		$pager = $this -> pagination_lib -> pagination($this -> products_model -> __get_products(),3,10,site_url('products'));
		$view['products'] = $this -> pagination_lib -> paginate();
		$view['pages'] = $this -> pagination_lib -> pages();
		$this->load->view('products', $view);
	}
	
	function products_add() {
		if ($_POST) {
			$desc = $this -> input -> post('desc', TRUE);
			$packaging = (int) $this -> input -> post('packaging');
			$category = (int) $this -> input -> post('category');
			$point = $this -> input -> post('point', TRUE);
			$consume = $this -> input -> post('consume', TRUE);
			$store = $this -> input -> post('store', TRUE);
			$key = $this -> input -> post('key', TRUE);
			$semi = $this -> input -> post('semi', TRUE);
			$dist = $this -> input -> post('dist', TRUE);
			$basic = $this -> input -> post('basic', TRUE);
			$name = $this -> input -> post('name', TRUE);
			$code = $this -> input -> post('code', TRUE);
			$status = (int) $this -> input -> post('status');
			
			if (!$name || !$desc || !$consume || !$store || !$key || !$semi || !$dist || !$code) {
				__set_error_msg(array('error' => 'Data yang anda masukkan tidak lengkap !!!'));
				redirect(site_url('products' . '/' . __FUNCTION__));
			}
			else {
				$arr = array('pcid' => $category, 'ppid' => $packaging, 'pcode' => $code, 'pname' => $name, 'pdesc' => $desc, 'phpp' => $basic, 'pdist' => $dist, 'psemi' => $semi, 'pkey' => $key, 'pstore' => $store, 'pconsume' => $consume, 'ppoint' => $point, 'pstatus' => $status);
				if ($this -> products_model -> __insert_products($arr)) {
					__set_error_msg(array('info' => 'Data berhasil ditambahkan.'));
					redirect(site_url('products'));
				}
				else {
					__set_error_msg(array('error' => 'Gagal menambahkan data !!!'));
					redirect(site_url('products'));
				}
			}
		}
		else {
			$view['products'] = $this -> products_lib -> __get_products();
			$view['category'] = $this -> categories_lib -> __get_categories();
			$view['packaging'] = $this -> packaging_lib -> __get_packaging();
			$this->load->view(__FUNCTION__, $view);
		}
	}
	
	function products_update($id) {
		if ($_POST) {
			$desc = $this -> input -> post('desc', TRUE);
			$point = $this -> input -> post('point', TRUE);
			$consume = $this -> input -> post('consume', TRUE);
			$store = $this -> input -> post('store', TRUE);
			$key = $this -> input -> post('key', TRUE);
			$semi = $this -> input -> post('semi', TRUE);
			$dist = $this -> input -> post('dist', TRUE);
			$basic = $this -> input -> post('basic', TRUE);
			$name = $this -> input -> post('name', TRUE);
			$code = $this -> input -> post('code', TRUE);
			$packaging = (int) $this -> input -> post('packaging');
			$category = (int) $this -> input -> post('category');
			$status = (int) $this -> input -> post('status');
			$id = (int) $this -> input -> post('id');
			
			if ($id) {
				if (!$name || !$desc || !$consume || !$store || !$key || !$semi || !$dist || !$code) {
					__set_error_msg(array('error' => 'Data yang anda masukkan tidak lengkap !!!'));
					redirect(site_url('products' . '/' . __FUNCTION__ . '/' . $id));
				}
				else {
					$arr = array('pcid' => $category, 'ppid' => $packaging, 'pcode' => $code, 'pname' => $name, 'pdesc' => $desc, 'phpp' => $basic, 'pdist' => $dist, 'psemi' => $semi, 'pkey' => $key, 'pstore' => $store, 'pconsume' => $consume, 'ppoint' => $point, 'pstatus' => $status);
					if ($this -> products_model -> __update_products($id, $arr)) {	
						__set_error_msg(array('info' => 'Data berhasil diubah.'));
						redirect(site_url('products'));
					}
					else {
						__set_error_msg(array('error' => 'Gagal mengubah data !!!'));
						redirect(site_url('products'));
					}
				}
			}
			else {
				__set_error_msg(array('error' => 'Kesalahan input data !!!'));
				redirect(site_url('products'));
			}
		}
		else {
			$view['id'] = $id;
			$view['detail'] = $this -> products_model -> __get_products_detail($id);
			$view['category'] = $this -> categories_lib -> __get_categories($view['detail'][0] -> pcid);
			$view['packaging'] = $this -> packaging_lib -> __get_packaging($view['detail'][0] -> ppid);
			$view['moq'] = $this -> products_model -> __get_moq($id);
			$this->load->view(__FUNCTION__, $view);
		}
	}
	
	function products_delete($id) {
		if ($this -> products_model -> __delete_products($id)) {
			__set_error_msg(array('info' => 'Data berhasil dihapus.'));
			redirect(site_url('products'));
		}
		else {
			__set_error_msg(array('error' => 'Gagal hapus data !!!'));
			redirect(site_url('products'));
		}
	}
}
