<?php
/* -*- tab-width: 2; indent-tabs-mode: nil; c-basic-offset: 2 -*- */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {
	function __construct() {
		parent::__construct();
		$this -> load -> library('pagination_lib');
		$this -> load -> model('pembayaran_model');
		$this -> load -> library('customer/customer_lib');
	}

	function index($id) {
		//echo "xx";die;
		$pager = $this -> pagination_lib -> pagination($this -> pembayaran_model -> __get_pembayaran(),3,10,site_url('pembayaran'));
		$view['pembayaran'] = $this -> pagination_lib -> paginate();
		$view['pages'] = $this -> pagination_lib -> pages();
		$this->load->view('pembayaran', $view);
	}
	
	function pembayaran_excel() {
		if($_POST){
			// print_r($_POST);die;
			$datex=explode(" - ",$_POST['datesort']);
			$datefromx=str_replace("/","-",$datex[0]);
			$datetox=str_replace("/","-",$datex[1]);
			$datefrom= date('Y-m-d',strtotime($datefromx));
			$dateto= date('Y-m-d',strtotime($datetox));
			
			//$dateto=$_POST[''];
			$view['pembayaran'] =$this -> pembayaran_model ->__get_pembayaran_by_date($datefrom,$dateto);
			// echo "<pre>";
			// print_r($view);
			// echo "</pre>";die;
			$this->load->view('pembayaran_excel', $view,FALSE);
		}else{
			echo "ok";die;
		}
		
	}	
	function pembayaran_addx() {
		//$urlz=site_url('pembayaran/pembayaran_add/');
		header('Refresh: 1;url=pembayaran_add?');
		//redirect(site_url('pembayaran/pembayaran_add/'));
		
	}
	function pembayaran_add() {
	
		if ($_POST) {
			//print_r($_POST);//die;
			
			$datex=explode(" - ",$_POST['datesort']);
			$datefromx=str_replace("/","-",$datex[0]);
			$datetox=str_replace("/","-",$datex[1]);
			$datefrom= date('Y-m-d',strtotime($datefromx));
			$dateto= date('Y-m-d',strtotime($datetox));			
			
			
			$year=date('y');
			$month=date('M');
			$mon=date('m');
			$yr=date('Y');
			$sec=date('s');
			$tinvv = $this -> input -> post('tinvv', TRUE);
			$branchid = $this -> input -> post('branch', TRUE);
			$ttanggal = $this -> input -> post('ttanggal', TRUE);
			$tcid = $this -> input -> post('tcid', TRUE);
			$taid = $this -> input -> post('aid', TRUE);
			$tbayar = $this -> input -> post('tbayar', TRUE);
			$ttype = 1;
			$ttypetrans = 1;
			$tinfo = $this -> input -> post('tinfo', TRUE);
			$ttax = (int) $this -> input -> post('ttax');	
			$gd_from = (int) $this -> input -> post('fromgd');
			$gd_to = (int) $this -> input -> post('togd');
			$tstatus = (int) $this -> input -> post('tstatus');
			$bcode = $this -> input -> post('bcode', TRUE);
			$tnofakturx = $this -> input -> post('tnofaktur', TRUE);
			$tnofaktur=$tnofakturx.$year.$bcode.$mon;

            $bayar=$this -> pembayaran_model -> __get_pembayaran_detailz($taid,$tcid,$datefrom,$dateto);			
			$gtotal= $bayar[0]->gtotal;
			
			//echo $tinvv;die;
			if($tinvv == "FAKTUR"){
//echo "xxx";die;
			$view['bayar']=$this -> pembayaran_model -> __get_pembayaran_detailzx($taid,$tcid,$datefrom,$dateto);			
			$gtotal= $bayar[0]->gtotal;			
			
			
			$branchid=$this -> memcachedlib -> sesresult['ubranchid'];
			$view['customer'] = $this -> customer_lib -> __get_customer_consinyasi();
			
			$view['gudang_niaga']=$this -> pembayaran_model ->__get_gudang_niaga($branchid);
			//print_r($view);die;
			$this->load->view(__FUNCTION__, $view);			
			
			
				
			}else{
			
			$bayarx=$this -> pembayaran_model -> __get_pembayaran_detailzx($taid,$tcid,$datefrom,$dateto);
			
				$arr = array('invid'=>'','invno' => $tnofaktur, 'invbid' => $branchid, 'invaid' => $taid,'invcid' => $tcid,'invtax' => $ttax ,
				'invtype' => $tbayar ,'periodfrom'=>$datefrom,'periodto'=>$dateto,
				'invdate' => $ttax ,'invdate' => $datefrom ,
				'invduedate' => $ttanggal,'invtotalall'=>$gtotal, 'invstatus' => 1 ,'desc'=>$tinfo );
				if ($this -> pembayaran_model -> __insert_pembayaran($arr)) {
					// $this -> pembayaran_model -> __update_pembayaran($arru);
					__set_error_msg(array('info' => 'Data berhasil ditambahkan.'));
					
				$lastid=$this->db->insert_id();		


					 $this -> pembayaran_model -> __get_total_pembayaran_monthly($mon,$yr,$lastid,$tnofaktur);

				
					// redirect(site_url('pembayaran_detail/pembayaran_detail_add/'. $lastid . ''));
					
					redirect(site_url('pembayaran'));					
				}
				else {
					__set_error_msg(array('error' => 'Gagal menambahkan data !!!'));
					redirect(site_url('pembayaran'));
				}
			}
		}
		else {
			//print_r($_SERVER);
$oy=substr($_SERVER["REQUEST_URI"],strlen($_SERVER["REQUEST_URI"])-1,1);	
//echo $oy;
 $urlz=site_url('pembayaran/pembayaran_add/');
// if($oy=="?"){	
// header('Refresh: 1;url=pembayaran_add');		
// }			
			$branchid=$this -> memcachedlib -> sesresult['ubranchid'];
			$view['customer'] = $this -> customer_lib -> __get_customer_consinyasi();
			
			$view['gudang_niaga']=$this -> pembayaran_model ->__get_gudang_niaga($branchid);
			//print_r($view);die;
			$this->load->view(__FUNCTION__, $view);
		}
	}
	
	
	function pembayaran_faktur($id) {
		
		//$view['customer'] = $this -> customer_lib -> __get_customer_consinyasi();		
		// $pager = $this -> pagination_lib -> pagination($this -> pembayaran_model -> __get_pembayaran_detail($id),3,10,site_url('pembayaran_detail'));
		// $view['pembayaran_detail'] = $this -> pagination_lib -> paginate();
		$view['detail'] =$this -> pembayaran_model -> __get_pembayaran_detail($id);
		//$view['pages'] = $this -> pagination_lib -> pages();
		$view['id'] = $id;
		
		//echo "sss";die;
		
		//$view['buku'] = $this -> books_lib -> __get_books_all();
		// $view['hostname']=$this->db->hostname;
		// $view['username']=$this->db->username;
		// $view['password']=$this->db->password;
		// $view['database']=$this->db->database;		
		$this->load->view('prinanpb', $view, false);
	}	
	
	
	
	function pembayaran_update($id) {
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
					redirect(site_url('pembayaran' . '/' . __FUNCTION__ . '/' . $id));
				}
				else {
					$arr = array('bname' => $name, 'bnpwp' => $npwp, 'baddr' => $addr, 'bcity' => $city, 'bprovince' => $prov, 'bphone' => $phone1 . '*' . $phone2, 'bstatus' => $status);
					if ($this -> pembayaran_model -> __update_pembayaran($id, $arr)) {	
						__set_error_msg(array('info' => 'Data berhasil diubah.'));
						redirect(site_url('pembayaran'));
					}
					else {
						__set_error_msg(array('error' => 'Gagal mengubah data !!!'));
						redirect(site_url('pembayaran'));
					}
				}
			}
			else {
				__set_error_msg(array('error' => 'Kesalahan input data !!!'));
				redirect(site_url('pembayaran'));
			}
		}
		else {
			$view['id'] = $id;
			$view['detail'] = $this -> pembayaran_model -> __get_pembayaran_detail($id);
			$this->load->view(__FUNCTION__, $view);
		}
	}
	
	function pembayaran_delete($id) {
		if ($this -> pembayaran_model -> __delete_pembayaran($id)) {
			__set_error_msg(array('info' => 'Data berhasil dihapus.'));
			redirect(site_url('pembayaran'));
		}
		else {
			__set_error_msg(array('error' => 'Gagal hapus data !!!'));
			redirect(site_url('pembayaran'));
		}
	}
	
	function pembayaran_search() {
		$keyword = urlencode($this -> input -> post('keyword', true));
		
		if ($keyword)
			redirect(site_url('pembayaran/pembayaran_search_result/'.$keyword));
		else
			redirect(site_url('pembayaran'));
	}
	
	function pembayaran_search_result($keyword) {
		$pager = $this -> pagination_lib -> pagination($this -> pembayaran_model -> __get_pembayaran_search(urldecode($keyword)),3,10,site_url('pembayaran/pembayaran_search_result/' . $keyword));
		$view['pembayaran'] = $this -> pagination_lib -> paginate();
		$view['pages'] = $this -> pagination_lib -> pages();
		$this -> load -> view('pembayaran', $view);
	}
}
