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
		$this -> load -> library('excel_reader');
	}

	function index() {
		(!$this -> memcachedlib -> get('__request_books') ? '' : $this -> memcachedlib -> delete('__request_books'));
		$pager = $this -> pagination_lib -> pagination($this -> request_model -> __get_request($this -> memcachedlib -> sesresult['ubranchid']),3,10,site_url('request'));
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
			$rtype = (int) $this -> input -> post('rtype');
			$status = (int) $this -> input -> post('status');
			
			if (!$bto || !$bfrom || !$title) {
				__set_error_msg(array('error' => 'Cabang Asal, Tujuan dan Judul harus di isi !!!'));
				redirect(site_url('request' . '/' . __FUNCTION__));
			}
			else if (!$rtype) {
				__set_error_msg(array('error' => 'Jenis Request harus di isi !!!'));
				redirect(site_url('request' . '/' . __FUNCTION__));
			}
			else {
				$fname = $_FILES['file']['name'];
				if ($fname) {
					if (substr($fname,-4) != '.xls' && $_FILES['file']['type'] != 'application/vnd.ms-excel') {
						__set_error_msg(array('error' => 'Format file salah, harus .xls !!!'));
						redirect(site_url('request' . '/' . __FUNCTION__));
					}
					
					$data = array('error' => false);
					$this -> excel_reader -> setOutputEncoding('CP1251');
					$this -> excel_reader -> read($_FILES['file']['tmp_name']);
					$data = $this->excel_reader->sheets[0];
					
					for($i=2;$i<=$data['numRows'];++$i) {
						$bk = $this -> books_model -> __get_books_by_code($data['cells'][$i][1]);
						if ($bk) $books[$bk] = $data['cells'][$i][2];
					}
				}
				
				$arr = array('dtype' => $rtype, 'dbfrom' => $bfrom, 'dbto' => $bto, 'ddate' => time(), 'dtitle' => $title, 'ddesc' => $desc, 'dstatus' => $status);
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
			$rtype = (int) $this -> input -> post('rtype');
			
			if ($app == 1) $status = 3;
			else $status = (int) $this -> input -> post('status');
			
			if ($id) {
				if (!$bfrom || !$bto || !$title) {
					__set_error_msg(array('error' => 'Cabang Asal, Tujuan dan Judul harus di isi !!!'));
					redirect(site_url('request' . '/' . __FUNCTION__ . '/' . $id));
				}
				else if (!$rtype) {
					__set_error_msg(array('error' => 'Jenis Request harus di isi !!!'));
					redirect(site_url('request' . '/' . __FUNCTION__ . '/' . $id));
				}
				else {
					$upa = false;
					$fname = $_FILES['file']['name'];
					if ($fname) {
						if (substr($fname,-4) != '.xls' && $_FILES['file']['type'] != 'application/vnd.ms-excel') {
							__set_error_msg(array('error' => 'Format file salah, harus .xls !!!'));
							redirect(site_url('request' . '/' . __FUNCTION__ . '/' . $id));
						}
						
						$data = array('error' => false);
						$this -> excel_reader -> setOutputEncoding('CP1251');
						$this -> excel_reader -> read($_FILES['file']['tmp_name']);
						$data = $this->excel_reader->sheets[0];
						$nbooks = array();
						for($i=2;$i<=$data['numRows'];++$i) {
							$bk = $this -> books_model -> __get_books_by_code($data['cells'][$i][1]);
							if ($bk) $nbooks[$bk] = $data['cells'][$i][2];
						}
						foreach($nbooks as $k => $v)
							$this -> request_model -> __insert_request_books(array('ddrid' => $id,'dbid' => $k,'dqty' => $v,'dstatus' => 1));
						
						$upa = true;
					}
					
					$arr = array('dtype' => $rtype, 'dbfrom' => $bfrom, 'dbto' => $bto, 'ddate' => time(), 'dtitle' => $title, 'ddesc' => $desc, 'dstatus' => $status);
					if ($this -> request_model -> __update_request($id, $arr)) {
						
					foreach($books as $k => $v)
						$this -> request_model -> __update_request_books($k,array('dqty' => $v));
						
						__set_error_msg(array('info' => 'Data berhasil diubah'.($upa == true ? ' dan buku berhasil di import' : '').'.'));
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
		$keyword = $this -> input -> get('keyword');
		if (!$keyword)
			$pager = $this -> pagination_lib -> pagination($this -> books_model -> __get_books(),3,10,site_url('request/request_list_books/'.$type.'/'.(int) $did));
		else
			$pager = $this -> pagination_lib -> pagination($this -> books_model -> __get_books_search($keyword),3,1000,site_url('request/request_list_books/'.$type.'/'.(int) $did));
		
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
				if ($drid) {
					foreach($bid as $k => $v)
						$this -> request_model -> __insert_request_books(array('ddrid' => $drid,'dbid' => $v,'dstatus' => 1));
				}
				else {
					__set_error_msg(array('error' => 'Kesalahan input data!!!'));
					redirect(site_url('request/request_list_books/' . $type));
				}
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
			if (!$bid) return false;
			$bid = implode(',',$bid);
			$view['type'] = 1;
			$view['books'] = $this -> request_model -> __get_books($bid, 1);
		}
		$this->load->view('tmp/' . __FUNCTION__, $view, FALSE);
	}
	
	function request_detail($id) {
		$view['books'] = $this -> request_model -> __get_books($id, 2);
		$view['detail'] = $this -> request_model -> __get_request_books_detail($id);
		$view['id'] = $id;
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
	
	function get_suggestion() {
		header('Content-type: application/javascript');
		$hint = array();
		$a = array();
		$q = urldecode($_SERVER['QUERY_STRING']);
		if (strlen($q) < 2) return false;
		$q = str_replace('-',' ',$q);
		
		$get_suggestion = $this -> memcachedlib -> get('__request_suggestion', true);
		if (!$get_suggestion) {
			$arr = $this -> request_model -> __get_suggestion();
			$this -> memcachedlib -> set('__request_suggestion', $arr, 1,true);
			$get_suggestion = $this -> memcachedlib -> get('__request_suggestion', true);
		}
		
		foreach($get_suggestion as $k => $v) {
			$a[] = array('name' => 'R'.str_pad($v['did'], 4, "0", STR_PAD_LEFT), 'id' => $v['did']);
			$a[] = array('name' => $v['dtitle'], 'id' => $v['did']);
		}
		
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
	
	function request_search() {
		$keyword = urlencode(base64_encode($this -> input -> post('keyword', true)));
		
		if ($keyword)
			redirect(site_url('request/request_search_result/'.$keyword));
		else
			redirect(site_url('request'));
	}
	
	function request_search_result($keyword) {
		$keyword = addslashes(base64_decode(urldecode($keyword)));
		$pager = $this -> pagination_lib -> pagination($this -> request_model -> __get_request_search($this -> memcachedlib -> sesresult['ubranchid'],urldecode($keyword)),3,10,site_url('request/request_search_result/' . $keyword));
		$view['request'] = $this -> pagination_lib -> paginate();
		$view['pages'] = $this -> pagination_lib -> pages();
		$this -> load -> view('request', $view);
	}
	
	function export($type,$id) {
		if ($type == 'excel') {
			ini_set('memory_limit', '-1');
			$this -> load -> library('excel');
			$data = $this -> request_model -> __export($this -> memcachedlib -> sesresult['ubranchid']);
			$arr = array();
			
			foreach($data as $K => $v)
				$arr[] = array('R'.str_pad($v -> did, 4, "0", STR_PAD_LEFT),__get_date($v -> ddate), $v -> fbname, $v -> tbname, $v -> dtitle, $v -> ddesc, $v -> total_books, ($v -> dstatus == 3 ? 'Approved' : __get_status($v -> dstatus,1)));
			
			$data = array('header' => array('Request No.', 'Date', 'Branch From','Branch To','Title','Description','Total Books','Status'), 'data' => $arr);

			$this -> excel -> sEncoding = 'UTF-8';
			$this -> excel -> bConvertTypes = false;
			$this -> excel -> sWorksheetTitle = 'Distribution Request - PT. Niaga Swadaya';
			
			$this -> excel -> addArray($data);
			$this -> excel -> generateXML('dist-request-' . date('Ymd'));
		}
		else if ($type == 'excel_detail') {
			$filename = "request_detail-".$id.".xls";
			header('Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			header('Content-Disposition: attachment; filename='.$filename);
			header("Cache-Control: max-age=0");
			$view['books'] = $this -> request_model -> __get_books($id, 2);
			$view['detail'] = $this -> request_model -> __get_request_books_detail($id);
			$view['id'] = $id;
			if ($view['detail'][0] -> dstatus != 3) redirect(site_url('request'));
			$this->load->view('print/dist_request', $view, false);
		}
	}
}
