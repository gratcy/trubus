
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Stock Book
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo site_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Stock Book</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
						<form action="<?php echo site_url('inventory/inventory_search/'); ?>" method="post">
                <div class="form-group">
                    <label for="text1" class="control-label col-lg-2">Title/Code/Publisher</label>
                        <div class="col-xs-4">
                        <input type="text" style="width:200px!important;display:inline!important;" placeholder="Title/Code/Publisher" name="bname" class="form-control" autocomplete="off" />
                        <button class="btn text-muted text-center btn-danger" type="submit">Go!</button>
                        <span id="sg1"></span>
                        <input type="hidden" name="bid" />
						</div>
						</div>
						</form>
						</div>
						<br />
                    <div class="row">
                        <div class="col-xs-12">
	<?php echo __get_error_msg(); ?>
							<div class="box">
                                <div class="box-body" style="overflow:auto;">
                                    <table class="table table-bordered" style="width: 1800px;">
                                    <thead>
                                        <tr>
          <th>Code</th>
          <th>Title</th>
          <th style="width:100px;">Price</th>
          <th>Stock Begining</th>
          <th>Stock In</th>
          <th>Stock Out</th>
          <th>Stock Retur</th>
          <th>Stock Reject</th>
          <th>Stock Final</th>
		  <th>Adjusment (+)</th>
		  <th>Adjusment (-)</th>
          <th>Stock Process</th>
          <th>Stock Left</th>
          <th>Status</th>
		  <th>Card Stock</th>
          <th style="width: 50px;"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
		  <?php
		  foreach($inventory as $k => $v) :
		  ?>
                                        <tr>
          <td><?php echo $v -> bcode; ?></td>
          <td><?php echo $v -> btitle; ?></td>
          <td style="text-align:right;"><?php echo __get_rupiah($v -> bprice,1); ?></td>
          <td><?php echo $v -> istockbegining; ?></td>
          <td><?php echo $v -> istockin; ?></td>
          <td><?php echo $v -> istockout; ?></td>
          <td><?php echo $v -> istockretur; ?></td>
          <td><?php echo $v -> istockreject; ?></td>
          <td><?php echo $v -> istock; ?></td>
          <td><?php echo __get_adjustment($v -> iid, $v -> ibcid, 1); ?></td>
          <td><?php echo __get_adjustment($v -> iid, $v -> ibcid, 2); ?></td>
          <td><?php echo __get_stock_process($v -> ibcid, $v -> ibid,1); ?></td>
          <td><?php echo ($v -> istock - __get_stock_process($v -> ibcid, $v -> ibid,1)); ?></td>
          <td><?php echo __get_status($v -> istatus,1); ?></td>
		  <td>
		  <a href="javascript:void(0);" onclick="print_data('<?php echo site_url('inventory/card_stock/' . $v -> ibid.'/'.$v->ibcid ); ?>', 'Print Kartu Stok');"><i class="fa fa-book"></i></a>
		  </td><td>
              <a href="<?php echo site_url('inventory/inventory_update/' . $v -> iid); ?>"><i class="fa fa-pencil"></i></a>
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

<script type="text/javascript">
$(function(){
	$('input[name="bname"]').sSuggestion('span#sg1','<?php echo site_url('books/get_suggestion'); ?>', 'bid');
});
</script>
