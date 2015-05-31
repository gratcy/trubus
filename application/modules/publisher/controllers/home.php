<?php
/* -*- tab-width: 2; indent-tabs-mode: nil; c-basic-offset: 2 -*- */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {
	function __construct() {
		parent::__construct();
		$this -> load -> library('pagination_lib');
		$this -> load -> library('publisher_lib');
		$this -> load -> library('excel');
		$this -> load -> library('province/province_lib');
		$this -> load -> library('city/city_lib');
		$this -> load -> model('publisher_model');
	}

	function index() {
		$pager = $this -> pagination_lib -> pagination($this -> publisher_model -> __get_publisher(1,0),3,10,site_url('publisher'));
		$view['publisher'] = $this -> pagination_lib -> paginate();
		$view['pages'] = $this -> pagination_lib -> pages();
		$view['isSearch'] = false;
		$this->load->view('publisher', $view);
	}
	
	function publisher_add() {
		if ($_POST) {
			$name = $this -> input -> post('name', TRUE);
			$code = $this -> input -> post('code', TRUE);
			$desc = $this -> input -> post('desc', TRUE);
			$email = $this -> input -> post('email', TRUE);
			$npwp = $this -> input -> post('npwp', TRUE);
			$cp = $this -> input -> post('cp', TRUE);
			$addr = $this -> input -> post('addr', TRUE);
			$phone1 = $this -> input -> post('phone1', TRUE);
			$phone2 = $this -> input -> post('phone2', TRUE);
			$phone3 = $this -> input -> post('phone3', TRUE);
			$climit = (int) $this -> input -> post('climit');
			$cday = (int) $this -> input -> post('cday');
			$city = (int) $this -> input -> post('city');
			$prov = (int) $this -> input -> post('prov');
			$category = (int) $this -> input -> post('category');
			$parent = (int) $this -> input -> post('parent');
			$status = (int) $this -> input -> post('status');
					
			if (!$name) {
				__set_error_msg(array('error' => 'Nama harus di isi !!!'));
				redirect(site_url('publisher' . '/' . __FUNCTION__));
			}
			else if (!$email || !$phone1 || !$phone2) {
				__set_error_msg(array('error' => 'Email, Telp dan Fax harus di isi !!!'));
				redirect(site_url('publisher' . '/' . __FUNCTION__));
			}
			else if (!$parent && !$code) {
				__set_error_msg(array('error' => 'Kode publisher harus di isi !!!'));
				redirect(site_url('publisher' . '/' . __FUNCTION__));
			}
			else if (!$city || !$prov) {
				__set_error_msg(array('error' => 'City dan Provinsi harus di isi !!!'));
				redirect(site_url('publisher' . '/' . __FUNCTION__));
			}
			else if (!$npwp) {
				__set_error_msg(array('error' => 'NPWP harus di isi !!!'));
				redirect(site_url('publisher' . '/' . __FUNCTION__));
			}
			else if (!$phone3 || !$cp) {
				__set_error_msg(array('error' => 'Kontak Person dan Telp harus di isi !!!'));
				redirect(site_url('publisher' . '/' . __FUNCTION__));
			}
			else {
				if ($parent == 0) {
					$code = $code;
				}
				else {
					$dr = $this -> publisher_model -> __get_publisher_code($parent);
					$code = $dr[0] -> pcode;
				}
				
				$phone = $phone1 . '*' . $phone2 . '*' . $phone3;
				$arr = array('pcode' => $code, 'pname' => $name, 'paddr' => $addr, 'pcity' => $city, 'pprov' => $prov, 'pphone' => $phone, 'pemail' => $email, 'pnpwp' => $npwp, 'pcreditlimit' => $climit, 'pcreditday' => $cday, 'pcp' => $cp, 'pcategory' => $category,'pdesc' => $desc, 'pparent' => $parent, 'pstatus' => $status);
				if ($this -> publisher_model -> __insert_publisher($arr)) {
					__set_error_msg(array('info' => 'Data berhasil ditambahkan.'));
					redirect(site_url('publisher'));
				}
				else {
					__set_error_msg(array('error' => 'Gagal menambahkan data !!!'));
					redirect(site_url('publisher'));
				}
			}
		}
		else {
			$view['province'] = $this -> province_lib -> __get_province();
			$view['city'] = $this -> city_lib -> __get_city();
			$view['pub'] = $this -> publisher_lib -> __get_publisher();
			$this->load->view(__FUNCTION__, $view);
		}
	}
	
	function publisher_update($id) {
		if ($_POST) {
			$id = (int) $this -> input -> post('id');
			$name = $this -> input -> post('name', TRUE);
			$code = $this -> input -> post('code', TRUE);
			$desc = $this -> input -> post('desc', TRUE);
			$email = $this -> input -> post('email', TRUE);
			$npwp = $this -> input -> post('npwp', TRUE);
			$addr = $this -> input -> post('addr', TRUE);
			$cp = $this -> input -> post('cp', TRUE);
			$phone1 = $this -> input -> post('phone1', TRUE);
			$phone2 = $this -> input -> post('phone2', TRUE);
			$phone3 = $this -> input -> post('phone3', TRUE);
			$climit = (int) $this -> input -> post('climit');
			$cday = (int) $this -> input -> post('cday');
			$city = (int) $this -> input -> post('city');
			$prov = (int) $this -> input -> post('prov');
			$status = (int) $this -> input -> post('status');
			$parent = (int) $this -> input -> post('parent');
			$category = (int) $this -> input -> post('category');
			
			if ($id) {
				if (!$name) {
					__set_error_msg(array('error' => 'Nama harus di isi !!!'));
					redirect(site_url('publisher' . '/' . __FUNCTION__ . '/' . $id));
				}
				else if (!$email || !$phone1 || !$phone2) {
					__set_error_msg(array('error' => 'Email, Telp I dan Telp II harus di isi !!!'));
					redirect(site_url('publisher' . '/' . __FUNCTION__ . '/' . $id));
				}
				else if (!$city || !$prov) {
					__set_error_msg(array('error' => 'City dan Provinsi harus di isi !!!'));
					redirect(site_url('publisher' . '/' . __FUNCTION__ . '/' . $id));
				}
				else if (!$parent && !$code) {
					__set_error_msg(array('error' => 'Kode publisher harus di isi !!!'));
					redirect(site_url('publisher' . '/' . __FUNCTION__ . '/' . $id));
				}
				else if (!$npwp) {
					__set_error_msg(array('error' => 'NPWP harus di isi !!!'));
					redirect(site_url('publisher' . '/' . __FUNCTION__ . '/' . $id));
				}
				else if ($id == $parent) {
					__set_error_msg(array('error' => 'Duplikat parent !!!'));
					redirect(site_url('publisher' . '/' . __FUNCTION__ . '/' . $id));
				}
				else if (!$phone3 || !$cp) {
					__set_error_msg(array('error' => 'Kontak Person dan Telp harus di isi !!!'));
					redirect(site_url('publisher' . '/' . __FUNCTION__ . '/' . $id));
				}
				else {
					if ($parent == 0) {
						$code = $code;
					}
					else {
						$dr = $this -> publisher_model -> __get_publisher_code($parent);
						$code = $dr[0] -> pcode;
					}
					
					$phone = $phone1 . '*' . $phone2 . '*' . $phone3;
					$arr = array('pcode' => $code, 'pname' => $name, 'paddr' => $addr, 'pcity' => $city, 'pprov' => $prov, 'pphone' => $phone, 'pemail' => $email, 'pnpwp' => $npwp, 'pcreditlimit' => $climit, 'pcreditday' => $cday, 'pcp' => $cp, 'pcategory' => $category, 'pdesc' => $desc, 'pparent' => $parent, 'pstatus' => $status);
					if ($this -> publisher_model -> __update_publisher($id, $arr)) {	
						__set_error_msg(array('info' => 'Data berhasil diubah.'));
						redirect(site_url('publisher'));
					}
					else {
						__set_error_msg(array('error' => 'Gagal mengubah data !!!'));
						redirect(site_url('publisher'));
					}
				}
			}
			else {
				__set_error_msg(array('error' => 'Kesalahan input data !!!'));
				redirect(site_url('publisher'));
			}
		}
		else {
			$view['id'] = $id;
			$view['detail'] = $this -> publisher_model -> __get_publisher_detail($id);
			$view['pub'] = $this -> publisher_lib -> __get_publisher($view['detail'][0] -> pparent);
			$view['province'] = $this -> province_lib -> __get_province($view['detail'][0] -> pprov);
			$view['city'] = $this -> city_lib -> __get_city($view['detail'][0] -> pcity);
			$this->load->view(__FUNCTION__, $view);
		}
	}

	function get_suggestion() {
		$hint = '';
		$a = array();
		$q = urldecode($_SERVER['QUERY_STRING']);
		$arr = $this -> publisher_model -> __get_suggestion();
		foreach($arr as $k => $v) $a[] = array('name' => $v -> name, 'id' => $v -> bid);
		
		if (strlen($q) > 0) {
			for($i=0; $i<count($a); $i++) {
				if (strtolower($q) == strtolower(substr($a[$i]['name'],0,strlen($q)))) {
					if ($hint == '')
						$hint .='<div class="autocomplete-suggestion" data-index="'.$i.'" ids="'.$a[$i]['id'].'">'.$a[$i]['name'].'</div>';
					else
						$hint .= '<div class="autocomplete-suggestion" data-index="'.$i.'" ids="'.$a[$i]['id'].'">'.$a[$i]['name'].'</div>';
				}
			}
		}
		
		echo ($hint == '' ? '<div class="autocomplete-suggestion">No Suggestion</div>' : $hint);
	}
	
	function publisher_search() {
		$bname = urlencode($this -> input -> post('keyword', true));
		
		if ($bname)
			redirect(site_url('publisher/publisher_search_result/'.$bname));
		else
			redirect(site_url('publisher'));
	}
	
	function publisher_search_result($keyword) {
		$pager = $this -> pagination_lib -> pagination($this -> publisher_model -> __get_publisher_search(urldecode($keyword)),3,10,site_url('publisher/publisher_search_result/' . $keyword));
		$view['publisher'] = $this -> pagination_lib -> paginate();
		$view['pages'] = $this -> pagination_lib -> pages();
		$view['isSearch'] = true;
		$view['npage'] = ($this->uri->segment(4) ? (int) $this->uri->segment(4) : 1);
		$this -> load -> view('publisher', $view);
	}
	
	function export($type) {
		if ($type == 'excel') {
			$data = json_decode(json_encode($this -> publisher_model -> __export()), true);
			$arr = array();
			$child = array();
			$phone = array();
			$phonec = array();
			foreach($data as $K => $v) {
				$phone = explode('*',$v['pphone']);
				$arr[] = array($v['pcode'],'01',$v['pname'],$v['pdesc'],__get_publisher_category($v['pcategory'],1),$v['paddr'],__get_cities($v['pcity']),__get_province($v['pprov']),$v['pemail'],$phone[0],$phone[1],$v['pnpwp'],$v['pcreditlimit'],$v['pcreditday'],$v['pcp'],$phone[2]);
				$child = json_decode(json_encode($this -> publisher_model -> __get_publisher(2, $v['pid'])), true);
				foreach($child as $k => $val) {
					$phonec = explode('*', $val['pphone']);
					$arr[] = array($val['pcode'],'-- '.str_pad(($k+2), 2, "0", STR_PAD_LEFT),$val['pname'],$val['pdesc'],__get_publisher_category($val['pcategory'],1),$val['paddr'],__get_cities($val['pcity']),__get_province($val['pprov']),$val['pemail'],$phonec[0],$phonec[1],$val['pnpwp'],$val['pcreditlimit'],$val['pcreditday'],$val['pcp'],$phonec[2]);
				}
				$child = array();
			}
			$data = array('header' => array('Code', 'Imprint', 'Name','Description','Category','Address','City','Province','Email','Phone','Fax', 'NPWP', 'Credit Limit', 'Credit Duration (Days)','Contact Person', 'Contact Person (Phone)'), 'data' => $arr);

			$this -> excel -> sEncoding = 'UTF-8';
			$this -> excel -> bConvertTypes = false;
			$this -> excel -> sWorksheetTitle = 'Publisher';
			
			$this -> excel -> addArray($data);
			$this -> excel -> generateXML('Publisher');
		}
	}
	
	function publisher_delete($id) {
		if ($this -> publisher_model -> __delete_publisher($id)) {
			__set_error_msg(array('info' => 'Data berhasil dihapus.'));
			redirect(site_url('publisher'));
		}
		else {
			__set_error_msg(array('error' => 'Gagal hapus data !!!'));
			redirect(site_url('publisher'));
		}
	}
}
