<?php
/* -*- tab-width: 2; indent-tabs-mode: nil; c-basic-offset: 2 -*- */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {
	function __construct() {
		parent::__construct();
		$this -> load -> library('pagination_lib');
		$this -> load -> library('branch/branch_lib');
		$this -> load -> library('books/books_lib');
		$this -> load -> model('inventory/inventory_model');
		$this -> load -> model('opname_model');
		$this -> load -> model('books/books_model');
		$this -> load -> library('excel_reader');
	}

	function index() {
		(!$this -> memcachedlib -> get('__opname_import') ? '' : $this -> memcachedlib -> delete('__opname_import'));
		$pager = $this -> pagination_lib -> pagination($this -> opname_model -> __get_opnameinventory($this -> memcachedlib -> sesresult['ubranchid']),3,10,site_url('opname'));
		$view['opname'] = $this -> pagination_lib -> paginate();
		$view['pages'] = $this -> pagination_lib -> pages();
		$this->load->view('opname', $view);
	}
	
	function opname_import_search() {
		$bname = urlencode(base64_encode($this -> input -> post('bname', true)));
		
		if ($bname)
			redirect(site_url('opname/opname_import_search_result/'.$bname));
		else
			redirect(site_url('opname/opname_import'));
	}

	function opname_import_search_result($keyword) {
		$get_books = $this -> memcachedlib -> get('__opname_import');
		if ($get_books) {
			$view['opname'] = $get_books;
			$pager = $this -> pagination_lib -> pagination($this -> opname_model -> __get_inventory_by_book_id_search($this -> memcachedlib -> sesresult['ubranchid'],implode(',',array_keys($get_books)),base64_decode(urldecode($keyword))),3,10,site_url('opname/' . __FUNCTION__));
			$view['books'] = $this -> pagination_lib -> paginate();
			$view['pages'] = $this -> pagination_lib -> pages();
			$view['isSearch'] = true;
			$this->load->view('opname_import', $view);
		}
		else
			redirect(site_url('opname/opname_import'));
	}
	
	function opname_import() {
		$type = (int) $this -> input -> post('type');
		if ($_POST && $type) {
			if ($type == 1) {
				$fname = $_FILES['name']['name'];
				if ($fname) {
					if (substr($fname,-4) != '.xls' && $_FILES['name']['type'] != 'application/vnd.ms-excel') {
						__set_error_msg(array('error' => 'Format file salah, harus .xls !!!'));
						redirect(site_url('opname' . '/' . __FUNCTION__));
					}
					
					$books = array();
					$data = array('error' => false);
					$this -> excel_reader -> setOutputEncoding('CP1251');
					$this -> excel_reader -> read($_FILES['name']['tmp_name']);
					$data = $this->excel_reader->sheets[0];
					for($i=2;$i<=$data['numRows'];++$i) {
						$bk = $this -> books_model -> __get_books_by_code($data['cells'][$i][1]);
						if ($bk) $books[$bk] = $data['cells'][$i][2];
					}
					
					$this -> memcachedlib -> set('__opname_import', $books, 3600,false);
					redirect(site_url('opname' . '/' . __FUNCTION__));
				}
				else {
					__set_error_msg(array('error' => 'File harus isi !!!'));
					redirect(site_url('opname' . '/' . __FUNCTION__));
				}
			}
			else {
				$app = (int) $this -> input -> post('app');
				$issearch = (int) $this -> input -> post('issearch');
				$iid = $this -> input -> post('iid');
				$qty = $this -> input -> post('qty');
				$amin = $this -> input -> post('amin');
				$aplus = $this -> input -> post('aplus');
				$stockin = $this -> input -> post('stockin');
				$stockout = $this -> input -> post('stockout');
				$stockretur = $this -> input -> post('stockretur');
				$stockreject = $this -> input -> post('stockreject');
				$stockbegining = $this -> input -> post('stockbegining');
				$stockfinale = $this -> input -> post('stockfinale');

				if ($app == 1) {
					for($i=0;$i<count($iid);++$i) {
						if ($aplus[$iid[$i]]) $sfinal = $stockfinale[$iid[$i]] + $aplus[$iid[$i]];
						else $sfinal = $stockfinale[$iid[$i]] - $amin[$iid[$i]];

						$arr = array('istock' => $sfinal);
						if ($this -> inventory_model -> __update_inventory($iid[$i], $arr)) {
							$oarr = array('obid' => $this -> memcachedlib -> sesresult['ubranchid'],'oidid' => $iid[$i],'otype' => 1, 'odate' => time(), 'ostockbegining' => $stockbegining[$iid[$i]], 'ostockin' => $stockin[$iid[$i]], 'ostockout' => $stockout[$iid[$i]], 'ostockreject' => $stockreject[$iid[$i]], 'ostockretur' => $stockretur[$iid[$i]], 'ostock' => $stockfinale[$iid[$i]], 'oadjustmin' => $amin[$iid[$i]], 'oadjustplus' => $aplus[$iid[$i]], 'odesc' => 'OPNAME IMPORT ' . date('d/m/Y'));
							$this -> opname_model -> __insert_opname($oarr);
						}
						
						$arr = array();
						$sfinal = 0;
					}
					__set_error_msg(array('info' => 'Stock berhasil di set.'));
					redirect(site_url('opname'));
				}
				else if ($app == 2) {
					$this -> memcachedlib -> delete('__opname_import');
					__set_error_msg(array('info' => 'Opname berhasil di reset.'));
					redirect(site_url('opname/opname_import'));
				}
				else {
					$arr = array();
					$get_books = $this -> memcachedlib -> get('__opname_import');
					if ($issearch == 1) {
						foreach($get_books as $k => $v) {
							if (isset($qty[$k])) $arr[$k] = array_values($qty[$k])[0];
							else $arr[$k] = $v;
						}
					
						$this -> memcachedlib -> set('__opname_import', $arr, 3600,false);
						__set_error_msg(array('info' => 'Stock berhasil di set.'));
						redirect(site_url('opname/opname_import'));
					}
					else {
						foreach($get_books as $k => $v)
							if (isset($qty[$k])) $arr[$k] = array_values($qty[$k])[0];
						
						$this -> memcachedlib -> delete('__opname_import',false);
						$this -> memcachedlib -> set('__opname_import', $arr, 3600,false);
						__set_error_msg(array('info' => 'Stock berhasil di set.'));
						redirect(site_url('opname/opname_import'));
					}
				}
				redirect(site_url('opname' . '/' . __FUNCTION__));
			}
		}
		else {
			$view['isSearch'] = false;
			$view['books'] = array();
			$get_books = $this -> memcachedlib -> get('__opname_import');
			
			if ($get_books) {
				$view['opname'] = $get_books;
				$pager = $this -> pagination_lib -> pagination($this -> opname_model -> __get_inventory_by_book_id($this -> memcachedlib -> sesresult['ubranchid'],implode(',',array_keys($get_books))),3,10000,site_url('opname/' . __FUNCTION__));
				$view['books'] = $this -> pagination_lib -> paginate();
				$view['pages'] = $this -> pagination_lib -> pages();
			}
			
			$this->load->view('opname_import', $view);
		}
	}

	function opname_update($id) {
		if ($_POST) {
			$id = (int) $this -> input -> post('id');
			$branch = (int) $this -> input -> post('branch');
			$desc = $this -> input -> post('desc');

			$adjustmin = (int) $this -> input -> post('adjustmin');
			$adjustplus = (int) $this -> input -> post('adjustplus');
			
			$sbegin2 = (int) $this -> input -> post('sbegin2');
			$sin2 = (int) $this -> input -> post('sin2');
			$sout2 = (int) $this -> input -> post('sout2');
			$sfinal2 = (int) $this -> input -> post('sfinal2');
			$sreject2 = (int) $this -> input -> post('sreject2');
			$sretur2 = (int) $this -> input -> post('sretur2');
			
			if ($id) {
				if ($adjustplus && $adjustmin) {
					__set_error_msg(array('error' => 'Adjust min dan plus salah satu harus di isi !!!'));
					redirect(site_url('opname/opname_update/' . $id));
				}
				else if (!$adjustmin && !$adjustplus) {
					__set_error_msg(array('error' => 'Adjust min dan plus salah satu harus di isi !!!'));
					redirect(site_url('opname/opname_update/' . $id));
				}
				else if (!$desc) {
					__set_error_msg(array('error' => 'Keterangan harus di isi !!!'));
					redirect(site_url('opname/opname_update/' . $id));
				}
				else {
					if ($adjustplus) $sfinal = $sfinal2 + $adjustplus;
					else $sfinal = $sfinal2 - $adjustmin;
					
					$arr = array('istock' => $sfinal);
					if ($this -> inventory_model -> __update_inventory($id, $arr)) {
						$oarr = array('obid' => $branch,'oidid' => $id,'otype' => 1, 'odate' => time(), 'ostockbegining' => $sbegin2, 'ostockin' => $sin2, 'ostockout' => $sout2, 'ostockreject' => $sreject2, 'ostockretur' => $sretur2, 'ostock' => $sfinal2, 'oadjustmin' => $adjustmin, 'oadjustplus' => $adjustplus, 'odesc' => $desc);
						$this -> memcachedlib -> delete('__trans_suggeest_1_' . $this -> memcachedlib -> sesresult['ubranchid']);
						$this -> memcachedlib -> delete('__trans_suggeest_2_' . $this -> memcachedlib -> sesresult['ubranchid']);
						$this -> opname_model -> __insert_opname($oarr);
						__set_error_msg(array('info' => 'Stock berhasil diubah.'));
						redirect(site_url('opname'));
					}
					else {
						__set_error_msg(array('error' => 'Gagal mengubah stock !!!'));
						redirect(site_url('opname'));
					}
				}
			}
			else {
				__set_error_msg(array('error' => 'Kesalahan input data !!!'));
				redirect(site_url('opname'));
			}
		}
		else {
			$view['id'] = $id;
			$view['detail'] = $this -> opname_model -> __get_opnameinventory_detail($id);
			$view['books'] = $this -> books_model -> __get_books_detail($view['detail'][0] -> ibid);
			$this->load->view(__FUNCTION__, $view);
		}
	}
	
	function opname_search_result($keyword) {
		$rw = $this -> books_model -> __get_books_search_inventory(base64_decode(urldecode($keyword)));
		
		if (!$rw) {
			__set_error_msg(array('info' => 'Data tidak ditemukan.'));
			redirect(site_url('opname'));
		}
		
		$res = '';
		foreach($rw as $k => $v) 
			$res .= $v -> bid . ',';
		$res = rtrim($res, ',');
		
		$pger = $this -> pagination_lib -> pagination($this -> opname_model -> __get_search($res, $this -> memcachedlib -> sesresult['ubranchid']),3,10,site_url('opname'));
		$view['opname'] = $this -> pagination_lib -> paginate();
		$view['pages'] = $this -> pagination_lib -> pages();
		$this->load->view('opname', $view);
	}
	
	function opname_search() {
		$bname = urlencode(base64_encode($this -> input -> post('bname', true)));
		
		if ($bname)
			redirect(site_url('opname/opname_search_result/'.$bname));
		else
			redirect(site_url('opname'));
	}
}
