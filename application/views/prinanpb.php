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
	font-size: 10px;
}

body,td,th {
	font-family: Verdana, Geneva, sans-serif;
	font-size: 12px;
}
.ax {
	font-family: Verdana, Geneva, sans-serif;
	font-size: 10px;
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
	

<div >
<body>


<?php  

if(!isset($_GET['kotapb'])){$_GET['kotapb']="";}
if(!isset($_GET['namapb'])){$_GET['namapb']="";}	

if($_GET['namapb']==""){
	?>
	<form>
	<table width=80% >
	<tr><td rowspan=4 width=10% ></td><td>Kota</td><td><input type=text name="kotapb"></td></tr>
	<tr><td>Tanggal</td><td><input type=text name="tanggalpb"></td></tr>
	<tr><td>Nama</td><td><input type=text name="namapb" value='Dra. Ambar Satyawati' ></td></tr>
	<tr><td><input type=submit></td><td></td></tr>
	</table>
	</form>
<?php	
}


 
function Terbilang($satuan){  
$huruf = array ("", "satu", "dua", "tiga", "empat", "lima", "enam",   
"tujuh", "delapan", "sembilan", "sepuluh","sebelas");  
if ($satuan < 12)  
 return " ".$huruf[$satuan];  
elseif ($satuan < 20)  
 return Terbilang($satuan - 10)." belas";  
elseif ($satuan < 100)  
 return Terbilang($satuan / 10)." puluh".  
 Terbilang($satuan % 10);  
elseif ($satuan < 200)  
 return " seratus".Terbilang($satuan - 100);  
elseif ($satuan < 1000)  
 return Terbilang($satuan / 100)." ratus".  
 Terbilang($satuan % 100);  
elseif ($satuan < 2000)  
 return " seribu".Terbilang($satuan - 1000);   
elseif ($satuan < 1000000)  
 return Terbilang($satuan / 1000)." ribu".  
 Terbilang($satuan % 1000);   
elseif ($satuan < 1000000000)  
 return Terbilang($satuan / 1000000)." juta".  
 Terbilang($satuan % 1000000);   
elseif ($satuan < 1000000000000)  
 return Terbilang($satuan / 1000000000)." miliar".  
 Terbilang($satuan % 1000000000);   
}  
?>  
   



<p align=center>
<table border=0 width=90% >


<tr>
<td width=72 >&nbsp;</td>
<td width="218" valign=top  >
<img src="<?php echo site_url('application/views/assets/img/logo.png'); ?>" style="float: right;position: absolute;">
<br><br><br>
</td>
<td valign=top     align=center width=423 >
PT. NIAGA SWADAYA

</td>
<td colspan="2"  >&nbsp;</td>
</tr>

<tr><td rowspan="2"  >&nbsp;</td>
<td valign=top rowspan=3 >
<?php if( $detail[0]->aname <> ""){ ?>
Area : <?=$detail[0]->aname;?>	
<?php
}	
if($detail[0]->cname<>""){
?>	
<br>Customer : <?=$detail[0]->cname;?>
<?php } ?>
</td>
<td  width=423 rowspan="2" valign=top >
</td>
<td width="91" align=left valign=top >

No Kwitansi 
<br></td>
<td width="125" align=left valign=top >: <?=$detail[0]->invno;?></td>
</tr>
<tr>
  <td align=left valign=top width="115" >Jatuh Tempo </td>
  <td width="125" align=left valign=top >: <?=$detail[0]->invduedate;?></td>
</tr>

<tr>
<td>&nbsp;</td>
<td valign=top >
&nbsp;<br><br>
</td><td colspan="2" valign=top >&nbsp;</td>

</tr>


<tr>
<td>&nbsp;</td>
<td colspan=4 bgcolor=#E7E7E7 >Banyaknya Uang : <?=terbilang($detail[0]->invtotalall);?> rupiah</td>
</tr>
<tr>
<td>&nbsp;</td>
<td colspan=4 >Untuk Pembayaran : <?=$detail[0]->desc;?>
<br>
</td>
</tr>

<tr>
<td>&nbsp;</td>
<td colspan=4 ><br>&nbsp;
</td>
</tr>

<tr>
<td>&nbsp;</td>
<td colspan=2 >Terbilang : Rp <?=number_format($detail[0]->invtotalall,2);?></td>
<td colspan="2" align=right >
<?=$_GET['kotapb'];?> <?=$_GET['tanggalpb'];?>&nbsp;&nbsp;
</td>
</tr>

<tr>
<td width=72 >&nbsp;</td>
<td><br><br></td><td>&nbsp;</td><td colspan="2" align=right><br><br><br>
<?=$_GET['namapb'];?>
</td>
</table>
</p>
<?php
//print_r($detail[0]);die;
?>