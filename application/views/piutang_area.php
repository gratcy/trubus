
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Piutang Area
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo site_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Piutang Area</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
				
				
				
	                    <div class="row">
						<form action="<?php echo site_url('pembayaran/pembayaran_excel/'); ?>" method="post">
                        <div class="col-xs-6" style="height: 60px;">
                                    <div class="form-group">
                                        <label>Date range:</label>
                                        <div class="input-group col-lg-10">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="text" class="form-control pull-right" id="datesort" name="datesort" autocomplete="off" />
                                        </div><!-- /.input group -->
                        <button class="btn text-muted text-center btn-danger" type="submit" style="position: relative;top: -34px;float: right;margin-right: 38px;">Go!</button>
                                    </div><!-- /.form group -->
						</div>
						</div>
						</form>
				
				
				
                    <div class="row">
			
						</div>
						<br />
				
                    <div class="row">
                        <div class="col-xs-12">
	<?php echo __get_error_msg(); ?>

							<div class="box">
                                <div class="box-header">
								
								
								
								
								
								
								
								
								
                                </div><!-- /.box-header -->
                                <div class="box-body">
                                    <table class="table table-bordered">
                                    <thead>
                                        <tr>
		  <th>Area</th>		
		  <th>Total Tagihan</th>	
		  <th>Status Bayar</th>
		  <th>Deatil</th>
         

          <!--th style="width: 80px;"></th-->
                                        </tr>
                                    </thead>
                                    <tbody>
		  <?php
		  
		  foreach($piutang as $k => $v) :
		  //$phone = explode('*', $v -> tnofaktur);
		  $appr= $v -> approval;
		  if($v -> tsbayar==1){ $sb="On Proses";}
		  elseif ($v -> tsbayar==3){ $sb="Done";}
		  else{ $sb="Belum di tagih";}
		  ?>
          <tr>
		  <td><?php echo $v -> aname; ?></td>		
          <td><?php echo __get_rupiah($v -> tg,3); ?></td>
		  <td><?php echo $sb ?></td>
		  <td><a href="<?php echo site_url('piutang/home/piutang_cust_id/'.$v->aid); ?>"><i class="fa fa-book"></i></a></td>

		  <!--td style="text-align:right;"><?php //echo __get_rupiah($v -> gtotal,1); ?></td-->
	  
		  

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
