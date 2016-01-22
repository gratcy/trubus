<?php
/* -*- tab-width: 2; indent-tabs-mode: nil; c-basic-offset: 2 -*- */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {
	function __construct() {
		parent::__construct();
		$this -> load -> library('pagination_lib');
		$this -> load -> model('retur_jk_detail_model');
		$this -> load -> model('penjualan_konsinyasi_detail/penjualan_konsinyasi_detail_model');
		$this -> load -> library('customer/customer_lib');
		$this -> load -> model('customer/customer_model');
		$this -> load -> library('books/books_lib');
	}

	function index($id) {
	
		$pager = $this -> pagination_lib -> pagination($this -> retur_jk_detail_model -> __get_retur_jk_detail($id),3,10,site_url('retur_jk_detail'));
		$view['retur_jk_detail'] = $this -> pagination_lib -> paginate();
		$view['pages'] = $this -> pagination_lib -> pages();
		$view['id'] = $id;
		$view['detail'] =$this -> retur_jk_detail_model -> __get_retur_jk_detailxx($id);
		$this->load->view('retur_jk_detail', $view);
		
		
		
	}
	
	function retur_jk_detail_add($id) {
	
		if ($_POST) {
			$ttanggal = $this -> input -> post('ttanggal', TRUE);
		$id = $this -> input -> post('id', TRUE);
		    $cid = $this -> input -> post('cid', TRUE);
			$ttid = $this -> input -> post('ttid', TRUE);
			$tbidx = $this -> input -> post('tbid', TRUE);
			$tbidz=explode("-",$tbidx);
			$tbid=$tbidz[0];
			$tharga=$tbidz[1];
			$tdisc=$tbidz[2];
			

			$tharga = $this -> input -> post('tharga', TRUE);
			$tdisc = $this -> input -> post('tdisc', TRUE);				
			$tqty = $this -> input -> post('tqty', TRUE);
			$ttharga=$tharga*$tqty;
			$ttotal = $tqty*($tharga-($tharga*$tdisc/100));			
			$tstatus = (int) $this -> input -> post('tstatus');
			$cold = $this -> input -> post('cold', TRUE);

			$arr = array('tid'=>'','ttid' => $ttid,  'tbid' => $tbid,'tqty' => $tqty ,'tharga' => $tharga, 'ttharga'=>$ttharga, 'tdisc' => $tdisc, 'ttotal' => $ttotal,  'tstatus' => $tstatus);
            $ars=array('tid'=>'','ttid' => $ttid,'cid'=>$cid,'type_trans'=>2,'type_pay'=>1,'bid'=>$tbid,
			'pid'=>'','qty_cid'=>$tqty,'qty_from_pid'=>'','qty_to_cid'=>'',
			'qty_from_cid'=>'','selisih'=>'','ket_selisih'=>'');
			
			$cust = false;
			if ($cold != $cid) {
				$tax = $this -> customer_model -> __get_customer_tax($cid);
				$this -> retur_jk_detail_model -> __update_retur_jks($id,array('tcid' => $cid, 'ttax' => $tax[0] -> ctax));
				$cust = true;
			}				
			
			if ($tbidx) {
			$arrm=array('ibcid'=>$cid,'ibid'=>$tbid,'itype'=>2,'istockbegining'=>0,'istockin'=>0,
			'istockout'=>0,'istockretur'=>0,'istockreject'=>0,'istock'=>0);
				//print_r($arr);die;
				if ($this -> retur_jk_detail_model -> __insert_retur_jk_detail($arr)) {
				//$this -> retur_jk_detail_model -> __insert_retur_jk_detailp($ars);	
					__set_error_msg(array('info' => 'Data berhasil ditambahkan.'));
					$this -> penjualan_konsinyasi_detail_model ->cek_stock_bookcust($cid,$tbid,$arrm);
					 $this -> retur_jk_detail_model -> __update_retur_jk_details($ttid);					
					
					//redirect(site_url('retur_jk_details/' . $ttid .''));
					redirect(site_url('retur_jk_detail/retur_jk_detail_add/' . $id .''));
				}
				else {
					__set_error_msg(array('error' => 'Gagal menambahkan data !!!'));
					redirect(site_url('retur_jk_detail'));
				}
			}
			else {
				$this -> retur_jk_detail_model -> __update_retur_jks($id, array('ttanggal'=>$ttanggal));
				if ($cust == true) {
					__set_error_msg(array('info' => 'Data berhasil diubah.'));
					redirect(site_url('retur_jk_detail/retur_jk_detail_add/' . $id .''));
				}
				else {
					__set_error_msg(array('info' => 'Data berhasil di ubah'));
					redirect(site_url('retur_jk_detail/retur_jk_detail_add/' . $id));
				}
			}
		}
		else {
		//$view['customer'] = $this -> customer_lib -> __get_customer_consinyasi();		
		$view['retur_jk_detail'] = $this -> retur_jk_detail_model -> __get_retur_jk_detail($id,2);
		$view['detail'] = $this -> retur_jk_detail_model -> __get_retur_jk_detailxx($id);
		$view['customer'] = $this -> customer_lib -> __get_customer($view['detail'][0] -> tcid);
		$view['pages'] = $this -> pagination_lib -> pages();
		$view['id'] = $id;
		$view['buku'] = $this -> books_lib -> __get_books_all();
		
		//print_r($view['detail']);die;
		//$this->load->view('retur_jk_detail_add', $view);	
$this->load->view(__FUNCTION__, $view);		
	
			
		}
	}
	



	function retur_jk_update($id) {
	$arr=array('');
		if ($_POST) {


			$ttid = $this -> input -> post('ttid', TRUE);
			$tid = $this -> input -> post('tid', TRUE);
			$tinfo = $this -> input -> post('tinfo', TRUE);
			$tgrandtotal = $this -> input -> post('tgrandtotal', TRUE);
			$ttotaldisc = $this -> input -> post('ttotaldisc', TRUE);
			$jum=count($_POST['tidx']);

		for($j=0;$j<$jum;$j++){	
			$tidx = $_POST['tidx'][$j];
			$tbid = $_POST['tbid'][$j];
			$qty_to_cid = $_POST['qty_to_cid'][$j];
			$thargaa = $_POST['thargaa'][$j];
			$tdiscc = $_POST['tdiscc'][$j];
			$tthargaa=$thargaa*$qty_to_cid;
			$ttotall=$tthargaa-(($tthargaa*$tdiscc)/100);


				$arrd = array('tqty' => $qty_to_cid, 'tharga' => $thargaa ,'tdisc'=>$tdiscc,
				'ttharga'=>$tthargaa,'ttotal'=>$ttotall );
					
				if ($this -> retur_jk_detail_model -> __update_retur_jk_detailz($tidx,$arrd)){
				__set_error_msg(array('info' => 'Data berhasil ditambahkan.'));

				}

			}	

			$this -> retur_jk_detail_model -> __update_retur_jk_details($id);
			$tid = $this -> input -> post('tid', TRUE);
			$tinfo = $this -> input -> post('tinfo', TRUE);


				$arr = array('tinfo'=>$tinfo );
					
				if ($this -> retur_jk_detail_model -> __update_retur_jks($tid,$arr)){
				__set_error_msg(array('info' => 'Data berhasil ditambahkan.'));

					//redirect(site_url('retur_jk'));
					redirect(site_url('retur_jk_detail/retur_jk_detail_add/' . $id .''));
				}
				else {
					__set_error_msg(array('error' => 'Gagal menambahkan data !!!'));
					redirect(site_url('retur_jk_detail_add'));
				}
	}

}

	
	function retur_jk_faktur($id) {
		$view['customer'] = $this -> customer_lib -> __get_customer_consinyasi();		
		$pager = $this -> pagination_lib -> pagination($this -> retur_jk_detail_model -> __get_retur_jk_detail($id),3,10,site_url('retur_jk_detail'));
		$view['retur_jk_detail'] = $this -> pagination_lib -> paginate();
		$view['detail'] =$this -> retur_jk_detail_model -> __get_retur_jk_detailxx($id);
		$view['pages'] = $this -> pagination_lib -> pages();
		$view['id'] = $id;
		$view['buku'] = $this -> books_lib -> __get_books_all();
		//$this->load->view('retur_jk_detail_add', $view);	
		//$this->load->view('kwitansi_faktur_pk', $view, false);		
		// $this->load->view('faktur5', $view, false);	
		$view['hostname']=$this->db->hostname;
		$view['username']=$this->db->username;
		$view['password']=$this->db->password;
		$view['database']=$this->db->database;	
		$this->load->view('prinanrjk', $view, false);	
	}		
	
	function faktur_pk($id) {
		$view['customer'] = $this -> customer_lib -> __get_customer_consinyasi();		
		$pager = $this -> pagination_lib -> pagination($this -> retur_jk_detail_model -> __get_retur_jk_detail($id),3,10,site_url('retur_jk_detail'));
		$view['retur_jk_detail'] = $this -> pagination_lib -> paginate();
		$view['detail'] =$this -> retur_jk_detail_model -> __get_retur_jk_detailxx($id);
		$view['pages'] = $this -> pagination_lib -> pages();
		$view['id'] = $id;
		$view['buku'] = $this -> books_lib -> __get_books_all();
		//$this->load->view('retur_jk_detail_add', $view);	
		$this->load->view('faktur_pk', $view, false);		
			
	}		
	
	
	
	
	
	
	
	
	
function retur_jk_details($id) {
	
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
			
			

				$arr = array('tid'=>'','ttid' => $ttid,  'tbid' => $tbid,'tqty' => $tqty ,'tharga' => $tharga,  'tdisc' => $tdisc, 'ttotal' => $ttotal,  'tstatus' => $tstatus);
				if ($this -> retur_jk_detail_model -> __insert_retur_jk_detail($arr)) {
					__set_error_msg(array('info' => 'Data berhasil ditambahkan.'));
					redirect(site_url('retur_jk_detail/' . $ttid .''));
				}
				else {
					__set_error_msg(array('error' => 'Gagal menambahkan data !!!'));
					redirect(site_url('retur_jk_detail'));
				}
			//}
		}
		else {
		if ($this->uri->segment(3) == FALSE) $view['pPages'] = 0;
		else $view['pPages'] = ($this->uri->segment(3)-1)* 10;
		$pager = $this -> pagination_lib -> pagination($this -> retur_jk_detail_model -> __get_retur_jk_detail($id),3,10,site_url('retur_jk_details/'.$id));
		$view['retur_jk_detail'] = $this -> pagination_lib -> paginate();
		$view['detail'] =$this -> retur_jk_detail_model -> __get_retur_jk_detailxx($id);
		$view['customer'] = $this -> customer_lib -> __get_customer($view['detail'][0] -> tcid);	
		$view['pages'] = $this -> pagination_lib -> pages();
		$view['id'] = $id;
		$view['buku'] = $this -> books_lib -> __get_books_all();
		$this->load->view('retur_jk_details', $view);		
	
			
		}
	}	
	


	function retur_jk_detail_approval1($id) {
		//echo "xxx";die;
				if ($this -> retur_jk_detail_model -> __update_penjualan_approval1($id)){
				__set_error_msg(array('info' => 'Approval1 berhasil.'));

					redirect(site_url('retur_jk_details/'.$id));
				}else{
					
					redirect(site_url('retur_jk_details/'.$id));
				}
					
		
	}






	
	function retur_jk_detail_approval2($id) {
		//echo "xxx";die;
				if ($this -> retur_jk_detail_model -> __update_penjualan_approval2($id)){
				__set_error_msg(array('info' => 'Approval2 berhasil.'));

					redirect(site_url('retur_jk_details/'.$id));
				}
						
		
	}
	function retur_jk_detail_update($id) {
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
					redirect(site_url('retur_jk_detail' . '/' . __FUNCTION__ . '/' . $id));
				}
				else {
					$arr = array('bname' => $name, 'bnpwp' => $npwp, 'baddr' => $addr, 'bcity' => $city, 'bprovince' => $prov, 'bphone' => $phone1 . '*' . $phone2, 'bstatus' => $status);
					if ($this -> retur_jk_detail_model -> __update_retur_jk_detail($id, $arr)) {	
						__set_error_msg(array('info' => 'Data berhasil diubah.'));
						redirect(site_url('retur_jk_detail'));
					}
					else {
						__set_error_msg(array('error' => 'Gagal mengubah data !!!'));
						redirect(site_url('retur_jk_detail'));
					}
				}
			}
			else {
				__set_error_msg(array('error' => 'Kesalahan input data !!!'));
				redirect(site_url('retur_jk_detail'));
			}
		}
		else {
			$view['id'] = $id;
			$view['detail'] = $this -> retur_jk_detail_model -> __get_retur_jk_detail_detail($id);
			$this->load->view(__FUNCTION__, $view);
		}
	}
	
	function retur_jk_detail_delete($id,$ttid) {
		if ($this -> retur_jk_detail_model -> __delete_retur_jk_detail($id)) {
			__set_error_msg(array('info' => 'Data berhasil dihapus.'));
			redirect(site_url('retur_jk_detail/retur_jk_detail_add/'.$ttid));
		}
		else {
			__set_error_msg(array('error' => 'Gagal hapus data !!!'));
			redirect(site_url('retur_jk_detail/retur_jk_detail_add/'.$ttid));
		}
	}
}
