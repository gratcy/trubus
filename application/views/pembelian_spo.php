
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Pembelian SPO
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo site_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Pembelian SPO</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
	<?php echo __get_error_msg(); ?>

							<div class="box">
                                <div class="box-header">
								
								
								
								
								
								
								
								
								
                                    <h3 class="box-title">
                <a href="<?php echo site_url('pembelian_spo/pembelian_spo_add'); ?>" class="btn btn-default"><i class="fa fa-plus"></i> Add Pembelian SPO</a></h3>
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <table class="table table-bordered">
                                    <thead>
                                        <tr>
		  <th>No SPO</th>	
		  <th>No Penerimaan</th>								
          <th>Penerbit</th>
          <th>Tanggal SPO</th>
          <th>Type Transaksi</th>
          <th style="width: 80px;"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
		  <?php
		  foreach($pembelian_spo as $k => $v) :
		  //$phone = explode('*', $v -> tnofaktur);
		  ?>
          <tr>
		  <td><?php echo $v -> tnospo; ?></td>								
          <td><?php echo $v -> tnofaktur; ?></td>
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
	              <a href="javascript:void(0);" onclick="print_data('<?php echo site_url('pembelian_spo_detail/pembelian_spo_faktur/' . $v -> tid); ?>', 'Print Penawaran');"><i class="fa fa-print"></i></a>
              <a href="<?php echo site_url('pembelian_spo_detail/pembelian_spo_detail_update/' . $v -> tid.'/'.$v -> pid ); ?>"><i class="fa fa-pencil"></i></a>
              <a href="<?php echo site_url('pembelian_spo/pembelian_spo_delete/' . $v -> tid); ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-times"></i></a>
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
