
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Categories
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo site_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Categories</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
						<form action="<?php echo site_url('categories/categories_search/'); ?>" method="post">
                <div class="form-group">
                    <label for="text1" class="control-label col-lg-1">Title</label>
                        <div class="col-xs-4">
                        <input type="text" style="width:200px!important;display:inline!important;" placeholder="Categories Name" name="keyword" class="form-control" autocomplete="off" />
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
				<?php if (__get_roles('BooksExecute')) : ?>
                                    <h3 class="box-title">
                <a href="<?php echo site_url('categories/categories_add'); ?>" class="btn btn-default"><i class="fa fa-plus"></i> Add Categories</a></h3>
                <?php endif; ?>
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
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
		  foreach($categories as $k => $v) :
		  ?>
                                        <tr>
          <td><?php echo $v -> cname; ?></td>
          <td><?php echo substr($v -> cdesc,0,150); ?></td>
          <td><?php echo __get_status($v -> cstatus,1); ?></td>
		  <td>
              <a href="<?php echo site_url('categories/categories_update/' . $v -> cid); ?>"><i class="fa fa-pencil"></i></a>
              <a href="<?php echo site_url('categories/categories_delete/' . $v -> cid); ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-times"></i></a>
          </td>
										</tr>
										
										
		  <?php
		  if (!preg_match('/\/categories_search_result/', $_SERVER['REQUEST_URI'])) :
		  $child = $this -> categories_model -> __get_categories(2,$v -> cid);
		  foreach($child as $k => $v) :
		  ?>
                                        <tr>
          <td>-- <?php echo $v -> cname; ?></td>
          <td><?php echo substr($v -> cdesc,0,150); ?></td>
          <td><?php echo __get_status($v -> cstatus,1); ?></td>
		  <td>
              <a href="<?php echo site_url('categories/categories_update/' . $v -> cid); ?>"><i class="fa fa-pencil"></i></a>
              <a href="<?php echo site_url('categories/categories_delete/' . $v -> cid); ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-times"></i></a>
          </td>
										</tr>
        <?php endforeach; ?>
        <?php endif; ?>
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
	$('input[name="keyword"]').sSuggestion('span#sg1','<?php echo site_url('categories/get_suggestion'); ?>', 'id');
});
</script>
