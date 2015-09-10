

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Request Add
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo site_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="<?php echo site_url('request'); ?>">Request</a></li>
                        <li class="active">Request Add</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
	<?php echo __get_error_msg(); ?>
<div class="box box-primary">
                                <!-- form start -->
                                 <form role="form" action="<?php echo site_url('request/request_add'); ?>" method="post" enctype="multipart/form-data">
                                    <div class="box-body">
                                        <div class="form-group" id="pbranch">
                                            <label>Branch From</label>
                                            <select class="form-control" name="bfrom">
												<?php echo $bfrom; ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Branch To</label>
                                            <select class="form-control" name="bto">
												<?php echo $bto; ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Title</label>
                        <input type="text" placeholder="Request Title" name="title" class="form-control" />
                                        </div>
                                        <div class="form-group">
                                            <label>Description</label>
											<textarea name="desc" class="form-control" placeholder="Description"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Status</label>
                                            <?php echo __get_status(0,2); ?>
                                        </div>
                    <div id="Books"></div>
                                        <div class="form-group">
                                            <label>Import</label>
                        <input type="file" placeholder="File" name="file" class="form-control" />
                                        </div>
                                    </div><!-- /.box-body -->
                                    <div class="box-footer">
   <a class="btn btn-info" href="<?php echo site_url('request/request_list_books/1'); ?>" id="addBook">Add Book</a>
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
	$('div#Books').load('<?php echo site_url('request/request_books'); ?>');
	$("#addBook").fancybox({
		'width'				: '75%',
		'height'			: '100%',
		'autoScale'			: false,
		'transitionIn'		: 'none',
		'transitionOut'		: 'none',
		'type'				: 'iframe'
	});
	
	$('a#fancybox-close').click(function(){
		$('div#Books').load('<?php echo site_url('request/request_books'); ?>');
	});
	
	$.fancybox.originalClose = $.fancybox.close;
	$.fancybox.close = function() {
		$('div#Books').load('<?php echo site_url('request/request_books'); ?>');
		$.fancybox.originalClose();
	}
	
	$('select[name="bfrom"]').val(<?php echo $this -> memcachedlib -> sesresult['ubranchid']; ?>);
	$('#pbranch').css('display','none');
});
</script>
