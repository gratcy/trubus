
        <link href="<?php echo site_url('application/views/assets/css/bootstrap.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo site_url('application/views/assets/css/AdminLTE.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo site_url('application/views/assets/css/suggestions.css'); ?>" rel="stylesheet" type="text/css" />
        <script src="<?php echo site_url('application/views/assets/js/jquery.min.js'); ?>"></script>
        <script src="<?php echo site_url('application/views/assets/js/js.js'); ?>"></script>
                <div class="box-body">
                    <div class="row">
						<form action="<?php echo site_url('request/request_list_books/' . $type . '/' . $did); ?>" method="GET">
                <div class="form-group">
                    <label for="text1" class="control-label col-lg-3" style="float:left">Title/Code/Author/Publisher/Category</label>
                        <div class="col-xs-6">
                        <input type="text" style="width:200px!important;display:inline!important;" placeholder="Title/Code/Author/Publisher/Category" name="keyword" class="form-control" autocomplete="off" />
                        <button class="btn text-muted text-center btn-danger" type="submit">Go!</button>
                        <span id="sg1"></span>
                        <input type="hidden" name="bid" />
						</div>
						</div>
						</form>
						</div>
						</div>
						<br />
        <div class="box-body">
	<?php echo __get_error_msg(); ?>
			<form action="<?php echo site_url('request/request_books_add/' . $type); ?>" method="post">
			<input type="hidden" name="did" value="<?php echo $did; ?>">
                                    <table class="table table-bordered">
                                    <thead>
                                        <tr>
          <th></th>
          <th>Code</th>
          <th>Title</th>
          <th>Publisher</th>
          <th>Price</th>
          <th>Discount</th>
          <th>ISBN</th>
                                        </tr>
                                    </thead>
                                    <tbody>
		  <?php
		  foreach($books as $k => $v) :
		  ?>
          <tr>
          <td><input type="checkbox" value="<?php echo $v -> bid; ?>" name="bid[]"></td>
          <td><?php echo $v -> bcode; ?></td>
          <td><?php echo $v -> btitle; ?></td>
          <td><?php echo $v -> pname; ?></td>
          <td><?php echo __get_rupiah($v -> bprice,1); ?></td>
          <td><?php echo $v -> bdisc; ?>%</td>
          <td><?php echo $v -> bisbn; ?></td>
			</tr>
        <?php endforeach; ?>
                                    </tbody>
                                    </table>
                                <div class="box-footer clearfix">
                                    <ul class="pagination pagination-sm no-margin pull-right">
                                        <?php echo $pages; ?>
                                    </ul>
                                </div>
<button type="submit" class="btn btn-primary"> <i class="fa fa-save"></i> Save</button>
</form>
                                    </div>

<script type="text/javascript">
$(function(){
	$('input[name="keyword"]').sSuggestion('span#sg1','<?php echo site_url('books/get_suggestion'); ?>', 'bid');
});
</script>
