<?php
/* -*- tab-width: 2; indent-tabs-mode: nil; c-basic-offset: 2 -*- */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {
	function __construct() {
		parent::__construct();
		$this -> load -> library('pagination_lib');
		$this -> load -> library('province/province_lib');
		$this -> load -> library('city/city_lib');
		$this -> load -> model('branch_model');
	}

	function index() {
		$pager = $this -> pagination_lib -> pagination($this -> branch_model -> __get_branch(),3,10,site_url('branch'));
		$view['branch'] = $this -> pagination_lib -> paginate();
		$view['pages'] = $this -> pagination_lib -> pages();
		$this->load->view('branch', $view);
	}
	
	function branch_add() {
		if ($_POST) {
			$name = $this -> input -> post('name', TRUE);
			$npwp = $this -> input -> post('npwp', TRUE);
			$code = $this -> input -> post('code', TRUE);
			$addr = $this -> input -> post('addr', TRUE);
			$phone1 = $this -> input -> post('phone1', TRUE);
			$phone2 = $this -> input -> post('phone2', TRUE);
			$hname = $this -> input -> post('hname', TRUE);
			$city = (int) $this -> input -> post('city');
			$prov = (int) $this -> input -> post('prov');
			$status = (int) $this -> input -> post('status');
			
			if (!$name || !$npwp || !$addr || !$phone1 || !$city || !$prov || !$hname) {
				__set_error_msg(array('error' => 'Data yang anda masukkan tidak lengkap !!!'));
				redirect(site_url('branch' . '/' . __FUNCTION__));
			}
			else {
				$arr = array('bcode' => $code,'bname' => $name, 'bhname' => $hname, 'bnpwp' => $npwp, 'baddr' => $addr, 'bcity' => $city, 'bprovince' => $prov, 'bphone' => $phone1 . '*' . $phone2, 'bstatus' => $status);
				if ($this -> branch_model -> __insert_branch($arr)) {
					__set_error_msg(array('info' => 'Data berhasil ditambahkan.'));
					redirect(site_url('branch'));
				}
				else {
					__set_error_msg(array('error' => 'Gagal menambahkan data !!!'));
					redirect(site_url('branch'));
				}
			}
		}
		else {
			$view['province'] = $this -> province_lib -> __get_province();
			$view['city'] = $this -> city_lib -> __get_city();
			$this->load->view(__FUNCTION__, $view);
		}
	}
	
	function branch_update($id) {
		if ($_POST) {
			$name = $this -> input -> post('name', TRUE);
			$npwp = $this -> input -> post('npwp', TRUE);
			$code = $this -> input -> post('code', TRUE);
			$addr = $this -> input -> post('addr', TRUE);
			$phone1 = $this -> input -> post('phone1', TRUE);
			$phone2 = $this -> input -> post('phone2', TRUE);
			$hname = $this -> input -> post('hname', TRUE);
			$city = (int) $this -> input -> post('city');
			$prov = (int) $this -> input -> post('prov');
			$status = (int) $this -> input -> post('status');
			$id = (int) $this -> input -> post('id');
			
			if ($id) {
				if (!$name || !$npwp || !$addr || !$phone1 || !$city || !$prov || !$hname) {
					__set_error_msg(array('error' => 'Data yang anda masukkan tidak lengkap !!!'));
					redirect(site_url('branch' . '/' . __FUNCTION__ . '/' . $id));
				}
				else {
					$arr = array('bcode' => $code,'bname' => $name, 'bhname' => $hname, 'bnpwp' => $npwp, 'baddr' => $addr, 'bcity' => $city, 'bprovince' => $prov, 'bphone' => $phone1 . '*' . $phone2, 'bstatus' => $status);
					if ($this -> branch_model -> __update_branch($id, $arr)) {	
						__set_error_msg(array('info' => 'Data berhasil diubah.'));
						redirect(site_url('branch'));
					}
					else {
						__set_error_msg(array('error' => 'Gagal mengubah data !!!'));
						redirect(site_url('branch'));
					}
				}
			}
			else {
				__set_error_msg(array('error' => 'Kesalahan input data !!!'));
				redirect(site_url('branch'));
			}
		}
		else {
			$view['id'] = $id;
			$view['detail'] = $this -> branch_model -> __get_branch_detail($id);
			$view['province'] = $this -> province_lib -> __get_province($view['detail'][0] -> bprovince);
			$view['city'] = $this -> city_lib -> __get_city($view['detail'][0] -> bcity);
			$this->load->view(__FUNCTION__, $view);
		}
	}

	function get_suggestion() {
		$hint = '';
		$a = array();
		$q = $_SERVER['QUERY_STRING'];
		if (strlen($q) < 3) return false;
		$arr = $this -> branch_model -> __get_suggestion();
		foreach($arr as $k => $v) $a[] = array('name' => $v -> name, 'id' => $v -> bid);
		
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
	
	function branch_search() {
		$bname = urlencode($this -> input -> post('keyword', true));
		
		if ($bname)
			redirect(site_url('branch/branch_search_result/'.$bname));
		else
			redirect(site_url('branch'));
	}
	
	function branch_search_result($keyword) {
		$pager = $this -> pagination_lib -> pagination($this -> branch_model -> __get_branch_search(urldecode($keyword)),3,10,site_url('branch/branch_search_result/' . $keyword));
		$view['branch'] = $this -> pagination_lib -> paginate();
		$view['pages'] = $this -> pagination_lib -> pages();
		$this -> load -> view('branch', $view);
	}
	
	function branch_delete($id) {
		if ($this -> branch_model -> __delete_branch($id)) {
			__set_error_msg(array('info' => 'Data berhasil dihapus.'));
			redirect(site_url('branch'));
		}
		else {
			__set_error_msg(array('error' => 'Gagal hapus data !!!'));
			redirect(site_url('branch'));
		}
	}
}
