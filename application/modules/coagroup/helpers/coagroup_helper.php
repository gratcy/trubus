<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function __get_coa_class($id, $type) {
	$res = '';
	$arr = array('AKTIVA', 'KEWAJIBAN', 'EKUITAS', 'INCOME', 'EXPENSE');
	if ($type == 1) {
		$res = $arr[$id];
	}
	else {
		foreach($arr as $k => $v)
			if ($k == $id) $res .= '<option value="'.$k.'" selected>'.$v.'</option>';
			else $res .= '<option value="'.$k.'">'.$v.'</option>';
	}
	return $res;
}
