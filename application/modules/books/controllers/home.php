<?php
/* -*- tab-width: 2; indent-tabs-mode: nil; c-basic-offset: 2 -*- */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {
	function __construct() {
		parent::__construct();
		$this -> load -> library('pagination_lib');
		$this -> load -> library('publisher/publisher_lib');
		$this -> load -> library('categories/categories_lib');
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
			$cid = (int) $this -> input -> post('cid');
			$desc = $this -> input -> post('desc', TRUE);
			$isbn = $this -> input -> post('isbn', TRUE);
			$pengarang = $this -> input -> post('pengarang', TRUE);
			$my = $this -> input -> post('my', TRUE);
			$width = (int) $this -> input -> post('width');
			$height = (int) $this -> input -> post('height');
			$pages = $this -> input -> post('pages');
			$price = str_replace(',','',$this -> input -> post('price', TRUE));
			$publisher = (int) $this -> input -> post('publisher');
			$group = (int) $this -> input -> post('group');
			$tax = (int) $this -> input -> post('tax');
			$pack = (int) $this -> input -> post('pack');
			$disc = $this -> input -> post('disc');
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
				//~ if (!$_FILES['file']['name']) {
					//~ __set_error_msg(array('error' => 'Cover buku harus diisi !!!'));
					//~ redirect(site_url('books' . '/' . __FUNCTION__));
				//~ }
				//~ $dpa = $this -> publisher_model -> __get_publisher_detail($publisher);
				//~ if ($dpa[0] -> pparent == 0) {
					//~ $dpa1 = '01';
				//~ }
				//~ else {
					//~ $wew = $this  -> publisher_model -> __get_publisher(2, $dpa[0] -> pparent);
					//~ $i = 2;
					//~ foreach($wew as $k => $v) :
						//~ if ($v -> pid == $publisher) {
							//~ $dpa1 = str_pad($i, 2, "0", STR_PAD_LEFT);
							//~ break;
						//~ }
						//~ ++$i;
					//~ endforeach;
				//~ }
				
				$fname = time() . uniqid() . $_FILES['file']['name'];
				$fdir = __get_path_upload('cover', 1);
				
				if (!is_dir($fdir)) mkdir($fdir);
				
				if (move_uploaded_file($_FILES["file"]["tmp_name"], $fdir .'/'. $fname))
					$fname = $fname;
				else
					$fname = '';
					
				$rbk = $this -> books_model -> __get_last_book_by_publisher($publisher);
				$lrbk = (int) substr($rbk[0] -> bcode, -4) + 1;
					
				$co = $this -> publisher_model -> __get_publisher_code($publisher);
				$rccode = $co[0] -> pcode;
					
				$code = $rccode .__get_publisher_imprint($publisher). str_pad($lrbk, 4, "0", STR_PAD_LEFT);
				
				$arr = array('bcid' => $cid, 'bdate' => time(), 'bcode' => $code, 'bauthor' => $pengarang, 'bpublisher' => $publisher, 'btitle' => $title, 'btax' => $tax, 'bprice' => $price, 'bpack' => $pack, 'bdisc' => $disc, 'bisbn' => $isbn, 'bhw' => $height . '*' . $width, 'bmonthyear' => $my, 'btotalpages' => $pages, 'bcover' => $fname, 'bdesc' => $desc, 'bstatus' => $status);
				if ($this -> books_model -> __insert_books($arr)) {
					$lastID = $this -> db -> insert_id();
					
					//~ $ird = 1;
					//~ foreach($rbk as $k => $v) {
						//~ if ($v -> bid == $lastID) {
							//~ $ird = ($k+1);
							//~ break;
						//~ }
					//~ }
					if (!$rccode) {
						$co1 = $this -> publisher_model -> __get_publisher_code_child($publisher);
						$rccode = $co1[0] -> pcode;
					}
					
					$bbranc = $this -> branch_model -> __get_branch_select();
					foreach($bbranc as $k => $v) {
						$arr = array('itype' => 1, 'ibid' => $lastID, 'ibcid' => $v -> bid, 'istockbegining' => 0, 'istockin' => 0, 'istockout' => 0, 'istockreject' => 0, 'istockretur' => 0, 'istock' => 0, 'istatus' => 1);
						$this -> inventory_model -> __insert_inventory($arr);
					}
					
					if ($co[0] -> pcategory == 2) {
						$sarr = array('ibid' => $lastID, 'ibcid' => 1, 'istockbegining' => 0, 'istockin' => 0, 'istockout' => 0, 'istockreject' => 0, 'istockretur' => 0, 'istock' => 0, 'istatus' => 1);
						$this -> inventory_shadow_model -> __insert_inventory_shadow($sarr);
					}
					
					$arr = $this -> books_model -> __get_suggestion();
					$this -> memcachedlib -> __regenerate_cache('__books_suggestion', $arr, $_SERVER['REQUEST_TIME']+60*60*24*100, true);
					
					if ($status == 1) $this -> memcachedlib -> __regenerate_cache('__new_books', array('total' => ($this -> memcachedlib -> get('__new_books', true)['total']+1)), $_SERVER['REQUEST_TIME']+60*60*24*100, true);
					
					$this -> memcachedlib -> delete('__trans_suggeest_2_'.$this -> memcachedlib -> sesresult['ubranchid']);
					$this -> memcachedlib -> delete('__trans_suggeest_4');

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
			$view['categories'] = $this -> categories_lib -> __get_categories(0,2);
			$this->load->view(__FUNCTION__, $view);
		}
	}
	
	function books_update($id) {
		if ($_POST) {
			$id = (int) $this -> input -> post('id');
			$cid = (int) $this -> input -> post('cid');
			$title = $this -> input -> post('title', TRUE);
			$desc = $this -> input -> post('desc', TRUE);
			$isbn = $this -> input -> post('isbn', TRUE);
			$price = str_replace(',','',$this -> input -> post('price', TRUE));
			$publisher = (int) $this -> input -> post('publisher');
			$tax = (int) $this -> input -> post('tax');
			$pack = (int) $this -> input -> post('pack');
			$disc =  $this -> input -> post('disc');
			$status = (int) $this -> input -> post('status');
			$pengarang = $this -> input -> post('pengarang', TRUE);
			$my = $this -> input -> post('my', TRUE);
			$width = (int) $this -> input -> post('width');
			$height = (int) $this -> input -> post('height');
			$publisherold = (int) $this -> input -> post('publisherold');
			$pages = $this -> input -> post('pages');
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
					$rbk = $this -> books_model -> __get_last_book_by_publisher($publisher);
					$ird = (int) substr($rbk[0] -> bcode, -4) + 1;
					//~ $dpa = $this -> publisher_model -> __get_publisher_detail($publisher);
					//~ if ($dpa[0] -> pparent == 0) {
						//~ $dpa1 = '01';
					//~ }
					//~ else {
						//~ $wew = $this  -> publisher_model -> __get_publisher(2, $dpa[0] -> pparent);
						//~ $i = 2;
						//~ foreach($wew as $k => $v) :
							//~ if ($v -> pid == $publisher) {
								//~ $dpa1 = str_pad($i, 2, "0", STR_PAD_LEFT);
								//~ break;
							//~ }
							//~ ++$i;
						//~ endforeach;
					//~ }
					
					//~ $ird = 1;
					//~ foreach($rbk as $k => $v) {
						//~ if ($v -> bid == $id) {
							//~ $ird = ($k+1);
							//~ break;
						//~ }
					//~ }
					
					$co = $this -> publisher_model -> __get_publisher_code($publisher);
					$code = $co[0] -> pcode .__get_publisher_imprint($publisher). str_pad($ird, 4, "0", STR_PAD_LEFT);
					
					if ($publisherold == $publisher)
						$arr = array('bcid' => $cid, 'bauthor' => $pengarang, 'bpublisher' => $publisher, 'btitle' => $title, 'btax' => $tax, 'bprice' => $price, 'bpack' => $pack, 'bdisc' => $disc, 'bisbn' => $isbn, 'bhw' => $height . '*' . $width, 'bmonthyear' => $my, 'btotalpages' => $pages, 'bdesc' => $desc, 'bstatus' => $status);
					else
						$arr = array('bcid' => $cid,'bcode' => $code, 'bauthor' => $pengarang, 'bpublisher' => $publisher, 'btitle' => $title, 'btax' => $tax, 'bprice' => $price, 'bpack' => $pack, 'bdisc' => $disc, 'bisbn' => $isbn, 'bhw' => $height . '*' . $width, 'bmonthyear' => $my, 'btotalpages' => $pages, 'bdesc' => $desc, 'bstatus' => $status);
					
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
						//~ if ($this -> books_model -> __get_total_category_book($publisher) != $publisher) {
							//~ $rbk = $this -> books_model -> __get_total_category_book($publisher);
							
							//~ $ird = count($rbk)+1;
							
							//~ $rcode = $co[0] -> pcode .__get_publisher_imprint($publisher). str_pad($ird, 4, "0", STR_PAD_LEFT);
							//~ $this -> books_model -> __update_books($id, array('bcode' => $rcode));
						//~ }
						
						
						$arr = $this -> books_model -> __get_suggestion();
						$this -> memcachedlib -> __regenerate_cache('__books_suggestion', $arr, $_SERVER['REQUEST_TIME']+60*60*24*100, true);
						$this -> memcachedlib -> memcached_obj -> delete('__trans_suggeest_2_'.$this -> memcachedlib -> sesresult['ubranchid']);
						$this -> memcachedlib -> delete('__trans_suggeest_4');
						
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
			$view['categories'] = $this -> categories_lib -> __get_categories($view['detail'][0] -> bcid,2);
			$view['publisher'] = $this -> publisher_lib -> __get_publisher($view['detail'][0] -> bpublisher);
			$this->load->view(__FUNCTION__, $view);
		}
	}

	function get_suggestion() {
		header('Content-type: application/javascript');
		$hint = array();
		$a = array();
		$q = urldecode($_SERVER['QUERY_STRING']);
		if (strlen($q) < 3) return false;
		$get_books = $this -> memcachedlib -> get('__books_suggestion', true);
		
		if (!$get_books) {
			$arr = $this -> books_model -> __get_suggestion();
			$this -> memcachedlib -> set('__books_suggestion', $arr, $_SERVER['REQUEST_TIME']+60*60*24*100,true);
			$get_books = $this -> memcachedlib -> get('__books_suggestion', true);
		}
		$get_pub = $this -> memcachedlib -> get('__publisher_suggestion', true);

		if (!$get_pub) {
			$arr = $this -> publisher_model -> __get_suggestion();
			$this -> memcachedlib -> set('__publisher_suggestion', $arr, 3600,true);
			$get_pub = $this -> memcachedlib -> get('__publisher_suggestion', true);
		}
		
		$arr = array_merge($get_pub,$get_books);
		foreach($arr as $k => $v) $a[] = array('name' => $v['name'], 'id' => (isset($v['bid']) ? $v['bid'] : $v['pid']));
		
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
	
	function books_search() {
		$bname = urlencode(base64_encode($this -> input -> post('bname', true)));
		
		if ($bname)
			redirect(site_url('books/books_search_result/'.$bname));
		else
			redirect(site_url('books'));
	}
	
	function books_search_result($keyword) {
		$dkeyword = $keyword;
		$keyword = html_entity_decode(strtolower(addslashes(base64_decode(urldecode($keyword)))));
		$keyword = strtoupper($keyword);
		$pager = $this -> pagination_lib -> pagination($this -> books_model -> __get_books_search($keyword),3,10,site_url('books/books_search_result/' . $dkeyword));
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
			
			foreach($data as $K => $v)
				$arr[] = array($v['bcode'],$v['btitle'],$v['pname'],$v['cname'],$v['bauthor'],__get_tax($v['btax'],1),$v['bprice'],__get_packs($v['bpack'],1),$v['bdisc'],$v['bisbn'],$v['bmonthyear'],$v['bhw'],$v['btotalpages'],$v['bdesc']);
			
			$data = array('header' => array('Code', 'Judul', 'Publisher','Category Book','Pengarang','Pajak','Harga','Kemasan','Diskon','ISBN','Bulan/Tahun','Panjang/Lebar', 'Total Halaman', 'Keterangan'), 'data' => $arr);

			$this -> excel -> sEncoding = 'UTF-8';
			$this -> excel -> bConvertTypes = false;
			$this -> excel -> sWorksheetTitle = 'Daftar Buku - PT. Niaga Swadaya';
			
			$this -> excel -> addArray($data);
			$this -> excel -> generateXML('books');
		}
	}
	
	function books_delete($id) {
		if ($this -> books_model -> __delete_books($id)) {
			$arr = $this -> books_model -> __get_suggestion();
			$this -> memcachedlib -> __regenerate_cache('__books_suggestion', $arr, $_SERVER['REQUEST_TIME']+60*60*24*100);
			$this -> memcachedlib -> delete('__trans_suggeest_2_'.$this -> memcachedlib -> sesresult['ubranchid']);
			$this -> memcachedlib -> delete('__trans_suggeest_4');
			__set_error_msg(array('info' => 'Data berhasil dihapus.'));
			redirect(site_url('books'));
		}
		else {
			__set_error_msg(array('error' => 'Gagal hapus data !!!'));
			redirect(site_url('books'));
		}
	}
}
