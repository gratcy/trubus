
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Stock Customer
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo site_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Stock Customer</li>
                        <li> <?php echo $customer[0] -> cname; ?></li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                <div class="form-group">
					<table border="0"  class="col-xs-8">
					<tr><td><label class="control-label col-lg-1">Kode</label></td><td><label class="control-label col-lg-8">: <?php echo $customer[0] -> ccode; ?></label></td></tr>
					<tr><td><label class="control-label col-lg-1">Nama</label></td><td><label class="control-label col-lg-8">: <?php echo $customer[0] -> cname; ?></label></td></tr>
					</table>
					</div>
					</div>
					<div class="clear"></div>
                    <div class="row">
						<form action="<?php echo site_url('inventory_customer/inventory_customer_search_detail/'); ?>" method="post">
                <div class="form-group">
                    <label for="text1" class="control-label col-lg-1">Title/Code</label>
                        <div class="col-xs-4">
                        <input type="text" style="width:200px!important;display:inline!important;" placeholder="Title/Code" name="keyword" class="form-control" autocomplete="off" />
                        <button class="btn text-muted text-center btn-danger" type="submit">Go!</button>
                        <span id="sg1"></span>
                        <input type="hidden" name="bid" />
                        <input type="hidden" name="cid" value="<?php echo $cid;?>" />
						</div>
						</div>
						</form>
						</div>
						<br />
                    <div class="row">
                        <div class="col-xs-12">
	<?php echo __get_error_msg(); ?>
							<div class="box">
                                <div class="box-header">
							<h3 class="box-title">
	<a href="<?php echo site_url('inventory_customer/export/' . $cid.'/excel'); ?>" class="btn btn-default"><i class="fa fa-file"></i> Export Excel</a>	
						</h3>
						</div>
                                <div class="box-body" style="overflow:auto;">
                                    <table class="table table-bordered" style="width: 1800px;">
                                    <thead>
                                        <tr>          <th>Code</th>
          <th>Title</th>
          <th style="width:100px">Price</th>
          <th>Stock Begining</th>
          <th>Stock In</th>
          <th>Stock Out</th>
          <th>Stock Reject</th>
          <th>Stock Retur</th>
          <th>Stock Final</th>
		  <th>Adjusment (+)</th>
		  <th>Adjusment (-)</th>
          <th>Stock Process</th>
          <th>Stock Left</th>
                                        </tr>
                                    </thead>
                                    <tbody>
		  <?php
		  foreach($inventory_customer as $k => $v) :
		  $aplus = __get_adjustment($v -> iid, $cid, 1, 2);
		  $amin = __get_adjustment($v -> iid, $cid, 2, 2);
		  $sprocess = __get_stock_process($cid, $v -> ibid, 2);
		  $sleft = $v -> istock - $sprocess;
		  ?>
                                        <tr>
		  <td><?php echo $v -> bcode; ?></td>
          <td><?php echo $v -> btitle; ?></td>
          <td><?php echo __get_rupiah($v -> bprice); ?></td>
          <td><?php echo (int) $v -> istockbegining; ?></td>
          <td><?php echo (int) $v -> istockin; ?></td>
          <td><?php echo (int) $v -> istockout; ?></td>
          <td><?php echo (int) $v -> istockreject; ?></td>
          <td><?php echo (int) $v -> istockretur; ?></td>
		  <td><?php echo (int) $v -> istock; ?></td>
          <td><?php echo $aplus; ?></td>
          <td><?php echo $amin; ?></td>
		  <td><?php echo $sprocess; ?></td>
		  <td><?php echo $sleft; ?></td>
		</tr>
        <?php endforeach; ?>
                                    </tbody>
                                    </table>
                                </div><!-- /.box-body -->
                                <div class="box-footer clearfix isthere">
                                    <ul class="pagination pagination-sm no-margin pull-right">
                                        <?php echo $pages; ?>
                                    </ul>
										<button class="btn btn-default" type="button" onclick="location.href='<?php echo site_url('inventory_customer'); ?>'">Back to Stock</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </section><!-- /.content -->
            </aside><!-- /.right-side -->


<script type="text/javascript">
$(function(){
	$('input[name="keyword"]').sSuggestion('span#sg1','<?php echo site_url('books/get_suggestion'); ?>', 'bid');
});
</script>
