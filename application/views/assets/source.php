<?php
$mysql_server = 'localhost';
$mysql_login = 'root';
$mysql_password = '';
$mysql_database = 'niaga_swadaya_db';
if(!isset($_REQUEST['term'])){$_REQUEST['term']="";}


mysql_connect($mysql_server, $mysql_login, $mysql_password);
mysql_select_db($mysql_database);

$req = "SELECT cid,cbid,ccode,cname,caddr,cphone,cemail,cnpwp,cdisc "
	."FROM customer_tab "
	."WHERE cname LIKE '%".$_REQUEST['term']."%' OR cid LIKE '%".$_REQUEST['term']."%'"; 

$query = mysql_query($req);

while($row = mysql_fetch_array($query))
{
	$results[] = array('label' => $row['cname'],'cid' => $row['cid'],'cbid' => $row['cbid'],
	'ccode' => $row['ccode'],'caddr' => $row['caddr'],'cphone' => $row['cphone'],
	'cnpwp' => $row['cnpwp'],'cemail' => $row['cemail'],'cdisc' => $row['cdisc']);
}

echo json_encode($results);

?>