
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Report Stock Position Books
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo site_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Report Stock Position Books</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
						<form action="<?php echo site_url('reportstockposition/search/'); ?>" method="post">
                <div class="form-group">
                    <label for="text1" class="control-label col-lg-2">Title/Code/Publisher/Price</label>
                        <div class="col-xs-4">
                        <input type="text" style="width:200px!important;display:inline!important;" placeholder="Title/Code/Publisher/Price" name="keyword" class="form-control" autocomplete="off" />
                        <button class="btn text-muted text-center btn-danger" type="submit">Go!</button>
                        <span id="sg1"></span>
                        <input type="hidden" name="bid" />
                        <input type="hidden" name="type" value="4" />
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
	<a href="<?php echo site_url('download/stock_position_book_' . strtolower($this -> memcachedlib -> sesresult['ubranch']) . '.xls'); ?>" class="btn btn-default"><i class="fa fa-file"></i> Export Excel</a>	
						</h3></div>
                                <div class="box-body" style="overflow:auto;">
                                    <table class="table table-bordered" style="width: 1400px;">
                                    <thead>
                                        <tr>
          <th>Code</th>
          <th>Title</th>
          <th>Price</th>
          <th>Stock In</th>
          <th>Stock Out</th>
          <th>Stock Final</th>
          <th>Stock Process</th>
          <th>Left</th>
                                        </tr>
                                    </thead>
                                    <tbody>
		  <?php
		  foreach($reportstockposition as $k => $v) :
		  $sfinal = __get_stock_position_book_detail($v -> bid, $branch, 3);
		  $sprocess = __get_stock_position_book_process($v -> bid, $branch);
		  $sleft = $sfinal - $sprocess;
		  ?>
                                        <tr>
          <td><?php echo $v -> bcode; ?></td>
          <td><?php echo $v -> btitle; ?></td>
          <td><?php echo __get_rupiah($v -> bprice); ?></td>
          <td><?php echo __get_stock_position_book_detail($v -> bid, $branch, 1); ?></td>
          <td><?php echo __get_stock_position_book_detail($v -> bid, $branch, 2); ?></td>
          <td><?php echo $sfinal; ?></td>
          <td><?php echo $sprocess; ?></td>
          <td><?php echo $sleft; ?></td>
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
	$('input[name="keyword"]').sSuggestion('span#sg1','<?php echo site_url('books/get_suggestion'); ?>', 'bid');
});
</script>
