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
			  
          <th>Tanggal Invoice</th>
          <th>Type Bayar</th>
          
		  <th>Grand Total</th>
          <th>Info</th>
		  <th>Status</th>
          <th style="width: 80px;"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
<?php 
//print_r($bayarz);
foreach ($bayarz as $k=>$v){ 

if($v->pbstatus==1){
	$pbst="pending";
}elseif($v->pbstatus==3){
	$pbst="Done";
}	
?>




          <tr>
		  								
          <td><?=$invoice[0]->invno;?></td>
<td><?=$v->aname;?></td>		  
          <td><?=$v->pbdate;?></td>
		  <td><?=$v->pbtype;?></td>
          <td><?=$v->pbsetor;?></td>
		  
          
		  <td style="text-align:right;"><?=$pbst;?></td>
          <td><a href="<?php echo site_url('pembayaran/home/bayar_approve/' . $v ->invid.'/'.$v ->pbid); ?>"><i class="fa fa-pencil"></i></a></td>
		  
		  
	
										</tr>
<?php } ?>
                                    </tbody>
                                    </table>
									


<?php 

echo 'terima: '.$terima[0]->terima.'<br>';
echo 'pending: '.$pending[0]->setor.'<br>';

?>
			