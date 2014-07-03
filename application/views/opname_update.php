            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Stock Adjustment
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo site_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="<?php echo site_url('opname'); ?>">Stock Opname</a></li>
                        <li class="active">Stock Adjustment</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
	<?php echo __get_error_msg(); ?>
<div class="box box-primary">
                                <!-- form start -->
                                 <form role="form" action="<?php echo site_url('opname/opname_update'); ?>" method="post">
<input type="hidden" name="id" value="<?php echo $id; ?>">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label>Book</label>
                                            <select class="form-control" name="book" disabled>
												<?php echo $books; ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Branch</label>
                                            <select multiple class="form-control" name="branch" disabled>
												<?php echo $branch; ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Stock Begining</label>
                        <input type="text" placeholder="Stock Begining" name="sbegin" class="form-control" value="<?php echo $detail[0] -> istockbegining; ?>" />
                        <input type="hidden" name="sbegin2" value="<?php echo $detail[0] -> istockbegining; ?>" />
                                        </div>
                                        <div class="form-group">
                                            <label>Stock In</label>
                        <input type="text" placeholder="Stock In" name="sin" class="form-control" value="<?php echo $detail[0] -> istockin; ?>" />
                        <input type="hidden" name="sin2" value="<?php echo $detail[0] -> istockin; ?>" />
                                        </div>
                                        <div class="form-group">
                                            <label>Stock Out</label>
                        <input type="text" placeholder="Stock Out" name="sout" class="form-control" value="<?php echo $detail[0] -> istockout; ?>" />
                        <input type="hidden" name="sout2" value="<?php echo $detail[0] -> istockout; ?>" />
                                        </div>
                                        <div class="form-group">
                                            <label>Stock Reject</label>
                        <input type="text" placeholder="Stock Reject" name="sreject" class="form-control" value="<?php echo $detail[0] -> istockreject; ?>" />
                        <input type="hidden" name="sreject2" value="<?php echo $detail[0] -> istockreject; ?>" />
                                        </div>
                                        <div class="form-group">
                                            <label>Stock Final</label>
                        <input type="text" placeholder="Stock Final" name="sfinal" class="form-control" value="<?php echo $detail[0] -> istock; ?>" />
                        <input type="hidden" name="sfinal2" value="<?php echo $detail[0] -> istock; ?>" />
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
