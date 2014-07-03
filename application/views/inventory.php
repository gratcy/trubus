
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
						<form action="<?php echo site_url('books/search_books/'); ?>" method="post">
                <div class="form-group">
                    <label for="text1" class="control-label col-lg-1">Title/Code</label>
                        <div class="col-xs-4">
                        <input type="text" style="width:200px!important;display:inline!important;" placeholder="To" name="bname" class="form-control" autocomplete="off" />
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
                                <div class="box-header">
                                    <h3 class="box-title">
                <a href="<?php echo site_url('inventory/inventory_add'); ?>" class="btn btn-default"><i class="fa fa-plus"></i> Add Stock</a></h3>
                                </div><!-- /.box-header -->
                                <div class="box-body">
                                    <table class="table table-bordered">
                                    <thead>
                                        <tr>
          <th>Branch</th>
          <th>Title</th>
          <th>Stock Begining</th>
          <th>Stock In</th>
          <th>Stock Out</th>
          <th>Stock Reject</th>
          <th>Stock Final</th>
          <th>Status</th>
          <th style="width: 50px;"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
		  <?php
		  foreach($inventory as $k => $v) :
		  ?>
                                        <tr>
          <td><?php echo $v -> bname; ?></td>
          <td><?php echo $v -> btitle; ?></td>
          <td><?php echo $v -> istockbegining; ?></td>
          <td><?php echo $v -> istockin; ?></td>
          <td><?php echo $v -> istockout; ?></td>
          <td><?php echo $v -> istockreject; ?></td>
          <td><?php echo $v -> istock; ?></td>
          <td><?php echo __get_status($v -> istatus,1); ?></td>
		  <td>
              <a href="<?php echo site_url('inventory/inventory_update/' . $v -> iid); ?>"><i class="fa fa-pencil"></i></a>
              <a href="<?php echo site_url('inventory/inventory_delete/' . $v -> iid); ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-times"></i></a>
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
