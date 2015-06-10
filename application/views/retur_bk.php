
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Retur Pembelian
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo site_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Retur Pembelian</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
				
	                    <div class="row">
						<form action="<?php echo site_url('retur_bk/hasil_retur_excel/'); ?>" method="post">
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
						<form action="<?php echo site_url('retur_bk/retur_bk_search/'); ?>" method="post">
                <div class="form-group">
                    <label for="text1" class="control-label col-lg-3">No Faktur / No Penerimaan / Penerbit</label>
                        <div class="col-xs-4">
                        <input type="text" style="width:200px!important;display:inline!important;" placeholder="No Faktur / No Penerimaan / Penerbit" name="keyword" class="form-control" autocomplete="off" />
                        <button class="btn text-muted text-center btn-danger" type="submit">Go!</button>
                        <span id="sg1"></span>
                        <input type="hidden" name="id" />
						</div>
						</div>
						</form>
						</div>
						<br />
				
                    <div class="row">
                        <div class="col-xs-12">
	<?php echo __get_error_msg(); ?>

							<div class="box">
                                <div class="box-header">
								
								
								
								
								
								
								
								
								
                                    <h3 class="box-title">
                <a href="<?php echo site_url('retur_bk/retur_bk_add'); ?>" class="btn btn-default"><i class="fa fa-plus"></i> Add Retur Pembelian</a></h3>
                                </div><!-- /.box-header -->
                                <div class="box-body">
                                    <table class="table table-bordered">
                                    <thead>
                                        <tr>
		  <th>No Faktur</th>	
		  <th>No Penerimaan</th>								
          <th>Penerbit</th>
          <th>Tanggal SPO</th>
          <th>Type Transaksi</th>
          <th style="width: 80px;"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
		  <?php
		  foreach($retur_bk as $k => $v) :
		  //$phone = explode('*', $v -> tnofaktur);
		  ?>
          <tr>						
          <td><?php echo $v -> tnofaktur; ?></td>
		  <td><?php echo $v -> tnospo; ?></td>		
          <td><?php echo $v -> pname; ?></td>
          <td><?php echo $v -> ttgl_spo; ?></td>
          <td>
		  <?php 
		  $ttypetrans= $v -> ttypetrans; 
		  if($ttypetrans==1){
			echo "Konsinyasi";  
		  }else{
			 echo "Kredit"; 
		  }
		  ?></td>
		  <td>
	<?php if ($v -> tstatus <> 2) { ?>
	              <a href="javascript:void(0);" onclick="print_data('<?php echo site_url('retur_bk_detail/retur_bk_faktur/' . $v -> tid); ?>', 'Print Penawaran');"><i class="fa fa-print"></i></a>
              <a href="<?php echo site_url('retur_bk_detail/retur_bk_detail_update/' . $v -> tid.'/'.$v -> pid ); ?>"><i class="fa fa-pencil"></i></a>
              <a href="<?php echo site_url('retur_bk/retur_bk_delete/' . $v -> tid); ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-times"></i></a>
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
