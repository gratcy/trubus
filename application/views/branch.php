
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Branch
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo site_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Branch</li>
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
                <a href="<?php echo site_url('branch/branch_add'); ?>" class="btn btn-default"><i class="fa fa-plus"></i> Add Branch</a></h3>
                                </div><!-- /.box-header -->
                                <div class="box-body">
                                    <table class="table table-bordered">
                                    <thead>
                                        <tr>
          <th>Branch</th>
          <th>NPWP</th>
          <th>Address</th>
          <th>City</th>
          <th>Province</th>
          <th>Phone I</th>
          <th>Phone II</th>
          <th>Status</th>
          <th style="width: 50px;"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
		  <?php
		  foreach($branch as $k => $v) :
		  $phone = explode('*', $v -> bphone);
		  ?>
                                        <tr>
          <td><?php echo $v -> bname; ?></td>
          <td><?php echo $v -> bnpwp; ?></td>
          <td><?php echo $v -> baddr; ?></td>
          <td><?php echo __get_cities($v -> bcity,1); ?></td>
          <td><?php echo __get_province($v -> bprovince,1); ?></td>
          <td><?php echo $phone[0]; ?></td>
          <td><?php echo $phone[1]; ?></td>
          <td><?php echo __get_status($v -> bstatus,1); ?></td>
		  <td>
	<?php if ($v -> bid <> 1) : ?>
              <a href="<?php echo site_url('branch/branch_update/' . $v -> bid); ?>"><i class="fa fa-pencil"></i></a>
              <a href="<?php echo site_url('branch/branch_delete/' . $v -> bid); ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-times"></i></a>
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
