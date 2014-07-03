
       <!--PAGE CONTENT -->
        <div id="content">
                <div class="inner">
                    <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Sales Commision Add</h1>
                </div>
            </div>
<div class="row">
<div class="col-lg-12">
    <div class="box dark">
        <header>
            <div class="icons"><i class="icon-edit"></i></div>
            <h5>Sales Commision Add</h5>
        </header>
        <div id="div-1" class="accordion-body collapse in body">
	<?php echo __get_error_msg(); ?>
            <form class="form-horizontal" action="<?php echo site_url('sales_commision/sales_commision_add'); ?>" method="post">

                <div class="form-group">
                    <label for="text1" class="control-label col-lg-4">Branch</label>

                    <div class="col-lg-6">
						<select name="branch" data-placeholder="Branch" class="form-control chzn-select"><?php echo $branch; ?></select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="text1" class="control-label col-lg-4">Category</label>

                    <div class="col-lg-6">
						<select name="category" data-placeholder="Product Category" class="form-control chzn-select"><?php echo $category; ?></select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="text1" class="control-label col-lg-4">Sales Commision</label>

                    <div class="input-group col-lg-2">
                        <input type="text" style="text-align:right;" placeholder="Commision A" name="scoma" class="form-control" /> <span class="input-group-addon">%</span>
                    </div>
                    <div class="input-group col-lg-2">
                        <input type="text" style="text-align:right;" placeholder="Commision B" name="scomb" class="form-control" /> <span class="input-group-addon">%</span>
                    </div>
                    <div class="input-group col-lg-2">
                        <input type="text" style="text-align:right;" placeholder="Commision C" name="scomc" class="form-control" /> <span class="input-group-addon">%</span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="text1" class="control-label col-lg-4"> </label>

                    <div class="input-group col-lg-2">
                        <input type="text" style="text-align:right;" placeholder="Commision D" name="scomd" class="form-control" /> <span class="input-group-addon">%</span>
                    </div>
                    <div class="input-group col-lg-2">
                        <input type="text" style="text-align:right;" placeholder="Commision E" name="scome" class="form-control" /> <span class="input-group-addon">%</span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="text1" class="control-label col-lg-4">Sales Credit</label>

                    <div class="input-group col-lg-2">
                        <input type="text" style="text-align:right;" placeholder="Credit A" name="scredita" class="form-control" /> <span class="input-group-addon">%</span>
                    </div>
                    <div class="input-group col-lg-2">
                        <input type="text" style="text-align:right;" placeholder="Credit B" name="screditb" class="form-control" /> <span class="input-group-addon">%</span>
                    </div>
                    <div class="input-group col-lg-2">
                        <input type="text" style="text-align:right;" placeholder="Credit C" name="screditc" class="form-control" /> <span class="input-group-addon">%</span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="text1" class="control-label col-lg-4"></label>
                    <div class="input-group col-lg-2">
                        <input type="text" style="text-align:right;" placeholder="Credit D" name="screditd" class="form-control" /> <span class="input-group-addon">%</span>
                    </div>
                    <div class="input-group col-lg-2">
                        <input type="text" style="text-align:right;" placeholder="Credit E" name="scredite" class="form-control" /> <span class="input-group-addon">%</span>
                    </div>
                </div>

                <div class="form-group">
							<label for="status" class="control-label col-lg-4">Status</label>
                    <div class="col-lg-4">
						
                            <div class="make-switch has-switch" data-on="danger" data-off="default">
                                <?php echo __get_status(0,2); ?>
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
