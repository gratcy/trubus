
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Transfer Add
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo site_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="<?php echo site_url('transfer'); ?>">Transfer</a></li>
                        <li class="active">Transfer Add</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
	<?php echo __get_error_msg(); ?>
<div class="box box-primary">
                                <!-- form start -->
                                 <form role="form" action="<?php echo site_url('transfer/transfer_add'); ?>" method="post">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label>Request Type</label>
                                            <select class="form-control" name="rtype">
											<?php echo __get_request_type($detail[0] -> dtype,2);?>
                                            </select>
                                        </div>
                                        <div class="form-group" id="rno">
                                            <label>Request No.</label>
                         <select name="rno" class="form-control"><?php echo $rno; ?></select>
                                        </div>
                                        <div class="form-group" id="rno2">
                                            <label>Request No.</label>
                         <select name="rno2" class="form-control"><?php echo $rno2; ?></select>
                                        </div>
                                        <div class="form-group">
                                            <label>Date</label>
                        <input type="text" placeholder="Date Transfer" name="waktu" class="form-control" autocomplete="off" />
                                        </div>
                                        <div class="form-group">
                                            <label>Title</label>
                        <input type="text" placeholder="Transfer Title" name="title" class="form-control" />
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
	$('select[name="rno"], select[name="rno2"]').change(function(){
		$('div#Books').load('<?php echo site_url('transfer/transfer_request_books/'); ?>'+'/'+$(this).val());
	});
	$('select[name="rtype"]').change(function(){
		if ($(this).val() == 1) {
			$('#rno2').css({'display':'none'});
			$('#rno').css({'display':'block'});
			$('#rno .chosen-container, #rno2 .chosen-container').css('width','100%');
		}
		else {
			$('#rno2').css({'display':'block'});
			$('#rno').css({'display':'none'});
			$('#rno .chosen-container, #rno2 .chosen-container').css('width','100%');
		}
	});
	
	$('select[name="rtype"]').chosen({disable_search_threshold: 10});
	$('select[name="rtype"]').change();
	$('input[name="waktu"]').datepicker({dateFormat: 'dd/mm/yy'});
});
</script>
