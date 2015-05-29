<?php
$mysql_server = $hostname;
$mysql_login = $username;
$mysql_password = $password;
$mysql_database = $database;
if(!isset($_REQUEST['term'])){$_REQUEST['term']="";}

if(!isset($_REQUEST['branch'])){$_REQUEST['branch']="";}

mysql_connect($mysql_server, $mysql_login, $mysql_password);
mysql_select_db($mysql_database);



$req = "SELECT cid,c.gid ,c.gname,
cbid,ccode,cname,caddr,cphone,cemail,cnpwp,cdisc,ctax,bcode "
	."FROM customer_tab a,branch_tab b,gudang_tab c "
	."WHERE a.cbid=b.bid  AND a.cbid =".$_REQUEST['branch']." AND  (cname LIKE '%".$_REQUEST['term']."%' OR ccode LIKE '%".$_REQUEST['term']."%')  
	AND c.gbcpid=a.cid AND c.gtype='customer'"; 
//echo $req."<br>";
$query = mysql_query($req);

while($row = mysql_fetch_array($query))
{
if($row['ctax']==0){$ctx="InTaxable";}
else if($row['ctax']==1){$ctx="Taxable";}

	$results[] = array('label' => $row['cname'],'cid' => $row['cid'],'gid' => $row['gid'],'gname' => $row['gname'],'cbid' => $row['cbid'],
	'ccode' => $row['ccode'],'caddr' => $row['caddr'],'cphone' => $row['cphone'],
	'cnpwp' => $row['cnpwp'],'cemail' => $row['cemail'],'cdisc' => $row['cdisc'],'ctax' => $row['ctax'],
	'ctx' => $ctx ,'bcode'=>$row['bcode'] );
}

echo json_encode($results);
flush();
?>