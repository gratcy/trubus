
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
            <form class="form-horizontal" action="<?php echo site_url('purchase_order/home/purchase_order_add'); ?>" method="post">


                <div class="form-group">
                    <label for="text1" class="control-label col-lg-4">Cabang</label>

                    <div class="col-lg-4">
                        <!--input type="text" placeholder="Purchase Order Code" name="pbid" class="form-control" /-->
						
						<select name="pbid" data-placeholder="Cabang" class="form-control chzn-select"><?php echo $pbid; ?></select>						
						
                    </div>
                </div>

                <div class="form-group">
                    <label for="text1" class="control-label col-lg-4">No bukti</label>

                    <div class="col-lg-4">
                        <input type="text" placeholder="No Bukti" name="pnobukti" class="form-control" />
                    </div>
                </div>

                <div class="form-group">
                    <label for="text1" class="control-label col-lg-4">Ref</label>

                    <div class="col-lg-4">
                        <input type="text" name="pref" class="form-control"     />
                    </div>
                </div>

                <div class="form-group">
                    <label for="text1" class="control-label col-lg-4">Tanggal</label>

                    <div class="col-lg-4">
                  

                <input  name="ptgl" type="text" placeholder="click to show datepicker"  id="example1" class="form-control"  >
            </div>
       				
					
					
                </div>

                <div class="form-group">
                    <label for="text1" class="control-label col-lg-4">Sales</label>

                    <div class="col-lg-4">
                        <select name="psid" data-placeholder="sales" class="form-control chzn-select"><?php echo $psid; ?></select>		
                    </div>
                </div>

                <div class="form-group">
                    <label for="text1" class="control-label col-lg-4">Gudang</label>

                    <div class="col-lg-4">
						<input type="text" name="pgudang" class="form-control"  />
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
    </div>
                    </div>
                  </div>
        </div>
        </div>
        <!-- END PAGE CONTENT -->
