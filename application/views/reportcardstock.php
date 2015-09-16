
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Report Card Stock
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo site_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Report Card Stock</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
	<?php echo __get_error_msg(); ?>
<div class="box box-primary">
                                <!-- form start -->
                                 <form role="form" action="" method="post">
                                    <div class="box-body">
                <div class="form-group" id="pbranch">
                    <label>Branch</label>
						<select name="branch" data-placeholder="Branch" class="form-control chzn-select"><?php echo $branch; ?></select>
                </div>
                                        <div class="form-group">
                                            <label>Transaction Type:</label>
                                            <select id="ttype" class="form-control" name="type[]" data-placeholder="Transaction Type" multiple="true">
												<?php echo __get_transaction_type(0);?>
											</select>
                                        </div>
                                        <div class="form-group">
                                        <label>Date Range:</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="text" class="form-control pull-right" id="datesort" name="datesort" autocomplete="off" />
                                        </div><!-- /.input group -->
                                        </div>
                                        <div class="form-group">
                                            <label>Customer:</label>
                                            <select id="tcustomer" data-placeholder="Choose Customer" class="form-control" name="customer[]" multiple="true">
												<?php echo $customer; ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Publisher:</label>
                                            <select id="tpublisher" data-placeholder="Choose Publisher" class="form-control" name="publisher[]" multiple="true">
												<?php echo $publisher; ?>
                                            </select>
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
function rprint_data(url, title) {
	var left = (screen.width/2)-(860/2);
	var top = (screen.height/2)-(400/2);
	var win = window.open(url, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, copyhistory=no, width=860, height=400, top='+top+', left='+left);
	win.focus();
}
<?php if ($done) { ?>
rprint_data('<?php echo site_url('reportcardstock/print_card_stock'); ?>', 'Cetak Kartu Stok');
$('select#ttype').val(<?php echo json_encode($_POST['type']);?>);
$('select#tpublisher').val(<?php echo json_encode($this -> input -> post('publisher'));?>);
$('select#tcustomer').val(<?php echo json_encode($_POST['customer']);?>);
$('select').trigger("chosen:updated");
<?php } ?>

$(document).ready(function(){
	$('select[name="branch"]').val(<?php echo $this -> memcachedlib -> sesresult['ubranchid']; ?>);
	$('#pbranch').css('display','none');
});

$(function(){
$('#datesort').daterangepicker();
});
</script>
