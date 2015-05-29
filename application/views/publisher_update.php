<?php
$phone = explode('*', $detail[0] -> pphone);
?>
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Publisher Update
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo site_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="<?php echo site_url('publisher'); ?>">Publisher</a></li>
                        <li class="active">Publisher Update</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
	<?php echo __get_error_msg(); ?>
<div class="box box-primary">
                                <!-- form start -->
                                 <form role="form" action="<?php echo site_url('publisher/publisher_update'); ?>" method="post">
<input type="hidden" name="id" value="<?php echo $id; ?>">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label>Name</label>
                        <input type="text" placeholder="publisher Name" name="name" class="form-control" value="<?php echo $detail[0] -> pname; ?>" />
                                        </div>
                                        <div class="form-group">
                                            <label>Parent</label>
                        <select name="parent" class="form-control"><?php echo $pub; ?></select>
                                        </div>
                                        <div class="form-group" id="mcode">
                                            <label>Code</label>
                        <input type="text" placeholder="Code" name="code" class="form-control" value="<?php echo $detail[0] -> pcode; ?>" />
                                        </div>
                                        <div class="form-group">
                                            <label>Category</label>
                        <select name="category" class="form-control">
<?php echo __get_publisher_category($detail[0] -> pcategory,2); ?>
						</select>
                                        </div>
                                        <div class="form-group">
                                            <label>Address</label>
						<textarea name="addr" class="form-control" placeholder="Address"><?php echo $detail[0] -> paddr; ?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>City</label>
                        <select name="city" class="form-control"><?php echo $city; ?></select>
                                        </div>
                                        <div class="form-group">
                                            <label>Province</label>
                        <select name="prov" class="form-control"><?php echo $province; ?></select>
                                        </div>
                                        <div class="form-group">
                                            <label>Phone</label>
                        <input type="text" placeholder="Phone" name="phone1" class="form-control" value="<?php echo $phone[0]; ?>" />
                                        </div>
                                        <div class="form-group">
                                            <label>Fax</label>
                        <input type="text" placeholder="Fax" name="phone2" class="form-control" value="<?php echo $phone[1]; ?>" />
                                        </div>
                                        <div class="form-group">
                                            <label>Email</label>
                        <input type="text" placeholder="Email" name="email" class="form-control" value="<?php echo $detail[0] -> pemail; ?>" />
                                        </div>
                                        <div class="form-group">
                                            <label>NPWP</label>
                        <input type="text" placeholder="NPWP" name="npwp" class="form-control" value="<?php echo $detail[0] -> pnpwp; ?>" />
                                        </div>
                                        <div class="form-group">
                                            <label>Credit Limit</label>
                        <input type="text" placeholder="Credit Limit" name="climit" class="form-control" value="<?php echo $detail[0] -> pcreditlimit; ?>" />
                                        </div>
                                        <div class="form-group">
                                            <label>Credit Duration (Days)</label>
                        <input type="text" placeholder="Credit Duration" name="cday" class="form-control" value="<?php echo $detail[0] -> pcreditday; ?>" />
                                        </div>
                                        <div class="form-group">
                                            <label>Contact Person</label>
                        <input type="text" placeholder="Contact Person" name="cp" class="form-control" value="<?php echo $detail[0] -> pcp; ?>" />
                                        </div>
                                        <div class="form-group">
                                            <label>Contact Person Phone</label>
                        <input type="text" placeholder="Contact Person Phone" name="phone3" class="form-control" value="<?php echo $phone[2]; ?>" />
                                        </div>
                                        <div class="form-group">
                                            <label>Description</label>
						<textarea name="desc" class="form-control" placeholder="Description"><?php echo $detail[0] -> pdesc; ?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Status</label>
                                            <?php echo __get_status($detail[0] -> pstatus,2); ?>
                                        </div>
                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
                                        <button type="submit" class="btn btn-primary"> <i class="fa fa-save"></i> Submit</button>
										<button class="btn btn-default" type="button" onclick="location.href='javascript:history.go(-1);'">Back</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </section><!-- /.content -->
            </aside><!-- /.right-side -->

<script>
$('select[name="parent"]').change(function(){
	if ($(this).val() == 0) $('#mcode').css('display', 'block');
	else $('#mcode').css('display', 'none');
});
$('select[name="parent"]').change();
</script>
