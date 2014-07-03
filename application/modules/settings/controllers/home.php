<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {
	function __construct() {
		parent::__construct();
		$this -> load -> model('settings_model');
	}

	function index() {
		$this->load->view('settings', '');
	}
	
	function settings() {
		if ($_POST) {
			$uemail = $this -> input -> post('uemail', true);
			$oldpass = $this -> input -> post('oldpass', true);
			$newpass = $this -> input -> post('newpass', true);
			$confpass = $this -> input -> post('confpass', true);
			$uid = (int) $this -> input -> post('uid');
			
			if ($uid == $this -> session->CI->memcachedlib->sesresult['uid']) {
				if ($uemail) {
					if ($oldpass) {
						if ($newpass != $confpass) {
							__set_error_msg(array('error' => 'Password dan password konfirmasi tidak sesuai !!!'));
							redirect(site_url('settings'));
						}
						else {
							$r = $this -> settings_model -> __check_password($uid);
							if (md5(sha1($oldpass, true)) != $r[0] -> upass)	{
								__set_error_msg(array('error' => 'Password lama tidak sesuai !!!'));
								redirect(site_url('settings'));
							}
							else
								$this -> settings_model -> __update_password($newpass, $uid);
						}
					
						$this -> settings_model -> __update_profile($uemail, $uid);
						__set_error_msg(array('info' => 'Data profile berhasil di ubah.'));
						redirect(site_url('settings'));
					}
					__set_error_msg(array('info' => 'Tidak ada data yang diubah.'));
					redirect(site_url('settings'));
				}
				else {
					__set_error_msg(array('error' => 'Data yang anda masukkan tidak lengkap !!!'));
					redirect(site_url('settings'));
				}
			}
			else {
				__set_error_msg(array('error' => 'Kesalahan input data !!!'));
				redirect(site_url('settings'));
			}
		}
	}
}
