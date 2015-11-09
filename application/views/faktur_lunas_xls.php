<?php
$filename ="excelreport.xls";
header('Content-type:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename='.$filename);
header("Cache-Control: max-age=0");
?>
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
   

                <!-- Main content -->
                <section class="content">
				
				
				
	                    <div class="row">
						
				
				
				
                    <div class="row">
			
						</div>
						<br />
				
                    <div class="row">
                        <div class="col-xs-12">

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
		  <th>Total Tagihan</th>		
		  <th>Status Bayar</th>
         

          <!--th style="width: 80px;"></th-->
                                        </tr>
                                    </thead>
                                    <tbody>
		  <?php
		 
		  foreach($lunas_all as $k => $v) :
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
		  
		  foreach($lunas_faktur as $a => $b) {
			  
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
			  <td><?php echo $b -> cname; ?></td>
			  <td><?php echo $b -> ttanggal; ?></td>
			  <td><?php echo $b -> tnofaktur; ?></td>
			  <td><?php echo $b -> tg; ?></td>			  
			  <td><?php echo $sb ?></td>	  
		  </tr>	  
				  
				  <?php
				  
			  }
		  }
		  
		
		  ?>
		  
		
		  
		
          <tr>
			  <td>TOTAL</td>								
			  <td>&nbsp;</td>
			  <td>&nbsp;</td>
			  <td>&nbsp;</td>
			  
		  
			  

	<?php 

$atall=$ttag1z+$atall;
$btall=$ttag2z+$btall;
$ctall=$ttag3z+$ctall;
$dtall=$ttag4z+$dtall;
$etall=$ttagx4z+$etall;
?>	

			  <th><?php 
			  //$tg_all=$v -> tg;
			  $tg_all=$ttag1z+$ttag2z+$ttag3z+$ttag4z+$ttagx4z;
			  echo $tg_all; ?></th>
			  <!--td>&nbsp;</td-->

			  
		<!--th><?=$atall;?></th>
		<th><?=$btall;?></th>
		<th><?=$ctall;?></th>
		<th><?=$dtall;?></th>
		<th><?=$etall;?></th-->			  
			  
			  
			  
			  
			  <td><?php echo $sb ?></td>	  
		  </tr>
        <?php endforeach; ?>
		
		
  <tr>
			  <th>TOTAL ALL</th>								
			  <td>&nbsp;</td>
			  <td>&nbsp;</td>
			  <td>&nbsp;</td>
			  
		  
			  
			  <th><?php   
			  $tgallz=$atall+$btall+$ctall+$dtall+$etall;
			  echo $tgallz; ?></th>
		  
			  
			  
			  
			  
			  <td>&nbsp;</td>	  
		  </tr>				
		
		
		
		
		
		
		
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
