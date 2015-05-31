    <html>
    <head>
    <style>
    @page { size 8.5in 11in; margin: 2cm }
    div.page { page-break-after: always }
    </style>
	
	<style type="text/css">
/* Print. */
@media print {
  /* cssclsNoPrint class. */
  .cssclsNoPrint {display:none}
}

/* Screen. */
@media screen {
  /* cssclsNoScreen class. */
  .cssclsNoScreen {display:none}
}
</style>
<script>
function printDiv(divName) {
      var printContents = document.getElementById(divName).innerHTML;    
   var originalContents = document.body.innerHTML;      
   document.body.innerHTML = printContents;     
   window.print();     
   document.body.innerHTML = originalContents;
   }
</script>
	
    </head>
<?php
$tnet=0;
$tot_netto=0;
$tot_brutto=0;
$tot_disc=0; 

$mysql_server = $hostname;
$mysql_login = $username;
$mysql_password = $password;
$mysql_database = $database;

// mysql_connect("localhost","root","");
// mysql_select_db("niaga_swadaya_db");
mysql_connect($mysql_server, $mysql_login, $mysql_password);
mysql_select_db($mysql_database);
$jum_baris="17";

$sqlx="SELECT *,
		(select ccode from customer_tab d where d.cid=a.tcid)as ccode,
		(select cname from customer_tab d where d.cid=a.tcid)as cname,
		(select caddr from customer_tab d where d.cid=a.tcid)as caddr,
        (select bcode from books_tab c where c.bid=b.tbid)as bcode,
		(select btitle from books_tab c where c.bid=b.tbid)as btitle
		FROM transaction_tab a, transaction_detail_tab b WHERE (a.tstatus='1' OR a.tstatus='0') AND ttype='1' AND ttypetrans='3'  AND a.tid=b.ttid AND a.tid='$id' ORDER BY b.tid DESC";
$tampilx=mysql_query($sqlx);
$jum_data=mysql_num_rows($tampilx);
$jum_page=ceil($jum_data/$jum_baris);

$datx=mysql_fetch_row($tampilx);
//echo "$jum_data $jum_page";
$jx=0;
$b=0;
for($p=1; $p<= $jum_page; $p++){
$c=$p*$jum_baris;


//echo "$p $c <br>";
$cx=$c-$jum_baris;
$sql="SELECT *,
		(select ccode from customer_tab d where d.cid=a.tcid)as ccode,
		(select cname from customer_tab d where d.cid=a.tcid)as cname,
		(select caddr from customer_tab d where d.cid=a.tcid)as caddr,
        (select bcode from books_tab c where c.bid=b.tbid)as bcode,
		(select btitle from books_tab c where c.bid=b.tbid)as btitle
		FROM transaction_tab a, transaction_detail_tab b WHERE (a.tstatus='1' OR a.tstatus='0') AND ttype='1' AND ttypetrans='3'  AND a.tid=b.ttid AND a.tid='$id' ORDER BY b.tid  limit $cx,$jum_baris";
$tampil=mysql_query($sql);

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<style type="text/css">
body p {
	font-family: Verdana, Geneva, sans-serif;
}
.ax {
	font-family: Verdana, Geneva, sans-serif;
	font-size: 12px;
	text-align: right;
}
.axx {
	font-family: Verdana, Geneva, sans-serif;
	font-size: 10px;
	text-align: left;
}

body p {
	text-align: center;
}
body p {
	text-align: left;
	font-size: 10px;
}
body p {
	font-size: 9px;
}
body p {
	font-size: 10px;
}
.xxx {
	font-size: 9px;
}
body p {
	font-family: Verdana, Geneva, sans-serif;
}
body p {
	font-size: 10px;
}
.yes {
	color: #999;
}
.puthh {
	color: #FFF;
}
</style>
</head>

<body>


<table width="730" border="0" cellpadding="0">



  <tr>
<td width="98" rowspan="5" valign="top" class="axx"><img src="<?php echo site_url('application/views/assets/img/hex00.jpg');?>" alt="okt" width="71" height="65"  /><span class="ax"><font color=white ></font></span></td>
    <td width="415" height="13" valign="top" class="axx"><div align="center"><span class="axx"><b>Kepada Yth</b></span></div></td>
    <td colspan=4 width="91" valign="top" class="axx"><div align="left"><span class="axx"></span><b>Faktur Retur Hp</b></div></td>
    
  <?php //print_r($datx);
 
  $dtxx=explode("-",$datx[8]);
  $datexxx="$dtxx[2]-$dtxx[1]-$dtxx[0]";
  ?>
  </tr>



  <tr>
    <td width="415" valign="top" class="axx"><div align="center"><b></b><span class="axx"> 
	<?=$datx[34];?></span></div></td>
    <td colspan=2 width="91" valign="top" class="axx"><div align="left"><span class="axx"></span>No Faktur</div></td>
    
    <td width="35" valign="top" class="axx"><div align="left"><span class="axx"><font color=white >.</font></span></div></td>
    <td width="77" valign="top" class="axx"><div align="left"><span class="axx"><?=$datx[3];?></span></div></td>
  </tr>
  <tr>
    <td valign="top" rowspan=2 class="axx"><div align="center"><?=$datx[35];?></div></td>
    <td valign="top" colspan=2 ><div align="left"><span class="axx">Tanggal</span></div></td>
    
    <td valign="top"><div align="left"><span class="axx"><font color=white >.</font></span></div></td>
    <td valign="top"><div align="left"><span class="axx"><?=$datexxx;?></span></div></td>
  </tr>
  <tr>
    
    <td valign="top"><div align="left"><span class="axx">info</span></div></td>
    <td valign="top"><div align="left"><span class="axx"><font color=white >.</font></span></div></td>
    <td valign="top"><div align="left"><span class="axx"><font color=white >.</font></span></div></td>
    <td valign="top"><div align="left"><span class="axx"><?=$datx[16];?></span></div></td>
  </tr>
  <tr>
    <td valign="top"><span class="ax"><font color=white >.</font></span></td>
    <td valign="top"><span class="ax"><font color=white >.</font></span></td>
    <td valign="top"><span class="ax"><font color=white >.</font></span></td>
    <td valign="top"><span class="ax"><font color=white >.</font></span></td>
    <td valign="top"><span class="ax"><font color=white >.</font></span></td>
  </tr>
  
  
  
  
  
  
  
  
  
  
  <tr>
    <td height="23" valign="top" bgcolor="#CCCCCC"><span class="ax">PLU</span></td>
    <td valign="top" bgcolor="#CCCCCC"><span class="ax">Nama Barang</span></td>
    <td valign="top" bgcolor="#CCCCCC"><span class="ax">Harga</span></td>
    <td valign="top" bgcolor="#CCCCCC"><span class="ax">Qty</span></td>
    <td valign="top" bgcolor="#CCCCCC"><span class="ax">Disc</span></td>
    <td valign="top" bgcolor="#CCCCCC"><span class="ax">Jumlah</span></td>
  </tr>
<?php
$r=0;
$jjx=0;
//$tot_brutto=0;
while ($data=mysql_fetch_row($tampil)){
	//print_r($data);
	
	
$jx=$jx+1;
$jjx=$jjx+1;
echo "<div class='page'>";
?>





  <tr>
    <td valign="top" bgcolor="#E8E8E8"><span class="ax"><?=$data[36];?></span></td>
    <td valign="top" bgcolor="#E8E8E8"><span class="ax"><?=$data[37];?></span></td>
    <td valign="top" bgcolor="#E8E8E8"><span class="ax"><?=number_format($data[25], 2, '.', ',');?></span></td>
    <td valign="top" bgcolor="#E8E8E8"><span class="ax"><?=number_format($data[24], 2, '.', ',');?></span></td>
    <td valign="top" bgcolor="#E8E8E8"><span class="ax"><?=number_format($data[27], 2, '.', ',');?></span></td>
    <td valign="top" bgcolor="#E8E8E8"><span class="ax"><?=number_format($data[28], 2, '.', ',');?></span></td>
  </tr>
<?php
$tnet=$data[25]*$data[24];
$tot_netto=$tnet+$tot_netto;
$tot_brutto=$data[28]+$tot_brutto;
$tot_disc=$tot_netto-$tot_brutto;
$r=$r+1;
}
//include "testingxz.php";		
// echo "$p - $c * $jx - $cx - $data[0] * $data[1] * $data[2] * $data[3] 
// * $data[33] * $data[34] * $data[35] * $data[36] * $data[37]
// <br>";
//if($c==$jx){
$f=17-$r;	
//echo $r.$f;
for($z=0;$z<$f;$z++){
?>

  <tr>
    <td valign="top">&nbsp;</td>
    <td valign="top">&nbsp;</td>
    <td valign="top">&nbsp;</td>
    <td valign="top">&nbsp;</td>
    <td valign="top">&nbsp;</td>
    <td valign="top">&nbsp;</td>
  </tr>
<?php }?>


  <tr>
    <td height="33" colspan="2" valign="top"><span class="ax"><font color="white">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>Hormat Kami, <font color="white">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>Expedisi,<font color="white">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font> Yang Menerima,</span></td>
    <td colspan="3" valign="top"><span class="ax">Total Brutto</span></td>
    <td valign="top"><span class="ax"><?=number_format($tot_brutto, 2, '.', ',');?></span></td>
  </tr>
  <tr>
    <td height="26" colspan="2" valign="top">&nbsp;</td>
    <td colspan="3" valign="top"><span class="ax">Total Disc</span></td>
    <td valign="top"><span class="ax"><?=number_format($tot_disc, 2, '.', ',');?></span></td>
  </tr>
  <tr>
    <td colspan="2" valign="top">&nbsp;</td>
    <td colspan="3" valign="top"><span class="ax">Total Netto</span></td>
    <td valign="top"><span class="ax"><?=number_format($tot_netto, 2, '.', ',');?></span></td>
  </tr>
  <tr>
    <td height="26" colspan="2" valign="top">&nbsp;</td>
    <td valign="top">&nbsp;</td>
    <td valign="top">&nbsp;</td>
    <td valign="top">&nbsp;</td>
    <td valign="top"><span class="ax">&nbsp;</span></td>
  </tr>
    <tr>
    <td colspan="2" valign="top">&nbsp;</td>
    <td colspan="3" valign="top"><span class="ax">Retur Hp</span></td>
    <td valign="top"><span class="ax">&nbsp;user</span></td>
  </tr>
      <tr>
    <td colspan="2" valign="top">&nbsp;</td>
    <td colspan="3" valign="top">&nbsp;</td>
    <td valign="top"><span class="ax">&nbsp;</span></td>
  </tr>
</table>



<?php

echo "<br><br></div>";
//}

//}

}
?>	