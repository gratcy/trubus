<?php
/* -*- tab-width: 2; indent-tabs-mode: nil; c-basic-offset: 2 -*- */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {
	function __construct() {
		parent::__construct();
		$this -> load -> library('pagination_lib');
		$this -> load -> model('category_arsip_model');
		$this -> load -> library('category_arsip_lib');
	}

	function index() {
		$pager = $this -> pagination_lib -> pagination($this -> category_arsip_model -> __get_category_arsip(1,0),3,10,site_url('category_arsip'));
		$view['category_arsip'] = $this -> pagination_lib -> paginate();
		$view['pages'] = $this -> pagination_lib -> pages();
		$this->load->view('category_arsip', $view);
	}
	
	function category_arsip_add() {
		if ($_POST) {
			$name = $this -> input -> post('name', TRUE);
			$desc = $this -> input -> post('desc', TRUE);
			$parent = (int) $this -> input -> post('parent');
			$status = (int) $this -> input -> post('status');
			
			if (!$name) {
				__set_error_msg(array('error' => 'Data yang anda masukkan tidak lengkap !!!'));
				redirect(site_url('category_arsip' . '/' . __FUNCTION__));
			}
			else {
				$pr = $this -> category_arsip_model -> __check_parent($parent);
				if ($pr[0] -> cparent <> 0) $parent = $pr[0] -> cparent;
				
				$arr = array('ctype' => 1,'cname' => $name, 'cdesc' => $desc, 'cstatus' => $status, 'cparent' => $parent);
				if ($this -> category_arsip_model -> __insert_category_arsip($arr)) {
					__set_error_msg(array('info' => 'Data berhasil ditambahkan.'));
					redirect(site_url('category_arsip'));
				}
				else {
					__set_error_msg(array('error' => 'Gagal menambahkan data !!!'));
					redirect(site_url('category_arsip'));
				}
			}
		}
		else {
			$view['cparent'] = $this -> category_arsip_lib -> __get_category_arsip();
			$this->load->view(__FUNCTION__, $view);
		}
	}
	
	function category_arsip_update($id) {
		if ($_POST) {
			$id = (int) $this -> input -> post('id');
			$name = $this -> input -> post('name', TRUE);
			$desc = $this -> input -> post('desc', TRUE);
			$parent = (int) $this -> input -> post('parent');
			$status = (int) $this -> input -> post('status');
			
			if ($id) {
				if (!$name) {
					__set_error_msg(array('error' => 'Data yang anda masukkan tidak lengkap !!!'));
					redirect(site_url('category_arsip' . '/' . __FUNCTION__ . '/' . $id));
				}
				else {
					$pr = $this -> category_arsip_model -> __check_parent($parent);
					if ($pr[0] -> cparent <> 0) $parent = $pr[0] -> cparent;
				
					$arr = array('cname' => $name, 'cdesc' => $desc, 'cstatus' => $status, 'cparent' => $parent);
					if ($this -> category_arsip_model -> __update_category_arsip($id, $arr)) {	
						__set_error_msg(array('info' => 'Data berhasil diubah.'));
						redirect(site_url('category_arsip'));
					}
					else {
						__set_error_msg(array('error' => 'Gagal mengubah data !!!'));
						redirect(site_url('category_arsip'));
					}
				}
			}
			else {
				__set_error_msg(array('error' => 'Kesalahan input data !!!'));
				redirect(site_url('category_arsip'));
			}
		}
		else {
			$view['id'] = $id;
			$view['detail'] = $this -> category_arsip_model -> __get_category_arsip_detail($id);
			$view['cparent'] = $this -> category_arsip_lib -> __get_category_arsip($view['detail'][0] -> cparent);
			$this->load->view(__FUNCTION__, $view);
		}
	}

	function get_suggestion() {
		$hint = '';
		$a = array();
		$q = urldecode($_SERVER['QUERY_STRING']);
		if (strlen($q) < 3) return false;
		$arr = $this -> category_arsip_model -> __get_suggestion();
		foreach($arr as $k => $v) $a[] = array('name' => $v -> name, 'id' => $v -> cid);
		
		if (strlen($q) > 0) {
			for($i=0; $i<count($a); $i++) {
				$a[$i]['name'] = trim($a[$i]['name']);
				$num_words = substr_count($a[$i]['name'],' ')+1;
				$pos = array();
				$is_suggestion_added = false;
				
				for ($cnt_pos=0; $cnt_pos<$num_words; $cnt_pos++) {
					if ($cnt_pos==0)
						$pos[$cnt_pos] = 0;
					else
						$pos[$cnt_pos] = strpos($a[$i]['name'],' ', $pos[$cnt_pos-1])+1;
				}
				
				if (strtolower($q)==strtolower(substr($a[$i]['name'],0,strlen($q)))) {
					$hint .='<div class="autocomplete-suggestion" data-index="'.$i.'" ids="'.$a[$i]['id'].'">'.$a[$i]['name'].'</div>';
					$is_suggestion_added = true;
				}
				for ($j=0;$j<$num_words && !$is_suggestion_added;$j++) {
					if(strtolower($q)==strtolower(substr($a[$i]['name'],$pos[$j],strlen($q)))){
						$hint .='<div class="autocomplete-suggestion" data-index="'.$i.'" ids="'.$a[$i]['id'].'">'.$a[$i]['name'].'</div>';
						$is_suggestion_added = true;                                        
					}
				}
			}
		}
		
		echo ($hint == '' ? '<div class="autocomplete-suggestion">No Suggestion</div>' : $hint);
	}
	
	function category_arsip_search() {
		$bname = urlencode($this -> input -> post('keyword', true));
		
		if ($bname)
			redirect(site_url('category_arsip/category_arsip_search_result/'.$bname));
		else
			redirect(site_url('category_arsip'));
	}
	
	function category_arsip_search_result($keyword) {
		$pager = $this -> pagination_lib -> pagination($this -> category_arsip_model -> __get_category_arsip_search(urldecode($keyword)),3,10,site_url('category_arsip/category_arsip_search_result/' . $keyword));
		$view['category_arsip'] = $this -> pagination_lib -> paginate();
		$view['pages'] = $this -> pagination_lib -> pages();
		$this -> load -> view('category_arsip', $view);
	}
	
	function category_arsip_delete($id) {
		if ($this -> category_arsip_model -> __delete_category_arsip($id)) {
			__set_error_msg(array('info' => 'Data berhasil dihapus.'));
			redirect(site_url('category_arsip'));
		}
		else {
			__set_error_msg(array('error' => 'Gagal hapus data !!!'));
			redirect(site_url('category_arsip'));
		}
	}
}
