            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Stock Customer Add
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo site_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="<?php echo site_url('inventory'); ?>">Stock Customer</a></li>
                        <li class="active">Stock Customer Add</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
	<?php echo __get_error_msg(); ?>
<div class="box box-primary">
                                <!-- form start -->
                                 <form role="form" action="<?php echo site_url('inventory_customer/inventory_customer_add'); ?>" method="post">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label>Book</label>
                                            <select class="form-control" name="book">
												<?php echo $books; ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Customer</label>
                                            <select class="form-control" name="cid" >
												<?php echo $customer; ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Stock Begining</label>
                        <input type="text" placeholder="Stock Begining" name="sbegin" class="form-control" />
                                        </div>
                                        <div class="form-group">
                                            <label>Stock In</label>
                        <input type="text" placeholder="Stock In" name="sin" class="form-control" />
                                        </div>
                                        <div class="form-group">
                                            <label>Stock Out</label>
                        <input type="text" placeholder="Stock Out" name="sout" class="form-control" />
                                        </div>
                                        <div class="form-group">
                                            <label>Stock Reject</label>
                        <input type="text" placeholder="Stock Reject" name="sreject" class="form-control" />
                                        </div>
                                        <div class="form-group">
                                            <label>Stock Final</label>
                        <input type="text" placeholder="Stock Final" name="sfinal" class="form-control" />
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
