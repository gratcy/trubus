<?php
/* -*- tab-width: 2; indent-tabs-mode: nil; c-basic-offset: 2 -*- */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {
	function __construct() {
		parent::__construct();
		$this -> load -> library('pagination_lib');
		$this -> load -> model('pembelian_kredit_detail_model');
		$this -> load -> library('customer/customer_lib');
		$this -> load -> library('books/books_lib');
	}

	function index($id) {
	
		$pager = $this -> pagination_lib -> pagination($this -> pembelian_kredit_detail_model -> __get_pembelian_kredit_detail($id),3,10,site_url('pembelian_kredit_detail'));
		$view['pembelian_kredit_detail'] = $this -> pagination_lib -> paginate();
		$view['pages'] = $this -> pagination_lib -> pages();
		$view['id'] = $id;
		$view['detail'] =$this -> pembelian_kredit_detail_model -> __get_pembelian_kredit_detailxx($id);
		$this->load->view('pembelian_kredit_detail', $view);
		
		
		
	}
	
	function pembelian_kredit_detail_add($id) {
	
		if ($_POST) {
		$id = $this -> input -> post('id', TRUE);
		//echo $id;die;	

			$ttid = $this -> input -> post('ttid', TRUE);
			$tbidx = $this -> input -> post('tbid', TRUE);
			$tbidz=explode("-",$tbidx);
			$tbid=$tbidz[0];
			$tharga=$tbidz[1];
			$tdisc=$tbidz[2];
			
			
		//echo $id;die;	

//if(($tharga==0) OR ($tharga=="")){
$tharga = $this -> input -> post('tharga', TRUE);
//}
//if(($tdisc==0) OR ($tdisc=="")){
$tdisc = $this -> input -> post('tdisc', TRUE);	
//}			
			
			$tqty = $this -> input -> post('tqty', TRUE);
			$ttotal = $tqty*($tharga-($tharga*$tdisc/100));			
			$tstatus = (int) $this -> input -> post('tstatus');
			
			
			// if (!$name || !$npwp || !$addr || !$phone1 || !$phone2 || !$city || !$prov) {
				// __set_error_msg(array('error' => 'Data yang anda masukkan tidak lengkap !!!'));
				// redirect(site_url('pembelian_kredit_detail' . '/' . __FUNCTION__));
			// }
			//else {
				$arr = array('tid'=>'','ttid' => $ttid,  'tbid' => $tbid,'tqty' => $tqty ,'tharga' => $tharga,  'tdisc' => $tdisc, 'ttotal' => $ttotal,  'tstatus' => $tstatus);
				if ($this -> pembelian_kredit_detail_model -> __insert_pembelian_kredit_detail($arr)) {
					__set_error_msg(array('info' => 'Data berhasil ditambahkan.'));
					
					 $this -> pembelian_kredit_detail_model -> __update_pembelian_kredit_details($ttid);					
					
					//redirect(site_url('pembelian_kredit_details/' . $ttid .''));
					redirect(site_url('pembelian_kredit_detail/pembelian_kredit_detail_add/' . $id .''));
				}
				else {
					__set_error_msg(array('error' => 'Gagal menambahkan data !!!'));
					redirect(site_url('pembelian_kredit_detail'));
				}
			//}
		}
		else {
		$view['customer'] = $this -> customer_lib -> __get_customer_consinyasi();		
		$pager = $this -> pagination_lib -> pagination($this -> pembelian_kredit_detail_model -> __get_pembelian_kredit_detail($id),3,10,site_url('pembelian_kredit_detail'));
		$view['pembelian_kredit_detail'] = $this -> pagination_lib -> paginate();
		$view['detail'] =$this -> pembelian_kredit_detail_model -> __get_pembelian_kredit_detailxx($id);
		$view['pages'] = $this -> pagination_lib -> pages();
		$view['id'] = $id;
		$view['buku'] = $this -> books_lib -> __get_books_all();
		//$this->load->view('pembelian_kredit_detail_add', $view);
//print_r($view);die;		
$this->load->view(__FUNCTION__, $view);		
	
			
		}
	}
	



	function pembelian_kredit_update() {
	$arr=array('');
		if ($_POST) {
		//$id = $this -> input -> post('id', TRUE);
		//echo $id;die;	

			$tid = $this -> input -> post('tid', TRUE);
			$tinfo = $this -> input -> post('tinfo', TRUE);
			$tgrandtotal = $this -> input -> post('tgrandtotal', TRUE);
			$ttotaldisc = $this -> input -> post('ttotaldisc', TRUE);
			$tgrandtotalx = $tgrandtotal-($tgrandtotal * $ttotaldisc /100);

				$arr = array('ttotaldisc' => $ttotaldisc, 'tgrandtotal' => $tgrandtotalx ,'tinfo'=>$tinfo );
					
				if ($this -> pembelian_kredit_detail_model -> __update_pembelian_kredits($tid,$arr)){
				__set_error_msg(array('info' => 'Data berhasil ditambahkan.'));
										
					
					//redirect(site_url('pembelian_kredit_details/' . $ttid .''));
					redirect(site_url('pembelian_kredit'));
				}
				else {
					__set_error_msg(array('error' => 'Gagal menambahkan data !!!'));
					redirect(site_url('pembelian_kredit_detail_add'));
				}
	}

}




	
	
	
function pembelian_kredit_faktur($id) {
		$view['customer'] = $this -> customer_lib -> __get_customer_consinyasi();		
		$pager = $this -> pagination_lib -> pagination($this -> pembelian_kredit_detail_model -> __get_pembelian_kredit_detail($id),3,10,site_url('pembelian_kredit_detail'));
		$view['pembelian_kredit_detail'] = $this -> pagination_lib -> paginate();
		$view['detail'] =$this -> pembelian_kredit_detail_model -> __get_pembelian_kredit_detailxx($id);
		$view['pages'] = $this -> pagination_lib -> pages();
		$view['id'] = $id;
		$view['buku'] = $this -> books_lib -> __get_books_all();
		//$this->load->view('pembelian_kredit_detail_add', $view);	
$this->load->view('kwitansi_faktur', $view, false);		
			
	}		
	
	
	
	
	
	
	
	
	
	
	
function pembelian_kredit_details($id) {
	
		if ($_POST) {
			$ttid = $this -> input -> post('ttid', TRUE);
			$tbidx = $this -> input -> post('tbid', TRUE);
			$tbidz=explode("-",$tbidx);
			$tbid=$tbidz[0];
			$tharga=$tbidz[1];
			$tdisc=$tbidz[2];
			
			
			

if(($tharga==0) OR ($tharga=="")){
$tharga = $this -> input -> post('tharga', TRUE);
}
if(($tdisc==0) OR ($tdisc=="")){
$tdisc = $this -> input -> post('tdisc', TRUE);	
}			
			
			$tqty = $this -> input -> post('tqty', TRUE);
			$ttotal = $tqty*($tharga-($tharga*$tdisc/100));			
			$tstatus = (int) $this -> input -> post('tstatus');
			
			
			// if (!$name || !$npwp || !$addr || !$phone1 || !$phone2 || !$city || !$prov) {
				// __set_error_msg(array('error' => 'Data yang anda masukkan tidak lengkap !!!'));
				// redirect(site_url('pembelian_kredit_detail' . '/' . __FUNCTION__));
			// }
			//else {
				$arr = array('tid'=>'','ttid' => $ttid,  'tbid' => $tbid,'tqty' => $tqty ,'tharga' => $tharga,  'tdisc' => $tdisc, 'ttotal' => $ttotal,  'tstatus' => $tstatus);
				if ($this -> pembelian_kredit_detail_model -> __insert_pembelian_kredit_detail($arr)) {
					__set_error_msg(array('info' => 'Data berhasil ditambahkan.'));
					redirect(site_url('pembelian_kredit_detail/' . $ttid .''));
				}
				else {
					__set_error_msg(array('error' => 'Gagal menambahkan data !!!'));
					redirect(site_url('pembelian_kredit_detail'));
				}
			//}
		}
		else {
			$view['customer'] = $this -> customer_lib -> __get_customer_consinyasi();		
			//$this->load->view(__FUNCTION__, $view);
			
			
			
		$pager = $this -> pagination_lib -> pagination($this -> pembelian_kredit_detail_model -> __get_pembelian_kredit_detail($id),3,10,site_url('pembelian_kredit_detail'));
		$view['pembelian_kredit_detail'] = $this -> pagination_lib -> paginate();
		$view['detail'] =$this -> pembelian_kredit_detail_model -> __get_pembelian_kredit_detailxx($id);
		$view['pages'] = $this -> pagination_lib -> pages();
		$view['id'] = $id;
		$view['buku'] = $this -> books_lib -> __get_books_all();
		//$this->load->view('pembelian_kredit_detail_add', $view);	
$this->load->view('pembelian_kredit_details', $view);		
			
			
			
			
			
			
			
			
			
		}
	}	
	
	
	
	function pembelian_kredit_detail_update($id) {
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
					redirect(site_url('pembelian_kredit_detail' . '/' . __FUNCTION__ . '/' . $id));
				}
				else {
					$arr = array('bname' => $name, 'bnpwp' => $npwp, 'baddr' => $addr, 'bcity' => $city, 'bprovince' => $prov, 'bphone' => $phone1 . '*' . $phone2, 'bstatus' => $status);
					if ($this -> pembelian_kredit_detail_model -> __update_pembelian_kredit_detail($id, $arr)) {	
						__set_error_msg(array('info' => 'Data berhasil diubah.'));
						redirect(site_url('pembelian_kredit_detail'));
					}
					else {
						__set_error_msg(array('error' => 'Gagal mengubah data !!!'));
						redirect(site_url('pembelian_kredit_detail'));
					}
				}
			}
			else {
				__set_error_msg(array('error' => 'Kesalahan input data !!!'));
				redirect(site_url('pembelian_kredit_detail'));
			}
		}
		else {
			$view['id'] = $id;
			$view['detail'] = $this -> pembelian_kredit_detail_model -> __get_pembelian_kredit_detail_detail($id);
			$this->load->view(__FUNCTION__, $view);
		}
	}
	
	function pembelian_kredit_detail_delete($id) {
		if ($this -> pembelian_kredit_detail_model -> __delete_pembelian_kredit_detail($id)) {
			__set_error_msg(array('info' => 'Data berhasil dihapus.'));
			redirect(site_url('pembelian_kredit_detail'));
		}
		else {
			__set_error_msg(array('error' => 'Gagal hapus data !!!'));
			redirect(site_url('pembelian_kredit_detail'));
		}
	}
}
