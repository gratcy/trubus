<?php
/* -*- tab-width: 2; indent-tabs-mode: nil; c-basic-offset: 2 -*- */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {
	function __construct() {
		parent::__construct();
		$this -> load -> library('pagination_lib');
		$this -> load -> model('hasil_penjualan_detail_model');
		$this -> load -> library('customer/customer_lib');
		$this -> load -> library('books/books_lib');
	}

	function index($id) {
	
		$pager = $this -> pagination_lib -> pagination($this -> hasil_penjualan_detail_model -> __get_hasil_penjualan_detail($id),3,10,site_url('hasil_penjualan_detail'));
		$view['hasil_penjualan_detail'] = $this -> pagination_lib -> paginate();
		$view['pages'] = $this -> pagination_lib -> pages();
		$view['id'] = $id;
		$view['detail'] =$this -> hasil_penjualan_detail_model -> __get_hasil_penjualan_detailxx($id);
		$this->load->view('hasil_penjualan_detail', $view);
		
		
		
	}
	
	function hasil_penjualan_detail_add($id) {
	
		if ($_POST) {
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
			

				$arr = array('tid'=>'','ttid' => $ttid,  'tbid' => $tbid,'tqty' => $tqty ,'tharga' => $tharga, 'ttharga'=>$ttharga, 'tdisc' => $tdisc, 'ttotal' => $ttotal,  'tstatus' => $tstatus);
            $ars=array('tid'=>'','ttid' => $ttid,'cid'=>$cid,'type_trans'=>1,'type_pay'=>1,'bid'=>$tbid,
			'pid'=>'','qty_cid'=>$tqty,'qty_from_pid'=>'','qty_to_cid'=>'',
			'qty_from_cid'=>'','selisih'=>'','ket_selisih'=>'');
				//print_r($arr);die;
				if ($this -> hasil_penjualan_detail_model -> __insert_hasil_penjualan_detail($arr)) {
				$this -> hasil_penjualan_detail_model -> __insert_hasil_penjualan_detailp($ars);	
					__set_error_msg(array('info' => 'Data berhasil ditambahkan.'));
					
					 $this -> hasil_penjualan_detail_model -> __update_hasil_penjualan_details($ttid);					
					
					redirect(site_url('hasil_penjualan_detail/hasil_penjualan_detail_add/' . $id .''));
				}
				else {
					__set_error_msg(array('error' => 'Gagal menambahkan data !!!'));
					redirect(site_url('hasil_penjualan_detail'));
				}
		}
		else {
		$view['customer'] = $this -> customer_lib -> __get_customer_consinyasi();		
		$view['hasil_penjualan_detail'] = $this -> hasil_penjualan_detail_model -> __get_hasil_penjualan_detail($id,2);
		$view['detail'] = $this -> hasil_penjualan_detail_model -> __get_hasil_penjualan_detailxx($id);
		$view['pages'] = $this -> pagination_lib -> pages();
		$view['id'] = $id;
		$view['buku'] = $this -> books_lib -> __get_books_all();
		$this->load->view('hasil_penjualan_detail_add', $view);	
		}
	}
	



	function hasil_penjualan_update($id) {

		if ($_POST) {

			$ttid = $this -> input -> post('ttid', TRUE);
			$tid = $this -> input -> post('tid', TRUE);
			$tinfo = $this -> input -> post('tinfo', TRUE);
			$tgrandtotal = $this -> input -> post('tgrandtotal', TRUE);
			$ttotaldisc = $this -> input -> post('ttotaldisc', TRUE);
			$jum=$this -> input -> post('jumbk', TRUE);
			
//echo $jum.'xxx';die;
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
			//print_r($arrd);die;		
				if ($this -> hasil_penjualan_detail_model -> __update_hasil_penjualan_detailz($tidx,$arrd)){
				__set_error_msg(array('info' => 'Data berhasil ditambahkan.'));

				}

			}	

			$this -> hasil_penjualan_detail_model -> __update_hasil_penjualan_details($id);
			$tid = $this -> input -> post('tid', TRUE);
			$tinfo = $this -> input -> post('tinfo', TRUE);


				$arr = array('tinfo'=>$tinfo );
					
				if ($this -> hasil_penjualan_detail_model -> __update_hasil_penjualans($tid,$arr)){
				__set_error_msg(array('info' => 'Data berhasil ditambahkan.'));

					redirect(site_url('hasil_penjualan'));
				}
				else {
					__set_error_msg(array('error' => 'Gagal menambahkan data !!!'));
					redirect(site_url('hasil_penjualan_detail_add'));
				}
	}

}

	
	function hasil_penjualan_faktur($id) {
		
		$view['customer'] = $this -> customer_lib -> __get_customer_consinyasi();		
		$pager = $this -> pagination_lib -> pagination($this -> hasil_penjualan_detail_model -> __get_hasil_penjualan_detail($id),3,10,site_url('hasil_penjualan_detail'));
		$view['hasil_penjualan_detail'] = $this -> pagination_lib -> paginate();
		$view['detail'] =$this -> hasil_penjualan_detail_model -> __get_hasil_penjualan_detailxx($id);
		$view['pages'] = $this -> pagination_lib -> pages();
		$view['id'] = $id;
		$view['buku'] = $this -> books_lib -> __get_books_all();
		$view['hostname']=$this->db->hostname;
		$view['username']=$this->db->username;
		$view['password']=$this->db->password;
		$view['database']=$this->db->database;		
		$this->load->view('prinanhp', $view, false);
	}		
	
	function faktur_pk($id) {
		$view['customer'] = $this -> customer_lib -> __get_customer_consinyasi();		
		$pager = $this -> pagination_lib -> pagination($this -> hasil_penjualan_detail_model -> __get_hasil_penjualan_detail($id),3,10,site_url('hasil_penjualan_detail'));
		$view['hasil_penjualan_detail'] = $this -> pagination_lib -> paginate();
		$view['detail'] =$this -> hasil_penjualan_detail_model -> __get_hasil_penjualan_detailxx($id);
		$view['pages'] = $this -> pagination_lib -> pages();
		$view['id'] = $id;
		$view['buku'] = $this -> books_lib -> __get_books_all();
		$this->load->view('faktur_pk', $view, false);		
			
	}		
	
	
	
	
	
	
	
	
	
function hasil_penjualan_details($id) {
	
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
				if ($this -> hasil_penjualan_detail_model -> __insert_hasil_penjualan_detail($arr)) {
					__set_error_msg(array('info' => 'Data berhasil ditambahkan.'));
					redirect(site_url('hasil_penjualan_detail/' . $ttid .''));
				}
				else {
					__set_error_msg(array('error' => 'Gagal menambahkan data !!!'));
					redirect(site_url('hasil_penjualan_detail'));
				}
		}
		else {
		if ($this->uri->segment(3) == FALSE) $view['pPages'] = 0;
		else $view['pPages'] = ($this->uri->segment(3)-1) * 10;
		$pager = $this -> pagination_lib -> pagination($this -> hasil_penjualan_detail_model -> __get_hasil_penjualan_detail($id),3,10,site_url('hasil_penjualan_details/'.$id));
		$view['hasil_penjualan_detail'] = $this -> pagination_lib -> paginate();
		$view['detail'] =$this -> hasil_penjualan_detail_model -> __get_hasil_penjualan_detailxx($id);
		$view['customer'] = $this -> customer_lib -> __get_customer($view['detail'][0] -> tcid);
		$view['pages'] = $this -> pagination_lib -> pages();
		$view['id'] = $id;
		$view['buku'] = $this -> books_lib -> __get_books_all();
		$this->load->view('hasil_penjualan_details', $view);		
	
			
		}
	}	
	


	function hasil_penjualan_detail_approval1($id) {
				if ($this -> hasil_penjualan_detail_model -> __update_penjualan_approval1($id)){
				__set_error_msg(array('info' => 'Approval1 berhasil.'));

					redirect(site_url('hasil_penjualan_details/'.$id));
				}else{
					
					redirect(site_url('hasil_penjualan_details/'.$id));
				}
					
		
	}






	
	function hasil_penjualan_detail_approval2($id) {
				if ($this -> hasil_penjualan_detail_model -> __update_penjualan_approval2($id)){
				__set_error_msg(array('info' => 'Approval2 berhasil.'));

					redirect(site_url('hasil_penjualan_details/'.$id));
				}
						
		
	}
	function hasil_penjualan_detail_update($id) {
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
					redirect(site_url('hasil_penjualan_detail' . '/' . __FUNCTION__ . '/' . $id));
				}
				else {
					$arr = array('bname' => $name, 'bnpwp' => $npwp, 'baddr' => $addr, 'bcity' => $city, 'bprovince' => $prov, 'bphone' => $phone1 . '*' . $phone2, 'bstatus' => $status);
					if ($this -> hasil_penjualan_detail_model -> __update_hasil_penjualan_detail($id, $arr)) {	
						__set_error_msg(array('info' => 'Data berhasil diubah.'));
						redirect(site_url('hasil_penjualan_detail'));
					}
					else {
						__set_error_msg(array('error' => 'Gagal mengubah data !!!'));
						redirect(site_url('hasil_penjualan_detail'));
					}
				}
			}
			else {
				__set_error_msg(array('error' => 'Kesalahan input data !!!'));
				redirect(site_url('hasil_penjualan_detail'));
			}
		}
		else {
			$view['id'] = $id;
			$view['detail'] = $this -> hasil_penjualan_detail_model -> __get_hasil_penjualan_detail_detail($id);
			$this->load->view(__FUNCTION__, $view);
		}
	}
	
	function hasil_penjualan_detail_delete($id,$idx) {
		if ($this -> hasil_penjualan_detail_model -> __delete_hasil_penjualan_detail($id)) {
			__set_error_msg(array('info' => 'Data berhasil dihapus.'));
			redirect(site_url('hasil_penjualan_detail/hasil_penjualan_detail_add/'.$idx));
		}
		else {
			__set_error_msg(array('error' => 'Gagal hapus data !!!'));
			redirect(site_url('hasil_penjualan_detail'));
		}
	}
}
