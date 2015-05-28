
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
<title>Print Faktur</title>
</head>
<body style="font-size:18px;" onload="window.print();">

<div style="width:850px;padding:0px 5px 5px 10px;">
		<span style="font-size:20px;font-weight:bold;">NIAGA SWADAYA</span>
		<div style="position:absolute;left:400px;top:24px;">
		<div style="border-bottom: 1px dashed #000;width:200px;font-weight:bold;font-size:25px;text-align:center;">INVOICE</div>
		<div style="border-bottom: 1px dashed #000;width:200px;padding-top:3px;"></div>
		</div>
		<div style="clear:both;"></div>
	<div style="float:left;">
	<div style="padding:5px 5px 5px 0;">
		Penjualan Buku
		<br>Buku Umum , pelajaran , agama dll
		<br>Jl. Gunung Sahari II, Jakarta Pusat
		<table border="0">
		<tr><td>No. Telp</td><td>: 0852 1592 3776, 0888 976 7549</td></tr>
		<tr><td>Email</td><td>: arnocreative@ymail.com</td></tr>
		</table>
		</div>
		</div>
		<div style="float:right;width:200px;">
		<div style="font-size:16px;font-weight:bold;">
			KEPADA YTH: <br> PAK SALES		</div>
		</div>
	<div style="clear:both;"></div>
	<div style="float:left;width:320px;">NO : 001</div>
	<div style="float:left;">Tanggal : <?php echo $detail[0] -> ttanggal; ?></div>
	<div style="float:right;">No PO : <?php echo $detail[0] -> tnofaktur; ?></div>
	<br>

	
	
	<div class="box-body">
                                    <table border="1" style="width:850px;border-collapse: collapse;font-size:18px;">
                                    <thead>
                                        <tr>
		  <th>No</th>	
		  <th>Kode Buku</th>							
          <th>Buku</th>
          <th>Qty</th>
          <th>Harga</th>
		  <th>Total Harga</th>
          <th style="width: 10px;" >Discount</th>          
          
          
          <th >Grand Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
		  <?php
		  foreach($penjualan_kredit_detail as $k => $v) :
		  //$phone = explode('*', $v -> tnofaktur);
		  ?>
          <tr>
		  <td><?php echo $v -> tid; ?></td>								
          <td><?php echo $v -> bcode; ?></td>
          <td><?php echo $v -> btitle; ?></td>
          <td><?php echo $v -> tqty; ?></td>
          <td><?php echo $v -> tharga; ?></td>
		  <td><?php echo $v -> tharga*$v -> tqty; ?></td>
          <td><?php echo $v -> tdisc; ?>%</td>
          

		  <td><?php echo $v -> ttotal; ?></td>
										</tr>
        <?php endforeach; ?>
		
		
		
		<tr>
		  <td colspan=3 >Total</td>						
         <td><?php echo $detail[0] -> ttotalqty; ?></td>
          <td></td>
          <td><?php echo $v -> ttotalharga; ?></td>
          <td></td>
		   <!--td><?php //echo $detail[0] -> ttotaldisc; ?>%</td-->
		  <td>
		  <?php echo $v -> tgrandtotal; ?></td></tr>			
		</tbody>
        </table>
                                <!-- /.box-body -->		

	
	
	<table border="0" style="width:850px;border-collapse: collapse;font-size:18px;">
	<tr>
	<td colspan="3" width="300px" style="text-align:left">Terbilang : <?php echo terbilang($v -> tgrandtotal); ?> Rupiah</td>
	<td style="border:1px solid #000;">Jumlah </td>
	<td style="border:1px solid #000;padding-right:3px;text-align:right;">Rp. <?php echo $v -> tgrandtotal; ?></td>
	</tr>
	<tr>
	<td></td>
	<td></td>
	<td></td>
	<td style="border:1px solid #000;">Uang Muka </td>
	<td style="border:1px solid #000;padding-right:3px;text-align:right;">Rp. 0,00</td>
	</tr>
	<tr>
	<td></td>
	<td></td>
	<td></td>
	<td style="border:1px solid #000;">Sisa </td>
	<td style="border:1px solid #000;padding-right:3px;text-align:right;">Rp.  <?php echo $v -> tgrandtotal; ?></td>
	</tr>
	</table>
	</div>
	
	<div style="float:left;text-align:center;">Tanda Terima,<br /><br /><br /><br />( .......................... )</div>
	<div style="float:right;text-align:center;">Hormat Kami, Ttd,<br /><br /><br /><br />( NIAGA )</div>
	<div style="clear:both;"></div>
	Catatan: Barang yang sudah dibeli tidak bisa ditukar/dikembalikan.<br>
	Pembayaran dapat ditransfer ke rekening : <br>
	Bank : BCA, Cabang Duri Kosambi<br>No. Rekening : 593-046-7571<br>Atas Nama : NIAGA
	</div>
</body>
</html>








