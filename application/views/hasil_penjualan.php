
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Hasil Penjualan
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo site_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Hasil Penjualan</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
				
				
				
	                    <div class="row">
						<form action="<?php echo site_url('hasil_penjualan/hasil_penjualan_excel/'); ?>" method="post">
                        <div class="col-xs-6">

                                    <div class="form-group">
                                        <label>Date range:</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="text" class="form-control pull-right" id="datesort" name="datesort" autocomplete="off" />
                                        </div><!-- /.input group -->
                        <button class="btn text-muted text-center btn-danger" type="submit" style="position: relative;
top: -34px;
float: right;">Go!</button>
                                    </div><!-- /.form group -->
						</div>
						</div>
						</form>
				
				
				
				
				
				
				
				
				
				
				
                    <div class="row">
                        <div class="col-xs-12">
	<?php echo __get_error_msg(); ?>

							<div class="box">
                                <div class="box-header">
								
								
								
								
								
								
								
								
								
                                    <h3 class="box-title">
                <a href="<?php echo site_url('hasil_penjualan/hasil_penjualan_add'); ?>" class="btn btn-default"><i class="fa fa-plus"></i> Add Hasil Penjualan</a></h3>
                                </div><!-- /.box-header -->
                                <div class="box-body">
                                    <table class="table table-bordered">
                                    <thead>
                                        <tr>
		  <th>No Faktur</th>	
		  <th>Customer</th>								
          <th>Jenis Pajak</th>
          <th>Tanggal</th>
          <th>Total Disc</th>
          <th>Total Qty</th>
          <th>Total Ongkos</th>
          <th>Total Harga</th>
		  <th>Grand Total</th>
          <th>Info</th>
          <th style="width: 80px;"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
		  <?php
		  
		  foreach($hasil_penjualan as $k => $v) :
		  //$phone = explode('*', $v -> tnofaktur);
		  ?>
          <tr>
		  <td><?php echo $v -> tnofaktur; ?></td>								
          <td><?php echo $v -> cname; ?></td>
          <td><?php echo __get_tax($v -> ttax,1); ?></td>
          <td><?php echo $v -> ttanggal; ?></td>
          <td><?php echo __get_rupiah($v -> ttotaldisc,1); ?></td>
          <td><?php echo $v -> ttotalqty; ?></td>
          <td style="text-align:right;"><?php echo __get_rupiah($v -> tongkos,1); ?></td>
          <td style="text-align:right;"><?php echo __get_rupiah($v -> ttotalharga,1); ?></td>
		  <td style="text-align:right;"><?php echo __get_rupiah($v -> tgrandtotal,1); ?></td>
          <td><?php echo $v -> tinfo; ?></td>
		  <td>
	<?php if ($v -> tstatus <> 2) { ?>
	              <a href="javascript:void(0);" onclick="print_data('<?php echo site_url('hasil_penjualan_detail/hasil_penjualan_faktur/' . $v -> tid); ?>', 'Print Penawaran');"><i class="fa fa-print"></i></a>
              <a href="<?php echo site_url('hasil_penjualan_details/' . $v -> tid); ?>"><i class="fa fa-pencil"></i></a>
              <a href="<?php echo site_url('hasil_penjualan/hasil_penjualan_delete/' . $v -> tid); ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-times"></i></a>
		<?php } ?>
		</td>
										</tr>
        <?php endforeach; ?>
                                    </tbody>
                                    </table>
                                </div><!-- /.box-body -->
                                <div class="box-footer clearfix">
                                    <ul class="pagination pagination-sm no-margin pull-right">
                                        <?php echo $pages; ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                </section><!-- /.content -->
            </aside><!-- /.right-side -->

			
			<script type="text/javascript">
$(function(){
	$('#datesort').daterangepicker();
});
</script>
