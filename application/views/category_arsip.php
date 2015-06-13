
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Category Arsip
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo site_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Category Arsip</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
						<form action="<?php echo site_url('category_arsip/category_arsip_search/'); ?>" method="post">
                <div class="form-group">
                    <label for="text1" class="control-label col-lg-1">Name</label>
                        <div class="col-xs-4">
                        <input type="text" style="width:200px!important;display:inline!important;" placeholder="Name" name="keyword" class="form-control" autocomplete="off" />
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
				<?php if (__get_roles('CategoryArsipExecute')) : ?>
                                    <h3 class="box-title">
                <a href="<?php echo site_url('category_arsip/category_arsip_add'); ?>" class="btn btn-default"><i class="fa fa-plus"></i> Add Category Arsip</a></h3>
                <?php endif; ?>
                                </div><!-- /.box-header -->
                                <div class="box-body">
                                    <table class="table table-bordered">
                                    <thead>
                                        <tr>
          <th>Name</th>
          <th>Description</th>
          <th>Status</th>
          <th style="width: 50px;"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
		  <?php
		  foreach($category_arsip as $k => $v) :
		  ?>
                                        <tr>
          <td><?php echo $v -> cname; ?></td>
          <td><?php echo $v -> cdesc; ?></td>
          <td><?php echo __get_status($v -> cstatus,1); ?></td>
		  <td>
				<?php if (__get_roles('CategoryArsipExecute')) : ?>
              <a href="<?php echo site_url('category_arsip/category_arsip_update/' . $v -> cid); ?>"><i class="fa fa-pencil"></i></a>
              <a href="<?php echo site_url('category_arsip/category_arsip_delete/' . $v -> cid); ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-times"></i></a>
                <?php endif; ?>
		</td>
										</tr>
		<?php
		$child = $this -> category_arsip_model -> __get_category_arsip(2, $v -> cid);
		foreach($child as $key => $val) :
		?>
		                                        <tr>
          <td>-- <?php echo $val -> cname; ?></td>
          <td><?php echo $val -> cdesc; ?></td>
          <td><?php echo __get_status($val -> cstatus,1); ?></td>
		  <td>
				<?php if (__get_roles('CategoryArsipExecute')) : ?>
              <a href="<?php echo site_url('category_arsip/category_arsip_update/' . $val -> cid); ?>"><i class="fa fa-pencil"></i></a>
              <a href="<?php echo site_url('category_arsip/category_arsip_delete/' . $val -> cid); ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-times"></i></a>
                <?php endif; ?>
		</td>
										</tr>
        <?php
        endforeach;
        $child = array();
        ?>
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
	$('input[name="keyword"]').sSuggestion('span#sg1','<?php echo site_url('area/get_suggestion'); ?>', 'id');
});
</script>
