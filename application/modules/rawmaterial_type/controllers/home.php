<?php
/* -*- tab-width: 2; indent-tabs-mode: nil; c-basic-offset: 2 -*- */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {
	function __construct() {
		parent::__construct();
		$this -> load -> library('pagination_lib');
		$this -> load -> model('rawmaterial_type_model');
	}

	function index() {
		$pager = $this -> pagination_lib -> pagination($this -> rawmaterial_type_model -> __get_rawmaterial_type(),3,10,site_url('rawmaterial_type'));
		$view['rawmaterial_type'] = $this -> pagination_lib -> paginate();
		$view['pages'] = $this -> pagination_lib -> pages();
		$this->load->view('rawmaterial_type', $view);
	}
	
	function rawmaterial_type_add() {
		if ($_POST) {
			$status = (int) $this -> input -> post('status');
		}
		else {
			$this->load->view(__FUNCTION__, '');
		}
	}
	
	function rawmaterial_type_update($id) {
		if ($_POST) {
			$status = (int) $this -> input -> post('status');
			$id = (int) $this -> input -> post('id');
			
			if ($id) {
				
			}
			else {
				__set_error_msg(array('error' => 'Kesalahan input data !!!'));
				redirect(site_url('rawmaterial_type'));
			}
		}
		else {
			$view['id'] = $id;
			$view['detail'] = $this -> rawmaterial_type_model -> __get_rawmaterial_type_detail($id);
			$this->load->view(__FUNCTION__, $view);
		}
	}
	
	function rawmaterial_type_delete($id) {
		if ($this -> rawmaterial_type_model -> __delete_rawmaterial($id)) {
			__set_error_msg(array('info' => 'Data berhasil dihapus.'));
			redirect(site_url('rawmaterial_type'));
		}
		else {
			__set_error_msg(array('error' => 'Gagal hapus data !!!'));
			redirect(site_url('rawmaterial_type'));
		}
	}
}
