<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function __get_date($str, $type=1) {
	if ($type == 1)
		return date('d/m/Y', $str);
	elseif ($type == 2)
		return date('d ').__get_month(date('m',$str)).date(' Y');
	elseif ($type == 3) return date('d/m/Y H:i:s', $str);
	else return date('d ').__get_month(date('m',$str)).date(' Y H:i:s');
}

function __get_month($id) {
	$month = array('Januari', 'Febuari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
	return $month[($id + 1)];
}

function __get_tahun_labarugi($tahun) {
	$res = '';
	for($i=(date('Y')-3);$i<=(date('Y')+3);++$i) {
		if ($i == $tahun)
			$res .= '<option value="'.$i.'" selected>'.$i.'</option>';
		else
			$res .= '<option value="'.$i.'">'.$i.'</option>';
	}
	return $res;
}
