<?php
$filename ="excelreport-".time().".xls";

header('Content-type: application/ms-excel');
header('Content-Disposition: attachment; filename='.$filename);
?>
<table border="0" style="border-collapse: collapse;">
  <tr style="border:1px solid #000;">
  <td style="border:1px solid #000;">Tanggal</td>
  <td style="border:1px solid #000;">No faktur</td>

  <td style="border:1px solid #000;">Kode Customer</td>
  <td style="border:1px solid #000;">Nama Customer</td>
  <td style="border:1px solid #000;">Kode Buku</td>
  <td style="border:1px solid #000;">Judul Buku</td>
   <td style="border:1px solid #000;">Harga</td>
   <td style="border:1px solid #000;">Qty</td>
   <td style="border:1px solid #000;">Total Harga</td>
   <td style="border:1px solid #000;">Disc</td>
   <td style="border:1px solid #000;">Harga Setelah Disc</td>
  </tr>	
<?php
foreach($hasil_penjualan as $k=> $v){
?>
  <tr>
  <td><?php echo __get_date(strtotime($v -> ttanggal),1); ?></td>
  <td><?php echo $v -> tnofaktur; ?></td>

  <td><?php echo $v -> ccode; ?></td>
  <td><?php echo $v -> cname; ?></td>
  <td><?php echo $v -> bcode; ?></td>
  <td><?php echo $v -> btitle; ?></td>
   <td><?php echo __get_rupiah($v -> tharga,3); ?></td>
   <td><?php echo $v -> tqty; ?></td>
   <td><?php echo __get_rupiah($v -> ttharga,3); ?></td>
   <td><?php echo $v -> tdisc; ?></td>
   <td><?php echo __get_rupiah($v -> ttotal,3); ?></td>
  </tr>	
<?php  
}
?>
</table>
