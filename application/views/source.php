<?php
header('Content-type: application/javascript');
$mysql_server = 'localhost';
$mysql_login = 'root';
$mysql_password = '';
$mysql_database = 'jqueryautocomplete';
if(!isset($_REQUEST['term'])){$_REQUEST['term']="";}


mysql_connect($mysql_server, $mysql_login, $mysql_password);
mysql_select_db($mysql_database);

$req = "SELECT id,name,isbn "
	."FROM mytablex "
	."WHERE name LIKE '%".$_REQUEST['term']."%' OR id LIKE '%".$_REQUEST['term']."%'
     OR isbn LIKE '%".$_REQUEST['term']."%'	"; 

$query = mysql_query($req);

while($row = mysql_fetch_array($query))
{
	$results[] = array('label' => $row['name'],'id' => $row['id'],'isbn' => $row['isbn']);
}

echo json_encode($results);

?>
