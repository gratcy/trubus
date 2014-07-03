        <!--PAGE CONTENT -->
        <div id="content">
            <div class="inner">
                <div class="row">
                    <div class="col-lg-12">
                        <h2> Suplier </h2>
                    </div>
                </div>

                <hr />
                <a href="<?php echo site_url('suplier/suplier_add'); ?>" class="btn btn-default btn-grad"><i class="icon-plus"></i> Add Suplier</a>
                <br />
                <br />
	<?php echo __get_error_msg(); ?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Suplier
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
          <th>Code</th>
          <th>Name</th>
          <th>Phone I</th>
          <th>Phone II</th>
          <th>City</th>
          <th>Province</th>
          <th>Status</th>
          <th style="width: 50px;"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
		  <?php
		  foreach($suplier as $k => $v) :
		  $phone = explode('*', $v -> sphone);
		  ?>
                                        <tr>
          <td><?php echo $v -> scode; ?></td>
          <td><?php echo $v -> sname; ?></td>
          <td><?php echo $phone[0]; ?></td>
          <td><?php echo $phone[1]; ?></td>
          <td><?php echo __get_cities($v -> scity,1); ?></td>
          <td><?php echo __get_province($v -> sprov,1); ?></td>
          <td><?php echo __get_status($v -> sstatus,1); ?></td>
		  <td>
              <a href="<?php echo site_url('suplier/suplier_update/' . $v -> sid); ?>"><i class="icon-pencil"></i></a>
              <a href="<?php echo site_url('suplier/suplier_delete/' . $v -> sid); ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="icon-remove"></i></a>
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
