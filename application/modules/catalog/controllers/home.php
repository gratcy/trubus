<?php
/* -*- tab-width: 2; indent-tabs-mode: nil; c-basic-offset: 2 -*- */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {
	function __construct() {
		parent::__construct();
		$this -> load -> library('pagination_lib');
		$this -> load -> model('catalog_model');
		$this -> load -> model('books/books_model');
		$this -> load -> library('branch/branch_lib');
	}

	function index() {
		($this -> memcachedlib -> get('__catalog_books_add') ? $this -> memcachedlib -> delete('__catalog_books_add') : false);
		$pager = $this -> pagination_lib -> pagination($this -> catalog_model -> __get_catalog(),3,10,site_url('catalog'));
		$view['catalog'] = $this -> pagination_lib -> paginate();
		$view['pages'] = $this -> pagination_lib -> pages();
		$this->load->view('catalog', $view);
	}
	
	function catalog_add() {
		if ($_POST) {
			$branch = (int) $this -> input -> post('branch');
			$title = $this -> input -> post('title', TRUE);
			$desc = $this -> input -> post('desc', TRUE);
			$bid = $this -> input -> post('bid');
			$status = (int) $this -> input -> post('status');
			
			if (!$branch || !$title) {
				__set_error_msg(array('error' => 'Data yang anda masukkan tidak lengkap !!!'));
				redirect(site_url('catalog' . '/' . __FUNCTION__));
			}
			else {
				$arr = array('cbid' => $branch, 'ctitle' => $title, 'cdesc' => $desc, 'cstatus' => $status);
				if ($this -> catalog_model -> __insert_catalog($arr)) {
					$lastID = $this -> db -> insert_id();
					
					for($i=0;$i<count($bid);++$i) $this -> catalog_model -> __insert_catalog_books(array('ccid' => $lastID, 'cbid' => $bid[$i], 'cstatus' => 1));
					
					__set_error_msg(array('info' => 'Data berhasil ditambahkan.'));
					redirect(site_url('catalog'));
				}
				else {
					__set_error_msg(array('error' => 'Gagal menambahkan data !!!'));
					redirect(site_url('catalog'));
				}
			}
		}
		else {
			$view['branch'] = $this -> branch_lib -> __get_branch();
			$this->load->view(__FUNCTION__, $view);
		}
	}
	
	function catalog_update($id) {
		if ($_POST) {
			$id = (int) $this -> input -> post('id');
			$branch = (int) $this -> input -> post('branch');
			$title = $this -> input -> post('title', TRUE);
			$desc = $this -> input -> post('desc', TRUE);
			$bid = $this -> input -> post('bid');
			$status = (int) $this -> input -> post('status');
			
			if ($id) {
				if (!$branch || !$title) {
					__set_error_msg(array('error' => 'Data yang anda masukkan tidak lengkap !!!'));
					redirect(site_url('catalog' . '/' . __FUNCTION__ . '/' . $id));
				}
				else {
					$arr = array('cbid' => $branch, 'ctitle' => $title, 'cdesc' => $desc, 'cstatus' => $status);
					if ($this -> catalog_model -> __update_catalog($id, $arr)) {	
						__set_error_msg(array('info' => 'Data berhasil diubah.'));
						redirect(site_url('catalog'));
					}
					else {
						__set_error_msg(array('error' => 'Gagal mengubah data !!!'));
						redirect(site_url('catalog'));
					}
				}
			}
			else {
				__set_error_msg(array('error' => 'Kesalahan input data !!!'));
				redirect(site_url('catalog'));
			}
		}
		else {
			$view['id'] = $id;
			$view['detail'] = $this -> catalog_model -> __get_catalog_detail($id);
			$view['branch'] = $this -> branch_lib -> __get_branch($view['detail'][0] -> cbid);
			$this->load->view(__FUNCTION__, $view);
		}
	}

	function get_suggestion() {
		$hint = '';
		$a = array();
		$q = urldecode($_SERVER['QUERY_STRING']);
		$arr = $this -> catalog_model -> __get_suggestion();
		foreach($arr as $k => $v) $a[] = array('name' => $v -> name, 'id' => $v -> cid);
		
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
	
	function catalog_search() {
		$bname = urlencode($this -> input -> post('keyword', true));
		
		if ($bname)
			redirect(site_url('catalog/catalog_search_result/'.$bname));
		else
			redirect(site_url('catalog'));
	}
	
	function catalog_search_result($keyword) {
		$pager = $this -> pagination_lib -> pagination($this -> catalog_model -> __get_catalog_search(urldecode($keyword)),3,10,site_url('catalog/catalog_search_result/' . $keyword));
		$view['catalog'] = $this -> pagination_lib -> paginate();
		$view['pages'] = $this -> pagination_lib -> pages();
		$this -> load -> view('catalog', $view);
	}
	
	function catalog_delete($id) {
		if ($this -> catalog_model -> __delete_catalog($id)) {
			__set_error_msg(array('info' => 'Data berhasil dihapus.'));
			redirect(site_url('catalog'));
		}
		else {
			__set_error_msg(array('error' => 'Gagal hapus data !!!'));
			redirect(site_url('catalog'));
		}
	}
	
	function books_add($type) {
		$id = (int) $this -> input -> get('id');
		if ($_POST) {
			$bid = $this -> input -> post('bid');
			if ($type == 1) {
				$ids = $this -> memcachedlib -> get('__catalog_books_add');
				if ($ids) $bid = array_unique(array_merge($bid, $ids));
				
				$this -> memcachedlib -> set('__catalog_books_add', $bid, 3600);
			}
			else {
				for($i=0;$i<count($bid);++$i) {
					if (!$this -> catalog_model -> __check_catalog_books($id, $bid[$i])) {
						$this -> catalog_model -> __insert_catalog_books(array('ccid' => $id, 'cbid' => $bid[$i], 'cstatus' => 1));
					}
					else {
						__set_error_msg(array('error' => 'Buku sudah terdaftar !!!'));
						redirect(site_url('catalog/books_add/' . $type . '?id=' . $id));
					}
				}
			}
			__set_error_msg(array('info' => 'Buku berhasil ditambahkan.'));
			redirect(site_url('catalog/books_add/' . $type . '?id=' . $id));
		}
		else {
			$pager = $this -> pagination_lib -> pagination($this -> books_model -> __get_books_locator(''),3,10,site_url('catalog/books_add/' . $type));
			$view['books'] = $this -> pagination_lib -> paginate();
			$view['pages'] = $this -> pagination_lib -> pages();
			$view['id'] = $id;
			$view['type'] = $type;
			$view['catalog'] = true;
			$this -> load -> view('box/books_add', $view, false);
		}
	}
	
	function books_delete($type) {
		$bid = (int) $this -> input -> post('bid');
		$lid = (int) $this -> input -> post('lid');
		if ($bid) {
			if ($type == 1) {
				$ids = $this -> memcachedlib -> get('__catalog_books_add');
				$res = array();
				for($i=0;$i<count($ids);++$i)
					if ($ids[$i] <> $bid) $res[] = $ids[$i];
				$this -> memcachedlib -> set('__catalog_books_add', $res, 3600);
			}
			else {
				$this -> catalog_model -> __delete_catalog_books($lid, $bid);
			}
		}
	}
	
	function books_tmp($type) {
		$id = (int) $this -> input -> get('id');
		$ids = array();
		$view['books'] = array();
		
		if ($type == 1) {
			$ids = $this -> memcachedlib -> get('__catalog_books_add');
		}
		else {
			$arr = $this -> catalog_model -> __get_catalog_books($id);
			foreach($arr as $k => $v) $ids[] = $v -> cbid;
		}
		
		$view['id'] = $id;
		$view['type'] = $type;
		$view['catalog'] = true;
		
		if ($ids) {
			$view['books'] = $this -> books_model -> __get_books_locator(implode(',', $ids));
			$this -> load -> view('box/books_tmp', $view, false);
		}
	}
	
	function books_search() {
		$keyword = urlencode($this -> input -> post('keyword', true));
		$type = (int) $this -> input -> post('type');
		
		if ($keyword)
			redirect(site_url('catalog/books_search_result/'.$type.'/'.$keyword));
		else
			redirect(site_url('catalog'));
	}
	
	function books_search_result($type, $keyword) {
		$id = (int) $this -> input -> get('id');
		$pager = $this -> pagination_lib -> pagination($this -> books_model -> __get_books_locator_search($keyword),3,10,site_url('catalog/books_add/' . $type));
		$view['books'] = $this -> pagination_lib -> paginate();
		$view['pages'] = $this -> pagination_lib -> pages();
		$view['id'] = $id;
		$view['type'] = $type;
		$view['catalog'] = true;
		$this -> load -> view('box/books_add', $view, false);
	}
}
