
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Stock Opname Customer<?php 
						if(count($opname)>0){
							$cname=$opname[0] -> cname;
						}else{
							$cname="";
						}
						?>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo site_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="<?php echo site_url('opnamecustomer'); ?>">Stock Opname Customer</a></li>
                        <li class="active"><?php echo $cname;?></li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
						<form action="<?php echo site_url('opnamecustomer/opname_customer_detail_search'); ?>" method="post">
						<input type="hidden" name="cid" value="<?php echo $cid; ?>">
                <div class="form-group">
                    <label for="text1" class="control-label col-lg-1">Title/Code</label>
                        <div class="col-xs-4">
                        <input type="text" style="width:200px!important;display:inline!important;" placeholder="Title/Code" name="keyword" class="form-control" autocomplete="off" />
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
                <a href="<?php echo site_url('opnamecustomer/opnamecustomer_import/' . $cid); ?>" class="btn btn-default"><i class="fa fa-upload"></i> Import Opname</a>
                </h3>
                </div>
                                <div class="box-body">
                                    <table class="table table-bordered">
                                    <thead>
                                        <tr>
          <th>Code</th>
          <th>Title</th>
          <th>Stock Begining</th>
          <th>Stock In</th>
          <th>Stock Out</th>
          <th>Stock Reject</th>
          <th>Stock Retur</th>
          <th>Stock Final</th>
          <th style="width: 50px;"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
		  <?php
		  foreach($opname as $k => $v) :
		  ?>
                                        <tr>
          <td><?php echo $v -> bcode; ?></td>
          <td><?php echo $v -> btitle; ?></td>
          <td><?php echo $v -> istockbegining; ?></td>
          <td><?php echo $v -> istockin; ?></td>
          <td><?php echo $v -> istockout; ?></td>
          <td><?php echo $v -> istockreject; ?></td>
          <td><?php echo $v -> istockretur; ?></td>
          <td><?php echo $v -> istock; ?></td>
		  <td>
              <a href="<?php echo site_url('opnamecustomer/opnamecustomer_update/' . $v -> iid); ?>"><i class="fa fa-pencil"></i></a>
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
	$('input[name="keyword"]').sSuggestion('span#sg1','<?php echo site_url('books/get_suggestion'); ?>', 'bid');
});
</script>
