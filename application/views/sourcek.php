<?php
header('Content-type: application/javascript');
$mysql_server = $hostname;
$mysql_login = $username;
$mysql_password = $password;
$mysql_database = $database;
if(!isset($_REQUEST['term'])){$_REQUEST['term']="";}

if(!isset($_REQUEST['branch'])){$_REQUEST['branch']="";}

$get_suggest = $this -> memcachedlib -> get('__trans_suggeest_1', true);
if (!$get_suggest) {
	$conn = mysql_connect($mysql_server, $mysql_login, $mysql_password);
	$db = mysql_select_db($mysql_database, $conn);


	$req = "SELECT cid,
	cbid,ccode,cname,caddr,cphone,cemail,cnpwp,cdisc,ctax,bcode "
		."FROM customer_tab a,branch_tab b "
		."WHERE a.cbid=b.bid  AND a.cbid =".$_REQUEST['branch']." AND  (cname LIKE '%".$_REQUEST['term']."%' OR ccode LIKE '%".$_REQUEST['term']."%') "; 

	$query = mysql_query($req);

	while($row = mysql_fetch_array($query))
	{
	if($row['ctax']==0){$ctx="InTaxable";}
	else if($row['ctax']==1){$ctx="Taxable";}

		$results[] = array('label' => $row['cname'],'cid' => $row['cid'],'cbid' => $row['cbid'],
		'ccode' => $row['ccode'],'caddr' => $row['caddr'],'cphone' => $row['cphone'],
		'cnpwp' => $row['cnpwp'],'cemail' => $row['cemail'],'cdisc' => $row['cdisc'],'ctax' => $row['ctax'],
		'ctx' => $ctx ,'bcode'=>$row['bcode'] );
	}
	$this -> memcachedlib -> set('__trans_suggeest_1', json_encode($results), 3600,true);
	$get_suggest = $this -> memcachedlib -> get('__trans_suggeest_1', true);
}

echo $get_suggest;
flush();
