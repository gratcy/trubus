<?php
$filename ="excelreport.xls";
header('Content-type:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
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
 <table class="table table-bordered">
                                    <thead>
                                        <tr>
		  <th>No Invoice</th>	
		  <th>Area</th>	
<th>Customer</th>			  
          <th>Tanggal Invoice</th>
          <th>Tanggal Jatuh Tempo</th>
          
		  <th>Total Tagihan</th>
		  <th>Sudah dibayar</th>
		  <th>Belum dibayar</th>
          <th>Info</th>
		  <th>Status</th>
          <th style="width: 80px;"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
		  <?php
		  
		  foreach($pembayaran as $k => $v) :
		  //$phone = explode('*', $v -> tnofaktur);
		  $appr= $v -> approval;
		  ?>
          <tr>
		  <td><?php echo $v -> invno; ?></td>								
          <td><?php echo $v -> aname; ?></td>
		  <td><?php echo $v -> cname; ?></td>
          <td><?php echo $v -> invdate; ?></td>
          <td><?php echo $v -> invduedate; ?></td>
		  <td style="text-align:right;"><?php echo __get_rupiah($v -> invtotalall,1); ?></td>
          <td style="text-align:right;"><?php echo __get_rupiah($v -> totalbayar,1); ?></td>
		  <td style="text-align:right;"><?php echo __get_rupiah($v -> totalhutang,1); ?></td>
          <td><?php echo $v -> desc; ?></td>
		  
<td><?php 
		  if($v -> invstatus=='1'){
			echo Pending;
		  }elseif($v -> invstatus=='3'){
			echo "Done";
		  }
			?></td>		  
		  
		  
		  <td>
	<?php if ($v -> tstatus <> 2) { ?>
	              <a href="javascript:void(0);" onclick="print_data('<?php echo site_url('pembayaran/pembayaran_faktur/' . $v -> invid); ?>', 'Print Penawaran');"><i class="fa fa-print"></i></a>
				    <?php if ($appr<2){?> 
              <a href="<?php echo site_url('pembayaran/home/bayar_add/' . $v -> invid); ?>"><i class="fa fa-pencil"></i></a>
			  <a href="<?php echo site_url('pembayaran/home/bayar_list/' . $v -> invid); ?>"><i class="fa fa-book"></i></a>
              <a href="<?php echo site_url('pembayaran/pembayaran_delete/' . $v -> invid); ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-times"></i></a>
	<?php }} ?>
		</td>
										</tr>
        <?php endforeach; ?>
                                    </tbody>
                                    </table>