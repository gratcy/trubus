
        <link href="<?php echo site_url('application/views/assets/css/bootstrap.min.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo site_url('application/views/assets/css/AdminLTE.css'); ?>" rel="stylesheet" type="text/css" />
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
          <th>Group</th>
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
          <td><?php echo $v -> bname; ?></td>
          <td><?php echo $v -> pname; ?></td>
          <td><?php echo $v -> bprice; ?></td>
          <td><?php echo $v -> bdisc; ?>%</td>
          <td><?php echo $v -> bisbn; ?></td>
			</tr>
        <?php endforeach; ?>
                                    </tbody>
                                    </table>
<button type="submit" class="btn btn-primary"> <i class="fa fa-save"></i> Save</button>
</form>
                                    </div>
