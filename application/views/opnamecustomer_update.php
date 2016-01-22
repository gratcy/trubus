            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Stock Opname Customer
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo site_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="<?php echo site_url('opnamecustomer'); ?>">Stock Opname Customer</a></li>
                        <li class="active">Stock Opname Customer</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
	<?php echo __get_error_msg(); ?>
<div class="box box-primary">
                                <!-- form start -->
                                    <div class="box">
                                    <div class="box-body">
										
											<table class="table table-bordered">
											<tr>
											<th>Books Title</th>
											<th>Books Code</th>
											<th>Books Author</th>
											</tr>
											<tr>
											<td><?php echo $books[0] -> btitle; ?></td>
											<td><?php echo $books[0] -> bcode; ?></td>
											<td><?php echo $books[0] -> bauthor; ?></td>
											</tr>
											</table>
											<p>&nbsp;</p>
											<table class="table table-bordered">
											<tr>
											<th>Stock Begining</th>
											<th>Stock In</th>
											<th>Stock Out</th>
											<th>Stock Reject</th>
											<th>Stock Retur</th>
											<th>Stock Final</th>
											</tr>
											<tr>
											<td><?php echo $detail[0] -> istockbegining; ?></td>
											<td><?php echo $detail[0] -> istockin; ?></td>
											<td><?php echo $detail[0] -> istockout; ?></td>
											<td><?php echo $detail[0] -> istockreject; ?></td>
											<td><?php echo $detail[0] -> istockretur; ?></td>
											<td><?php echo $detail[0] -> istock; ?></td>
											</tr>
											</table>
										</div>
										</div>
                                 <form role="form" action="<?php echo site_url('opnamecustomer/opnamecustomer_update'); ?>" method="post">
<input type="hidden" name="id" value="<?php echo $id; ?>">
										<input type="hidden" name="branch" value="<?php echo $detail[0] -> ibcid; ?>">
										<input type="hidden" name="sbegin2" value="<?php echo $detail[0] -> istockbegining; ?>" />
										<input type="hidden" name="sin2" value="<?php echo $detail[0] -> istockin; ?>" />
										<input type="hidden" name="sout2" value="<?php echo $detail[0] -> istockout; ?>" />
										<input type="hidden" name="sreject2" value="<?php echo $detail[0] -> istockreject; ?>" />
										<input type="hidden" name="sretur2" value="<?php echo $detail[0] -> istockretur; ?>" />
										<input type="hidden" name="sfinal2" value="<?php echo $detail[0] -> istock; ?>" />
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label class="control-label col-lg-2">Adjustment Min (-)</label>
											<div class="col-xs-4">
											<input type="text" placeholder="Adjustment Min (-)" name="adjustmin" class="form-control" />
											</div>
                                        </div>
                                        <div style="clear:both"></div>
                                        <br />
                                        <div class="form-group">
                                            <label class="control-label col-lg-2">Adjustment Plus (+)</label>
											<div class="col-xs-4">
											<input type="text" placeholder="Adjustment Plus (+)" name="adjustplus" class="form-control" />
											</div>
                                        </div>
                                        <div style="clear:both"></div>
                                        <br />
                                        <div class="form-group">
                                            <label class="control-label col-lg-2">Description</label>
											<div class="col-xs-4">
												<textarea name="desc" class="form-control" placeholder="Description"></textarea>
											</div>
                                        </div>
									<div style="clear:both"></div>
                                        <br />
                                    <div class="box-footer">
                                            <label class="control-label col-lg-2"></label>
											<div class="col-xs-4">
											<button type="submit" class="btn btn-primary"> <i class="fa fa-save"></i> Submit</button>
											<button class="btn btn-default" type="button" onclick="location.href='javascript:history.go(-1);'">Back</button>
										</div>
                                    </div>
                                </form>
                                        <div style="clear:both"></div>
                                        <br />
                            </div>
                        </div>
                    </div>

                </section><!-- /.content -->
            </aside><!-- /.right-side -->

