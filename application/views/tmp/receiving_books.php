		<table class="table table-bordered" id="bookTMP">
		<thead>
		<tr><th>Publisher</th><th>Code</th><th>Title</th><th>ISBN</th><th>Price</th><th>QTY</th><th style="width:35px;"></th></tr>
		</thead>
		<tbody>
		<?php foreach($books as $k => $v) : ?>
			<tr idnya="<?php echo $v -> rbid; ?>">
			<td><?php echo $v -> pname; ?></td>
			<td><?php echo $v -> bcode; ?></td>
			<td><?php echo $v -> btitle; ?></td>
			<td><?php echo $v -> bisbn; ?></td>
			<td><?php echo __get_rupiah($v -> bprice); ?></td>
			<td><input type="text" value="<?php echo ($type == 1 ? '' : $v -> rqty); ?>" name="books[<?php echo ($type == 1 ? $v -> rid : $v -> rbid); ?>]" class="form-control" style="width:100px;"></td>
			<td style="text-align:center;"><a href="javascript:void(0);" id="dellist" idnya="<?php echo $v -> rbid; ?>"><i class="fa fa-times"></i></a></td>
			</tr>
		<?php endforeach; ?>
		</tbody>
		</table>
<script type="text/javascript">
$('a#dellist').click(function(){
	var idnya = $(this).attr('idnya');
	$('tr[idnya='+idnya+']').remove();
	<?php if ($type == 2) : ?>
	var data = {'bid' : idnya, 'did' : <?php echo $did; ?>};
	<?php else : ?>
	var data = {'bid' : idnya};
	<?php endif; ?>
	$.post('<?php echo site_url('receiving/receiving_books_delete/' . $type); ?>', data,
	function(datas) {
		
	});
});
</script>
