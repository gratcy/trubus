<?php
/* -*- tab-width: 2; indent-tabs-mode: nil; c-basic-offset: 2 -*- */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {
	function __construct() {
		parent::__construct();
		$this -> load -> library('pagination_lib');
		$this -> load -> library('branch/branch_lib');
		$this -> load -> library('books/books_lib');
		$this -> load -> model('inventory_model');
		$this -> load -> model('books/books_model');
	}

	function index() {
		$pager = $this -> pagination_lib -> pagination($this -> inventory_model -> __get_inventory($this -> memcachedlib -> sesresult['ubranchid']),3,10,site_url('inventory'));
		$view['inventory'] = $this -> pagination_lib -> paginate();
		$view['pages'] = $this -> pagination_lib -> pages();
		$this->load->view('inventory', $view);
	}
	
	function export_excel() {
		@ini_set('memory_limit', '-1');
		$this -> load -> library('excel');
		$data = $this -> inventory_model -> __get_inventory_export($this -> memcachedlib -> sesresult['ubranchid']);

		$arr = array();
		foreach($data as $K => $v) {
			$aplus = __get_adjustment($v -> iid, $this -> memcachedlib -> sesresult['ubranchid'], 1, 1);
			$amin = __get_adjustment($v -> iid, $this -> memcachedlib -> sesresult['ubranchid'], 2, 1);
			$sprocess = __get_stock_process($this -> memcachedlib -> sesresult['ubranchid'], $v -> ibid, 1);

			$sleft = ($v -> istock - $sprocess);
			
			if ($this -> memcachedlib -> sesresult['ubranchid'] == 1)
				$arr[] = array($v -> bcode, $v -> btitle, $v -> bprice, $v -> istockbegining, $v -> istockin, $v -> istockout, $aplus, $amin, $v -> istock, $sprocess, $v -> ishadow, $sleft);
			else
				$arr[] = array($v -> bcode, $v -> btitle, $v -> bprice, $v -> istockbegining, $v -> istockin, $v -> istockout, $aplus, $amin, $v -> istock, $sprocess, $sleft);
		}
		
		if ($this -> memcachedlib -> sesresult['ubranchid'] == 1)
			$data = array('header' => array('Code', 'Title', 'Price','Stock Begining','Stock In','Stock Out','Adjusment (+)', 'Adjusment (-)','Stock Final', 'Stock Process','Stock Shadow', 'Stock Left'), 'data' => $arr);
		else
			$data = array('header' => array('Code', 'Title', 'Price','Stock Begining','Stock In','Stock Out','Adjusment (+)', 'Adjusment (-)','Stock Final', 'Stock Process', 'Stock Left'), 'data' => $arr);

		$this -> excel -> sEncoding = 'UTF-8';
		$this -> excel -> bConvertTypes = false;
		$this -> excel -> sWorksheetTitle = 'Inventory Buku - PT. Niaga Swadaya';
		
		$this -> excel -> addArray($data);
		$this -> excel -> generateXML('inventory');
	}
	
	function inventory_add() {
		if ($_POST) {
			$book = (int) $this -> input -> post('book');
			$branch = (int) $this -> input -> post('branch');
			$sbegin = (int) $this -> input -> post('sbegin');
			$sin = (int) $this -> input -> post('sin');
			$sout = (int) $this -> input -> post('sout');
			$sfinal = (int) $this -> input -> post('sfinal');
			$sreject = (int) $this -> input -> post('sreject');
			$sretur = (int) $this -> input -> post('sretur');
			$status = (int) $this -> input -> post('status');
			
			if (!$book || !$branch) {
				__set_error_msg(array('error' => 'Buku dan Cabang harus di isi !!!'));
				redirect(site_url('inventory' . '/' . __FUNCTION__));
			}
			else {
				$arr = array('itype' => 1, 'ibid' => $book, 'ibcid' => $branch, 'istockbegining' => $sbegin, 'istockin' => $sin, 'istockout' => $sout, 'istockreject' => $sreject, 'istockretur' => $sretur, 'istock' => $sfinal, 'istatus' => $status);
				if ($this -> inventory_model -> __insert_inventory($arr)) {
					__set_error_msg(array('info' => 'Data berhasil ditambahkan.'));
					redirect(site_url('inventory'));
				}
				else {
					__set_error_msg(array('error' => 'Gagal menambahkan data !!!'));
					redirect(site_url('inventory'));
				}
			}
		}
		else {
			$view['branch'] = $this -> branch_lib -> __get_branch();
			$view['books'] = $this -> books_lib -> __get_books();
			$this->load->view(__FUNCTION__, $view);
		}
	}
	
	function inventory_update($id) {
		if ($_POST) {
			$id = (int) $this -> input -> post('id');
			$book = (int) $this -> input -> post('book');
			$branch = (int) $this -> input -> post('branch');
			$sbegin = (int) $this -> input -> post('sbegin');
			$sin = (int) $this -> input -> post('sin');
			$sout = (int) $this -> input -> post('sout');
			$sfinal = (int) $this -> input -> post('sfinal');
			$sreject = (int) $this -> input -> post('sreject');
			$sretur = (int) $this -> input -> post('sretur');
			$status = 1;
			
			if ($id) {
				if (!$book || !$branch) {
					__set_error_msg(array('error' => 'Buku dan Cabang harus di isi !!!'));
					redirect(site_url('inventory' . '/' . __FUNCTION__ . '/' . $id));
				}
				else {
					$arr = array('itype' => 1, 'ibcid' => $branch, 'istockbegining' => $sbegin, 'istockin' => $sin, 'istockout' => $sout, 'istockreject' => $sreject, 'istockretur' => $sretur, 'istock' => $sfinal, 'istatus' => $status);
					if ($this -> inventory_model -> __update_inventory($id, $arr)) {	
						__set_error_msg(array('info' => 'Data berhasil diubah.'));
						redirect(site_url('inventory'));
					}
					else {
						__set_error_msg(array('error' => 'Gagal mengubah data !!!'));
						redirect(site_url('inventory'));
					}
				}
			}
			else {
				__set_error_msg(array('error' => 'Kesalahan input data !!!'));
				redirect(site_url('inventory'));
			}
		}
		else {
			$view['id'] = $id;
			$view['detail'] = $this -> inventory_model -> __get_inventory_detail($id);
			$view['books'] = $this -> books_lib -> __get_books($view['detail'][0] -> ibid);
			$view['branch'] = $this -> branch_lib -> __get_branch($view['detail'][0] -> ibcid);
			$this->load->view(__FUNCTION__, $view);
		}
	}
	
	function card_stock($id,$cid) {
		$this -> load -> model('receiving/receiving_model');
		$this -> load -> model('transfer/transfer_model');
		$this -> load -> model('opname/opname_model');
		$view['id'] = $id;
		$view['cid'] = $cid;
		$res = array();
		$receiving = $this -> receiving_model -> __get_receiving_by_books($cid,$id);
		
		foreach($receiving as $k => $v) {
				if ($v -> rtype == 1) {
					$v -> cname = __get_receiving_name($v -> riid, $v -> rtype);
				}
				$res[] = $v;
		}
		
		$retur = $this -> transfer_model -> __get_transfer_out($cid, $id, 2, true);
		$trans = $this -> inventory_model -> __get_inventory_detailx($id,$cid,true);
		$transPemb = $this -> inventory_model -> __get_inventory_detailx($id,$cid,true, true);
		$opname = $this -> opname_model -> __get_stock_adjustment_hist($id,$cid);
		$pptransfer = $this -> transfer_model -> __get_transfer_out($cid, $id, 3, false);

		$ppatransfer = $this -> transfer_model -> __get_transfer_out($cid, $id, 5, true);

		//$ptransfer = $this -> transfer_model -> __get_transfer_out($cid, $id, 1, false);
		$pretur = $this -> transfer_model -> __get_transfer_out($cid, $id, 2, false);
		$ptrans = $this -> inventory_model -> __get_inventory_detailx($id,$cid,false);
		$ptransPemb = $this -> inventory_model -> __get_inventory_detailx($id,$cid,false,true);
		$ptransfer = array();

		$data = array_merge($receiving,$trans,$retur,$opname,$ptrans,$ptransfer,$pretur,$pptransfer,$ppatransfer,$transPemb,$ptransPemb);
		usort($data, "__sortArrayByDate");
		//~ var_dump($ptransPemb);die;
		$view['detail'] = $data;
		$view['stock'] = $this -> inventory_model -> __get_stock_begining($id,$cid);
		$view['book'] = $this -> inventory_model -> __get_book($id);
		$this->load->view('card_stock', $view, false);
	}

	function inventory_search_result($keyword) {
		$rw = $this -> books_model -> __get_books_search_inventory(base64_decode(urldecode($keyword)));
		$bid = '';
		foreach($rw as $k => $v) $bid .= $v -> bid.',';
		$bid = rtrim($bid,',');
		
		if (!$rw) {
			__set_error_msg(array('info' => 'Data tidak ditemukan.'));
			redirect(site_url('inventory'));
		}
		$pger = $this -> pagination_lib -> pagination($this -> inventory_model -> __get_search($bid, $this -> memcachedlib -> sesresult['ubranchid']),3,10,site_url('inventory/inventory_search_result/' . $keyword));
		$view['inventory'] = $this -> pagination_lib -> paginate();
		$view['pages'] = $this -> pagination_lib -> pages();
		$this->load->view('inventory', $view);
	}
	
	function inventory_search() {
		$bname = urlencode(base64_encode($this -> input -> post('bname', true)));
		
		if ($bname)
			redirect(site_url('inventory/inventory_search_result/'.$bname));
		else
			redirect(site_url('inventory'));
	}
	
	function stokx() {
		$view['hostname']=$this->db->hostname;
		$view['username']=$this->db->username;
		$view['password']=$this->db->password;
		$view['database']=$this->db->database;
		$this->load->view('stok_buku',$view,FALSE);
	}
	
	function inventory_delete($id) {
		if ($this -> inventory_model -> __delete_inventory($id)) {
			__set_error_msg(array('info' => 'Data berhasil dihapus.'));
			redirect(site_url('inventory'));
		}
		else {
			__set_error_msg(array('error' => 'Gagal hapus data !!!'));
			redirect(site_url('inventory'));
		}
	}
}
