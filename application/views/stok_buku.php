<?php
//header('Content-type: application/javascript');
$mysql_server = $hostname;
$mysql_login = $username;
$mysql_password = $password;
$mysql_database = $database;
//echo "xx";die;

//echo $branch;
$conn = mysql_connect($mysql_server, $mysql_login, $mysql_password);
	$db = mysql_select_db($mysql_database, $conn);
$qrb="SELECT a.tbid FROM transaction_detail_tab a, transaction_tab b WHERE 
a.ttid=b.tid AND b.tnofaktur NOT LIKE '%hp%'  AND a.approval ='2' limit 0,500";
$tqrb=mysql_query($qrb);
while($dtb=mysql_fetch_array($tqrb)){	
$bk=$dtb[0];
	$qr="SELECT b.tcid,SUM(a.tqty),a.tbid FROM transaction_detail_tab a, transaction_tab b WHERE a.ttid=b.tid  AND a.approval ='2' AND b.tbid='1' AND b.tnofaktur NOT LIKE '%hp%' AND a.tbid='$bk' 
	GROUP BY(b.tcid)";

	$tqr=mysql_query($qr);
	while($dt=mysql_fetch_array($tqr)){
		$tcid=$dt[0];
		$tqt=$dt[1];
		$tbid=$dt[2];
		echo $tcid.'-'.$tqt.'-'.$tbid.'<br>';
	$qrx="update inventory_tab set istockout='$tqt', istock=(istockbegining+istockin-istockout) where ibid='$tbid' and ibcid='$tcid' and itype='1'";
	$qry="update inventory_tab set istockin='$tqt', istock=(istockbegining+istockin-istockout) where ibid='$tbid' and ibcid='$tcid'and itype='2'";	
	//echo $qrx;die;
			 // mysql_query($qrx);
			 // mysql_query($qry);
				
	}
}
?>