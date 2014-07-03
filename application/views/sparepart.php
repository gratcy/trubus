        <!--PAGE CONTENT -->
        <div id="content">
            <div class="inner">
                <div class="row">
                    <div class="col-lg-12">
                        <h2> Sparepart </h2>
                    </div>
                </div>

                <hr />
                <a href="<?php echo site_url('sparepart/sparepart_add'); ?>" class="btn btn-default btn-grad"><i class="icon-plus"></i> Add Sparepart</a>
                <br />
                <br />
	<?php echo __get_error_msg(); ?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Sparepart
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
          <th>Product</th>
          <th>Code</th>
          <th>Name</th>
          <th>No Component</th>
          <th style="text-align:center;">Price Agent</th>
          <th style="text-align:center;">Price Retail</th>
          <th>Status</th>
          <th style="width: 50px;"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
		  <?php
		  foreach($sparepart as $k => $v) :
		  ?>
                                        <tr>
          <td><?php echo $v -> pname; ?></td>
          <td><?php echo $v -> scode; ?></td>
          <td><?php echo $v -> sname; ?></td>
          <td><?php echo $v -> snocomponent; ?></td>
          <td style="text-align:right;"><?php echo __get_rupiah($v -> spriceagent,4); ?></td>
          <td style="text-align:right;"><?php echo __get_rupiah($v -> spriceretail,4); ?></td>
          <td><?php echo __get_status($v -> sstatus,1); ?></td>
		  <td>
              <a href="<?php echo site_url('sparepart/sparepart_update/' . $v -> sid); ?>"><i class="icon-pencil"></i></a>
              <a href="<?php echo site_url('sparepart/sparepart_delete/' . $v -> sid); ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="icon-remove"></i></a>
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
