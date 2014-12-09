<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function __get_status_tax($status) {
	return ($status == 1 ? 'Active' : ($status == 0 ? 'Inactive' : '<span style="color:#ae4;font-weight:bold;">Used</span>'));
}
