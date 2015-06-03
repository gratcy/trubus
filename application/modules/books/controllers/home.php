<?php
/* -*- tab-width: 2; indent-tabs-mode: nil; c-basic-offset: 2 -*- */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {
	function __construct() {
		parent::__construct();
		$this -> load -> library('pagination_lib');
		$this -> load -> library('publisher/publisher_lib');
		$this -> load -> model('publisher/publisher_model');
		$this -> load -> model('inventory/inventory_model');
		$this -> load -> model('inventory_shadow/inventory_shadow_model');
		$this -> load -> model('branch/branch_model');
		$this -> load -> model('books_model');
	}

	function index() {
		$pager = $this -> pagination_lib -> pagination($this -> books_model -> __get_books(),3,10,site_url('books'));
		$view['books'] = $this -> pagination_lib -> paginate();
		$view['pages'] = $this -> pagination_lib -> pages();
		$this->load->view('books', $view);
	}
	
	function books_add() {
		if ($_POST) {
			$title = $this -> input -> post('title', TRUE);
			$desc = $this -> input -> post('desc', TRUE);
			$isbn = $this -> input -> post('isbn', TRUE);
			$pengarang = $this -> input -> post('pengarang', TRUE);
			$my = $this -> input -> post('my', TRUE);
			$width = (int) $this -> input -> post('width');
			$height = (int) $this -> input -> post('height');
			$pages = (int) $this -> input -> post('pages');
			$price = str_replace(',','',$this -> input -> post('price', TRUE));
			$publisher = (int) $this -> input -> post('publisher');
			$group = (int) $this -> input -> post('group');
			$tax = (int) $this -> input -> post('tax');
			$pack = (int) $this -> input -> post('pack');
			$disc = (int) $this -> input -> post('disc');
			$status = (int) $this -> input -> post('status');
			
			if (!$title) {
				__set_error_msg(array('error' => 'Judul harus di isi !!!'));
				redirect(site_url('books' . '/' . __FUNCTION__));
			}
			else if (!$publisher || !$pengarang) {
				__set_error_msg(array('error' => 'Pengarang dan publisher harus di isi !!!'));
				redirect(site_url('books' . '/' . __FUNCTION__));
			}
			else if (!$my || !$pages) {
				__set_error_msg(array('error' => 'Bulan-Tahun dan Total Pages harus di isi !!!'));
				redirect(site_url('books' . '/' . __FUNCTION__));
			}
			else if (!$width || !$height) {
				__set_error_msg(array('error' => 'Panjang dan lebar harus di isi !!!'));
				redirect(site_url('books' . '/' . __FUNCTION__));
			}
			else if (!$isbn) {
				__set_error_msg(array('error' => 'Kode ISBN harus di isi !!!'));
				redirect(site_url('books' . '/' . __FUNCTION__));
			}
			else if (!$price) {
				__set_error_msg(array('error' => 'Harga harus di isi !!!'));
				redirect(site_url('books' . '/' . __FUNCTION__));
			}
			else {
				if (!$_FILES['file']['name']) {
					__set_error_msg(array('error' => 'Cover buku harus diisi !!!'));
					redirect(site_url('books' . '/' . __FUNCTION__));
				}
				
				$dpa = $this -> publisher_model -> __get_publisher_detail($publisher);
				if ($dpa[0] -> pparent == 0) {
					$dpa1 = '01';
				}
				else {
					$wew = $this  -> publisher_model -> __get_publisher(2, $dpa[0] -> pparent);
					$i = 2;
					foreach($wew as $k => $v) :
						if ($v -> pid == $publisher) {
							$dpa1 = str_pad($i, 2, "0", STR_PAD_LEFT);
							break;
						}
						++$i;
					endforeach;
				}
				
				$fname = time() . uniqid() . $_FILES['file']['name'];
				$fdir = __get_path_upload('cover', 1);
				
				if (!is_dir($fdir)) mkdir($fdir);
				
				if (move_uploaded_file($_FILES["file"]["tmp_name"], $fdir .'/'. $fname))
					$fname = $fname;
				else
					$fname = '';
				
				$arr = array('bauthor' => $pengarang, 'bpublisher' => $publisher, 'btitle' => $title, 'btax' => $tax, 'bprice' => $price, 'bpack' => $pack, 'bdisc' => $disc, 'bisbn' => $isbn, 'bhw' => $height . '*' . $width, 'bmonthyear' => $my, 'btotalpages' => $pages, 'bcover' => $fname, 'bdesc' => $desc, 'bstatus' => $status);
				if ($this -> books_model -> __insert_books($arr)) {
					$lastID = $this -> db -> insert_id();
					$rbk = $this -> books_model -> __get_total_category_book($publisher);
					
					$ird = 1;
					foreach($rbk as $k => $v) {
						if ($v -> bid == $lastID) {
							$ird = ($k+1);
							break;
						}
					}
					$co = $this -> publisher_model -> __get_publisher_code($publisher);
					$rccode = $co[0] -> pcode;
					if (!$rccode) {
						$co1 = $this -> publisher_model -> __get_publisher_code_child($publisher);
						$rccode = $co1[0] -> pcode;
					}
					
					$code = $rccode .$dpa1. str_pad($ird, 4, "0", STR_PAD_LEFT);
					$this -> books_model -> __update_books($lastID, array('bcode' => $code));
					
					$bbranc = $this -> branch_model -> __get_branch_select();
					foreach($bbranc as $k => $v) {
						$arr = array('itype' => 1, 'ibid' => $lastID, 'ibcid' => $v -> bid, 'istockbegining' => 0, 'istockin' => 0, 'istockout' => 0, 'istockreject' => 0, 'istockretur' => 0, 'istock' => 0, 'istatus' => 1);
						$this -> inventory_model -> __insert_inventory($arr);
					}
					
					if ($co[0] -> pcategory == 2) {
						$sarr = array('ibid' => $lastID, 'ibcid' => 1, 'istockbegining' => 0, 'istockin' => 0, 'istockout' => 0, 'istockreject' => 0, 'istockretur' => 0, 'istock' => 0, 'istatus' => 1);
						$this -> inventory_shadow_model -> __insert_inventory_shadow($sarr);
					}
					
					__set_error_msg(array('info' => 'Buku berhasil ditambahkan.'));
					redirect(site_url('books'));
				}
				else {
					@unlink($fdir .'/'. $fname);
					__set_error_msg(array('error' => 'Gagal menambahkan buku !!!'));
					redirect(site_url('books'));
				}
			}
		}
		else {
			$view['publisher'] = $this -> publisher_lib -> __get_publisher();
			$this->load->view(__FUNCTION__, $view);
		}
	}
	
	function books_update($id) {
		if ($_POST) {
			$id = (int) $this -> input -> post('id');
			$title = $this -> input -> post('title', TRUE);
			$desc = $this -> input -> post('desc', TRUE);
			$isbn = $this -> input -> post('isbn', TRUE);
			$price = str_replace(',','',$this -> input -> post('price', TRUE));
			$publisher = (int) $this -> input -> post('publisher');
			$tax = (int) $this -> input -> post('tax');
			$pack = (int) $this -> input -> post('pack');
			$disc = (int) $this -> input -> post('disc');
			$status = (int) $this -> input -> post('status');
			$pengarang = $this -> input -> post('pengarang', TRUE);
			$my = $this -> input -> post('my', TRUE);
			$width = (int) $this -> input -> post('width');
			$height = (int) $this -> input -> post('height');
			$pages = (int) $this -> input -> post('pages');
			$sfile = $this -> input -> post('sfile', TRUE);

			if ($id) {
				if (!$title) {
					__set_error_msg(array('error' => 'Judul harus di isi !!!'));
					redirect(site_url('books' . '/' . __FUNCTION__ . '/' . $id));
				}
				else if (!$my || !$pages) {
					__set_error_msg(array('error' => 'Bulan-Tahun dan Total Pages harus di isi !!!'));
					redirect(site_url('books' . '/' . __FUNCTION__ . '/' . $id));
				}
				else if (!$width || !$height) {
					__set_error_msg(array('error' => 'Panjang dan lebar harus di isi !!!'));
					redirect(site_url('books' . '/' . __FUNCTION__ . '/' . $id));
				}
				else if (!$publisher || !$pengarang) {
					__set_error_msg(array('error' => 'Pengarang dan publisher harus di isi !!!'));
					redirect(site_url('books' . '/' . __FUNCTION__ . '/' . $id));
				}
				else if (!$isbn) {
					__set_error_msg(array('error' => 'Kode ISBN harus di isi !!!'));
					redirect(site_url('books' . '/' . __FUNCTION__ . '/' . $id));
				}
				else if (!$price) {
					__set_error_msg(array('error' => 'Harga harus di isi !!!'));
					redirect(site_url('books' . '/' . __FUNCTION__ . '/' . $id));
				}
				else {
					$rbk = $this -> books_model -> __get_total_category_book($publisher);
					
					$dpa = $this -> publisher_model -> __get_publisher_detail($publisher);
					if ($dpa[0] -> pparent == 0) {
						$dpa1 = '01';
					}
					else {
						$wew = $this  -> publisher_model -> __get_publisher(2, $dpa[0] -> pparent);
						$i = 2;
						foreach($wew as $k => $v) :
							if ($v -> pid == $publisher) {
								$dpa1 = str_pad($i, 2, "0", STR_PAD_LEFT);
								break;
							}
							++$i;
						endforeach;
					}
					
					$ird = 1;
					foreach($rbk as $k => $v) {
						if ($v -> bid == $id) {
							$ird = ($k+1);
							break;
						}
					}
					
					$co = $this -> publisher_model -> __get_publisher_code($publisher);
					$code = $co[0] -> pcode .$dpa1. str_pad($ird, 4, "0", STR_PAD_LEFT);

					$arr = array('bcode' => $code, 'bauthor' => $pengarang, 'bpublisher' => $publisher, 'btitle' => $title, 'btax' => $tax, 'bprice' => $price, 'bpack' => $pack, 'bdisc' => $disc, 'bisbn' => $isbn, 'bhw' => $height . '*' . $width, 'bmonthyear' => $my, 'btotalpages' => $pages, 'bdesc' => $desc, 'bstatus' => $status);
					
					if ($_FILES["file"]['name']) {
						$fname = time() . uniqid() . $_FILES['file']['name'];
						$fdir = __get_path_upload('cover', 1);
						
						if (!is_dir($fdir)) mkdir($fdir);
						$rarr = array('bcover' => $fname);
						if (move_uploaded_file($_FILES["file"]["tmp_name"], $fdir. $fname)) {
							if (file_exists($dir . $sfile)) @unlink($dir . $sfile);
							$arr = array_merge($arr, $rarr);
						}
						else {
							__set_error_msg(array('error' => 'Gagal upload data !!!'));
							redirect(site_url('books' . '/' . __FUNCTION__ . '/' . $id));
						}
					}
					
					if ($this -> books_model -> __update_books($id, $arr)) {
						if ($this -> books_model -> __get_total_category_book($publisher) != $publisher) {
							$rbk = $this -> books_model -> __get_total_category_book($publisher);
							
							$ird = 1;
							foreach($rbk as $k => $v) {
								if ($v -> bid == $id) {
									$ird = ($k+1);
									break;
								}
							}
							
							$rcode = $co[0] -> pcode .$dpa1. str_pad($ird, 4, "0", STR_PAD_LEFT);
							$this -> books_model -> __update_books($id, array('bcode' => $rcode));
						}
						
						__set_error_msg(array('info' => 'Buku berhasil diubah.'));
						redirect(site_url('books'));
					}
					else {
						__set_error_msg(array('error' => 'Gagal mengubah buku !!!'));
						redirect(site_url('books'));
					}
				}
			}
			else {
				__set_error_msg(array('error' => 'Kesalahan input data !!!'));
				redirect(site_url('books'));
			}
		}
		else {
			$view['id'] = $id;
			$view['detail'] = $this -> books_model -> __get_books_detail($id);
			$view['publisher'] = $this -> publisher_lib -> __get_publisher($view['detail'][0] -> bpublisher);
			$this->load->view(__FUNCTION__, $view);
		}
	}

	function get_suggestion() {
		$hint = '';
		$a = array();
		$q = urldecode($_SERVER['QUERY_STRING']);
		if (strlen($q) < 3) return false;
		$get_books = $this -> memcachedlib -> get('__books_suggestion', true);
		
		if (!$get_books) {
			$arr = $this -> books_model -> __get_suggestion();
			$this -> memcachedlib -> set('__books_suggestion', $arr, 3600,true);
			$get_books = $this -> memcachedlib -> get('__books_suggestion', true);
		}
		
		foreach($get_books as $k => $v) $a[] = array('name' => $v['name'], 'id' => $v['bid']);
		
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
					$hint .='<div class="autocomplete-suggestion" data-index="'.$i.'" ids="'.$a[$i]['id'].'">'.$a[$i]['name'].'</div>';
					$is_suggestion_added = true;
				}
				for ($j=0;$j<$num_words && !$is_suggestion_added;$j++) {
					if(strtolower($q)==strtolower(substr($a[$i]['name'],$pos[$j],strlen($q)))){
						$hint .='<div class="autocomplete-suggestion" data-index="'.$i.'" ids="'.$a[$i]['id'].'">'.$a[$i]['name'].'</div>';
						$is_suggestion_added = true;                                        
					}
				}
			}
		}
		
		echo ($hint == '' ? '<div class="autocomplete-suggestion">No Suggestion</div>' : $hint);
	}
	
	function books_search() {
		$bname = urlencode($this -> input -> post('bname', true));
		
		if ($bname)
			redirect(site_url('books/books_search_result/'.$bname));
		else
			redirect(site_url('books'));
	}
	
	function books_search_result($keyword) {
		$pager = $this -> pagination_lib -> pagination($this -> books_model -> __get_books_search(urldecode($keyword)),3,10,site_url('books/books_search_result/' . $keyword));
		$view['books'] = $this -> pagination_lib -> paginate();
		$view['pages'] = $this -> pagination_lib -> pages();
		$this -> load -> view('books', $view);
	}
	
	function export($type) {
		if ($type == 'excel') {
			ini_set('memory_limit', '-1');
			$this -> load -> library('excel');
			$data = $this -> books_model -> __export();
			$arr = array();
			foreach($data as $K => $v) {
				$arr[] = array($v['bcode'],$v['btitle'],$v['pname'],$v['bauthor'],$v['btax'],$v['bprice'],$v['bpack'],$v['bdisc'],$v['bisbn'],$v['bmonthyear'],$v['bhw'],$v['btotalpages'],$v['bdesc']);
			}
			
			$data = array('header' => array('Code', 'Judul', 'Publisher','Pengarang','Pajak','Harga','Kemasan','Diskon','ISBN','Bulan/Tahun','Panjang/Lebar', 'Total Halaman', 'Keterangan'), 'data' => $arr);

			$this -> excel -> sEncoding = 'UTF-8';
			$this -> excel -> bConvertTypes = false;
			$this -> excel -> sWorksheetTitle = 'Daftar Buku - PT. Niaga Swadaya';
			
			$this -> excel -> addArray($data);
			$this -> excel -> generateXML('books');
		}
	}
	
	function books_delete($id) {
		if ($this -> books_model -> __delete_books($id)) {
			__set_error_msg(array('info' => 'Data berhasil dihapus.'));
			redirect(site_url('books'));
		}
		else {
			__set_error_msg(array('error' => 'Gagal hapus data !!!'));
			redirect(site_url('books'));
		}
	}
}
