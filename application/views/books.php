
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Books
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo site_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Books</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
						<form action="<?php echo site_url('books/books_search/'); ?>" method="post">
                <div class="form-group">
                    <label for="text1" class="control-label col-lg-4">Title/Code/Author/Publisher/Category</label>
                        <div class="col-xs-4">
                        <input type="text" style="width:200px!important;display:inline!important;" placeholder="Title/Code/Author/Publisher/Category" name="bname" class="form-control" autocomplete="off" />
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
				<?php if (__get_roles('BooksExecute')) : ?>
                <a href="<?php echo site_url('books/books_add'); ?>" class="btn btn-default"><i class="fa fa-plus"></i> Add Book</a></h3>
                <?php endif; ?>
                &nbsp;
               <h3 class="box-title"> <a href="<?php echo site_url('books/export/excel'); ?>" class="btn btn-default"><i class="fa fa-file"></i> Export Excel</a></h3>
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <table class="table table-bordered">
                                    <thead>
                                        <tr>
          <th style="width:120px">Code</th>
          <th>Category</th>
          <th>Title</th>
          <th>Publisher</th>
          <th style="width:100px">Price</th>
          <th>Discount</th>
          <th>ISBN</th>
          <th>Status</th>
          <th style="width: 80px;"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
		  <?php
		  foreach($books as $k => $v) :
		  ?>
                                        <tr>
          <td><?php echo __check_new_book($v -> bdate); ?> <?php echo $v -> bcode; ?></td>
          <td><?php echo $v -> cname; ?></td>
          <td><?php echo $v -> btitle; ?></td>
          <td><?php echo $v -> pname; ?></td>
          <td style="text-align:right;"><?php echo __get_rupiah($v -> bprice,1); ?></td>
          <td><?php echo $v -> bdisc; ?>%</td>
          <td><?php echo $v -> bisbn; ?></td>
          <td><?php echo __get_status($v -> bstatus,1); ?></td>
		  <td>
			<?php if (__get_roles('BooksExecute')) : ?>
              <a href="<?php echo site_url('books/books_update/' . $v -> bid); ?>"><i class="fa fa-pencil"></i></a>
              <a href="<?php echo site_url('books/books_delete/' . $v -> bid); ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-times"></i></a>
              <a href="javascript:void(0);" onclick="print_data('<?php echo site_url('printpage/penawaran/' . $v -> bid); ?>', 'Print Penawaran');"><i class="fa fa-print"></i></a>
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
	$('input[name="bname"]').sSuggestion('span#sg1','<?php echo site_url('books/get_suggestion'); ?>', 'bid');
});
</script>
