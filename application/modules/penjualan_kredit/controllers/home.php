<?php
/* -*- tab-width: 2; indent-tabs-mode: nil; c-basic-offset: 2 -*- */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {
	function __construct() {
		parent::__construct();
		$this -> load -> library('pagination_lib');
		$this -> load -> model('penjualan_kredit_model');
		$this -> load -> library('customer/customer_lib');
		
        $this->load->helper(array('form'));
        
        $this->load->model(array('import_model'));		
	}

	function index($id) {
		$pager = $this -> pagination_lib -> pagination($this -> penjualan_kredit_model -> __get_penjualan_kredit(),3,10,site_url('penjualan_kredit'));
		$view['penjualan_kredit'] = $this -> pagination_lib -> paginate();
		$view['pages'] = $this -> pagination_lib -> pages();
		$this->load->view('penjualan_kredit', $view);
	}
	
	function hasil_penjualan_excel_old() {
		if($_POST){
			$datex=explode(" - ",$_POST['datesort']);
			$datefromx=str_replace("/","-",$datex[0]);
			$datetox=str_replace("/","-",$datex[1]);
			$datefrom= date('Y-m-d',strtotime($datefromx));
			$dateto= date('Y-m-d',strtotime($datetox));
			
			$view['hasil_penjualan'] =$this -> penjualan_kredit_model ->__get_hasil_penjualan_by_date($datefrom,$dateto);
			$this->load->view('hasil_penjualan_excel', $view,FALSE);
		}
		
	}	
	
	function hasil_penjualan_excel() {
		if($_POST){
			$datex=explode(" - ",$_POST['datesort']);
			$datefromx=str_replace("/","-",$datex[0]);
			$datetox=str_replace("/","-",$datex[1]);
			$view['datefrom']= date('Y-m-d',strtotime($datefromx));
			$view['dateto']= date('Y-m-d',strtotime($datetox));		
			$view['hostname']=$this->db->hostname;
			$view['username']=$this->db->username;
			$view['password']=$this->db->password;
			$view['database']=$this->db->database;	
			$this->load->view('jc_excell', $view,FALSE);
		}
	}		
	
	
	function index_upload($ttid)
	{	    
	$view['ttid']=$ttid;
		$this->load->view('form_upload',$view);
	}

	function index_uploadz()
	{	    
	//$view['ttid']=$ttid;
		$this->load->view('form_uploadz');
	}
	
	function upload()
    {
        $this->load->helper('file');
             
        //$config['upload_path'] = './upload/';
		//$config['allowed_types'] = '*';
		//$this->load->library('upload', $config);
        $ttid=$_POST['ttid'];
		// if ( ! $this->upload->do_upload('file'))
		// {
			// __set_error_msg(array('error' => $this->upload->display_errors()));			
            // redirect('penjualan_kredit/index_upload/'.$ttid);
		// }
		// else
		// {
            $data = array('error' => false);
			//$upload = $this->upload->data();

            $this->load->library('excel_reader');
			$this->excel_reader->setOutputEncoding('CP1251');

			//$file = $upload['full_path'];
			//$this->excel_reader->read($file);
			
			$this -> excel_reader -> read($_FILES['file']['tmp_name']);

			$data      = $this->excel_reader->sheets[0];
            $excel_data = Array();
			for ($i = 2; $i <= $data['numRows']; $i++)
            {
                if($data['cells'][$i][1] == '') break;
				
                $excel_data[$i-1]['ttid'] = $ttid;
                $excel_data[$i-1]['tbid'] = $data['cells'][$i][1];
                $excel_data[$i-1]['tqty'] = $data['cells'][$i][2];        
				$excel_data[$i-1]['tharga'] = $data['cells'][$i][3]; 
				$excel_data[$i-1]['tdisc'] = $data['cells'][$i][4];
				$excel_data[$i-1]['ttharga'] = $data['cells'][$i][2] * $data['cells'][$i][3]; 
				$excel_data[$i-1]['ttotal'] = ($data['cells'][$i][2] * $data['cells'][$i][3] )-($data['cells'][$i][2] * $data['cells'][$i][3] * $data['cells'][$i][4] / 100); 
				//$excel_data[$i-1]['tqty'] = $data['cells'][$i][3]; 
			}          
            delete_files($upload['file_path']);
            $this->import_model->upload_data($excel_data);    
			__set_error_msg(array('info' => 'Data berhasil ditambahkan.'));			
            redirect('penjualan_kredit/index_upload/'.$ttid);
		//}
    }


function upload_shadow()
    {
        $this->load->helper('file');
                
        // $config['upload_path'] = './upload/';
		// $config['allowed_types'] = '*';
		// $this->load->library('upload', $config);
        $ttid=$_POST['ttid'];
		// if ( ! $this->upload->do_upload('file'))
		// {
			
			// echo "xxxxzz";die;
			// __set_error_msg(array('error' => $this->upload->display_errors()));			
            // redirect('penjualan_kredit/index_uploadz/');
		// }
		// else
		// {
			//echo "yyyxxxx";die;
            $data = array('error' => false);
			//$upload = $this->upload->data();

            $this->load->library('excel_reader');
			$this->excel_reader->setOutputEncoding('CP1251');

			//$file = $upload['full_path'];
			//$this->excel_reader->read($file);
			
			$this -> excel_reader -> read($_FILES['file']['tmp_name']);

			$data      = $this->excel_reader->sheets[0];
			//print_r($data);die;
            $excel_data = Array();
			for ($i = 2; $i <= $data['numRows']; $i++)
            {
                if($data['cells'][$i][1] == '') break;
				
                $excel_data[$i-1]['ttid'] = $ttid;
                $excel_data[$i-1]['tbid'] = $data['cells'][$i][1];
                $excel_data[$i-1]['tqty'] = $data['cells'][$i][2];        
				$excel_data[$i-1]['tharga'] = $data['cells'][$i][3]; 
				$excel_data[$i-1]['tdisc'] = $data['cells'][$i][4];
				$excel_data[$i-1]['ttharga'] = $data['cells'][$i][2] * $data['cells'][$i][3]; 
				$excel_data[$i-1]['ttotal'] = ($data['cells'][$i][2] * $data['cells'][$i][3] )-($data['cells'][$i][2] * $data['cells'][$i][3] * $data['cells'][$i][4] / 100); 
				//$excel_data[$i-1]['tqty'] = $data['cells'][$i][3]; 
			}          
           // delete_files($upload['file_path']);
            $this->import_model->upload_dataz($excel_data);    
			__set_error_msg(array('info' => 'Data berhasil ditambahkan.'));			
            redirect('penjualan_kredit/index_uploadz/'.$ttid);
		//}
    }
	
	function penjualan_kredit_addx() {
		//$urlz=site_url('hasil_penjualan/hasil_penjualan_add/');
		header('Refresh: 1;url=penjualan_kredit_add?');
		//redirect(site_url('hasil_penjualan/hasil_penjualan_add/'));
		
	}
	
	function penjualan_kredit_add() {
	
		if ($_POST) {
			
			$year=date('y',strtotime($_POST['ttanggal']));
			$month=date('M',strtotime($_POST['ttanggal']));
			$mon=date('m',strtotime($_POST['ttanggal']));
			$yr=date('Y',strtotime($_POST['ttanggal']));
			$sec=date('s',strtotime($_POST['ttanggal']));
			$branchid = $this -> input -> post('branch', TRUE);
			$ttanggal = $this -> input -> post('ttanggal', TRUE);
			$tcid = $this -> input -> post('tcid', TRUE);
			$ttype = 2;
			$ttypetrans = 2;
			$ttax = (int) $this -> input -> post('ttax');	
			$gd_from = (int) $this -> input -> post('fromgd');
			$gd_to = (int) $this -> input -> post('togd');
			$tstatus = (int) $this -> input -> post('tstatus');
			$bcode = $this -> input -> post('bcode', TRUE);
			$tnofakturx = $this -> input -> post('tnofaktur', TRUE);
			//$tnofaktur=$tnofakturx.$bcode.$year.$mon.$sec;
			$tnofaktur=$tnofakturx.$year.$bcode.$mon;
			// if (!$name || !$npwp || !$addr || !$phone1 || !$phone2 || !$city || !$prov) {
				// __set_error_msg(array('error' => 'Data yang anda masukkan tidak lengkap !!!'));
				// redirect(site_url('penjualan_kredit' . '/' . __FUNCTION__));
			// }
			//else {
				$arr = array('tid'=>'','tnofaktur' => $tnofaktur, 'tbid' => $branchid, 'tcid' => $tcid,'tpid' => '','ttax' => $ttax ,
				'ttanggal' => $ttanggal,  'ttype' => $ttype, 'ttypetrans' => $ttypetrans,  'ttotalqty' => '', 
				'ttotalharga' => '', 'ttotaldisc' => '', 'tongkos' => '', 'tgrandtotal' => '', 
				'gd_from'=>$gd_from,'gd_to'=>$gd_to,'tstatus' => $tstatus);
				if ($this -> penjualan_kredit_model -> __insert_penjualan_kredit($arr)) {
					__set_error_msg(array('info' => 'Data berhasil ditambahkan.'));
					
				$lastid=$this->db->insert_id();		


					 $this -> penjualan_kredit_model -> __get_total_penjualan_kredit_monthly($mon,$yr,$lastid,$tnofaktur);

				
					redirect(site_url('penjualan_kredit_detail/penjualan_kredit_detail_add/'. $lastid . ''));
				}
				else {
					__set_error_msg(array('error' => 'Gagal menambahkan data !!!'));
					redirect(site_url('penjualan_kredit'));
				}
			//}
		}
		else {
			$branchid=$this -> memcachedlib -> sesresult['ubranchid'];
			$view['customer'] = $this -> customer_lib -> __get_customer_consinyasi();
			
			$view['gudang_niaga']=$this -> penjualan_kredit_model ->__get_gudang_niaga($branchid);
			//print_r($view);die;
			$this->load->view(__FUNCTION__, $view);
		}
	}
	
	function penjualan_kredit_update($id) {
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
					redirect(site_url('penjualan_kredit' . '/' . __FUNCTION__ . '/' . $id));
				}
				else {
					$arr = array('bname' => $name, 'bnpwp' => $npwp, 'baddr' => $addr, 'bcity' => $city, 'bprovince' => $prov, 'bphone' => $phone1 . '*' . $phone2, 'bstatus' => $status);
					if ($this -> penjualan_kredit_model -> __update_penjualan_kredit($id, $arr)) {	
						__set_error_msg(array('info' => 'Data berhasil diubah.'));
						redirect(site_url('penjualan_kredit'));
					}
					else {
						__set_error_msg(array('error' => 'Gagal mengubah data !!!'));
						redirect(site_url('penjualan_kredit'));
					}
				}
			}
			else {
				__set_error_msg(array('error' => 'Kesalahan input data !!!'));
				redirect(site_url('penjualan_kredit'));
			}
		}
		else {
			$view['id'] = $id;
			$view['detail'] = $this -> penjualan_kredit_model -> __get_penjualan_kredit_detail($id);
			$this->load->view(__FUNCTION__, $view);
		}
	}
	
	function penjualan_kredit_delete($id) {
		if ($this -> penjualan_kredit_model -> __delete_penjualan_kredit($id)) {
			__set_error_msg(array('info' => 'Data berhasil dihapus.'));
			redirect(site_url('penjualan_kredit'));
		}
		else {
			__set_error_msg(array('error' => 'Gagal hapus data !!!'));
			redirect(site_url('penjualan_kredit'));
		}
	}
	
	function source() {
		$view['hostname']=$this->db->hostname;
		$view['username']=$this->db->username;
		$view['password']=$this->db->password;
		$view['database']=$this->db->database;
		$this->load->view('sourcek',$view,FALSE);
	}
	
	function penjualan_kredit_search() {
		$keyword = base64_decode(urldecode($this -> input -> post('keyword', true)));
                $keyword = $this -> input -> post('keyword', true);
		//echo $keyword;die;
		if ($keyword)
			redirect(site_url('penjualan_kredit/penjualan_kredit_search_result/'.$keyword));
		else
			redirect(site_url('penjualan_kredit'));
	}



	function _penjualan_kredit_search() {
		$keyword = $this -> input -> post('keyword', true);
		$branch=$this -> memcachedlib -> sesresult['ubranchid'];
		return "SELECT a.*,b.cname FROM transaction_tab a LEFT JOIN customer_tab b ON a.tcid=b.cid WHERE (a.tnofaktur LIKE '%".$keyword."%' OR b.cname LIKE '%".$keyword."%' OR a.tinfo LIKE '%".$keyword."%') AND (a.tstatus='1' OR a.tstatus='0') AND a.ttype='2' AND a.ttypetrans='2' 
		and a.tbid='$branch' ORDER BY a.tid DESC";
	}


	
	function penjualan_kredit_search_result($keyword) {
		//$keyword = $this -> input -> post('keyword', true);
		//echo $keyword;//die;
		$pager = $this -> pagination_lib -> pagination($this -> penjualan_kredit_model -> __get_penjualan_kredit_search($keyword),3,10,site_url('penjualan_kredit/penjualan_kredit_search_result/' . $keyword));
		$view['penjualan_kredit'] = $this -> pagination_lib -> paginate();
		$view['pages'] = $this -> pagination_lib -> pages();
		$this -> load -> view('penjualan_kredit', $view);
	}

	
}
