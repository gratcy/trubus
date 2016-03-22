<?php
include('config/config.php');
$conn = mysql_connect($conf['database']['host'], $conf['database']['username'], $conf['database']['password']);
$db = mysql_select_db($conf['database']['database'], $conn);

$memcached_obj = new Memcache;
$memcached_obj -> addServer($conf['memcached']['host'], $conf['memcached']['port']);

function __get_sum_transaction($bid) {
	$sql = mysql_query("SELECT SUM(tqty) as tqty FROM transaction_detail_tab WHERE tstatus=1 AND approval<2 AND tbid=".$bid);
	$r = mysql_fetch_array($sql);
	return ($r['tqty'] ? $r['tqty'] : 0);
}

for($i=1;$i<3;++$i) {
	$query = mysql_query("SELECT a.bid,a.bcode,a.btitle,a.bisbn,a.bprice,a.bdisc,a.bpublisher,b.pname,b.pcategory,c.istock,c.ishadow as ishadow,c.ibcid as ibcid FROM books_tab a JOIN publisher_tab b ON a.bpublisher=b.pid JOIN inventory_tab c ON c.ibid=a.bid WHERE a.bstatus=1 AND b.pstatus=1 AND c.itype=1 AND c.ibcid=".$i);
	while($row = mysql_fetch_array($query))
		$results[] = array('label' => $row['bcode'] .' | '.$row['btitle'] .' | '.$row['bprice'] .' | '.$row['pname'],'bid' => $row['bid'],'bcode' => $row['bcode'],'pcategory'=>$row['pcategory'],'ibcid'=>$row['ibcid'],'bisbn' => $row['bisbn'],'bprice' => $row['bprice'],'bdisc' => $row['bdisc'],'bpublisher' => $row['bpublisher'],'pname' => $row['pname'],'stok'=>(($row['pcategory'] == 2 && $row['ibcid'] == 1) ? $row['ishadow'] : $row['istock']));

	$results2 = array();
	foreach($results as $k => $v)
		$results2[] = array_merge($v,array('tqty' => __get_sum_transaction($v['bid'])));
		
	echo '__trans_suggeest_3_'.$i."\r\n";
	$memcached_obj -> set('__trans_suggeest_3_'.$i, json_encode($results2), MEMCACHE_COMPRESSED, 7200);
}
