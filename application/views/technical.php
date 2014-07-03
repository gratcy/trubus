        <!--PAGE CONTENT -->
        <div id="content">
            <div class="inner">
                <div class="row">
                    <div class="col-lg-12">
                        <h2> Technical </h2>
                    </div>
                </div>

                <hr />
                <a href="<?php echo site_url('technical/technical_add'); ?>" class="btn btn-default btn-grad"><i class="icon-plus"></i> Add Technical</a>
                <br />
                <br />
	<?php echo __get_error_msg(); ?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Technical
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
          <th>Branch</th>
          <th>Code</th>
          <th>Name</th>
          <th>Email</th>
          <th>Phone I</th>
          <th>Phone II</th>
          <th>Status</th>
          <th style="width: 50px;"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
		  <?php
		  foreach($technical as $k => $v) :
		  $phone = explode('*', $v -> tphone);
		  ?>
                                        <tr>
          <td><?php echo $v -> bname; ?></td>
          <td><?php echo $v -> tcode; ?></td>
          <td><?php echo $v -> tname; ?></td>
          <td><?php echo $v -> temail; ?></td>
          <td><?php echo $phone[0]; ?></td>
          <td><?php echo $phone[1]; ?></td>
          <td><?php echo __get_status($v -> tstatus,1); ?></td>
		  <td>
              <a href="<?php echo site_url('technical/technical_update/' . $v -> tid); ?>"><i class="icon-pencil"></i></a>
              <a href="<?php echo site_url('technical/technical_delete/' . $v -> tid); ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="icon-remove"></i></a>
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
