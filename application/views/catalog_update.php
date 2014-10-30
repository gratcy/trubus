
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Catalog Update
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo site_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="<?php echo site_url('catalog'); ?>">Catalog</a></li>
                        <li class="active">Catalog Update</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
	<?php echo __get_error_msg(); ?>
<div class="box box-primary">
                                <!-- form start -->
                                 <form role="form" action="<?php echo site_url('catalog/catalog_update'); ?>" method="post">
<input type="hidden" name="id" value="<?php echo $id; ?>">
                                    <div class="box-body">
                <div class="form-group">
                    <label>Branch</label>
						<select name="branch" data-placeholder="Branch" class="form-control chzn-select"><?php echo $branch; ?></select>
                </div>
                                        <div class="form-group">
                                            <label>Title</label>
											<input type="text" placeholder="Title Catalog" name="title" class="form-control" value="<?php echo $detail[0] -> ctitle; ?>" />
                                        </div>
                                        <div class="form-group">
                                            <label>Description</label>
											<textarea name="desc" class="form-control" placeholder="Description"><?php echo $detail[0] -> cdesc; ?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Status</label>
                                            <?php echo __get_status($detail[0] -> cstatus,2); ?>
                                        </div>
                                        <div class="form-group">
<div id="booksTMP"></div>
                                        </div>
                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
										<a href="<?php echo site_url('catalog/books_add/2?id=' . $id); ?>" class="btn btn-info" id="addBook">Add Book</a>
                                        <button type="submit" class="btn btn-primary"> <i class="fa fa-save"></i> Submit</button>
										<button class="btn btn-default" type="button" onclick="location.href='javascript:history.go(-1);'">Back</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </section><!-- /.content -->
            </aside><!-- /.right-side -->

<script type="text/javascript">
$(function(){
	$('div#booksTMP').load('<?php echo site_url('catalog/books_tmp/2?id=' . $id);?>');
	$("#addBook").fancybox({
		'width'				: '65%',
		'height'			: '100%',
		'autoScale'			: false,
		'transitionIn'		: 'none',
		'transitionOut'		: 'none',
		'type'				: 'iframe'
	});
	$('a#fancybox-close').click(function(){
		$('div#booksTMP').load('<?php echo site_url('catalog/books_tmp/2?id=' . $id);?>');
	});
	$.fancybox.originalClose = $.fancybox.close;
	$.fancybox.close = function() {
		$('div#booksTMP').load('<?php echo site_url('catalog/books_tmp/2?id=' . $id);?>');
		$.fancybox.originalClose();
	}
});
</script>
