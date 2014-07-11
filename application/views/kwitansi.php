
<?php   
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
 return "seratus".Terbilang($satuan - 100);  
elseif ($satuan < 1000)  
 return Terbilang($satuan / 100)." ratus".  
 Terbilang($satuan % 100);  
elseif ($satuan < 2000)  
 return "seribu".Terbilang($satuan - 1000);   
elseif ($satuan < 1000000)  
 return Terbilang($satuan / 1000)." ribu".  
 Terbilang($satuan % 1000);   
elseif ($satuan < 1000000000)  
 return Terbilang($satuan / 1000000)." juta".  
 Terbilang($satuan % 1000000);   
elseif ($satuan >= 1000000000)  
 echo "Angka terlalu Besar";  
}  
?>  

<html>
<head>
<title>Print Kwitansi</title>
</head>
<body style="font-family:Courier;" onload="window.print();">
<div style="width:850px;padding:50px 5px 5px 10px;">
	<div style="padding:5px;">
		<span style="font-size:20px;font-weight:bold;">ARNO CREATIVE</span>
		<span style="font-size:20px;font-weight:bold;float:right;border:1px solid #000;padding:3px;">NO PO: &nbsp;0000</span>
		<br>
		Menerima Pesanan T-Shirt - Polo - Oblong
		<br>Topi Promosi - Baju Seragam - Dll
		<br>Jl. Pulo Raya No. 20 RT. 006/08 Cengkareng Jak-Bar
		<br>Telp: 0852 1592 3776, 0888 976 7549
		<br>E-Mail: arnocreative@ymail.com
		</div>
		<div style="position:absolute;font-size:14px;left:610px;top:130px;">Bank : BCA, Cabang Duri Kosambi<br>No. Rekening : 593-046-7571<br>Atas Nama : Yuli Witriana</div>
	<div style="text-align:center;font-size:14px;padding-bottom:5px;">
	<span style="font-size:18px;text-decoration:underline;font-weight:bold;">&nbsp;&nbsp; KWITANSI &nbsp;&nbsp;</span>
	<br>
	<span>OFFICIAL RECEIPT</span>
	</div>
	<table border="0">
	<tr>
	<td width="300"><i>No.</i></td>
	<td>:</td>
	<td>001/AR/JKT/07/07</td>
	</tr>
	<tr>
	<td width="300"><i>Sudah terima dari <br> Received From</i></td>
	<td>:</td>
	<td style="border:2px solid #000;width:530px;padding:3px;">PAK ANTON</td>
	</tr>
	<tr>
	<td width="300"><i>Banyaknya Uang <br> The Amount of</i></td>
	<td>:</td>
	<td style="width:530px;padding:3px;background-image:url('http://localhost:2020/application/views/images/grid.jpg');"><i><?php terbilang();?></i></td>
	</tr>
	<tr>
	<td width="300"><i>Untuk pembayaran<br>In Payment of</i></td>
	<td>:</td>
	<td>wew</td>
	</tr>
	</table>
	<br>
	<br>
	<br>
	<div style="float:left;font-weight:bold;width:310px;">
	<hr width="310px;" style="float:left;margin:5px 0 5px 0;">
	<div style="clear:both;"></div>
	Rupiah / US $ &nbsp;<span style="padding:3px 25px;background-image:url('http://localhost:2020/application/views/images/grid.jpg');">10.000,00</span>
	<div style="clear:both;"></div>
	<hr width="310px;" style="float:left;margin:5px 0 5px 0;">
	<div style="clear:both;"></div>
	<hr width="310px;" style="float:left;margin:0;">
	<div style="clear:both;"></div>
	<span style="font-size:14px;font-weight:bold;">Pembayaran dengan Cheque / Giro dianggap Sah, apabila sudah diuangkan.<br>Payment is made by Cheque / Giro This Receipt Shall be valid after Clearing</span>
	</div>
	<div style="float:right;font-size:14px;text-align:center;">
	Jakarta, <span style="border-bottom: 1px dashed #000;">08-Jul-2014</span>
	<br>
	<br>
	<br>
	<br>
	<br>
	<span style="font-weight:bold;text-decoration:underline;text-align:center;">&nbsp;&nbsp;&nbsp; (NIAGA) &nbsp;&nbsp;&nbsp;</span>
	<div style="clear:both;"></div>
	</div>
	<div style="clear:both;"></div>
</div>
</body>
</html>
