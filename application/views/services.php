        <!--PAGE CONTENT -->
        <div id="content">
            <div class="inner">
                <div class="row">
                    <div class="col-lg-12">
                        <h2> Services </h2>
                    </div>
                </div>

                <hr />
                <a href="<?php echo site_url('services/services_add'); ?>" class="btn btn-default btn-grad"><i class="icon-plus"></i> Add Service</a>
                <br />
                <br />
	<?php echo __get_error_msg(); ?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Services
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
          <th>Branch</th>
          <th>Date</th>
          <th>Product</th>
          <th>QTY</th>
          <th>No Serial</th>
          <th>Condition</th>
          <th>Duration</th>
          <th>Status</th>
          <th style="width: 50px;"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
		  <?php
		  foreach($services as $k => $v) :
		  ?>
                                        <tr>
          <td><?php echo $v -> bname; ?></td>
          <td><?php echo __get_date($v -> sdate); ?></td>
          <td><?php echo $v -> pname; ?></td>
          <td><?php echo $v -> sqty; ?></td>
          <td><?php echo $v -> snoseri; ?></td>
          <td><?php echo __get_condition_services($v -> scondition,1); ?></td>
          <td><?php echo __get_date($v -> sdatefrom,1) . ' &raquo; ' . __get_date($v -> sdateto,1); ?></td>
          <td><?php echo __get_status($v -> sstatus,1); ?></td>
		  <td>
              <a href="<?php echo site_url('services/services_update/' . $v -> sid); ?>"><i class="icon-pencil"></i></a>
              <a href="<?php echo site_url('services/services_delete/' . $v -> sid); ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="icon-remove"></i></a>
          </td>
										</tr>
        <?php endforeach; ?>
                                    </tbody>
                                </table>
    <?php echo $pages; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        </div>
       <!--END PAGE CONTENT -->
