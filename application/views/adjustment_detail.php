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
                                 <form role="form" action="<?php echo site_url('area/area_add'); ?>" method="post">
<input type="hidden" name="id" value="<?php echo $id; ?>">
										<input type="hidden" name="branch" value="<?php echo $detail[0] -> ibcid; ?>">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label class="control-label col-lg-2">Adjustment Min (-)</label>
											<div class="col-xs-4">
											<input type="text" placeholder="Adjustment Min (-)" name="min" class="form-control" />
											</div>
                                        </div>
                                        <div style="clear:both"></div>
                                        <br />
                                        <div class="form-group">
                                            <label class="control-label col-lg-2">Adjustment Plus (+)</label>
											<div class="col-xs-4">
											<input type="text" placeholder="Adjustment Plus (+)" name="plus" class="form-control" />
											</div>
                                        </div>
									</div>
									<p>&nbsp;</p>
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

