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
									<h4>PT NIAGA SWADAYA</h4>
									<table border="0">
									<tr><td>Kartu Stok</td><td></td></tr>
									<tr><td>Tanggal Cetak</td><td>: <?php echo date('d  M  Y');?></td></tr>
									<tr><td>Buku</td><td>: <?php echo $book[0]->btitle; ?></td></tr>
									<tr><td>Stok Awal</td><td>: <?php //echo $detail[0] -> istockbegining; ?></td></tr>
									</table>
                                        <div class="form-group">
										
										
						<table width="100%" border="0" style="border-collapse: collapse;">
						<tr style="border:1px solid #000;"><th style="border:1px solid #000;">Tanggal</th><th style="border:1px solid #000;">Gudang</th><th style="border:1px solid #000;">Stok Masuk</th><th style="border:1px solid #000;">Stok Keluar</th><th style="border:1px solid #000;">Sisa</th></tr>
						<tr style="border:1px solid #000;"><td style="border:1px solid #000;"></td><td style="border:1px solid #000;"><?php //echo $branch; ?></td><td style="border:1px solid #000;"><?php //echo $detail[0] -> istockin; ?></td><td style="border:1px solid #000;"></td><td style="border:1px solid #000;"></td></tr>
						<?php
						$totalkeluar = 0;
						//print_r($detail);
						foreach($detail as $k ) :
						
						?>
						<tr style="border:1px solid #000;">
						<td style="border:1px solid #000;"><?php echo $k -> ttanggal; ?></td>
						<td style="border:1px solid #000;"><?php echo $k->tnofaktur; ?></td><td style="border:1px solid #000;"></td> <td style="border:1px solid #000;"> <?php echo $k -> tbid; ?></td><td style="border:1px solid #000;"></td></tr>


						<?php 
						//$totalkeluar = $k -> istockin + $totalkeluar;
						endforeach; ?>					
						
						<tr style="border:1px solid #000;"><th colspan="2" style="border:1px solid #000;">Total</th><th style="border:1px solid #000;"><?php //echo $detail[0] -> istockin; ?></th><th style="border:1px solid #000;"></th><th style="border:1px solid #000;">
						<?php 
						//$stocktotal=($detail[0] -> istock ) + ($detail[0] -> istockbegining)-$totalkeluar;
						//echo $stocktotal; ?></th></tr>
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
