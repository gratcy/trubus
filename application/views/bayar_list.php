
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Invoice
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo site_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Invoice</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
				
				
				
	                    <div class="row">
						
                        <p align="left">
                                    
                                       
                        <a href="<?php echo site_url('pembayaran/home/bayar_excel/'.$invid); ?>" class="btn text-muted text-center btn-danger"  style="position: relative;float: left;margin-left: 10px;top:3px;">EXPORT EXCEL</a>
                                   <!-- /.form group -->
						</p>
						</div>
						
				
				
				
                    <div class="row">
						<!--form action="<?php echo site_url('pembayaran/pembayaran_search/'); ?>" method="post">
                <div class="form-group">
                    <label for="text1" class="control-label col-lg-2">No Faktur / Customer</label>
                        <div class="col-xs-4">
                        <input type="text" style="width:200px!important;display:inline!important;" placeholder="No Faktur / Customer" name="keyword" class="form-control" autocomplete="off" />
                        <button class="btn text-muted text-center btn-danger" type="submit">Go!</button>
                        <span id="sg1"></span>
                        <input type="hidden" name="id" />
						</div>
						</div>
						</form-->
						</div>
						<br />
				
                    <div class="row">
                        <div class="col-xs-12">
	<?php echo __get_error_msg(); ?>

							<div class="box">
                                <div class="box-header">
								
								
								
								
								
								
								
								
                                </div><!-- /.box-header -->
                                <div class="box-body">
                                    <table class="table table-bordered">
                                    <thead>
                                        <tr>
		  <th>No Invoice</th>	
		  <th>Area</th>	
			  
          <th>Tanggal Invoice</th>
          <th>Type Bayar</th>
          
		  <th>Grand Total</th>
          <th>Info</th>
		  <th>Status</th>
          <th style="width: 80px;"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
<?php 
$branchid=$this -> memcachedlib -> sesresult['ubranchid'];
//print_r($bayarz);
foreach ($bayarz as $k=>$v){ 

if($v->pbstatus==1){
	$pbst="pending";
}elseif($v->pbstatus==3){
	$pbst="Done";
}	
?>




          <tr>
		  								
          <td><?=$invoice[0]->invno;?></td>
<td><?=$v->aname;?></td>		  
          <td><?=$v->pbdate;?></td>
		  <td><?=$v->pbtype;?></td>
          <td><?=$v->pbsetor;?></td>
		  
          
		  <td style="text-align:right;"><?=$pbst;?></td>
          <td><a href="<?php echo site_url('pembayaran/home/bayar_approve/' . $v ->invid.'/'.$branchid); ?>"><i class="fa fa-pencil"></i></a></td>
		  
		  
	
										</tr>
<?php } ?>
                                    </tbody>
                                    </table>
									


<?php 

echo 'terima: '.$terima[0]->terima.'<br>';
echo 'pending: '.$pending[0]->setor.'<br>';

?>
									
									
									
									
									
									
									
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

			
			<script type="text/javascript">
$(function(){
	$('#datesort').daterangepicker();
});
</script>
