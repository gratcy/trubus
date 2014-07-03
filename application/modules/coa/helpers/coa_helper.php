<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function __get_account_type($id, $type) {
	$res = '';
	$arr = array('Cash', 'Bank', 'Other Current Asset', 'Inventory Asset', 'Other Asset', 'Fixed Asset', 'Credit Card', 'Payroll Liability', 'Current Liability', 'Long-term Liability', 'Equity', 'Income', 'Expense', 'Other Income', 'Other Expense', 'Cost Of Goods Sold');
	if ($type == 1) {
		$res = $arr[($id + 1)];
	}
	else {
		foreach($arr as $k => $v)
			if (($k+1) == $id) $res .= '<option value="'.($k+1).'">'.$v.'</option>';
			else $res .= '<option value="'.($k+1).'">'.$v.'</option>';
	}
	return $res;
}

function __get_acpas($id, $type) {
	if ($type == 1)
		return ($id == 1 ? 'Activa' : 'Pasiva');
	else
		return ($id == 1 ? 'Activa <input type="radio" name="type" value="1" checked /> Pasiva <input type="radio" name="type" value="0" />' :  'Activa <input type="radio" name="type" value="1" /> Pasiva <input type="radio" name="type" value="0" checked />');
}

function __extract_coa(array $arr, $pass=0) {
	$res = '';
	foreach($arr as $k => $v) {
		$res .= '<tr>';
		$res .= '<td>'.__get_account_type($v -> catype,1).'</td>';
		$res .= '<td>'.__get_acpas($v -> ctype,1).'</td>';
		$res .= '<td>'.$v -> ccode.'</td>';
		$res .= '<td>'.str_repeat("--", $pass).' '.$v -> cname.'</td>';
		$res .= '<td style="text-align:right;">'.__get_rupiah($v -> csaldo,1).'</td>';
		$res .= '<td>'.__get_status($v -> cstatus,1).'</td>';
		$res .= '<td>';
		$res .= '<a href="'.site_url('coa/coa_update/' . $v -> cid).'"><i class="fa fa-pencil"></i></a> <a href="'.site_url('coa/coa_delete/' . $v -> cid).'" onclick="return confirm(\'Are you sure you want to delete this item?\');"><i class="fa fa-times"></i></a>';
		$res .= '</td>';
		$res .= '</tr>';
		if (isset($v -> cchild)) $res .= __extract_coa($v -> cchild, $pass+1);
	}
	return $res;
}
	
function __get_coa_arr(array $elements, $parentId=0) {
	$branch = array();
	foreach ($elements as $element) {
		if ($element -> cparent == $parentId) {
			$children = __get_coa_arr($elements, $element -> cid);
			if ($children) {
				$element -> cchild = $children;
			}
			$branch[] = $element;
		}
	}
	return $branch;
}
