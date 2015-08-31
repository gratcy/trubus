<?php 
 $branch=$this -> memcachedlib -> sesresult['ubranchid'];  
?>
	<!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                         Report Transaction
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo site_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Report Transaction</li>
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
                <div class="form-group" >
                    <label>Final</label>
						<select class="form-control" name=approval >
						<option value=0 >No</option>
						<option value=2 >Yes</option>
						</select>
                </div>
				<input type="hidden" name="branchid" value="<?=$branch;?>" >
                                        <div class="form-group">
                                            <label>Transaction Type:</label><br>
                                            
											<input type=checkbox name=typea value="ALL"> ALL <br>
											<input type=checkbox name=typeb value="JC"> Penjualan Kredit <br>
											<input type=checkbox name=typec value="JK"> Penjualan Konsinyasi <br>
											<input type=checkbox name=typed value="HP"> Hasil Penjualan <br>
											<input type=checkbox name=typee value="RJC"> Retur Penjualan Kredit<br>
											<input type=checkbox name=typef value="RJK"> Retur Penjualan Konsinyasi<br>
											<input type=checkbox name=typeg value="RHP"> Retur Hasil Penjualan<br>
											<input type=checkbox name=typei value="RB"> Retur Pembelian<br>
                                        </div>
                                        <div class="form-group">
                                            <label>Report Type:</label><br>
                                            <select name="rtype" data-placeholder="Choose Report Type" class="form-control">
                                            <?php echo __get_reporting_type(0,2);?>
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
                                        <div class="form-group ">
                                            <label>Customer:</label>
                                            <div class="clear"></div>
                                            <div class="col-xs-4">
												<label>From:</label>
                                           <select id="tcustomer" data-placeholder="Choose Customer" class="form-control" name="customer">
											   <option value=""></option>
											   <?php echo $customer; ?>
                                            </select> 
                                            </div>
                                            <div class="col-xs-4">
												<label>To:</label>
                                           <select id="tcustomer" data-placeholder="Choose Customer" class="form-control" name="customerr">
											   <option value=""></option>
												<?php echo $customer; ?>
                                            </select>
                                            </div>
                                            <div class="clear"></div>
                                        </div>
										<div class="form-group">
                                            <label>Kode Area:</label>
                                            <div class="clear"></div>
                                            <div class="col-xs-4">
												<label>From:</label>
											<select id="tpublisher" data-placeholder="Choose Area" class="form-control" name="area">
												<?php echo $area; ?>
                                            </select>
                                            </div>
                                            <div class="col-xs-4">
												<label>To:</label>
											<select id="tpublisher" data-placeholder="Choose Area" class="form-control" name="areax">
												<?php echo $area; ?>
                                            </select>
                                            </div>
                                            <div class="clear"></div>
                                        </div>
                                        <div class="form-group">
                                            <label>Publisher:</label>
                                            <div class="clear"></div>
                                            <div class="col-xs-4">
												<label>From:</label>
                                            <select id="tpublisher" data-placeholder="Choose Publisher" class="form-control" name="publisher">
												<?php echo $publisher; ?>
                                            </select>											
                                            </div>
                                            <div class="col-xs-4">
												<label>To:</label>
                                            <select id="tpublisher" data-placeholder="Choose Publisher" class="form-control" name="publisherx">
												<?php echo $publisher; ?>
                                            </select>												
                                            </div>
                                            <div class="clear"></div>
                                        </div>
                                        <div class="form-group">
                                            <label>Kode Buku:</label>
                                            <div class="clear"></div>
                                            <div class="col-xs-4">
												<label>From:</label>
											<select id="tpublisher" data-placeholder="Choose Books" class="form-control" name="kode_buku">
												<?php echo $books; ?>
                                            </select>
                                            </div>
                                            <div class="col-xs-4">
												<label>To:</label>
											<select id="tpublisher" data-placeholder="Choose Books" class="form-control" name="kode_bukux">
												<?php echo $books; ?>
                                            </select>											
                                            </div>
                                            <div class="clear"></div>
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
$('select#tpublisher').val(<?php echo json_encode($_POST['publisher']);?>);
$('select#tcustomer').val(<?php echo json_encode($_POST['customer']);?>);
$('select').trigger("chosen:updated");
<?php } ?>
$('select[name="branch"]').val(<?php echo $this -> memcachedlib -> sesresult['ubranchid']; ?>);
$('#pbranch').css('display','none');
$(function(){
$('#datesort').daterangepicker();
});

$(function(){
$('#datesortx').daterangepicker();
});
</script>
