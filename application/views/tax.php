
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Taxes
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo site_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Taxes</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
	<?php echo __get_error_msg(); ?>
							<div class="box">
                                <div class="box-header">
				<?php if (__get_roles('TaxesExecute')) : ?>
                                    <h3 class="box-title">
                <a href="<?php echo site_url('tax/tax_add'); ?>" class="btn btn-default"><i class="fa fa-plus"></i> Generate Tax No</a></h3>
                <?php endif; ?>
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <table class="table table-bordered">
                                    <thead>
                                        <tr>
          <th>Tax No</th>
          <th>Date</th>
          <th>Desc</th>
          <th>Status</th>
          <th style="width: 50px;"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
		  <?php
		  foreach($tax as $k => $v) :
		  ?>
                                        <tr>
          <td><?php echo $v -> ttax; ?></td>
          <td><?php echo __get_date($v -> tdate,3); ?></td>
          <td><?php echo substr($v -> tdesc,0,300); ?></td>
          <td><?php echo __get_status_tax($v -> tstatus); ?></td>
		  <td>
				<?php if (__get_roles('TaxesExecute')) : ?>
              <a href="<?php echo site_url('tax/tax_update/' . $v -> tid); ?>"><i class="fa fa-pencil"></i></a>
              <a href="<?php echo site_url('tax/tax_delete/' . $v -> tid); ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-times"></i></a>
                <?php endif; ?>
		</td>
										</tr>
        <?php endforeach; ?>
                                    </tbody>
                                    </table>
                                </div><!-- /.box-body -->
                                <div class="box-footer clearfix">
                                        <?php echo $pages; ?>
                                </div>
                            </div>
                        </div>
                    </div>

                </section><!-- /.content -->
            </aside><!-- /.right-side -->
