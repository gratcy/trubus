
       <!--PAGE CONTENT -->
        <div id="content">
                <div class="inner">
                    <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Sparepart Update</h1>
                </div>
            </div>
<div class="row">
<div class="col-lg-12">
    <div class="box dark">
        <header>
            <div class="icons"><i class="icon-edit"></i></div>
            <h5>Sparepart Update</h5>
        </header>
        <div id="div-1" class="accordion-body collapse in body">
	<?php echo __get_error_msg(); ?>
            <form class="form-horizontal" action="<?php echo site_url('sparepart/sparepart_update'); ?>" method="post">
<input type="hidden" name="id" value="<?php echo $id; ?>">

                <div class="form-group">
                    <label for="text1" class="control-label col-lg-4">Code</label>

                    <div class="col-lg-4">
                        <input type="text" placeholder="Sparepart Code" name="code" class="form-control" value="<?php echo $detail[0] -> scode; ?>" />
                    </div>
                </div>

                <div class="form-group">
                    <label for="text1" class="control-label col-lg-4">Product</label>

                    <div class="col-lg-4">
						<select name="product" data-placeholder="Product" class="form-control chzn-select"><?php echo $products; ?></select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="text1" class="control-label col-lg-4">Name</label>

                    <div class="col-lg-4">
                        <input type="text" placeholder="Sparepart Name" name="name" class="form-control" value="<?php echo $detail[0] -> sname; ?>" />
                    </div>
                </div>

                <div class="form-group">
                    <label for="text1" class="control-label col-lg-4">No Component</label>

                    <div class="col-lg-4">
                        <input type="text" placeholder="No Component" name="nocomp" class="form-control" value="<?php echo $detail[0] -> snocomponent; ?>" />
                    </div>
                </div>

                <div class="form-group">
                    <label for="text1" class="control-label col-lg-4">Price Agent</label>

                    <div class="col-lg-4">
                        <input type="text" name="agent" class="form-control" style="text-align:right;" onkeyup="formatharga(this.value,this)" value="<?php echo __get_rupiah($detail[0] -> spriceagent,2); ?>" />
                    </div>
                </div>
                <div class="form-group">
                    <label for="text1" class="control-label col-lg-4">Price Retail</label>

                    <div class="col-lg-4">
                        <input type="text" name="retail" class="form-control" style="text-align:right;" onkeyup="formatharga(this.value,this)" value="<?php echo __get_rupiah($detail[0] -> spriceretail,2); ?>" />
                    </div>
                </div>
                <div class="form-group">
							<label for="status" class="control-label col-lg-4">Status</label>
                    <div class="col-lg-4">
						
                            <div class="make-switch has-switch" data-on="danger" data-off="default">
                                <?php echo __get_status($detail[0] -> sstatus,2); ?>
                            </div>
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
