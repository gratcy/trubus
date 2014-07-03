        <!--PAGE CONTENT -->
        <div id="content">
            <div class="inner">
                <div class="row">
                    <div class="col-lg-12">
                        <h2>Purchase Order </h2>
                    </div>
                </div>

                <hr />
                <a href="<?php echo site_url('purchase_order/home/purchase_order_add'); ?>" class="btn btn-default btn-grad"><i class="icon-plus"></i> Add purchase_order</a>
                <br />
                <br />
	<?php echo __get_error_msg(); ?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            purchase_order
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
          <th>Pbid</th>
          <th>No Bukti</th>
          <th>Reff</th>
          <th>Tanggal</th>
          <th>Psid</th>
          <th>Gudang </th>
          <th>Ppid</th>
		  <th>Currency</th>
		  <th>Qty</th>
		  <th>Harga</th>
		  <th>Disc</th>
          <th>Keterangan</th>
          <th>Status</th>
		  <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
		  <?php
		  foreach($purchase_order as $k => $v) :
	
		  ?>
                                        <tr>
          <td><?php echo $v -> pbid; ?></td>
          <td><?php echo $v -> pnobukti; ?></td>
          <td><?php echo $v -> pref; ?></td>
          <td><?php echo $v -> ptgl; ?></td>
          <td><?php echo $v -> psid; ?></td>
          <td><?php echo $v -> pgudang; ?></td>
          <td><?php echo $v -> ppid; ?></td>
          <td><?php echo $v -> pcurrency; ?></td>
		<td><?php echo $v -> pqty; ?></td>
		<td><?php echo $v -> pharga; ?></td>
		<td><?php echo $v -> pdisc; ?></td>
		<td><?php echo $v -> pketerangan; ?></td>
		<td><?php echo $v -> pstatus; ?></td>
		
		
		  <td>
              <a href="<?php echo site_url('purchase_order/home/purchase_order_update/' . $v -> pid); ?>"><i class="icon-pencil"></i></a>
              <a href="<?php echo site_url('purchase_order/home/purchase_order_delete/' . $v -> pid); ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="icon-remove"></i></a>
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
