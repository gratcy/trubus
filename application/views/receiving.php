
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Item Receiving
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo site_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Item Receiving</li>
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
                <a href="<?php echo site_url('receiving/receiving_add'); ?>" class="btn btn-default"><i class="fa fa-plus"></i> Add Item Receiving</a></h3>
                <h3 class="box-title">
                <a href="<?php echo site_url('receiving/export/excel'); ?>" class="btn btn-default"><i class="fa fa-file"></i> Export Excel</a>
                </h3>
                                </div><!-- /.box-header -->
                                <div class="box-body">
                                    <table class="table table-bordered">
                                    <thead>
                                        <tr>
          <th>Doc No.</th>
          <th>Type</th>
          <th>Request No. / Publisher</th>
          <th>Date</th>
          <th>Description</th>
          <th>Status</th>
          <th style="width: 100px;"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
		  <?php
		  foreach($receiving as $k => $v) :
		  ?>
                                        <tr>
          <td><?php echo $v -> rdocno; ?></td>
          <td><?php echo __get_receiving_type($v -> rtype,1); ?></td>
          <td><?php echo __get_receiving_name($v -> riid, $v -> rtype); ?></td>
          <td><?php echo __get_date($v -> rdate); ?></td>
          <td><?php echo $v -> rdesc; ?></td>
          <td><?php echo ($v -> rstatus == 3 ? '<span style="color:#9e3;font-weight:bold;">Approved</span>' : __get_status($v -> rstatus,1)); ?></td>
		  <td style="text-align:center;">
			  <?php if ($v -> rstatus != 3) : ?>
              <a href="<?php echo site_url('receiving/receiving_update/' . $v -> rid); ?>"><i class="fa fa-pencil"></i></a>
              <a href="<?php echo site_url('receiving/receiving_delete/' . $v -> rid); ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-times"></i></a>
              <?php else : ?>
              <a href="<?php echo site_url('receiving/receiving_detail/' . $v -> rid); ?>"><i class="fa fa-book"></i></a>
			   <a href="<?php echo site_url('receiving/export/excel_detail/' . $v -> rid); ?>"><i class="fa fa-file"></i></a>
              <a href="javascript:void(0);" onclick="print_data('<?php echo site_url('printpage/receiving/' . $v -> rid); ?>');"><i class="fa fa-print"></i></a>
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
