<?php
/* -*- tab-width: 2; indent-tabs-mode: nil; c-basic-offset: 2 -*- */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {
	function __construct() {
		parent::__construct();
		$this -> load -> library('pagination_lib');
		$this -> load -> library('publisher_lib');
		$this -> load -> library('province/province_lib');
		$this -> load -> library('city/city_lib');
		$this -> load -> model('publisher_model');
	}

	function index() {
		$pager = $this -> pagination_lib -> pagination($this -> publisher_model -> __get_publisher(1,0),3,10,site_url('publisher'));
		$view['publisher'] = $this -> pagination_lib -> paginate();
		$view['pages'] = $this -> pagination_lib -> pages();
		$this->load->view('publisher', $view);
	}
	
	function publisher_add() {
		if ($_POST) {
			$name = $this -> input -> post('name', TRUE);
			$mcode = $this -> input -> post('mcode', TRUE);
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
				__set_error_msg(array('error' => 'Nama dan kode harus di isi !!!'));
				redirect(site_url('publisher' . '/' . __FUNCTION__));
			}
			else if (!$email || !$phone1 || !$phone2) {
				__set_error_msg(array('error' => 'Email, Telp dan Fax harus di isi !!!'));
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
				$ch = $this -> publisher_model -> __check_parent($parent);
				if ($ch[0] -> pparent <> 0) $parent = $ch[0] -> pparent;
				$phone = $phone1 . '*' . $phone2 . '*' . $phone3;
				$arr = array('pname' => $name, 'paddr' => $addr, 'pcity' => $city, 'pprov' => $prov, 'pphone' => $phone, 'pemail' => $email, 'pnpwp' => $npwp, 'pcreditlimit' => $climit, 'pcreditday' => $cday, 'pcp' => $cp, 'pcategory' => $category,'pdesc' => $desc, 'pparent' => $parent, 'pstatus' => $status);
				if ($this -> publisher_model -> __insert_publisher($arr)) {
					$lastID = $this -> db -> insert_id();
					
					$rpub = $this -> publisher_model -> __get_child($parent);
					$ird = 1;
					foreach($rpub as $k => $v) {
						if ($lastID == $id) {
							$ird = ($k+2);
							break;
						}
					}
					
					$rs = $this -> publisher_model -> __get_publisher_detail($parent);
					if ($rs[0] -> pparent == 0) $parent = $parent;
					else $parent = $rs[0] -> pparent;
					
					$ch = $this -> publisher_model -> __check_parent($parent);
					if (isset($ch[0] -> pparent) && $ch[0] -> pparent <> 0) $parent = $ch[0] -> pparent;
					
					//~ if ($parent == 0) $code = $mcode . '01';
					//~ else $code = $ch[0] -> pmcode . str_pad($ird, 2, "0", STR_PAD_LEFT);
					//~ 
					//~ $this -> publisher_model -> __update_publisher($lastID, array('pcode' => $code));
					
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
			$mcode = $this -> input -> post('mcode', TRUE);
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
			
			if ($parent <> 0) {
				$mcode = '';
			}
			else {
				
			}
			
			if ($id) {
				if (!$name || !$code) {
					__set_error_msg(array('error' => 'Nama dan kode harus di isi !!!'));
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
				else if (!$npwp) {
					__set_error_msg(array('error' => 'NPWP harus di isi !!!'));
					redirect(site_url('publisher' . '/' . __FUNCTION__ . '/' . $id));
				}
				else if (!$phone3 || !$cp) {
					__set_error_msg(array('error' => 'Kontak Person dan Telp harus di isi !!!'));
					redirect(site_url('publisher' . '/' . __FUNCTION__ . '/' . $id));
				}
				else {
					$rpub = $this -> publisher_model -> __get_child($parent);
					$ird = 1;
					foreach($rpub as $k => $v) {
						if ($v -> pid == $id) {
							$ird = ($k+2);
							break;
						}
					}
					$rs = $this -> publisher_model -> __get_publisher_detail($parent);
					if ($rs[0] -> pparent == 0) $parent = $parent;
					else $parent = $rs[0] -> pparent;
					$ch = $this -> publisher_model -> __check_parent($parent);
					if (isset($ch[0] -> pparent) && $ch[0] -> pparent <> 0) $parent = $ch[0] -> pparent;
					if ($parent == 0) $code = $mcode . '01';
					else $code = $ch[0] -> pmcode . str_pad($ird, 2, "0", STR_PAD_LEFT);

					$phone = $phone1 . '*' . $phone2 . '*' . $phone3;
					$arr = array('pmcode' => $mcode, 'pcode' => $code, 'pname' => $name, 'paddr' => $addr, 'pcity' => $city, 'pprov' => $prov, 'pphone' => $phone, 'pemail' => $email, 'pnpwp' => $npwp, 'pcreditlimit' => $climit, 'pcreditday' => $cday, 'pcp' => $cp, 'pcategory' => $category, 'pdesc' => $desc, 'pparent' => $parent, 'pstatus' => $status);
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
		$q = $_SERVER['QUERY_STRING'];
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
		$this -> load -> view('publisher', $view);
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
