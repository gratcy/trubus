<?php 
 $branch=$this -> memcachedlib -> sesresult['ubranchid'];  
?>
	<!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
<?php

$filename ="excelreport-".date('d-m-Y').".xls";

header('Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename='.$filename);
header("Cache-Control: max-age=0");

?>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">

<div class="box box-primary">




                                <!-- form start -->
                            <table>
							<tr>
							<td>No Faktur</td>
							<td>Tanggal Faktur</td>
							<td>Publisher</td>
							<td>Kode Cust</td>
							<td>Customer</td>
							<td>Area</td>
							<td>Kode Buku</td>
							<td>Nama Buku</td>
							<td>Harga Satuan</td>
							<td>Qty</td>
							<td>Harga</td>
							<td>Disc</td>
							<td>Total</td>

							</tr>
						<?php
					//print_r($data);die;
					$totalharga=0;
					$totdisc=0;
					$tthargax=0;
						foreach ($data as $k=>$v){
							
						?>
							<tr>
							<td><?php echo $data[$k]->tnofaktur; ?></td>
							<td><?php echo date('d-m-Y',strtotime($data[$k]->ttanggal)); ?></td>
							<td><?php echo $data[$k]->pname; ?></td>
							<td><?php echo $data[$k]->ccode; ?></td>
							<td><?php echo $data[$k]->cname; ?></td>
							<td><?php echo $data[$k]->narea; ?></td>
							<td><?php echo $data[$k]->bcode; ?></td>
							<td><?php echo $data[$k]->btitle; ?></td>
							<td><?php echo $data[$k]->bprice; ?></td>
							<td><?php echo $data[$k]->tqty; ?></td>	
							<td><?php echo $data[$k]->ttharga; ?></td>	
							<td><?php echo $data[$k]->tdisc; ?> %</td>
							<td><?php echo $data[$k]->ttotal; ?></td>	

							</tr>
						<?php 	
							$tthargax=$tthargax+ $data[$k]->ttharga ;
							$totalharga=$totalharga+ $data[$k]->ttotal ;
						}	
						$totdisc=$tthargax-$totalharga;
						?>	
							
								<tr>
							<td>TOTAL</td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>						
							<td></td>
							<td></td>
							<td></td>	
							<td><?php echo $tthargax; ?></td>	
							<td><?php echo $totdisc; ?> </td>
							<td><?php echo $totalharga; ?></td>	

							</tr>						
							
							</table>
							<br>
							
							
							</div>
                        </div>
                    </div>

                </section><!-- /.content -->
            </aside><!-- /.right-side -->

<script type="text/javascript">
function rprint_data(url, title) {
	var left = (screen.width/2)-(860/2);
	var top = (screen.height/2)-(400/2);
	var win = window.open(url, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, copyhistory=no, width=860, height=400, top='+top+', left='+left);
	win.focus();
}
<?php if ($done) { ?>
rprint_data('<?php echo site_url('reportcardstock/print_card_stock'); ?>', 'Cetak Kartu Stok');
$('select#ttype').val(<?php echo json_encode($_POST['type']);?>);
$('select#tpublisher').val(<?php echo json_encode($_POST['publisher']);?>);
$('select#tcustomer').val(<?php echo json_encode($_POST['customer']);?>);
$('select').trigger("chosen:updated");
<?php } ?>
$('select[name="branch"]').val(<?php echo $this -> memcachedlib -> sesresult['ubranchid']; ?>);
$('#pbranch').css('display','none');
$(function(){
$('#datesort').daterangepicker();
});

$(function(){
$('#datesortx').daterangepicker();
});
</script>
