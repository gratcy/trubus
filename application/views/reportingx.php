<?php
$branch = $this -> memcachedlib -> sesresult['ubranchid'];

//~ $filename ="excelreport-".date('d-m-Y').".xls";
//~ header('Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
//~ header('Content-Disposition: attachment; filename='.$filename);
//~ header("Cache-Control: max-age=0");
$arrtype = array($pt['typea'],$pt['typeb'],$pt['typec'],$pt['typed'],$pt['typee'],$pt['typef'],$pt['typeg'],$pt['typei']);
?>
<html>
<body>
<table border="0">
<?php if ($pt['datesort']) : ?>
<tr><td>Tanggal</td><td>: <?php echo $pt['datesort']; ?></td></tr>
<?php endif; ?>
<?php if ($pt['customer'] && $pt['customerr']) : ?>
<tr><td>Customer</td><td>: <?php echo __get_reporting_name_option($pt['customer'],1) . ' s/d ' . __get_reporting_name_option($pt['customerr'],1); ?></td></tr>
<?php endif; ?>
<?php if ($pt['area'] && $pt['areax']) : ?>
<tr><td>Area</td><td>: <?php echo __get_reporting_name_option($pt['area'],2) . ' s/d ' . __get_reporting_name_option($pt['areax'],2); ?></td></tr>
<?php endif; ?>
<?php if ($pt['publisher'] && $pt['publisherx']) : ?>
<tr><td>Publisher</td><td>: <?php echo __get_reporting_name_option($pt['publisher'],3) . ' s/d ' . __get_reporting_name_option($pt['publisherx'],3); ?></td></tr>
<?php endif; ?>
<?php if ($pt['kode_buku'] && $pt['kode_bukux']) : ?>
<tr><td>Buku</td><td>: <?php echo __get_reporting_name_option($pt['kode_buku'],4) . ' s/d ' . __get_reporting_name_option($pt['kode_bukux'],4); ?></td></tr>
<?php endif; ?>
<tr><td>Transaksi</td><td>: <?php echo __get_reporting_transaction_type($arrtype); ?></td></tr>
<?php if ($pt['rtype']) : ?>
<tr><td>Laporan</td><td>: <?php echo __get_reporting_type($pt['rtype'],1); ?></td></tr>
<?php endif; ?>
</table>
<br />
<?php if ($pt['rtype'] == 0) { ?>
                            <table border="0">
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
							
							<?php } else if ($pt['rtype'] == 1) { ?>
                            <table border="0">
							<tr>
							<td>Kode Area</td>
							<td>Nama</td>
							<td>Bruto</td>
							<td>Discount</td>
							<td>Netto</td>
							<td>Qty</td>
							</tr>
						<?php
						foreach ($data as $k => $v) :
						?>
							<tr>
							<td><?php echo $v -> acode; ?></td>
							<td><?php echo $v -> aname; ?></td>
							<td><?php echo $v -> bruto; ?></td>
							<td><?php echo ($v -> bruto - $v -> netto); ?></td>
							<td><?php echo $v -> netto; ?></td>
							<td><?php echo $v -> totalqty; ?></td>
							</tr>
						<?php endforeach; ?>	
							</table>
							<?php } else if ($pt['rtype'] == 2) { ?>
                            <table border="0">
							<tr>
							<td>Kode Buku</td>
							<td>Judul</td>
							<td>Harga Satuan</td>
							<td>Bruto</td>
							<td>Discount</td>
							<td>Netto</td>
							<td>Qty</td>
							</tr>
						<?php
						foreach ($data as $k => $v) :
						?>
							<tr>
							<tr>
							<td><?php echo $v -> bcode; ?></td>
							<td><?php echo $v -> btitle; ?></td>
							<td><?php echo $v -> tharga; ?></td>
							<td><?php echo $v -> bruto; ?></td>
							<td><?php echo ($v -> bruto - $v -> netto); ?></td>
							<td><?php echo $v -> netto; ?></td>
							<td><?php echo $v -> totalqty; ?></td>
							</tr>
							</tr>
						<?php endforeach; ?>	
							</table>
							<?php } ?>
</body>
</html>
