<?php
/* -*- tab-width: 2; indent-tabs-mode: nil; c-basic-offset: 2 -*- */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {
	function __construct() {
		parent::__construct();
		$this -> load -> library('pagination_lib');
		$this -> load -> model('retur_jk_model');
		$this -> load -> library('customer/customer_lib');
	}

	function index($id) {
		$pager = $this -> pagination_lib -> pagination($this -> retur_jk_model -> __get_retur_jk(),3,10,site_url('retur_jk'));
		$view['retur_jk'] = $this -> pagination_lib -> paginate();
		$view['pages'] = $this -> pagination_lib -> pages();
		$this->load->view('retur_jk', $view);
	}
	
	function hasil_retur_excel() {
		if($_POST){
			$datex=explode(" - ",$_POST['datesort']);
			$datefromx=str_replace("/","-",$datex[0]);
			$datetox=str_replace("/","-",$datex[1]);
			$datefrom= date('Y-m-d',strtotime($datefromx));
			$dateto= date('Y-m-d',strtotime($datetox));
			$view['hasil_penjualan'] =$this -> retur_jk_model ->__get_hasil_penjualan_by_date($datefrom,$dateto);
			$this->load->view('hasil_penjualan_excel', $view,FALSE);
		}
	}
	
	function retur_jk_add() {
	
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
			$ttypetrans = 4;
			$ttax = (int) $this -> input -> post('ttax');	
			$gd_from = (int) $this -> input -> post('fromgd');
			$gd_to = (int) $this -> input -> post('togd');
			$tstatus = (int) $this -> input -> post('tstatus');
			$bcode = $this -> input -> post('bcode', TRUE);
			$tnofakturx = $this -> input -> post('tnofaktur', TRUE);
			$tnofaktur=$tnofakturx.$year.$bcode.$mon;
			// if (!$name || !$npwp || !$addr || !$phone1 || !$phone2 || !$city || !$prov) {
				// __set_error_msg(array('error' => 'Data yang anda masukkan tidak lengkap !!!'));
				// redirect(site_url('retur_jk' . '/' . __FUNCTION__));
			// }
			//else {
				$arr = array('tid'=>'','tnofaktur' => $tnofaktur, 'tbid' => $branchid, 'tcid' => $tcid,'tpid' => '','ttax' => $ttax ,
				'ttanggal' => $ttanggal,  'ttype' => $ttype, 'ttypetrans' => $ttypetrans,  'ttotalqty' => '', 
				'ttotalharga' => '', 'ttotaldisc' => '', 'tongkos' => '', 'tgrandtotal' => '', 
				'gd_from'=>$gd_from,'gd_to'=>$gd_to,'tstatus' => $tstatus);
				if ($this -> retur_jk_model -> __insert_retur_jk($arr)) {
					__set_error_msg(array('info' => 'Data berhasil ditambahkan.'));
					
				$lastid=$this->db->insert_id();		


					 $this -> retur_jk_model -> __get_total_retur_jk_monthly($mon,$yr,$lastid,$tnofaktur);

				
					redirect(site_url('retur_jk_detail/retur_jk_detail_add/'. $lastid . ''));
				}
				else {
					__set_error_msg(array('error' => 'Gagal menambahkan data !!!'));
					redirect(site_url('retur_jk'));
				}
			//}
		}
		else {
			$branchid=$this -> memcachedlib -> sesresult['ubranchid'];
			$view['customer'] = $this -> customer_lib -> __get_customer_consinyasi();
			
			$view['gudang_niaga']=$this -> retur_jk_model ->__get_gudang_niaga($branchid);
			//print_r($view);die;
			$this->load->view(__FUNCTION__, $view);
		}
	}
	
	function retur_jk_update($id) {
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
					redirect(site_url('retur_jk' . '/' . __FUNCTION__ . '/' . $id));
				}
				else {
					$arr = array('bname' => $name, 'bnpwp' => $npwp, 'baddr' => $addr, 'bcity' => $city, 'bprovince' => $prov, 'bphone' => $phone1 . '*' . $phone2, 'bstatus' => $status);
					if ($this -> retur_jk_model -> __update_retur_jk($id, $arr)) {	
						__set_error_msg(array('info' => 'Data berhasil diubah.'));
						redirect(site_url('retur_jk'));
					}
					else {
						__set_error_msg(array('error' => 'Gagal mengubah data !!!'));
						redirect(site_url('retur_jk'));
					}
				}
			}
			else {
				__set_error_msg(array('error' => 'Kesalahan input data !!!'));
				redirect(site_url('retur_jk'));
			}
		}
		else {
			$view['id'] = $id;
			$view['detail'] = $this -> retur_jk_model -> __get_retur_jk_detail($id);
			$this->load->view(__FUNCTION__, $view);
		}
	}
	
	function retur_jk_delete($id) {
		if ($this -> retur_jk_model -> __delete_retur_jk($id)) {
			__set_error_msg(array('info' => 'Data berhasil dihapus.'));
			redirect(site_url('retur_jk'));
		}
		else {
			__set_error_msg(array('error' => 'Gagal hapus data !!!'));
			redirect(site_url('retur_jk'));
		}
	}
	
	function retur_jk_search() {
		$keyword = urlencode($this -> input -> post('keyword', true));
		
		if ($keyword)
			redirect(site_url('retur_jk/retur_jk_search_result/'.$keyword));
		else
			redirect(site_url('retur_jk'));
	}
	
	function retur_jk_search_result($keyword) {
		$pager = $this -> pagination_lib -> pagination($this -> retur_jk_model -> __get_retur_jk_search(urldecode($keyword)),3,10,site_url('retur_jk/retur_jk_search_result/' . $keyword));
		$view['retur_jk'] = $this -> pagination_lib -> paginate();
		$view['pages'] = $this -> pagination_lib -> pages();
		$this -> load -> view('retur_jk', $view);
	}
}
