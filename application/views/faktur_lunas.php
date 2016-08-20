
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Faktur Lunas
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo site_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Piutang Customer</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
				
				<div class="row">
						<?php if(!isset($_POST['tsbayar'])){$_POST['tsbayar']="";}  ?>
						
						<form action="<?php echo site_url('piutang/home/pfaktur_lunasz/'); ?>" method="POST">
                        <div class="col-xs-6" style="height: 60px;">
                                    <div class="form-group">
                                        <label>Status:</label>
                                        <div class="input-group col-lg-10">
                                            
											<select name="tsbayar" class="form-control" >
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
				
	                    <div class="row"><br><br>
						<form action="<?php echo site_url('piutang/home/pfaktur_lunas_xls/'); ?>" method="post">
                      
                        <div class="form-group">
                        <p align=left>                
                        <button class="btn text-muted text-center btn-danger" type="submit" style="position: relative;top: -34px;float: right;margin-right: 38px;">EXPORT EXCEL</button>
						</p>
                                   
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
		  <th>Customer</th>
          <th>Tanggal Invoice</th>
<th>Tanggal Lunas</th>		  
		  <th>No Faktur</th>
		  
		  <th>Total Tagihan</th>
		
		  <th>Status Bayar</th>
         

          <!--th style="width: 80px;"></th-->
                                        </tr>
                                    </thead>
                                    <tbody>
		  <?php
		 
		  foreach($lunas_all as $k => $v) :
		 // $phone = explode('*', $v -> tnofaktur);
		  // echo '<pre>';
		// print_r($lunas_all);
		// echo '</pre>';
		//die;

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
			  <td><?php echo $b -> invduedate; ?></td>
			  <td><?php echo $b -> tnofaktur; ?></td>
			  <td><?php echo __get_rupiah($b -> tg,3); ?></td>			  
			  <td><?php echo $sb ?></td>	  
		  </tr>	  
				  
				  <?php
				  
			  }
		  }
		  
		
		  ?>
		  
		
		  
		
          <tr>
			  <td>TOTAL</td>								
			  <td>&nbsp;</td><td>&nbsp;</td>
			  <td>&nbsp;</td>
			  
		  
			  

	<?php 

$atall=$ttag1z;
$btall=$ttag2z;
$ctall=$ttag3z;
$dtall=$ttag4z;
$etall=$ttagx4z;
?>	
			  <td><?php 
			  //$tg_all=$v -> tg;
			  $tg_all=$atall+$btall+$ctall+$dtall+$etall;
			  echo $tg_all; ?></td>
			  <!--td>&nbsp;</td-->		  
		<!--th><?=$atall;?></th>
		<th><?=$btall;?></th>
		<th><?=$ctall;?></th>
		<th><?=$dtall;?></th>
		<th><?=$etall;?></th-->			  
			  
			  
			  
			  
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
