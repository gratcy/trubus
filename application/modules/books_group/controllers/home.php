<?php
/* -*- tab-width: 2; indent-tabs-mode: nil; c-basic-offset: 2 -*- */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {
	function __construct() {
		parent::__construct();
		$this -> load -> library('pagination_lib');
		$this -> load -> model('books_group_model');
		$this -> load -> library('books_group/books_group_lib');
	}

	function index() {
		$pager = $this -> pagination_lib -> pagination($this -> books_group_model -> __get_books_group(),3,10,site_url('books_group'));
		$view['books_group'] = $this -> pagination_lib -> paginate();
		$view['pages'] = $this -> pagination_lib -> pages();
		$this->load->view('books_group', $view);
	}
	
	function books_group_add() {
		if ($_POST) {
			$name = $this -> input -> post('name', TRUE);
			$code = $this -> input -> post('code', TRUE);
			$desc = $this -> input -> post('desc', TRUE);
			$status = (int) $this -> input -> post('status');
			$parent = (int) $this -> input -> post('parent');
			
			if (!$name || !$code || !$desc) {
				__set_error_msg(array('error' => 'Data yang anda masukkan tidak lengkap !!!'));
				redirect(site_url('books_group' . '/' . __FUNCTION__));
			}
			else {
				$pr = $this -> books_group_model -> __check_parent($parent);
				if ($pr[0] -> bparent <> 0) $parent = $pr[0] -> bparent;
				
				$arr = array('bname' => $name, 'bcode' => $code, 'bdesc' => $desc, 'bparent' => $parent, 'bstatus' => $status);
				if ($this -> books_group_model -> __insert_books_group($arr)) {
					__set_error_msg(array('info' => 'Data berhasil ditambahkan.'));
					redirect(site_url('books_group'));
				}
				else {
					__set_error_msg(array('error' => 'Gagal menambahkan data !!!'));
					redirect(site_url('books_group'));
				}
			}
		}
		else {
			$view['groups'] = $this -> books_group_lib -> __get_books_group();
			$this->load->view(__FUNCTION__, $view);
		}
	}
	
	function books_group_update($id) {
		if ($_POST) {
			$id = (int) $this -> input -> post('id');
			$name = $this -> input -> post('name', TRUE);
			$code = $this -> input -> post('code', TRUE);
			$desc = $this -> input -> post('desc', TRUE);
			$parent = (int) $this -> input -> post('parent');
			$status = (int) $this -> input -> post('status');
			
			if ($id) {
				if (!$name || !$code || !$desc) {
					__set_error_msg(array('error' => 'Data yang anda masukkan tidak lengkap !!!'));
					redirect(site_url('books_group' . '/' . __FUNCTION__ . '/' . $id));
				}
				else {
					$pr = $this -> books_group_model -> __check_parent($parent);
					if ($pr[0] -> bparent <> 0) $parent = $pr[0] -> bparent;
					
					$arr = array('bname' => $name, 'bcode' => $code, 'bdesc' => $desc, 'bparent' => $parent, 'bstatus' => $status);
					if ($this -> books_group_model -> __update_books_group($id, $arr)) {	
						__set_error_msg(array('info' => 'Data berhasil diubah.'));
						redirect(site_url('books_group'));
					}
					else {
						__set_error_msg(array('error' => 'Gagal mengubah data !!!'));
						redirect(site_url('books_group'));
					}
				}
			}
			else {
				__set_error_msg(array('error' => 'Kesalahan input data !!!'));
				redirect(site_url('books_group'));
			}
		}
		else {
			$view['id'] = $id;
			$view['detail'] = $this -> books_group_model -> __get_books_group_detail($id);
			$view['groups'] = $this -> books_group_lib -> __get_books_group($view['detail'][0] -> bparent);
			$this->load->view(__FUNCTION__, $view);
		}
	}

	function get_suggestion() {
		$hint = '';
		$a = array();
		$q = $_SERVER['QUERY_STRING'];
		$arr = $this -> books_group_model -> __get_suggestion();
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
	
	function books_group_search() {
		$bname = urlencode($this -> input -> post('keyword', true));
		
		if ($bname)
			redirect(site_url('books_group/books_group_search_result/'.$bname));
		else
			redirect(site_url('books_group'));
	}
	
	function books_group_search_result($keyword) {
		$pager = $this -> pagination_lib -> pagination($this -> books_group_model -> __get_books_group_search(urldecode($keyword)),3,10,site_url('books_group/books_group_search_result/' . $keyword));
		$view['books_group'] = $this -> pagination_lib -> paginate();
		$view['pages'] = $this -> pagination_lib -> pages();
		$this -> load -> view('books_group', $view);
	}
	
	function books_group_delete($id) {
		if ($this -> books_group_model -> __delete_books_group($id)) {
			__set_error_msg(array('info' => 'Data berhasil dihapus.'));
			redirect(site_url('books_group'));
		}
		else {
			__set_error_msg(array('error' => 'Gagal hapus data !!!'));
			redirect(site_url('books_group'));
		}
	}
}
