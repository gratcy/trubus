

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Receiving Add
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo site_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="<?php echo site_url('receiving'); ?>">Receiving</a></li>
                        <li class="active">Receiving Add</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
	<?php echo __get_error_msg(); ?>
<div class="box box-primary">
                                <!-- form start -->
                                 <form role="form" action="<?php echo site_url('receiving/receiving_add'); ?>" method="post" enctype="multipart/form-data">
				<div class="box-body">
                <div class="form-group" id="pbranch">
                    <label>Branch</label>
						<select name="branch" data-placeholder="Branch" class="form-control chzn-select"><?php echo $branch; ?></select>
                </div>
                                        <div class="form-group">
                                            <label>Receiving Type</label>
                                            <select name="rtype" class="form-control"><?php echo __get_receiving_type(0,2); ?></select>
                                        </div>
                                        <div class="form-group">
                                            <label>Request No. / Publisher</label>
                        <span id="bp"></span>
                                        </div>
                                        <div class="form-group">
                                            <label>Doc No.</label>
                        <input type="text" placeholder="Doc No." name="docno" class="form-control" />
                                        </div>
                                        <div class="form-group">
                                            <label>Date</label>
                        <input type="text" placeholder="Date Receiving" name="waktu" class="form-control" autocomplete="off" />
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
                                    </div><!-- /.box-body -->
                                    <div class="box-footer">
                                        <div class="form-group">
                                            <label>Import</label>
                        <input type="file" placeholder="File" name="file" class="form-control" />
                                        </div>
   <a class="btn btn-info" href="<?php echo site_url('receiving/receiving_list_books/1'); ?>" id="addBook">Add Book</a>
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
	$('div#Books').load('<?php echo site_url('receiving/receiving_books'); ?>');
	$("#addBook").fancybox({
		'width'				: '75%',
		'height'			: '100%',
		'autoScale'			: false,
		'transitionIn'		: 'none',
		'transitionOut'		: 'none',
		'type'				: 'iframe'
	});
	
	$('a#fancybox-close').click(function(){
		$('div#Books').load('<?php echo site_url('receiving/receiving_books'); ?>');
	});
	
	$.fancybox.originalClose = $.fancybox.close;
	$.fancybox.close = function() {
		$('div#Books').load('<?php echo site_url('receiving/receiving_books'); ?>');
		$.fancybox.originalClose();
	}
	$('select[name="rtype"]').change(function(){
		$('span#bp').load('<?php echo site_url('receiving/receiving_types'); ?>/'+$(this).val()+'/0');
	});
	$('select[name="rtype"]').change();
	$('input[name="waktu"]').datepicker({format: 'dd/mm/yyyy'});
	
	$('select[name="branch"]').val(<?php echo $this -> memcachedlib -> sesresult['ubranchid']; ?>);
	$('#pbranch').css('display','none');
});
</script>
