<script>

$(function(){
$('#datesort').daterangepicker();
});
</script>

<script>
$(function() {
$("#search").autocomplete({
delay:0, 
cacheLength: 0,
minLength: 1,
source: '<?php echo site_url('purchase_order/home/sourceg'); ?>',
select: function(event, ui) { 
$("#theHidden").val(ui.item.gid) ,
 
$("#thegaddress").val(ui.item.gaddress)

}


})

});
</script>

<?php
if(!isset($_POST['excel'])){$_POST['excel']="";}
if($_POST['excel']=='EXCEL'){
$filename ="excelreport.xls";
header('Content-type:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename='.$filename);
header("Cache-Control: max-age=0");
}else{
?>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Purchase Order
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo site_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Purchase Order</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
	<?php echo __get_error_msg(); ?>
								<form method=POST  >
							<b>No Faktur</b><br><input type=text name="no_po" >            
							<input type=submit name=cari value=cari >

							</form>
								<form method=POST  >
							<b>Type Order</b><br><select name="ttypetrans" >  
							<option value=1 >Reguler</option>
							<option value=2 >Projek</option>
							<option value=3 >Pameran</option>
							</select>							
							<input type=submit name=cari value=cari >

							</form>							
							<form method=POST  >
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
	<label>Nama Gudang</label>
	 
<input autofocus="autofocus" name=gname type="text" id="search" class="form-control"   />					
<input  name=tgid type="hidden" id="theHidden" class="form-control"   />											
											
											
											
											<input type=submit name="excel" value="EXCEL" >
                                        
                                        </div>	
							</form>

      							
							<div class="box">
                                <div class="box-header">
								

								
								
								
								
								
								
								
                                    <h3 class="box-title">
                <a href="<?php echo site_url('purchase_order/purchase_order_add'); ?>" class="btn btn-default"><i class="fa fa-plus"></i> Add</a></h3>
                                </div><!-- /.box-header -->
								
								
	<?php } ?> 							
								
                                <div class="box-body table-responsive">
                                    <table class="table table-bordered">
                                    <thead>
                                        <tr>
		  <th>No Faktur</th>	
		  <th>Gudang</th>							
          
          <th>Tanggal</th>
		  <th>Type Order</th>

<?php if($_POST['excel']=='EXCEL'){		?>
		  <th>No Req</th>	
		  <th>Judul</th>								
          <th>Kode Baru</th>
          <th>Kode Lama</th>
          <th>Harga</th>
          <th>Qty</th>
          <th>Brutto</th>
<?php } ?>  
		  
		  
          <th style="width: 80px;"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
		  <?php
		  foreach($purchase_order as $k => $v) :
		  //$phone = explode('*', $v -> tnofaktur);
		  ?>
          <tr>
		  <td><?php echo $v -> tnofaktur; ?></td>								
          <td><?php echo $v -> gname; ?></td>
          
          <td><?php echo $v -> ttanggal; ?></td>
		  <td><?php 
		  if($v -> ttypetrans=='1'){
			  $ttrans="Reguler";
		  }elseif($v -> ttypetrans=='2'){
			  $ttrans="Projek";
		  }elseif($v -> ttypetrans=='3'){
			  $ttrans="Pameran";
		  }
		  
		  
		  echo $ttrans; ?></td>

<?php if($_POST['excel']=='EXCEL'){		?>
		  <td><?php echo $v -> gd_from; ?></td>								
          <td><?php echo $v -> btitle; ?></td>
          <td><?php echo $v -> bcode; ?></td>
          <td><?php 
		  $blama=explode("|",$v -> btitle);
		  if(!isset($blama[1])){$blama[1]="";}
		  echo $blama[1]; ?></td>
          <td><?php echo $v -> tharga; ?></td>
          <td><?php echo $v -> tqty; ?></td>

          <td><?php echo $v -> tharga * $v -> tqty; ?></td>
<?php } ?>		  
		  
		  <td>
	<?php if ($v -> tstatus <> 2) { ?>
	              <a href="javascript:void(0);" onclick="print_data('<?php echo site_url('purchase_order_details/home/purchase_order_faktur/' . $v -> tid); ?>', 'Print Penawaran');"><i class="fa fa-print"></i></a>
              <a href="<?php echo site_url('purchase_order_details/purchase_order_details_add/' . $v -> tid); ?>"><i class="fa fa-pencil"></i></a>
              <a href="<?php echo site_url('purchase_order/purchase_order_delete/' . $v -> tid); ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-times"></i></a>
		<?php } ?>
		</td>
										</tr>
        <?php endforeach; ?>
                                    </tbody>
                                    </table>
                                </div><!-- /.box-body -->
                                <div class="box-footer clearfix">
                                    <ul class="pagination pagination-sm no-margin pull-right">
                                        <?php echo $pages; ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                </section><!-- /.content -->
            </aside><!-- /.right-side -->
