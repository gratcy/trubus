
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Branch Add
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo site_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="<?php echo site_url('branch'); ?>">Branch</a></li>
                        <li class="active">Branch Add</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
	<?php echo __get_error_msg(); ?>
<div class="box box-primary">
                                <!-- form start -->
                                 <form role="form" action="<?php echo site_url('branch/branch_add'); ?>" method="post">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label>Head of Branch</label>
                        <input type="text" placeholder="Head of Branch" name="hname" class="form-control" />
                                        </div>
                                        <div class="form-group">
                                            <label>Code</label>
                        <input type="text" placeholder="Branch Code" name="code" class="form-control" />
                                        </div>
                                        <div class="form-group">
                                            <label>Name</label>
                        <input type="text" placeholder="Branch Name" name="name" class="form-control" />
                                        </div>
                                        <div class="form-group">
                                            <label>NPWP</label>
                        <input type="text" placeholder="Branch NPWP" name="npwp" class="form-control" />
                                        </div>
                                        <div class="form-group">
                                            <label>Address</label>
											<textarea name="addr" class="form-control" placeholder="Address"></textarea>
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
                        <input type="text" placeholder="Phone" name="phone1" class="form-control" />
                                        </div>
                                        <div class="form-group">
                                            <label>Fax</label>
                        <input type="text" placeholder="Fax" name="phone2" class="form-control" />
                                        </div>
                                        <div class="form-group">
                                            <label>Status</label>
                                            <?php echo __get_status(0,2); ?>
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
