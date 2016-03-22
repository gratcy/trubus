<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function __set_error_msg($arr) {
	$CI =& get_instance();
	return $CI -> memcachedlib -> set('__msg', $arr, '60');
}

function __get_error_msg() {
	$CI =& get_instance();
	$css = (isset($CI -> memcachedlib -> get('__msg')['error']) == '' ? 'success' : 'danger');
	
	if (isset($CI -> memcachedlib -> get('__msg')['error']) || isset($CI -> memcachedlib -> get('__msg')['info'])) {
		$res = '<div class="alert alert-'.$css.' alert-dismissable"><i class="fa fa-'.($css == 'success' ? 'check' : 'ban').'"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
		$res .= (isset($CI -> memcachedlib -> get('__msg')['error']) ? $CI -> memcachedlib -> get('__msg')['error'] : $CI -> memcachedlib -> get('__msg')['info']);
		$res .= '</div>';
		$CI -> memcachedlib -> delete('__msg');
		return $res;
	}
}

function __get_request_type($id, $type) {
	if ($type == 1)
		return ($id == 2 ? 'Retur' : 'Transfer');
	else
		return ($id == 2 ? '<option value="1">Transfer</option><option value="2" selected>Retur</option>' : '<option value="1" selected>Transfer</option><option value="2">Retur</option>');
}

function __get_status($status, $type) {
	if ($type == 1)
		return ($status == 1 ? 'Active' : 'Inactive');
	else
		return ($status == 1 ? 'Active <input type="radio" checked="checked" name="status" value="1" /> Inactive <input type="radio" name="status" value="0" />' : 'Active <input type="radio" name="status" value="1" /> Inactive <input type="radio" checked="checked" name="status" value="0" />');
}

function __get_rupiah($num,$type=1) {
	if ($type == 1) return "Rp. " . number_format($num,0,',','.');
	elseif ($type == 2) return number_format($num,0,',',',');
	elseif ($type == 3) return number_format($num,0,',','.');
	else return "Rp. " . number_format($num,2,',','.');
}

function __get_roles($key) {
    $arr = array();
    $CI =& get_instance();
    $roles = $CI -> memcachedlib -> sesresult['permission'];
    foreach($roles as $k => $v)
        $arr[$v['pname']] = $v['aaccess'];
    return (isset($arr[$key]) ? $arr[$key] : '');
}

function __get_roles_by_id($key) {
    $arr = array();
    $CI =& get_instance();
    return $CI -> memcachedlib -> sesresult['gid'] !=  $key ? 'no' : '';
}

function __get_spelled($num) {
	$num = (float)$num;
	$bilangan = array(
	'',
	'satu',
	'dua',
	'tiga',
	'empat',
	'lima',
	'enam',
	'tujuh',
	'delapan',
	'sembilan',
	'sepuluh',
	'sebelas'
	);

	if ($num < 12) {
		return strtoupper($bilangan[$num]);
	}
	else if ($num < 20) {
		return strtoupper($bilangan[$num - 10] . ' belas');
	}
	else if ($num < 100) {
		$mod = (int)($num / 10);
		$hasil_mod = $num % 10;
		return strtoupper(trim(sprintf('%s puluh %s', $bilangan[$mod], $bilangan[$hasil_mod])));
	}
	else if ($num < 200) {
		return strtoupper(sprintf('seratus %s', __get_spelled($num - 100)));
	}
	else if ($num < 1000) {
		$mod = (int)($num / 100);
		$hasil_mod = $num % 100;
		return strtoupper(trim(sprintf('%s ratus %s', $bilangan[$mod], __get_spelled($hasil_mod))));
	}
	else if ($num < 2000) {
		return strtoupper(trim(sprintf('seribu %s', __get_spelled($num - 1000))));
	}
	else if ($num < 1000000) {
		$mod = (int)($num / 1000);
		$hasil_mod = $num % 1000;
		return strtoupper(sprintf('%s ribu %s', __get_spelled($mod), __get_spelled($hasil_mod)));
	}
	else if ($num < 1000000000) {
		$mod = (int)($num / 1000000);
		$hasil_mod = $num % 1000000;
		return strtoupper(trim(sprintf('%s juta %s', __get_spelled($mod), __get_spelled($hasil_mod))));
	}
	else if ($num < 1000000000000) {
		$mod = (int)($num / 1000000000);
		$hasil_mod = fmod($num, 1000000000);
		return strtoupper(trim(sprintf('%s milyar %s', __get_spelled($mod), __get_spelled($hasil_mod))));
	}
	else if ($num < 1000000000000000) {
		$mod = $num / 1000000000000;
		$hasil_mod = fmod($num, 1000000000000);
		return strtoupper(trim(sprintf('%s triliun %s', __get_spelled($mod), __get_spelled($hasil_mod))));
	}
	else {
		return 'Wow...';
	}
}

function __get_cities($id,$type=1) {
	$CI =& get_instance();
	$CI -> load -> library('city/city_lib');
	if ($type == 1) {
		$CI -> load -> model('city/city_model');
		$city = $CI -> city_model -> __get_city_detail($id);
		return $city[0] -> cname;
	}
	else {
		return $CI -> city_lib -> __get_city($id);
	}
}

function __get_province($id, $type=1) {
	$CI =& get_instance();
	$CI -> load -> library('province/province_lib');
	if ($type == 1) {
		$CI -> load -> model('province/province_model');
		$city = $CI -> province_model -> __get_province_detail($id);
		return $city[0] -> pname;
	}
	else
		return $CI -> province_lib -> __get_province($id);
}

function __get_branch($id, $type) {
	$branch = array(1 => 'Pusat', 2 => 'Bandung', 6 => 'Yogyakarta', 7 => 'Surabaya', 4 => 'Medan', 3 => 'Palembang', 5 => 'Makassar', 8 => 'Indomarco');
	if ($type == 1) {
		$res = $branch[$id];
	}
	else {
		$res = '';
		foreach($branch as $k => $v) {
			if ($id == $k) $res .= '<option value="'.$k.'" selected>'.$v.'</option>';
			else $res .= '<option value="'.$k.'">'.$v.'</option>';
		}
	}
	return $res;
}

function __get_packs($id, $type) {
	$city = array('PCS', 'Koli');
	if ($type == 1) {
		$res = $city[$id-1];
	}
	else {
		$res = '<option value=""></option>';
		foreach($city as $k => $v) {
			if ($id == ($k+1)) $res .= '<option value="'.($k+1).'" selected>'.$v.'</option>';
			else $res .= '<option value="'.($k+1).'">'.$v.'</option>';
		}
	}
	return $res;
}

function __get_tax($tax, $type) {
	if ($type == 1)
		return ($tax == 1 ? 'Standard' : 'Sederhana');
	else
		return ($tax == 1 ? 'Standard <input type="radio" checked="checked" name="tax" value="1" /> Sederhana <input type="radio" name="tax" value="0" />' : 'Standard <input type="radio" name="tax" value="1" /> Sederhana <input type="radio" checked="checked" name="tax" value="0" />');
}

function __get_customer_type($ctype, $type) {
	if ($type == 1) {
		if ($ctype == 0) return 'Consignment';
		else if ($ctype == 1) return 'Credit';
		else return 'Cash';
	}
	else {
		if ($ctype === 0) return 'Consignment <input type="radio" name="ctype" value="0" checked="checked" /> Credit <input type="radio" name="ctype" value="1" /> Cash <input type="radio" name="ctype" value="2" />';
		else if ($ctype == 1) return 'Consignment <input type="radio" name="ctype" value="0" /> Credit <input type="radio" name="ctype" value="1" checked="checked" /> Cash <input type="radio" name="ctype" value="2" />';
		else return 'Consignment <input type="radio" name="ctype" value="0" /> Credit <input type="radio" name="ctype" value="1" /> Cash <input type="radio" name="ctype" value="2"  checked="checked" />';
	}
}

function __get_total_new_pm($uid) {
	$CI =& get_instance();
	$CI -> load -> model('pm/pm_model');
	return $CI -> pm_model -> __get_total_new_pm($uid);
}

function __get_new_pm($uid) {
	$CI =& get_instance();
	$CI -> load -> model('pm/pm_model');
	$sql = $CI -> pm_model -> __get_new_pm($uid);
	$res = '<li>';
	foreach($sql as $k => $v)
		$res .= '<ul class="menu"><li><a href="'.site_url('pm/pm_read/' . $v -> pid).'"><h4>'.$v -> uemail.'<small><i class="fa fa-clock-o"></i> '.__get_date($v -> pdate).'</small></h4><p>'.substr($v -> psubject,0,50).'</p></a></li></ul>';
	$res .= '</li>';
	return $res;
}

function __get_receiving_type($id, $type) {
	if ($type == 1)
		return ($id == 1 ? 'Branches' : 'Publisher');
	else
		return ($id == 1 ? '<option value="1" selected>Branches</option><option value="2">Publisher</option>' : '<option value="1">Branches</option><option value="2" selected>Publisher</option>');
}

function __get_letter_type($id, $type) {
	if ($type == 1)
		return ($id == 1 ? 'Branches' : 'Customer');
	else
		return ($id == 1 ? '<option value="1" selected>Branches</option><option value="2">Customer</option>' : '<option value="1" selected>Branches</option><option value="2" selected>Customer</option>');
}

function __get_letter_no($id, $type) {
	return ($type == 1 ? 'R' : 'T') . str_pad($id, 4, "0", STR_PAD_LEFT);
}

function __get_receiving_name($id, $type) {
	$CI =& get_instance();
	if ($type == 2) {
		$CI -> load -> model('publisher/publisher_model');
		return $CI -> publisher_model -> __publisher_name($id);
	}
	else {
		$CI -> load -> model('request/request_model');
		$type = $CI -> request_model -> __get_request_type($id);
		return ($type[0] -> dtype == 1 ? 'R01' : 'R02').str_pad($id, 4, "0", STR_PAD_LEFT);
	}
}

function __get_letter_docno($id, $type) {
	$CI =& get_instance();
	if ($type == 1) {
		$CI -> load -> model('transfer/transfer_model');
		$res = $CI -> transfer_model -> __get_transfer_by_request($id);
		return $res[0] -> ddocno;
	}
	else {
		$CI -> load -> model('letter/letter_model');
		$res = $CI -> letter_model -> __get_transaction_docno($id);
		return $res[0] -> tnofaktur;
	}
}

function __get_total_adjustment($type, $aatype, $branch, $bid) {
	$CI =& get_instance();
	$CI -> load -> model('reportstock/reportstock_model');
	$res = $CI -> reportstock_model -> __get_total_adjustment($type, $aatype, $branch, $bid);
	return ($res[0] -> total ? $res[0] -> total : 0);
}

function __get_total_receiving($branch, $bid) {
	$CI =& get_instance();
	$CI -> load -> model('reportstock/reportstock_model');
	$res = $CI -> reportstock_model -> __get_total_receiving($branch, $bid);
	return ($res[0] -> qty ? $res[0] -> qty : 0);
}

function __get_total_selling($branch, $bid) {
	$CI =& get_instance();
	$CI -> load -> model('reportstock/reportstock_model');
	$res = $CI -> reportstock_model -> __get_total_selling($branch, $bid);
	return ($res[0] -> qty ? $res[0] -> qty : 0);
}

function __get_publisher_category($id, $type) {
	$data = array('External', 'Internal', 'Majalah');
	if ($type == 1) {
		$res = $data[$id-1];
	}
	else {
		$res = '<option value=""></option>';
		foreach($data as $k => $v)
			if ($id == ($k+1)) $res .= '<option value="'.($k+1).'" selected>'.$v.'</option>';
			else $res .= '<option value="'.($k+1).'">'.$v.'</option>';
	}
	return $res;
}

function __get_publisher_type($id, $type) {
	if ($type == 1)
		return ($type == 1 ? 'Main Publisher' : 'Sub Publisher');
	else
		return ($type == 1 ? 'Main Publisher <input type="radio" checked="checked" name="ptype" value="1" /> Sub Publisher <input type="radio" name="ptype" value="0" />' : 'Main Publisher <input type="radio" name="ptype" value="1" /> Sub Publisher <input type="radio" checked="checked" name="ptype" value="0" />');
}

function __get_path_upload($key, $type, $file='') {
	$CI =& get_instance();
	$conf = $CI->config->load('upload', TRUE);
	if ($type == 1)
		return ($file == '' ? FCPATH . $conf['sfile'][$key] : FCPATH . $conf['sfile'][$key] . $file);
	else
		return site_url($conf['sfile'][$key] . $file);
}

function __get_promo_type($status, $type) {
	if ($type == 1)
		return ($status == 1 ? 'Area' : 'Customer');
	else
		return ($status == 1 ? 'Area <input id="promoType" type="radio" checked="checked" name="type" value="1" /> Customer <input id="promoType" type="radio" name="type" value="0" />' : 'Area <input id="promoType" type="radio" name="type" value="1" /> Customer <input id="promoType" type="radio" checked="checked" name="type" value="0" />');
}

function __keyTMP($str) {
	return str_replace('/','PalMa',$str);
}

function __get_PTMP() {
    $arr = array();
    $CI =& get_instance();
    if (isset($CI -> memcachedlib -> get('__msg')['info']) || $CI -> memcachedlib -> get('__msg')['info']) {
		$CI -> memcachedlib -> delete(__keyTMP(str_replace(site_url(),'/',$_SERVER['HTTP_REFERER'])));
		$CI -> memcachedlib -> delete('__msg');
		return false;
	}
    $res = json_encode($CI -> memcachedlib -> get(__keyTMP($_SERVER['REQUEST_URI'])));
    $CI -> memcachedlib -> delete(__keyTMP($_SERVER['REQUEST_URI']));
    return $res;
}

function __get_stock_process($bcid,$bid,$isCustomer=1) {
    $CI =& get_instance();
    if ($isCustomer == 1) {
		$CI -> load -> model('inventory/inventory_model');
		$data = $CI -> inventory_model ->__get_stock_process($bcid,$bid);
	}
	else {
		$CI -> load -> model('inventory_customer/inventory_customer_model');
		$data = $CI -> inventory_customer_model ->__get_stock_process($bcid,$bid);
	}
	return $data;
}

function __get_publisher_imprint($publisher,$type=1) {
	if (!$publisher) return false;
    $CI =& get_instance();
	$CI -> load -> model('publisher/publisher_model');
	$dpa = $CI -> publisher_model -> __get_publisher_detail($publisher);
	if ($dpa[0] -> pparent == 0) {
		$dpa1 = '01';
	}
	else {
		$wew = $CI -> publisher_model -> __get_publisher(2, $dpa[0] -> pparent);
		$i = 2;
		foreach($wew as $k => $v) :
			if ($v -> pid == $publisher) {
				$dpa1 = ($type == 1 ? '' : '-- ').str_pad($i, 2, "0", STR_PAD_LEFT);
				break;
			}
			++$i;
		endforeach;
	}
	return $dpa1;
}

function __get_transaction_type() {
	$data = array('Kredit','Konsinyasi', 'Retur');
	$res = '<option value="0">All</option>';
	foreach($data as $k => $v)
		$res .= '<option value="'.($k+1).'">'.$v.'</option>';
	return $res;
}

function __get_stock_begining($bid, $branch) {
    $CI =& get_instance();
	$CI -> load -> model('inventory/inventory_model');
	$data = $CI -> inventory_model ->__get_stock_begining($bid,$branch);
	return (isset($data[0] -> istockbegining) ? $data[0] -> istockbegining : 0);
}

function __get_adjustment($iid, $branch, $type, $isCustomer=1) {
    $CI =& get_instance();
    if ($isCustomer == 1) {
		$CI -> load -> model('opname/opname_model');
		$data = $CI -> opname_model ->__get_stock_adjustment($iid, $branch, $type);
	}
	else {
		$CI -> load -> model('opnamecustomer/opnamecustomer_model');
		$data = $CI -> opnamecustomer_model ->__get_stock_adjustment($iid, $branch, $type);
	}
	return (isset($data[0] -> total) ? $data[0] -> total : 0);
}

function __calc_opname($bil,$bil2) {
	if ($bil >= 0 && $bil2 >= 0) return $bil - $bil2;
	else if ($bil2 < 0 && $bil > 0) return $bil + (int) substr($bil2,1);
	else if ($bil2 < 0 && $bil >= 0) return $bil2;
	else if ($bil < 0 && $bil2 > 0) return $bil - $bil2;
	else if ($bil < 0 && $bil2 < 0) return $bil - $bil2;
	else return $bil;
}

function __check_new_book($date) {
	if (!$date) return false;
	if (date('Y-m-d', strtotime('-1 week')) >= date('Y-m-d', $date) || date('Y-m-d', $date) <= date('Y-m-d')) return '<small class="badge pull-left bg-yellow">&nbsp;</small> &nbsp;';
}

function __notif_stock_book($stock) {
	if ($stock >= 100) return '<small class="badge pull-left bg-green">&nbsp;</small> &nbsp;';
	elseif ($stock > 50 && $stock < 100) return '<small class="badge pull-left bg-yellow">&nbsp;</small> &nbsp;';
	else return '<small class="badge pull-left bg-red">&nbsp;</small> &nbsp;';
}
