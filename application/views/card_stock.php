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
<input type="hidden" name="id" value="<?php echo $id; ?>">
                                    <div class="box-body">
									<h2>PT. NIAGA SWADAYA</h2>
									<table border="0">
									<tr><td><b>Kartu Stok</b></td><td></td></tr>
									<tr><td>Tanggal Cetak</td><td>: <?php echo date('d  M  Y');?></td></tr>
									<tr><td>Buku</td><td>: <?php echo $book[0]->btitle; ?></td></tr>
									<tr><td>Kode Buku</td><td>: <?php echo $book[0]->bcode; ?></td></tr>
									<tr><td>Stok Awal</td><td>: <?php echo $stock[0] -> istockbegining; ?></td></tr>
									</table>
									<br />
                                        <div class="form-group">
										
										
						<table width="100%" border="0" style="border-collapse: collapse;">
						<tr style="border:1px solid #000;padding:3px;">
						<th style="border:1px solid #000;padding:3px;">Date</th>
						<th style="border:1px solid #000;padding:3px;">Trans No.</th>
						<th style="border:1px solid #000;padding:3px;">Customer</th>
						<th style="border:1px solid #000;padding:3px;">Stock In</th>
						<th style="border:1px solid #000;padding:3px;">Stock Out</th>
						<th style="border:1px solid #000;padding:3px;">Stock Process</th>
						<th style="border:1px solid #000;padding:3px;">Stock Left</th></tr>
						<?php
						$tgl = '';
						$sisa = 0;
						$wew = 0;
						$totalkeluar = 0;
						$proccess = 0;
						$tmasuk = 0;
						$tkeluar = 0;
						$sbegining = (int) $stock[0] -> istockbegining;
						$i = 1;
						foreach($detail as $k ) :
							if (preg_match('/RB(\d+)/i', $k -> tnofaktur)) $k -> ttypetrans = 19;
							
							if ($i == 1) $sisa = $sbegining;
							
							if ($k -> approved == 1) {
								$masuk = ($k -> ttypetrans == 4 || $k -> ttypetrans == 12 || $k -> ttypetrans == 16 || $k -> ttypetrans == 14 ? $k -> tqty : 0);
								$keluar = ($k -> ttypetrans == 1 || $k -> ttypetrans == 2 || $k -> ttypetrans == 17 || $k -> ttypetrans == 18 || $k -> ttypetrans == 13 || $k -> ttypetrans == 15 || $k -> ttypetrans == 19 ? $k -> tqty : 0);

								if ($k -> oadjustplus > 0) $masuk += $k -> oadjustplus;
								else $keluar += $k -> oadjustmin;
								$proccess = 0;
							}
							else {
								$masuk = 0;
								$keluar = 0;
								$proccess = $k -> tqty;
								$tproccess += $k -> tqty;
							}
							
							$sisa += (floatval('-'.$keluar) + $masuk);
							if ($k -> ttypetrans == 4 && !preg_match('/RB(.*)/i', $k -> tnospo))
								$sisa += $proccess;
							else
								$sisa -= $proccess;
						?>
						<tr style="border:1px solid #000;">
						<td style="border:1px solid #000;padding:3px;"><?php
$date = __get_date(strtotime($k -> ttanggal),1);
if($tgl <> $date){
	$tgl = $date;
	echo $tgl;
}
?></td>
						<td style="border:1px solid #000;padding:3px;"><?php echo ($k->tnofaktur ? $k->tnofaktur : $k -> tnospo) . ' - ' . $k -> ttypetrans; ?></td>
						<td style="border:1px solid #000;padding:3px;"><?php echo $k->cname; ?></td>
						<td style="border:1px solid #000;text-align:center;padding:3px;"><?php echo ($masuk ? $masuk : '-');?></td>
						<td style="border:1px solid #000;text-align:center;padding:3px;"><?php echo ($keluar ? $keluar : '-');?></td>
						<td style="border:1px solid #000;text-align:center;padding:3px;"><?php echo ($proccess ? $proccess : '-');?></td>
						<td style="border:1px solid #000;text-align:center;padding:3px;"><?php echo $sisa;?></td>
						</tr>
						<?php
						$tmasuk += $masuk;
						$tkeluar += $keluar;
						++$i;
						endforeach;
						?>
						<tr style="border:1px solid #000;">
							<th colspan="3" style="border:1px solid #000;padding:3px;">Total</th>
							<th style="border:1px solid #000;padding:3px;"><?php echo $tmasuk; ?></th>
							<th style="border:1px solid #000;padding:3px;"><?php echo $tkeluar; ?></th>
							<th style="border:1px solid #000;padding:3px;"><?php echo $tproccess; ?></th>
							<th style="border:1px solid #000;padding:3px;"><?php echo $sisa; ?></th>
						</tr>
						</table>
				
			




					
                                        </div>
                            </div>
                        </div>
                    </div>

                </section><!-- /.content -->
            </aside><!-- /.right-side -->


</body>
</html>
