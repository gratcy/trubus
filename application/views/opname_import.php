            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Opname Import
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo site_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="<?php echo site_url('opname'); ?>">Stock Opname</a></li>
                        <li class="active">Opname Import</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
	<?php echo __get_error_msg(); ?>
<div class="box box-primary">
                                <!-- form start -->
                                 <form role="form" action="<?php echo site_url('opname/opname_import'); ?>" method="post" enctype="multipart/form-data">
												<input type="hidden" name="type" value="1">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label class="control-label col-lg-2">File Excel</label>
											<div class="col-xs-4">
											<input type="file" placeholder="File Excel" name="name" class="form-control" />
											</div>
                                        </div>
									<div style="clear:both"></div>
                                        <br />
                                    <div class="box-footer">
                                            <label class="control-label col-lg-2"></label>
											<div class="col-xs-8">
											<button type="submit" class="btn btn-primary"> <i class="fa fa-save"></i> Submit</button>
											<button class="btn btn-default" type="button" onclick="location.href='javascript:history.go(-1);'">Back</button>
										</div>
										</div>
                                    </div>
                                </form>
								<div style="clear:both"></div>
								<br />
                            </div>
                            <?php if ($books) : ?>
                    <div class="row">
						<form action="<?php echo site_url('opname/opname_import_search/'); ?>" method="post">
                <div class="form-group">
                    <label for="text1" class="control-label col-lg-1">Title/Code</label>
                        <div class="col-xs-4">
                        <input type="text" style="width:200px!important;display:inline!important;" placeholder="Title/Code" name="bname" class="form-control" autocomplete="off" />
                        <button class="btn text-muted text-center btn-danger" type="submit">Go!</button>
                        <span id="sg1"></span>
                        <input type="hidden" name="bid" />
						</div>
						</div>
						</form>
						</div>
						<br />
                                 <form role="form1" action="<?php echo site_url('opname/opname_import'); ?>" method="post">
								<input type="hidden" name="type" value="2">
							<div class="box">
                                <div class="box-body table-responsive">
                            
                                    <table class="table table-bordered">
                                    <thead>
                                        <tr>
											<th>Code</th>
											<th>Title</th>
											<th>Stock Left</th>
											<th style="text-align:center;">QTY</th>
											<th style="text-align:center;">Diff</th>
											<th style="text-align:center;">Adjustment (-)</th>
											<th style="text-align:center;">Adjustment (+)</th>
										</tr>
									</thead>
											<tbody>
												<?php
												foreach($books as $k => $v) :
												$left = ($v -> istock - __get_stock_process($v -> ibcid, $v -> ibid,1));
												$op = __calc_opname($opname[$v -> ibid], $left);
												?>
												<input type="hidden" name="iid[]" value="<?php echo $v -> iid; ?>">
								<input type="hidden" name="stockbegining[<?php echo $v -> iid; ?>]" value="<?php echo $v -> istockbegining; ?>">
								<input type="hidden" name="stockin[<?php echo $v -> iid; ?>]" value="<?php echo $v -> istockin; ?>">
								<input type="hidden" name="stockout[<?php echo $v -> iid; ?>]" value="<?php echo $v -> istockout; ?>">
								<input type="hidden" name="stockretur[<?php echo $v -> iid; ?>]" value="<?php echo $v -> istockretur; ?>">
								<input type="hidden" name="stockreject[<?php echo $v -> iid; ?>]" value="<?php echo $v -> istockreject; ?>">
								<input type="hidden" name="stockfinale[<?php echo $v -> iid; ?>]" value="<?php echo $v -> istock; ?>">
												<tr>
												<td><?php echo $v -> bcode; ?></td>
												<td><?php echo $v -> btitle; ?></td>
												<td><?php echo $left; ?></td>
												<td><input type="number" value="<?php echo $opname[$v -> ibid]; ?>" name="qty[<?php echo $v -> ibid?>][<?php echo $v -> iid; ?>]" class="form-control" style="width:100px" /></td>
												<td><?php echo $op; ?></td>
												<td><?php echo ($opname[$v -> ibid] < $left ? ($op > 0 ? $op : substr($op,1)) : 0); ?></td>
												<td><?php echo ($opname[$v -> ibid] > $left ? ($op > 0 ? $op : substr($op,1)) : 0); ?></td>
												</tr>
												<input type="hidden" name="amin[<?php echo $v -> iid; ?>]" value="<?php echo ($opname[$v -> ibid] < $left ? ($op > 0 ? $op : substr($op,1)) : 0); ?>">
												<input type="hidden" name="aplus[<?php echo $v -> iid; ?>]" value="<?php echo ($opname[$v -> ibid] > $left ? ($op > 0 ? $op : substr($op,1)) : 0); ?>">
												<?php
												endforeach;
												?>
											</tbody>
									</table>
                            </div>
									<div class="box-footer clearfix isthere">
                                    <ul class="pagination pagination-sm no-margin pull-right">
                                        <?php echo $pages; ?>
                                    </ul>
									<button type="button" id="approved" class="btn btn-warning" onclick="return confirm('Anda yakin ingin semua data sudah valid?');"> <i class="fa fa-check"></i> Approved</button>
									<button type="submit" class="btn btn-primary"> <i class="fa fa-refresh"></i> Calculate</button>
									<?php if ($isSearch) : ?>
									<button type="button" class="btn btn-default" onclick="location.href='<?php echo site_url('opname/opname_import'); ?>"> Back </button>
									<input type="hidden" name="issearch" value="1">
									<?php endif; ?>
									<button id="reset" type="button" class="btn btn-danger" onclick="return confirm('Anda yakin ingin mereset?');"> <i class="fa fa-info"></i>  Reset</button>
									</div>
                            </div>
                        </div>
                                </form>
                        <?php endif; ?>
                    </div>

                </section><!-- /.content -->
            </aside><!-- /.right-side -->
<script type="text/javascript">
$(function(){
	$('#approved').click(function(){
		$('form[role="form1"]').append('<input type="hidden" name="app" value="1">');
		$('form[role="form1"]').submit();
	});
	$('#reset').click(function(){
		$('form[role="form1"]').append('<input type="hidden" name="app" value="2">');
		$('form[role="form1"]').submit();
	});
	$('input[name="bname"]').sSuggestion('span#sg1','<?php echo site_url('books/get_suggestion'); ?>', 'bid');
});
</script>
