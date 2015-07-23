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
	}

	function index() {
		$pager = $this -> pagination_lib -> pagination($this -> opname_model -> __get_opnameinventory($this -> memcachedlib -> sesresult['ubranchid']),3,10,site_url('opname'));
		$view['opname'] = $this -> pagination_lib -> paginate();
		$view['pages'] = $this -> pagination_lib -> pages();
		$this->load->view('opname', $view);
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
					
					$arr = array('itype' => 1, 'istock' => $sfinal);
					if ($this -> inventory_model -> __update_inventory($id, $arr)) {
						$oarr = array('obid' => $branch,'oidid' => $id,'otype' => 1, 'odate' => time(), 'ostockbegining' => $sbegin2, 'ostockin' => $sin2, 'ostockout' => $sout2, 'ostockreject' => $sreject2, 'ostockretur' => $sretur2, 'ostock' => $sfinal2, 'oadjustmin' => $adjustmin, 'oadjustplus' => $adjustplus, 'odesc' => $desc);
						$this -> memcachedlib -> delete('__trans_suggeest_1_' . $this -> memcachedlib -> sesresult['ubranchid']);
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
		$pger = $this -> pagination_lib -> pagination($this -> opname_model -> __get_search($rw[0] -> bid, $this -> memcachedlib -> sesresult['ubranchid']),3,10,site_url('opname'));
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
