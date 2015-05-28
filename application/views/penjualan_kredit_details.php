
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Penjualan Kredit
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo site_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Penjualan Kredit</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
	<?php echo __get_error_msg(); ?>
							<div class="box">
                                <div class="box-header">
                                   </div><!-- /.box-header -->
                                <div class="box-body">

                                    </thead>
                                    <tbody>

		  
<!-- form start -->
                                 <form role="form" action="<?php echo site_url('penjualan_kredit_detail/penjualan_kredit_detail_add'); ?>" method="post">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label>No Faktur</label>
                        <input type="text" value="<?php echo $detail[0] -> tnofaktur; ?>" placeholder="No Faktur" name="tnofaktur" class="form-control" disabled />
                                        </div>
                                        <div class="form-group">
                                            <label>Kode Customer</label>
						                  <select  class="form-control" name="branch" disabled >
										  <option value="<?php echo $detail[0] -> tcid; ?>"><?php echo $detail[0] -> tcid; ?></option>
												<?php echo $customer; ?>
                                            </select>					
										</div>
                                        <div class="form-group">
                                            <label>Jenis Pajak</label>
											<input type="text" value="<?php echo $detail[0] -> ttax; ?>" name="ttax" class="form-control" placeholder="Jenis Pajak" disabled  >
                                        </div>
                                        <div class="form-group">
                                            <label>Tanggal</label>
                        <input type="text" value="<?php echo $detail[0] -> ttanggal; ?>" name="ttanggal" class="form-control" placeholder="Tanggal" disabled  >
						<input type="hidden" name="ttype" value="1" class="form-control" placeholder="Type">
						<input type="hidden" name="ttypetrans" value="1" class="form-control" placeholder="Type Trans">	
						<input type="hidden" name="tstatus" value="1" class="form-control" placeholder="tstatus">						
                                        </div>
   
                                    </div><!-- /.box-body -->

                          
                                </form>
	  
		       </tbody>
                                  
                                </div><!-- /.box-body -->
								
								
	<br>

								
	  <div class="box-body">
                                    <table class="table table-bordered">
                                    <thead>
                                        <tr>
		  <th>No</th>	
		  <th>Nofaktur</th>								
          <th>Buku</th>
          <th>Qty</th>
          <th>Harga</th>
		  <th>Total Harga</th>
          <th>Discount</th>          
          <th>Total</th>
          
          <th style="width: 50px;"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
		  <?php
		  $jcount=count($penjualan_kredit_detail);
		  if($jcount>0){
		  foreach($penjualan_kredit_detail as $k => $v) :
		  //$phone = explode('*', $v -> tnofaktur);

		  ?>
          <tr>
		  <td><?php echo $v -> tid; ?></td>								
          <td><?php echo $v -> tnofaktur; ?></td>
          <td><?php echo $v -> btitle; ?></td>
          <td><?php echo $v -> tqty; ?></td>
          <td><?php echo $v -> tharga; ?></td>
		  <td><?php echo $v -> tharga*$v -> tqty; ?></td>
          <td><?php echo $v -> tdisc; ?></td>
          <td><?php echo $v -> ttotal; ?></td>

		  <td>
	<?php if ($v -> tstatus <> 1) { ?>
              <a href="<?php echo site_url('penjualan_kredit_detail/penjualan_kredit_detail_update/' . $v -> tid); ?>"><i class="fa fa-pencil"></i></a>
              <a href="<?php echo site_url('penjualan_kredit_detail/penjualan_kredit_detail_delete/' . $v -> tid); ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-times"></i></a>
		<?php } ?>
		</td>
										</tr>
        <?php endforeach; ?>
                                    </tbody>
                                    </table>
									<?php 
									$app= $v -> approval; 
									$appx=$app+1;
									echo $app;
									?>
		
       <?php if($app < 2){?>
		
		 <a href="<?php echo site_url('penjualan_kredit_detail/penjualan_kredit_detail_add/'. $id); ?>" class="btn btn-default"><i class="fa fa-plus"></i> Edit Penjualan</a>							
	   							
		<a href="<?php echo site_url('penjualan_kredit_detail/penjualan_kredit_detail_approval'.$appx.'/'. $id); ?>" class="btn btn-default"><i class="fa fa-plus"></i> APPROVAL <?=$appx;?></a>							
		<?php } else{?>	
         <a href="javascript:void(0);" onclick="print_data('<?php echo site_url('penjualan_kredit_detail/penjualan_kredit_faktur/' . $id); ?>', 'Print Penawaran');"><i class="fa fa-print"></i></a>
		  <?php } }else{ ?>	
 <a href="<?php echo site_url('penjualan_kredit_detail/penjualan_kredit_detail_add/'. $id); ?>" class="btn btn-default"><i class="fa fa-plus"></i> Edit Penjualan</a>
		  <?php } ?>		  
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
