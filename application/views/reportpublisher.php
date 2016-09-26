<style>
.ui-datepicker-calendar {
    display: none;
 }
</style>
<!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                         Report Publisher
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo site_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Report Publisher</li>
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
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label>Format:</label><br>
                                            Print <input name="format" checked type="radio" value="1">
                                            Excel <input name="format" type="radio" value="2">
                                        </div>
                                        <div class="form-group">
                                        <label>Date Range:</label>
                                        <div class="form-group">
                                            <input type="text" class="form-control pull-right" id="datesort" name="datesort" autocomplete="off" />
											
                                        </div><!-- /.input group -->
                                        </div>
                                        <div class="form-group">
                                            <label>Publisher:</label>
                                            <select id="tpublisher" multiple data-placeholder="Choose Publisher" class="form-control" name="publisher[]">
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
<?php if ($done) { ?>
$('select#tpublisher').val(<?php echo json_encode($_POST['publisher']);?>);
$('select').trigger("chosen:updated");
<?php } ?>
$(function(){
	$('#datesort').datepicker({
		changeMonth: true,
		changeYear: true,
		showButtonPanel: true,
		dateFormat: 'mm,yy'
	}).focus(function() {
		var thisCalendar = $(this);
		$('.ui-datepicker-calendar').detach();
		$('.ui-datepicker-close').click(function() {
			var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
			var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
			thisCalendar.datepicker('setDate', new Date(year, month, 1));
		});
	});
});
</script>
