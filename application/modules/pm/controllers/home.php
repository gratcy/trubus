<?php
/* -*- tab-width: 2; indent-tabs-mode: nil; c-basic-offset: 2 -*- */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {
	function __construct() {
		parent::__construct();
		$this -> load -> library('pagination_lib');
		$this -> load -> library('users/users_lib');
		$this -> load -> model('pm_model');
	}

	function index() {
		$pager = $this -> pagination_lib -> pagination($this -> pm_model -> __get_pm($this -> memcachedlib -> sesresult['uid'], 1),3,10,site_url('pm'));
		$view['pm'] = $this -> pagination_lib -> paginate();
		$view['pages'] = $this -> pagination_lib -> pages();
		$view['type'] = 1;
		$this->load->view('pm', $view);
	}

	function outbox() {
		$pager = $this -> pagination_lib -> pagination($this -> pm_model -> __get_pm($this -> memcachedlib -> sesresult['uid'], 2),3,10,site_url('pm/outbox'));
		$view['pm'] = $this -> pagination_lib -> paginate();
		$view['pages'] = $this -> pagination_lib -> pages();
		$view['type'] = 2;
		$this->load->view('pm', $view);
	}
	
	function pm_read($id) {
		if (!preg_match('/outbox/i', $_SERVER['HTTP_REFERER']))	$this -> pm_model -> __update_new_status($id);
		$view['id'] = $id;
		$view['detail'] = $this -> pm_model -> __get_pm_detail($id, $this -> memcachedlib -> sesresult['uid']);
		$this->load->view('pm_read', $view);
	}
	
	function pm_reply($id) {
		$view['detail'] = $this -> pm_model -> __get_pm_detail($id, $this -> memcachedlib -> sesresult['uid']);
		$view['getUser'] = $this -> users_lib -> __get_user($view['detail'][0] -> pfrom);
		$this->load->view('pm_reply', $view);
	}
	
	function pm_new() {
		if ($_POST) {
			$subject = $this -> input -> post('subject', TRUE);
			$msg = $this -> input -> post('msg', TRUE);
			$to = $this -> input -> post('to');
			
			if (!$to) {
				__set_error_msg(array('error' => 'Tujuan pengirim harus di isi !!!'));
				redirect(site_url('pm/' . __FUNCTION__));
			}
			else if (!$subject) {
				__set_error_msg(array('error' => 'Subject harus di isi !!!'));
				redirect(site_url('pm/' . __FUNCTION__));
			}
			else if (!$msg) {
				__set_error_msg(array('error' => 'Pesan harus di isi !!!'));
				redirect(site_url('pm/' . __FUNCTION__));
			}
			else {
				foreach($to as $k => $pto) {
					$arr = array('pdate' => time(), 'pfrom' => $this -> memcachedlib -> sesresult['uid'], 'pto' => $pto, 'psubject' => $subject, 'pmsg' => $msg, 'pstatus' => 0);
					$this -> pm_model -> __insert_pm($arr);
				}
				__set_error_msg(array('info' => 'Pesan berhasil dikirim.'));
				redirect(site_url('pm/outbox'));
			}
		}
		else {
			$view['getUser'] = $this -> users_lib -> __get_user(0);
			$this->load->view('pm_new', $view);
		}
	}
	
	function pm_delete($id, $type) {
		if ($this -> pm_model -> __delete_pm($id, $type)) {
			__set_error_msg(array('info' => 'Data berhasil dihapus.'));
			redirect(site_url(($type == 1 ? 'pm' : 'pm/outbox')));
		}
		else {
			__set_error_msg(array('error' => 'Gagal hapus data !!!'));
			redirect(site_url(($type == 1 ? 'pm' : 'pm/outbox')));
		}
	}
}
