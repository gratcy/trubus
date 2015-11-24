	<!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                         Report Item Receiving
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo site_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Report Item Receiving</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
	<?php echo __get_error_msg(); ?>
<div class="box box-primary">
                                <!-- form start -->
                                 <form role="form" action="" method="post" target="_blank">
                                    <div class="box-body table-responsive">
                                        <div class="form-group">
                                            <label>Receiving Type</label>
                                            <select name="rtype" class="form-control"><?php echo __get_receiving_type(0,2); ?></select>
                                        </div>
				<input type="hidden" name="branchid" value="<?php echo $this -> memcachedlib -> sesresult['ubranchid']; ?>" >
                                        <div class="form-group" id="pubpub">
                                            <label>Publisher</label>
                                            <select data-placeholder="Choose Publisher" class="form-control" name="publisher[]" multiple="true">
												<?php echo $publisher; ?>
                                            </select>
                                            </div>
                                        <div class="form-group" id="brabra">
                                            <label>Branch</label>
                                            <select data-placeholder="Choose Branch" class="form-control" name="branch[]" multiple="true">
												<?php echo $branch; ?>
                                            </select>
										</div>
                                        <div class="form-group">
                                        <label>Date Range</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="text" class="form-control pull-right" id="datesort" name="datesort" autocomplete="off" />
                                        </div><!-- /.input group -->
                                        </div>
                                        <div class="form-group">
                                            <label>Export Type</label>
                                            Print <input type="radio" name="etype" value="1" checked>
                                            &nbsp;
                                            Excel <input type="radio" name="etype" value="2">
										</div>
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

$(function(){
	$('#brabra').css('display', 'none');
	$('select[name="rtype"]').change(function(){
		$('div.chosen-container-multi').css('width','100%');
		if ($(this).val() == 1) {
			$('#brabra').css('display', 'block');
			$('#pubpub').css('display', 'none');
		}
		else {
			$('#pubpub').css('display', 'block');
			$('#brabra').css('display', 'none');
		}
	});
	$('#datesort').daterangepicker();
});
<?php if ($done && $etype == 1) { ?>
//~ rprint_data('<?php echo site_url('reportitemreceiving/export/html'); ?>', 'Print Report Item Receiving');
$('select').trigger("chosen:updated");
<?php } ?>
</script>
