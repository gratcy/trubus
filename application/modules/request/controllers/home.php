<?php
/* -*- tab-width: 2; indent-tabs-mode: nil; c-basic-offset: 2 -*- */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {
	function __construct() {
		parent::__construct();
		$this -> load -> library('pagination_lib');
		$this -> load -> library('branch/branch_lib');
		$this -> load -> library('books/books_lib');
		$this -> load -> model('books/books_model');
		$this -> load -> model('request_model');
	}

	function index() {
		(!$this -> memcachedlib -> get('__request_books') ? '' : $this -> memcachedlib -> delete('__request_books'));
		$pager = $this -> pagination_lib -> pagination($this -> request_model -> __get_request(),3,10,site_url('request'));
		$view['request'] = $this -> pagination_lib -> paginate();
		$view['pages'] = $this -> pagination_lib -> pages();
		$this->load->view('request', $view);
	}
	
	function request_add() {
		if ($_POST) {
			$title = $this -> input -> post('title', TRUE);
			$desc = $this -> input -> post('desc', TRUE);
			$books = $this -> input -> post('books');
			$bfrom = (int) $this -> input -> post('bfrom');
			$bto = (int) $this -> input -> post('bto');
			$status = (int) $this -> input -> post('status');
			
			if (!$bfrom || !$bfrom || !$title) {
				__set_error_msg(array('error' => 'Cabang Asal, Tujuan dan Judul harus di isi !!!'));
				redirect(site_url('request' . '/' . __FUNCTION__));
			}
			else {
				$arr = array('dbfrom' => $bfrom, 'dbto' => $bto, 'ddate' => time(), 'dtitle' => $title, 'ddesc' => $desc, 'dstatus' => $status);
				if ($this -> request_model -> __insert_request($arr)) {
					$drid = $this -> db -> insert_id();
					foreach($books as $k => $v)
						$this -> request_model -> __insert_request_books(array('ddrid' => $drid,'dbid' => $k,'dqty' => $v,'dstatus' => 1));
					
					__set_error_msg(array('info' => 'Data berhasil ditambahkan.'));
					redirect(site_url('request'));
				}
				else {
					__set_error_msg(array('error' => 'Gagal menambahkan data !!!'));
					redirect(site_url('request'));
				}
			}
		}
		else {
			$view['bfrom'] = $this -> branch_lib -> __get_branch();
			$view['bto'] = $this -> branch_lib -> __get_branch();
			$this->load->view(__FUNCTION__, $view);
		}
	}
	
	function request_update($id) {
		if ($_POST) {
			$id = (int) $this -> input -> post('id');
			$title = $this -> input -> post('title', TRUE);
			$desc = $this -> input -> post('desc', TRUE);
			$books = $this -> input -> post('books');
			$bfrom = (int) $this -> input -> post('bfrom');
			$bto = (int) $this -> input -> post('bto');
			$app = (int) $this -> input -> post('app');
			if ($app == 1) $status = 3;
			else $status = (int) $this -> input -> post('status');
			
			if ($id) {
				if (!$bfrom || !$bfrom || !$title) {
					__set_error_msg(array('error' => 'Cabang Asal, Tujuan dan Judul harus di isi !!!'));
					redirect(site_url('request' . '/' . __FUNCTION__ . '/' . $id));
				}
				else {
					$arr = array('dbfrom' => $bfrom, 'dbto' => $bto, 'ddate' => time(), 'dtitle' => $title, 'ddesc' => $desc, 'dstatus' => $status);
					if ($this -> request_model -> __update_request($id, $arr)) {
						
					foreach($books as $k => $v)
						$this -> request_model -> __update_request_books($k,array('dqty' => $v));
						
						__set_error_msg(array('info' => 'Data berhasil diubah.'));
						redirect(site_url('request'));
					}
					else {
						__set_error_msg(array('error' => 'Gagal mengubah data !!!'));
						redirect(site_url('request'));
					}
				}
			}
			else {
				__set_error_msg(array('error' => 'Kesalahan input data !!!'));
				redirect(site_url('request'));
			}
		}
		else {
			$view['id'] = $id;
			$view['detail'] = $this -> request_model -> __get_request_detail($id);
			$view['bfrom'] = $this -> branch_lib -> __get_branch($view['detail'][0] -> dbfrom);
			$view['bto'] = $this -> branch_lib -> __get_branch($view['detail'][0] -> dbto);
			$this->load->view(__FUNCTION__, $view);
		}
	}
	
	function request_list_books($type, $did) {
		$pager = $this -> pagination_lib -> pagination($this -> books_model -> __get_books(),3,10,site_url('request/request_list_books/'.$type.'/'.(int) $did));
		$view['books'] = $this -> pagination_lib -> paginate();
		$view['pages'] = $this -> pagination_lib -> pages();
		$view['type'] = $type;
		$view['did'] = $did;
		$this->load->view('tmp/' . __FUNCTION__, $view, FALSE);
	}
	
	function request_books_delete($type) {
		$bid = (int) $this -> input -> post('bid');
		$did = (int) $this -> input -> post('did');
		if ($bid) {
			if ($type == 1) {
				$books = $this -> memcachedlib -> get('__request_books');
				$arr = array();
				foreach($books as $v)
					if ($v <> $bid) $arr[] = $v;
				$this -> memcachedlib -> set('__request_books', $arr, 900);
			}
			else
				if ($did) $this -> request_model -> __delete_request_books($did,$bid);
		}
	}
	
	function request_books_add($type) {
		$bid = $this -> input -> post('bid');
		if (!$bid) {
			__set_error_msg(array('error' => 'Buku harus dipilih !!!'));
			redirect(site_url('request/request_list_books/' . $type));
		}
		else {
			if ($type == 1) {
				$DidN = (!$this -> memcachedlib -> get('__request_books') ? array() : $this -> memcachedlib -> get('__request_books'));
				$this -> memcachedlib -> set('__request_books', array_unique(array_merge($DidN,$bid)), 900);
			}
			else {
				$drid = (int) $this -> input -> post('did');
				foreach($bid as $k => $v)
					$this -> request_model -> __insert_request_books(array('ddrid' => $drid,'dbid' => $v,'dstatus' => 1));
			}

			__set_error_msg(array('info' => 'Buku berhasil ditambahkan.'));
			redirect(site_url('request/request_list_books/' . $type));
		}
	}
	
	function request_books($did) {
		if ($did) {
			$view['type'] = 2;
			$view['did'] = $did;
			$view['books'] = $this -> request_model -> __get_books($did, 2);
		}
		else {
			$bid = $this -> memcachedlib -> get('__request_books');
			$bid = implode(',',$bid);
			$view['type'] = 1;
			$view['books'] = $this -> request_model -> __get_books($bid, 1);
		}
		$this->load->view('tmp/' . __FUNCTION__, $view, FALSE);
	}
	
	function request_detail($id) {
		$view['books'] = $this -> request_model -> __get_books($id, 2);
		$view['detail'] = $this -> request_model -> __get_request_books_detail($id);
		if ($view['detail'][0] -> dstatus != 3) redirect(site_url('request'));
		$this->load->view(__FUNCTION__, $view);
	}
	
	function request_delete($id) {
		if ($this -> request_model -> __delete_request($id)) {
			__set_error_msg(array('info' => 'Data berhasil dihapus.'));
			redirect(site_url('request'));
		}
		else {
			__set_error_msg(array('error' => 'Gagal hapus data !!!'));
			redirect(site_url('request'));
		}
	}
}
