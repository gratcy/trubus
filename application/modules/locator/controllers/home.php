<?php
/* -*- tab-width: 2; indent-tabs-mode: nil; c-basic-offset: 2 -*- */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {
	function __construct() {
		parent::__construct();
		$this -> load -> library('pagination_lib');
		$this -> load -> model('locator_model');
		$this -> load -> library('branch/branch_lib');
	}

	function index() {
		$pager = $this -> pagination_lib -> pagination($this -> locator_model -> __get_locator(),3,10,site_url('locator'));
		$view['locator'] = $this -> pagination_lib -> paginate();
		$view['pages'] = $this -> pagination_lib -> pages();
		$this->load->view('locator', $view);
	}
	
	function locator_add() {
		if ($_POST) {
			$branch = (int) $this -> input -> post('branch');
			$placed = $this -> input -> post('placed', TRUE);
			$desc = $this -> input -> post('desc', TRUE);
			$status = (int) $this -> input -> post('status');
			
			if (!$placed || !$branch) {
				__set_error_msg(array('error' => 'Data yang anda masukkan tidak lengkap !!!'));
				redirect(site_url('locator' . '/' . __FUNCTION__));
			}
			else {
				$arr = array('lbid' => $branch,'lplaced' => $placed, 'ldesc' => $desc, 'lstatus' => $status);
				if ($this -> locator_model -> __insert_locator($arr)) {
					__set_error_msg(array('info' => 'Data berhasil ditambahkan.'));
					redirect(site_url('locator'));
				}
				else {
					__set_error_msg(array('error' => 'Gagal menambahkan data !!!'));
					redirect(site_url('locator'));
				}
			}
		}
		else {
			$view['branch'] = $this -> branch_lib -> __get_branch();
			$this->load->view(__FUNCTION__, $view);
		}
	}
	
	function locator_update($id) {
		if ($_POST) {
			$id = (int) $this -> input -> post('id');
			$branch = (int) $this -> input -> post('branch');
			$placed = $this -> input -> post('placed', TRUE);
			$desc = $this -> input -> post('desc', TRUE);
			$status = (int) $this -> input -> post('status');
			
			if ($id) {
				if (!$placed || !$branch) {
					__set_error_msg(array('error' => 'Data yang anda masukkan tidak lengkap !!!'));
					redirect(site_url('locator' . '/' . __FUNCTION__ . '/' . $id));
				}
				else {
					$arr = array('lbid' => $branch,'lplaced' => $placed, 'ldesc' => $desc, 'lstatus' => $status);
					if ($this -> locator_model -> __update_locator($id, $arr)) {	
						__set_error_msg(array('info' => 'Data berhasil diubah.'));
						redirect(site_url('locator'));
					}
					else {
						__set_error_msg(array('error' => 'Gagal mengubah data !!!'));
						redirect(site_url('locator'));
					}
				}
			}
			else {
				__set_error_msg(array('error' => 'Kesalahan input data !!!'));
				redirect(site_url('locator'));
			}
		}
		else {
			$view['id'] = $id;
			$view['detail'] = $this -> locator_model -> __get_locator_detail($id);
			$view['branch'] = $this -> branch_lib -> __get_branch($view['detail'][0] -> lbid);
			$this->load->view(__FUNCTION__, $view);
		}
	}

	function get_suggestion() {
		$hint = '';
		$a = array();
		$q = $_SERVER['QUERY_STRING'];
		$arr = $this -> locator_model -> __get_suggestion();
		foreach($arr as $k => $v) $a[] = array('name' => $v -> name, 'id' => $v -> lid);
		
		if (strlen($q) > 0) {
			for($i=0; $i<count($a); $i++) {
				if (strtolower($q) == strtolower(substr($a[$i]['name'],0,strlen($q)))) {
					if ($hint == '')
						$hint .='<div class="autocomplete-suggestion" data-index="'.$i.'" ids="'.$a[$i]['id'].'">'.$a[$i]['name'].'</div>';
					else
						$hint .= '<div class="autocomplete-suggestion" data-index="'.$i.'" ids="'.$a[$i]['id'].'">'.$a[$i]['name'].'</div>';
				}
			}
		}
		
		echo ($hint == '' ? '<div class="autocomplete-suggestion">No Suggestion</div>' : $hint);
	}
	
	function locator_search() {
		$bname = urlencode($this -> input -> post('keyword', true));
		
		if ($bname)
			redirect(site_url('locator/locator_search_result/'.$bname));
		else
			redirect(site_url('locator'));
	}
	
	function locator_search_result($keyword) {
		$pager = $this -> pagination_lib -> pagination($this -> locator_model -> __get_locator_search(urldecode($keyword)),3,10,site_url('locator/locator_search_result/' . $keyword));
		$view['locator'] = $this -> pagination_lib -> paginate();
		$view['pages'] = $this -> pagination_lib -> pages();
		$this -> load -> view('locator', $view);
	}
	
	function locator_delete($id) {
		if ($this -> locator_model -> __delete_locator($id)) {
			__set_error_msg(array('info' => 'Data berhasil dihapus.'));
			redirect(site_url('locator'));
		}
		else {
			__set_error_msg(array('error' => 'Gagal hapus data !!!'));
			redirect(site_url('locator'));
		}
	}
}
