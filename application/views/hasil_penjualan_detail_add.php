
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Hasil penjualan hanya dari cust Konsinyasi
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo site_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Hasil Penjualan</li>
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
		  //foreach($hasil_penjualan_detailxx as $k => $v) :
		  //$phone = explode('*', $v -> tnofaktur);
		  ?>
		   <?php //endforeach; 
		   //print_r($detail);
		   ?>
		  
<!-- form start -->
                                 <form role="form" action="<?php echo site_url('hasil_penjualan_detail/hasil_penjualan_detail_add'); ?>" method="post">
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
   

                                        <div class="form-group">
                                            <label>Buku</label>
						                  <select  class="form-control" name="tbid">
												<?php echo $buku; ?>
                                            </select>	
                                        </div>
                                        <div class="form-group">
                                            <label>Qty</label>
											<input type="text"  name="tqty" class="form-control" placeholder="Qty"  >
                                        </div>
                                        <div class="form-group">
                                            <label>Discount</label>
											<input type="text"  name="tdisc" class="form-control" placeholder="Discount"  >
											<input type="hidden" value="<?php echo $id; ?>" name="ttid" class="form-control" placeholder="Discount"  >
                                        </div>






   
                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
                                        <button type="submit" class="btn btn-primary"> <i class="fa fa-save"></i> Submit</button>
										<button class="btn btn-default" type="button" onclick="location.href='javascript:history.go(-1);'">Back</button>
                                    </div>
                                </form>
	  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  


                                    </tbody>
                                  
                                </div><!-- /.box-body -->
								
								
	<br>
	<hr></hr>
								
	  <div class="box-body">
                                    <table class="table table-bordered">
                                    <thead>
                                        <tr>
		  <th>No</th>	
		  <th>Nofaktur</th>								
          <th>Buku</th>
          <th>Qty</th>
          <th>Harga</th>
          <th>Discount</th>          
          <th>Total Harga</th>
          
          <th style="width: 50px;"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
		  <?php
		  foreach($hasil_penjualan_detail as $k => $v) :
		  //$phone = explode('*', $v -> tnofaktur);
		  ?>
          <tr>
		  <td><?php echo $v -> tid; ?></td>								
          <td><?php echo $v -> tnofaktur; ?></td>
          <td><?php echo $v -> tbid; ?></td>
          <td><?php echo $v -> tqty; ?></td>
          <td><?php echo $v -> tharga; ?></td>
          <td><?php echo $v -> tdisc; ?></td>
          <td><?php echo $v -> ttotal; ?></td>

		  <td>
	<?php if ($v -> tstatus <> 1) { ?>
              <a href="<?php echo site_url('hasil_penjualan_detail/hasil_penjualan_detail_update/' . $v -> tid); ?>"><i class="fa fa-pencil"></i></a>
              <a href="<?php echo site_url('hasil_penjualan_detail/hasil_penjualan_detail_delete/' . $v -> tid); ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-times"></i></a>
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
