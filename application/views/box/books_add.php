<html>
<head>
<title>Books Add</title>
        <link href="<?php echo site_url('application/views/assets/css/bootstrap.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo site_url('application/views/assets/css/AdminLTE.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo site_url('application/views/assets/css/suggestions.css'); ?>" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" type="text/css" href="<?php echo site_url('application/views/assets/fancybox/fancybox/jquery.fancybox-1.3.4.css'); ?>" media="screen" />
        <script src="<?php echo site_url('application/views/assets/js/jquery.min.js'); ?>"></script>
        <script src="<?php echo site_url('application/views/assets/js/js.js'); ?>"></script>
		<script type="text/javascript" src="<?php echo site_url('application/views/assets/fancybox/fancybox/jquery.mousewheel-3.0.4.pack.js'); ?>"></script>
		<script type="text/javascript" src="<?php echo site_url('application/views/assets/fancybox/fancybox/jquery.fancybox-1.3.4.pack.js'); ?>"></script>
</head>
<body>
<div style="padding:5px;">
<section class="content-header">
<h1>Add Books</h1>
</section>
	<?php echo __get_error_msg(); ?>
                    <div class="row">
						<form action="<?php echo site_url((isset($catalog) == true ? 'catalog' : 'locator').'/books_search/'); ?>" method="post">
						<input type="hidden" name="type" value="<?php echo $type; ?>">
						<input type="hidden" name="lid" value="<?php echo $id; ?>">
                <div class="form-group">
                    <label for="text1" class="control-label col-lg-1" style="float:left;">Title/Code</label>
                        <div class="col-xs-6">
                        <input type="text" style="width:200px!important;display:inline!important;" placeholder="Title/Code" name="keyword" class="form-control" autocomplete="off" />
                        <button class="btn text-muted text-center btn-danger" type="submit">Go!</button>
                        <span id="sg1"></span>
                        <input type="hidden" name="id" />
						</div>
						</div>
						</form>
						</div>
						<br />
<form action="<?php echo site_url((isset($catalog) == true ? 'catalog' : 'locator').'/books_add/'.$type.'?id=' . $id); ?>" method="post">
<div class="box-body">
<table class="table table-bordered">
<thead>
<tr>
<th style="width:50px;"></th>
<th>Code</th>
<th>Title</th>
<th style="width:150px;">ISBN</th>
<th style="width:150px;">Cover</th>
</tr>
</thead>
<tbody>
<?php foreach($books as $k => $v) : ?>
<tr>
<td style="text-align:center;"><input type="checkbox" name="bid[]" value="<?php echo $v -> bid?>"></td>
<td><?php echo $v -> bcode; ?></td>
<td><?php echo $v -> btitle; ?></td>
<td><?php echo $v -> bisbn; ?></td>
<td><?php if ($v -> bcover) : ?><a href="<?php echo __get_path_upload('cover', 2, $v -> bcover); ?>" id="cover">View Cover</a><?php else : ?>No Cover<?php endif;?></td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
</div>
<div class="box-footer">
	<button type="submit" class="btn btn-primary" value="save"> <i class="fa fa-save"></i> Submit</button>
</div>
</form>
<div class="box-footer clearfix">
	<ul class="pagination pagination-sm no-margin pull-right">
		<?php echo $pages; ?>
	</ul>
</div>
</div>
</body>
</html>

<script type="text/javascript">
$(function(){
	$("a#cover").fancybox({
		  helpers: {
			  title : {
				  type : 'float'
			  }
		  }
	});
});
</script>
<script type="text/javascript">
$(function(){
	$('input[name="keyword"]').sSuggestion('span#sg1','<?php echo site_url('books/get_suggestion'); ?>', 'bid');
});
</script>
