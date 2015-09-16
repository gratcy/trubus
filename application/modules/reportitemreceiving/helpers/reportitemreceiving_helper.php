<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function __get_pb_list($ids, $type) {
	if (!$ids) return false;
	$res = '';
    $CI =& get_instance();
	$CI -> load -> model('reportitemreceiving/reportitemreceiving_model');
	$data = $CI -> reportitemreceiving_model ->__get_pb_list($ids,$type);
	foreach($data as $k => $v) $res .= $v -> name . ' - ';
	return rtrim($res, ' - ');
}
