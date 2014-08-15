            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        CARD STOCK
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo site_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="<?php echo site_url('inventory'); ?>">Stock Book</a></li>
                        <li class="active">Stock Update</li>
                    </ol>
                </section>

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
									
                                        <div class="form-group">
                                            <label><h4>PT NIAGA SWADAYA</h4></label><br>
											<label>Kartu Stok</label><br><label>Tanggal Cetak : <?php echo date('d  M  Y');?></label><br>
                                            
                                        </div>									
									
									
                                        <div class="form-group">
                                            <label>Book   &nbsp;&nbsp;&nbsp;&nbsp;  : &nbsp;&nbsp; &nbsp;&nbsp;                                       
												<?php echo $books; ?> </label>  <br>                                          
                                        
                                            <label>Stok Awal</label>
                        <input type="text" readonly placeholder="Stock Begining" name="sbegin" class="form-control" value="<?php echo $detail[0] -> istockbegining; ?>" />
                                        </div>
                                        <div class="form-group">
										
										
						<table width=100% border=1>
						<tr><th>Tanggal</th><th>Gudang</th><th>Stok Masuk</th><th>Stok Keluar</th><th>Adj</th><th>Sisa</th></tr>
						<tr><td></td><td><?php echo $branch; ?></td><td><?php echo $detail[0] -> istockin; ?></td><td></td><td></td><td></td></tr>
						<?php
						foreach($detail_book as $k ) :
						
						?>
						<tr><td></td><td><?php echo $k->cname; ?></td><td></td> <td> <?php echo $k -> istockin; ?></td><td></td><td></td></tr>


						<?php 
						$totalkeluar= $k -> istockin + $totalkeluar;
						endforeach; ?>					
						
						<tr><th colspan=2 >Total</th><th><?php echo $detail[0] -> istockin; ?></th><th>
						<?php echo $totalkeluar; ?></th><th></th><th>
						<?php 
						$stocktotal=($detail[0] -> istock ) + ($detail[0] -> istockbegining)-$totalkeluar;
						echo $stocktotal; ?></th></tr>
						</table>
				
			




					
                                        </div>
                                        
                                </form>
                            </div>
                        </div>
                    </div>

                </section><!-- /.content -->
            </aside><!-- /.right-side -->
