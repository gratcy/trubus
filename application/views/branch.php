
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Branch
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo site_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Branch</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
						<form action="<?php echo site_url('branch/branch_search/'); ?>" method="post">
                <div class="form-group">
                    <label for="text1" class="control-label col-lg-1">Name/Code</label>
                        <div class="col-xs-4">
                        <input type="text" style="width:200px!important;display:inline!important;" placeholder="Name/Code" name="keyword" class="form-control" autocomplete="off" />
                        <button class="btn text-muted text-center btn-danger" type="submit">Go!</button>
                        <span id="sg1"></span>
                        <input type="hidden" name="id" />
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
				<?php if (__get_roles('BranchExecute')) : ?>
                                    <h3 class="box-title">
                <a href="<?php echo site_url('branch/branch_add'); ?>" class="btn btn-default"><i class="fa fa-plus"></i> Add Branch</a></h3>
                <?php endif; ?>
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <table class="table table-bordered">
                                    <thead>
                                        <tr>
          <th>Code</th>
          <th>Branch</th>
          <th>Head</th>
          <th>NPWP</th>
          <th style="width: 350px;">Address</th>
          <th>Phone/Fax</th>
          <th>Status</th>
          <th style="width: 50px;"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
		  <?php
		  foreach($branch as $k => $v) :
		  $phone = explode('*', $v -> bphone);
		  ?>
                                        <tr>
          <td><?php echo $v -> bcode; ?></td>
          <td><?php echo $v -> bname; ?></td>
          <td><?php echo $v -> bhname; ?></td>
          <td><?php echo $v -> bnpwp; ?></td>
          <td><?php echo $v -> baddr. ', '.$v -> city.', '.$v -> province; ?></td>
          <td><?php echo $phone[0] . ($phone[0] && $phone[1] ? ' / ' : '') . (isset($phone[1]) ? $phone[1] : ''); ?></td>
          <td><?php echo __get_status($v -> bstatus,1); ?></td>
		  <td>
		<?php if (__get_roles('BranchExecute')) : ?>
		<?php if ($v -> bid <> 1) : ?>
              <a href="<?php echo site_url('branch/branch_update/' . $v -> bid); ?>"><i class="fa fa-pencil"></i></a>
              <a href="<?php echo site_url('branch/branch_delete/' . $v -> bid); ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-times"></i></a>
		<?php endif; ?>
		<?php endif; ?>
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
	$('input[name="keyword"]').sSuggestion('span#sg1','<?php echo site_url('branch/get_suggestion'); ?>', 'id');
});
</script>
