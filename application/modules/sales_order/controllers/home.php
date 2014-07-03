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
		$this -> load -> model('sales_order_model');
	}

	function index() {
		$pager = $this -> pagination_lib -> pagination($this -> sales_order_model -> __get_sales_order(),3,10,site_url('sales_order'));
		$view['sales_order'] = $this -> pagination_lib -> paginate();
		$view['pages'] = $this -> pagination_lib -> pages();
		$this->load->view('sales_order', $view);
	}
	
	function sales_order_add() {
		if ($_POST) {
		
		
			$pbid = $this -> input -> post('pbid', TRUE);
			$pnobukti = $this -> input -> post('pnobukti', TRUE);
			$pref = $this -> input -> post('pref', TRUE);
			$ptglx = explode("/",$this -> input -> post('ptgl', TRUE));			
			$ptgl="$ptglx[2]-$ptglx[1]-$ptglx[0]";					
			$psid = $this -> input -> post('psid', TRUE);
			$pgudang = $this -> input -> post('pgudang', TRUE);
			$ppid = $this -> input -> post('ppid', TRUE);
			$pcurrency = $this -> input -> post('pcurrency', TRUE);
			$pqty = $this -> input -> post('pqty', TRUE);
			$pharga = $this -> input -> post('pharga', TRUE);
			$pdisc = $this -> input -> post('pdisc', TRUE);
			$pketerangan = $this -> input -> post('pketeranganus', TRUE);
			$pstatus = (int)$this ->input -> post('pstatus', TRUE);
			
		
			// print_r($_POST);die;
			
			// if (!$name || !$npwp || !$addr || !$phone1 || !$phone2 || !$city || !$prov) {
				// __set_error_msg(array('error' => 'Data yang anda masukkan tidak lengkap !!!'));
				// redirect(site_url('sales_order' . '/' . __FUNCTION__));
			// }
			// else {
					$arr = array('pbid' => $pbid, 'pnobukti' => $pnobukti, 'pref' => $pref, 'ptgl' => $ptgl, 'psid' => $psid, 'pgudang' => $pgudang, 'ppid' => $ppid , 'pcurrency' => $pcurrency , 'pqty' => $pqty , 'pharga' => $pharga , 'pdisc' => $pdisc ,'pketerangan' => $pketerangan,'pstatus' => $pstatus );	
				if ($this -> sales_order_model -> __insert_sales_order($arr)) {
					__set_error_msg(array('info' => 'Data berhasil ditambahkan.'));
					redirect(site_url('sales_order/home'));
				}
				else {
					__set_error_msg(array('error' => 'Gagal menambahkan data !!!'));
					redirect(site_url('sales_order/home'));
				}
			//}
		}
		else {
		$view['pbid'] = $this -> branch_lib -> __get_branch();
		$view['psid'] = $this -> sales_lib -> __get_sales();
			$this->load->view('sales_order_add',$view);
		}
	}
	
	function sales_order_update($id) {
	//print_r($id);die;
		if ($_POST) {
		//print_r($_POST);die;	
			$pbid = $this -> input -> post('pbid', TRUE);
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
					// redirect(site_url('sales_order' . '/' . __FUNCTION__ . '/' . $id));
				// }
				// else {
			// else {
					$arr = array('pbid' => $pbid, 'pnobukti' => $pnobukti, 'pref' => $pref, 'ptgl' => $ptgl, 'psid' => $psid, 'pgudang' => $pgudang, 'ppid' => $ppid , 'pcurrency' => $pcurrency , 'pqty' => $pqty , 'pharga' => $pharga , 'pdisc' => $pdisc ,'pketerangan' => $pketerangan,'pstatus' => $pstatus );	
					
					
					
					
					if ($this -> sales_order_model -> __update_sales_order($id, $arr)) {	
						__set_error_msg(array('info' => 'Data berhasil diubah.'));
						redirect(site_url('sales_order/home'));
					}
					else {
						__set_error_msg(array('error' => 'Gagal mengubah data !!!'));
						redirect(site_url('sales_order/home'));
					}
				//}
			}
			else {
				__set_error_msg(array('error' => 'Kesalahan input data !!!'));
				redirect(site_url('sales_order/home'));
			}
		}
		else {
			$view['id'] = $id;
			
			$view['detail'] = $this -> sales_order_model -> __get_sales_order_detail($id);
			$view['pbid'] = $this -> branch_lib -> __get_branch($view['detail'][0] -> pbid);
			$view['psid'] = $this -> sales_lib -> __get_sales($view['detail'][0] -> psid);
			$this->load->view(__FUNCTION__, $view);
		}
	}
	
	function sales_order_delete($id) {
		if ($this -> sales_order_model -> __delete_sales_order($id)) {
			__set_error_msg(array('info' => 'Data berhasil dihapus.'));
			redirect(site_url('sales_order/home'));
		}
		else {
			__set_error_msg(array('error' => 'Gagal hapus data !!!'));
			redirect(site_url('sales_order'));
		}
	}
}
