

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Receiving Update
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo site_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="<?php echo site_url('receiving'); ?>">Receiving</a></li>
                        <li class="active">Receiving Update</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
	<?php echo __get_error_msg(); ?>
<div class="box box-primary">
                                <!-- form start -->
	<span class="approved"><button type="button" id="approve" class="btn btn-warning"> <i class="fa fa-save"></i> Approved</button></span>
                                 <form role="form" action="<?php echo site_url('receiving/receiving_update'); ?>" method="post">
<input type="hidden" name="id" value="<?php echo $id; ?>">
                                    <div class="box-body">
                <div class="form-group" id="pbranch">
                    <label>Branch</label>
						<select name="branch" data-placeholder="Branch" class="form-control chzn-select"><?php echo $branch; ?></select>
                </div>
                                        <div class="form-group">
                                            <label>Receiving Type</label>
                                            <select name="rtype" class="form-control"><?php echo __get_receiving_type($detail[0] -> rtype,2); ?></select>
                                        </div>
                                        <div class="form-group">
                                            <label>Request No. / Publisher</label>
                        <span id="bp"></span>
                                        </div>
                                        <div class="form-group">
                                            <label>Doc No.</label>
                        <input type="text" placeholder="Doc No." name="docno" class="form-control" value="<?php echo $detail[0] -> rdocno;?>" />
                                        </div>
                                        <div class="form-group">
                                            <label>Date</label>
                        <input type="text" placeholder="Date Receiving" name="waktu" class="form-control" value="<?php echo date('d/m/Y',$detail[0] -> rdate);?>" />
                                        </div>
                                        <div class="form-group">
                                            <label>Description</label>
											<textarea name="desc" class="form-control" placeholder="Description"><?php echo $detail[0] -> rdesc;?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Status</label>
                                            <?php echo __get_status($detail[0] -> rstatus,2); ?>
                                        </div>
                    <div id="Books"></div>
                                    </div><!-- /.box-body -->
                                    <div class="box-footer">
   <a class="btn btn-info" href="<?php echo site_url('receiving/receiving_list_books/2/' . $id); ?>" id="addBook">Add Book</a>
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
	$('div#Books').load('<?php echo site_url('receiving/receiving_books/' . $id); ?>');
	$("#addBook").fancybox({
		'width'				: '75%',
		'height'			: '100%',
		'autoScale'			: false,
		'transitionIn'		: 'none',
		'transitionOut'		: 'none',
		'type'				: 'iframe'
	});
	
	$('a#fancybox-close').click(function(){
		$('div#Books').load('<?php echo site_url('receiving/receiving_books/' . $id); ?>');
	});
	
	$.fancybox.originalClose = $.fancybox.close;
	$.fancybox.close = function() {
		$('div#Books').load('<?php echo site_url('receiving/receiving_books/' . $id); ?>');
		$.fancybox.originalClose();
	}
	$('select[name="rtype"]').change(function(){
		$('span#bp').load('<?php echo site_url('receiving/receiving_types'); ?>/'+$(this).val());
	});
	
	$('select[name="rtype"]').change();
	
	$('#approve').click(function(){
		$('form[role="form"]').append('<input type="hidden" name="app" value="1">');
		$('form[role="form"]').submit();
	});
	$( document ).ajaxComplete(function() {
		$('select#rid').val(<?php echo $detail[0] -> riid;?>);
	});
	$('input[name="waktu"]').datepicker({format: 'dd/mm/yyyy'});
	
	$('select[name="branch"]').val(<?php echo $this -> memcachedlib -> sesresult['ubranchid']; ?>);
	$('#pbranch').css('display','none');
});
</script>
