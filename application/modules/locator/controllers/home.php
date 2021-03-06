<?php
/* -*- tab-width: 2; indent-tabs-mode: nil; c-basic-offset: 2 -*- */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {
	function __construct() {
		parent::__construct();
		$this -> load -> library('pagination_lib');
		$this -> load -> model('locator_model');
		$this -> load -> model('books/books_model');
		$this -> load -> library('branch/branch_lib');
	}

	function index() {
		($this -> memcachedlib -> get('__locator_books_add') ? $this -> memcachedlib -> delete('__locator_books_add') : false);
		$pager = $this -> pagination_lib -> pagination($this -> locator_model -> __get_locator($this -> memcachedlib -> sesresult['ubranchid']),3,10,site_url('locator'));
		$view['locator'] = $this -> pagination_lib -> paginate();
		$view['pages'] = $this -> pagination_lib -> pages();
		$this->load->view('locator', $view);
	}
	
	function locator_add() {
		if ($_POST) {
			$branch = (int) $this -> input -> post('branch');
			$placed = $this -> input -> post('placed', TRUE);
			$desc = $this -> input -> post('desc', TRUE);
			$bid = $this -> input -> post('bid');
			$status = (int) $this -> input -> post('status');
			
			if (!$placed || !$branch) {
				__set_error_msg(array('error' => 'Data yang anda masukkan tidak lengkap !!!'));
				redirect(site_url('locator' . '/' . __FUNCTION__));
			}
			else {
				$arr = array('lbid' => $branch,'lplaced' => $placed, 'ldesc' => $desc, 'lstatus' => $status);
				if ($this -> locator_model -> __insert_locator($arr)) {
					$lastID = $this -> db -> insert_id();
					
					for($i=0;$i<count($bid);++$i) $this -> locator_model -> __insert_locator_books(array('llid' => $lastID, 'lbid' => $bid[$i], 'lstatus' => 1));
					
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
		header('Content-type: application/javascript');
		$hint = array();
		$a = array();
		$q = urldecode($_SERVER['QUERY_STRING']);
		if (strlen($q) < 3) return false;
		$get_books = $this -> memcachedlib -> get('__books_suggestion', true);
		
		if (!$get_books) {
			$books = $this -> books_model -> __get_suggestion();
			$this -> memcachedlib -> set('__books_suggestion', $books, $_SERVER['REQUEST_TIME']+60*60*24*100,true);
			$get_books = $this -> memcachedlib -> get('__books_suggestion', true);
		}
		
		$get_rack = $this -> memcachedlib -> get('__rack_suggestion_' . $this -> memcachedlib -> sesresult['ubranchid'], true);
		if (!$get_rack) {
			$rack = $this -> locator_model -> __get_suggestion($this -> memcachedlib -> sesresult['ubranchid']);
			$this -> memcachedlib -> set('__rack_suggestion_' . $this -> memcachedlib -> sesresult['ubranchid'], $rack, $_SERVER['REQUEST_TIME']+60*60*24*100,true);
			$get_rack = $this -> memcachedlib -> get('__rack_suggestion_' . $this -> memcachedlib -> sesresult['ubranchid'], true);
		}
		
		$data = array_merge($get_rack,$get_books);
		foreach($data as $k => $v) $a[] = array('name' => $v['name'], 'id' => (isset($v['lid']) ? $v['lid'] : $v['bid']));
		
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
					$hint[] = array('d' => $i, 'i' => $a[$i]['id'], 'n' => $a[$i]['name']);
					$is_suggestion_added = true;
				}
				for ($j=0;$j<$num_words && !$is_suggestion_added;$j++) {
					if(strtolower($q)==strtolower(substr($a[$i]['name'],$pos[$j],strlen($q)))){
						$hint[] = array('d' => $i, 'i' => $a[$i]['id'], 'n' => $a[$i]['name']);
						$is_suggestion_added = true;                                        
					}
				}
			}
		}
		
		echo json_encode($hint);
	}
	
	function locator_search() {
		$keyword = urlencode(base64_encode($this -> input -> post('keyword', true)));
		if ($keyword)
			redirect(site_url('locator/locator_search_result/'.$keyword));
		else
			redirect(site_url('locator'));
	}
	
	function locator_search_result($keyword) {
		$dkeyword = $keyword;
		$keyword = trim(html_entity_decode(strtolower(addslashes(base64_decode(urldecode($keyword))))));
		$keyword = strtoupper($keyword);
		$ids = $this -> locator_model -> __get_locator_ids($keyword);
		
		$view['locator'] = array();
		$view['pages'] = '';
		if ($ids) {
			$res = '';
			foreach($ids as $k => $v)
				$res .= $v -> lid . ',';
			$res = rtrim($res,',');

			$pager = $this -> pagination_lib -> pagination($this -> locator_model -> __get_locator_search($this -> memcachedlib -> sesresult['ubranchid'],$res),3,10,site_url('locator/locator_search_result/' . $dkeyword));
			$view['locator'] = $this -> pagination_lib -> paginate();
			$view['pages'] = $this -> pagination_lib -> pages();
		}
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
	
	function books_add($type) {
		$id = (int) $this -> input -> get('id');
		if ($_POST) {
			$bid = $this -> input -> post('bid');
			if ($type == 1) {
				$ids = $this -> memcachedlib -> get('__locator_books_add');
				if ($ids) $bid = array_unique(array_merge($bid, $ids));
				$this -> memcachedlib -> set('__locator_books_add', $bid, 3600);
			}
			else {
				for($i=0;$i<count($bid);++$i) {
					if (!$this -> locator_model -> __check_locator_books($id, $bid[$i])) {
						$this -> locator_model -> __insert_locator_books(array('llid' => $id, 'lbid' => $bid[$i], 'lstatus' => 1));
					}
					else {
						__set_error_msg(array('error' => 'Buku sudah terdaftar !!!'));
						redirect(site_url('locator/books_add/' . $type . '?id=' . $id));
					}
				}
			}
			__set_error_msg(array('info' => 'Buku berhasil ditambahkan.'));
			redirect(site_url('locator/books_add/' . $type . '?id=' . $id));
		}
		else {
			$pager = $this -> pagination_lib -> pagination($this -> books_model -> __get_books_locator(''),3,10,site_url('locator/books_add/' . $type));
			$view['books'] = $this -> pagination_lib -> paginate();
			$view['pages'] = $this -> pagination_lib -> pages();
			$view['id'] = $id;
			$view['type'] = $type;
			$this -> load -> view('box/books_add', $view, false);
		}
	}
	
	function books_delete($type) {
		$bid = (int) $this -> input -> post('bid');
		$lid = (int) $this -> input -> post('lid');
		if ($bid) {
			if ($type == 1) {
				$ids = $this -> memcachedlib -> get('__locator_books_add');
				$res = array();
				for($i=0;$i<count($ids);++$i)
					if ($ids[$i] <> $bid) $res[] = $ids[$i];
				$this -> memcachedlib -> set('__locator_books_add', $res, 3600);
			}
			else {
				$this -> locator_model -> __delete_locator_books($lid, $bid);
			}
		}
	}
	
	function books_tmp($type) {
		$id = (int) $this -> input -> get('id');
		$ids = array();
		$view['books'] = array();
		
		if ($type == 1) {
			$ids = $this -> memcachedlib -> get('__locator_books_add');
		}
		else {
			$arr = $this -> locator_model -> __get_locator_books($id);
			foreach($arr as $k => $v) $ids[] = $v -> lbid;
		}
		
		$view['id'] = $id;
		$view['type'] = $type;
		
		if ($ids) {
			$view['books'] = $this -> books_model -> __get_books_locator(implode(',', $ids));
			$this -> load -> view('box/books_tmp', $view, false);
		}
	}
	
	function books_search() {
		$keyword = urlencode(base64_encode($this -> input -> post('keyword', true)));
		$type = (int) $this -> input -> post('type');
		$lid =  (int) $this -> input -> post('lid', true);
		
		if ($keyword)
			redirect(site_url('locator/books_search_result/'.$type.'/'.$keyword . '/?id=' . $lid));
		else
			redirect(site_url('locator'));
	}
	
	function books_search_result($type, $keyword) {
		$id = (int) $this -> input -> get('id');
		$dkeyword = $keyword;
		$keyword = html_entity_decode(strtolower(addslashes(base64_decode(urldecode($keyword)))));
		$keyword = strtoupper($keyword);
		$pager = $this -> pagination_lib -> pagination($this -> books_model -> __get_books_locator_search($keyword),3,10,site_url('locator/books_search_result/' . $type . '/' . $dkeyword));
		$view['books'] = $this -> pagination_lib -> paginate();
		$view['pages'] = $this -> pagination_lib -> pages();
		$view['id'] = $id;
		$view['type'] = $type;
		$this -> load -> view('box/books_add', $view, false);
	}
}
