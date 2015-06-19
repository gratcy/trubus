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
			$disc = (int) $this -> input -> post('disc');
			$limit = (int) $this -> input -> post('limit');
			$tenor = (int) $this -> input -> post('tenor');
			$branch = (int) $this -> input -> post('branch');
			$area = (int) $this -> input -> post('area');
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
				$arr = array('cbid' => $branch, 'cname' => $name, 'caddr' => $addr, 'ccity' => $city, 'cprovince' => $prov, 'cphone' => $phone1 . '*' . $phone2, 'cemail' => $email, 'cnpwp' => $npwp, 'cdisc' => $disc, 'ctax' => $tax, 'carea' => $area, 'ccreditlimit' => $limit, 'ccredittime' => $tenor, 'ctype' => $ctype, 'cdesc' => $desc, 'cstatus' => $status);
				if ($this -> customer_model -> __insert_customer($arr)) {
					$lastID = $this -> db -> insert_id();
					$code = str_pad($branch, 3, "0", STR_PAD_LEFT).str_pad($area, 2, "0", STR_PAD_LEFT).str_pad($lastID, 4, "0", STR_PAD_LEFT);
					$this -> customer_model -> __update_customer($lastID, array('ccode' => $code));
					
					$arr = $this -> customer_model -> __get_suggestion($this -> memcachedlib -> sesresult['ubranchid']);
					$this -> memcachedlib -> __regenerate_cache('__customer_suggestion_' . $this -> memcachedlib -> sesresult['ubranchid'], $arr, $_SERVER['REQUEST_TIME']+60*60*24*100);
					
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
			$disc = (int) $this -> input -> post('disc');
			$limit = (int) $this -> input -> post('limit');
			$tenor = (int) $this -> input -> post('tenor');
			$branch = (int) $this -> input -> post('branch');
			$area = (int) $this -> input -> post('area');
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
					$code = str_pad($branch, 3, "0", STR_PAD_LEFT).str_pad($area, 2, "0", STR_PAD_LEFT).str_pad($id, 4, "0", STR_PAD_LEFT);
					$arr = array('ccode' => $code, 'cbid' => $branch, 'cname' => $name, 'caddr' => $addr, 'ccity' => $city, 'cprovince' => $prov, 'cphone' => $phone1 . '*' . $phone2, 'cemail' => $email, 'cnpwp' => $npwp, 'cdisc' => $disc, 'ctax' => $tax, 'carea' => $area, 'ccreditlimit' => $limit, 'ccredittime' => $tenor, 'ctype' => $ctype, 'cdesc' => $desc, 'cstatus' => $status);
					if ($this -> customer_model -> __update_customer($id, $arr)) {
						$arr = $this -> customer_model -> __get_suggestion($this -> memcachedlib -> sesresult['ubranchid']);
						$this -> memcachedlib -> __regenerate_cache('__customer_suggestion_' . $this -> memcachedlib -> sesresult['ubranchid'], $arr, $_SERVER['REQUEST_TIME']+60*60*24*100);
						
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
	
	function customer_delete($id) {
		if ($this -> customer_model -> __delete_customer($id)) {
			$arr = $this -> customer_model -> __get_suggestion($this -> memcachedlib -> sesresult['ubranchid']);
			$this -> memcachedlib -> __regenerate_cache('__customer_suggestion_' . $this -> memcachedlib -> sesresult['ubranchid'], $arr, $_SERVER['REQUEST_TIME']+60*60*24*100);
			__set_error_msg(array('info' => 'Data berhasil dihapus.'));
			redirect(site_url('customer'));
		}
		else {
			__set_error_msg(array('error' => 'Gagal hapus data !!!'));
			redirect(site_url('customer'));
		}
	}
}
