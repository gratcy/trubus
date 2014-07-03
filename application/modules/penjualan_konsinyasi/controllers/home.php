<?php
/* -*- tab-width: 2; indent-tabs-mode: nil; c-basic-offset: 2 -*- */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {
	function __construct() {
		parent::__construct();
		$this -> load -> library('pagination_lib');
		$this -> load -> model('penjualan_konsinyasi_model');
		$this -> load -> library('customer/customer_lib');
	}

	function index($id) {
		$pager = $this -> pagination_lib -> pagination($this -> penjualan_konsinyasi_model -> __get_penjualan_konsinyasi(),3,10,site_url('penjualan_konsinyasi'));
		$view['penjualan_konsinyasi'] = $this -> pagination_lib -> paginate();
		$view['pages'] = $this -> pagination_lib -> pages();
		$this->load->view('penjualan_konsinyasi', $view);
	}
	
	function penjualan_konsinyasi_add() {
	
		if ($_POST) {
			$tnofaktur = $this -> input -> post('tnofaktur', TRUE);
			$ttanggal = $this -> input -> post('ttanggal', TRUE);
			$tcid = $this -> input -> post('tcid', TRUE);
			$ttype = $this -> input -> post('ttype', TRUE);
			$ttypetrans = $this -> input -> post('ttypetrans', TRUE);
			$ttax = (int) $this -> input -> post('ttax');			
			$tstatus = (int) $this -> input -> post('tstatus');
			
			// if (!$name || !$npwp || !$addr || !$phone1 || !$phone2 || !$city || !$prov) {
				// __set_error_msg(array('error' => 'Data yang anda masukkan tidak lengkap !!!'));
				// redirect(site_url('penjualan_konsinyasi' . '/' . __FUNCTION__));
			// }
			//else {
				$arr = array('tid'=>'','tnofaktur' => $tnofaktur,  'tcid' => $tcid,'tpid' => '','ttax' => $ttax ,'ttanggal' => $ttanggal,  'ttype' => $ttype, 'ttypetrans' => $ttypetrans,  'ttotalqty' => '', 'ttotalharga' => '', 'ttotaldisc' => '', 'tongkos' => '', 'tgrandtotal' => '', 'tstatus' => $tstatus);
				if ($this -> penjualan_konsinyasi_model -> __insert_penjualan_konsinyasi($arr)) {
					__set_error_msg(array('info' => 'Data berhasil ditambahkan.'));
					
				$lastid=$this->db->insert_id();		
					
					redirect(site_url('penjualan_konsinyasi_detail/penjualan_konsinyasi_detail_add/'. $lastid . ''));
				}
				else {
					__set_error_msg(array('error' => 'Gagal menambahkan data !!!'));
					redirect(site_url('penjualan_konsinyasi'));
				}
			//}
		}
		else {
			$view['customer'] = $this -> customer_lib -> __get_customer_consinyasi();		
			$this->load->view(__FUNCTION__, $view);
		}
	}
	
	function penjualan_konsinyasi_update($id) {
	echo $id;
		if ($_POST) {
			$name = $this -> input -> post('name', TRUE);
			$npwp = $this -> input -> post('npwp', TRUE);
			$addr = $this -> input -> post('addr', TRUE);
			$phone1 = $this -> input -> post('phone1', TRUE);
			$phone2 = $this -> input -> post('phone2', TRUE);
			$city = (int) $this -> input -> post('city');
			$prov = (int) $this -> input -> post('prov');
			$status = (int) $this -> input -> post('status');
			$id = (int) $this -> input -> post('id');
			
			if ($id) {
				if (!$name || !$npwp || !$addr || !$phone1 || !$phone2 || !$city || !$prov) {
					__set_error_msg(array('error' => 'Data yang anda masukkan tidak lengkap !!!'));
					redirect(site_url('penjualan_konsinyasi' . '/' . __FUNCTION__ . '/' . $id));
				}
				else {
					$arr = array('bname' => $name, 'bnpwp' => $npwp, 'baddr' => $addr, 'bcity' => $city, 'bprovince' => $prov, 'bphone' => $phone1 . '*' . $phone2, 'bstatus' => $status);
					if ($this -> penjualan_konsinyasi_model -> __update_penjualan_konsinyasi($id, $arr)) {	
						__set_error_msg(array('info' => 'Data berhasil diubah.'));
						redirect(site_url('penjualan_konsinyasi'));
					}
					else {
						__set_error_msg(array('error' => 'Gagal mengubah data !!!'));
						redirect(site_url('penjualan_konsinyasi'));
					}
				}
			}
			else {
				__set_error_msg(array('error' => 'Kesalahan input data !!!'));
				redirect(site_url('penjualan_konsinyasi'));
			}
		}
		else {
			$view['id'] = $id;
			$view['detail'] = $this -> penjualan_konsinyasi_model -> __get_penjualan_konsinyasi_detail($id);
			$this->load->view(__FUNCTION__, $view);
		}
	}
	
	function penjualan_konsinyasi_delete($id) {
		if ($this -> penjualan_konsinyasi_model -> __delete_penjualan_konsinyasi($id)) {
			__set_error_msg(array('info' => 'Data berhasil dihapus.'));
			redirect(site_url('penjualan_konsinyasi'));
		}
		else {
			__set_error_msg(array('error' => 'Gagal hapus data !!!'));
			redirect(site_url('penjualan_konsinyasi'));
		}
	}
}
