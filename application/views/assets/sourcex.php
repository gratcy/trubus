<?php
$mysql_server = 'localhost';
$mysql_login = 'root';
$mysql_password = '';
$mysql_database = 'niaga_swadaya_db';
if(!isset($_REQUEST['term'])){$_REQUEST['term']="";}

$id_penerbit=$_GET['id_penerbit'];
mysql_connect($mysql_server, $mysql_login, $mysql_password);
mysql_select_db($mysql_database);

$req = "SELECT bid,bcode,btitle,bisbn,bprice,bdisc,bpublisher,pname "
	."FROM books_tab a,publisher_tab b "
	."WHERE a.bpublisher=b.pid AND b.pid=".$id_penerbit." AND 
	( btitle LIKE '%".$_REQUEST['term']."%' OR bcode LIKE '%".$_REQUEST['term']."%'
	OR bisbn LIKE '%".$_REQUEST['term']."%')"; 

$query = mysql_query($req);
//print_r($query);die;
while($row = mysql_fetch_array($query))
{
	$results[] = array('label' => $row['btitle'],'bid' => $row['bid'],'bcode' => $row['bcode'],
	'bisbn' => $row['bisbn'],'bprice' => $row['bprice'],'bdisc' => $row['bdisc'],'bpublisher' => $row['bpublisher'],'pname' => $row['pname']);
}

echo json_encode($results);
flush();
?>