
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Promotion
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo site_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Promotion</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
	<?php echo __get_error_msg(); ?>
							<div class="box">
                                <div class="box-header">
				<?php if (__get_roles('PromotionExecute')) : ?>
                                    <h3 class="box-title">
                <a href="<?php echo site_url('promo/promo_add'); ?>" class="btn btn-default"><i class="fa fa-plus"></i> Add Promotion</a></h3>
                <?php endif; ?>
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <table class="table table-bordered">
                                    <thead>
                                        <tr>
          <th>Name</th>
          <th>Book</th>
          <th>Type</th>
          <th>Customer / Area</th>
          <th style="width: 50px;">Discount Publisher</th>
          <th style="width: 50px;">Discount Customer</th>
          <th style="width: 200px;">Periode</th>
          <th>Status</th>
          <th style="width: 50px;"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
		  <?php
		  foreach($promo as $k => $v) :
		  ?>
                                        <tr>
          <td><?php echo $v -> pname; ?></td>
          <td><?php echo $v -> btitle; ?></td>
          <td><?php echo __get_promo_type($v -> ptype,1); ?></td>
          <td><?php echo $v -> custarea; ?></td>
          <td><?php echo $v -> pdiscp; ?>%</td>
          <td><?php echo $v -> pdiscc; ?>%</td>
          <td><?php echo __get_date($v -> pfrom,1) . ' s/d ' .__get_date($v -> pto,1); ?></td>
          <td><?php echo __get_status($v -> pstatus,1); ?></td>
		  <td>
				<?php if (__get_roles('PromotionExecute')) : ?>
              <a href="<?php echo site_url('promo/promo_update/' . $v -> pid); ?>"><i class="fa fa-pencil"></i></a>
              <a href="<?php echo site_url('promo/promo_delete/' . $v -> pid); ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-times"></i></a>
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
