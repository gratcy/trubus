<?php
header('Content-type: application/javascript');
$mysql_server = $hostname;
$mysql_login = $username;
$mysql_password = $password;
$mysql_database = $database;
if(!isset($_REQUEST['term'])){$_REQUEST['term']="";}

$get_suggest = $this -> memcachedlib -> get('__trans_suggeest_3', true);
if (!$get_suggest) {
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
	$this -> memcachedlib -> set('__trans_suggeest_3', json_encode($results), 3600,true);
	$get_suggest = $this -> memcachedlib -> get('__trans_suggeest_3', true);
}

echo $get_suggest;
flush();
?>
