<?php
/* -*- tab-width: 2; indent-tabs-mode: nil; c-basic-offset: 2 -*- */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {
	function __construct() {
		parent::__construct();
		$this -> load -> library('pagination_lib');
		$this -> load -> model('retur_bk_detail_model');
		$this -> load -> library('customer/customer_lib');
		$this -> load -> library('books/books_lib');
	}

	function index($id) {	
		$view['customer'] = $this -> customer_lib -> __get_customer_consinyasi();		
		$pager = $this -> pagination_lib -> pagination($this -> retur_bk_detail_model -> __get_retur_bk_detail($id),3,10,site_url('retur_bk_detail'));
		$view['retur_bk_detail'] = $this -> pagination_lib -> paginate();
		$view['detail'] =$this -> retur_bk_detail_model -> __get_retur_bk_detailxx($id);
		$view['pages'] = $this -> pagination_lib -> pages();
		$view['id'] = $id;
		$view['buku'] = $this -> books_lib -> __get_books_all();				
		$this->load->view('retur_bk_detail', $view);			
		//$this->load->view(__FUNCTION__, $view);	
		
	}
	
	
	function retur_bk_detail($id) {
		$view['customer'] = $this -> customer_lib -> __get_customer_consinyasi();		
		$pager = $this -> pagination_lib -> pagination($this -> retur_bk_detail_model -> __get_retur_bk_detail($id),3,10,site_url('retur_bk_detail'));
		$view['retur_bk_detail'] = $this -> pagination_lib -> paginate();
		$view['detail'] =$this -> retur_bk_detail_model -> __get_retur_bk_detailxx($id);
		$view['pages'] = $this -> pagination_lib -> pages();
		$view['id'] = $id;
		$view['buku'] = $this -> books_lib -> __get_books_all();
				
		$this->load->view(__FUNCTION__, $view);		
	
			
		
	}
	

	
	
	
	function retur_bk_detail_add($id) {	
		if ($_POST) {			
			$ttanggal = $this -> input -> post('ttanggal', TRUE);
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
			$arr = array('tid'=>'','ttid' => $ttid,  'tbid' => $tbid,'tqty' => $tqty ,'tharga' => $tharga,  'tdisc' => $tdisc, 'ttotal' => $ttotal,  'tstatus' => $tstatus);
			if ($this -> retur_bk_detail_model -> __insert_retur_bk_detail($arr)) {
				__set_error_msg(array('info' => 'Data berhasil ditambahkan.'));
				
				$this -> retur_bk_detail_model -> __update_retur_bk_details($ttid);
				redirect(site_url('retur_bk_detail/retur_bk_detail_add/' . $id .'/'.$tpid));
			}
			else {
				__set_error_msg(array('error' => 'Gagal menambahkan data !!!'));
				redirect(site_url('retur_bk_detail'));
			}

		}
		else {
			
		if ($this->uri->segment(5) == FALSE) $view['pPages'] = 0;
		else $view['pPages'] = ($this->uri->segment(5)-1)* 10;
		$pager = $this -> pagination_lib -> pagination($this -> retur_bk_detail_model -> __get_retur_bk_detail($id),3,10,site_url('retur_bk_detail/retur_bk_detail_add/' . $id.'/'.$this->uri->segment(4)));
		$view['retur_bk_detail'] = $this -> pagination_lib -> paginate();
		$view['detail'] =$this -> retur_bk_detail_model -> __get_retur_bk_detailxx($id);
		$view['pages'] = $this -> pagination_lib -> pages();
		$view['id'] = $id;
		$view['buku'] = $this -> books_lib -> __get_books_all();
				//print_r($view);die;
		$this->load->view(__FUNCTION__, $view);		
	
			
		}
	}
	



	function retur_bk_update($id) {
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
					
				if ($this -> retur_bk_detail_model -> __update_retur_bk($tid,$arr)){
				__set_error_msg(array('info' => 'Data berhasil ditambahkan.'));
				redirect(site_url('retur_bk_detail/retur_bk_detail_add/' . $id .''));
					
				}
				else {
					__set_error_msg(array('error' => 'Gagal menambahkan data !!!'));
					redirect(site_url('retur_bk_detail_add'));
				}
		}

	}	
	
	function retur_bk_faktur($id) {
		$view['customer'] = $this -> customer_lib -> __get_customer_consinyasi();		
		$pager = $this -> pagination_lib -> pagination($this -> retur_bk_detail_model -> __get_retur_bk_detail($id),3,10,site_url('retur_bk_detail'));
		$view['retur_bk_detail'] = $this -> pagination_lib -> paginate();
		$view['detail'] =$this -> retur_bk_detail_model -> __get_retur_bk_detailxx($id);
		$view['pages'] = $this -> pagination_lib -> pages();
		$view['id'] = $id;
		$view['buku'] = $this -> books_lib -> __get_books_all();

		$view['hostname']=$this->db->hostname;
		$view['username']=$this->db->username;
		$view['password']=$this->db->password;
		$view['database']=$this->db->database;	
		$this->load->view('prinanrbk', $view, false);	
	}		
	
	function retur_bk_details($id) {
	
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
			if ($this -> retur_bk_detail_model -> __insert_retur_bk_detail($arr)) {
				__set_error_msg(array('info' => 'Data berhasil ditambahkan.'));
				redirect(site_url('retur_bk_detail/' . $ttid .''));
			}
			else {
				__set_error_msg(array('error' => 'Gagal menambahkan data !!!'));
				redirect(site_url('retur_bk_detail'));
			}

		}
		else {
			$view['customer'] = $this -> customer_lib -> __get_customer_consinyasi();		
			//$this->load->view(__FUNCTION__, $view);
			
			
			
		$pager = $this -> pagination_lib -> pagination($this -> retur_bk_detail_model -> __get_retur_bk_detail($id),3,10,site_url('retur_bk_detail'));
		$view['retur_bk_detail'] = $this -> pagination_lib -> paginate();
		$view['detail'] =$this -> retur_bk_detail_model -> __get_retur_bk_detailxx($id);
		$view['pages'] = $this -> pagination_lib -> pages();
		$view['id'] = $id;
		$view['buku'] = $this -> books_lib -> __get_books_all();
		//$this->load->view('retur_bk_detail_add', $view);	
		$this->load->view('retur_bk_details', $view);		
		
		}
	}	
	
	
	
	function retur_bk_detail_update($id) {
		if ($_POST) {
			$no_penerimaan = $this -> input -> post('no_penerimaan', TRUE);
			$id = (int) $this -> input -> post('id');
			$id_penerbit = (int) $this -> input -> post('id_penerbit');

			$ttotalqty=0;
			$jum=count($_POST['qty']);

			for($j=0;$j<$jum;$j++){
				$tid=$_POST['tid'][$j];
				$qty=$_POST['qty'][$j];
				$tbid=$_POST['tbid'][$j];
				$arr = array('tqty' => $qty );							
				$this -> retur_bk_detail_model ->  __update_retur_bk_detail($tid, $arr);
				$this -> retur_bk_detail_model -> __update_penjualan_stok($id);
				$ttotalqty=$ttotalqty+$qty;
			}
			$arrx = array('tnofaktur' => $no_penerimaan,'ttotalqty'=>$ttotalqty );
			$this -> retur_bk_detail_model ->  __update_retur_bk($id, $arrx);

			redirect(site_url('retur_bk_detail/retur_bk_detail/'.$id.'/'.$id_penerbit));

		}
		else {
	
		if ($this->uri->segment(5) == FALSE) $view['pPages'] = 0;
		else $view['pPages'] = ($this->uri->segment(5)-1)* 10;
			$pager = $this -> pagination_lib -> pagination($this -> retur_bk_detail_model -> __get_retur_bk_detail($id),3,10,site_url('retur_bk_detail/retur_bk_detail_update/'.$id.'/'.$this->uri->segment(4)));
			$view['retur_bk_detail'] = $this -> pagination_lib -> paginate();
			$view['detail'] =$this -> retur_bk_detail_model -> __get_retur_bk_detailxx($id);
			$view['pages'] = $this -> pagination_lib -> pages();
			$view['id'] = $id;
			$this->load->view('retur_bk_detail_update', $view);			
		}
	}
	
	function retur_bk_detail_delete($id) {
		$idd=$this->uri->segment(4);
		$pid=$this->uri->segment(5);
		//echo $id.'-'.$idd.'-'.$pid;die;
		if ($this -> retur_bk_detail_model -> __delete_retur_bk_detail($id)) {
			__set_error_msg(array('info' => 'Data berhasil dihapus.'));
			redirect(site_url('retur_bk_detail/retur_bk_detail_update/'.$idd.'/'.$pid));
		}
		else {
			__set_error_msg(array('error' => 'Gagal hapus data !!!'));
			redirect(site_url('retur_bk_detail'));
		}
	}	
	
	function sourcex() {
		$view['hostname']=$this->db->hostname;
		$view['username']=$this->db->username;
		$view['password']=$this->db->password;
		$view['database']=$this->db->database;
		$this->load->view('sourcex',$view,FALSE);
	}
}
