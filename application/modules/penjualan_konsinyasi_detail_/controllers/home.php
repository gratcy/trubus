<?php
/* -*- tab-width: 2; indent-tabs-mode: nil; c-basic-offset: 2 -*- */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {
	function __construct() {
		parent::__construct();
		$this -> load -> library('pagination_lib');
		$this -> load -> model('penjualan_konsinyasi_detail_model');
		$this -> load -> library('customer/customer_lib');
		$this -> load -> library('books/books_lib');
	}

	function index($id) {
	
		$pager = $this -> pagination_lib -> pagination($this -> penjualan_konsinyasi_detail_model -> __get_penjualan_konsinyasi_detail($id),3,10,site_url('penjualan_konsinyasi_detail'));
		$view['penjualan_konsinyasi_detail'] = $this -> pagination_lib -> paginate();
		$view['pages'] = $this -> pagination_lib -> pages();
		$view['id'] = $id;
		$view['detail'] =$this -> penjualan_konsinyasi_detail_model -> __get_penjualan_konsinyasi_detailxx($id);
		$this->load->view('penjualan_konsinyasi_detail', $view);
		
		
		
	}
	
	function penjualan_konsinyasi_detail_add($id) {
	
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
				// redirect(site_url('penjualan_konsinyasi_detail' . '/' . __FUNCTION__));
			// }
			//else {
				$arr = array('tid'=>'','ttid' => $ttid,  'tbid' => $tbid,'tqty' => $tqty ,'tharga' => $tharga,  'tdisc' => $tdisc, 'ttotal' => $ttotal,  'tstatus' => $tstatus);
				
				//print_r($arr);die;
				
				if ($this -> penjualan_konsinyasi_detail_model -> __insert_penjualan_konsinyasi_detail($arr)) {
					__set_error_msg(array('info' => 'Data berhasil ditambahkan.'));
					
					 $this -> penjualan_konsinyasi_detail_model -> __update_penjualan_konsinyasi_details($ttid);					
					
					//redirect(site_url('penjualan_konsinyasi_details/' . $ttid .''));
					redirect(site_url('penjualan_konsinyasi_detail/penjualan_konsinyasi_detail_add/' . $id .''));
				}
				else {
					__set_error_msg(array('error' => 'Gagal menambahkan data !!!'));
					redirect(site_url('penjualan_konsinyasi_detail'));
				}
			//}
		}
		else {
		$view['customer'] = $this -> customer_lib -> __get_customer_consinyasi();		
		$pager = $this -> pagination_lib -> pagination($this -> penjualan_konsinyasi_detail_model -> __get_penjualan_konsinyasi_detail($id),3,10,site_url('penjualan_konsinyasi_detail'));
		$view['penjualan_konsinyasi_detail'] = $this -> pagination_lib -> paginate();
		$view['detail'] =
		$this -> penjualan_konsinyasi_detail_model -> __get_penjualan_konsinyasi_detailxx($id);
		$view['pages'] = $this -> pagination_lib -> pages();
		$view['id'] = $id;
		$view['buku'] = $this -> books_lib -> __get_books_all();
		
		//print_r($view['detail']);die;
		//$this->load->view('penjualan_konsinyasi_detail_add', $view);	
$this->load->view(__FUNCTION__, $view);		
	
			
		}
	}
	



	function penjualan_konsinyasi_update() {
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
					
				if ($this -> penjualan_konsinyasi_detail_model -> __update_penjualan_konsinyasis($tid,$arr)){
				__set_error_msg(array('info' => 'Data berhasil ditambahkan.'));
										
					
					//redirect(site_url('penjualan_konsinyasi_details/' . $ttid .''));
					redirect(site_url('penjualan_konsinyasi'));
				}
				else {
					__set_error_msg(array('error' => 'Gagal menambahkan data !!!'));
					redirect(site_url('penjualan_konsinyasi_detail_add'));
				}
	}

}




	
	
	
function penjualan_konsinyasi_faktur($id) {
		$view['customer'] = $this -> customer_lib -> __get_customer_consinyasi();		
		$pager = $this -> pagination_lib -> pagination($this -> penjualan_konsinyasi_detail_model -> __get_penjualan_konsinyasi_detail($id),3,10,site_url('penjualan_konsinyasi_detail'));
		$view['penjualan_konsinyasi_detail'] = $this -> pagination_lib -> paginate();
		$view['detail'] =$this -> penjualan_konsinyasi_detail_model -> __get_penjualan_konsinyasi_detailxx($id);
		$view['pages'] = $this -> pagination_lib -> pages();
		$view['id'] = $id;
		$view['buku'] = $this -> books_lib -> __get_books_all();
		//$this->load->view('penjualan_konsinyasi_detail_add', $view);	
$this->load->view('kwitansi_faktur_pk', $view, false);		
			
	}		
	
	
	
	
	
	
	
	
	
	
	
function penjualan_konsinyasi_details($id) {
	
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
				// redirect(site_url('penjualan_konsinyasi_detail' . '/' . __FUNCTION__));
			// }
			//else {
				$arr = array('tid'=>'','ttid' => $ttid,  'tbid' => $tbid,'tqty' => $tqty ,'tharga' => $tharga,  'tdisc' => $tdisc, 'ttotal' => $ttotal,  'tstatus' => $tstatus);
				if ($this -> penjualan_konsinyasi_detail_model -> __insert_penjualan_konsinyasi_detail($arr)) {
					__set_error_msg(array('info' => 'Data berhasil ditambahkan.'));
					redirect(site_url('penjualan_konsinyasi_detail/' . $ttid .''));
				}
				else {
					__set_error_msg(array('error' => 'Gagal menambahkan data !!!'));
					redirect(site_url('penjualan_konsinyasi_detail'));
				}
			//}
		}
		else {
			$view['customer'] = $this -> customer_lib -> __get_customer_consinyasi();		
			//$this->load->view(__FUNCTION__, $view);
			
			
			
		$pager = $this -> pagination_lib -> pagination($this -> penjualan_konsinyasi_detail_model -> __get_penjualan_konsinyasi_detail($id),3,10,site_url('penjualan_konsinyasi_detail'));
		$view['penjualan_konsinyasi_detail'] = $this -> pagination_lib -> paginate();
		$view['detail'] =$this -> penjualan_konsinyasi_detail_model -> __get_penjualan_konsinyasi_detailxx($id);
		$view['pages'] = $this -> pagination_lib -> pages();
		$view['id'] = $id;
		$view['buku'] = $this -> books_lib -> __get_books_all();
		//$this->load->view('penjualan_konsinyasi_detail_add', $view);	
$this->load->view('penjualan_konsinyasi_details', $view);		
			
			
			
			
			
			
			
			
			
		}
	}	
	
	
	
	function penjualan_konsinyasi_detail_update($id) {
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
					redirect(site_url('penjualan_konsinyasi_detail' . '/' . __FUNCTION__ . '/' . $id));
				}
				else {
					$arr = array('bname' => $name, 'bnpwp' => $npwp, 'baddr' => $addr, 'bcity' => $city, 'bprovince' => $prov, 'bphone' => $phone1 . '*' . $phone2, 'bstatus' => $status);
					if ($this -> penjualan_konsinyasi_detail_model -> __update_penjualan_konsinyasi_detail($id, $arr)) {	
						__set_error_msg(array('info' => 'Data berhasil diubah.'));
						redirect(site_url('penjualan_konsinyasi_detail'));
					}
					else {
						__set_error_msg(array('error' => 'Gagal mengubah data !!!'));
						redirect(site_url('penjualan_konsinyasi_detail'));
					}
				}
			}
			else {
				__set_error_msg(array('error' => 'Kesalahan input data !!!'));
				redirect(site_url('penjualan_konsinyasi_detail'));
			}
		}
		else {
			$view['id'] = $id;
			$view['detail'] = $this -> penjualan_konsinyasi_detail_model -> __get_penjualan_konsinyasi_detail_detail($id);
			$this->load->view(__FUNCTION__, $view);
		}
	}
	
	function penjualan_konsinyasi_detail_delete($id) {
		if ($this -> penjualan_konsinyasi_detail_model -> __delete_penjualan_konsinyasi_detail($id)) {
			__set_error_msg(array('info' => 'Data berhasil dihapus.'));
			redirect(site_url('penjualan_konsinyasi_detail'));
		}
		else {
			__set_error_msg(array('error' => 'Gagal hapus data !!!'));
			redirect(site_url('penjualan_konsinyasi_detail'));
		}
	}
}
