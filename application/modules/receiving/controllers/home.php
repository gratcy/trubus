<?php
/* -*- tab-width: 2; indent-tabs-mode: nil; c-basic-offset: 2 -*- */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {
	function __construct() {
		parent::__construct();
		$this -> load -> library('pagination_lib');
		$this -> load -> library('branch/branch_lib');
		$this -> load -> library('request/request_lib');
		$this -> load -> library('publisher/publisher_lib');
		$this -> load -> model('request/request_model');
		$this -> load -> model('books/books_model');
		$this -> load -> model('receiving_model');
		$this -> load -> library('excel_reader');
	}

	function index() {
		(!$this -> memcachedlib -> get('__receiving_books') ? '' : $this -> memcachedlib -> delete('__receiving_books'));
		$pager = $this -> pagination_lib -> pagination($this -> receiving_model -> __get_receiving($this -> memcachedlib -> sesresult['ubranchid']),3,10,site_url('receiving'));
		$view['receiving'] = $this -> pagination_lib -> paginate();
		$view['pages'] = $this -> pagination_lib -> pages();
		$this->load->view('receiving', $view);
	}
	
	function receiving_add() {
		if ($_POST) {
			$id = (int) $this -> input -> post('id');
			$rid = (int) $this -> input -> post('rid');
			$desc = $this -> input -> post('desc', TRUE);
			$docno = $this -> input -> post('docno', TRUE);
			$books = $this -> input -> post('books');
			$waktu = str_replace('/','-',$this -> input -> post('waktu', TRUE));
			$branch = (int) $this -> input -> post('branch');
			$rtype = (int) $this -> input -> post('rtype');
			$status = (int) $this -> input -> post('status');

			if (!$docno || !$rid || !$branch) {
				__set_error_msg(array('error' => 'Data yang anda masukkan tidak lengkap !!!'));
				redirect(site_url('receiving' . '/' . __FUNCTION__));
			}
			else {
				$fname = $_FILES['file']['name'];
				if ($fname) {
					if (substr($fname,-4) != '.xls' && $_FILES['file']['type'] != 'application/vnd.ms-excel') {
						__set_error_msg(array('error' => 'Format file salah, harus .xls !!!'));
						redirect(site_url('receiving' . '/' . __FUNCTION__));
					}
					
					$data = array('error' => false);
					$this -> excel_reader -> setOutputEncoding('CP1251');
					$this -> excel_reader -> read($_FILES['file']['tmp_name']);
					$data = $this->excel_reader->sheets[0];
					
					for($i=2;$i<=$data['numRows'];++$i) {
						$bk = $this -> books_model -> __get_books_by_code($data['cells'][$i][1]);
						if ($bk) $books[$bk] = $data['cells'][$i][2];
					}
				}
				
				$arr = array('ruid' => $this -> memcachedlib -> sesresult['uid'], 'rbid' => $branch,'rtype' => $rtype, 'rdocno' => $docno, 'riid' => $rid, 'rdate' => strtotime($waktu), 'rdesc' => $desc, 'rstatus' => $status);
				if ($this -> receiving_model -> __insert_receiving($arr)) {
					$rrid = $this -> db -> insert_id();
					foreach($books as $k => $v)
						$this -> receiving_model -> __insert_receiving_books(array('rrid' => $rrid,'rbcid' => $this -> memcachedlib -> sesresult['ubranchid'],'rbid' => $k,'rqty' => $v,'rstatus' => 1));
						
					__set_error_msg(array('info' => 'Data berhasil ditambahkan.'));
					redirect(site_url('receiving'));
				}
				else {
					__set_error_msg(array('error' => 'Gagal menambahkan data !!!'));
					redirect(site_url('receiving'));
				}
			}
		}
		else {
			$view['branch'] = $this -> branch_lib -> __get_branch();
			$this->load->view(__FUNCTION__, $view);
		}
	}
	
	function receiving_update($id) {
		if ($_POST) {
			$id = (int) $this -> input -> post('id');
			$rid = (int) $this -> input -> post('rid');
			$desc = $this -> input -> post('desc', TRUE);
			$docno = $this -> input -> post('docno', TRUE);
			$books = $this -> input -> post('books');
			$waktu = str_replace('/','-',$this -> input -> post('waktu', TRUE));
			$rtype = (int) $this -> input -> post('rtype');
			$app = (int) $this -> input -> post('app');

			if ($app == 1) $status = 3;
			else $status = (int) $this -> input -> post('status');
			
			if ($id) {
				if (!$docno || !$rid) {
					__set_error_msg(array('error' => 'Data yang anda masukkan tidak lengkap !!!'));
					redirect(site_url('receiving' . '/' . __FUNCTION__ . '/' . $id));
				}
				else {
					$upa = false;
					$fname = $_FILES['file']['name'];
					if ($fname) {
						if (substr($fname,-4) != '.xls' && $_FILES['file']['type'] != 'application/vnd.ms-excel') {
							__set_error_msg(array('error' => 'Format file salah, harus .xls !!!'));
							redirect(site_url('receiving' . '/' . __FUNCTION__ . '/' . $id));
						}
						
						$data = array('error' => false);
						$this -> excel_reader -> setOutputEncoding('CP1251');
						$this -> excel_reader -> read($_FILES['file']['tmp_name']);
						$data = $this->excel_reader->sheets[0];
						$nbooks = array();
						for($i=2;$i<=$data['numRows'];++$i) {
							$bk = $this -> books_model -> __get_books_by_code($data['cells'][$i][1]);
							if ($bk) $nbooks[$bk] = $data['cells'][$i][2];
						}
						foreach($nbooks as $k => $v)
							$this -> receiving_model -> __insert_receiving_books(array('rrid' => $id,'rbcid' => $this -> memcachedlib -> sesresult['ubranchid'],'rbid' => $k,'rqty' => $v,'rstatus' => 1));
						
						$upa = true;
					}
					
					$arr = array('rtype' => $rtype, 'rdocno' => $docno, 'riid' => $rid, 'rdate' => strtotime($waktu), 'rdesc' => $desc, 'rluid' => $this -> memcachedlib -> sesresult['uid'], 'rldate' => time(), 'rstatus' => $status);
					if ($this -> receiving_model -> __update_receiving($id, $arr)) {
						$bid = 0;
						foreach($books as $k => $v) {
							$this -> receiving_model -> __update_receiving_books($k,array('rqty' => $v));
							$bid = $this -> receiving_model -> __get_receiving_books_detail($k);

							if ($app == 1) {
								$iv = $this -> receiving_model -> __get_inventory_detail($bid[0] -> rbid,$this -> memcachedlib -> sesresult['ubranchid']);
								$this -> receiving_model -> __update_inventory($bid[0] -> rbid,$this -> memcachedlib -> sesresult['ubranchid'],array('istockin' => ($iv[0] -> istockin+$v),'istock' => ($iv[0] -> istock + $v)));
								
								$bd = $this -> books_model -> __get_books_detail($bid[0] -> rbid);
								$co = $this -> publisher_model -> __get_publisher_code($bd[0] -> bpublisher);
								if ($co[0] -> pcategory == 2 || !$co[0] -> pcategory) {
									$ih = $this -> receiving_model -> __get_inventory_shadow_detail($bid[0] -> rbid,$this -> memcachedlib -> sesresult['ubranchid']);
									$this -> receiving_model -> __update_inventory_shadow($bid[0] -> rbid,$this -> memcachedlib -> sesresult['ubranchid'],array('istockin' => ($ih[0] -> istockin+$v),'istock' => ($ih[0] -> istock + $v)));
								}
							}
						}
					
						__set_error_msg(array('info' => 'Data berhasil diubah'.($upa == true ? ' dan buku berhasil di import' : '').'.'));
						redirect(site_url('receiving'));
					}
					else {
						__set_error_msg(array('error' => 'Gagal mengubah data !!!'));
						redirect(site_url('receiving'));
					}
				}
			}
			else {
				__set_error_msg(array('error' => 'Kesalahan input data !!!'));
				redirect(site_url('receiving'));
			}
		}
		else {
			$view['id'] = $id;
			$view['detail'] = $this -> receiving_model -> __get_receiving_detail($id);
			$view['branch'] = $this -> branch_lib -> __get_branch($view['detail'][0] -> rbid);
			$this->load->view(__FUNCTION__, $view);
		}
	}
	
	function receiving_types($type,$id) {
		$res = '<select name="rid" class="form-control" id="rid">';
		if ($type == 1)
			$res .= $this -> request_lib -> __get_request($id,$this -> memcachedlib -> sesresult['ubranchid'],3);
		else
			$res .= $this -> publisher_lib -> __get_publisher($id);
		$res .= '</select>';
		echo $res;
	}
	
	function receiving_books($did) {
		if ($did) {
			$view['type'] = 2;
			$view['did'] = $did;
			$view['books'] = $this -> receiving_model -> __get_books($did, 2);
		}
		else {
			$bid = $this -> memcachedlib -> get('__receiving_books');
			if (!$bid) return false;
			$bid = implode(',',$bid);

			if ($bid) {
				$view['type'] = 1;
				$view['books'] = $this -> receiving_model -> __get_books($bid, 1);
			}
		}
		$this->load->view('tmp/' . __FUNCTION__, $view, FALSE);
	}
	
	function receiving_books_delete($type) {
		$bid = (int) $this -> input -> post('bid');
		$did = (int) $this -> input -> post('did');
		
		if ($bid) {
			if ($type == 1) {
				$books = $this -> memcachedlib -> get('__receiving_books');
				$arr = array();
				foreach($books as $v)
					if ($v <> $bid) $arr[] = $v;
				$this -> memcachedlib -> set('__receiving_books', $arr, 900);
			}
			else
				if ($did) $this -> receiving_model -> __delete_receiving_books($did,$bid);
		}
	}
	
	function receiving_books_add($type) {
		$bid = $this -> input -> post('bid');
		if (!$bid) {
			__set_error_msg(array('error' => 'Buku harus dipilih !!!'));
			redirect(site_url('receiving/receiving_list_books/' . $type));
		}
		else {
			if ($type == 1) {
				$DidN = (!$this -> memcachedlib -> get('__receiving_books') ? array() : $this -> memcachedlib -> get('__receiving_books'));
				$this -> memcachedlib -> set('__receiving_books', array_unique(array_merge($DidN,$bid)), 900);
			}
			else {
				$drid = (int) $this -> input -> post('did');
				foreach($bid as $k => $v)
					$this -> receiving_model -> __insert_receiving_books(array('rrid' => $drid,'rbid' => $v, 'rqty' => 0, 'rstatus' => 1));
			}

			__set_error_msg(array('info' => 'Buku berhasil ditambahkan.'));
			redirect(site_url('receiving/receiving_list_books/' . $type));
		}
	}
	
	function receiving_list_books($type, $did) {
		$keyword = $this -> input -> get('keyword');
		$keyword = addslashes(urldecode($keyword));
		$dids = $this -> input -> get('did');
		if ($dids) {
			$did = $dids;
		}
		
		if (!$keyword)
		$pager = $this -> pagination_lib -> pagination($this -> books_model -> __get_books(),3,10,site_url('receiving/receiving_list_books/' . $type));
		else
		$pager = $this -> pagination_lib -> pagination($this -> books_model -> __get_books_search($keyword),3,1000,site_url('receiving/receiving_list_books/' . $type));
		
		$view['books'] = $this -> pagination_lib -> paginate();
		$view['pages'] = $this -> pagination_lib -> pages();
		$view['type'] = $type;
		$view['did'] = $did;
		$this->load->view('tmp/' . __FUNCTION__, $view, FALSE);
	}
	
	function receiving_detail($id) {
		$view['books'] = $this -> receiving_model -> __get_books($id, 2);
		$view['detail'] = $this -> receiving_model -> __get_receiving_detail($id);
		if ($view['detail'][0] -> rstatus != 3) redirect(site_url('receiving'));
		$this->load->view(__FUNCTION__, $view);
	}
	
	function receiving_delete($id) {
		if ($this -> receiving_model -> __delete_receiving($id)) {
			__set_error_msg(array('info' => 'Data berhasil dihapus.'));
			redirect(site_url('receiving'));
		}
		else {
			__set_error_msg(array('error' => 'Gagal hapus data !!!'));
			redirect(site_url('receiving'));
		}
	}
	
	function get_suggestion() {
		header('Content-type: application/javascript');
		$hint = array();
		$a = array();
		$q = urldecode($_SERVER['QUERY_STRING']);
		if (strlen($q) < 2) return false;
		$q = str_replace('-',' ',$q);
		$get_suggestion = $this -> memcachedlib -> get('__receiving_suggestion_' . $this -> memcachedlib -> sesresult['ubranchid'], true);

		if (!$get_suggestion) {
			$arr = $this -> receiving_model -> __get_suggestion($this -> memcachedlib -> sesresult['ubranchid']);
			$this -> memcachedlib -> set('__receiving_suggestion_' . $this -> memcachedlib -> sesresult['ubranchid'], $arr, 3600,true);
			$get_suggestion = $this -> memcachedlib -> get('__receiving_suggestion_' . $this -> memcachedlib -> sesresult['ubranchid'], true);
		}
		
		$data = $get_suggestion;
		foreach($data as $k => $v) {
			$a[] = array('name' => $v['name'], 'id' => $v['rid']);
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
	
	function receiving_search() {
		$keyword = urlencode(base64_encode($this -> input -> post('keyword', true)));
		
		if ($keyword)
			redirect(site_url('receiving/receiving_search_result/'.$keyword));
		else
			redirect(site_url('receiving'));
	}
	
	function receiving_search_result($keyword) {
		$dkeyword = addslashes(base64_decode(urldecode($keyword)));
		$pager = $this -> pagination_lib -> pagination($this -> receiving_model -> __get_receiving_search($this -> memcachedlib -> sesresult['ubranchid'],urldecode($dkeyword)),3,10,site_url('receiving/receiving_search_result/' . $keyword));
		$view['receiving'] = $this -> pagination_lib -> paginate();
		$view['pages'] = $this -> pagination_lib -> pages();
		$this -> load -> view('receiving', $view);
	}
	
	function export($type,$id) {
		if ($type == 'excel') {
			ini_set('memory_limit', '-1');
			$this -> load -> library('excel');
			$data = $this -> receiving_model -> __export($this -> memcachedlib -> sesresult['ubranchid']);
			
			$arr = array();
			foreach($data as $K => $v)
				$arr[] = array($v -> rdocno, __get_receiving_type($v -> rtype,1),__get_receiving_name($v -> riid, $v -> rtype), __get_date($v -> rdate), $v -> rdesc, $v -> total_books, ($v -> rstatus == 3 ? 'Approved' : __get_status($v -> rstatus,1)));
			
			$data = array('header' => array('Doc No.', 'Type', 'Request No. / Publisher','Date','Description','Total Books','Status'), 'data' => $arr);

			$this -> excel -> sEncoding = 'UTF-8';
			$this -> excel -> bConvertTypes = false;
			$this -> excel -> sWorksheetTitle = 'Item Receiving - PT. Niaga Swadaya';
			
			$this -> excel -> addArray($data);
			$this -> excel -> generateXML('dist-receiving-' . date('Ymd'));
		}
		else if ($type == 'excel_detail') {
			$filename ="receiving_detail-".$id.".xls";
			header('Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			header('Content-Disposition: attachment; filename='.$filename);
			header("Cache-Control: max-age=0");
			$view['books'] = $this -> receiving_model -> __get_books($id, 2);
			$view['detail'] = $this -> receiving_model -> __get_receiving_detail($id);
			$view['id'] = $id;
			if ($view['detail'][0] -> rstatus != 3) redirect(site_url('receiving'));
			$this->load->view('print/receiving', $view, false);
		}
	}
}
