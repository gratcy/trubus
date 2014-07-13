
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Report Opname Customer
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo site_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Report Opname Customer</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
						<form action="<?php echo site_url('reportopnamecustomer/sortreport/'); ?>" method="post">
                        <div class="col-xs-6">

                                    <div class="form-group">
                                        <label>Date range:</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="text" class="form-control pull-right" id="datesort" name="datesort" autocomplete="off" />
                                        </div><!-- /.input group -->
                        <button class="btn text-muted text-center btn-danger" type="submit" style="position: relative;
top: -34px;
float: right;">Go!</button>
                                    </div><!-- /.form group -->
						</div>
						</div>
						</form>
						<br />
                    <div class="row">
                        <div class="col-xs-12">
	<?php echo __get_error_msg(); ?>
							<div class="box">
                                <div class="box-body">
                                    <table class="table table-bordered">
                                    <thead>
                                        <tr>
          <th>Customer</th>
          <th>Title</th>
          <th>Stock Begining</th>
          <th>Stock In</th>
          <th>Stock Out</th>
          <th>Stock Reject</th>
          <th>Stock Retur</th>
          <th>Stock Final</th>
                                        </tr>
                                    </thead>
                                    <tbody>
		  <?php
		  foreach($reportopnamecustomer as $k => $v) :
		  ?>
                                        <tr>
          <td><?php echo $v -> cname; ?></td>
          <td><?php echo $v -> btitle; ?></td>
          <td><?php echo $v -> ostockbegining; ?></td>
          <td><?php echo $v -> ostockin; ?></td>
          <td><?php echo $v -> ostockout; ?></td>
          <td><?php echo $v -> ostockreject; ?></td>
          <td><?php echo $v -> ostockretur; ?></td>
          <td><?php echo $v -> ostock; ?></td>
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
	$('#datesort').daterangepicker();
});
</script>
