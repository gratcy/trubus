<?php
/* -*- tab-width: 2; indent-tabs-mode: nil; c-basic-offset: 2 -*- */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {
	function __construct() {
		parent::__construct();
		$this -> load -> library('pagination_lib');
		$this -> load -> library('branch/branch_lib');
		$this -> load -> library('request/request_lib');
		$this -> load -> library('publisher/publisher_lib');
		$this -> load -> model('request/request_model');
		$this -> load -> model('books/books_model');
		$this -> load -> model('receiving_model');
	}

	function index() {
		(!$this -> memcachedlib -> get('__receiving_books') ? '' : $this -> memcachedlib -> delete('__receiving_books'));
		$pager = $this -> pagination_lib -> pagination($this -> receiving_model -> __get_receiving($this -> memcachedlib -> sesresult['ubranchid']),3,10,site_url('receiving'));
		$view['receiving'] = $this -> pagination_lib -> paginate();
		$view['pages'] = $this -> pagination_lib -> pages();
		$this->load->view('receiving', $view);
	}
	
	function receiving_add() {
		if ($_POST) {
			$id = (int) $this -> input -> post('id');
			$rid = (int) $this -> input -> post('rid');
			$desc = $this -> input -> post('desc', TRUE);
			$docno = $this -> input -> post('docno', TRUE);
			$books = $this -> input -> post('books');
			$waktu = $this -> input -> post('waktu', TRUE);
			$branch = (int) $this -> input -> post('branch');
			$rtype = (int) $this -> input -> post('rtype');
			$status = (int) $this -> input -> post('status');

			if (!$docno || !$rid || !$branch) {
				__set_error_msg(array('error' => 'Data yang anda masukkan tidak lengkap !!!'));
				redirect(site_url('receiving' . '/' . __FUNCTION__));
			}
			else {
				$arr = array('rbid' => $branch,'rtype' => $rtype, 'rdocno' => $docno, 'riid' => $rid, 'rdate' => strtotime($waktu), 'rdesc' => $desc, 'rstatus' => $status);
				if ($this -> receiving_model -> __insert_receiving($arr)) {
					$rrid = $this -> db -> insert_id();
					foreach($books as $k => $v)
						$this -> receiving_model -> __insert_receiving_books(array('rrid' => $rrid,'rbcid' => $this -> memcachedlib -> sesresult['ubranchid'],'rbid' => $k,'rqty' => $v,'rstatus' => 1));
						
					__set_error_msg(array('info' => 'Data berhasil ditambahkan.'));
					redirect(site_url('receiving'));
				}
				else {
					__set_error_msg(array('error' => 'Gagal menambahkan data !!!'));
					redirect(site_url('receiving'));
				}
			}
		}
		else {
			$view['branch'] = $this -> branch_lib -> __get_branch();
			$this->load->view(__FUNCTION__, $view);
		}
	}
	
	function receiving_update($id) {
		if ($_POST) {
			$id = (int) $this -> input -> post('id');
			$rid = (int) $this -> input -> post('rid');
			$desc = $this -> input -> post('desc', TRUE);
			$docno = $this -> input -> post('docno', TRUE);
			$books = $this -> input -> post('books');
			$waktu = $this -> input -> post('waktu', TRUE);
			$rtype = (int) $this -> input -> post('rtype');
			$app = (int) $this -> input -> post('app');
			
			if ($app == 1) $status = 3;
			else $status = (int) $this -> input -> post('status');
			
			if ($id) {
				if (!$docno || !$rid) {
					__set_error_msg(array('error' => 'Data yang anda masukkan tidak lengkap !!!'));
					redirect(site_url('receiving' . '/' . __FUNCTION__ . '/' . $id));
				}
				else {
					$arr = array('rtype' => $rtype, 'rdocno' => $docno, 'riid' => $rid, 'rdate' => strtotime($waktu), 'rdesc' => $desc, 'rstatus' => $status);
					if ($this -> receiving_model -> __update_receiving($id, $arr)) {
						
					foreach($books as $k => $v) {
						$this -> receiving_model -> __update_receiving_books($k,array('rqty' => $v));
						
						if ($app == 1) {
							$iv = $this -> receiving_model -> __get_inventory_detail($k,$this -> memcachedlib -> sesresult['ubranchid']);
							$this -> receiving_model -> __update_inventory($k,$this -> memcachedlib -> sesresult['ubranchid'],array('istockin' => ($iv[0] -> istockin+$v),'istock' => ($iv[0] -> istock + $v)));
						}
					}
						__set_error_msg(array('info' => 'Data berhasil diubah.'));
						redirect(site_url('receiving'));
					}
					else {
						__set_error_msg(array('error' => 'Gagal mengubah data !!!'));
						redirect(site_url('receiving'));
					}
				}
			}
			else {
				__set_error_msg(array('error' => 'Kesalahan input data !!!'));
				redirect(site_url('receiving'));
			}
		}
		else {
			$view['id'] = $id;
			$view['detail'] = $this -> receiving_model -> __get_receiving_detail($id);
			$view['branch'] = $this -> branch_lib -> __get_branch($view['detail'][0] -> rbid);
			$this->load->view(__FUNCTION__, $view);
		}
	}
	
	function receiving_types($type) {
		$res = '<select name="rid" class="form-control" id="rid">';
		if ($type == 1)
			$res .= $this -> request_lib -> __get_request();
		else
			$res .= $this -> publisher_lib -> __get_publisher();
		$res .= '</select>';
		echo $res;
	}
	
	function receiving_books($did) {
		if ($did) {
			$view['type'] = 2;
			$view['did'] = $did;
			$view['books'] = $this -> receiving_model -> __get_books($did, 2);
		}
		else {
			$bid = $this -> memcachedlib -> get('__receiving_books');
			if (!$bid) return false;
			$bid = implode(',',$bid);
			if ($bid) {
				$view['type'] = 1;
				$view['books'] = $this -> receiving_model -> __get_books($bid, 1);
			}
		}
		$this->load->view('tmp/' . __FUNCTION__, $view, FALSE);
	}
	
	function receiving_books_delete($type) {
		$bid = (int) $this -> input -> post('bid');
		$did = (int) $this -> input -> post('did');
		
		if ($bid) {
			if ($type == 1) {
				$books = $this -> memcachedlib -> get('__receiving_books');
				$arr = array();
				foreach($books as $v)
					if ($v <> $bid) $arr[] = $v;
				$this -> memcachedlib -> set('__receiving_books', $arr, 900);
			}
			else
				if ($did) $this -> receiving_model -> __delete_receiving_books($did,$bid);
		}
	}
	
	function receiving_books_add($type) {
		$bid = $this -> input -> post('bid');
		if (!$bid) {
			__set_error_msg(array('error' => 'Buku harus dipilih !!!'));
			redirect(site_url('receiving/receiving_list_books/' . $type));
		}
		else {
			if ($type == 1) {
				$DidN = (!$this -> memcachedlib -> get('__receiving_books') ? array() : $this -> memcachedlib -> get('__receiving_books'));
				$this -> memcachedlib -> set('__receiving_books', array_unique(array_merge($DidN,$bid)), 900);
			}
			else {
				$drid = (int) $this -> input -> post('did');
				foreach($bid as $k => $v)
					$this -> receiving_model -> __insert_receiving_books(array('rrid' => $drid,'rbid' => $v, 'rqty' => 0, 'rstatus' => 1));
			}

			__set_error_msg(array('info' => 'Buku berhasil ditambahkan.'));
			redirect(site_url('receiving/receiving_list_books/' . $type));
		}
	}
	
	function receiving_list_books($type, $did) {
		$pager = $this -> pagination_lib -> pagination($this -> books_model -> __get_books(),3,10,site_url('receiving'));
		$view['books'] = $this -> pagination_lib -> paginate();
		$view['pages'] = $this -> pagination_lib -> pages();
		$view['type'] = $type;
		$view['did'] = $did;
		$this->load->view('tmp/' . __FUNCTION__, $view, FALSE);
	}
	
	function receiving_detail($id) {
		$view['books'] = $this -> receiving_model -> __get_books($id, 2);
		$view['detail'] = $this -> receiving_model -> __get_receiving_detail($id);
		if ($view['detail'][0] -> rstatus != 3) redirect(site_url('receiving'));
		$this->load->view(__FUNCTION__, $view);
	}
	
	function receiving_delete($id) {
		if ($this -> receiving_model -> __delete_receiving($id)) {
			__set_error_msg(array('info' => 'Data berhasil dihapus.'));
			redirect(site_url('receiving'));
		}
		else {
			__set_error_msg(array('error' => 'Gagal hapus data !!!'));
			redirect(site_url('receiving'));
		}
	}
}
