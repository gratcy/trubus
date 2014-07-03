
        <!-- Load jQuery and bootstrap datepicker scripts -->
        <script src="js/jquery-1.9.1.min.js"></script>
        <script src="js/bootstrap-datepicker.js"></script>
        <script type="text/javascript">
            // When the document is ready
            $(document).ready(function () {
                
                $('#example1').datepicker({
                    format: "dd/mm/yyyy"
                });  
            
            });
        </script>
    
       <!--PAGE CONTENT -->
        <div id="content">
                <div class="inner">
                    <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Purchase Order Add</h1>
                </div>
            </div>
<div class="row">
<div class="col-lg-12">
    <div class="box dark">
        <header>
            <div class="icons"><i class="icon-edit"></i></div>
            <h5>Purchase Order Add</h5>
        </header>
        <div id="div-1" class="accordion-body collapse in body">
	<?php echo __get_error_msg(); ?>
            <form class="form-horizontal" action="<?php echo site_url('purchase_order_detail/home/purchase_order_detail_add'); ?>" method="post">

<?php  //print_r($detailx);?>
                <div class="form-group">
                    <label for="text1" class="control-label col-lg-4">Cabang</label>

                    <div class="col-lg-4">	
					<input type=text value="<?php echo $detailx[0]->pbid; ?>" class="form-control" disabled>
                    </div>
                </div>

                <div class="form-group">
                    <label for="text1" class="control-label col-lg-4">No bukti</label>

                    <div class="col-lg-4">
                       <input type=hidden name=id value="<?php echo $id; ?>">
					   <input type=text value="<?php echo $detailx[0]->pnobukti; ?>" class="form-control" disabled>
                    </div>
                </div>

                <div class="form-group">
                    <label for="text1" class="control-label col-lg-4">Ref</label>

                    <div class="col-lg-4">
                       <input type=text value="<?php echo $detailx[0]->pref; ?>" class="form-control" disabled>
                    </div>
                </div>

                <div class="form-group">
                    <label for="text1" class="control-label col-lg-4">Tanggal</label>

                    <div class="col-lg-4">
					<input type=text value="<?php echo $detailx[0]->ptgl; ?>" class="form-control" disabled>
                    </div>
       				
					
					
                </div>

                <div class="form-group">
                    <label for="text1" class="control-label col-lg-4">Sales</label>

                    <div class="col-lg-4">
                       	<input type=text value="<?php echo $detailx[0]->psid; ?>" class="form-control" disabled>
                    </div>
                </div>

                <div class="form-group">
                    <label for="text1" class="control-label col-lg-4">Gudang</label>

                    <div class="col-lg-4">
						<input type=text value="<?php echo $detailx[0]->pgudang; ?>" class="form-control" disabled>
                    </div>
                </div>

                <div class="form-group">
                    <label for="text1" class="control-label col-lg-4">Kode Barang</label>

                    <div class="col-lg-4">
                        <select name="pppid" data-placeholder="Kode Barang" class="form-control chzn-select"><?php echo $pppid; ?></select>	
                    </div>
                </div>

                <div class="form-group">
                    <label for="text1" class="control-label col-lg-4">Mata Uang</label>

                    <div class="col-lg-4">
                        <input type="text" name="pcurrency" class="form-control"     />
                    </div>
                </div>

                <div class="form-group">
                    <label for="text1" class="control-label col-lg-4">Qty</label>

                    <div class="col-lg-4">
                        <input type="text" name="pqty" class="form-control" data-placeholder="Point" />
                    </div>
                </div>
                <div class="form-group">
                    <label for="text1" class="control-label col-lg-4">Harga</label>

                    <div class="col-lg-4">
                        <input type="text" name="pharga" class="form-control" data-placeholder="Point" 
						onkeyup="formatharga(this.value,this)" value="0" />
                    </div>
                </div>
				
                <div class="form-group">
                    <label for="text1" class="control-label col-lg-4">Discount</label>
                    <div class="col-lg-4">
                        <input type="text" name="pdisc" class="form-control" data-placeholder="Point" />
                    </div>
                </div>

                <div class="form-group">
                    <label for="text1" class="control-label col-lg-4">Keterangan</label>

                    <div class="col-lg-4">
                        <textarea name="pketerangan" class="form-control" placeholder="Description"></textarea>
                    </div>
                </div>				
				
                <div class="form-group">
							<label for="status" class="control-label col-lg-4">Status</label>
                    
                    <div class="col-lg-4">
						<select name="pstatus" data-placeholder="gudang" class="form-control chzn-select">
						<option value=0>Pending</option>
						<option value=1>Ok</option>
						</select>
                    </div>
				</div>
                <div class="form-group">
							<label for="status" class="control-label col-lg-4"></label>
                    <div class="col-lg-4">
				<button class="btn text-muted text-center btn-danger" type="submit">Submit</button>
				<button class="btn text-muted text-center btn-primary" type="button" onclick="location.href='javascript:history.go(-1);'">Back</button>
					</div>
				</div>
            </form>
        </div>
    </div>
</div>










  <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
          
          <th>Kode Product</th>
          <th>Currency</th>
          <th>Qty</th>
          <th>Harga</th>
          <th>Discount </th>
		  <th>Keterangan</th>
          <th>Status</th>
		  <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
		  <?php
		  
		
		  foreach($detail as $k => $v) :	
	
		  ?>
          <tr>
          
          <td><?php echo $v -> pppid; ?></td>
          <td><?php echo $v -> pcurrency; ?></td>
          <td><?php echo $v -> pqty; ?></td>
          <td><?php echo $v -> pharga; ?></td>
          <td><?php echo $v -> pdisc; ?></td>
		  <td><?php echo $v -> pketerangan; ?></td>
          <td><?php echo $v -> pstatus; ?></td>
		
		
		  <td>
              <a href="<?php echo site_url('purchase_order/home/purchase_order_update/' . $v -> pid); ?>"><i class="icon-pencil"></i></a>
              <a href="<?php echo site_url('purchase_order/home/purchase_order_delete/' . $v -> pid); ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="icon-remove"></i></a>
          </td>		
		
		
										</tr>
        <?php endforeach; ?>
                                    </tbody>
                                </table>
    <?php //echo $pages; ?>
                            </div>
                        </div>
                    
    </div>
                    </div>
                  </div>
        </div>
        </div>
        <!-- END PAGE CONTENT -->
