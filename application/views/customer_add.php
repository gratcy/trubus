
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Customer Add
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo site_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="<?php echo site_url('customer'); ?>">Customer</a></li>
                        <li class="active">Customer Add</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
	<?php echo __get_error_msg(); ?>
<div class="box box-primary">
                                <!-- form start -->
                                 <form role="form" action="<?php echo site_url('customer/customer_add'); ?>" method="post">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label>Branch</label>
                                            <select multiple class="form-control" name="branch">
												<?php echo $branch; ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Area</label>
                                            <select class="form-control" name="area">
												<?php echo $area; ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Name</label>
                        <input type="text" placeholder="Customer Name" name="name" class="form-control" />
                                        </div>
                                        <div class="form-group">
                                            <label>NPWP</label>
                        <input type="text" placeholder="Customer NPWP" name="npwp" class="form-control" />
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
                                            <label>Phone I</label>
                        <input type="text" placeholder="Phone I" name="phone1" class="form-control" />
                                        </div>
                                        <div class="form-group">
                                            <label>Phone II</label>
                        <input type="text" placeholder="Phone II" name="phone2" class="form-control" />
                                        </div>
                                        <div class="form-group">
                                            <label>Email</label>
                        <input type="text" placeholder="Email" name="email" class="form-control" />
                                        </div>
                                        <div class="form-group">
                                            <label>Discount</label>
                        <input type="text" placeholder="Discount" name="disc" class="form-control" />
                                        </div>
                                        <div class="form-group">
                                            <label>Credit Limit</label>
                        <input type="text" placeholder="Credit Limit" name="limit" class="form-control" />
                                        </div>
                                        <div class="form-group">
                                            <label>Credit Tenor</label>
                        <input type="text" placeholder="Credit Tenor" name="tenor" class="form-control" />
                                        </div>
                                        <div class="form-group">
                                            <label>Tax</label>
                                            <?php echo __get_tax(0,2); ?>
                                        </div>
                                        <div class="form-group">
                                            <label>Customer Type</label>
                                            <?php echo __get_customer_type(0,2); ?>
                                        </div>
                                        <div class="form-group">
                                            <label>Description</label>
											<textarea name="desc" class="form-control" placeholder="Description"></textarea>
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
