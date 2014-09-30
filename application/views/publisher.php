
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Publisher
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo site_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Publisher</li>
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
                <a href="<?php echo site_url('publisher/publisher_add'); ?>" class="btn btn-default"><i class="fa fa-plus"></i> Add Publisher</a></h3>
                                </div><!-- /.box-header -->
                                <div class="box-body">
                                    <table class="table table-bordered">
                                    <thead>
                                        <tr>
          <th>Code</th>
          <th>Name</th>
		  <th>Category</th>
          <th>Email</th>
          <th>Phone</th>
          <th>Contact Person</th>
          <th>Address</th>
          <th>City</th>
          <th>Prov</th>
          <th>Status</th>
          <th style="width: 50px;"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
		  <?php
		  foreach($publisher as $k => $v) :
		  $phone = explode('*', $v -> pphone);
		  ?>
                                        <tr>
          <td><?php echo $v -> pcode; ?></td>
          <td><?php echo $v -> pname; ?></td>
		  <td><?php echo __get_publisher_type($v -> ptype,1); ?></td>
          <td><?php echo $v -> pemail; ?></td>
          <td><?php echo $phone[0] . '/' . $phone[1]; ?></td>
          <td><?php echo $v -> pcp . ' (' . $phone[2] . ')'; ?></td>
          <td><?php echo $v -> paddr; ?></td>
          <td><?php echo __get_cities($v -> pcity,1); ?></td>
          <td><?php echo __get_province($v -> pprov,1); ?></td>
          <td><?php echo __get_status($v -> pstatus,1); ?></td>
		  <td>
              <a href="<?php echo site_url('publisher/publisher_update/' . $v -> pid); ?>"><i class="fa fa-pencil"></i></a>
              <a href="<?php echo site_url('publisher/publisher_delete/' . $v -> pid); ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-times"></i></a>
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
