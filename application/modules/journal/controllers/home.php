<?php
/* -*- tab-width: 2; indent-tabs-mode: nil; c-basic-offset: 2 -*- */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {
	function __construct() {
		parent::__construct();
		$this -> load -> library('pagination_lib');
		$this -> load -> model('journal_model');
		$this -> load -> model('closingperiod/closingperiod_model');
		$this -> load -> helper('accounting');
		$this -> load -> library('coa/coa_lib');
	}

	function index() {
		$pager = $this -> pagination_lib -> pagination($this -> journal_model -> __get_journal($this -> memcachedlib -> sesresult['ubranchid']),3,10,site_url('journal'));
		$view['journal'] = $this -> pagination_lib -> paginate();
		$view['pages'] = $this -> pagination_lib -> pages();
		$this->load->view('journal', $view);
	}
	
	function journal_add() {
		if ($_POST) {
			$type = (int) $this -> input -> post('type');
			$ispost = (int) $this -> input -> post('ispost');
			$title = $this -> input -> post('title', TRUE);
			$desc = $this -> input -> post('desc', TRUE);
			$docref = $this -> input -> post('docref', TRUE);
			$status = (int) $this -> input -> post('status');
			$numrows = (int) $this -> input -> post('numrows');
			
			$coas = $this -> input -> post('coas');
			$debit = $this -> input -> post('debit');
			$credit = $this -> input -> post('credit');
			$descc = $this -> input -> post('descc');
			
			if (!$title) {
				__set_error_msg(array('error' => 'Judul harus diisi !!!'));
				redirect(site_url('journal' . '/' . __FUNCTION__));
			}
			elseif ($numrows == 0) {
				__set_error_msg(array('error' => 'Data akun harus diisi !!!'));
				redirect(site_url('journal' . '/' . __FUNCTION__));
			}
			else {
				$aid = $this -> closingperiod_model -> __get_period_active();
				$arr = array('gbid' => $this -> memcachedlib -> sesresult['ubranchid'], 'guid' => $this -> memcachedlib -> sesresult['uid'], 'gaid' => $aid[0] -> aid, 'gtype' => $type, 'gtitle' => $title, 'gdesc' => $desc, 'gdate' => time(), 'gdocref' => $docref, 'gstatus' => $status);
				if ($ispost == 1) $arr += array('gpdate' => time());
				
				if ($this -> journal_model -> __insert_journal($arr, 1)) {
					$gid = $this -> db-> insert_id();
					for($i=0;$i<$numrows;++$i) {
						$carr = array('ggid' => $gid, 'gcid' => $coas[$i], 'gdebet' => $debit[$i], 'gcredit' => $credit[$i], 'gdesc' => $descc[$i], 'gstatus' => 1);
						$this -> journal_model -> __insert_journal($carr, 2);
					}
					if ($ispost == 1)
						__set_error_msg(array('info' => 'Jurnal berhasi diposting.'));
					else
						__set_error_msg(array('info' => 'Data berhasil ditambahkan.'));
					redirect(site_url('journal'));
				}
				else {
					__set_error_msg(array('error' => 'Gagal menambahkan data !!!'));
					redirect(site_url('journal'));
				}
			}
		}
		else {
			$view['coa'] = $this -> coa_lib -> __get_coa();
			$this->load->view(__FUNCTION__, $view);
		}
	}
	
	function journal_update($id) {
		if ($_POST) {
			$type = (int) $this -> input -> post('type');
			$ispost = (int) $this -> input -> post('ispost');
			$title = $this -> input -> post('title', TRUE);
			$desc = $this -> input -> post('desc', TRUE);
			$docref = $this -> input -> post('docref', TRUE);
			$status = (int) $this -> input -> post('status');
			$numrows = (int) $this -> input -> post('numrows');
			
			$coas = $this -> input -> post('coas');
			$debit = $this -> input -> post('debit');
			$credit = $this -> input -> post('credit');
			$descc = $this -> input -> post('descc');
			$gid = $this -> input -> post('gid');
			
			$id = (int) $this -> input -> post('id');
			
			if ($id) {
				if (!$title) {
					__set_error_msg(array('error' => 'Judul harus diisi !!!'));
					redirect(site_url('journal' . '/' . __FUNCTION__ . '/' . $id));
				}
				else {
					$aid = $this -> closingperiod_model -> __get_period_active();
					$arr = array('gbid' => $this -> memcachedlib -> sesresult['ubranchid'], 'guid' => $this -> memcachedlib -> sesresult['uid'], 'gaid' => $aid[0] -> aid, 'gtype' => $type, 'gtitle' => $title, 'gdesc' => $desc, 'gdate' => time(), 'gdocref' => $docref, 'gstatus' => $status);
					if ($ispost == 1) $arr += array('gpdate' => time());

					if ($this -> journal_model -> __update_journal($id, $arr, 1)) {
						for($i=0;$i<$numrows;++$i) {
							if (isset($gid[$i])) {
								$carr = array('gcid' => $coas[$i], 'gdebet' => $debit[$i], 'gcredit' => $credit[$i], 'gdesc' => $descc[$i], 'gstatus' => 1);
								$this -> journal_model -> __update_journal($gid[$i], $carr, 2);
							}
							else {
								$carr = array('ggid' => $id, 'gcid' => $coas[$i], 'gdebet' => $debit[$i], 'gcredit' => $credit[$i], 'gdesc' => $descc[$i], 'gstatus' => 1);
								$this -> journal_model -> __insert_journal($carr, 2);
							}
						}
						
						if ($ispost == 1)
							__set_error_msg(array('info' => 'Jurnal berhasi diposting.'));
						else
							__set_error_msg(array('info' => 'Data berhasil diubah.'));
						redirect(site_url('journal'));
					}
					else {
						__set_error_msg(array('error' => 'Gagal mengubah data !!!'));
						redirect(site_url('journal'));
					}
				}
			}
			else {
				__set_error_msg(array('error' => 'Kesalahan input data !!!'));
				redirect(site_url('journal'));
			}
		}
		else {
			$view['id'] = $id;
			$view['coa'] = $this -> coa_lib -> __get_coa();
			$view['detail'] = $this -> journal_model -> __get_journal_detail($id);
			$view['detailchild'] = $this -> journal_model -> __get_journal_child($id);
			$this->load->view(__FUNCTION__, $view);
		}
	}
	
	function journal_delete($id) {
		if ($this -> journal_model -> __delete_journal($id)) {
			__set_error_msg(array('info' => 'Data berhasil dihapus.'));
			redirect(site_url('journal'));
		}
		else {
			__set_error_msg(array('error' => 'Gagal hapus data !!!'));
			redirect(site_url('journal'));
		}
	}
	
	function journal_child_delete($id) {
		if ($this -> journal_model -> __delete_journal_child($id)) {
			return true;
		}
	}
}
