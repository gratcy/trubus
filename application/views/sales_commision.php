        <!--PAGE CONTENT -->
        <div id="content">
            <div class="inner">
                <div class="row">
                    <div class="col-lg-12">
                        <h2> Sales Commision</h2>
                    </div>
                </div>

                <hr />
                <a href="<?php echo site_url('sales_commision/sales_commision_add'); ?>" class="btn btn-default btn-grad"><i class="icon-plus"></i> Add Sales Commision</a>
                <br />
                <br />
	<?php echo __get_error_msg(); ?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Sales
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
          <th>Branch</th>
          <th>Category</th>
          <th>Sales Commision (%)</th>
          <th>Sales Credit (%)</th>
          <th>Status</th>
          <th style="width: 50px;"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
		  <?php
		  foreach($sales_commision as $k => $v) :
		  ?>
          <tr>
          <td><?php echo $v -> bname; ?></td>
          <td><?php echo $v -> cname; ?></td>
          <td style="text-align:right;"><?php echo $v -> scoma.'<br />'.$v -> scomb.'<br />'.$v -> scomc.'<br />'.$v -> scomd.'<br />'.$v -> scome; ?></td>
          <td style="text-align:right;"><?php echo $v -> scredita.'<br />'.$v -> screditb.'<br />'.$v -> screditc.'<br />'.$v -> screditd.'<br />'.$v -> scredite.'<br />'; ?></td>
          <td><?php echo __get_status($v -> sstatus,1); ?></td>
		  <td>
              <a href="<?php echo site_url('sales_commision/sales_commision_update/' . $v -> sid); ?>"><i class="icon-pencil"></i></a>
              <a href="<?php echo site_url('sales_commision/sales_commision_delete/' . $v -> sid); ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="icon-remove"></i></a>
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
