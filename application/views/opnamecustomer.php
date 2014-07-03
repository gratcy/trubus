
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Stock Opname Customer
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo site_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Stock Opname Customer</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
						<form action="<?php echo site_url('opnamecustomer/search_customer/'); ?>" method="post">
                <div class="form-group">
                    <label for="text1" class="control-label col-lg-1">Name</label>
                        <div class="col-xs-4">
                        <input type="text" style="width:200px!important;display:inline!important;" placeholder="To" name="cname" class="form-control" autocomplete="off" />
                        <button class="btn text-muted text-center btn-danger" type="submit">Go!</button>
                        <span id="sg1"></span>
                        <input type="hidden" name="cid" />
						</div>
						</div>
						</form>
						</div>
						<br />
                    <div class="row">
                        <div class="col-xs-12">
	<?php echo __get_error_msg(); ?>
							<div class="box">
                                <div class="box-body">
                                    <table class="table table-bordered">
                                    <thead>
                                        <tr>
          <th>Branch</th>
          <th>Name</th>
          <th>Group</th>
          <th>Area</th>
          <th>Status</th>
          <th style="width: 50px;"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
		  <?php
		  foreach($opnamecustomer as $k => $v) :
		  ?>
          <tr>
          <td><?php echo $v -> bname; ?></td>
          <td><?php echo $v -> cname; ?></td>
          <td><?php echo $v -> bgname; ?></td>
          <td><?php echo $v -> aname; ?></td>
          <td><?php echo __get_status($v -> cstatus,1); ?></td>
		  <td>
              <a href="<?php echo site_url('opnamecustomer/opnamecustomer_detail/' . $v -> cid); ?>"><i class="fa fa-book"></i></a>
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
	$('input[name="cname"]').sSuggestion('span#sg1','<?php echo site_url('customer/get_suggestion'); ?>', 'cid');
});
</script>
