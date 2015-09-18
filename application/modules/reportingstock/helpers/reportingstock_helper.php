<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
function __get_reporting_type($id,$type) {
	$data = array('Basic', 'Summary Area', 'Summary Books');
	$res = '';
	if ($type == 1)
		$res = $data[$id];
	else
		foreach($data as $k => $v)
			$res .= '<option value="'.($k).'">'.$v.'</option>';
	return $res;
}

function __get_reporting_transaction_type(&$key) {
	$data = array('ALL' => 'ALL', 'JC' => 'Penjualan Kredit', 'JK' => 'Penjualan Konsinyasi', 'HP' => 'Hasil Penjualan', 'RJC' => 'Retur Penjualan Kredit', 'RJK' => 'Retur Penjualan Konsinyasi', 'RHP' => 'Retur Hasil Penjualan', 'RB' => 'Retur Pembelian', 'TR' => 'Transfer Books','IR' => 'Item Receiving');
	$res = '';
	foreach($key as $v)
		$res .= (isset($data[$v]) ? $data[$v] . ' - ' : '');
	return ($res ? rtrim($res, ' - ') : 'ALL');
}

function __get_reporting_name_option($id,$type) {
	if (!$id) return false;
    $CI =& get_instance();
	$CI -> load -> model('reportingstock/reportingstock_model');
	$data = $CI -> reportingstock_model ->__get_name_option($id,$type);
	return (isset($data[0] -> name) ? $data[0] -> name : '');
}

function __date_compare($a, $b) {
    $t1 = strtotime($a -> ttanggal);
    $t2 = strtotime($b -> ttanggal);
    return $t1 - $t2;
}  
