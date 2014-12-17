<style>
div#txtHint {
width: 98%;
left: 11px;	
}
</style>
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Promotion Add
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo site_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="<?php echo site_url('promo'); ?>">Promotion</a></li>
                        <li class="active">Promotion Add</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
	<?php echo __get_error_msg(); ?>
<div class="box box-primary">
                                <!-- form start -->
                                 <form role="form" action="<?php echo site_url('promo/promo_add'); ?>" method="post">
                                    <div class="box-body">
										                                        <div class="form-group">
                                            <label>Type</label>
                                            <?php echo __get_promo_type(0,2); ?>
                                        </div>
                                        <div class="form-group">
                                            <label>Customer / Area</label>
                        <input type="text" placeholder="Customer/Area" name="custarea" class="form-control" autocomplete="off" />                        <span id="sg1"></span>
                        <input type="hidden" name="caid" />
                                        </div>
                                        <div class="form-group">
                                            <label>Books</label>
                                            <select class="form-control" name="books">
												<?php echo $books; ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Title</label>
                        <input type="text" placeholder="Title" name="title" class="form-control" />
                                        </div>
                                        <div class="form-group">
                                            <label>Discount Publisher</label>
                        <input type="text" placeholder="Discount Publisher" name="discp" class="form-control" />
                                        </div>
                                        <div class="form-group">
                                            <label>Discount Customer</label>
                        <input type="text" placeholder="Discount Customer" name="discc" class="form-control" />
                                        </div>
                                    <div class="form-group">
                                        <label>Date range:</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="text" class="form-control pull-right" id="datesort" name="period" autocomplete="off" />
                                        </div>
                                    </div><!-- /.form group -->
                                        <div class="form-group">
                                            <label>Description</label>
											<textarea name="desc" class="form-control" placeholder="Description"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Status</label>
                                            <?php echo __get_status(0,2); ?>
                                        </div>
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
	$('input#promoType').change(function(){
		if ($(this).val() == 1) {
			$('input[name="custarea"]').sSuggestion('span#sg1','<?php echo site_url('area/get_suggestion'); ?>', 'caid');
		}
		else {
			$('input[name="custarea"]').sSuggestion('span#sg1','<?php echo site_url('customer/get_suggestion'); ?>', 'caid');
		}
	});
	$('input[name="custarea"]').sSuggestion('span#sg1','<?php echo site_url('customer/get_suggestion'); ?>', 'caid');
	$('#datesort').daterangepicker();
});
</script>
