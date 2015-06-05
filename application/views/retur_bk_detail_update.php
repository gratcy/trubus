
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
                        <div class="col-xs-12">
	<?php echo __get_error_msg(); ?>
							<div class="box">
                                <div class="box-header">
                                    
                                </div><!-- /.box-header -->
                                <div class="box-body">

                                    </thead>
                                    <tbody>
		  <?php
		  $id= $this->uri->segment(3);
		   $id_penerbit= $this->uri->segment(4);
		  ?>
		   <?php //endforeach; ?>
		  
<!-- form start -->
                                                                 <form role="form" action="<?php echo site_url('retur_bk_detail/retur_bk_detail_add'); ?>" method="post">
                                    <div class="box-body">
                                        <div class="form-group">
											
		   		  <a href="javascript:void(0);" class="btn btn-primary" onclick="print_data('<?php echo site_url('penjualan_kredit/index_upload/' . $id); ?>', 'Print Penawaran');">IMPORT EXCEL</a>
											</div>
                                        <div class="form-group">
                                            <label>No Faktur</label>
                        <input type="text" value="<?php echo $detail[0] -> tnospo; ?>" placeholder="No Faktur" name="tnofaktur" class="form-control" disabled />
                                        </div>
  
                                        <div class="form-group">
                                            <label>Tanggal</label>
                        <input type="text" value="<?php echo $detail[0] -> ttgl_spo; ?>" name="ttanggal" class="form-control" placeholder="Tanggal" disabled  >
						<input type="hidden" name="ttype" value="3" class="form-control" placeholder="Type">
						<input type="hidden" name="ttypetrans" value="2" class="form-control" placeholder="Type Trans">	
						<input type="hidden" name="tstatus" value="1" class="form-control" placeholder="tstatus">						
                                        
                                        </div>
                                        					
                                    </div><!-- /.box-body -->


                                </form>		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  


                                    </tbody>
                                  
                                </div><!-- /.box-body -->
								
               &nbsp;&nbsp; <a href="<?php echo site_url('retur_bk_detail/retur_bk_detail_add/'. $id .'/'.$id_penerbit ); ?>" class="btn btn-default"><i class="fa fa-plus"></i> Add Retur Pembelian Detail</a>
								<br />
								<br />
	 <div class="box-body">

	 <form method=POST>
	 <label>No Faktur</label> <input type=text name="no_penerimaan" value="<?php echo $retur_bk_detail[0] ->tnospo; ?>" class="form-control"><br>
	 <input type=hidden name="id" value="<?=$id;?>">
	 <input type=hidden name="id_penerbit" value="<?=$id_penerbit;?>" >
                                    <table class="table table-bordered">
                                    <thead>
                                        <tr>
		  <th>No</th>	
		 								
          <th>Kode Buku</th>
          <th>Buku</th>
          <th>Qty</th>

          
          <th style="width: 50px;"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
		  <?php
		  $l=1;
		  foreach($retur_bk_detail as $k => $v) :
		  //print_r($retur_bk_detail);
		  ?>
          <tr>
		  <td><?php echo ($l+$pPages); ?>
		  <input type=hidden name="tbid[]" value="<?php echo $v -> tbid; ?>">
		  <input type=hidden name="tid[]" value="<?php echo $v -> tid; ?>"></td>								
       
          <td><?php echo $v -> bcode; ?></td>
          <td><?php echo $v -> btitle; ?> </td>
          <td>
		  <select name="qty[]" class="form-control">
		  <?php $qty= $v -> tqty; 
		  echo "<option value=$qty>$qty</option>";  
		  for ($i=100;$i>=0;$i--){
			echo "<option value=$i>$i</option>";  
		  }
		  
		  ?>
		  </select>
		  </td>


		  <td>
	<?php if ($v -> tstatus <> 2) { ?>
              <!--a href="<?php //echo site_url('retur_bk_detail/retur_bk_detail_update/' . $v -> tid); ?>"><i class="fa fa-pencil"></i></a-->
              <a href="<?php echo site_url('retur_bk_detail/retur_bk_detail_delete/' . $v -> tid.'/'.$id.'/'. $id_penerbit ); ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-times"></i></a>
		<?php } ?>
		</td>
										</tr>
        <?php ++$l; endforeach; ?>
                                    </tbody>
                                    </table>
<br />
<input type="submit" value="Approval" class="btn btn-primary">
		</form>
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
