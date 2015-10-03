
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
<!--
                                        <div class="form-group">
                                            <label>Doc No.</label>
                        <input type="text" placeholder="Doc No." name="docno" class="form-control" />
                                        </div>
-->
                                        <div class="form-group">
                                            <label>Request No.</label>
                         <select name="rno" class="form-control"><?php echo $rno; ?></select>
                                        </div>
                                        <div class="form-group">
                                            <label>Date</label>
                        <input type="text" placeholder="Date Transfer" name="waktu" class="form-control" />
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
	$('select[name="rno"]').change(function(){
		$('div#Books').load('<?php echo site_url('transfer/transfer_request_books/'); ?>'+'/'+$(this).val());
	});
	$('input[name="waktu"]').datepicker({format: 'dd/mm/yyyy'});
});
</script>
