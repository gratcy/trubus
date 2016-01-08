
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Users
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo site_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Users</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
						<form action="<?php echo site_url('customer/customer_search/'); ?>" method="post">
                <div class="form-group">
                    <label for="text1" class="control-label col-lg-1">Email</label>
                        <div class="col-xs-4">
                        <input type="text" style="width:200px!important;display:inline!important;" placeholder="Email" name="email" class="form-control" autocomplete="off" />
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
                                <div class="box-header">
                                    <h3 class="box-title">
                <a href="<?php echo site_url('users/users_add'); ?>" class="btn btn-default"><i class="fa fa-plus"></i> Add User</a></h3>
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <table class="table table-bordered">
                                    <thead>
                                        <tr>
          <th>Group</th>
          <th>Branch</th>
          <th>Email</th>
          <th>History IP Address</th>
          <th>History Date</th>
          <th>Status</th>
          <th style="width: 50px;"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
		  <?php
		  foreach($users as $k => $v) :
		  $hist = explode('*', $v -> ulastlogin);
		  ?>
                                        <tr>
          <td><?php echo $v -> gname; ?></td>
          <td><?php echo $v -> bname; ?></td>
          <td><?php echo $v -> uemail; ?></td>
          <td><?php echo (isset($hist[0]) && $hist[0] != '' ? long2ip($hist[0]) : ''); ?></td>
          <td><?php echo (isset($hist[1]) && $hist[1] != '' ? __get_date($hist[1],3) : ''); ?></td>
          <td><?php echo __get_status($v -> ustatus,1); ?></td>
											<td>
	<?php if ($v -> uid <> 1) : ?>
              <a href="<?php echo site_url('users/users_update/' . $v -> uid); ?>"><i class="fa fa-pencil"></i></a>
              <a href="<?php echo site_url('users/users_delete/' . $v -> uid); ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-times"></i></a>
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
	$('input[name="email"]').sSuggestion('span#sg1','<?php echo site_url('users/get_suggestion'); ?>', 'cid');
});
</script>
