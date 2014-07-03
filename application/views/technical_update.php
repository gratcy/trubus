<?php
$phone = explode('*', $detail[0] -> tphone);
?>
       <!--PAGE CONTENT -->
        <div id="content">
                <div class="inner">
                    <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Technical Update</h1>
                </div>
            </div>
<div class="row">
<div class="col-lg-12">
    <div class="box dark">
        <header>
            <div class="icons"><i class="icon-edit"></i></div>
            <h5>Technical Update</h5>
        </header>
        <div id="div-1" class="accordion-body collapse in body">
	<?php echo __get_error_msg(); ?>
            <form class="form-horizontal" action="<?php echo site_url('technical/technical_update'); ?>" method="post">
<input type="hidden" name="id" value="<?php echo $id; ?>">
                <div class="form-group">
                    <label for="text1" class="control-label col-lg-4">Branch</label>

                    <div class="col-lg-4">
						<select name="branch" data-placeholder="Branch" class="form-control chzn-select"><?php echo $branch; ?></select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="text1" class="control-label col-lg-4">Code</label>

                    <div class="col-lg-4">
                        <input type="text" placeholder="Technical Code" name="code" class="form-control" value="<?php echo $detail[0] -> tcode; ?>" />
                    </div>
                </div>

                <div class="form-group">
                    <label for="text1" class="control-label col-lg-4">Name</label>

                    <div class="col-lg-4">
                        <input type="text" placeholder="Technical Name" name="name" class="form-control" value="<?php echo $detail[0] -> tname; ?>" />
                    </div>
                </div>
                <div class="form-group">
                    <label for="text1" class="control-label col-lg-4">Phone I</label>

                    <div class="col-lg-4">
                        <input type="text" placeholder="Phone I" name="phone1" class="form-control" value="<?php echo $phone[0]; ?>" />
                    </div>
                </div>

                <div class="form-group">
                    <label for="text1" class="control-label col-lg-4">Phone II</label>

                    <div class="col-lg-4">
                        <input type="text" placeholder="Phone II" name="phone2" class="form-control" value="<?php echo $phone[1]; ?>" />
                    </div>
                </div>
                <div class="form-group">
                    <label for="text1" class="control-label col-lg-4">Email</label>

                    <div class="col-lg-4">
                        <input type="text" placeholder="Email" name="email" class="form-control" value="<?php echo $detail[0] -> temail; ?>" />
                    </div>
                </div>
                <div class="form-group">
							<label for="status" class="control-label col-lg-4">Status</label>
                    <div class="col-lg-4">
						
                            <div class="make-switch has-switch" data-on="danger" data-off="default">
                                <?php echo __get_status($detail[0] -> tstatus,2); ?>
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
