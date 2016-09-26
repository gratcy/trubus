
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Stock Publisher
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo site_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Stock Publisher</li>
                        <li> <?php echo $customer[0] -> cname; ?></li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                <div class="form-group">
					<table border="0"  class="col-xs-8">
					<tr><td><label class="control-label col-lg-1">Code</label></td><td><label class="control-label col-lg-8">: <?php echo $publisher[0] -> pcode; ?></label></td></tr>
					<tr><td><label class="control-label col-lg-1">Name</label></td><td><label class="control-label col-lg-8">: <?php echo $publisher[0] -> pname; ?></label></td></tr>
					</table>
					</div>
					</div>
					<div class="clear"></div>
                    <div class="row">
						<form action="<?php echo site_url('inventory_publisher/inventory_publisher_search_detail/'); ?>" method="post">
                <div class="form-group">
                    <label for="text1" class="control-label col-lg-1">Title/Code</label>
                        <div class="col-xs-4">
                        <input type="text" style="width:200px!important;display:inline!important;" placeholder="Title/Code" name="keyword" class="form-control" autocomplete="off" />
                        <button class="btn text-muted text-center btn-danger" type="submit">Go!</button>
                        <span id="sg1"></span>
                        <input type="hidden" name="bid" />
                        <input type="hidden" name="pid" value="<?php echo $pid;?>" />
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
	<a href="<?php echo site_url('inventory_publisher/export/' . $pid.'/excel'); ?>" class="btn btn-default"><i class="fa fa-file"></i> Export Excel</a>	
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
          <th>Selling</th>
          <th>Stock Return</th>
          <th>Stock Left</th>
                                        </tr>
                                    </thead>
                                    <tbody>
		  <?php
		  foreach($inventory_publisher as $k => $v) :
		  $in = __get_stockin_publisher($this -> memcachedlib -> sesresult['ubranchid'], $v -> bid);
		  $out = __get_stockselling_publisher($this -> memcachedlib -> sesresult['ubranchid'], $v -> bid);
		  $return = __get_stockreturn_publisher($this -> memcachedlib -> sesresult['ubranchid'], $v -> bid);
		  $begin = __get_total_stockbegining_customer($this -> memcachedlib -> sesresult['ubranchid'], $v -> bid) + $v -> istockbegining;
		  $sleft = ($begin + $in) - ($out + $return);
		  ?>
                                        <tr>
		  <td><?php echo $v -> bcode; ?></td>
          <td><?php echo $v -> btitle; ?></td>
          <td><?php echo __get_rupiah($v -> bprice); ?></td>
          <td><?php echo $begin; ?></td>
          <td><?php echo $in; ?></td>
          <td><?php echo $out; ?></td>
          <td><?php echo $return; ?></td>
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
										<button class="btn btn-default" type="button" onclick="location.href='<?php echo site_url('inventory_publisher'); ?>'">Back to Stock</button>
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
