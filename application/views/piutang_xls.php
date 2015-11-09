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
		  $tg_allz=0;
		  $atallz=0;
		  $btallz=0;
		  $ctallz=0;
		  $dtallz=0;
		  $etallz=0;
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
			 // $tg_all=$v -> tg + $dtg;
			 $tg_all=$atall+$btall+$ctall+$dtall+$etall;
			  echo $tg_all; ?></th>
			  <td>&nbsp;</td>
			  
		<th><?=$atall;?></th>
		<th><?=$btall;?></th>
		<th><?=$ctall;?></th>
		<th><?=$dtall;?></th>
		<th><?=$etall;?></th>			  
			  
<?php 
$tg_allz=$tg_allz+$tg_all;
$atallz=$atallz	+ $atall;
$btallz=$btallz	+ $btall;
$ctallz=$ctallz	+ $ctall;
$dtallz=$dtallz	+ $dtall;
$etallz=$etallz	+ $etall;
?>		  
			  
			  
			  <td>&nbsp;</td>	  
		  </tr>
        <?php endforeach; ?>
		
		
          <tr>
			  <td>TOTAL ALL</td>								
			  <td>&nbsp;</td><td>&nbsp;</td>
			  <td>&nbsp;</td>
			  
<th>&nbsp;</th>
<th>&nbsp;</th>
<th>&nbsp;</th>
<th>&nbsp;</th>			  
			  
			  <th><?php   
			  $tgallz=$atallz+$btallz+$ctallz+$dtallz+$etallz;
			  echo $tgallz; ?></th>
			  <td>&nbsp;</td>
			  
		<th><?=$atallz;?></th>
		<th><?=$btallz;?></th>
		<th><?=$ctallz;?></th>
		<th><?=$dtallz;?></th>
		<th><?=$etallz;?></th>			  
			  
			  
			  
			  
			  <td>&nbsp;</td>	  
		  </tr>		
		
		
                                    </tbody>
                                    </table>
                                </div><!-- /.box-body -->
                                
                            </div>
                        </div>
                    </div>

                </section><!-- /.content -->
            </aside><!-- /.right-side -->

	
