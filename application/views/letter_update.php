            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Letter Update
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo site_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="<?php echo site_url('letter'); ?>">Letter</a></li>
                        <li class="active">Letter Update</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
	<?php echo __get_error_msg(); ?>
<div class="box box-primary">
	<span class="approved"><button type="button" id="approve" class="btn btn-warning"> <i class="fa fa-save"></i> Approved</button></span>
                                <!-- form start -->
                                 <form role="form" action="<?php echo site_url('letter/letter_update'); ?>" method="post">
<input type="hidden" name="id" value="<?php echo $id; ?>">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label>Letter Type</label>
                                            <select name="ltype" class="form-control"><?php echo __get_letter_type($detail[0] -> ltype,2); ?></select>
                                        </div>
                                        <div class="form-group">
                                            <label>Request No. / Transaction No.</label>
                        <span id="bp"></span>
                                        </div>
                                        <div class="form-group">
                                            <label>Doc No.</label>
                        <input type="text" placeholder="Doc No." name="docno" class="form-control" value="" />
                                        </div>
                                        <div class="form-group">
                                            <label>Description</label>
											<textarea name="desc" class="form-control" placeholder="Description"><?php echo $detail[0] -> ldesc; ?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Status</label>
                                            <?php echo __get_status($detail[0] -> lstatus,2); ?>
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
	$('div#Books').load('<?php echo site_url('letter/letter_books'); ?>');
	$('select[name="ltype"]').change(function(){
		$('span#bp').load('<?php echo site_url('letter/letter_types'); ?>/'+$(this).val());
	});
	$('select[name="ltype"]').change();
	$( document ).ajaxComplete(function() {
		$('select#rid').val(<?php echo $detail[0] -> liid;?>);
	});
	
	$('#approve').click(function(){
		$('form[role="form"]').append('<input type="hidden" name="app" value="1">');
		$('form[role="form"]').submit();
	});
});
</script>
