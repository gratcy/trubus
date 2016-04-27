<?php
include('config/config.php');
$conn = mysql_connect($conf['database']['host'], $conf['database']['username'], $conf['database']['password']);
$db = mysql_select_db($conf['database']['database'], $conn);

$memcached_obj = new Memcache;
$memcached_obj -> addServer($conf['memcached']['host'], $conf['memcached']['port']);

function __get_total_newbook() {
	$sql = mysql_query("SELECT COUNT(*) as total FROM books_tab WHERE FROM_UNIXTIME(bdate, '%Y-%m-%d')>='".date('Y-m-d', strtotime('-1 week'))."' AND FROM_UNIXTIME(bdate, '%Y-%m-%d')<='".date('Y-m-d')."'");
	$r = mysql_fetch_array($sql);
	return ($r['total'] ? $r['total'] : 0);
}

$memcached_obj -> set('__new_books', json_encode(array('total' => __get_total_newbook())), MEMCACHE_COMPRESSED, 3600*24);
