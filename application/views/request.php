
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Request
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo site_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Request</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
						<form action="<?php echo site_url('request/request_search/'); ?>" method="post">
                <div class="form-group">
                    <label for="text1" class="control-label col-lg-2">Request Code / Title</label>
                        <div class="col-xs-4">
                        <input type="text" style="width:200px!important;display:inline!important;" placeholder="Request Code / Title" name="keyword" class="form-control" autocomplete="off" />
                        <button class="btn text-muted text-center btn-danger" type="submit">Go!</button>
                        <span id="sg1"></span>
                        <input type="hidden" name="did" />
						</div>
						</div>
						</form>
						</div>
						<br />
                    <div class="row">
                        <div class="col-xs-12">
	<?php echo __get_error_msg(); ?>
							<div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">
                <a href="<?php echo site_url('request/request_add'); ?>" class="btn btn-default"><i class="fa fa-plus"></i> Add Request</a>
                </h3>
                <h3 class="box-title">
                <a href="<?php echo site_url('request/export/excel'); ?>" class="btn btn-default"><i class="fa fa-file"></i> Export Excel</a>
                </h3>
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <table class="table table-bordered">
                                    <thead>
                                        <tr>
          <th>Request No.</th>
          <th>Request Type</th>
          <th>Date</th>
          <th>Branch From</th>
          <th>Branch To</th>
          <th>Title</th>
          <th>Description</th>
          <th>Status</th>
          <th style="width: 100px;"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
		  <?php
		  foreach($request as $k => $v) :
		  ?>
                                        <tr>
          <td><?php echo ($v -> dtype == 1 ? 'R01' : 'R02').str_pad($v -> did, 4, "0", STR_PAD_LEFT); ?></td>
          <td><?php echo __get_request_type($v -> dtype,1); ?></td>
          <td><?php echo __get_date($v -> ddate); ?></td>
          <td><?php echo $v -> fbname; ?></td>
          <td><?php echo $v -> tbname; ?></td>
          <td><?php echo $v -> dtitle; ?></td>
          <td><?php echo $v -> ddesc; ?></td>
          <td><?php echo ($v -> dstatus == 3 ? '<span style="color:#9e3;font-weight:bold;">Approved</span>' : __get_status($v -> dstatus,1)); ?></td>
		  <td style="text-align:center;">
			  <?php if ($v -> dstatus != 3) : ?>
              <a href="<?php echo site_url('request/request_update/' . $v -> did); ?>"><i class="fa fa-pencil"></i></a>
              <a href="<?php echo site_url('request/request_delete/' . $v -> did); ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-times"></i></a>
              <?php else: ?>
              <a href="<?php echo site_url('request/request_detail/' . $v -> did); ?>"><i class="fa fa-book"></i></a>
			   <a href="<?php echo site_url('request/export/excel_detail/' . $v -> did); ?>"><i class="fa fa-file"></i></a>
              <a href="javascript:void(0);" onclick="print_data('<?php echo site_url('printpage/dist_request/' . $v -> did); ?>');"><i class="fa fa-print"></i></a>
              <?php endif; ?>
		</td>
										</tr>
        <?php endforeach; ?>
                                    </tbody>
                                    </table>
                                </div><!-- /.box-body -->
                                <div class="box-footer clearfix">
                                    <ul class="pagination pagination-sm no-margin pull-right">
                                        <?php echo $pages; ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </section><!-- /.content -->
            </aside><!-- /.right-side -->

<script type="text/javascript">
$(function(){
	$('input[name="keyword"]').sSuggestion('span#sg1','<?php echo site_url('request/get_suggestion'); ?>', 'did');
});
</script>
