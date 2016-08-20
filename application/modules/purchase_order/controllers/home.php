<?php
/* -*- tab-width: 2; indent-tabs-mode: nil; c-basic-offset: 2 -*- */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {
	function __construct() {
		parent::__construct();
		$this -> load -> library('pagination_lib');
		$this -> load -> model('purchase_order_model');
		$this -> load -> library('customer/customer_lib');
		$this -> load -> library('branch/branch_lib');
		//$this -> load -> library('branch/branch_model');
	}

	function index($id) {
		
		if(!isset($_POST['excel'])){$_POST['excel']="";}
		if(!isset($_POST['no_po'])){$_POST['no_po']="";}
		if(!isset($_POST['tgid'])){$_POST['tgid']="";}
		if(!isset($_POST['datesort'])){$_POST['datesort']="";}
		if($_POST['datesort']!=""){
		$tgid=$_POST['tgid'];	
		$podt=explode('-',$_POST['datesort']);		
		$podate=explode('/',$podt[0]);
		$podatex=explode('/',$podt[1]);
		$pdt1= trim($podate[2]).'-'.trim($podate[1]).'-'.trim($podate[0]);
		$pdt2= trim($podatex[2]).'-'.trim($podatex[1]).'-'.trim($podatex[0]);
		}
		if($_POST['excel']=='EXCEL'){
		if($_POST['datesort']==""){
				__set_error_msg(array('error' => 'Data yang anda masukkan tidak lengkap !!!'));
				redirect(site_url('purchase_order'));
		}else{	
			$view['purchase_order'] = $this -> purchase_order_model -> __get_purchase_excel($pdt1,$pdt2,$tgid);
			$view['pages'] = "";
			//print_r($view['purchase_order']);
			$this->load->view('purchase_order', $view,FALSE);		
		}
		}else{	
			$pager = $this -> pagination_lib -> pagination($this -> purchase_order_model -> __get_purchase_order(),3,10,site_url('purchase_order'));
			$view['purchase_order'] = $this -> pagination_lib -> paginate();
			$view['pages'] = $this -> pagination_lib -> pages();		
			$this->load->view('purchase_order', $view);
		}
	}
	
	function purchase_order_add() {

		if ($_POST) {
			
			$year=date('y');
			$month=date('M');
			$mon=date('m');
			$yr=date('Y');
			$ttanggal = $this -> input -> post('ttanggal', TRUE);
			$tgid = $this -> input -> post('tgid', TRUE);
			$ttype = 5;
			$ttypetrans = $this -> input -> post('torder', TRUE);
			$branch = $this -> input -> post('branch', TRUE);
$bcode=$this -> branch_model -> __get_branch_code($branch);
	$bcode=$bcode[0]->bcode;					
			$tstatus = (int) $this -> input -> post('tstatus');
		$torder = (int) $this -> input -> post('torder');
			$tnofakturx = $this -> input -> post('tnofaktur', TRUE);
			
			
			$tnofaktur=$tnofakturx.$torder.$bcode.$year.$mon;
			// if (!$name || !$npwp || !$addr || !$phone1 || !$phone2 || !$city || !$prov) {
				// __set_error_msg(array('error' => 'Data yang anda masukkan tidak lengkap !!!'));
				// redirect(site_url('purchase_order' . '/' . __FUNCTION__));
			// }
			//else {
				$arr = array('tid'=>'','tbid'=>$branch,'tnofaktur' => $tnofaktur,  'tcid' => '','tpid' => $tcid,'ttanggal' => $ttanggal,  'ttype' => $ttype, 
				'ttypetrans' => $ttypetrans,  'ttotalqty' => '', 'ttotalharga' => '', 'ttotaldisc' => '', 'tongkos' => '', 'gd_to'=>$tgid,
				'tgrandtotal' => '', 'tstatus' => $tstatus);
				if ($this -> purchase_order_model -> __insert_purchase_order($arr)) {
					__set_error_msg(array('info' => 'Data berhasil ditambahkan.'));
					//SELECT MAX(tid) FROM transaction_tab WHERE ttype='5'
				$lastid=$this->db->insert_id();						
					 $this -> purchase_order_model -> __get_total_purchase_order_monthly($mon,$yr,$lastid,$tnofaktur);				
					redirect(site_url('purchase_order_details/purchase_order_details_add/'. $lastid . ''));
				}
				else {
					__set_error_msg(array('error' => 'Gagal menambahkan data !!!'));
					redirect(site_url('purchase_order'));
				}
			//}
		}
		else {
			$view['branch'] = $this -> branch_lib -> __get_branch();
			$view['customer'] = $this -> customer_lib -> __get_customer_consinyasi();		
			$this->load->view(__FUNCTION__, $view);
		}
	}
	
	function purchase_order_update($id) {
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
					redirect(site_url('purchase_order' . '/' . __FUNCTION__ . '/' . $id));
				}
				else {
					$arr = array('bname' => $name, 'bnpwp' => $npwp, 'baddr' => $addr, 'bcity' => $city, 'bprovince' => $prov, 'bphone' => $phone1 . '*' . $phone2, 'bstatus' => $status);
					if ($this -> purchase_order_model -> __update_purchase_order($id, $arr)) {	
						__set_error_msg(array('info' => 'Data berhasil diubah.'));
						redirect(site_url('purchase_order'));
					}
					else {
						__set_error_msg(array('error' => 'Gagal mengubah data !!!'));
						redirect(site_url('purchase_order'));
					}
				}
			}
			else {
				__set_error_msg(array('error' => 'Kesalahan input data !!!'));
				redirect(site_url('purchase_order'));
			}
		}
		else {
			$view['id'] = $id;
			$view['detail'] = $this -> purchase_order_model -> __get_purchase_order_detail($id);
			$this->load->view(__FUNCTION__, $view);
		}
	}
	
	function purchase_order_delete($id) {
		if ($this -> purchase_order_model -> __delete_purchase_order($id)) {
			__set_error_msg(array('info' => 'Data berhasil dihapus.'));
			redirect(site_url('purchase_order'));
		}
		else {
			__set_error_msg(array('error' => 'Gagal hapus data !!!'));
			redirect(site_url('purchase_order'));
		}
	}
	
	function sourceg() {
		$view['hostname']=$this->db->hostname;
		$view['username']=$this->db->username;
		$view['password']=$this->db->password;
		$view['database']=$this->db->database;
		$this->load->view('sourceg',$view,FALSE);
	}	

	
}
