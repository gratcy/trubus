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

function __get_status($status, $type) {
	if ($type == 1)
		return ($status == 1 ? 'Active' : 'Inactive');
	else
		return ($status == 1 ? 'Active <input type="radio" checked="checked" name="status" value="1" /> Inactive <input type="radio" name="status" value="0" />' : 'Active <input type="radio" name="status" value="1" /> Inactive <input type="radio" checked="checked" name="status" value="0" />');
}

function __get_rupiah($num,$type=1) {
	if ($type == 1) return "Rp. " . number_format($num,0,',','.');
	elseif ($type == 2) return number_format($num,0,',',',');
	elseif ($type == 3) return number_format($num,2,',','.');
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

function __get_cities($id, $type) {
	$city = array('Jakarta', 'Bekasi', 'Bali');
	if ($type == 1) {
		$res = $city[$id-1];
	}
	else {
		$res = '<option value=""></option>';
		foreach($city as $k => $v)
			if ($id == ($k+1)) $res .= '<option value="'.($k+1).'" selected>'.$v.'</option>';
			else $res .= '<option value="'.($k+1).'">'.$v.'</option>';
	}
	return $res;
}

function __get_province($id, $type) {
	$prov = array('DKI Jakarta', 'Jawa Barat', 'Bali');
	if ($type == 1) {
		$res = $prov[$id-1];
	}
	else {
		$res = '<option value=""></option>';
		foreach($prov as $k => $v)
			if ($id == ($k+1)) $res .= '<option value="'.($k+1).'" selected>'.$v.'</option>';
			else $res .= '<option value="'.($k+1).'">'.$v.'</option>';
	}
	return $res;
}

function __get_packs($id, $type) {
	$city = array('PCS', 'Koli', 'Bla');
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
		return ($tax == 1 ? 'Taxable' : 'Intaxable');
	else
		return ($tax == 1 ? 'Taxable <input type="radio" checked="checked" name="tax" value="1" /> Intaxable <input type="radio" name="tax" value="0" />' : 'Taxable <input type="radio" name="tax" value="1" /> Intaxable <input type="radio" checked="checked" name="tax" value="0" />');
}

function __get_customer_type($ctype, $type) {
	if ($type == 1) {
		if ($ctype == 0) return 'Consignment';
		else if ($ctype === 1) return 'Credit';
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
		return ($id == 1 ? '<option value="1" selected>Branches</option><option value="2">Publisher</option>' : '<option value="1" selected>Branches</option><option value="2" selected>Publisher</option>');
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
	else
		return 'R'.str_pad($id, 4, "0", STR_PAD_LEFT);
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
