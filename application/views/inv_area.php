<?php 
//print_r($area);
foreach ($area as $k=>$v){
$xx[$k]=array("id" =>$v->aid ,"value" =>$v->aname );
}
?>
<script>
$(function() {
	var save_note="";
$('#demo2').autocomplete({			
                 delay: 0, cacheLength: 0, source: <?php echo json_encode($xx);?>,
				minLength: 1,
        select: function(event, ui) {					
					save_note	=	ui.item.id;					
					//alert(save_note);
					$("#demo3").val(save_note);
					//return false;					
        }				 
				
        });	

$('#tbayar').autocomplete({			
                 delay: 0, cacheLength: 0, source: <?php echo json_encode($tb);?>,		
});
	
$("#search").autocomplete({
delay:0, 
cacheLength: 0,
minLength: 1,
    source: '<?php echo site_url('penjualan_kredit/home/source?branch='.$branch); ?>',
     select: function(event, ui) { 
        $("#theHidden").val(ui.item.cid) ,
		$("#theHiddenx").val(ui.item.cdisc),
		$("#theHiddeny").val(ui.item.ctax),
		$("#theHiddenz").val(ui.item.ctx), 
		$("#thecode").val(ui.item.ccode),
		$("#thegudang").val(ui.item.gid),
		$("#thegname").val(ui.item.gname),
		$("#thebcode").val(ui.item.bcode)
		
    }
	

})

});
</script>	

  <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Invoice Area
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo site_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Invoice</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">

				  <div class="row">
						
						
						<form action="<?php echo site_url('piutang/home/inv_area'); ?>" method="post">
                        <div class="col-xs-6" style="height: 60px;">
                                    <div class="form-group">
                                        <label>Status:</label>
                                        <div class="input-group col-lg-10">
                                            
											<select name="istat" class="form-control" >
											<option value="">Pilih</option>
											<option value="1">On Proses</option>
											<option value="2">Belum di tagih</option>
											<option value="3">Done</option>
                                            </select>
										
                                        </div><!-- /.input group -->
                        <button class="btn text-muted text-center btn-danger" type="submit" style="position: relative;top: -34px;float: right;margin-right: 38px;">Cari</button>
                                    </div><!-- /.form group -->
						</div>
						</div>
						</form>

				
				  <div class="row">
						
						
						<form action="<?php echo site_url('piutang/home/inv_area'); ?>" method="post">
                        <div class="col-xs-6" style="height: 60px;">
                                    <div class="form-group">
                                        <label>Area:</label>
                                        <div class="input-group col-lg-10">
                                            
											<input type=text id="demo2" name="productidname" class="form-control" >
                                            
											<input type=hidden id="demo3" name="aid" >	
                                        </div><!-- /.input group -->
                        <button class="btn text-muted text-center btn-danger" type="submit" style="position: relative;top: -34px;float: right;margin-right: 38px;">Cari</button>
                                    </div><!-- /.form group -->
						</div>
						</div>
						</form>
						
						
				
	                    <div class="row">
						
						
						<form action="<?php echo site_url('pembayaran/pembayaran_excel/'); ?>" method="post">
                        <div class="col-xs-6" style="height: 60px;">
                                    <div class="form-group">
                                        <label>Date range:</label>
                                        <div class="input-group col-lg-10">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="text" class="form-control pull-right" id="datesort" name="datesort" autocomplete="off" />
                                        </div><!-- /.input group -->
                        <button class="btn text-muted text-center btn-danger" type="submit" style="position: relative;top: -34px;float: right;margin-right: 38px;">Go!</button>
                                    </div><!-- /.form group -->
						</div>
						</div>
						</form>
				
				
				
                    <div class="row">
			
			
			
			
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
		  <th>Area</th>		
		  <th>Total Tagihan</th>	
		  <th>Status Bayar</th>
		  <th>Deatil</th>
         

          <!--th style="width: 80px;"></th-->
                                        </tr>
                                    </thead>
                                    <tbody>
		  <?php
		  
		  foreach($piutang as $k => $v) :
		  //$phone = explode('*', $v -> tnofaktur);
		  $appr= $v -> approval;
		  if($v -> istatus==1){ $sb="On Proses";}
		  elseif ($v -> istatus==3){ $sb="Done";}
		  else{ $sb="Belum di tagih";}
		  ?>
          <tr>
		  <td><?php echo $v -> aname; ?></td>		
          <td><?php echo $v -> tg; ?></td>
		  <td><?php echo $sb ?></td>
		  <td><a href="<?php echo site_url('piutang/home/inv_cust_id/'. $v -> aid); ?>"><i class="fa fa-book"></i></a></td>

		  

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

			
			<script type="text/javascript">
$(function(){
	$('#datesort').daterangepicker();
});
</script>
