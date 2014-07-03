<?php
/* -*- tab-width: 2; indent-tabs-mode: nil; c-basic-offset: 2 -*- */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {
	function __construct() {
		parent::__construct();
		$this -> load -> library('pagination_lib');
		$this -> load -> library('branch/branch_lib');
		$this -> load -> library('categories/categories_lib');
		$this -> load -> model('sales_commision_model');
	}

	function index() {
		$pager = $this -> pagination_lib -> pagination($this -> sales_commision_model -> __get_sales_commision(),3,10,site_url('sales_commision'));
		$view['sales_commision'] = $this -> pagination_lib -> paginate();
		$view['pages'] = $this -> pagination_lib -> pages();
		$this->load->view('sales_commision', $view);
	}
	
	function sales_commision_add() {
		if ($_POST) {
			$branch = (int) $this -> input -> post('branch');
			$category = (int) $this -> input -> post('category');
			$scoma = (int) $this -> input -> post('scoma');
			$scomb = (int) $this -> input -> post('scomb');
			$scomc = (int) $this -> input -> post('scomc');
			$scomd = (int) $this -> input -> post('scomd');
			$scome = (int) $this -> input -> post('scome');
			$scredita = (int) $this -> input -> post('scredita');
			$screditb = (int) $this -> input -> post('screditb');
			$screditc = (int) $this -> input -> post('screditc');
			$screditd = (int) $this -> input -> post('screditd');
			$scredite = (int) $this -> input -> post('scredite');
			$status = (int) $this -> input -> post('status');
			
			if (!$branch || !$category || !$scoma || !$scomb || !$scomc || !$scomd || !$scome || !$scredita || !$screditb || !$screditc || !$screditd || !$scredite) {
				__set_error_msg(array('error' => 'Data yang anda masukkan tidak lengkap !!!'));
				redirect(site_url('sales_commision' . '/' . __FUNCTION__));
			}
			else {
				$arr = array('sbid' => $branch, 'scid' => $category, 'scoma' => $scoma, 'scomb' => $scomb, 'scomc' => $scomc, 'scomd' => $scomd, 'scome' => $scome, 'scredita' => $scredita, 'screditb' => $screditb, 'screditc' => $screditc, 'screditd' => $screditd, 'scredite' => $scredite, 'sstatus' => $status);
				if ($this -> sales_commision_model -> __insert_sales_commision($arr)) {
					__set_error_msg(array('info' => 'Data berhasil ditambahkan.'));
					redirect(site_url('sales_commision'));
				}
				else {
					__set_error_msg(array('error' => 'Gagal menambahkan data !!!'));
					redirect(site_url('sales_commision'));
				}
			}
		}
		else {
			$view['branch'] = $this -> branch_lib -> __get_branch();
			$view['category'] = $this -> categories_lib -> __get_categories();
			$this->load->view(__FUNCTION__, $view);
		}
	}
	
	function sales_commision_update($id) {
		if ($_POST) {
			$branch = (int) $this -> input -> post('branch');
			$category = (int) $this -> input -> post('category');
			$scoma = (int) $this -> input -> post('scoma');
			$scomb = (int) $this -> input -> post('scomb');
			$scomc = (int) $this -> input -> post('scomc');
			$scomd = (int) $this -> input -> post('scomd');
			$scome = (int) $this -> input -> post('scome');
			$scredita = (int) $this -> input -> post('scredita');
			$screditb = (int) $this -> input -> post('screditb');
			$screditc = (int) $this -> input -> post('screditc');
			$screditd = (int) $this -> input -> post('screditd');
			$scredite = (int) $this -> input -> post('scredite');
			$status = (int) $this -> input -> post('status');
			$id = (int) $this -> input -> post('id');
			
			if ($id) {
				if (!$branch || !$category || !$scoma || !$scomb || !$scomc || !$scomd || !$scome || !$scredita || !$screditb || !$screditc || !$screditd || !$scredite) {
					__set_error_msg(array('error' => 'Data yang anda masukkan tidak lengkap !!!'));
					redirect(site_url('sales_commision' . '/' . __FUNCTION__ . '/' . $id));
				}
				else {
					$arr = array('sbid' => $branch, 'scid' => $category, 'scoma' => $scoma, 'scomb' => $scomb, 'scomc' => $scomc, 'scomd' => $scomd, 'scome' => $scome, 'scredita' => $scredita, 'screditb' => $screditb, 'screditc' => $screditc, 'screditd' => $screditd, 'scredite' => $scredite, 'sstatus' => $status);
					if ($this -> sales_commision_model -> __update_sales_commision($id, $arr)) {	
						__set_error_msg(array('info' => 'Data berhasil diubah.'));
						redirect(site_url('sales_commision'));
					}
					else {
						__set_error_msg(array('error' => 'Gagal mengubah data !!!'));
						redirect(site_url('sales_commision'));
					}
				}
			}
			else {
				__set_error_msg(array('error' => 'Kesalahan input data !!!'));
				redirect(site_url('sales_commision'));
			}
		}
		else {
			$view['id'] = $id;
			$view['detail'] = $this -> sales_commision_model -> __get_sales_commision_detail($id);
			$view['branch'] = $this -> branch_lib -> __get_branch($view['detail'][0] -> sbid);
			$view['category'] = $this -> categories_lib -> __get_categories($view['detail'][0] -> scid);
			$this->load->view(__FUNCTION__, $view);
		}
	}
	
	function sales_commision_delete($id) {
		if ($this -> sales_commision_model -> __delete_sales($id)) {
			__set_error_msg(array('info' => 'Data berhasil dihapus.'));
			redirect(site_url('sales_commision'));
		}
		else {
			__set_error_msg(array('error' => 'Gagal hapus data !!!'));
			redirect(site_url('sales_commision'));
		}
	}
}
