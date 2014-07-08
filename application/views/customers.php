        <!--PAGE CONTENT -->
        <div id="content">
            <div class="inner">
                <div class="row">
                    <div class="col-lg-12">
                        <h2> Customers </h2>
                    </div>
                </div>

                <hr />
                <a href="<?php echo site_url('customers/customers_add'); ?>" class="btn btn-default btn-grad"><i class="icon-plus"></i> Add Customer</a>
                <br />
                <br />
	<?php echo __get_error_msg(); ?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Customers
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
          <th>Code</th>
          <th>Branch</th>
          <th>Name</th>
          <th>Address</th>
          <th>Address II</th>
          <th>City</th>
          <th>Province</th>
          <th>Phone I</th>
          <th>Phone II</th>
          <th>Status</th>
          <th style="width: 50px;"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
		  <?php
		  foreach($customers as $k => $v) :
		  $phone = explode('*', $v -> cphone);
		  $addr = explode('*', $v -> caddr);
		  ?>
                                        <tr>
          <td><?php echo $v -> ccode; ?></td>
          <td><?php echo $v -> bname; ?></td>
          <td><?php echo $v -> cname; ?></td>
          <td><?php echo $addr[0]; ?></td>
          <td><?php echo $addr[1]; ?></td>
          <td><?php echo __get_cities($v -> ccity,1); ?></td>
          <td><?php echo __get_province($v -> cprov,1); ?></td>
          <td><?php echo $phone[0]; ?></td>
          <td><?php echo $phone[1]; ?></td>
          <td><?php echo __get_status($v -> cstatus,1); ?></td>
		  <td>
              <a href="<?php echo site_url('customers/customers_update/' . $v -> cid); ?>"><i class="icon-pencil"></i></a>
              <a href="<?php echo site_url('customers/customers_delete/' . $v -> cid); ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="icon-remove"></i></a>
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
