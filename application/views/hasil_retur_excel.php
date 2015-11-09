<?php
$filename ="excelreport-".date('d-m-Y').".xls";
header('Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename='.$filename);
header("Cache-Control: max-age=0");
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
  <td><b>Kode Publisher</b></td>
  <td><b>Publisher</b></td>
  <td><b>Kode Buku</b></td>
  <td><b>Judul Buku</b></td>
   <td><b>Harga</b></td>
   <td><b>Qty</b></td>
   <td><b>Total Harga</b></td>
   <td><b>Disc</b></td>
   <td><b>Harga Setelah Disc</b></td>
  </tr>	
<?php
foreach($hasil_penjualan as $k=> $v){
	// echo "<pre>";
	 // print_r($hasil_penjualan);
	 // echo "</pre>";
?>
  <tr>
  <td><?php echo $v -> tnospo; ?></td>
  <td><?php echo $v -> ttanggal; ?></td>
  <td><?php echo $v -> pcode; ?></td>
  <td><?php echo $v -> pname; ?></td>
  <td><?php echo $v -> bcode; ?></td>
  <td><?php echo $v -> btitle; ?></td>
   <td><?php echo $v -> tharga; ?></td>
   <td><?php echo $v -> tqty; ?></td>
   <td><?php echo $v -> ttharga; ?></td>
   <td><?php echo $v -> tdisc; ?></td>
   <td><?php echo $v -> ttotal; ?></td>
  </tr>	
<?php  
}
?>
</table>
