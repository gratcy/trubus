<?php
/* -*- tab-width: 2; indent-tabs-mode: nil; c-basic-offset: 2 -*- */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {
	function __construct() {
		parent::__construct();
		$this -> load -> library('pagination_lib');
		$this -> load -> model('retur_bk_model');
		$this -> load -> library('customer/customer_lib');
	}

	function index($id) {
		$pager = $this -> pagination_lib -> pagination($this -> retur_bk_model -> __get_retur_bk(),3,10,site_url('retur_bk'));
		$view['retur_bk'] = $this -> pagination_lib -> paginate();
		$view['pages'] = $this -> pagination_lib -> pages();
		$this->load->view('retur_bk', $view);
	}
	
	function retur_bk_add() {
	
		if ($_POST) {
			$branchid = $this -> input -> post('branch', TRUE);
			$year=date('y');
			$month=date('M');
			$mon=date('m');
			$yr=date('Y');
			$sec=date('s');
			$ttanggal = $this -> input -> post('ttanggal', TRUE);
			$ttgl_spo=date('Y-m-d');
			$tpid = $this -> input -> post('tpid', TRUE);
			$ttype = 3;
			$ttypetrans = 4;
					
			$tstatus = (int) $this -> input -> post('tstatus');

			$tnofakturx = $this -> input -> post('tnofaktur', TRUE);
			$tnofaktur=$tnofakturx.$bcode.$year.$mon.$sec;
			// if (!$name || !$npwp || !$addr || !$phone1 || !$phone2 || !$city || !$prov) {
				// __set_error_msg(array('error' => 'Data yang anda masukkan tidak lengkap !!!'));
				// redirect(site_url('retur_bk' . '/' . __FUNCTION__));
			// }
			//else {
				$arr = array('tid'=>'','tnospo' => $tnofaktur,'tnofaktur' => '', 'tbid' => $branchid, 'tcid' => '','tpid' => $tpid,
				 'ttgl_spo'=>$ttgl_spo, 'ttype' => $ttype, 
				'ttypetrans' => $ttypetrans,  'ttotalqty' => '', 'ttotalharga' => '', 'ttotaldisc' => '', 'tongkos' => '', 'tgrandtotal' => '', 'tstatus' => $tstatus);
				if ($this -> retur_bk_model -> __insert_retur_bk($arr)) {
					__set_error_msg(array('info' => 'Data berhasil ditambahkan.'));
					
				$lastid=$this->db->insert_id();		


					 $this -> retur_bk_model -> __get_total_retur_bk_monthly($mon,$yr,$lastid,$tnofaktur);

				
					redirect(site_url('retur_bk_detail/retur_bk_detail_add/'. $lastid . '/'.$tpid));
				}
				else {
					__set_error_msg(array('error' => 'Gagal menambahkan data !!!'));
					redirect(site_url('retur_bk'));
				}
			//}
		}
		else {
			$view['customer'] = $this -> customer_lib -> __get_customer_consinyasi();		
			$this->load->view(__FUNCTION__, $view);
		}
	}
	
	function retur_bk_update($id) {
	//echo $id;
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
					redirect(site_url('retur_bk' . '/' . __FUNCTION__ . '/' . $id));
				}
				else {
					$arr = array('bname' => $name, 'bnpwp' => $npwp, 'baddr' => $addr, 'bcity' => $city, 'bprovince' => $prov, 'bphone' => $phone1 . '*' . $phone2, 'bstatus' => $status);
					if ($this -> retur_bk_model -> __update_retur_bk($id, $arr)) {	
						__set_error_msg(array('info' => 'Data berhasil diubah.'));
						redirect(site_url('retur_bk'));
					}
					else {
						__set_error_msg(array('error' => 'Gagal mengubah data !!!'));
						redirect(site_url('retur_bk'));
					}
				}
			}
			else {
				__set_error_msg(array('error' => 'Kesalahan input data !!!'));
				redirect(site_url('retur_bk'));
			}
		}
		else {
			$view['id'] = $id;
			$view['detail'] = $this -> retur_bk_model -> __get_retur_bk_detail($id);
			$this->load->view(__FUNCTION__, $view);
		}
	}
	
	function retur_bk_delete($id) {
		if ($this -> retur_bk_model -> __delete_retur_bk($id)) {
			__set_error_msg(array('info' => 'Data berhasil dihapus.'));
			redirect(site_url('retur_bk'));
		}
		else {
			__set_error_msg(array('error' => 'Gagal hapus data !!!'));
			redirect(site_url('retur_bk'));
		}
	}
	
	

	
}
