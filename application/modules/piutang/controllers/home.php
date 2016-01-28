<?php
/* -*- tab-width: 2; indent-tabs-mode: nil; c-basic-offset: 2 -*- */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {
	function __construct() {
		parent::__construct();
		$this -> load -> library('pagination_lib');
		$this -> load -> model('piutang_model');
		$this -> load -> model('area/area_model');
		$this -> load -> library('customer/customer_lib');
	}

	function index() {
		//echo "xx";die;
		$pager = $this -> pagination_lib -> pagination($this -> piutang_model -> __get_piutang_area(),3,10,site_url('piutang/home/index/'));
		$view['piutang'] = $this -> pagination_lib -> paginate();
		$view['pages'] = $this -> pagination_lib -> pages();
		$this->load->view('piutang_area', $view);
	}
	
	
	
	
	function piutang_cust() {
		//echo "xx";die;
		$pager = $this -> pagination_lib -> pagination($this -> piutang_model -> __get_piutang_cust(),3,10,site_url('piutang/home/piutang_cust/'));
		$view['piutang'] = $this -> pagination_lib -> paginate();
		$view['pages'] = $this -> pagination_lib -> pages();
		$this->load->view('piutang', $view);
	}	

	function pfaktur(){
		
		if(!isset($_GET['xlsxx'])){$_GET['xlsxx']="";}
		// echo "xx";die;
		 // $pager = $this -> pagination_lib -> pagination($this -> piutang_model -> __get_piutang_cust_all(),3,10,site_url('piutang/home/pfaktur/'));
		 // $view['piutang'] = $this -> pagination_lib -> paginate();
		 // $view['pages'] = $this -> pagination_lib -> pages();
		 // $view['piutang_faktur'] = $this -> piutang_model -> __get_piutang_faktur();
		 // $view['piutang_invoice'] = $this -> piutang_model -> __get_piutang_invoice();
		 //print_r($view);die;
		//$this->load->view('piutang_faktur', $view);

		if($_GET['xlsxx']==1){ 
		
		 $view['piutang'] = $this -> piutang_model -> __get_piutang_cust_allx();
		 
		 $view['piutang_faktur'] = $this -> piutang_model -> __get_piutang_faktur();
		 $view['piutang_invoice'] = $this -> piutang_model -> __get_piutang_invoice();		
			$this -> load -> view('piutang_xls', $view ,FALSE );
		}else{
		 $pager = $this -> pagination_lib -> pagination($this -> piutang_model -> __get_piutang_cust_all(),3,10,site_url('piutang/home/pfaktur/'));
		 $view['piutang'] = $this -> pagination_lib -> paginate();
		 $view['pages'] = $this -> pagination_lib -> pages();
		 $view['piutang_faktur'] = $this -> piutang_model -> __get_piutang_faktur();
		 $view['piutang_invoice'] = $this -> piutang_model -> __get_piutang_invoice();			
			$this -> load -> view('piutang_faktur', $view ,TRUE );
		}		
		
	
	
	}		
	
	
	
	function pfaktur_xls(){
		
		 $view['piutang'] = $this -> piutang_model -> __get_piutang_cust_allx();		
		 $view['piutang_faktur'] = $this -> piutang_model -> __get_piutang_faktur();
		 $view['piutang_invoice'] = $this -> piutang_model -> __get_piutang_invoice();
		 //print_r($view);die;
		$this->load->view('piutang_xls', $view,FALSE);
	}		
	
	function pfaktur_lunas(){
		
		 $pager = $this -> pagination_lib -> pagination($this -> piutang_model -> __get_piutang_cust_lunas(),3,10,site_url('piutang/home/pfaktur_lunas/'));
		 $view['lunas_all'] = $this -> pagination_lib -> paginate();
		 $view['pages'] = $this -> pagination_lib -> pages();
		 $view['lunas_faktur'] = $this -> piutang_model -> __get_faktur_lunas();
		// echo '<pre>';
		// print_r($view['lunas_all']);
		// echo '</pre>';die;
		$this->load->view('faktur_lunas', $view);
	}


	function pfaktur_lunas_xls(){
		
		 $view['lunas_all'] = $this -> piutang_model -> __get_piutang_cust_lunasx();		
		 $view['lunas_faktur'] = $this -> piutang_model -> __get_faktur_lunas();
		$this->load->view('faktur_lunas_xls', $view,FALSE);	
	}
	function piutang_cust_id($aid) {
		//echo "xx";die;
		$pager = $this -> pagination_lib -> pagination($this -> piutang_model -> __get_piutang_cust_id($aid),3,10,site_url('piutang/home/piutang_cust_id/'.$aid));
		$view['piutang'] = $this -> pagination_lib -> paginate();
		$view['pages'] = $this -> pagination_lib -> pages();
		$this->load->view('piutang', $view);
	}	
	
	function inv_area() {
		//echo "xx";die;
		$pager = $this -> pagination_lib -> pagination($this -> piutang_model -> __get_inv_area(),3,10,site_url('piutang/home/inv_area'));
		$view['piutang'] = $this -> pagination_lib -> paginate();
		$view['pages'] = $this -> pagination_lib -> pages();
		$this->load->view('inv_area', $view);
	}

	function inv_cust() {
		//echo "xx";die;
		$pager = $this -> pagination_lib -> pagination($this -> piutang_model -> __get_inv_cust(),3,10,site_url('piutang/home/inv_cust/'));
		$view['piutang'] = $this -> pagination_lib -> paginate();
		$view['pages'] = $this -> pagination_lib -> pages();
		$this->load->view('inv_cust', $view);
	}	
	
	function inv_cust_id($aid) {
		//echo "xx";die;
		$pager = $this -> pagination_lib -> pagination($this -> piutang_model -> __get_inv_cust_id($aid),3,10,site_url('piutang/home/'));
		$view['piutang'] = $this -> pagination_lib -> paginate();
		$view['pages'] = $this -> pagination_lib -> pages();
		$this->load->view('inv_cust', $view);
	}	
	
	function piutang_excel() {
		if($_POST){
			// print_r($_POST);die;
			$datex=explode(" - ",$_POST['datesort']);
			$datefromx=str_replace("/","-",$datex[0]);
			$datetox=str_replace("/","-",$datex[1]);
			$datefrom= date('Y-m-d',strtotime($datefromx));
			$dateto= date('Y-m-d',strtotime($datetox));
			
			//$dateto=$_POST[''];
			$view['piutang'] =$this -> piutang_model ->__get_piutang_by_date($datefrom,$dateto);
			// echo "<pre>";
			// print_r($view);
			// echo "</pre>";die;
			$this->load->view('piutang_excel', $view,FALSE);
		}else{
			echo "ok";die;
		}
		
	}	
	
	
	function bayar_excel($id) {
		

			$view['invoice'] = $this -> piutang_model -> __get_invoice($id);
			$view['bayarz'] = $this -> piutang_model -> __get_bayar($id);
			$view['terima'] = $this -> piutang_model ->__get_total_terima($id);
			$view['pending'] = $this -> piutang_model ->__get_total_pending($id);
			$view['invid']=$id;
			$this->load->view('bayar_excel', $view,FALSE);
		
		
	}	
	
	
	function piutang_addx() {
		//$urlz=site_url('piutang/piutang_add/');
		header('Refresh: 1;url=piutang_add?');
		//redirect(site_url('piutang/piutang_add/'));
		
	}
	
	function bayar_addx($id) {
		//$urlz=site_url('piutang/piutang_add/');
		header('Refresh: 1;url=../bayar_add/'.$id.'?');
		//redirect(site_url('piutang/piutang_add/'));
		
	}	
	
	function piutang_add() {
	
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


		if($tinvv == "FAKTUR"){
			$gtotalx=0;
			if($jumt>0){
				for($j=0;$j<$jumt;$j++){	
				$fakturra = explode("-",$_POST['fakturr'][$j]);
				$fakturr=$fakturra[0];
				$gtotal=$fakturra[1];
				$gtotalx=$gtotalx+$gtotal;
				$art=array('tinvid'=>$tnofaktur,'tsbayar'=>'1');


					 
						$this -> piutang_model ->__update_invtrans($fakturr,$art);
					
				}
				
				$arr = array('invid'=>'','invno' => $tnofaktur, 'invbid' => $branchid, 'invaid' => $taid,'invcid' => $tcid,'invtax' => $ttax ,
				'invtype' => '' ,'periodfrom'=>$datefrom,'periodto'=>$dateto,
				'invdate' => $datenow ,
				'invduedate' => $ttanggal,'invtotalall'=>$gtotal,'totalhutang'=>$gtotal, 'invstatus' => 1 ,'desc'=>$tinfo );
				//print_r($arr);die;
					if ($this -> piutang_model -> __insert_piutang($arr)) {
					$lastid=$this->db->insert_id();		
					 $this -> piutang_model -> __get_total_piutang_monthly($mon,$yr,$lastid,$tnofaktur);				
				
				
				
				 //redirect piutang depan
				 redirect(site_url('piutang'));
					}
				
			}	
			
			
			$view['bayar']=$this -> piutang_model -> __get_piutang_detailzx($taid,$tcid,$datefrom,$dateto);
			$bayarzz=$this -> piutang_model -> __get_piutang_detailz($taid,$tcid,$datefrom,$dateto);
			$gtotal= $bayarzz[0]->gtotal;			
			$view['area']=$this -> area_model -> __get_area($this -> memcachedlib -> sesresult['ubranchid']);
			
			$branchid=$this -> memcachedlib -> sesresult['ubranchid'];
			$view['customer'] = $this -> customer_lib -> __get_customer_consinyasi();
			
			$view['gudang_niaga']=$this -> piutang_model ->__get_gudang_niaga($branchid);
			
			$this->load->view(__FUNCTION__, $view);			
			
			
				
			}else{
			
			$bayarx=$this -> piutang_model -> __get_piutang_detailz($taid,$tcid,$datefrom,$dateto);
			//print_r($bayarx);
			$gtotal= $bayarx[0]->gtotal;			
			//echo $gtotal.'xxx';die;
				$arr = array('invid'=>'','invno' => $tnofaktur, 'invbid' => $branchid, 'invaid' => $taid,'invcid' => $tcid,'invtax' => $ttax ,
				'invtype' => $tbayar ,'periodfrom'=>$datefrom,'periodto'=>$dateto,
				'invdate' => $datenow ,
				'invduedate' => $ttanggal,'invtotalall'=>$gtotal,'totalhutang'=>$gtotal, 'invstatus' => 1 ,'desc'=>$tinfo );
				if ($this -> piutang_model -> __insert_piutang($arr)) {
					// $this -> piutang_model -> __update_piutang($arru);
					__set_error_msg(array('info' => 'Data berhasil ditambahkan.'));
					
				$lastid=$this->db->insert_id();		


					 $this -> piutang_model -> __get_total_piutang_monthly($mon,$yr,$lastid,$tnofaktur);

	


            $bayar=$this -> piutang_model -> __get_piutang_detailz($taid,$tcid,$datefrom,$dateto);			
			$gtotal= $bayar[0]->gtotal;
			$ff=$this -> piutang_model -> __get_piutang_detailzx($taid,$tcid,$datefrom,$dateto);
			//print_r($ff);
			foreach ($ff as $k=>$v){
				
				$tnof= $v->tnofaktur;
				echo $tnof.'<br>';
				$art=array('tinvid'=>$lastid,'tsbayar'=>'1');
				$this -> piutang_model ->__update_invtrans($tnof,$art);
			}
			
	
					// redirect(site_url('piutang_detail/piutang_detail_add/'. $lastid . ''));
					
					redirect(site_url('piutang'));					
				}
				else {
					__set_error_msg(array('error' => 'Gagal menambahkan data !!!'));
					redirect(site_url('piutang'));
				}
			}
		}
		else {
			//print_r($_SERVER);
$oy=substr($_SERVER["REQUEST_URI"],strlen($_SERVER["REQUEST_URI"])-1,1);	
 $urlz=site_url('piutang/piutang_add/');
			
			$branchid=$this -> memcachedlib -> sesresult['ubranchid'];
			$view['customer'] = $this -> customer_lib -> __get_customer_consinyasi();
			$view['area']=$this -> area_model -> __get_areax($this -> memcachedlib -> sesresult['ubranchid']);
			
			$view['gudang_niaga']=$this -> piutang_model ->__get_gudang_niaga($branchid);
			//print_r($view);die;
			$this->load->view(__FUNCTION__, $view);
		}
	}
	
	
	function bayar_add($id) {
		$branchid=$this -> memcachedlib -> sesresult['ubranchid'];
		if($_POST){
			
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
			
			//echo $amountx;
			//print_r($_POST);die;
			
			$pbdate=date('Y-m-d');
				$arr = array('pbid'=>'','pbbid'=>$branchid,'pbnobayar' => '', 
				'invid' => $id, 'invno' => '','pbaid' => '' ,
				'pbcid' => '' ,'pbtype'=>$tbayar,'pbacc'=>'',
				'pbbank' => '' ,'pbnogiro' => $pbnogiro ,
				'pbsetor_to' => '','pbsetor'=>$amountx, 'pbdate' => $pbdate ,'pbsetordate'=>$pbdate,'pbstatus'=>1 );
				if ($this -> piutang_model -> __insert_bayar($arr)) {
					
					__set_error_msg(array('info' => 'Data berhasil ditambahkan.'));
redirect(site_url('piutang/home/bayar_addx/'.$id));					
				}
			
			
			
		}
			$branchid=$this -> memcachedlib -> sesresult['ubranchid'];
			$view['invoice'] = $this -> piutang_model -> __get_invoice($id);
			$view['bayarz'] = $this -> piutang_model -> __get_bayar($id);
			$view['terima'] = $this -> piutang_model ->__get_total_terima($id);
			$view['pending'] = $this -> piutang_model ->__get_total_pending($id);
			$view['invid']=$id;
			$view['gudang_niaga']=$this -> piutang_model ->__get_gudang_niaga($branchid);
			//print_r($view);die;
			$this->load->view(__FUNCTION__, $view);		
		
	}

	function bayar_list($id) {

		$branchid=$this -> memcachedlib -> sesresult['ubranchid'];
			$view['id']=$id;
			$view['invoice'] = $this -> piutang_model -> __get_invoice($id);
			$view['bayarz'] = $this -> piutang_model -> __get_bayar($id);
			$view['terima'] = $this -> piutang_model ->__get_total_terima($id);
			$view['pending'] = $this -> piutang_model ->__get_total_pending($id);
			$view['invid']=$id;
			//echo "aa";die;
			//print_r($view);
			$this->load->view(__FUNCTION__, $view);	
	}

	
	function bayar_approve($invid,$pbid) {
		$branchid=$this -> memcachedlib -> sesresult['ubranchid'];	
		$this -> piutang_model -> __approve_bayar($invid,$pbid);
		redirect(site_url('piutang/home/bayar_addx/'.$invid));	
		
	}
	
	

		
	
	
	function piutang_faktur($id) {
		
		//$view['customer'] = $this -> customer_lib -> __get_customer_consinyasi();		
		// $pager = $this -> pagination_lib -> pagination($this -> piutang_model -> __get_piutang_detail($id),3,10,site_url('piutang_detail'));
		// $view['piutang_detail'] = $this -> pagination_lib -> paginate();
		$view['detail'] =$this -> piutang_model -> __get_piutang_detail($id);
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
	
	
	
	function piutang_update($id) {
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
					redirect(site_url('piutang' . '/' . __FUNCTION__ . '/' . $id));
				}
				else {
					$arr = array('bname' => $name, 'bnpwp' => $npwp, 'baddr' => $addr, 'bcity' => $city, 'bprovince' => $prov, 'bphone' => $phone1 . '*' . $phone2, 'bstatus' => $status);
					if ($this -> piutang_model -> __update_piutang($id, $arr)) {	
						__set_error_msg(array('info' => 'Data berhasil diubah.'));
						redirect(site_url('piutang'));
					}
					else {
						__set_error_msg(array('error' => 'Gagal mengubah data !!!'));
						redirect(site_url('piutang'));
					}
				}
			}
			else {
				__set_error_msg(array('error' => 'Kesalahan input data !!!'));
				redirect(site_url('piutang'));
			}
		}
		else {
			$view['id'] = $id;
			$view['detail'] = $this -> piutang_model -> __get_piutang_detail($id);
			$this->load->view(__FUNCTION__, $view);
		}
	}
	
	function piutang_delete($id) {
		if ($this -> piutang_model -> __delete_piutang($id)) {
			__set_error_msg(array('info' => 'Data berhasil dihapus.'));
			redirect(site_url('piutang'));
		}
		else {
			__set_error_msg(array('error' => 'Gagal hapus data !!!'));
			redirect(site_url('piutang'));
		}
	}
	
	function piutang_search() {
		$keyword = urlencode($this -> input -> post('keyword', true));
		
		if ($keyword)
			redirect(site_url('piutang/home/piutang_search_result/'.$keyword));
		else
			redirect(site_url('piutang/home/pfaktur'));
	}
	
	function piutang_search_result($keyword) {
		// $pager = $this -> pagination_lib -> pagination($this -> piutang_model -> __get_piutang_search(urldecode($keyword)),3,10,site_url('piutang/home/piutang_search_result/' . $keyword));
		// $view['piutang'] = $this -> pagination_lib -> paginate();
		// $view['pages'] = $this -> pagination_lib -> pages();
		if(!isset($_GET['xlsxx'])){$_GET['xlsxx']="";}
		
		
		 $pager = $this -> pagination_lib -> pagination($this -> piutang_model -> __get_piutang_search_faktur(urldecode($keyword)),3,10,site_url('piutang/home/piutang_search_result/'.$keyword));
		 $view['piutang'] = $this -> pagination_lib -> paginate();
		 $view['pages'] = $this -> pagination_lib -> pages();
		 $view['piutang_faktur'] = $this -> piutang_model -> __get_piutang_faktursr(urldecode($keyword));
		 $view['piutang_invoice'] = $this -> piutang_model -> __get_piutang_invoicesr(urldecode($keyword));		
//print_r($this -> piutang_model -> __get_piutang_search(urldecode($keyword)));die;
		// $this -> load -> view('piutang_faktur', $view ,$kondisi );
		
		if($_GET['xlsxx']==1){ 
			$this -> load -> view('piutang_faktur', $view ,FALSE );
		}else{
			$this -> load -> view('piutang_faktur', $view ,TRUE );
		}		
		
	}
}
