
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Journal
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo site_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Journal</li>
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
                <a href="<?php echo site_url('journal/journal_add'); ?>" class="btn btn-default"><i class="fa fa-plus"></i> Add Journal</a>
               
                <a href="<?php echo site_url('journal/journal_export'); ?>" class="btn btn-default"><i class="fa fa-book"></i> Export Excel</a>
                </h3>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
          <th>Date</th>
          <th>Post Date</th>
          <th>Type</th>
          <th>Title</th>
          <th>Description</th>
          <th>Status</th>
          <th style="width: 50px;"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
		  <?php
		  foreach($journal as $k => $v) :
		  ?>
                                        <tr>
          <td><?php echo __get_date($v -> gdate,1); ?></td>
          <td><?php echo ($v -> gpdate ? __get_date($v -> gpdate,1) : '-'); ?></td>
          <td><?php echo __get_transaction_type($v -> gtype,1); ?></td>
          <td><?php echo $v -> gtitle; ?></td>
          <td><?php echo substr($v -> gdesc,0,150); ?></td>
          <td><?php echo __get_status($v -> gstatus,1); ?></td>
		  <td style="text-align:center;">
			  <?php if ($v -> gpdate) : ?>
			  <a href="#"><i class="fa fa-check"></i></a>
			  <?php else : ?>
		  <a href="<?php echo site_url('journal/journal_update/' . $v -> gid); ?>"><i class="fa fa-pencil"></i></a>
		  <a href="<?php echo site_url('journal/journal_delete/' . $v -> gid); ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-times"></i></a>
		  <?php endif;?>
		</td>
										</tr>
        <?php endforeach; ?>
                                    </tbody>
                                </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </section><!-- /.content -->
            </aside><!-- /.right-side -->
