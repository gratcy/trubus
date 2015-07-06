
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Publisher
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo site_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Publisher</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
						<form action="<?php echo site_url('publisher/publisher_search/'); ?>" method="post">
                <div class="form-group">
                    <label for="text1" class="control-label col-lg-3">Name/Code/Description</label>
                        <div class="col-xs-4">
                        <input type="text" style="width:200px!important;display:inline!important;" placeholder="Name/Code/Description" name="keyword" class="form-control" autocomplete="off" />
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
				<?php if (__get_roles('PublisherExecute')) : ?>
                                    <h3 class="box-title">
                <a href="<?php echo site_url('publisher/publisher_add'); ?>" class="btn btn-default"><i class="fa fa-plus"></i> Add Publisher</a></h3>
                <?php endif; ?>
                &nbsp;
               <h3 class="box-title"> <a href="<?php echo site_url('publisher/export/excel'); ?>" class="btn btn-default"><i class="fa fa-file"></i> Export Excel</a></h3>
                                </div><!-- /.box-header -->
                                <div class="box-body">
                                    <table class="table table-bordered">
                                    <thead>
                                        <tr>
          <th>Code</th>
          <th>Imprint</th>
          <th>Name</th>
          <th>Description</th>
		  <th>Category</th>
          <th>Email</th>
          <th>Phone</th>
          <th>Fax</th>
          <th>Status</th>
          <th style="width: 50px;"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
		  <?php
		  foreach($publisher as $k => $v) :
		  $phone = explode('*', $v -> pphone);
		  ?>
                                        <tr>
          <td><?php echo ($v -> pparent == 0 || $this->uri->segment(2) == 'publisher_search_result' ? $v -> pcode : ''); ?></td>
          <td><?php echo ($this->uri->segment(2) == 'publisher_search_result' ? __get_publisher_imprint($v -> pid,2) : '01'); ?></td>
          <td><?php echo $v -> pname; ?></td>
          <td><?php echo $v -> pdesc; ?></td>
		  <td><?php echo __get_publisher_category($v -> pcategory,1); ?></td>
          <td><?php echo $v -> pemail; ?></td>
          <td><?php echo $phone[0]; ?></td>
          <td><?php echo $phone[1]; ?></td>
          <td><?php echo __get_status($v -> pstatus,1); ?></td>
		  <td>
				<?php if (__get_roles('PublisherExecute')) : ?>
              <a href="<?php echo site_url('publisher/publisher_update/' . $v -> pid); ?>"><i class="fa fa-pencil"></i></a>
              <a href="<?php echo site_url('publisher/publisher_delete/' . $v -> pid); ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-times"></i></a>
                <?php endif; ?>
		</td>
										</tr>
										<?php if (!$isSearch) : ?>
		<?php
		$par = $this -> publisher_model -> __get_publisher(2, $v -> pid);
		?>
		  <?php
		  $i = 2;
		  foreach($par as $key => $val) :
		  $phones = explode('*', $val -> pphone);
		  ?>
                                        <tr>
          <td></td>
          <td>-- <?php echo str_pad($i, 2, "0", STR_PAD_LEFT); ?></td>
          <td><?php echo $val -> pname; ?></td>
          <td><?php echo $val -> pdesc; ?></td>
		  <td><?php echo __get_publisher_category($val -> pcategory,1); ?></td>
          <td><?php echo $val -> pemail; ?></td>
          <td><?php echo $phones[0]; ?></td>
          <td><?php echo $phones[1]; ?></td>
          <td><?php echo __get_status($val -> pstatus,1); ?></td>
		  <td>
              <a href="<?php echo site_url('publisher/publisher_update/' . $val -> pid); ?>"><i class="fa fa-pencil"></i></a>
              <a href="<?php echo site_url('publisher/publisher_delete/' . $val -> pid); ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-times"></i></a>
		</td>
										</tr>
										<?php ++$i; endforeach; ?>
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
	$('input[name="keyword"]').sSuggestion('span#sg1','<?php echo site_url('publisher/get_suggestion'); ?>', 'id');
});
</script>
