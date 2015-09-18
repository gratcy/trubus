<?php
$branch = $this -> memcachedlib -> sesresult['ubranchid'];

//~ $filename ="excelreport-".date('d-m-Y').".xls";
//~ header('Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
//~ header('Content-Disposition: attachment; filename='.$filename);
//~ header("Cache-Control: max-age=0");
$arrtype = array($pt['typea'],$pt['typeb'],$pt['typec'],$pt['typed'],$pt['typee'],$pt['typef'],$pt['typeg'],$pt['typei'],$pt['typej'],$pt['typek']);
?>
<html>
	<title>Reporting Transaction</title>
<body>
									<h2>PT. NIAGA SWADAYA</h2>
		<h3>Laporan Transaksi</h3>
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
<tr><td>Laporan</td><td>: <?php echo __get_reporting_type($pt['rtype'],1); ?></td></tr>
</table>
<br />
<?php if ($pt['rtype'] == 0) { ?>
                            <table border="0" style="border-collapse: collapse;">
								<thead>
							<tr>
							<th style="border:1px solid #000;padding:3px;">No Faktur</th>
							<th style="border:1px solid #000;padding:3px;">Tanggal Faktur</th>
							<th style="border:1px solid #000;padding:3px;">Publisher</th>
			<?php if($pt['typei']!='RB'){ ?>				
							
							<th style="border:1px solid #000;padding:3px;">Kode Cust</th>
							<th style="border:1px solid #000;padding:3px;">Customer</th>
							<th style="border:1px solid #000;padding:3px;">Area</th>
			<?php }?>			
							<th style="border:1px solid #000;padding:3px;">Kode Buku</th>
							<th style="border:1px solid #000;padding:3px;">Nama Buku</th>
							<th style="border:1px solid #000;padding:3px;">Harga Satuan</th>
							<th style="border:1px solid #000;padding:3px;width:50px">Qty</th>
							<th style="border:1px solid #000;padding:3px;width:150px">Harga</th>
							<th style="border:1px solid #000;padding:3px;width:150px">Disc</th>
							<th style="border:1px solid #000;padding:3px;width:150px">Total</th>

							</tr>
							</thead>
							<tbody>
						<?php
					$tqt=0;	
					$totalharga=0;
					$totdisc=0;
					$tthargax=0;
						foreach ($data as $k=>$v){
							//print_r($data);
						?>
							<tr>
						<?php if($pt['typei']=='RB'){	?>
						<td><?php echo $data[$k]->tnospo; ?></td>
						<?php }else{?>
							<td><?php echo $data[$k]->tnofaktur; ?></td>
						<?php } ?>	
							<td><?php echo date('d-m-Y',strtotime($data[$k]->ttanggal)); ?></td>
							<td><?php echo $data[$k]->pname; ?></td>
						<?php if($pt['typei']!='RB'){	?>
							<td><?php echo $data[$k]->ccode; ?></td>
							<td><?php echo $data[$k]->cname; ?></td>
							<td><?php echo $data[$k]->narea; ?></td>
						<?php }?>
							<td><?php echo $data[$k]->bcode; ?></td>
							<td><?php echo $data[$k]->btitle; ?></td>
							<td><?php echo $data[$k]->bprice; ?></td>
							<td><?php echo $data[$k]->tqty; ?></td>	
							<td><?php echo $data[$k]->ttharga; ?></td>	
							<td><?php echo $data[$k]->tdisc; ?> %</td>
							<td><?php echo $data[$k]->ttotal; ?></td>	

							</tr>
							</tbody>
						<?php 	
						    $tqt=$tqt+$data[$k]->tqty;
							$tthargax=$tthargax+ $data[$k]->ttharga ;
							$totalharga=$totalharga+ $data[$k]->ttotal ;
						}	
						$totdisc=$tthargax-$totalharga;
						?>	
							
								<tr>
							<td style="font-weight:bold;">TOTAL</td>
							<td></td>
							<td></td>
			<?php if($pt['typei']!='RB'){ ?>				
							<td></td>
							<td></td>						
							<td></td>
			<?php } ?>		
							<td></td>						
							<td></td>			
							<td></td>
							<td style="font-weight:bold;width:50px"><?php echo $tqt; ?></td>	
							<td style="font-weight:bold;width:150px"><?php echo $tthargax; ?></td>	
							<td style="font-weight:bold;width:150px"><?php echo $totdisc; ?> </td>
							<td style="font-weight:bold;width:150px"><?php echo $totalharga; ?></td>	

							</tr>						
							
							</table>
							
							<?php } else if ($pt['rtype'] == 1) { ?>
                            <table border="0" style="border-collapse: collapse;">
							<thead>
							<tr>
							<th style="border:1px solid #000;padding:3px;">Kode</th>
							<th style="border:1px solid #000;padding:3px;">Nama</th>
							<th style="border:1px solid #000;padding:3px;">Bruto</th>
							<th style="border:1px solid #000;padding:3px;">Discount</th>
							<th style="border:1px solid #000;padding:3px;">Netto</th>
							<th style="border:1px solid #000;padding:3px;">Qty</th>
							</tr>
							</thead>
							<tbody>
						<?php
						foreach ($data as $k => $v) :
						?>
							<tr>
							<td><?php echo $v -> acode.__get_publisher_imprint($v -> pid,1); ?></td>
							<td><?php echo $v -> aname; ?></td>
							<td><?php echo $v -> bruto; ?></td>
							<td><?php echo ($v -> bruto - $v -> netto); ?></td>
							<td><?php echo $v -> netto; ?></td>
							<td><?php echo $v -> totalqty; ?></td>
							</tr>
						<?php endforeach; ?>	
						</tbody>
							</table>
							<?php } else if ($pt['rtype'] == 2) { ?>
                            <table border="0" style="border-collapse: collapse;">
							<thead>
							<tr>
							<th style="border:1px solid #000;padding:3px;">Kode Buku</th>
							<th style="border:1px solid #000;padding:3px;">Judul</th>
							<th style="border:1px solid #000;padding:3px;">Harga Satuan</th>
							<th style="border:1px solid #000;padding:3px;">Bruto</th>
							<th style="border:1px solid #000;padding:3px;">Discount</th>
							<th style="border:1px solid #000;padding:3px;">Netto</th>
							<th style="border:1px solid #000;padding:3px;">Qty</th>
							</tr>
							</thead>
							<tbody>
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
							</tbody>
							</table>
							<?php } ?>
</body>
</html>
