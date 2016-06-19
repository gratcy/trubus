<?php
/* -*- tab-width: 2; indent-tabs-mode: nil; c-basic-offset: 2 -*- */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {
	function __construct() {
		parent::__construct();
		$this -> load -> library('pagination_lib');
		$this -> load -> library('books_group/books_group_lib');
		$this -> load -> library('customer_group/customer_group_lib');
		$this -> load -> library('branch/branch_lib');
		$this -> load -> library('area/area_lib');
		$this -> load -> library('province/province_lib');
		$this -> load -> library('city/city_lib');
		$this -> load -> model('customer_model');
		$this -> load -> model('area/area_model');
	}

	function index() {
		$pager = $this -> pagination_lib -> pagination($this -> customer_model -> __get_customer($this -> memcachedlib -> sesresult['ubranchid']),3,10,site_url('customer'));
		$view['customer'] = $this -> pagination_lib -> paginate();
		$view['pages'] = $this -> pagination_lib -> pages();
		$this->load->view('customer', $view);
	}
	
	function customer_add() {
		if ($_POST) {
			$name = $this -> input -> post('name', TRUE);
			$ctype = $this -> input -> post('ctype', TRUE);
			$npwp = $this -> input -> post('npwp', TRUE);
			$addr = $this -> input -> post('addr', TRUE);
			$phone1 = $this -> input -> post('phone1', TRUE);
			$phone2 = $this -> input -> post('phone2', TRUE);
			$email = $this -> input -> post('email', TRUE);
			$desc = $this -> input -> post('desc', TRUE);
			$disc = $this -> input -> post('disc');
			$limit = (int) $this -> input -> post('limit');
			$tenor = (int) $this -> input -> post('tenor');
			$branch = (int) $this -> input -> post('branch');
			$area = (int) $this -> input -> post('area');
			$cacc = (int) $this -> input -> post('cacc');
			$group = (int) $this -> input -> post('group');
			$tax = (int) $this -> input -> post('tax');
			$city = (int) $this -> input -> post('city');
			$prov = (int) $this -> input -> post('prov');
			$status = (int) $this -> input -> post('status');
			
			if (!$name || !$npwp) {
				__set_error_msg(array('error' => 'Nama dan NPWP harus di isi !!!'));
				redirect(site_url('customer' . '/' . __FUNCTION__));
			}
			else if (!$branch || !$area) {
				__set_error_msg(array('error' => 'Branch dan area harus di isi !!!'));
				redirect(site_url('customer' . '/' . __FUNCTION__));
			}
			else if (!$addr) {
				__set_error_msg(array('error' => 'Alamat harus di isi !!!'));
				redirect(site_url('customer' . '/' . __FUNCTION__));
			}
			else if (!$phone1 || !$phone2 || !$email) {
				__set_error_msg(array('error' => 'Telp I, Telp II dan Email harus di isi !!!'));
				redirect(site_url('customer' . '/' . __FUNCTION__));
			}
			else {
				$bcode = $this -> branch_model -> __get_branch_code($branch);
				if (!$bcode[0]) {
					__set_error_msg(array('error' => 'Cabang tidak terdaftar !!!'));
					redirect(site_url('customer' . '/' . __FUNCTION__));
				}
				
				$lastcode = $this -> customer_model -> __get_last_customer_by_area($area);
				$lastcode = (int) ltrim($lastcode[0] -> lastcode,'0') + 1;
				$codearea = $this -> area_model -> __get_area_detail($area);
				
				$code = $codearea[0] -> acode.str_pad($lastcode, 4, "0", STR_PAD_LEFT);
				$arr = array('cbid' => $branch, 'ccode' => $code, 'cname' => $name, 'caddr' => $addr, 'ccity' => $city, 'cprovince' => $prov, 'cphone' => $phone1 . '*' . $phone2, 'cemail' => $email, 'cnpwp' => $npwp, 'cdisc' => $disc, 'ctax' => $tax, 'carea' => $area, 'cacc' => $cacc, 'ccreditlimit' => $limit, 'ccredittime' => $tenor, 'ctype' => $ctype, 'cdesc' => $desc, 'cstatus' => $status);

				if ($this -> customer_model -> __insert_customer($arr)) {
					$arr = $this -> customer_model -> __get_suggestion($this -> memcachedlib -> sesresult['ubranchid']);
					$this -> memcachedlib -> __regenerate_cache('__customer_suggestion_' . $this -> memcachedlib -> sesresult['ubranchid'], $arr, $_SERVER['REQUEST_TIME']+60*60*24*100);
					$this -> memcachedlib -> delete('__trans_suggeest_1_' . $this -> memcachedlib -> sesresult['ubranchid']);
					
					__set_error_msg(array('info' => 'Customer berhasil ditambahkan.'));
					redirect(site_url('customer'));
				}
				else {
					__set_error_msg(array('error' => 'Gagal menambahkan customer !!!'));
					redirect(site_url('customer'));
				}
			}
		}
		else {
			$view['area'] = $this -> area_lib -> __get_area();
			$view['branch'] = $this -> branch_lib -> __get_branch();
			$view['groups'] = $this -> customer_group_lib -> __get_customer_group();
			$view['province'] = $this -> province_lib -> __get_province();
			$view['city'] = $this -> city_lib -> __get_city();
			$this->load->view(__FUNCTION__, $view);
		}
	}
	
	function customer_update($id) {
		if ($_POST) {
			$id = (int) $this -> input -> post('id');
			$name = $this -> input -> post('name', TRUE);
			$ctype = $this -> input -> post('ctype', TRUE);
			$npwp = $this -> input -> post('npwp', TRUE);
			$addr = $this -> input -> post('addr', TRUE);
			$phone1 = $this -> input -> post('phone1', TRUE);
			$phone2 = $this -> input -> post('phone2', TRUE);
			$email = $this -> input -> post('email', TRUE);
			$desc = $this -> input -> post('desc', TRUE);
			$disc = $this -> input -> post('disc');
			$limit = (int) $this -> input -> post('limit');
			$tenor = (int) $this -> input -> post('tenor');
			$branch = (int) $this -> input -> post('branch');
			$area = (int) $this -> input -> post('area');
			$cacc = (int) $this -> input -> post('cacc');
			$oarea = (int) $this -> input -> post('oarea');
			$group = (int) $this -> input -> post('group');
			$tax = (int) $this -> input -> post('tax');
			$city = (int) $this -> input -> post('city');
			$prov = (int) $this -> input -> post('prov');
			$status = (int) $this -> input -> post('status');
			
			if ($id) {
				if (!$name || !$npwp) {
					__set_error_msg(array('error' => 'Nama dan NPWP harus di isi !!!'));
					redirect(site_url('customer' . '/' . __FUNCTION__ . '/' . $id));
				}
				else if (!$branch || !$area) {
					__set_error_msg(array('error' => 'Branch dan area harus di isi !!!'));
					redirect(site_url('customer' . '/' . __FUNCTION__ . '/' . $id));
				}
				else if (!$addr) {
					__set_error_msg(array('error' => 'Alamat harus di isi !!!'));
					redirect(site_url('customer' . '/' . __FUNCTION__ . '/' . $id));
				}
				else if (!$phone1 || !$phone2 || !$email) {
					__set_error_msg(array('error' => 'Telp I, Telp II dan Email harus di isi !!!'));
					redirect(site_url('customer' . '/' . __FUNCTION__ . '/' . $id));
				}
				else {
					$bcode = $this -> branch_model -> __get_branch_code($branch);
					if (!$bcode[0]) {
						__set_error_msg(array('error' => 'Cabang tidak terdaftar !!!'));
						redirect(site_url('customer' . '/' . __FUNCTION__ . '/' . $id));
					}
						
					
					if ($area == $oarea) {
						$rarr = array();
					}
					else {
						$codearea = $this -> area_model -> __get_area_detail($area);
						$lastcode = $this -> customer_model -> __get_last_customer_by_area($area);
						$lastcode = (int) ltrim($lastcode[0] -> lastcode,'0') + 1;
						$code = $codearea[0] -> acode.str_pad($lastcode, 4, "0", STR_PAD_LEFT);
						$rarr = array('ccode' => $code);
					}
					
					$arr = array('cbid' => $branch, 'cname' => $name, 'caddr' => $addr, 'ccity' => $city, 'cprovince' => $prov, 'cphone' => $phone1 . '*' . $phone2, 'cemail' => $email, 'cnpwp' => $npwp, 'cdisc' => $disc, 'ctax' => $tax, 'carea' => $area, 'cacc' => $cacc, 'ccreditlimit' => $limit, 'ccredittime' => $tenor, 'ctype' => $ctype, 'cdesc' => $desc, 'cstatus' => $status);
					$marr = array_merge($rarr,$arr);
					if ($this -> customer_model -> __update_customer($id, $arr)) {
						$arr = $this -> customer_model -> __get_suggestion($this -> memcachedlib -> sesresult['ubranchid']);
						$this -> memcachedlib -> __regenerate_cache('__customer_suggestion_' . $this -> memcachedlib -> sesresult['ubranchid'], $arr, $_SERVER['REQUEST_TIME']+60*60*24*100);
						$this -> memcachedlib -> delete('__trans_suggeest_1_' . $this -> memcachedlib -> sesresult['ubranchid']);
						
						__set_error_msg(array('info' => 'Customer berhasil diubah.'));
						redirect(site_url('customer'));
					}
					else {
						__set_error_msg(array('error' => 'Gagal mengubah customer !!!'));
						redirect(site_url('customer'));
					}
				}
			}
			else {
				__set_error_msg(array('error' => 'Kesalahan input data !!!'));
				redirect(site_url('customer'));
			}
		}
		else {
			$view['id'] = $id;
			$view['detail'] = $this -> customer_model -> __get_customer_detail($id);
			$view['groups'] = $this -> books_group_lib -> __get_books_group($view['detail'][0] -> cgroup);
			$view['area'] = $this -> area_lib -> __get_area($view['detail'][0] -> carea);
			$view['branch'] = $this -> branch_lib -> __get_branch($view['detail'][0] -> cbid);
			$view['province'] = $this -> province_lib -> __get_province($view['detail'][0] -> cprovince);
			$view['city'] = $this -> city_lib -> __get_city($view['detail'][0] -> ccity);
			$this->load->view(__FUNCTION__, $view);
		}
	}

	function get_suggestion() {
		header('Content-type: application/javascript');
		$hint = array();
		$a = array();
		$q = urldecode($_SERVER['QUERY_STRING']);
		if (strlen($q) < 3) return false;
		$q = str_replace('-',' ',$q);
		$get_customer = $this -> memcachedlib -> get('__customer_suggestion_' . $this -> memcachedlib -> sesresult['ubranchid'], true);

		if (!$get_customer) {
			$arr = $this -> customer_model -> __get_suggestion($this -> memcachedlib -> sesresult['ubranchid']);
			$this -> memcachedlib -> set('__customer_suggestion_' . $this -> memcachedlib -> sesresult['ubranchid'], $arr, 3600,true);
			$get_customer = $this -> memcachedlib -> get('__customer_suggestion_' . $this -> memcachedlib -> sesresult['ubranchid'], true);
		}
		
		foreach($get_customer as $k => $v) $a[] = array('name' => $v['name'], 'id' => $v['cid']);
		
		if (strlen($q) > 0) {
			for($i=0; $i<count($a); $i++) {
				$a[$i]['name'] = trim($a[$i]['name']);
				$num_words = substr_count($a[$i]['name'],' ')+1;
				$pos = array();
				$is_suggestion_added = false;
				
				for ($cnt_pos=0; $cnt_pos<$num_words; $cnt_pos++) {
					if ($cnt_pos==0)
						$pos[$cnt_pos] = 0;
					else
						$pos[$cnt_pos] = strpos($a[$i]['name'],' ', $pos[$cnt_pos-1])+1;
				}
				
				if (strtolower($q)==strtolower(substr($a[$i]['name'],0,strlen($q)))) {
					$hint[] = array('d' => $i, 'i' => $a[$i]['id'], 'n' => $a[$i]['name']);
					$is_suggestion_added = true;
				}
				for ($j=0;$j<$num_words && !$is_suggestion_added;$j++) {
					if(strtolower($q)==strtolower(substr($a[$i]['name'],$pos[$j],strlen($q)))){
						$hint[] = array('d' => $i, 'i' => $a[$i]['id'], 'n' => $a[$i]['name']);
						$is_suggestion_added = true;                                        
					}
				}
			}
		}
		
		echo json_encode($hint);
	}
	
	function customer_search() {
		$keyword = urlencode($this -> input -> post('keyword', true));
		
		if ($keyword)
			redirect(site_url('customer/customer_search_result/'.$keyword));
		else
			redirect(site_url('customer'));
	}
	
	function customer_search_result($keyword) {
		$pager = $this -> pagination_lib -> pagination($this -> customer_model -> __get_customer_search(urldecode($keyword), false, $this -> memcachedlib -> sesresult['ubranchid']),3,10,site_url('customer/customer_search_result/' . $keyword));
		$view['customer'] = $this -> pagination_lib -> paginate();
		$view['pages'] = $this -> pagination_lib -> pages();
		$this -> load -> view('customer', $view);
	}
	
	function export($type) {
		if ($type == 'excel') {
			ini_set('memory_limit', '-1');
			$this -> load -> library('excel');
			$data = $this -> customer_model -> __export_data($this -> memcachedlib -> sesresult['ubranchid']);

			$arr = array();
			foreach($data as $K => $v) {
				$phone = explode('*', $v['cphone']);
				$arr[] = array($v['bname'], $v['ccode'], __get_customer_type($v['ctype'],1), $v['cname'], $v['aname'], (isset($phone[0]) ? $phone[0] : '') . (isset($phone[0]) && isset($phone[1]) ? ' / ' : '') . (isset($phone[1]) ? $phone[1] : ''), $v['cemail'], $v['cnpwp'], $v['cdisc'],__get_tax($v['ctax'],1));
			}
			
			$data = array('header' => array('Branch', 'Code', 'Type', 'Name', 'Area', 'Phone', 'Email', 'NPWP', 'Discount', 'Tax'), 'data' => $arr);

			$this -> excel -> sEncoding = 'UTF-8';
			$this -> excel -> bConvertTypes = false;
			$this -> excel -> sWorksheetTitle = 'Daftar Buku - PT. Niaga Swadaya';
			
			$this -> excel -> addArray($data);
			$this -> excel -> generateXML('customer-' . date('d-m-Y'));
		}
	}
	
	function customer_delete($id) {
		if ($this -> customer_model -> __delete_customer($id)) {
			$arr = $this -> customer_model -> __get_suggestion($this -> memcachedlib -> sesresult['ubranchid']);
			$this -> memcachedlib -> __regenerate_cache('__customer_suggestion_' . $this -> memcachedlib -> sesresult['ubranchid'], $arr, $_SERVER['REQUEST_TIME']+60*60*24*100);
			$this -> memcachedlib -> delete('__trans_suggeest_1_' . $this -> memcachedlib -> sesresult['ubranchid']);
			__set_error_msg(array('info' => 'Data berhasil dihapus.'));
			redirect(site_url('customer'));
		}
		else {
			__set_error_msg(array('error' => 'Gagal hapus data !!!'));
			redirect(site_url('customer'));
		}
	}
}
