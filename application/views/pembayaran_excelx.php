<?php
// $filename ="excelreport.xls";

// header('Content-type: application/ms-excel');
// header('Content-Disposition: attachment; filename='.$filename);
?>
<table border=1>
  <tr>
  <td><?php //echo No faktur; ?></td>

  <td>Kode Buku</td>
  <td>Judul Buku</td>
   <td>Harga</td>
   <td>Qty</td>
   <td>Total Harga</td>
   <td>Disc</td>
   <td>Harga Setelah Disc</td>
  <td>Tanggal</td>
  </tr>	
<?php
foreach($pembayaran as $k=> $v){
	//print_r($pembayaran);
?>
  <tr>
  <td><?php echo $v -> tnofaktur; ?></td>

  <td><?php echo $v -> bcode; ?></td>
  <td><?php echo $v -> btitle; ?></td>
   <td><?php echo $v -> tharga; ?></td>
   <td><?php echo $v -> tqty; ?></td>
   <td><?php echo $v -> ttharga; ?></td>
   <td><?php echo $v -> tdisc; ?></td>
   <td><?php echo $v -> ttotal; ?></td>
  <td><?php echo $v -> ttanggal; ?></td>
  </tr>	
<?php  
}
?>
</table>