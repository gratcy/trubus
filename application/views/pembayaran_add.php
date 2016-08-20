
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
<?php 
$branch=$this -> memcachedlib -> sesresult['ubranchid'];
?>
<head>
<script language=" JavaScript" >
<!-- 
function LoadOnce() 
{ 
window.location.reload(); 
} 
//-->
</script>
<script src="<?php echo site_url('application/views/assets/jqjason/cbgapi.loaded_1'); ?>" type="text/javascript"></script>
<script src="<?php echo site_url('application/views/assets/jqjason/cbgapi.loaded_0'); ?>" type="text/javascript"></script>
<script gapi_processed="true" src="<?php echo site_url('application/views/assets/jqjason/plusone.js'); ?>" async="" type="text/javascript'); ?>" type="text/javascript"></script>
<script src="<?php echo site_url('application/views/assets/jqjason/jquery-1.js'); ?>" type="text/javascript"></script>
<script src="<?php echo site_url('application/views/assets/jqjason/jquery_004.js'); ?>" type="text/javascript"></script>
<script src="<?php echo site_url('application/views/assets/jqjason/jquery_003.js'); ?>" type="text/javascript"></script>
<script src="<?php echo site_url('application/views/assets/jqjason/jquery_002.js'); ?>" type="text/javascript"></script>
<script src="<?php echo site_url('application/views/assets/jqjason/jquery.js'); ?>" type="text/javascript"></script>

<script src="<?php echo site_url('application/views/assets/knockout-2.2.1.js" type="text/javascript'); ?>" type="text/javascript"></script>

 <script src="<?php echo site_url('application/views/assets/js/bootstrap-datepicker.js');?>"></script>

<link rel="stylesheet" href="<?php echo site_url('application/views/assets/css/datepicker.css'); ?>">
  
<link rel="stylesheet" href="<?php echo site_url('application/views/assets/jqjason/jquery-ui-1.css'); ?>">

<?php
//print_r($area);
$tb=array('cash','cicil','giro');
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





</head>
<Body onLoad=" LoadOnce()" >

<?php 
// echo '<pre>';
// print_r($bayar);
// echo '</pre>';
?>
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Invoice Add
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo site_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="<?php echo site_url('pembayaran'); ?>">Invoice</a></li>
                        <li class="active">Invoice Add</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
	<?php echo __get_error_msg(); ?>
<div class="box box-primary">
                                <!-- form start -->
                                 <form role="form" action="<?php echo site_url('pembayaran/pembayaran_add'); ?>" method="post" id="form1">
								 
								 
								 
								 
 <div data-bind="nextFieldOnEnter:true">
						 
<input  name=branch type="hidden" value="<?=$branch;?>"  />	
								 
								 
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label>No Invoice</label>
                        <input type="text" placeholder="No Faktur" name="tnofaktur" class="form-control" value="INV" />
                                        </div>

									<div class="form-group">
                                        <label>Date range:</label>
                                        <div class="input-group col-lg-10">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="text" class="form-control pull-right" id="datesort" name="datesort" autocomplete="off" />
                                        </div><!-- /.input group -->
										
									</div>	
<?php 
if(!isset($_POST['aid'])){$_POST['aid']="";}
if(!isset($_POST['tcid'])){$_POST['tcid']="";} 
$aid=$_POST['aid'];
$tcid=$_POST['tcid']
?>
		<div class="form-group">
              <label>Area</label>

<input type=text id="demo2" name="productidname" class="form-control" >


<?php 
if($aid==""){
?>	
<input type=hidden id="demo3" name="aid" >	
<?php }else{ ?>
                                       
<input type=hidden  name="aid"  value="<?=$aid;?>"   />
<?php } ?>



			
										</div>
										
									<div class="form-group">
                                            <label>Nama Customer</label>
<input autofocus="autofocus" name=cname type="text" id="search" class="form-control"   />						
										</div>
										 
									<div class="form-group">
                                            <label>Tipe Invoice</label><br>
<?php 
//echo $_POST['tinvv'];
if($_POST['tinvv']=="FAKTUR"){
	$fak="checked	";
	$allx="";
}else{
	$fak="";
	$allx="checked";	
	
}
?>											
											
<input type=radio name="tinvv" value="all" <?=$allx;?> />	ALL &nbsp;&nbsp;&nbsp;
<input type=radio name="tinvv" value="faktur"  <?=$fak;?> />	Per Faktur					
										</div>										
					
										
									
<?php 
if($tcid==""){
?>	
                                        
<input  name=tcid type="hidden" id="theHidden" class="form-control"   />
<?php }else{ ?>
                                       
<input  name=tcid type="hidden" value="<?=$tcid;?>"   />
<?php } ?>									
	<div class="form-group">
      <label>Pilih Faktur</label><br>
<?php 

foreach ($bayar as $k=>$v){ ?>
	
	<input type=checkbox name="fakturr[]" value="<?=$v->tnofaktur;?>-<?=$v->tgrandtotal;?>">
	<?=$v->tnofaktur;?> - <?=$v->tgrandtotal;?><br>
	
<?php } ?>
			
	</div>										
																						
										
										
                                        
<input   type="hidden" id="theHiddenz" class="form-control"   />
                                   
                                        <div class="form-group">
                                            <label>Jatuh Tempo</label>
<?php $tggl=date('Y-m-d'); ?>											
                        <input  type="text" name="ttanggal" class="form-control" placeholder="YYYY-MM-DD"  value="<?=$tggl;?>" >
						<input type="hidden" name="ttype" value="2" class="form-control" placeholder="Type">
						<input type="hidden" name="ttypetrans" value="2" class="form-control" placeholder="Type Trans">	
						<input type="hidden" name="tstatus" value="1" class="form-control" placeholder="tstatus">						
                                        </div>
										
										
                                        <div class="form-group">
                                            <label>Info</label>
											<textarea name="tinfo" class="form-control"   ></textarea>
                                        </div>
										
										
                                        					
                                    <!-- /.box-body -->

                                    <div class="box-footer">
                                        <input type="submit" onkeydown="nginput();" class="btn btn-primary" value="submit" > 
										<button class="btn btn-default" type="button" onclick="location.href='javascript:history.go(-1);'">Back</button>
                                    </div>
									
									</div>
									
									
                                </form>
                            </div>
                        </div>
                    </div>

                </section><!-- /.content -->
            </aside><!-- /.right-side -->

</body>			
			

    <script type="text/javascript">
    ko.bindingHandlers.nextFieldOnEnter = {
        init: function(element, valueAccessor, allBindingsAccessor) {
            $(element).on('keydown', 'input, select, textarea,radio,submit', function (e) {
                var self = $(this)
                , form = $(element)
                  , focusable
                  , next
                ;
                if (e.keyCode == 13) {
                    focusable = form.find('input,a,select,textarea').filter(':visible');
                    var nextIndex = focusable.index(this) == focusable.length -1 ? 0 : focusable.index(this) + 1;
                    next = focusable.eq(nextIndex);
                    next.focus();
                    return false;
                }
            });
        }
    };

    ko.applyBindings({});
    </script>
	
    <script type="text/javascript">
function nginput() {
document.getElementById('form1').submit();
}	
	</script>
	
	<script type="text/javascript">
$(function(){
	$('#datesort').daterangepicker();
});
</script>

				
