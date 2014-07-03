
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Private Messages - <?php echo($type == 2 ? 'Outbox' : 'Inbox'); ?>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo site_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Private Messages</li>
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
                <a href="<?php echo site_url('pm/pm_new'); ?>" class="btn btn-default"><i class="fa fa-plus"></i> New Private Messages</a></h3>
                                </div><!-- /.box-header -->
                                <div class="box-body">
                                    <table class="table table-bordered">
                                    <thead>
                                        <tr>
          <th>Date</th>
          <th>From</th>
          <th>Subject</th>
          <th>Messages</th>
          <th style="width: 50px;"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
		  <?php
		  foreach($pm as $k => $v) :
		  ?>
          <tr style="<?php echo ($v -> pstatus == 0 && $type == 1 ? 'background:#F0F0F0;' : '');?>">
          <td><a href="<?php echo site_url('pm/pm_read/' . $v -> pid);?>"><?php echo __get_date($v -> pdate,1); ?></a></td>
          <td><a href="<?php echo site_url('pm/pm_read/' . $v -> pid);?>"><?php echo $v -> ufrom; ?></a></td>
          <td><a href="<?php echo site_url('pm/pm_read/' . $v -> pid);?>"><?php echo $v -> psubject; ?></a></td>
          <td><a href="<?php echo site_url('pm/pm_read/' . $v -> pid);?>"><?php echo substr($v -> pmsg,0,30); ?></a></td>
		  <td>
              <a href="<?php echo site_url('pm/pm_delete/' . $v -> pid); ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-times"></i></a>
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
