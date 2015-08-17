
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Journal Add
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo site_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="<?php echo site_url('journal'); ?>">Journal</a></li>
                        <li class="active">Journal Add</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
	<?php echo __get_error_msg(); ?>
<div class="box box-primary">
                                <!-- form start -->
                                 <form role="form" action="<?php echo site_url('journal/journal_add'); ?>" method="post">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label>Type</label>
                        <select name="type" class="form-control" /><?php echo __get_transaction_account_type(0,2); ?></select>
                                        </div>
                                        <div class="form-group">
                                            <label>Title</label>
                        <input type="text" placeholder="Journal Title" name="title" class="form-control" />
                                        </div>
                                        <div class="form-group">
                                            <label>Document Reff</label>
                        <input type="text" placeholder="Document Reff" name="docref" class="form-control" />
                                        </div>
                                        <div class="form-group">
                                            <label>Description</label>
											<textarea name="desc" class="form-control" placeholder="Description"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Status</label>
                                            <?php echo __get_status(0,2); ?>
                                        </div>
                <div class="form-group">
							<label>Account</label>
						<button class="btn text-muted text-center btn-success" type="button" id="AddAcc">Add Account</button>
						<input type="hidden" name="numrows" id="numrows" value="0">
					<p>&nbsp;</p>
					<p>&nbsp;</p>
                    <div class="col-lg-10" style="float:none!important;margin:0 auto;">
						<div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
          <th>COA</th>
          <th>Debit</th>
          <th>Credit</th>
          <th>Description</th>
          <th></th>
                                        </tr>
                                    </thead>
                                    <tbody id="glchild">
                                            </tbody>
                                            <tfoot>
                                            <tr>
                                <td style="text-align: right;">Total :</td>
                                <td style="text-align: right;"><span id="totalDebit">0</span></td>
                                <td style="text-align: right;"><span id="totalCredit">0</span></td>
                                <td></td>
                                <td></td>
												</tr>
                                            </tfoot>
                                </table>
                                </div>
					</div>
				</div>
                                    <div class="box-footer">
                                        <button type="button" class="btn btn-primary"> <i class="fa fa-check"></i> Post</button>
                                        <button type="submit" class="btn btn-primary"> <i class="fa fa-save"></i> Submit</button>
										<button class="btn btn-default" type="button" onclick="location.href='javascript:history.go(-1);'">Back</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                                    </div><!-- /.box-body -->

                </section><!-- /.content -->
            </aside><!-- /.right-side -->
<script type="text/javascript">
$('#AddAcc').click(function(){
	var numrows = $('#numrows').val();
	numrows++;
	$('#numrows').val(numrows);
	res = '';
	res += '<tr id="row_' + numrows + '">';
	res += '<td><select name="coas[]" class="form-control"><?php echo str_replace(array("\n", "\r"), '', $coa); ?></select></td>';
	res += '<td><input class="form-control" type="text" name="debit[]" style="text-align: right;" id="debit_' + numrows + '" value="0" onchange="debitChanged(' + numrows + ')"></td>';
	res += '<td><input class="form-control" type="text" name="credit[]" style="text-align: right;" id="credit_' + numrows + '" value="0" onchange="creditChanged(' + numrows + ')"></td>';
	res += '<td><input class="form-control" type="text" name="descc[]" id="desc_' + numrows + '" value=""></td>';
	res += '<td><button type="button" id="btn_remove_coa_' + numrows + '" onclick="removeRow(' + numrows + ');" class="btn btn-primary" style="margin-top: 2px;"><i class="fa fa-minus"></i></button></td>';
	res += '</tr>';
	$('#glchild').append(res);
});
var removeRow = function(numrow){
	$('#glchild #row_' + numrow).detach();
	$('#numrows').val($('#numrows').val() - 1);
	totalDebit();
	totalCredit();
	return true;
}

var debitChanged = function(numrow) {
	$('#credit_' + numrow).val(0);
	totalDebit();
	totalCredit();
}

var creditChanged = function(numrow) {
	$('#debit_' + numrow).val(0);
	totalDebit();
	totalCredit();
}

var totalDebit = function() {
	numrows = $('#numrows').val();
	var totaldebit = 0;
	for(i=1; i<=numrows; i++){
		if($('#debit_' + i).length > 0 && $('#debit_' + i).val() != '' && $('#debit_' + i).val() != 0){
			totaldebit += parseInt($('#debit_' + i).val());
		}
	}
	$('#totalDebit').html(totaldebit);
}
var totalCredit = function() {
	numrows = $('#numrows').val();
	var totalcredit = 0;
	for(i=1; i<=numrows; i++){
		if($('#credit_' + i).length > 0 && $('#credit_' + i).val() != ''){
			totalcredit += parseInt($('#credit_' + i).val());
		}
	}
	$('#totalCredit').html(totalcredit);
}
$('#post').click(function(){
	$('form.form-horizontal').append('<input type="hidden" name="ispost" value="1">');
	$('form.form-horizontal').submit();
});
</script>
        <!-- END PAGE CONTENT -->
