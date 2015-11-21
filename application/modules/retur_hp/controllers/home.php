<?php
/* -*- tab-width: 2; indent-tabs-mode: nil; c-basic-offset: 2 -*- */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {
	function __construct() {
		parent::__construct();
		$this -> load -> library('pagination_lib');
		$this -> load -> model('retur_hp_model');
		$this -> load -> library('customer/customer_lib');
	}

	function index($id) {
		$pager = $this -> pagination_lib -> pagination($this -> retur_hp_model -> __get_retur_hp(),3,10,site_url('retur_hp'));
		$view['retur_hp'] = $this -> pagination_lib -> paginate();
		$view['pages'] = $this -> pagination_lib -> pages();
		$this->load->view('retur_hp', $view);
	}

	function retur_hp_addx() {
		//$urlz=site_url('hasil_penjualan/hasil_penjualan_add/');
		header('Refresh: 1;url=retur_hp_add?');
		//redirect(site_url('hasil_penjualan/hasil_penjualan_add/'));
		
	}	
	
	function hasil_retur_excel_old() {
		if($_POST){
			$datex = explode(" - ",$_POST['datesort']);
			$datefromx=str_replace("/","-",$datex[0]);
			$datetox=str_replace("/","-",$datex[1]);
			$datefrom= date('Y-m-d',strtotime($datefromx));
			$dateto= date('Y-m-d',strtotime($datetox));
			$view['hasil_penjualan'] = $this -> retur_hp_model ->__get_hasil_penjualan_by_date($datefrom,$dateto);
			$this->load->view('hasil_penjualan_excel', $view,FALSE);
		}
	}
	
	function hasil_retur_excel() {
		if($_POST){
			$datex=explode(" - ",$_POST['datesort']);
			$datefromx=str_replace("/","-",$datex[0]);
			$datetox=str_replace("/","-",$datex[1]);
			$view['datefrom']= date('Y-m-d',strtotime($datefromx));
			$view['dateto']= date('Y-m-d',strtotime($datetox));		
			$view['hostname']=$this->db->hostname;
			$view['username']=$this->db->username;
			$view['password']=$this->db->password;
			$view['database']=$this->db->database;	
			$this->load->view('rhp_excell', $view,FALSE);
		}
	}	
	

	function retur_hp_add() {
	
		if ($_POST) {
			
			$year=date('y');
			$month=date('M');
			$mon=date('m');
			$yr=date('Y');
			$sec=date('s');
			$branchid = $this -> input -> post('branch', TRUE);
			$ttanggal = $this -> input -> post('ttanggal', TRUE);
			$tcid = $this -> input -> post('tcid', TRUE);
			$ttype = 1;
			$ttypetrans = 3;
			$ttax = (int) $this -> input -> post('ttax');	
			$gd_from = (int) $this -> input -> post('fromgd');
			$gd_to = (int) $this -> input -> post('togd');
			$tstatus = (int) $this -> input -> post('tstatus');
			$bcode = $this -> input -> post('bcode', TRUE);
			$tnofakturx = $this -> input -> post('tnofaktur', TRUE);
			$tnofaktur=$tnofakturx.$year.$bcode.$mon;
			// if (!$name || !$npwp || !$addr || !$phone1 || !$phone2 || !$city || !$prov) {
				// __set_error_msg(array('error' => 'Data yang anda masukkan tidak lengkap !!!'));
				// redirect(site_url('retur_hp' . '/' . __FUNCTION__));
			// }
			//else {
				$arr = array('tid'=>'','tnofaktur' => $tnofaktur, 'tbid' => $branchid, 'tcid' => $tcid,'tpid' => '','ttax' => $ttax ,
				'ttanggal' => $ttanggal,  'ttype' => $ttype, 'ttypetrans' => $ttypetrans,  'ttotalqty' => '', 
				'ttotalharga' => '', 'ttotaldisc' => '', 'tongkos' => '', 'tgrandtotal' => '', 
				'gd_from'=>$gd_from,'gd_to'=>$gd_to,'tstatus' => $tstatus);
				if ($this -> retur_hp_model -> __insert_retur_hp($arr)) {
					__set_error_msg(array('info' => 'Data berhasil ditambahkan.'));
					
				$lastid=$this->db->insert_id();		


					 $this -> retur_hp_model -> __get_total_retur_hp_monthly($mon,$yr,$lastid,$tnofaktur);
//echo $lastid;die;
				
					redirect(site_url('retur_hp_detail/retur_hp_detail_add/'. $lastid . ''));
				}
				else {
					__set_error_msg(array('error' => 'Gagal menambahkan data !!!'));
					redirect(site_url('retur_hp'));
				}
			//}
		}
		else {
			$branchid=$this -> memcachedlib -> sesresult['ubranchid'];
			$view['customer'] = $this -> customer_lib -> __get_customer_consinyasi();
			
			$view['gudang_niaga']=$this -> retur_hp_model ->__get_gudang_niaga($branchid);
			//print_r($view);die;
			$this->load->view(__FUNCTION__, $view);
		}
	}
	
	function retur_hp_update($id) {
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
					redirect(site_url('retur_hp' . '/' . __FUNCTION__ . '/' . $id));
				}
				else {
					$arr = array('bname' => $name, 'bnpwp' => $npwp, 'baddr' => $addr, 'bcity' => $city, 'bprovince' => $prov, 'bphone' => $phone1 . '*' . $phone2, 'bstatus' => $status);
					if ($this -> retur_hp_model -> __update_retur_hp($id, $arr)) {	
						__set_error_msg(array('info' => 'Data berhasil diubah.'));
						redirect(site_url('retur_hp'));
					}
					else {
						__set_error_msg(array('error' => 'Gagal mengubah data !!!'));
						redirect(site_url('retur_hp'));
					}
				}
			}
			else {
				__set_error_msg(array('error' => 'Kesalahan input data !!!'));
				redirect(site_url('retur_hp'));
			}
		}
		else {
			$view['id'] = $id;
			$view['detail'] = $this -> retur_hp_model -> __get_retur_hp_detail($id);
			$this->load->view(__FUNCTION__, $view);
		}
	}
	
	function retur_hp_delete($id) {
		if ($this -> retur_hp_model -> __delete_retur_hp($id)) {
			__set_error_msg(array('info' => 'Data berhasil dihapus.'));
			redirect(site_url('retur_hp'));
		}
		else {
			__set_error_msg(array('error' => 'Gagal hapus data !!!'));
			redirect(site_url('retur_hp'));
		}
	}
	
	function retur_hp_search() {
		$keyword = urlencode($this -> input -> post('keyword', true));
		
		if ($keyword)
			redirect(site_url('retur_hp/retur_hp_search_result/'.$keyword));
		else
			redirect(site_url('retur_hp'));
	}
	
	function retur_hp_search_result($keyword) {
		$pager = $this -> pagination_lib -> pagination($this -> retur_hp_model -> __get_retur_hp_search(urldecode($keyword)),3,10,site_url('retur_hp/retur_hp_search_result/' . $keyword));
		$view['retur_hp'] = $this -> pagination_lib -> paginate();
		$view['pages'] = $this -> pagination_lib -> pages();
		$this -> load -> view('retur_hp', $view);
	}
}
