<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >

<head>

<!--script type="text/javascript">
function UpdateCost() {
	alert('4');
	var c=document.getElementById("sumz");
	var gn, elem,str,res,a,b;
	num=document.getElementById('txtNum').value;

  for (i=0; i< num ; i++) {
    gn = 'buttonx'+i;  	
    elem = document.getElementById(gn);		
	
	 str = elem.value;
     res = str.split("*");
	 a = res[2];
	 b=res[0];
  } 
  
	 
	 //alert(b);
	if(res[0]=="NO"){
		//alert('2');
  elem.value="YES*"+res[1]+"*"+res[2];
  document.getElementById("sumz").value= parseInt(c.value) + parseInt(a);
	}else{
		//alert('3');
		 elem.value="NO*"+res[1]+"*"+res[2];
		 document.getElementById("sumz").value= parseInt(c.value) - parseInt(a);
	}	
	
  
           
} 
</script-->	
<script src="<?php echo site_url('application/views/assets/jqjason/jquery-ui.js'); ?>" type="text/javascript"></script>
<script src="<?php echo site_url('application/views/assets/knockout-2.2.1.js'); ?>" type="text/javascript"></script>
					 

</head>
<?php 
$branch=$this -> memcachedlib -> sesresult['ubranchid'];
?>
								 
<Body>


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
                                 <form role="form" action="<?php echo site_url('pembayaran/home/bayar_add/'.$invid); ?>" method="POST" id="form1"   name="listFormz" >
								 
							
								 
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

			<input type="hidden" name="bid" value="<?=$invoice[0]->invbid;?>" >
			<input type="hidden" name="aid" value="<?=$invoice[0]->invaid;?>" >
			<input type="hidden" name="cid" value="<?=$invoice[0]->invcid;?>" >
						
						

		<div class="form-group">
              <label>Area</label><br><?=$invoice[0]->aname;?>

<input type=hidden id="demo2" name="productidname" class="form-control" >
<input type=hidden id="demo3" name="aidx" >				
										</div>
										
									<div class="form-group">
                                            <label>Nama Customer</label>
<input autofocus="autofocus" name=cname type="hidden" id="search" class="form-control"   />						<br><?=$invoice[0]->cname;?>
										</div>
										 
								
										
                                        <div class="form-group">
                                            <label>Total Tagihan</label>
<input  name=ttagihan type="text" value="<?=$invoice[0]->totalhutang;?>"  class="form-control"   />					
										</div>
										
				


	

<!-- BARU-->


 <div data-bind="nextFieldOnEnter:true">

	  <div class="box-body">
	  <div id="systemxx">
                                    <table class="table table-bordered">
                                    <thead>
                                        <tr>
		  <th>No</th>	
		  <th>No Faktur</th>								
          <th>Qty</th>
          
          <th>Total Tagihan</th>		  

          <th style="width: 50px;"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
			<input type="text" name="txtNum" value="100" id="txtNum">	
<?php 
//print_r($bayarz);
//print_r($fakturz);
$ka=0;
foreach ($fakturz as $k=>$v){ 
$ka=$ka+1;
?>
<tr>
		  <th><?=$ka;?></th>	
		  <td><input type='checkbox' name="cbc[]" id="cbc<?=$i;?>" rel='<?=$v->tgrandtotal;?>' value='<?=$v->tid;?>' onclick='handleClick(this);'> &nbsp;&nbsp;<?=$v->tnofaktur;?></td>								
          <th><?=$v->ttotalqty;?></th>
          
          <th><?=$v->tgrandtotal;?></th>		  

          <th style="width: 50px;"></th>
</tr>
			
<?php } ?>

                                    </tbody>                   
                                 </table>
								 </div>
                                </div><!-- /.box-body -->		

          
	<!-- END BARU -->



<br><input type="text" size="20" id="sumz" name="total" value="0"/><br>



				
										
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
                        <input  type="text" name="ttanggal" class="form-control" placeholder="YYYY-MM-DD"  id="datesort" value="<?=$tggl;?>" >
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
								
		</div>						
	
<table class="">
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
foreach ($bayarzz as $k=>$v){ 

if($v->pbstatus==1){
	$pbst="pending";
}elseif($v->pbstatus==3){
	$pbst="Done";
}	
?>




          <tr>
		  								
          <td><?=$invoice[0]->invno;?> </td>
<td><?=$v->aname;?></td>		  
          <td><?=$v->pbdate;?></td>
		  <td><?=$v->pbtype;?></td>
          <td><?=$v->pbsetor;?></td>
		  <td><?=$v->info;?></td>
          
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

<br>
<a href="<?php echo site_url('pembayaran');?>" class="btn btn-danger" >CLOSE</a>
<br>



	
								
								
                            </div>
                        </div>
                    

                </section><!-- /.content -->
            </aside><!-- /.right-side -->

</body>			
			

    <script type="text/javascript">
    ko.bindingHandlers.nextFieldOnEnter = {
        init: function(element, valueAccessor, allBindingsAccessor) {
            $(element).on('keydown', 'input, select, textarea,radio', function (e) {
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

function nginput() {
document.getElementById('form1').submit();
}	
$.ui = null;
	
    $('table.table').dataTable({
                "sDom": '<"H"Cfr>t<"F"ip>',
                "sScrollY" : "600px",
                "sScrollX" : false,
                "bScrollCollapse" : true,
                "bAutoWidth" : true,
                "bPaginate" : false
		});
		

	</script>
	
	<script type="text/javascript">
$(function(){
	$('#datesort').datepicker();
});
</script>



<input type="checkbox" id="finRot" name="something" value="Fin Rot">
<button onclick="document.getElementById('finRot').checked=!document.getElementById('finRot').checked;">Fin Rot</button>





<!--div id="system_boxx">
<label><input type='checkbox' id='cbc' rel='3' onclick='handleClick(this);'>Checkbox</label><br>
<label><input type='checkbox' id='cbd' rel='7' onclick='handleClick(this);'  >Checkbox2</label>
</div-->


<script>
function handleClick(cb) {
	
  setTimeout(function() {
    display("Clicked, new value = " + cb.checked);
	
  }, 0);
  
  
}

$("#systemxx").click(function(){ 
//alert(9);
recalculate();

});

function recalculate(){
	//alert(0);
    var sum = 0;
	
    $("input[type=checkbox]:checked").each(function(){
      sum += parseInt($(this).attr("rel"));
    });

    //alert(sum);
	document.getElementById('sumz').value=sum;
}
</script>


