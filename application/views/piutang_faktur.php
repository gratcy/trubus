
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Piutang Customer
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo site_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Piutang Customer</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
				
				
				
	                    <div class="row"><br><br>
						<form action="<?php echo site_url('piutang/home/pfaktur_xls/'); ?>" method="post">
                      
                        <div class="form-group">
                        <p align=left>                
                        <button class="btn text-muted text-center btn-danger" type="submit" style="position: relative;top: -34px;float: right;margin-right: 38px;">EXPORT EXCEL</button>
						</p>
                                   
						</div>
						</div>
						</form>
				
				
				
                                        <div class="row">
						<form action="<?php echo site_url('piutang/home/piutang_search/'); ?>" method="post">
                <div class="form-group">
                    <label for="text1" class="control-label col-lg-2">No Faktur / Customer</label>
                        <div class="col-xs-4">
                        <input type="text" style="width:200px!important;display:inline!important;" placeholder="No Faktur / Customer" name="keyword" class="form-control" autocomplete="off" />
                        <button class="btn text-muted text-center btn-danger" type="submit">Go!</button>
                        <span id="sg1"></span>
                        <input type="hidden" name="id" />
						</div>
						</div>
						</form>
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
		  <th>Customer</th>
          <th>Tanggal</th>		  
		  <th>No Faktur</th>
<th>JTP</th>
<th>Lama</th>
<th>Term</th>
<th>Lewat</th>		  
		  <th>Total Tagihan</th>
		<th>Lama Tagihan</th>
		<th>1 bulan</th>
		<th>2 bulan</th>
		<th>3 bulan</th>
		<th>4 bulan</th>
		<th> > 4 bulan</th>
		  <th>Status Bayar</th>
         

          <!--th style="width: 80px;"></th-->
                                        </tr>
                                    </thead>
                                    <tbody>
		  <?php
		  
		  foreach($piutang as $k => $v) :
		  //$phone = explode('*', $v -> tnofaktur);
		  
		  
		  $appr= $v -> approval;
		  
		  if($v -> tsbayar==1){ $sb="On Proses";}
		  elseif ($v -> tsbayar==3){ $sb="Done";}
		  else{ $sb="Belum di tagih";}?>
		  
		  <?php
		  $tcid=$v -> tcid;
		 // print_r($piutang_faktur);
		  
		  $ttag1z=0;
		  $ttag2z=0;
		  $ttag3z=0;
		  $ttag4z=0;
		  $ttagx4z=0;
		  
		  foreach($piutang_faktur as $a => $b) {
			  if($sb=="On Proses"){
				$b->tg=$b->tongkos;  
			  }
			  if ($b -> tcid == $tcid){
				  $jmonth=ceil($b -> jdate/30);
				  $tg=$b -> tg;
				  //echo $jmonth;
				 if($jmonth==1) {$ttag1= $tg;}else{ $ttag1=0;}
				 if($jmonth==2) {$ttag2= $tg;}else{ $ttag2=0;}
				 if($jmonth==3) {$ttag3= $tg;}else{ $ttag3=0;}
				 if($jmonth==4) {$ttag4= $tg;}else{ $ttag4=0;}
				 if($jmonth >4) {$ttagx4= $tg;}else{ $ttagx4=0;}
				 
		  $ttag1z=$ttag1z+$ttag1;
		  $ttag2z=$ttag2z+$ttag2;
		  $ttag3z=$ttag3z+$ttag3;
		  $ttag4z=$ttag4z+$ttag4;
		  $ttagx4z=$ttagx4z+$ttagx4;				 
				 
				 
				 
				 
				  ?>
			<tr>
			  <td><?php echo $b -> aname; ?></td>								
			  <td><?php echo $b -> cname; ?></td><td><?php echo $b -> ttanggal; ?></td>
			  <td><?php echo $b -> tnofaktur; ?></td>
			  
<th><?=$b -> ttanggal;?></th>
<th><?=$b -> jdate;?></th>
<th>-</th>
<th><?=$b -> jdate;?></th>			  
			  
			  
			  <td><?php echo $b -> tg; ?></td>
			  <td><?php echo $jmonth. ' bln ( '.$b -> jdate .' hari )'; ?></td>
			  
		<th><?=$ttag1;?></th>
		<th><?=$ttag2;?></th>
		<th><?=$ttag3;?></th>
		<th><?=$ttag4;?></th>
		<th><?=$ttagx4;?></th>			  
			  
			  
			  
			  <td><?php echo $sb ?></td>	  
		  </tr>	  
				  
				  <?php
				  
			  }
		  }
		  
		
		  ?>
		  
		  
		  
		  
		  
		  
 <?php
		  $tcid= $v->tcid.'<br>';
		  $dtg=0;
		 // print_r($piutang_faktur);
		  
		  $itag1z=0;
		  $itag2z=0;
		  $itag3z=0;
		  $itag4z=0;
		  $itagx4z=0;
		  //print_r($piutang_invoice);
		  
		  foreach($piutang_invoice as $c => $d) {
			  $dcid=$d->tcid;
	
			  if($d -> tsbayar==1){
				$d->tg=$d->tongkos;  
			  }
	
			  if ($tcid == (int)$dcid){
				  
				 
				  $jjmonth=ceil($d -> jdate/30);
				  $itg=$d -> tg;
				  //echo $jmonth;
				 if($jjmonth==1) {$itag1= $itg;}else{ $itag1=0;}
				 if($jjmonth==2) {$itag2= $itg;}else{ $itag2=0;}
				 if($jjmonth==3) {$itag3= $itg;}else{ $itag3=0;}
				 if($jjmonth==4) {$itag4= $itg;}else{ $itag4=0;}
				 if($jjmonth >4) {$itagx4= $itg;}else{ $itagx4=0;}
				 
		  $itag1z=$itag1z+$itag1;
		  $itag2z=$itag2z+$itag2;
		  $itag3z=$itag3z+$itag3;
		  $itag4z=$itag4z+$itag4;
		  $itagx4z=$itagx4z+$itagx4;				 
				 

		  if($d -> tsbayar==1){ $sbx="On Proses";}
		  elseif ($d -> tsbayar==3){ $sbx="Done";}
		  else{ $sbx="Belum di tagih";}?>				 
				 
				 
			<tr>
			  <td><?php echo $d -> aname; ?></td>								
			  <td><?php echo $d -> cname; ?></td><td><?php echo $d -> ttanggal; ?></td>
			  <td><?php echo $d -> tnofaktur; ?></td>
			  
<th><?=$d -> ttanggal;?></th>
<th><?=$d -> jdate;?></th>
<th>-</th>
<th><?=$d -> jdate;?></th>			  
			  
			  
			  <td><?php 
			  
			  echo $d -> tg; 
			  $dtg=$dtg+ $d -> tg;
			  
			  ?></td>
			  <td><?php echo $jjmonth. ' bln ( '.$d -> jdate .' hari )'; ?></td>
			  
		<th><?=$itag1;?></th>
		<th><?=$itag2;?></th>
		<th><?=$itag3;?></th>
		<th><?=$itag4;?></th>
		<th><?=$itagx4;?></th>			  
			  
			  
			  
			  <td><?php echo $sbx ?></td>	  
		  </tr>	  
				  
		<?php
				  
			  }
		  }
		  
		
		  ?>		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		
          <tr>
			  <td>TOTAL</td>								
			  <td>&nbsp;</td><td>&nbsp;</td>
			  <td>&nbsp;</td>
			  
<th>&nbsp;</th>
<th>&nbsp;</th>
<th>&nbsp;</th>
<th>&nbsp;</th>			  
			  

	<?php 

$atall=$ttag1z	+ $itag1z;
$btall=$ttag2z	+ $itag2z;
$ctall=$ttag3z	+ $itag3z;
$dtall=$ttag4z	+ $itag4z;
$etall=$ttagx4z	+ $itagx4z;
?>	


			  <th><?php 
			  //$tg_all=$v -> tg + $dtg;
			  $tg_all=$atall+$btall+$ctall+$dtall+$etall;
			  echo $tg_all; ?></th>
			  <td>&nbsp;</td>
			  
		<th><?=$atall;?></th>
		<th><?=$btall;?></th>
		<th><?=$ctall;?></th>
		<th><?=$dtall;?></th>
		<th><?=$etall;?></th>			  
			  
			  
			  
			  
			  <td><?php echo $sb ?></td>	  
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
