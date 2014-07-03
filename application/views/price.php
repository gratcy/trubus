        <!--PAGE CONTENT -->
        <div id="content">
            <div class="inner">
                <div class="row">
                    <div class="col-lg-12">
                        <h2> Price <?php echo __get_price_type($type); ?></h2>
                    </div>
                </div>

                <hr />
                <a href="<?php echo site_url('price/price_add/' . $type); ?>" class="btn btn-default btn-grad"><i class="icon-plus"></i> Add Price <?php echo __get_price_type($type); ?></a>
                <br />
                <br />
	<?php echo __get_error_msg(); ?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Price <?php echo __get_price_type($type); ?>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
          <th>Branch</th>
          <th>Product</th>
          <th style="text-align:center;">Price Distribution</th>
          <th style="text-align:center;">Price Semi</th>
          <th style="text-align:center;">Price Key</th>
          <th style="text-align:center;">Price Moq</th>
          <th style="text-align:center;">Price Store</th>
          <th style="text-align:center;">Price Consume</th>
          <th>Status</th>
          <th style="width: 50px;"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
		  <?php
		  foreach($price as $k => $v) :
		  ?>
                                        <tr>
          <td><?php echo $v -> bname; ?></td>
          <td><?php echo $v -> pname; ?></td>
          <td style="text-align:right;"><?php echo __get_rupiah($v -> pdist,4); ?></td>
          <td style="text-align:right;"><?php echo __get_rupiah($v -> psemi,4); ?></td>
          <td style="text-align:right;"><?php echo __get_rupiah($v -> pkey,4); ?></td>
          <td style="text-align:right;"><?php echo __get_rupiah($v -> pmoq,4); ?></td>
          <td style="text-align:right;"><?php echo __get_rupiah($v -> pstore,4); ?></td>
          <td style="text-align:right;"><?php echo __get_rupiah($v -> pconsume,4); ?></td>
          <td><?php echo __get_status($v -> pstatus,1); ?></td>
		  <td>
              <a href="<?php echo site_url('price/price_update/' . $v -> pid.'/'.$type); ?>"><i class="icon-pencil"></i></a>
              <a href="<?php echo site_url('price/price_delete/' . $v -> pid.'/'. $type); ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="icon-remove"></i></a>
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
