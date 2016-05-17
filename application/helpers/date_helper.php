<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function __get_date($str, $type=1) {
	if (!$str) return false;
	if ($type == 1)
		return date('d/m/Y', $str);
	elseif ($type == 2)
		return date('d', $str).' '.__get_month(date('m',$str)).' '.date('Y',$str);
	elseif ($type == 3) return date('d/m/Y H:i:s', $str);
	elseif ($type == 4) return date('d ').__get_month(date('m',$str)).date(' Y H:i:s',$str);
	else return date('d ',$str).__get_month(date('m',$str)).date(' Y H:i',$str);
}

function __get_month($id) {
	$id = (int) $id;
	$month = array('Januari', 'Febuari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
	return $month[($id - 1)];
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
