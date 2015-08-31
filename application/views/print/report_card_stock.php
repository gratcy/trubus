<html>
<title>Stock Card</title>
<body>
	<?php if ($books) { ?>
                                <?php foreach($books as $k => $v) :
                                $stockawal = __get_stock_begining($v -> bid, $branch);
                                ?>
									<aside class="right-side">                
										<section class="content">
											<div class="row">
												<div class="col-xs-12">
													<div class="box box-primary">
                                    <div class="box-body">
									<h2>PT. NIAGA SWADAYA</h2>
									<table border="0">
									<tr><td>Kartu Stok</td><td></td></tr>
									<tr><td>Tanggal Cetak</td><td>: <?php echo date('d  M  Y');?></td></tr>
									<tr><td>Buku</td><td>: <?php echo $v->bcode.' | ' .$v->btitle; ?></td></tr>
									<tr><td>Stok Awal</td><td>: <?php echo $stockawal; ?></td></tr>
									</table>
									<br />
                                        <div class="form-group">
										
										
						<table width="100%" border="0" style="border-collapse: collapse;">
						<tr style="border:1px solid #000;">
						<th style="border:1px solid #000;">Tanggal</th>
						<th style="border:1px solid #000;">No. Bukti</th>
						<th style="border:1px solid #000;">Kustomer</th>
						<th style="border:1px solid #000;">Stok Masuk</th>
						<th style="border:1px solid #000;">Stok Keluar</th>
						<th style="border:1px solid #000;">Sisa</th></tr>
						<?php
						$sisa = 0;
						$totalkeluar = 0;
						$tmasuk = 0;
						$wew = 0;
						$tkeluar = 0;
						$tgl = '';
						$trans = $this -> reportcardstock_model -> __get_inventory_list($ids3,$v -> bid);
						foreach($trans as $k ) :
							$masuk = ($k -> ttypetrans == 4 ? $k -> tqty : '-');
							$keluar = ($k -> ttypetrans == 1 || $k -> ttypetrans == 2 ? $k -> tqty : 0);
							if ($sisa > 0)
								$sisa = ($k -> ttypetrans == 4 ? $sisa + $masuk : $sisa - $keluar);
							else
								$sisa = ($k -> ttypetrans == 4 ? $stockawal + $masuk : $stockawal - $keluar);
						?>
						<tr style="border:1px solid #000;">
						<td style="border:1px solid #000;"><?php
$date = __get_date(strtotime($k -> ttanggal),1);
if($tgl <> $date){
	$tgl = $date;
	echo $tgl;
}
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
                            </div>
                        </div>
                    </div>
                </section>
            </aside>
            <p>&nbsp;</p>
                                <?php endforeach;?>
<?php } else { ?>
	<h1>Tidak ada data yang sesuai !!!</h1>
<?php } ?>
</body>
</html>
