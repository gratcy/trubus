    <html>
    <head>
    <style>
    @page { size 8.5in 28in; margin: 0 cm }
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
p.pos1 {
    position: fixed;
    top: 20px;
	left:80px;
	right:350px;
}

p.posqty {
    position: fixed;
    top: 480px;
	left:520px;
}

img.ex2 {
    position: fixed;
    top: 500px;
	left:300px;
}
p.pos_fixed {
    position: fixed;
    top: 20px;
    right: 210px;
    color: red;
	left:360px;
}
p.pos_fixedx {
    position: fixed;
    top: 50px;
    right: 210px;
    color: red;
	left:360px;
}

p.pos_info {
    position: fixed;
    top: 50px;
    right: 4px;
    color: red;
	left:670px;
	
}

p.pos_faktur {
    position: fixed;
    top: 15px;
    right: 4px;
    color: red;
	left:670px;
	
}

p.pos_tgl {
    position: fixed;
    top: 35px;
    right: 4px;
    color: red;
	left:670px;
	
}

p.pos_user {
    position: fixed;
    top: 620px;
    right: 4px;
    color: red;
	left:700px;
	
}

p.pos_kondisi {
    position: fixed;
    top: 620px;
    right: 4px;
    color: red;
	left:610px;
	
}


table.pos_fixedz {
    position: fixed;
    top: 0px;

}
table.pos_fixedzz {
    position: fixed;
    bottom: 300px;

}

h2 {
    position: relative;
    left: 100px;
    top: 150px;
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
.axb {
	font-family: Verdana, Geneva, sans-serif;
	font-size: 9px;
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
$jum_baris="8";
$ttqty=0;
$pg=0;	
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



    
  <?php //print_r($datx);
 
  $dtxx=explode("-",$datx[8]);
  $datexxx="$dtxx[2]-$dtxx[1]-$dtxx[0]";
  ?>


<div  ><p class="pos_fixed">	
<?=$datx[36];?> - (<?php echo $datx[35];?>)
</p></div>
<div class="axx"><p class="pos_fixedx">
<?=$datx[37];?>
</p></div>	

  <br><br><br><br><br><br><br>
  <?php //if($p=='1'){  echo "<br>";  }  ?>
  <table width="780" style="table-layout:fixed;" border="0" cellpadding="2" >
  
  
  

<?php
$r=0;$rt=0;
$jjx=0;
//$tot_brutto=0;
while ($data=mysql_fetch_row($tampil)){
		
	$jx=$jx+1;
	$jjx=$jjx+1;
	//echo "<div class='page'>";

	$pjss=strlen($data[39]);
	if($pjss>53){ $data39=$data[39]."<br>";}else{$data39=$data[39];}
	?>



	<p class="pos1" ><span class="axx"><b>
<?php 
$branch=$this -> memcachedlib -> sesresult['ubranchid'];
if($branch==1){ ?>	
	Jl.Gunung Sahari III <br>
	no.7 Jakarta Pusat 10610 - Indonesia<br>
	Phone.021 4204402,Fax 021 4214821 <br>
	www.niagaswadaya.co.id


<?php } elseif($branch==6){ ?>	
	Jl.Nyi Pembayun no.16a  <br>
	Prenggan Kota Gede Jogjakarta<br>
	Indonesia <br>
	www.niagaswadaya.co.id
<?php } elseif($branch==7){ ?>	
	Jl.Kutisari Indah Utara gg vi 36/38 <br>
	phone/fax: 0318431221<br>
	Surabaya - Indonesia <br>
	www.niagaswadaya.co.id	
<?php } else{ ?>	
	Jl.Gunung Sahari III <br>
	no.7 Jakarta Pusat 10610 - Indonesia<br>
	Phone.021 4204402,Fax 021 4214821 <br>
	www.niagaswadaya.co.id
<?php } ?>
	</b></span></p>
	<p class="pos_faktur"><span class="axx"><b><?=$datx[3];?></b></span></p>
	<p class="pos_tgl"><span class="axx"><?=$datexxx;?></span></p>
	<p class="pos_info"><span class="axx"><?=$datx[16];?></span></p>
<p class="pos_user"><span class="axx">user </span></p>
<p class="pos_kondisi"><span class="axx">Konsinyasi</span></p>
	<p class="pos_fixedx">&nbsp;</p>



	  <tr>
		<td valign="top" width=100 bgcolor="#E8E8E8"><span class="ax">&nbsp;&nbsp;<?=$data[38];?></span></td>
		<td  width=380 colspan=2 rowspan=2 valign="top" bgcolor="#E8E8E8" ><span class="axb"><?=$data39;?></span></td>
		<td   valign="top" width=95 bgcolor="#E8E8E8"  ><span class="ax">&nbsp;&nbsp;&nbsp;
		<?=number_format($data[27], 0, '.', ',');?></span></td>
		<td  valign="top" width=35 bgcolor="#E8E8E8"><span class="ax"><?=number_format($data[26], 0, '.', ',');?></span></td>
		<td valign="top" width=40 bgcolor="#E8E8E8"><span class="ax"><?=number_format($data[29], 2, '.', ',');?></span></td>
		<td valign="top"  bgcolor="#E8E8E8"><span class="ax"><?=number_format($data[30], 2, '.', ',');?></span></td>
	  </tr>
	  
	  <tr>
		<td valign="top" width=100 bgcolor="#E8E8E8"><span class="ax">&nbsp;</span></td>
		
		<td   valign="top" width=95 bgcolor="#E8E8E8"  ><span class="ax">&nbsp;</span></td>
		<td  valign="top" width=35 bgcolor="#E8E8E8"><span class="ax">&nbsp;</span></td>
		<td valign="top" width=40 bgcolor="#E8E8E8"><span class="ax">&nbsp;</span></td>
		<td valign="top"  bgcolor="#E8E8E8"><span class="ax">&nbsp;</span></td>
	  </tr>	  
	  
<?php
	$ttqty=$data[26]+$ttqty;
	$rr=2;
	$pjs=0;
	$pjs=strlen($data[39]);
	//if($pjs>57){ $rr=2;}else{$rr=1;}
	$tnet=$data[27]*$data[26];
	$tot_brutto=$tnet+$tot_brutto;
	$tot_netto =$data[30]+$tot_netto;
	$tot_disc=$tot_brutto-$tot_netto;
	$r=$r+$rr;
	$rt=$rt+1;
	//echo $r.'-'.$rt.'-'.$rr.'xx';
}

$f=(24-($r+$rt))/3;
//echo $f;
for($z=0;$z<$f;$z++){
?>
	  <tr>
		<td valign="top" width=100 bgcolor="#E8E8E8"><span class="ax">&nbsp;</span></td>
		<td  width=380 colspan=2 rowspan=2 valign="top" bgcolor="#E8E8E8" ><span class="ax">&nbsp;</span></td>
		<td   valign="top" width=95 bgcolor="#E8E8E8"  ><span class="ax">&nbsp;</span></td>
		<td  valign="top" width=35 bgcolor="#E8E8E8"><span class="ax">&nbsp;</span></td>
		<td valign="top" width=40 bgcolor="#E8E8E8"><span class="ax">&nbsp;</span></td>
		<td valign="top"  bgcolor="#E8E8E8"><span class="ax">&nbsp;</span></td>
	  </tr>
	  
	  <tr>
		<td valign="top" width=100 bgcolor="#E8E8E8"><span class="ax">&nbsp;</span></td>
		
		<td   valign="top" width=95 bgcolor="#E8E8E8"  ><span class="ax">&nbsp;</span></td>
		<td  valign="top" width=35 bgcolor="#E8E8E8"><span class="ax">&nbsp;</span></td>
		<td valign="top" width=40 bgcolor="#E8E8E8"><span class="ax">&nbsp;</span></td>
		<td valign="top"  bgcolor="#E8E8E8"><span class="ax">&nbsp;</span></td>
	  </tr>	  
<?php 
}

$pg=$pg+1;
 ?> 
   <tr>
    <td colspan=2 valign="top"><span class="axx">&nbsp;</span></td>
    <td valign="top"><span class="axx">&nbsp;</span></td>
    <td valign="top"><span class="axx"><b>&nbsp;</b></span></td>
    <td valign="top"><span class="axx">&nbsp;</span></td>
    <td valign="top"><span class="axx">&nbsp;</span></td>
    <td valign="top"><span class="axx">&nbsp;</span></td>
  </tr>
  <tr>
    <td colspan=2 valign="top"><span class="axx">&nbsp;</span></td>
    <td valign="top"><span class="axx">&nbsp;</span></td>
    <td valign="top"><span class="axx"><b>&nbsp;</b></span></td>
    <td valign="top"><span class="axx">&nbsp;</span></td>
    <td valign="top"><span class="axx">&nbsp;</span></td>
    <td valign="top"><span class="axx">&nbsp;</span></td>
  </tr>

  <tr>
    <td height="33" colspan="3" valign="top"><span class="ax"><font color="white">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></td>
	<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td colspan="2" valign="top"><span class="ax"><?=$ttqty;?>&nbsp;</span></td>
    <td valign="top"><span class="ax"><?=number_format($tot_brutto, 2, '.', ',');?></span></td>
  </tr>
  <tr>
    <td height="26" colspan="4" valign="top">&nbsp;</td>
    <td colspan="2" valign="top"><span class="ax"></span></td>
    <td valign="top"><span class="ax"><?=number_format($tot_disc, 2, '.', ',');?></span></td>
  </tr>

  
  <tr>
    <td colspan="4" valign="top">&nbsp;</td>
    <td colspan="2" valign="top"><span class="ax"></span></td>
    <td valign="middle" ><span class="ax"><br><?=number_format($tot_netto, 2, '.', ',');?></span></td>
  </tr>

   <tr>
    <td height="26" colspan="3" valign="top">&nbsp;</td>
    <td valign="top">&nbsp;</td>
    <td valign="top">&nbsp;</td>
    <td valign="top">&nbsp;</td>
    <td valign="top"><span class="axx"><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;<?=$pg;?> of <?=$jum_page;?></span></td>
  </tr> 

</table>



<?php

echo "</div>";

}
?>	
