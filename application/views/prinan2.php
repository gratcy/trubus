    <html>
    <head>
    <style>
    @page { size 8.5in 11in; margin: 0 cm }
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
<style type="text/css">
img.ex1 {
    position: fixed;
    bottom: 0px;
}

img.ex2 {
    position: fixed;
    bottom: 390px;
	left:300px;
}
p.pos_fixed {
    position: fixed;
    top: 30px;
    right: 210px;
    color: red;
	left:360px;
}
p.pos_fixedx {
    position: fixed;
    top: 70px;
    right: 210px;
    color: red;
	left:360px;
}

p.pos_info {
    position: fixed;
    top: 65px;
    right: 4px;
    color: red;
	left:700px;
	
}

p.pos_faktur {
    position: fixed;
    top: 27px;
    right: 4px;
    color: red;
	left:705px;
	
}

p.pos_tgl {
    position: fixed;
    top: 47px;
    right: 4px;
    color: red;
	left:710px;
	
}
p.pos_bottom {
    position: fixed;
    top: 75px;
    right: 210px;
    color: red;
	left:360px;
}

table.pos_fixedz {
    position: fixed;
    top: 0px;

}
table.pos_fixedzz {
    position: fixed;
    bottom: 300px;

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

.xxx {
	font-size: 9px;
}
body p {
	font-family: Verdana, Geneva, sans-serif;
}

.yes {
	color: #999;
}
.puthh {
	color: #FFF;
}
</style>	
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
$jum_baris="9";
$ttqty=0;
	
$sqlx="SELECT *,
		(select ccode from customer_tab d where d.cid=a.tcid)as ccode,
		(select cname from customer_tab d where d.cid=a.tcid)as cname,
		(select caddr from customer_tab d where d.cid=a.tcid)as caddr,
        (select bcode from books_tab c where c.bid=b.tbid)as bcode,
		(select btitle from books_tab c where c.bid=b.tbid)as btitle
		FROM transaction_tab a, transaction_detail_tab b WHERE (a.tstatus='1' OR a.tstatus='0') AND ttype='2' AND ttypetrans='1'  AND a.tid=b.ttid AND a.tid='$id' ORDER BY b.tid DESC";
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
		FROM transaction_tab a, transaction_detail_tab b WHERE (a.tstatus='1' OR a.tstatus='0') AND ttype='2' AND ttypetrans='1'  AND a.tid=b.ttid AND a.tid='$id' ORDER BY b.tid  limit $cx,$jum_baris";
$tampil=mysql_query($sql);



?>

<div class='page'>
<body>


<table width="780" style="table-layout:fixed;"  class="pos_fixedz" border="0" cellpadding="2">



  <tr>
<td width="85" rowspan="5" valign="top" class="axx"><img src="<?php echo site_url('application/views/assets/img/hex00.jpg');?>" alt="okt" width="71" height="65"  /><span class="ax"><font color=white ></font></span></td>
<td width=220 valign="top"></td>
    <td width="250" height="13" colspan=2 valign="top" class="axx"><div align="left"><span class="axx"><b>Kepada Yth</b></span></div></td>
    <td  colspan=3  width=120 valign="top" class="axx"><div align="left"><span class="axx"></span><b>Faktur Penjualan</b><br>&nbsp;</div></td>
    
  <?php //print_r($datx);
 
  $dtxx=explode("-",$datx[8]);
  $datexxx="$dtxx[2]-$dtxx[1]-$dtxx[0]";
  ?>
  </tr>

<div  ><p class="pos_fixed">	
<?=$datx[34];?> - (<?php echo $datx[33];?>)
</p></div>
<div class="axx"><p class="pos_fixedx">
<?=$datx[35];?>
</p></div>	
  <tr>
  <td valign="top"  rowspan=2 ><span class="ax">&nbsp;</span></td>
    <td  rowspan=2 colspan=2 valign="top" align="right" class="axx">
	&nbsp;</td>
    
    
    <td  colspan=2 valign="top" class="axx"><div align="left"><span class="axx">No Faktur</span></div></td>
    <td  valign="top"   class="axx"><div align="left"><span class="axx">&nbsp;</span></div></td>
  </tr>
  
    <tr>

    
    
   
    <td valign="top" colspan=2 > <div align="left"><span class="axx">Tanggal</span></div></td>
	<td valign="top"> <div align="left"><span class="axx">&nbsp;</span></div></td>
	
  </tr>
  
  
  
  
  
  <tr>
  <td valign="top"><span class="axx"><font color=white >.</font></span></td>
    <td valign="top" colspan=2 rowspan=2 class="axx">&nbsp;</td>
    
    
    <td valign="top" colspan=2 ><div align="left"><span class="axx">Info</span></div></td>
    <td valign="top"  rowspan=2 ><div width=10 align="left">&nbsp;</div></td>
  </tr>
  
  
  

  <tr>
    <td valign="top"><span class="axx">&nbsp;</span></td>
    <td valign="top" colspan=2 ><span class="axx">&nbsp;&nbsp;</span></td>
  
    
    
  </tr>
  
  </table><br><br><br><br><br><br>
  <table width="780" style="table-layout:fixed;" border="0" cellpadding="2" >
  
  
  
  
  
  
  
  
  <tr>
    <td height="23" width=100 valign="top" bgcolor="#CCCCCC"><span class="ax">&nbsp;PLU</span></td>
    <td valign="top"  width=380 colspan=2 bgcolor="#CCCCCC"><span class="ax">Nama Barang<br>&nbsp;
	</span></td>
    <td valign="top" width=90 bgcolor="#CCCCCC"><span class="ax">&nbsp;&nbsp;&nbsp;	 Harga </span></td>
    <td valign="top" width=40  bgcolor="#CCCCCC"><span class="ax">Qty&nbsp;&nbsp;&nbsp;&nbsp; </span></td>
    <td valign="top" width=40 bgcolor="#CCCCCC"><span class="ax">Disc</span></td>
    <td valign="top"  bgcolor="#CCCCCC"><span class="ax">Jumlah</span></td>
  </tr>
<?php
$r=0;$rt=0;
$jjx=0;
//$tot_brutto=0;
while ($data=mysql_fetch_row($tampil)){
	//print_r($data);
	
	
$jx=$jx+1;
$jjx=$jjx+1;
//echo "<div class='page'>";

$pjss=strlen($data[37]);
if($pjss>53){ $data37=$data[37]."<br>";}else{$data37=$data[37];}
?>

<img class="ex2" src="<?php echo site_url('application/views/assets/img/ppn5.png');?>" alt="logo" width="150" height="50"  />

<p class="pos_faktur"><span class="axx"><b><?=$datx[3];?></b></span></p>
<p class="pos_tgl"><span class="axx"><?=$datexxx;?></span></p>
<p class="pos_info"><span class="axx"><?=$datx[16];?></span></p>

<p class="pos_fixedx">&nbsp;</p>



  <tr>
    <td valign="top" bgcolor="#E8E8E8"><span class="ax">&nbsp;&nbsp;<?=$data[36];?></span></td>
    <td  colspan=2 valign="top" bgcolor="#E8E8E8" ><span class="ax"><?=$data37;?></span></td>
    <td   valign="top" bgcolor="#E8E8E8" halign="right" ><span class="ax">
	<?=number_format($data[25], 0, '.', ',');?></span></td>
    <td  valign="top" bgcolor="#E8E8E8"><span class="ax"><?=number_format($data[24], 0, '.', ',');?></span></td>
    <td valign="top" bgcolor="#E8E8E8"><span class="ax"><?=number_format($data[27], 2, '.', ',');?></span></td>
    <td valign="top"  bgcolor="#E8E8E8"><span class="ax"><?=number_format($data[28], 2, '.', ',');?></span></td>
  </tr>
<?php
$ttqty=$data[24]+$ttqty;
$rr=0;
$pjs=0;
$pjs=strlen($data[37]);
if($pjs>57){ $rr=2;}else{$rr=1;}
$tnet=$data[25]*$data[24];
$tot_brutto=$tnet+$tot_brutto;
$tot_netto =$data[28]+$tot_netto;
$tot_disc=$tot_brutto-$tot_netto;
$r=$r+$rr;
$rt=$rt+1;
//echo $r.'-'.$rt;
}


?>

  <tr>
    <td colspan=2 valign="top"><span class="axx">&nbsp;</span>
	<span class="axx"><br>&nbsp;</span>
	<span class="axx"><br>&nbsp;</span>
<?php
$f=27-($r+$rt);
//echo $f;
for($z=0;$z<$f;$z++){
?>
<span class="axx"><br>&nbsp;</span>

<?php }?>
</td>
  </tr>

  <tr>
    <td colspan=2 valign="top"><span class="axx">&nbsp;</span></td>
    <td valign="top"><span class="axx">&nbsp;</span></td>
    <td valign="top"><span class="axx"><b>Total QTY</b></span></td>
    <td valign="top"><span class="axx"><b><?=$ttqty;?></b></span></td>
    <td valign="top"><span class="axx">&nbsp;</span></td>
    <td valign="top"><span class="axx">&nbsp;</span></td>
  </tr>

  <tr>
    <td height="33" colspan="3" valign="top"><span class="ax"><font color="white">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>Hormat Kami, &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	Expedisi,&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Yang Menerima,</span></td>
	<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td colspan="2" valign="top"><span class="ax">Total Brutto</span></td>
    <td valign="top"><span class="ax"><?=number_format($tot_brutto, 2, '.', ',');?></span></td>
  </tr>
  <tr>
    <td height="26" colspan="4" valign="top">&nbsp;</td>
    <td colspan="2" valign="top"><span class="ax">Total Disc</span></td>
    <td valign="top"><span class="ax"><?=number_format($tot_disc, 2, '.', ',');?></span></td>
  </tr>
  <tr>
    <td colspan="4" valign="top">&nbsp;</td>
    <td colspan="2" valign="top"><span class="ax">Total Netto</span></td>
    <td valign="top"><span class="ax"><?=number_format($tot_netto, 2, '.', ',');?></span></td>
  </tr>
  <tr>
    <td height="26" colspan="3" valign="top">&nbsp;</td>
    <td valign="top">&nbsp;</td>
    <td valign="top">&nbsp;</td>
    <td valign="top">&nbsp;</td>
    <td valign="top"><span class="axx">&nbsp;</span></td>
  </tr>
  <tr>
    <td colspan="4" valign="top">&nbsp;</td>
    <td colspan="2" valign="top"><span class="ax">konsinyasi</span></td>
    <td valign="top"><span class="ax">&nbsp;user</span></td>
  </tr>
      <tr>
    <td colspan="4" valign="top">&nbsp;</td>
    <td colspan="2" valign="top">&nbsp;</td>
    <td valign="top"><span class="ax">&nbsp;</span></td>
  </tr>
</table>



<?php

echo "<br><br></div>";
//}

//}

}
?>	
