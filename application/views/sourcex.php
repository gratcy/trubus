<?php
header('Content-type: application/javascript');
$mysql_server = $hostname;
$mysql_login = $username;
$mysql_password = $password;
$mysql_database = $database;
if(!isset($_REQUEST['term'])){$_REQUEST['term']="";}
if(!isset($_REQUEST['id_penerbit'])){$_REQUEST['id_penerbit']="";}
$id_penerbit=$_REQUEST['id_penerbit'];

$get_suggest = $this -> memcachedlib -> get('__trans_suggeest_4', true);

if (!$get_suggest) {
	mysql_connect($mysql_server, $mysql_login, $mysql_password);
	mysql_select_db($mysql_database);

	$req = "SELECT bid,bcode,btitle,bisbn,bprice,bdisc,bpublisher,pname "
		."FROM books_tab a,publisher_tab b "
		."WHERE a.bpublisher=b.pid AND b.pid=".$id_penerbit." AND 
		( btitle LIKE '%".$_REQUEST['term']."%' OR bcode LIKE '%".$_REQUEST['term']."%'
		OR bisbn LIKE '%".$_REQUEST['term']."%')"; 

	$query = mysql_query($req);
	while($row = mysql_fetch_array($query))
	{
		$results[] = array('label' => $row['btitle'],'bid' => $row['bid'],'bcode' => $row['bcode'],
		'bisbn' => $row['bisbn'],'bprice' => $row['bprice'],'bdisc' => $row['bdisc'],'bpublisher' => $row['bpublisher'],'pname' => $row['pname']);
	}
	$this -> memcachedlib -> set('__trans_suggeest_4', json_encode($results), 3600,true);
	$get_suggest = $this -> memcachedlib -> get('__trans_suggeest_4', true);
}

echo json_encode($results);
flush();
