<?php
/* -*- tab-width: 2; indent-tabs-mode: nil; c-basic-offset: 2 -*- */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {
	function __construct() {
		parent::__construct();
		$this -> load -> library('category_arsip/category_arsip_lib');
		$this -> load -> library('pagination_lib');
		$this -> load -> model('arsip_model');
		$this -> load -> library('branch/branch_lib');
	}

	function index() {
		$pager = $this -> pagination_lib -> pagination($this -> arsip_model -> __get_arsip($this -> memcachedlib -> sesresult['ubranchid']),3,10,site_url('arsip'));
		$view['arsip'] = $this -> pagination_lib -> paginate();
		$view['pages'] = $this -> pagination_lib -> pages();
		$this->load->view('arsip', $view);
	}
	
	function arsip_add() {
		if ($_POST) {
			$cat = (int) $this -> input -> post('cat');
			$branch = (int) $this -> input -> post('branch');
			$title = $this -> input -> post('title', TRUE);
			$desc = $this -> input -> post('desc', TRUE);
			$status = (int) $this -> input -> post('status');
			
			if (!$cat || !$title || !$branch) {
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
					$arr = array('abid' => $branch, 'acid' => $cat,'atitle' => $title, 'adesc' => $desc, 'adate' => time(), 'afile' => $fname, 'asize' => $_FILES['file']['size'], 'astatus' => $status);
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
			$view['branch'] = $this -> branch_lib -> __get_branch();
			$view['category'] = $this -> category_arsip_lib -> __get_category_arsip();
			$this->load->view(__FUNCTION__, $view);
		}
	}
	
	function arsip_update($id) {
		if ($_POST) {
			$id = (int) $this -> input -> post('id');
			$branch = (int) $this -> input -> post('branch');
			$cat = (int) $this -> input -> post('cat');
			$title = $this -> input -> post('title', TRUE);
			$desc = $this -> input -> post('desc', TRUE);
			$sfile = $this -> input -> post('sfile', TRUE);
			$status = (int) $this -> input -> post('status');
			$scat = (int) $this -> input -> post('scat');
			
			if ($id) {
				if (!$cat || !$title || !$branch) {
					__set_error_msg(array('error' => 'Data yang anda masukkan tidak lengkap !!!'));
					redirect(site_url('arsip' . '/' . __FUNCTION__ . '/' . $id));
				}
				else {
					$arr = array('abid' => $branch,'acid' => $cat,'atitle' => $title, 'adesc' => $desc, 'adate' => time(), 'astatus' => $status);
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
			$view['branch'] = $this -> branch_lib -> __get_branch($view['detail'][0] -> abid);
			$view['category'] = $this -> category_arsip_lib -> __get_category_arsip($view['detail'][0] -> acid);
			$this->load->view(__FUNCTION__, $view);
		}
	}
	
	function get_suggestion() {
		$hint = '';
		$a = array();
		$q = $_SERVER['QUERY_STRING'];
		$arr = $this -> arsip_model -> __get_suggestion();
		if (strlen($q) < 3) return false;
		foreach($arr as $k => $v) $a[] = array('name' => $v -> name, 'id' => $v -> aid);
		
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
				
				if (strtolower($q)==strtolower(substr($a[$i]['code'],0,strlen($q)))) {
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
	
	function arsip_search() {
		$keyword = urlencode($this -> input -> post('keyword', true));
		
		if ($keyword)
			redirect(site_url('arsip/arsip_search_result/'.$keyword));
		else
			redirect(site_url('arsip'));
	}
	
	function arsip_search_result($keyword) {
		$pager = $this -> pagination_lib -> pagination($this -> arsip_model -> __get_arsip_search(urldecode($keyword)),3,10,site_url('arsip/arsip_search_result/' . $keyword));
		$view['arsip'] = $this -> pagination_lib -> paginate();
		$view['pages'] = $this -> pagination_lib -> pages();
		$this -> load -> view('arsip', $view);
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
