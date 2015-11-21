<?php
/* -*- tab-width: 2; indent-tabs-mode: nil; c-basic-offset: 2 -*- */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {
	function __construct() {
		parent::__construct();
		$this -> load -> library('pagination_lib');
		$this -> load -> model('pembayaran_model');
		$this -> load -> model('area/area_model');
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
	
	
	function bayar_excel($id) {
		

			$view['invoice'] = $this -> pembayaran_model -> __get_invoice($id);
			$view['bayarz'] = $this -> pembayaran_model -> __get_bayar($id);
			$view['terima'] = $this -> pembayaran_model ->__get_total_terima($id);
			$view['pending'] = $this -> pembayaran_model ->__get_total_pending($id);
			$view['invid']=$id;
			$this->load->view('bayar_excel', $view,FALSE);
		
		
	}	
	
	
	function pembayaran_addx() {
		//$urlz=site_url('pembayaran/pembayaran_add/');
		header('Refresh: 1;url=pembayaran_add?');
		//redirect(site_url('pembayaran/pembayaran_add/'));
		
	}
	
	function bayar_addx($id) {
		//$urlz=site_url('pembayaran/pembayaran_add/');
		header('Refresh: 1;url=../bayar_add/'.$id.'?');
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
			$datenow=date('Y-m-d');
			
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
			$tnofaktur=$tnofakturx.$year.$mon;
			
			
			$jumt=count($_POST['fakturr']);

// echo $jumt;
// print_r($_POST);die;

		if($tinvv == "FAKTUR"){
			$gtotalx=0;
			if($jumt>0){
			for($j=0;$j<$jumt;$j++){	
				$fakturra = explode("-",$_POST['fakturr'][$j]);
				$fakturr=$fakturra[0];
				$gtotal=$fakturra[1];
				$gtotalx=$gtotalx+$gtotal;
				//$art=array('tinvid'=>'','tsbayar'=>'1');

//echo $fakturr.'--'.$tnofaktur;
					 
						//$this -> pembayaran_model ->__update_invtrans($fakturr,$art);
					
				}//die;
				
				$arr = array('invid'=>'','invno' => $tnofaktur, 'invbid' => $branchid, 'invaid' => $taid,'invcid' => $tcid,'invtax' => $ttax ,
				'invtype' => '' ,'periodfrom'=>$datefrom,'periodto'=>$dateto,
				'invdate' => $datenow ,
				'invduedate' => $ttanggal,'invtotalall'=>$gtotalx,'totalhutang'=>$gtotalx, 'invstatus' => 1 ,'desc'=>$tinfo );
				//print_r($arr);die;
					if ($this -> pembayaran_model -> __insert_pembayaran($arr)) {
					$lastid=$this->db->insert_id();		
					 $this -> pembayaran_model -> __get_total_pembayaran_monthly($mon,$yr,$lastid,$tnofaktur);				
				
				$jumb=count($_POST['fakturr']);
		for($j=0;$j<$jumb;$j++){	
				$fakturra = explode("-",$_POST['fakturr'][$j]);
				$fakturr=$fakturra[0];
				$gtotal=$fakturra[1];
				$gtotalx=$gtotalx+$gtotal;
				$art=array('tinvid'=>$lastid,'tsbayar'=>'1');

//echo $fakturr.'--'.$lastid;
					 
						$this -> pembayaran_model ->__update_invtrans($fakturr,$art);
					
				}//die;
				
				
				
						//$arb=array('tinvid'=>$lastid,'tsbayar'=>'1');					 
						//$this -> pembayaran_model ->__update_invtrans($fakturr,$arb);				
				
				 //redirect pembayaran depan
				 redirect(site_url('pembayaran'));
					}
				
			}	
			
			
			$view['bayar']=$this -> pembayaran_model -> __get_pembayaran_detailzx($taid,$tcid,$datefrom,$dateto);
			$bayarzz=$this -> pembayaran_model -> __get_pembayaran_detailz($taid,$tcid,$datefrom,$dateto);
			$gtotal= $bayarzz[0]->gtotal;			
			$view['area']=$this -> area_model -> __get_area($this -> memcachedlib -> sesresult['ubranchid']);
			
			$branchid=$this -> memcachedlib -> sesresult['ubranchid'];
			$view['customer'] = $this -> customer_lib -> __get_customer_consinyasi();
			
			$view['gudang_niaga']=$this -> pembayaran_model ->__get_gudang_niaga($branchid);
			
			$this->load->view(__FUNCTION__, $view);			
		
		}else{
			
			$bayarx=$this -> pembayaran_model -> __get_pembayaran_detailz($taid,$tcid,$datefrom,$dateto);
			//print_r($bayarx);
			$gtotalx= $bayarx[0]->gtotal;			
			//echo $gtotal.'xxx';die;
				$arr = array('invid'=>'','invno' => $tnofaktur, 'invbid' => $branchid, 'invaid' => $taid,'invcid' => $tcid,'invtax' => $ttax ,
				'invtype' => $tbayar ,'periodfrom'=>$datefrom,'periodto'=>$dateto,
				'invdate' => $datenow ,
				'invduedate' => $ttanggal,'invtotalall'=>$gtotalx,'totalhutang'=>$gtotalx, 'invstatus' => 1 ,'desc'=>$tinfo );
				if ($this -> pembayaran_model -> __insert_pembayaran($arr)) {
					// $this -> pembayaran_model -> __update_pembayaran($arru);
					__set_error_msg(array('info' => 'Data berhasil ditambahkan.'));
					
				$lastid=$this->db->insert_id();		


					 $this -> pembayaran_model -> __get_total_pembayaran_monthly($mon,$yr,$lastid,$tnofaktur);

	


            $bayar=$this -> pembayaran_model -> __get_pembayaran_detailz($taid,$tcid,$datefrom,$dateto);			
			$gtotal= $bayar[0]->gtotal;
			$ff=$this -> pembayaran_model -> __get_pembayaran_detailzx($taid,$tcid,$datefrom,$dateto);
			//print_r($ff);
			foreach ($ff as $k=>$v){
				
				$tnof= $v->tnofaktur;
				echo $tnof.'<br>';
				$art=array('tinvid'=>$lastid,'tsbayar'=>'1');
				$this -> pembayaran_model ->__update_invtrans($tnof,$art);
			}
			
	
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
 $urlz=site_url('pembayaran/pembayaran_add/');
			
			$branchid=$this -> memcachedlib -> sesresult['ubranchid'];
			$view['customer'] = $this -> customer_lib -> __get_customer_consinyasi();
			$view['area']=$this -> area_model -> __get_areax($this -> memcachedlib -> sesresult['ubranchid']);
			
			$view['gudang_niaga']=$this -> pembayaran_model ->__get_gudang_niaga($branchid);
			//print_r($view);die;
			$this->load->view(__FUNCTION__, $view);
		}
	}
	
	
	function bayar_add($id) {
		$branchid=$this -> memcachedlib -> sesresult['ubranchid'];
		if($_POST){
			$noinv=$this -> input -> post('noinv', TRUE);
			$cid=$tbayar = $this -> input -> post('cid', TRUE);
			$aid=$tbayar = $this -> input -> post('aid', TRUE);
			$tbayar = $this -> input -> post('tbayar', TRUE);
			$pbdate = $this -> input -> post('ttanggal', TRUE);
			//echo $tbayar;
			if($tbayar=='CASH'){
				//echo "a";die;
				$amountx=$this -> input -> post('amountcash', TRUE);
			}elseif($tbayar=='TRANSFER'){
				//echo "b";die;
				$amountx=$this -> input -> post('amounttrans', TRUE);
			}elseif($tbayar=='GIRO'){
				//echo "c";die;
				$amountx=$this -> input -> post('amountgiro', TRUE);
			}
			

			//die;
			
			$pbdate=date('Y-m-d');
				$arr = array('pbid'=>'','pbbid'=>$branchid,'pbnobayar' => '', 
				'invid' => $id, 'invno' => $noinv,'pbaid' => $aid ,
				'pbcid' => $cid ,'pbtype'=>$tbayar,'pbacc'=>'',
				'pbbank' => '' ,'pbnogiro' => $pbnogiro ,
				'pbsetor_to' => '','pbsetor'=>$amountx, 'pbdate' => $pbdate ,'pbsetordate'=>$pbdate,'pbstatus'=>1 );
				//print_r($arr);die;
				if ($this -> pembayaran_model -> __insert_bayar($arr)) {
					
					__set_error_msg(array('info' => 'Data berhasil ditambahkan.'));
			redirect(site_url('pembayaran/home/bayar_addx/'.$id));					
				}
			
			
			
		}
			$branchid=$this -> memcachedlib -> sesresult['ubranchid'];
			$view['invoice'] = $this -> pembayaran_model -> __get_invoice($id);
			$view['bayarz'] = $this -> pembayaran_model -> __get_bayar($id);
			$view['bayarzz'] = $this -> pembayaran_model -> __get_bayar_detail($id);
			$view['terima'] = $this -> pembayaran_model ->__get_total_terima($id);
			$view['pending'] = $this -> pembayaran_model ->__get_total_pending($id);
			$view['invid']=$id;
			$view['gudang_niaga']=$this -> pembayaran_model ->__get_gudang_niaga($branchid);
			// echo '<pre>';
			// print_r($view);
			// echo '</pre>';
			// die;
			$this->load->view(__FUNCTION__, $view);		
		
	}

	function bayar_list($id) {

		$branchid=$this -> memcachedlib -> sesresult['ubranchid'];
			$view['id']=$id;
			$view['invoice'] = $this -> pembayaran_model -> __get_invoice($id);
			$view['bayarz'] = $this -> pembayaran_model -> __get_bayar($id);
			$view['terima'] = $this -> pembayaran_model ->__get_total_terima($id);
			$view['pending'] = $this -> pembayaran_model ->__get_total_pending($id);
			$view['invid']=$id;
			//echo "aa";die;
			//print_r($view);
			$this->load->view(__FUNCTION__, $view);	
	}

	
	function bayar_approve($invid,$pbid) {
		$branchid=$this -> memcachedlib -> sesresult['ubranchid'];	
		$this -> pembayaran_model -> __approve_bayar($invid,$pbid);
		redirect(site_url('pembayaran/home/bayar_addx/'.$invid));	
		
	}
	
	function approve_lunas($invid) {
		$branchid=$this -> memcachedlib -> sesresult['ubranchid'];	
		$this -> pembayaran_model -> __approve_lunas($invid);
		redirect(site_url('pembayaran'));	
		
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
