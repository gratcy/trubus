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
		$this -> load -> model('customer_model');
	}

	function index() {
		$pager = $this -> pagination_lib -> pagination($this -> customer_model -> __get_customer(false),3,10,site_url('customer'));
		$view['customer'] = $this -> pagination_lib -> paginate();
		$view['pages'] = $this -> pagination_lib -> pages();
		$this->load->view('customer', $view);
	}
	
	function customer_add() {
		if ($_POST) {
			$code = $this -> input -> post('code', TRUE);
			$name = $this -> input -> post('name', TRUE);
			$ctype = $this -> input -> post('ctype', TRUE);
			$npwp = $this -> input -> post('npwp', TRUE);
			$addr = $this -> input -> post('addr', TRUE);
			$phone1 = $this -> input -> post('phone1', TRUE);
			$phone2 = $this -> input -> post('phone2', TRUE);
			$email = $this -> input -> post('email', TRUE);
			$disc = (int) $this -> input -> post('disc');
			$limit = (int) $this -> input -> post('limit');
			$branch = (int) $this -> input -> post('branch');
			$area = (int) $this -> input -> post('area');
			$group = (int) $this -> input -> post('group');
			$tax = (int) $this -> input -> post('tax');
			$city = (int) $this -> input -> post('city');
			$prov = (int) $this -> input -> post('prov');
			$status = (int) $this -> input -> post('status');
			
			if (!$name || !$npwp || !$code) {
				__set_error_msg(array('error' => 'kode, nama dan npwp harus di isi !!!'));
				redirect(site_url('customer' . '/' . __FUNCTION__));
			}
			else if (!$branch || !$area || !$group) {
				__set_error_msg(array('error' => 'Branch, area dan group harus di isi !!!'));
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
				$arr = array('ccode' => $code, 'cbid' => $branch, 'cname' => $name, 'caddr' => $addr, 'ccity' => $city, 'cprovince' => $prov, 'cphone' => $phone1 . '*' . $phone2, 'cemail' => $email, 'cnpwp' => $npwp, 'cdisc' => $disc, 'ctax' => $tax, 'cgroup' => $group, 'carea' => $area, 'ccreditlimit' => $limit, 'ctype' => $ctype, 'cstatus' => $status);
				if ($this -> customer_model -> __insert_customer($arr)) {
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
			$this->load->view(__FUNCTION__, $view);
		}
	}
	
	function customer_update($id) {
		if ($_POST) {
			$code = $this -> input -> post('code', TRUE);
			$id = (int) $this -> input -> post('id');
			$name = $this -> input -> post('name', TRUE);
			$ctype = $this -> input -> post('ctype', TRUE);
			$npwp = $this -> input -> post('npwp', TRUE);
			$addr = $this -> input -> post('addr', TRUE);
			$phone1 = $this -> input -> post('phone1', TRUE);
			$phone2 = $this -> input -> post('phone2', TRUE);
			$email = $this -> input -> post('email', TRUE);
			$disc = (int) $this -> input -> post('disc');
			$limit = (int) $this -> input -> post('limit');
			$branch = (int) $this -> input -> post('branch');
			$area = (int) $this -> input -> post('area');
			$group = (int) $this -> input -> post('group');
			$tax = (int) $this -> input -> post('tax');
			$city = (int) $this -> input -> post('city');
			$prov = (int) $this -> input -> post('prov');
			$status = (int) $this -> input -> post('status');
			
			if ($id) {
				if (!$name || !$npwp || !$code) {
					__set_error_msg(array('error' => 'kode, nama dan npwp harus di isi !!!'));
					redirect(site_url('customer' . '/' . __FUNCTION__ . '/' . $id));
				}
				else if (!$branch || !$area || !$group) {
					__set_error_msg(array('error' => 'Branch, area dan group harus di isi !!!'));
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
					$arr = array('ccode' => $code, 'cbid' => $branch, 'cname' => $name, 'caddr' => $addr, 'ccity' => $city, 'cprovince' => $prov, 'cphone' => $phone1 . '*' . $phone2, 'cemail' => $email, 'cnpwp' => $npwp, 'cdisc' => $disc, 'ctax' => $tax, 'cgroup' => $group, 'carea' => $area, 'ccreditlimit' => $limit, 'ctype' => $ctype, 'cstatus' => $status);
					if ($this -> customer_model -> __update_customer($id, $arr)) {	
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
			$this->load->view(__FUNCTION__, $view);
		}
	}
	
	function customer_delete($id) {
		if ($this -> customer_model -> __delete_customer($id)) {
			__set_error_msg(array('info' => 'Data berhasil dihapus.'));
			redirect(site_url('customer'));
		}
		else {
			__set_error_msg(array('error' => 'Gagal hapus data !!!'));
			redirect(site_url('customer'));
		}
	}
}
