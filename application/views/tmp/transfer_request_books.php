		<table class="table table-bordered" id="bookTMP">
		<thead>
		<tr><th>Publisher</th><th>Code</th><th>Title</th><th>ISBN</th><th>Price</th><th>QTY</th></tr>
		</thead>
		<tbody>
		<?php foreach($books as $k => $v) : ?>
			<tr>
			<td><?php echo $v -> pname; ?></td>
			<td><?php echo $v -> bcode; ?></td>
			<td><?php echo $v -> btitle; ?></td>
			<td><?php echo $v -> bisbn; ?></td>
			<td><?php echo __get_rupiah($v -> bprice); ?></td>
			<td><input type="number" value="<?php echo $v -> dqty; ?>" name="books[<?php echo $v -> did;?>]" style="width:100px;" class="form-control"></td>
			</tr>
		<?php endforeach; ?>
		</tbody>
		</table>
