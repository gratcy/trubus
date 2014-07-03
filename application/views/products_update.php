
       <!--PAGE CONTENT -->
        <div id="content">
                <div class="inner">
                    <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Product Update</h1>
                </div>
            </div>
<div class="row">
<div class="col-lg-12">
    <div class="box dark">
        <header>
            <div class="icons"><i class="icon-edit"></i></div>
            <h5>Product Update</h5>
        </header>
        <div id="div-1" class="accordion-body collapse in body">
	<?php echo __get_error_msg(); ?>
            <form class="form-horizontal" action="<?php echo site_url('products/products_update'); ?>" method="post">
<input type="hidden" name="id" value="<?php echo $id; ?>">
                <div class="form-group">
                    <label for="text1" class="control-label col-lg-4">Category</label>

                    <div class="col-lg-4">
						<select name="category" data-placeholder="Product Category" class="form-control chzn-select"><?php echo $category; ?></select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="text1" class="control-label col-lg-4">Packaging</label>

                    <div class="col-lg-4">
						<select name="packaging" data-placeholder="Product Packaging" class="form-control chzn-select"><?php echo $packaging; ?></select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="text1" class="control-label col-lg-4">Code</label>

                    <div class="col-lg-4">
                        <input type="text" placeholder="Product Code" name="code" class="form-control" value="<?php echo $detail[0] -> pcode; ?>" />
                    </div>
                </div>
                <div class="form-group">
                    <label for="text1" class="control-label col-lg-4">Name</label>

                    <div class="col-lg-4">
                        <input type="text" placeholder="Product Name" name="name" class="form-control" value="<?php echo $detail[0] -> pname; ?>" />
                    </div>
                </div>

                <div class="form-group">
                    <label for="text1" class="control-label col-lg-4">Price Basic</label>

                    <div class="col-lg-4">
                        <input type="text" name="basic" class="form-control" style="text-align:right;" onkeyup="formatharga(this.value,this)" value="<?php echo __get_rupiah($detail[0] -> phpp,2); ?>" />
                    </div>
                </div>

                <div class="form-group">
                    <label for="text1" class="control-label col-lg-4">Price Distributor</label>

                    <div class="col-lg-4">
                        <input type="text" name="dist" class="form-control" style="text-align:right;" onkeyup="formatharga(this.value,this)" value="<?php echo __get_rupiah($detail[0] -> pdist,2); ?>" />
                    </div>
                </div>

                <div class="form-group">
                    <label for="text1" class="control-label col-lg-4">Price Semi</label>

                    <div class="col-lg-4">
                        <input type="text" name="semi" class="form-control" style="text-align:right;" onkeyup="formatharga(this.value,this)" value="<?php echo __get_rupiah($detail[0] -> psemi,2); ?>" />
                    </div>
                </div>

                <div class="form-group">
                    <label for="text1" class="control-label col-lg-4">Price Key</label>

                    <div class="col-lg-4">
                        <input type="text" name="key" class="form-control" style="text-align:right;" onkeyup="formatharga(this.value,this)" value="<?php echo __get_rupiah($detail[0] -> pkey,2); ?>" />
                    </div>
                </div>

                <div class="form-group">
                    <label for="text1" class="control-label col-lg-4">Price Store</label>

                    <div class="col-lg-4">
                        <input type="text" name="store" class="form-control" style="text-align:right;" onkeyup="formatharga(this.value,this)" value="<?php echo __get_rupiah($detail[0] -> pstore,2); ?>" />
                    </div>
                </div>

                <div class="form-group">
                    <label for="text1" class="control-label col-lg-4">Price Consume</label>

                    <div class="col-lg-4">
                        <input type="text" name="consume" class="form-control" style="text-align:right;" onkeyup="formatharga(this.value,this)" value="<?php echo __get_rupiah($detail[0] -> pconsume,2); ?>" />
                    </div>
                </div>
                <div class="form-group">
							<label for="status" class="control-label col-lg-4">MOQ</label>
                    <div class="col-lg-4">
						
                            <?php echo $this -> branch_lib -> __get_branch_moq($moq); ?>
					</div>
				</div>

                <div class="form-group">
                    <label for="text1" class="control-label col-lg-4">Point</label>

                    <div class="col-lg-4">
                        <input type="text" name="point" class="form-control" value="<?php echo $detail[0] -> ppoint; ?>" />
                    </div>
                </div>
                <div class="form-group">
                    <label for="text1" class="control-label col-lg-4">Description</label>

                    <div class="col-lg-4">
                        <textarea name="desc" class="form-control" placeholder="Description"><?php echo $detail[0] -> pdesc; ?></textarea>
                    </div>
                </div>
                <div class="form-group">
							<label for="status" class="control-label col-lg-4">Status</label>
                    <div class="col-lg-4">
						
                            <div class="make-switch has-switch" data-on="danger" data-off="default">
                                <?php echo __get_status($detail[0] -> pstatus,2); ?>
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
