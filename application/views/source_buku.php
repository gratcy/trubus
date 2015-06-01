<?php
// $mysql_server = 'localhost';
// $mysql_login = 'root';
// $mysql_password = '';
// $mysql_database = 'niaga_swadaya_db';
$mysql_server = $hostname;
$mysql_login = $username;
$mysql_password = $password;
$mysql_database = $database;
if(!isset($_REQUEST['term'])){$_REQUEST['term']="";}
if(!isset($_REQUEST['branch'])){$_REQUEST['branch']="";}

mysql_connect($mysql_server, $mysql_login, $mysql_password);
mysql_select_db($mysql_database);

$req = "SELECT bid,bcode,btitle,bisbn,bprice,bdisc,bpublisher,pname,istock "
	." FROM books_tab a,publisher_tab b,inventory_tab c "
	."WHERE c.ibid=a.bid and c.itype='1' AND a.bpublisher=b.pid AND ( btitle LIKE '%".$_REQUEST['term']."%' OR bcode LIKE '%".$_REQUEST['term']."%'
	OR bisbn LIKE '%".$_REQUEST['term']."%')"; 
//echo $req;die;
$query = mysql_query($req);
//print_r($query);die;
while($row = mysql_fetch_array($query))
{
	$results[] = array('label' => $row['btitle'],'bid' => $row['bid'],'bcode' => $row['bcode'],
	'bisbn' => $row['bisbn'],'bprice' => $row['bprice'],'bdisc' => $row['bdisc'],'bpublisher' => $row['bpublisher'],'pname' => $row['pname'],'stok'=>$row['istock']);
}

echo json_encode($results);
flush();
?>