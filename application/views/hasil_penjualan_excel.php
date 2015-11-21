<?php
ini_set('memory_limit', '-1');
$filename ="excelreport.xls";
// header('Content-type:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
// header('Content-Disposition: attachment; filename='.$filename);
// header("Cache-Control: max-age=0");

    header("Pragma: public");
    header("Expires: 0");
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header("Content-Type: application/force-download");
    header("Content-Type: application/octet-stream");
    header("Content-Type: application/download");
	header('Content-Disposition: attachment; filename='.$filename);
?>
    <style>
        table {
			width:600px;
            border-collapse: collapse;
        }
        th {
			text-align:left;
            background-color: #cccccc;
        }
        th, td {
            border: 1px solid #000;
        }
    </style>
<table>
  <tr>
  <td><b>No Faktur</b></td>
  <td><b>Tanggal</b></td>
  <td><b>Kode Pelanggan</b></td>
  <td><b>Pelanggan</b></td>
  <td><b>Kode Buku</b></td>
  <td><b>Judul Buku</b></td>
   <td><b>Harga</b></td>
   <td><b>Qty</b></td>
   <td><b>Total Harga</b></td>
   <td><b>Disc</b></td>
   <td><b>Harga Setelah Disc</b></td>
   <td><b>Description</b></td>
  </tr>	
<?php
foreach($hasil_penjualan as $k=> $v){
?>
  <tr>
  <td><?php echo $v -> tnofaktur; ?></td>
  <td><?php echo $v -> ttanggal; ?></td>
  <td><?php echo $v -> ccode; ?></td>
  <td><?php echo $v -> cname; ?></td>
  <td><?php echo $v -> bcode; ?></td>
  <td><?php echo $v -> btitle; ?></td>
   <td><?php echo $v -> tharga; ?></td>
   <td><?php echo $v -> tqty; ?></td>
   <td><?php echo $v -> ttharga; ?></td>
   <td><?php echo $v -> tdisc; ?></td>
   <td><?php echo $v -> ttotal; ?></td>
   <td><?php echo $v -> tinfo; ?></td>
  </tr>	
<?php  
}
?>
</table>
