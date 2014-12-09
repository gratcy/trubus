<table class="table table-bordered">
<thead>
<tr>
<th>Code</th>
<th>Title</th>
<th style="width:150px;">ISBN</th>
<th style="width:150px;">Cover</th>
<th style="width:50px;">Action</th>
</tr>
</thead>
<tbody>
<?php foreach($books as $k => $v) : ?>
<tr id="book_id_<?php echo $v -> bid?>">
<input type="hidden" name="bid[]" value="<?php echo $v -> bid;?>">
<td><?php echo $v -> bcode; ?></td>
<td><?php echo $v -> btitle; ?></td>
<td><a href="<?php echo __get_path_upload('cover', 2, $v -> bcover); ?>" id="cover">View Cover</a></td>
<td><?php echo $v -> bisbn; ?></td>
<td style="text-align:center;"><a href="javascript:void(0);" id="DelBook" bid="<?php echo $v -> bid; ?>"><i class="fa fa-times"></i></a></td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
<script type="text/javascript">
$(function(){
	$('a#DelBook').click(function() {
		console.log($(this).attr('bid'));
		<?php if ($type == 1) : ?>
		var data = {'bid' : $(this).attr('bid')};
		<?php else : ?>
		var data = {'lid' : <?php echo $id; ?>,'bid' : $(this).attr('bid')};
		<?php endif; ?>
		$.post('<?php echo site_url((isset($catalog) == true ? 'catalog' : 'locator').'/books_delete/' . $type); ?>', data,
		function(datas) {
			if (datas != '-1') {
				$('tr#book_id_' + $(this).attr('bid')).remove();
				$('div#booksTMP').load('<?php echo site_url(($catalog == true ? 'catalog' : 'locator').'/books_tmp/' . $type . '?id=' . $id);?>');
			}
		});
	});
	
	$("a#cover").fancybox({
		  helpers: {
			  title : {
				  type : 'float'
			  }
		  }
	});
});
</script>
