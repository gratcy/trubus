
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Letter
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo site_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Letter</li>
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
                <a href="<?php echo site_url('letter/letter_add'); ?>" class="btn btn-default"><i class="fa fa-plus"></i> Add Letter</a></h3>
                                </div><!-- /.box-header -->
                                <div class="box-body">
                                    <table class="table table-bordered">
                                    <thead>
                                        <tr>
          <th>Type</th>
          <th>Request No. / Transaction No.</th>
          <th>Doc No.</th>
          <th>Date</th>
          <th>Description</th>
          <th>Status</th>
          <th style="width: 50px;"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
		  <?php
		  foreach($letter as $k => $v) :
		  ?>
                                        <tr>
          <td><?php echo __get_letter_type($v -> ltype,1); ?></td>
          <td><?php echo __get_letter_no($v -> liid, $v -> ltype); ?></td>
          <td><?php echo __get_letter_docno($v -> liid, $v -> ltype); ?></td>
          <td><?php echo __get_date($v -> ldate); ?></td>
          <td><?php echo $v -> ldesc; ?></td>
          <td><?php echo ($v -> lstatus == 3 ? '<span style="color:#9e3;font-weight:bold;">Approved</span>' : __get_status($v -> lstatus,1)); ?></td>
		  <td style="text-align:center;">
			  <?php if ($v -> lstatus != 3) : ?>
              <a href="<?php echo site_url('letter/letter_update/' . $v -> lid); ?>"><i class="fa fa-pencil"></i></a>
              <a href="<?php echo site_url('letter/letter_delete/' . $v -> lid); ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-times"></i></a>
              <?php else : ?>
              <a href="javascript:void(0);" onclick="print_data('<?php echo site_url('printpage/letter/' . $v -> lid); ?>', 'Print Surat Jalan');"><i class="fa fa-print"></i></a>
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
