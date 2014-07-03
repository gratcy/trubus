        <!--PAGE CONTENT -->
        <div id="content">
            <div class="inner">
                <div class="row">
                    <div class="col-lg-12">
                        <h2> Raw Material </h2>
                    </div>
                </div>

                <hr />
                <a href="<?php echo site_url('rawmaterial/rawmaterial_add'); ?>" class="btn btn-default btn-grad"><i class="icon-plus"></i> Add Raw Material</a>
                <br />
                <br />
	<?php echo __get_error_msg(); ?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Raw Material
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
          <th>Branch</th>
          <th>Material Type</th>
          <th>Material Code</th>
          <th>Material Name</th>
          <th>Status</th>
          <th style="width: 50px;"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
		  <?php
		  foreach($rawmaterial as $k => $v) :
		  ?>
                                        <tr>
          <td><?php echo $v -> bname; ?></td>
          <td><?php echo $v -> cname; ?></td>
          <td><?php echo $v -> rcode; ?></td>
          <td><?php echo $v -> rname; ?></td>
          <td><?php echo __get_status($v -> rstatus,1); ?></td>
		  <td>
              <a href="<?php echo site_url('rawmaterial/rawmaterial_update/' . $v -> rid); ?>"><i class="icon-pencil"></i></a>
              <a href="<?php echo site_url('rawmaterial/rawmaterial_delete/' . $v -> rid); ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="icon-remove"></i></a>
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
