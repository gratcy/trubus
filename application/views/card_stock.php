<html>
<title>Stock Card</title>
<body>
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
	<?php echo __get_error_msg(); ?>
<div class="box box-primary">

                                <!-- form start -->
                                 <form role="form" action="<?php echo site_url('inventory/inventory_update'); ?>" method="post">
<input type="hidden" name="id" value="<?php echo $id; ?>">
                                    <div class="box-body">
									<h2>PT. NIAGA SWADAYA</h2>
									<table border="0">
									<tr><td>Kartu Stok</td><td></td></tr>
									<tr><td>Tanggal Cetak</td><td>: <?php echo date('d  M  Y');?></td></tr>
									<tr><td>Buku</td><td>: <?php echo $book[0]->btitle; ?></td></tr>
									<tr><td>Stok Awal</td><td>: <?php echo $stock[0] -> istockbegining; ?></td></tr>
									</table>
									<br />
                                        <div class="form-group">
										
										
						<table width="100%" border="0" style="border-collapse: collapse;">
						<tr style="border:1px solid #000;">
						<th style="border:1px solid #000;">Tanggal</th>
						<th style="border:1px solid #000;">No. Bukti</th>
						<th style="border:1px solid #000;">Customer</th>
						<th style="border:1px solid #000;">Stok Masuk</th>
						<th style="border:1px solid #000;">Stok Keluar</th>
						<th style="border:1px solid #000;">Sisa</th></tr>
						<?php
						$tgl = '';
						$sisa = 0;
						$wew = 0;
						$totalkeluar = 0;
						$tmasuk = 0;
						$tkeluar = 0;
						foreach($detail as $k ) :
							$masuk = ($k -> ttypetrans == 4 ? $k -> tqty : 0);
							$keluar = ($k -> ttypetrans == 1 || $k -> ttypetrans == 2 ? $k -> tqty : 0);
							if ($sisa > 0)
								$sisa = ($k -> ttypetrans == 4 ? $sisa + $masuk : $sisa - $keluar);
							else
								$sisa = ($k -> ttypetrans == 4 ? $stock[0] -> istockbegining + $masuk : $stock[0] -> istockbegining - $keluar);
						?>
						<tr style="border:1px solid #000;">
						<td style="border:1px solid #000;"><?php
$date = __get_date(strtotime($k -> ttanggal),1);
if($tgl <> $date){
	$tgl = $date;
	echo $tgl;
}
if ($sisa < 0) {
	$wew += $sisa;
}
else {
	if ($sisa == 0) $wew = $wew;
	else $wew = $sisa;
}
?></td>
						<td style="border:1px solid #000;"><?php echo $k->tnofaktur; ?></td>
						<td style="border:1px solid #000;"><?php echo $k->cname; ?></td>
						<td style="border:1px solid #000;text-align:center;"><?php echo ($masuk ? $masuk : '-');?></td>
						<td style="border:1px solid #000;text-align:center;"><?php echo ($keluar ? $keluar : '-');?></td>
						<td style="border:1px solid #000;text-align:center;"><?php echo $wew;?></td>
						</tr>
						<?php
						$tmasuk += $masuk;
						$tkeluar += $keluar;
						endforeach;
						?>
						<tr style="border:1px solid #000;">
							<th colspan="2" style="border:1px solid #000;">Total</th>
							<th style="border:1px solid #000;"></th>
							<th style="border:1px solid #000;"><?php echo $tmasuk; ?></th>
							<th style="border:1px solid #000;"><?php echo $tkeluar; ?></th>
							<th style="border:1px solid #000;"><?php echo $wew; ?></th>
						</tr>
						</table>
				
			




					
                                        </div>
                                        
                                </form>
                            </div>
                        </div>
                    </div>

                </section><!-- /.content -->
            </aside><!-- /.right-side -->


</body>
</html>
