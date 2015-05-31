<?php
/* -*- tab-width: 2; indent-tabs-mode: nil; c-basic-offset: 2 -*- */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {
	function __construct() {
		parent::__construct();
		$this -> load -> library('pagination_lib');
		$this -> load -> model('pembelian_spo_detail_model');
		$this -> load -> library('customer/customer_lib');
		$this -> load -> library('books/books_lib');
	}

	function index($id) {
	
		$view['customer'] = $this -> customer_lib -> __get_customer_consinyasi();		
		$pager = $this -> pagination_lib -> pagination($this -> pembelian_spo_detail_model -> __get_pembelian_spo_detail($id),3,10,site_url('pembelian_spo_detail'));
		$view['pembelian_spo_detail'] = $this -> pagination_lib -> paginate();
		$view['detail'] =$this -> pembelian_spo_detail_model -> __get_pembelian_spo_detailxx($id);
		$view['pages'] = $this -> pagination_lib -> pages();
		$view['id'] = $id;
		$view['buku'] = $this -> books_lib -> __get_books_all();
				
		$this->load->view('pembelian_spo_detail', $view);	
		
		//$this->load->view(__FUNCTION__, $view);	
		
	}
	
	
function pembelian_spo_detail($id) {
	
		
		$view['customer'] = $this -> customer_lib -> __get_customer_consinyasi();		
		$pager = $this -> pagination_lib -> pagination($this -> pembelian_spo_detail_model -> __get_pembelian_spo_detail($id),3,10,site_url('pembelian_spo_detail'));
		$view['pembelian_spo_detail'] = $this -> pagination_lib -> paginate();
		$view['detail'] =$this -> pembelian_spo_detail_model -> __get_pembelian_spo_detailxx($id);
		$view['pages'] = $this -> pagination_lib -> pages();
		$view['id'] = $id;
		$view['buku'] = $this -> books_lib -> __get_books_all();
				
		$this->load->view(__FUNCTION__, $view);		
	
			
		
	}
	

	
	
	
	function pembelian_spo_detail_add($id) {
	
		if ($_POST) {
			
			
		$id = $this -> input -> post('id', TRUE);
		$tpid = $this -> input -> post('tpid', TRUE);


			$ttid = $this -> input -> post('ttid', TRUE);
			$tbidx = $this -> input -> post('tbid', TRUE);
			$tbidz=explode("-",$tbidx);
			$tbid=$tbidz[0];
			$tharga=$tbidz[1];
			$tdisc=$tbidz[2];
			
		
			
			$tqty = $this -> input -> post('tqty', TRUE);
			$ttotal = $tqty*($tharga-($tharga*$tdisc/100));			
			$tstatus = (int) $this -> input -> post('tstatus');
			
			
			// if (!$name || !$npwp || !$addr || !$phone1 || !$phone2 || !$city || !$prov) {
				// __set_error_msg(array('error' => 'Data yang anda masukkan tidak lengkap !!!'));
				// redirect(site_url('pembelian_spo_detail' . '/' . __FUNCTION__));
			// }
			//else {
				$arr = array('tid'=>'','ttid' => $ttid,  'tbid' => $tbid,'tqty' => $tqty ,'tharga' => $tharga,  'tdisc' => $tdisc, 'ttotal' => $ttotal,  'tstatus' => $tstatus);
				if ($this -> pembelian_spo_detail_model -> __insert_pembelian_spo_detail($arr)) {
					__set_error_msg(array('info' => 'Data berhasil ditambahkan.'));
					
					 $this -> pembelian_spo_detail_model -> __update_pembelian_spo_details($ttid);					
					

					redirect(site_url('pembelian_spo_detail/pembelian_spo_detail_add/' . $id .'/'.$tpid));
				}
				else {
					__set_error_msg(array('error' => 'Gagal menambahkan data !!!'));
					redirect(site_url('pembelian_spo_detail'));
				}
			//}
		}
		else {
			
		//$view['customer'] = $this -> customer_lib -> __get_customer_consinyasi();		
		$pager = $this -> pagination_lib -> pagination($this -> pembelian_spo_detail_model -> __get_pembelian_spo_detail($id),3,10,site_url('pembelian_spo_detail'));
		$view['pembelian_spo_detail'] = $this -> pagination_lib -> paginate();
		$view['detail'] =$this -> pembelian_spo_detail_model -> __get_pembelian_spo_detailxx($id);
		$view['pages'] = $this -> pagination_lib -> pages();
		$view['id'] = $id;
		$view['buku'] = $this -> books_lib -> __get_books_all();
				//print_r($view);die;
		$this->load->view(__FUNCTION__, $view);		
	
			
		}
	}
	



	function pembelian_spo_update() {
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
					
				if ($this -> pembelian_spo_detail_model -> __update_pembelian_spo($tid,$arr)){
				__set_error_msg(array('info' => 'Data berhasil ditambahkan.'));
										
					
					//redirect(site_url('pembelian_spo_details/' . $ttid .''));
					redirect(site_url('pembelian_spo'));
				}
				else {
					__set_error_msg(array('error' => 'Gagal menambahkan data !!!'));
					redirect(site_url('pembelian_spo_detail_add'));
				}
	}

}




	
	
	
function pembelian_spo_faktur($id) {
		$view['customer'] = $this -> customer_lib -> __get_customer_consinyasi();		
		$pager = $this -> pagination_lib -> pagination($this -> pembelian_spo_detail_model -> __get_pembelian_spo_detail($id),3,10,site_url('pembelian_spo_detail'));
		$view['pembelian_spo_detail'] = $this -> pagination_lib -> paginate();
		$view['detail'] =$this -> pembelian_spo_detail_model -> __get_pembelian_spo_detailxx($id);
		$view['pages'] = $this -> pagination_lib -> pages();
		$view['id'] = $id;
		$view['buku'] = $this -> books_lib -> __get_books_all();
		//$this->load->view('pembelian_spo_detail_add', $view);	
//$this->load->view('kwitansi_faktur', $view, false);		
$this->load->view('fakturpn', $view, false);				
	}		
	
	
	
	
	
	
	
	
	
	
	
function pembelian_spo_details($id) {
	
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
				// redirect(site_url('pembelian_spo_detail' . '/' . __FUNCTION__));
			// }
			//else {
				$arr = array('tid'=>'','ttid' => $ttid,  'tbid' => $tbid,'tqty' => $tqty ,'tharga' => $tharga,  'tdisc' => $tdisc, 'ttotal' => $ttotal,  'tstatus' => $tstatus);
				if ($this -> pembelian_spo_detail_model -> __insert_pembelian_spo_detail($arr)) {
					__set_error_msg(array('info' => 'Data berhasil ditambahkan.'));
					redirect(site_url('pembelian_spo_detail/' . $ttid .''));
				}
				else {
					__set_error_msg(array('error' => 'Gagal menambahkan data !!!'));
					redirect(site_url('pembelian_spo_detail'));
				}
			//}
		}
		else {
			$view['customer'] = $this -> customer_lib -> __get_customer_consinyasi();		
			//$this->load->view(__FUNCTION__, $view);
			
			
			
		$pager = $this -> pagination_lib -> pagination($this -> pembelian_spo_detail_model -> __get_pembelian_spo_detail($id),3,10,site_url('pembelian_spo_detail'));
		$view['pembelian_spo_detail'] = $this -> pagination_lib -> paginate();
		$view['detail'] =$this -> pembelian_spo_detail_model -> __get_pembelian_spo_detailxx($id);
		$view['pages'] = $this -> pagination_lib -> pages();
		$view['id'] = $id;
		$view['buku'] = $this -> books_lib -> __get_books_all();
		//$this->load->view('pembelian_spo_detail_add', $view);	
$this->load->view('pembelian_spo_details', $view);		
			
			
			
			
			
			
			
			
			
		}
	}	
	
	
	
	function pembelian_spo_detail_update($id) {
	//echo $id;
		if ($_POST) {
			// print_r($_POST);die;
			$no_penerimaan = $this -> input -> post('no_penerimaan', TRUE);
			// $tid = $this -> input -> post('tid', TRUE);
			// $qty = $this -> input -> post('qty', TRUE);
			$id = (int) $this -> input -> post('id');
			$id_penerbit = (int) $this -> input -> post('id_penerbit');

			$ttotalqty=0;
			$jum=count($_POST['qty']);
			echo count($_POST['qty']);
			// print_r($_POST);die;
				for($j=0;$j<$jum;$j++){
					$tid=$_POST['tid'][$j];
					$qty=$_POST['qty'][$j];
					
echo "<br>".$tid."<br>";
					$arr = array('tqty' => $qty );						
					
						$this -> pembelian_spo_detail_model ->  __update_pembelian_spo_detail($tid, $arr);
						$ttotalqty=$ttotalqty+$qty;
				}
$arrx = array('tnofaktur' => $no_penerimaan,'ttotalqty'=>$ttotalqty );
$this -> pembelian_spo_detail_model ->  __update_pembelian_spo($id, $arrx);

redirect(site_url('pembelian_spo_detail/pembelian_spo_detail/'.$id.'/'.$id_penerbit));













			
			// if ($id) {
				// if (!$name || !$npwp || !$addr || !$phone1 || !$phone2 || !$city || !$prov) {
					// __set_error_msg(array('error' => 'Data yang anda masukkan tidak lengkap !!!'));
					// redirect(site_url('pembelian_spo_detail' . '/' . __FUNCTION__ . '/' . $id));
				// }
				// else {
					// $arr = array('bname' => $name, 'bnpwp' => $npwp, 'baddr' => $addr, 'bcity' => $city, 'bprovince' => $prov, 'bphone' => $phone1 . '*' . $phone2, 'bstatus' => $status);
					// if ($this -> pembelian_spo_detail_model -> __update_pembelian_spo_detail($id, $arr)) {	
						// __set_error_msg(array('info' => 'Data berhasil diubah.'));
						// redirect(site_url('pembelian_spo_detail'));
					// }
					// else {
						// __set_error_msg(array('error' => 'Gagal mengubah data !!!'));
						// redirect(site_url('pembelian_spo_detail'));
					// }
				// }
			// }
			// else {
				// __set_error_msg(array('error' => 'Kesalahan input data !!!'));
				// redirect(site_url('pembelian_spo_detail'));
			// }
		}
		else {
	
		$pager = $this -> pagination_lib -> pagination($this -> pembelian_spo_detail_model -> __get_pembelian_spo_detail($id),3,10,site_url('pembelian_spo_detail'));
		$view['pembelian_spo_detail'] = $this -> pagination_lib -> paginate();
		$view['detail'] =$this -> pembelian_spo_detail_model -> __get_pembelian_spo_detailxx($id);
		$view['pages'] = $this -> pagination_lib -> pages();
		$view['id'] = $id;
		//echo "xxz";die;	
			// $view['id'] = $id;
			// $view['detail'] = $this -> pembelian_spo_detail_model -> __get_pembelian_spo_detail_detail($id);
			$this->load->view('pembelian_spo_detail_update', $view);
			
			
			
			
			
			
			
			
			
			
			
			
		}
	}
	
	function pembelian_spo_detail_delete($id) {
		$idd=$this->uri->segment(4);
		$pid=$this->uri->segment(5);
		if ($this -> pembelian_spo_detail_model -> __delete_pembelian_spo_detail($id)) {
			__set_error_msg(array('info' => 'Data berhasil dihapus.'));
			redirect(site_url('pembelian_spo_detail/pembelian_spo_detail/'.$idd.'/'.$pid));
		}
		else {
			__set_error_msg(array('error' => 'Gagal hapus data !!!'));
			redirect(site_url('pembelian_spo_detail'));
		}
	}
}
