<?php
/* -*- tab-width: 2; indent-tabs-mode: nil; c-basic-offset: 2 -*- */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {
	function __construct() {
		parent::__construct();
		$this -> load -> library('pagination_lib');
		$this -> load -> library('branch/branch_lib');
		$this -> load -> library('rawmaterial_type/rawmaterial_type_lib');
		$this -> load -> model('rawmaterial_model');
	}

	function index() {
		$pager = $this -> pagination_lib -> pagination($this -> rawmaterial_model -> __get_rawmaterial(),3,10,site_url('rawmaterial'));
		$view['rawmaterial'] = $this -> pagination_lib -> paginate();
		$view['pages'] = $this -> pagination_lib -> pages();
		$this->load->view('rawmaterial', $view);
	}
	
	function rawmaterial_add() {
		if ($_POST) {
			$status = (int) $this -> input -> post('status');
		}
		else {
			$view['branch'] = $this -> branch_lib -> __get_branch();
			$view['typematerial'] = $this -> rawmaterial_type_lib -> __get_rawmaterial_type();
			$this->load->view(__FUNCTION__, $view);
		}
	}
	
	function rawmaterial_update($id) {
		if ($_POST) {
			$status = (int) $this -> input -> post('status');
			$id = (int) $this -> input -> post('id');
			
			if ($id) {
				
			}
			else {
				__set_error_msg(array('error' => 'Kesalahan input data !!!'));
				redirect(site_url('rawmaterial'));
			}
		}
		else {
			$view['id'] = $id;
			$view['detail'] = $this -> rawmaterial_model -> __get_rawmaterial_detail($id);
			$view['branch'] = $this -> branch_lib -> __get_branch($view['detail'][0] -> rbid);
			$view['typematerial'] = $this -> rawmaterial_type_lib -> __get_rawmaterial_type($view['detail'][0] -> rtype);
			$this->load->view(__FUNCTION__, $view);
		}
	}
	
	function rawmaterial_delete($id) {
		if ($this -> rawmaterial_model -> __delete_rawmaterial($id)) {
			__set_error_msg(array('info' => 'Data berhasil dihapus.'));
			redirect(site_url('rawmaterial'));
		}
		else {
			__set_error_msg(array('error' => 'Gagal hapus data !!!'));
			redirect(site_url('rawmaterial'));
		}
	}
}
