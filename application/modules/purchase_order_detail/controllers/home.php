<?php
/* -*- tab-width: 2; indent-tabs-mode: nil; c-basic-offset: 2 -*- */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {
	function __construct() {
		parent::__construct();
		$this -> load -> library('pagination_lib');
		$this -> load -> library('branch/branch_lib');
		$this -> load -> library('sales/sales_lib');
		$this -> load -> library('products/products_lib');
		$this -> load -> model('purchase_order/purchase_order_model');
		$this -> load -> model('purchase_order_detail_model');
	}

	function index() {
		$pager = $this -> pagination_lib -> pagination($this -> purchase_order_detail_model -> __get_purchase_order_detail(),3,10,site_url('purchase_order_detail'));
		$view['purchase_order_detail'] = $this -> pagination_lib -> paginate();
		$view['pages'] = $this -> pagination_lib -> pages();
		$this->load->view('purchase_order_detail', $view);
	}
	
	function purchase_order_detail_add($id) {
		if ($_POST) {
		
			$pppid = $this -> input -> post('pppid', TRUE);
			$pcurrency = $this -> input -> post('pcurrency', TRUE);
			$pqty = $this -> input -> post('pqty', TRUE);
			$pharga = $this -> input -> post('pharga', TRUE);
			$pdisc = $this -> input -> post('pdisc', TRUE);
			$pketerangan = $this -> input -> post('pketerangan', TRUE);
			$pstatus = (int)$this ->input -> post('pstatus', TRUE);
			$id = (int) $this -> input -> post('id');
		
			// print_r($_POST);die;
			
			// if (!$name || !$npwp || !$addr || !$phone1 || !$phone2 || !$city || !$prov) {
				// __set_error_msg(array('error' => 'Data yang anda masukkan tidak lengkap !!!'));
				// redirect(site_url('purchase_order_detail' . '/' . __FUNCTION__));
			// }
			// else {
			if ($id) {
			
					$arr = array( 'ppid' => $id ,'pppid' => $pppid, 'pcurrency' => $pcurrency , 'pqty' => $pqty , 'pharga' => $pharga , 'pdisc' => $pdisc ,'pketerangan' => $pketerangan,'pstatus' => $pstatus );	
					//print_r($arr);die;
				if ($this -> purchase_order_detail_model -> __insert_purchase_order_detail($arr)) {
					__set_error_msg(array('info' => 'Data berhasil ditambahkan.'));
					redirect(site_url('purchase_order_detail/home/purchase_order_detail_add/'. $id .''));
				}
				else {
					__set_error_msg(array('error' => 'Gagal menambahkan data !!!'));
					redirect(site_url('purchase_order_detail/home'));
				}
			}else{
				__set_error_msg(array('error' => 'Kesalahan input data !!!'));
				redirect(site_url('purchase_order_detail/home'));			
			
			}
		}
		else {
		//echo "x2";die;
		$view['id'] = $id;
		$view['detailx'] = $this -> purchase_order_model -> __get_purchase_order_detail($id);
		$view['detail'] = $this -> purchase_order_detail_model -> __get_purchase_order_detail($id);
		$view['pbid'] = $this -> branch_lib -> __get_branch();
		$view['psid'] = $this -> sales_lib -> __get_sales();
		$view['pppid'] = $this -> products_lib -> __get_products();
		
		// print_r($view['detailx']);die;
			$this->load->view('purchase_order_detail_add',$view);
		}
	}
	
	function purchase_order_detail_update($id) {
	//print_r($id);die;
		if ($_POST) {
		//print_r($_POST);die;	
			
			$pnobukti = $this -> input -> post('pnobukti', TRUE);
			$pref = $this -> input -> post('pref', TRUE);
			$ptgl = $this -> input -> post('ptgl', TRUE);
			$psid = $this -> input -> post('psid', TRUE);
			$pgudang = $this -> input -> post('pgudang', TRUE);
			$ppid = $this -> input -> post('ppid', TRUE);
			$pcurrency = $this -> input -> post('pcurrency', TRUE);
			$pqty = $this -> input -> post('pqty', TRUE);
			$pharga = $this -> input -> post('pharga', TRUE);
			$pdisc = $this -> input -> post('pdisc', TRUE);
			$pketerangan = $this -> input -> post('pketerangan', TRUE);
			$id = (int) $this -> input -> post('id');
			
			if ($id) {
				// if (!$name || !$npwp || !$addr || !$phone1 || !$phone2 || !$city || !$prov) {
					// __set_error_msg(array('error' => 'Data yang anda masukkan tidak lengkap !!!'));
					// redirect(site_url('purchase_order_detail' . '/' . __FUNCTION__ . '/' . $id));
				// }
				// else {
			// else {
					$arr = array('pbid' => $pbid, 'pnobukti' => $pnobukti, 'pref' => $pref, 'ptgl' => $ptgl, 'psid' => $psid, 'pgudang' => $pgudang, 'ppid' => $ppid , 'pcurrency' => $pcurrency , 'pqty' => $pqty , 'pharga' => $pharga , 'pdisc' => $pdisc ,'pketerangan' => $pketerangan,'pstatus' => $pstatus );	
					
					
					
					
					if ($this -> purchase_order_detail_model -> __update_purchase_order_detail($id, $arr)) {	
						__set_error_msg(array('info' => 'Data berhasil diubah.'));
						redirect(site_url('purchase_order_detail/home'));
					}
					else {
						__set_error_msg(array('error' => 'Gagal mengubah data !!!'));
						redirect(site_url('purchase_order_detail/home'));
					}
				//}
			}
			else {
				__set_error_msg(array('error' => 'Kesalahan input data !!!'));
				redirect(site_url('purchase_order_detail/home'));
			}
		}
		else {
			$view['id'] = $id;
			
			$view['detail'] = $this -> purchase_order_detail_model -> __get_purchase_order_detail($id);
			$view['pbid'] = $this -> branch_lib -> __get_branch($view['detail'][0] -> pbid);
			$view['psid'] = $this -> sales_lib -> __get_sales($view['detail'][0] -> psid);
			$view['ppid'] = $this -> products_lib -> __get_products($view['detail'][0] -> ppid);
			$this->load->view(__FUNCTION__, $view);
		}
	}
	
	function purchase_order_detail_delete($id) {
		if ($this -> purchase_order_detail_model -> __delete_purchase_order_detail($id)) {
			__set_error_msg(array('info' => 'Data berhasil dihapus.'));
			redirect(site_url('purchase_order_detail/home'));
		}
		else {
			__set_error_msg(array('error' => 'Gagal hapus data !!!'));
			redirect(site_url('purchase_order_detail'));
		}
	}
}
