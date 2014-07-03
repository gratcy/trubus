<?php
/* -*- tab-width: 2; indent-tabs-mode: nil; c-basic-offset: 2 -*- */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {
	function __construct() {
		parent::__construct();
		$this -> load -> library('pagination_lib');
		$this -> load -> library('branch/branch_lib');
		$this -> load -> library('books/books_lib');
		$this -> load -> model('customer/customer_model');
		$this -> load -> model('inventory_customer/inventory_customer_model');
		$this -> load -> model('opnamecustomer_model');
	}

	function index() {
		$pager = $this -> pagination_lib -> pagination($this -> opnamecustomer_model -> __get_customer(1),3,10,site_url('opnamecustomer'));
		$view['opnamecustomer'] = $this -> pagination_lib -> paginate();
		$view['pages'] = $this -> pagination_lib -> pages();
		$this->load->view('opnamecustomer', $view);
	}

	function opnamecustomer_detail($cid) {
		$pager = $this -> pagination_lib -> pagination($this -> opnamecustomer_model -> __get_opname_inventory($cid),3,10,site_url('opnamecustomer_detail'));
		$view['opname'] = $this -> pagination_lib -> paginate();
		$view['pages'] = $this -> pagination_lib -> pages();
		$this->load->view('opnamecustomer_detail', $view);
	}

	function opnamecustomer_update($id) {
		if ($_POST) {
			$id = (int) $this -> input -> post('id');
			$sbegin = (int) $this -> input -> post('sbegin');
			$sin = (int) $this -> input -> post('sin');
			$sout = (int) $this -> input -> post('sout');
			$sfinal = (int) $this -> input -> post('sfinal');
			$sreject = (int) $this -> input -> post('sreject');
			
			$sbegin2 = (int) $this -> input -> post('sbegin2');
			$sin2 = (int) $this -> input -> post('sin2');
			$sout2 = (int) $this -> input -> post('sout2');
			$sfinal2 = (int) $this -> input -> post('sfinal2');
			$sreject2 = (int) $this -> input -> post('sreject2');
			
			if ($id) {
				$arr = array('itype' => 1, 'istockbegining' => $sbegin, 'istockin' => $sin, 'istockout' => $sout, 'istockreject' => $sreject, 'istock' => $sfinal);
				if ($this -> inventory_model -> __update_inventory($id, $arr)) {
					$oarr = array('oidid' => $id,'otype' => 1, 'ostockbegining' => $sbegin2, 'ostockin' => $sin2, 'ostockout' => $sout2, 'ostockreject' => $sreject2, 'ostock' => $sfinal2);
					$this -> opnamecustomer_model -> __insert_opnamecustomer($oarr);
					
					__set_error_msg(array('info' => 'Stock berhasil diubah.'));
					redirect(site_url('opnamecustomer'));
				}
				else {
					__set_error_msg(array('error' => 'Gagal mengubah stock !!!'));
					redirect(site_url('opnamecustomer'));
				}
			}
			else {
				__set_error_msg(array('error' => 'Kesalahan input data !!!'));
				redirect(site_url('opnamecustomer'));
			}
		}
		else {
			$view['id'] = $id;
			$view['detail'] = $this -> opnamecustomer_model -> __get_opname_inventory_customer_detail($id);
			$view['books'] = $this -> books_lib -> __get_books($view['detail'][0] -> ibid);
			$view['branch'] = $this -> branch_lib -> __get_branch($view['detail'][0] -> ibcid);
			$this->load->view(__FUNCTION__, $view);
		}
	}
}
