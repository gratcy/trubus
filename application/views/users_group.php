
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Users Group
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo site_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Users Group</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
	<?php echo __get_error_msg(); ?>
							<div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">
                <a href="<?php echo site_url('users/users_group_add'); ?>" class="btn btn-default"><i class="fa fa-plus"></i> Add Users Group</a></h3>
                                </div><!-- /.box-header -->
                                <div class="box-body">
                                    <table class="table table-bordered">
                                    <thead>
                                        <tr>
          <th>Group Name</th>
          <th>Description</th>
          <th>Status</th>
          <th style="width: 50px;"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
		  <?php foreach($group as $k => $v) : ?>
        <tr>
          <td><?php echo $v -> gname; ?></td>
          <td><?php echo $v -> gdesc; ?></td>
          <td><?php echo __get_status($v -> gstatus,1); ?></td>
          <td>
			 <?php if ($v -> gid <> 1) : ?>
              <a href="<?php echo site_url('users/users_group_update/' . $v -> gid); ?>"><i class="fa fa-pencil"></i></a>
              <a href="<?php echo site_url('users/users_group_delete/' . $v -> gid); ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-times"></i></a>
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
