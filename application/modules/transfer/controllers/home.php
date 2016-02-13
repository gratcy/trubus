<?php
/* -*- tab-width: 2; indent-tabs-mode: nil; c-basic-offset: 2 -*- */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {
	function __construct() {
		parent::__construct();
		$this -> load -> library('pagination_lib');
		$this -> load -> library('request/request_lib');
		$this -> load -> model('request/request_model');
		$this -> load -> model('receiving/receiving_model');
		$this -> load -> model('branch/branch_model');
		$this -> load -> model('transfer_model');
	}

	function index() {
		$pager = $this -> pagination_lib -> pagination($this -> transfer_model -> __get_transfer($this -> memcachedlib -> sesresult['ubranchid']),3,10,site_url('transfer'));
		$view['transfer'] = $this -> pagination_lib -> paginate();
		$view['pages'] = $this -> pagination_lib -> pages();
		$this->load->view('transfer', $view);
	}
	
	function transfer_add() {
		if ($_POST) {
			$title = $this -> input -> post('title', TRUE);
			$desc = $this -> input -> post('desc', TRUE);
			$waktu = str_replace('/','-',$this -> input -> post('waktu', TRUE));
			$rno = (int) $this -> input -> post('rno');
			$rno2 = (int) $this -> input -> post('rno2');
			$status = (int) $this -> input -> post('status');
			$rtype = (int) $this -> input -> post('rtype');
			
			if ($rtype == 2) $rno = $rno2;
			
			if (!$title || !$rno) {
				__set_error_msg(array('error' => 'Judul dan Request No harus di isi !!!'));
				redirect(site_url('transfer' . '/' . __FUNCTION__));
			}
			else if (!$rtype) {
				__set_error_msg(array('error' => 'Jenis Request harus di isi !!!'));
				redirect(site_url('request' . '/' . __FUNCTION__));
			}
			else {
				$maxid = $this -> transfer_model -> ___get_maxid_transfer();
				$bcode = $this -> branch_model -> __get_branch_code($this -> memcachedlib -> sesresult['ubranchid']);
				$docno = 'T'.$bcode[0] -> bcode.date('m', strtotime($waktu)).date('y', strtotime($waktu)).($maxid[0] -> maxid+1).str_pad($rno, 2, "0", STR_PAD_LEFT);
				
				$arr = array('duid' => $this -> memcachedlib -> sesresult['uid'], 'dtype' => $rtype, 'ddrid' => $rno, 'ddocno' => $docno, 'ddate' => strtotime($waktu), 'dtitle' => $title, 'ddesc' => $desc, 'dstatus' => $status);
				if ($this -> transfer_model -> __insert_transfer($arr)) {
					__set_error_msg(array('info' => 'Data berhasil ditambahkan.'));
					redirect(site_url('transfer'));
				}
				else {
					__set_error_msg(array('error' => 'Gagal menambahkan data !!!'));
					redirect(site_url('transfer'));
				}
			}
		}
		else {
			$view['rno'] = $this -> request_lib -> __get_request(0,$this -> memcachedlib -> sesresult['ubranchid'],1);
			$view['rno2'] = $this -> request_lib -> __get_request(0,$this -> memcachedlib -> sesresult['ubranchid'],2);
			$this->load->view(__FUNCTION__, $view);
		}
	}
	
	function transfer_update($id) {
		if ($_POST) {
			$id = (int) $this -> input -> post('id');
			$title = $this -> input -> post('title', TRUE);
			$desc = $this -> input -> post('desc', TRUE);
			$books = $this -> input -> post('books', TRUE);
			$waktu = str_replace('/','-',$this -> input -> post('waktu', TRUE));
			$rno = (int) $this -> input -> post('rno');
			$rno2 = (int) $this -> input -> post('rno2');
			$app = (int) $this -> input -> post('app');
			$rtype = (int) $this -> input -> post('rtype');
			
			if ($app == 1) $status = 3;
			elseif ($app == 2) $status = 4;
			else $status = (int) $this -> input -> post('status');
			if ($rtype == 2) $rno = $rno2;

			if ($id) {
				if (!$title || !$rno) {
					__set_error_msg(array('error' => 'Judul dan Request No harus di isi !!!'));
					redirect(site_url('transfer' . '/' . __FUNCTION__ . '/' . $id));
				}
				else if (!$rtype) {
					__set_error_msg(array('error' => 'Jenis Request harus di isi !!!'));
					redirect(site_url('request' . '/' . __FUNCTION__ . '/' . $id));
				}
				else {
					$st = false;
					$cd = array();
					
					$req = $this -> request_model -> __get_books($rno,2);
					if ($status == 3) {
						foreach($req as $k => $v) {
							$iv = $this -> receiving_model -> __get_inventory_detail($v -> dbid,$this -> memcachedlib -> sesresult['ubranchid']);
							if ($iv[0] -> istock == 0) {
								$st = true;
								$cd[] = $v -> bcode;
							}
						}
					}
					if ($st == true && $status == 3) {
						__set_error_msg(array('error' => 'Kode Buku "'.implode($cd,', ').'" stok tidak tersedia !!!'));
						redirect(site_url('transfer' . '/' . __FUNCTION__ . '/' . $id));
					}
					else {
						$bcode = $this -> branch_model -> __get_branch_code($this -> memcachedlib -> sesresult['ubranchid']);
						$docno = 'T'.$bcode[0] -> bcode.date('m', strtotime($waktu)).date('y', strtotime($waktu)).$id.str_pad($rno, 2, "0", STR_PAD_LEFT);
						
						if ($app == 2)
							$arr = array('dtype' => $rtype, 'ddate' => strtotime($waktu), 'dtitle' => $title, 'ddesc' => $desc, 'dluid' => $this -> memcachedlib -> sesresult['uid'], 'dldate' => time(), 'dstatus' => $status);
						else
							$arr = array('dtype' => $rtype, 'ddrid' => $rno, 'ddocno' => $docno, 'ddate' => strtotime($waktu), 'dtitle' => $title, 'ddesc' => $desc, 'dluid' => $this -> memcachedlib -> sesresult['uid'], 'dldate' => time(), 'dstatus' => $status);
						
						if ($this -> transfer_model -> __update_transfer($id, $arr)) {
							if ($status == 4) {
								$dbfrom = $this -> request_model -> __get_request_detail($rno);
							
								if ($rtype == 1) {
									$brch = $dbfrom[0] -> dbto;
								}
								else {
									$brch = $this -> memcachedlib -> sesresult['ubranchid'];
									$brchf = $dbfrom[0] -> dbfrom;
								}
								
								foreach($req as $k => $v) {
									$iv = $this -> receiving_model -> __get_inventory_detail($v -> dbid,$brch);
									$this -> receiving_model -> __update_inventory($v -> dbid,$brch,array('istockout' => ($iv[0] -> istockout+$v -> dqty),'istock' => ($iv[0] -> istock - $v -> dqty)));
									
									if ($rtype == 2) {
										$iv2 = $this -> receiving_model -> __get_inventory_detail($v -> dbid,$brchf);
										$this -> receiving_model -> __update_inventory($v -> dbid,$brchf,array('istockout' => ($iv2[0] -> istockout+$v -> dqty),'istock' => ($iv2[0] -> istock - $v -> dqty)));
									}
								}
							}
							
							foreach($books as $k => $v)
								$this -> request_model -> __update_request_books($k,array('dqty' => $v));
							
							__set_error_msg(array('info' => 'Data berhasil diubah.'));
							redirect(site_url('transfer'));
						}
						else {
							__set_error_msg(array('error' => 'Gagal mengubah data !!!'));
							redirect(site_url('transfer'));
						}
					}
				}
			}
			else {
				__set_error_msg(array('error' => 'Kesalahan input data !!!'));
				redirect(site_url('transfer'));
			}
		}
		else {
			$view['id'] = $id;
			$view['detail'] = $this -> transfer_model -> __get_transfer_detail($id);
			$view['rno'] = $this -> request_lib -> __get_request($view['detail'][0] -> ddrid,$this -> memcachedlib -> sesresult['ubranchid'],1);
			$view['rno2'] = $this -> request_lib -> __get_request($view['detail'][0] -> ddrid,$this -> memcachedlib -> sesresult['ubranchid'],2);
			$this->load->view(__FUNCTION__, $view);
		}
	}
	
	function transfer_request_books($did) {
		$view['books'] = $this -> request_model -> __get_books($did, 2);
		$this->load->view('tmp/' . __FUNCTION__, $view, FALSE);
	}
	
	function transfer_detail($id) {
		$view['detail'] = $this -> transfer_model -> __get_transfer_books_detail($id);
		$view['books'] = $this -> request_model -> __get_books($view['detail'][0] -> ddrid, 2);
		$view['id'] = $id;
		if ($view['detail'][0] -> dstatus < 3) redirect(site_url('transfer'));
		$this->load->view(__FUNCTION__, $view);
	}
	
	function transfer_delete($id) {
		if ($this -> transfer_model -> __delete_transfer($id)) {
			__set_error_msg(array('info' => 'Data berhasil dihapus.'));
			redirect(site_url('transfer'));
		}
		else {
			__set_error_msg(array('error' => 'Gagal hapus data !!!'));
			redirect(site_url('transfer'));
		}
	}
	
	function get_suggestion() {
		header('Content-type: application/javascript');
		$hint = array();
		$a = array();
		$q = urldecode($_SERVER['QUERY_STRING']);
		if (strlen($q) < 2) return false;
		$q = str_replace('-',' ',$q);
		$get_suggestion = $this -> memcachedlib -> get('__transfer_suggestion', true);

		if (!$get_suggestion) {
			$arr = $this -> transfer_model -> __get_suggestion();
			$this -> memcachedlib -> set('__transfer_suggestion', $arr, 3600,true);
			$get_suggestion = $this -> memcachedlib -> get('__transfer_suggestion', true);
		}
		
		$get_suggestionR = $this -> memcachedlib -> get('__request_suggestion', true);
		if (!$get_suggestionR) {
			$arr = $this -> request_model -> __get_suggestion();
			$this -> memcachedlib -> set('__request_suggestion', $arr, 1,true);
			$get_suggestionR = $this -> memcachedlib -> get('__request_suggestion', true);
		}
		
		$data = array_merge($get_suggestion,$get_suggestionR);
		foreach($data as $k => $v) {
			if (isset($v['dtype'])) {
				$a[] = array('name' => ($v['dtype'] == 1 ? 'R01' : 'R02').str_pad($v['did'], 4, "0", STR_PAD_LEFT), 'id' => $v['did']);
				$a[] = array('name' => $v['dtitle'], 'id' => $v['did']);
			}
			else {
				$a[] = array('name' => $v['ddocno'], 'id' => $v['did']);
				$a[] = array('name' => $v['dtitle'], 'id' => $v['did']);
			}
		}
		
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
	
	function transfer_search() {
		$keyword = urlencode(base64_encode($this -> input -> post('keyword', true)));
		
		if ($keyword)
			redirect(site_url('transfer/transfer_search_result/'.$keyword));
		else
			redirect(site_url('transfer'));
	}
	
	function transfer_search_result($keyword) {
		$keyword = addslashes(base64_decode(urldecode($keyword)));
		$pager = $this -> pagination_lib -> pagination($this -> transfer_model -> __get_transfer_search($this -> memcachedlib -> sesresult['ubranchid'],urldecode($keyword)),3,10,site_url('transfer/transfer_search_result/' . $keyword));
		$view['transfer'] = $this -> pagination_lib -> paginate();
		$view['pages'] = $this -> pagination_lib -> pages();
		$this -> load -> view('transfer', $view);
	}
	
	function export($type, $id) {
		if ($type == 'excel') {
			ini_set('memory_limit', '-1');
			$this -> load -> library('excel');
			$data = $this -> transfer_model -> __export($this -> memcachedlib -> sesresult['ubranchid']);
			$arr = array();
		
			foreach($data as $K => $v)
				$arr[] = array($v -> ddocno,'R'.str_pad($v -> did, 4, "0", STR_PAD_LEFT),__get_date($v -> ddate), $v -> fbname, $v -> tbname, $v -> dtitle, $v -> ddesc, $v -> total_books, ($v -> dstatus == 3 ? 'Approved' : __get_status($v -> dstatus,1)));
			
			$data = array('header' => array('Doc No.', 'Request No.', 'Date', 'Branch From','Branch To','Title','Description','Total Books','Status'), 'data' => $arr);

			$this -> excel -> sEncoding = 'UTF-8';
			$this -> excel -> bConvertTypes = false;
			$this -> excel -> sWorksheetTitle = 'Distribution Transfer - PT. Niaga Swadaya';
			
			$this -> excel -> addArray($data);
			$this -> excel -> generateXML('dist-transfer-' . date('Ymd'));
		}
		elseif ($type == 'excel_detail') {
			$filename ="transfer_detail-".$id.".xls";
			header('Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			header('Content-Disposition: attachment; filename='.$filename);
			header("Cache-Control: max-age=0");

			$view['detail'] = $this -> transfer_model -> __get_transfer_books_detail($id);
			$view['books'] = $this -> request_model -> __get_books($view['detail'][0] -> ddrid, 2);
			$view['id'] = $id;
		
			if ($view['detail'][0] -> dstatus < 3) redirect(site_url('transfer'));
		
			$this->load->view('print/dist_transfer', $view, false);
		}
	}
}
