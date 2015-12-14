<?php
header('Content-type: application/javascript');
$mysql_server = $hostname;
$mysql_login = $username;
$mysql_password = $password;
$mysql_database = $database;
//You can write some code in there.
//Connect Database and make sql query in here
// mysql_connect("localhost","root","");
// mysql_select_db("niaga_swadaya_db");
//echo "Search For ".$_GET['data'];

if(($_GET['pcat']==2) and ($_GET['branch']==1)){


$qr="select istock,ishadow from inventory_tab where itype='1' AND istatus='1' AND ibcid='".$_GET['branch']."' AND ibid= ".$_GET['data'];
$tqr=mysql_query($qr);
$dqr=mysql_fetch_array($tqr);



$qq="SELECT SUM(b.tqty) FROM transaction_tab a , transaction_detail_tab b WHERE a.tid=b.ttid 
AND tnofaktur LIKE 'j%'  AND a.approval < 2  AND a.tbid='".$_GET['branch']."' AND a.tstatus <>'2' ";
$tqq=mysql_query($qq);
$dqq=mysql_fetch_array($tqq);
$sisa=$dqr[1]-$dqq[0];
echo "stok final :". $dqr[0]."<br>";
echo "stok shadow :". $dqr[1]."<br>";
echo "stok proses :". $dqq[0]."<br>";
echo "stok sisa :". $sisa."<br>";	
	
}else{	

$qr="select istock from inventory_tab where itype='1' AND ibcid='".$_GET['branch']."' AND ibid= ".$_GET['data'];
$tqr=mysql_query($qr);
$dqr=mysql_fetch_array($tqr);


$qq="SELECT SUM(b.tqty) FROM transaction_tab a , transaction_detail_tab b WHERE a.tid=b.ttid 
AND tnofaktur LIKE 'j%'  AND a.approval < 2  AND a.tbid='".$_GET['branch']."' AND b.tbid='".$_GET['data']."' AND a.tstatus <>'2'";
$tqq=mysql_query($qq);
$dqq=mysql_fetch_array($tqq);
$sisa=$dqr[0]-$dqq[0];
echo "stok final :". $dqr[0]."<br>";
echo "stok proses :". $dqq[0]."<br>";
echo "stok sisa :". $sisa."<br>";

}
// echo $_GET['pcat'];
// echo $_GET['branch'];
//echo "<input type='text' name='dd' value='". $dqr[0] ."' >";
?>
<div class="form-group">
	<label>Stok Left</label>
	<input type="text"  name="tstok"  class="form-control" placeholder="Qty" id="thestok" value="<?=$sisa;?>"	>
</div>	
<!--div class="form-group">
	<label>Stok Left</label>
	<input type="text"  name="tstok"  class="form-control" placeholder="Qty" id="thestok" 
	value="<?//=$sisa;?>"	>
</div-->