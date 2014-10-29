
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Arsip
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo site_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Arsip</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
						<form action="<?php echo site_url('arsip/arsip_search/'); ?>" method="post">
                <div class="form-group">
                    <label for="text1" class="control-label col-lg-1">Title</label>
                        <div class="col-xs-4">
                        <input type="text" style="width:200px!important;display:inline!important;" placeholder="To" name="keyword" class="form-control" autocomplete="off" />
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
                                    <h3 class="box-title">
                <a href="<?php echo site_url('arsip/arsip_add'); ?>" class="btn btn-default"><i class="fa fa-plus"></i> Add Arsip</a></h3>
                                </div><!-- /.box-header -->
                                <div class="box-body">
                                    <table class="table table-bordered">
                                    <thead>
                                        <tr>
          <th>Branch</th>
          <th>Title</th>
          <th>Category</th>
          <th>File</th>
          <th>Description</th>
          <th>Status</th>
          <th style="width: 50px;"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
		  <?php
		  foreach($arsip as $k => $v) :
		  ?>
                                        <tr>
          <td><?php echo $v -> bname; ?></td>
          <td><?php echo $v -> atitle; ?></td>
          <td><?php echo $v -> cname; ?></td>
          <td><a href="<?php echo __get_path_upload('arsip',2,$v -> acid.'/'.$v -> afile); ?>" target="_blank">Download</a></td>
          <td><?php echo substr($v -> adesc,0,300); ?></td>
          <td><?php echo __get_status($v -> astatus,1); ?></td>
		  <td>
              <a href="<?php echo site_url('arsip/arsip_update/' . $v -> aid); ?>"><i class="fa fa-pencil"></i></a>
              <a href="<?php echo site_url('arsip/arsip_delete/' . $v -> aid); ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-times"></i></a>
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
	$('input[name="keyword"]').sSuggestion('span#sg1','<?php echo site_url('arsip/get_suggestion'); ?>', 'id');
});
</script>
