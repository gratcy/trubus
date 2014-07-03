<?php
/* -*- tab-width: 2; indent-tabs-mode: nil; c-basic-offset: 2 -*- */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {
	function __construct() {
		parent::__construct();
		$this -> load -> library('pagination_lib');
		$this -> load -> library('branch/branch_lib');
		$this -> load -> library('products/products_lib');
		$this -> load -> model('price_model');
	}

	function index($type) {
		$pager = $this -> pagination_lib -> pagination($this -> price_model -> __get_price($type),3,10,site_url('price'));
		$view['price'] = $this -> pagination_lib -> paginate();
		$view['pages'] = $this -> pagination_lib -> pages();
		$view['type'] = $type;
		$this->load->view('price', $view);
	}
	
	function price_add($type) {
		if ($_POST) {
			$status = (int) $this -> input -> post('status');
		}
		else {
			$view['type'] = $type;
			$view['branch'] = $this -> branch_lib -> __get_branch();
			$view['products'] = $this -> products_lib -> __get_products();
			$this->load->view(__FUNCTION__, $view);
		}
	}
	
	function price_update($type,$id) {
		if ($_POST) {
			$status = (int) $this -> input -> post('status');
			$id = (int) $this -> input -> post('id');
			
			if ($id) {
				
			}
			else {
				__set_error_msg(array('error' => 'Kesalahan input data !!!'));
				redirect(site_url('price'));
			}
		}
		else {
			$view['type'] = $type;
			$view['id'] = $id;
			$view['detail'] = $this -> price_model -> __get_price_detail($type,$id);
			$view['branch'] = $this -> branch_lib -> __get_branch($view['detail'][0] -> pbid);
			$view['products'] = $this -> products_lib -> __get_products($view['detail'][0] -> piid);
			$this->load->view(__FUNCTION__, $view);
		}
	}
	
	function price_delete($type,$id) {
		if ($this -> price_model -> __delete_price($id)) {
			__set_error_msg(array('info' => 'Data berhasil dihapus.'));
			redirect(site_url('price'));
		}
		else {
			__set_error_msg(array('error' => 'Gagal hapus data !!!'));
			redirect(site_url('price'));
		}
	}
}
