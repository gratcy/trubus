
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
$tb=array('cash','cicil','giro');
$xx[0]=array("id" =>'1' ,"value" =>'gramedia' );
$xx[1]=array("id" =>'2' ,"value" =>'ga tiga belas' );
$xx[2]=array("id" =>'3' ,"value" =>'KARISMA' );
$xx[3]=array("id" =>'4' ,"value" =>'Trubus' );

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
                        Pembayaran Add
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo site_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="<?php echo site_url('pembayaran'); ?>">Pembayaran</a></li>
                        <li class="active">Pembayaran Add</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
	<?php echo __get_error_msg(); ?>
<div class="box box-primary">
                                <!-- form start -->
                                 <form role="form" action="<?php echo site_url('pembayaran/home/bayar_add/'.$invid); ?>" method="post" id="form1">
								 
								 
								 
								 
 <div data-bind="nextFieldOnEnter:true">
						 
<input  name=branch type="hidden" value="<?=$branch;?>"  />	
								 
								 
                     <div class="box-body">
					 <?php //print_r($invoice);?>
                               <div class="form-group">
                                  <label>No Bayar</label>
									<input type="text" placeholder="No Faktur" name="nobyr" class="form-control" value="BYR" />
                                </div>
								
								
                               <div class="form-group">
                                  <label>No Invoice</label>
									<input type="text"  name="noinv" class="form-control" value="<?=$invoice[0]->invno;?>" />
                                </div>								

									

		<div class="form-group">
              <label>Area</label>

<input type=text id="demo2" name="productidname" class="form-control" >
<input type=hidden id="demo3" name="aid" >				
										</div>
										
									<div class="form-group">
                                            <label>Nama Customer</label>
<input autofocus="autofocus" name=cname type="text" id="search" class="form-control"   />						
										</div>
										 
								
										
                                        <div class="form-group">
                                            <label>Total Tagihan</label>
<input  name=ttagihan type="text" value="<?=$invoice[0]->totalhutang;?>"  class="form-control"   />					
										</div>
										
									
										
 <div class="form-group">
<label>Type Bayar</label><br>
<table border=0>
<tr><td>
<input  name=tbayar type="radio" id="tbayar" value="cash" class="form-control"/>CASH 
</td>
<td>&nbsp;&nbsp;Rp<input  name=amountcash type="text" id="tbayar"  /></td></tr>
<tr><td>
<input  name=tbayar type="radio" id="tbayar" value="transfer" class="form-control"/>TRANSFER 
</td><td>&nbsp;&nbsp;Rp<input  name=amounttrans type="text" id="tbayar"  /></td>
<td> Rek Tujuan &nbsp;&nbsp; <input  name=rekto type="text" id="tbayar"  />
</td></tr>
<tr><td>
<input  name=tbayar type="radio" id="tbayar" value="giro" class="form-control"/>GIRO </td>
<td>&nbsp;&nbsp;Rp<input  name=amountgiro type="text" id="tbayar"  />
</td><td> Tanggal Giro &nbsp;&nbsp; <input  name=dategiro type="text" id="tbayar"  />
</td></tr>
</table>					
</div>


                                        
<input  name=tcid type="hidden" id="theHidden" class="form-control"   />									
								
																						
					
                                   
                                        <div class="form-group">
                                            <label>Tanggal </label>
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
									
									
                                </form><br>
								
								
	
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
          <td><a href="<?php echo site_url('pembayaran/home/bayar_approve/' . $v ->invid.'/'.$v ->pbid); ?>"><i class="fa fa-pencil"></i></a></td>
		  
		  
	
										</tr>
<?php } ?>
                                    </tbody>
                                    </table>
									
<?php 

echo 'terima: '.$terima[0]->terima.'<br>';
echo 'pending: '.$pending[0]->setor.'<br>';

?>





	
								
								
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

				
