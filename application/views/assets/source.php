<?php
$mysql_server = 'localhost';
$mysql_login = 'root';
$mysql_password = '';
$mysql_database = 'niaga_swadaya_db';
if(!isset($_REQUEST['term'])){$_REQUEST['term']="";}


mysql_connect($mysql_server, $mysql_login, $mysql_password);
mysql_select_db($mysql_database);

$req = "SELECT pid,pcode,pname,paddr,pphone,pemail,pnpwp "
	."FROM publisher_tab "
	."WHERE  pstatus='1' AND (pname LIKE '%".$_REQUEST['term']."%' OR pcode LIKE '%".$_REQUEST['term']."%')"; 
//echo $req;
$query = mysql_query($req);

while($row = mysql_fetch_array($query))
{

	$results[] = array('label' => $row['pname'],'pid' => $row['pid'],
	'pcode' => $row['pcode'],'paddr' => $row['paddr'],'pphone' => $row['pphone'],
	'pnpwp' => $row['pnpwp'],'pemail' => $row['pemail'] );
}

echo json_encode($results);
flush();
?>