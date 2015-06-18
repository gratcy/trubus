<?php 
$branch=$this -> memcachedlib -> sesresult['ubranchid'];
?>
<script src="<?php echo site_url('application/views/assets/jqjason/jquery-ui.js'); ?>" type="text/javascript"></script>
<script src="<?php echo site_url('application/views/assets/knockout-2.2.1.js'); ?>" type="text/javascript"></script>
<script>
$(function() {
$("#search").autocomplete({
delay:0, EnableCaching:true,
    source: '<?php echo site_url('penjualan_kredit_detail/home/source?branch='.$branch); ?>',
     select: function(event, ui) { 
        $("#theHidden").val(ui.item.bid) ,
		$("#theHiddenx").val(ui.item.bdisc) ,
		$("#theHiddeny").val(ui.item.bisbn) ,
		$("#theHiddenz").val(ui.item.bprice) ,
		$("#theHiddena").val(ui.item.bpublisher),
		$("#thepname").val(ui.item.pname), 
		$("#thestok").val(ui.item.stok),
		$("#theqty").val(ui.item.tqty)
		
    }

})

});
</script>
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Retur Penjualan Konsinyasi
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo site_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Retur Penjualan Konsinyasi</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
	<?php echo __get_error_msg(); ?>
							<div class="box">
                                <div class="box-header">
                                   </div><!-- /.box-header -->
                                <div class="box-body">

                                    </thead>
                                    <tbody>
		  <?php
		  //foreach($retur_jk_detailxx as $k => $v) :
		  //$phone = explode('*', $v -> tnofaktur);
		  ?>
		   <?php //endforeach; 
		   //print_r($detail);
		   ?>
<!-- form start -->
                                 <form role="form" id="form1" action="<?php echo site_url('retur_jk_detail/retur_jk_detail_add/'.$id); ?>" method="post">
 
                                 
 <div data-bind="nextFieldOnEnter:true">

								 <div class="box-body">
                                        <div class="form-group">
		    		  <a href="javascript:void(0);" class="btn btn-primary" onclick="print_data('<?php echo site_url('penjualan_kredit/index_upload/' . $id); ?>', 'Print Penawaran');">IMPORT EXCEL</a>
											</div>
                                        <div class="form-group">
                                            <label>No Faktur</label>
                        <input type="text" value="<?php echo $detail[0] -> tnofaktur; ?>" placeholder="No Faktur" name="tnofaktur" class="form-control" disabled />
                                        </div>
                                        <div class="form-group">
                                            <label>Customer</label>
						                  <select  class="form-control" name="cid" disabled >
										  <option value="<?php echo $detail[0] -> tcid; ?>"><?php echo $detail[0] -> cname; ?></option>
												<?php echo $customer; ?>
                                            </select>	
<input type=hidden name=cid value="<?php echo $detail[0] -> tcid; ?>" >
										</div>
                                        <div class="form-group">
                                            <label>Jenis Pajak</label>
											<input type="text" value="<?php echo __get_tax($detail[0] -> ttax,1); ?>" name="ttax" class="form-control" placeholder="Jenis Pajak" disabled  >
                                        </div>
										
										
                                        <div class="form-group">
                                            <label>Discount Customer</label>
											<input type="text" value="<?php echo $detail[0] -> cdisc; ?>" name="discc" class="form-control" placeholder="Jenis Pajak" disabled  >
                                        </div>										
										
                                        <div class="form-group">
                                            <label>Tanggal</label>
                        <input type="text" value="<?php echo $detail[0] -> ttanggal; ?>" name="ttanggal" class="form-control" placeholder="Tanggal" disabled  >
						<input type="hidden" name="ttype" value="1" class="form-control" placeholder="Type">
						<input type="hidden" name="ttypetrans" value="1" class="form-control" placeholder="Type Trans">	
						<input type="hidden" name="tstatus" value="1" class="form-control" placeholder="tstatus">						
                                        </div>
   
<input  type=hidden name="id" class="form-control"  value="<?php echo $id;?>" >
                                        <div class="form-group">
                                            <label>Buku</label>
											<input autofocus="autofocus" type="text"  name="btitle" class="form-control" placeholder="Buku" id="search"  >											
											<input type="hidden"  name="tbid" class="form-control" placeholder="Qty" id="theHidden" >
                                        </div>
										
                                        <div class="form-group">
                                            <label>ISBN</label>
											<input type="text"   class="form-control" placeholder="ISBN" id="theHiddeny" >
                                        </div>										

                                        <div class="form-group">
                                            <label>Harga</label>
											<input type="text"  name="tharga"  class="form-control" placeholder="Harga" id="theHiddenz"  >
                                        </div>											
										
                                        <div class="form-group">
                                            <label>Disc</label>
											<input type="text"  name="tdisc" class="form-control" placeholder="disc" value="<?php echo $detail[0] -> cdisc; ?>"  >
                                        </div>											
                                        <div class="form-group">
                                            <label>Publisher</label>
											<input type="text"   class="form-control" placeholder="Publisher" id="thepname" >
                                        </div>										
                                        <div class="form-group">
                                            <label>Qty</label>
											<input type="text"  name="tqty"  class="form-control" placeholder="Qty" 
			                                 >
                                        </div>
                                        <div class="form-group">
                                            <label>Stok</label>
											<input type="text"  name="tstok"  class="form-control" placeholder="Qty" id="thestok" >
                                        </div>	
                                        <div class="form-group">
                                            <label>Stok Proses</label>
											<input type="text"  name="tstok"  class="form-control" placeholder="Qty" id="theqty" >
                                        </div>										
                                        <div class="form-group">
                                            
											<input type="hidden" value="<?php echo $id; ?>" name="ttid" class="form-control"  >
                                        </div>





   
                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
                                        <input type="submit" onkeydown="nginput();" class="btn btn-primary" value="Submit" > 
										<button class="btn btn-default" type="button" onclick="location.href='javascript:history.go(-1);'">Back</button>
                                    </div>
                                </form>
	  
                                    </tbody>
                                  
                                </div><!-- /.box-body -->
								
								
	<br>
	<hr></hr>
			<form role="form" id="form1" action="<?php echo site_url('retur_jk_detail/retur_jk_update/'.$id); ?>" method="POST" >						
	  <div class="box-body">
                                    <table class="table table-bordered">
                                    <thead>
                                        <tr>
		  <th>No</th>	
		  <th>Kode Buku</th>								
          <th>Buku</th>
          
		  <th>Qty ke Customer</th>
<!--
		  <th>Qty diterima Customer</th>
-->
<!--
		  <th>selisih</th>
-->
          <th>Harga</th>
		  <th>Qty</th>
          <th>Total Harga</th>		  
          <th>Discount</th>    
          <th>Total Harga After Disc</th>
          <th style="width: 50px;"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
		  <?php
		  $tthargaz=0;
		  $i=1;
		  foreach($retur_jk_detail as $k => $v) :
		  $ttharga= $v -> tharga*$v -> tqty;
		  $tthargaz=$ttharga+$tthargaz;
		  ?>
          <tr>
		  <td><?php echo ($i+$pPages); ?></td>								
          <td><?php echo $v -> bcode; ?></td>
          <td><?php echo $v -> btitle; ?></td>
          
		  
		  <td>
		  <input type=hidden name="tidx[]" value="<?php echo $v -> tid; ?>" >
		  <input type=hidden name="tbid[]" value="<?php echo $v -> tbid; ?>" >
		  
		  
		  <input style="width:50px;" type=text name="qty_to_cid[]" value= "<?php echo $v -> tqty; ?>" ></td>
          <td><input type=text name="thargaa[]" value="<?php echo $v -> tharga; ?>" ></td>  
		<td><?php echo $v -> tqty; ?></td>		  
		  <td><?php echo __get_rupiah($ttharga,3); ?></td>
		   <td><input style="width:50px;" type=text name="tdiscc[]" value="<?php echo $v -> tdisc; ?>" ></td>
          <td><?php echo __get_rupiah($v -> ttotal,3); ?></td>

		  <td>
	<?php if ($v -> tstatus <> 2) { ?>
              <a href="<?php echo site_url('retur_jk_detail/retur_jk_detail_update/' . $v -> tid); ?>"><i class="fa fa-pencil"></i></a>
              <a href="<?php echo site_url('retur_jk_detail/retur_jk_detail_delete/' . $v -> tid); ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-times"></i></a>
		<?php } ?>
		</td>
										</tr>
        <?php ++$i; endforeach; ?>
		
		
		</tbody>
		<tfoot>
 <tr>
          <td></td>
		  <td>Total</td>
          <td></td>
          <td></td>
		  <td></td>
          <td><?php echo $detail[0] -> ttotalqty; ?></td>
          <td> <?php echo __get_rupiah($detail[0] -> ttotalharga,3); ?></td>
          <td><?php echo __get_rupiah($detail[0] -> ttotaldisc,3); ?></td>
		  
		  <td>
		  <?php 
		  $tgrandtotalx= $detail[0] -> tgrandtotal;
		  echo __get_rupiah($tgrandtotalx,3); 
		  ?></td>

		  <td>
		</td></tr>
                                    </tfoot>
                                    </table>
                                </div><!-- /.box-body -->	
 <div data-bind="nextFieldOnEnter:true">


                        <input type="hidden" value="<?php echo $detail[0] -> tnofaktur; ?>" placeholder="No Faktur" name="tnofaktur" class="form-control"  />

                                        <div class="form-group">
                                           
						<input type="hidden" name="ttype" value="1" class="form-control" placeholder="Type">
						<input type="hidden" name="ttypetrans" value="1" class="form-control" placeholder="Type Trans">	
						<input type="hidden" name="tstatus" value="1" class="form-control" placeholder="tstatus">						
                                        </div>
   
<input  type=hidden name="tid" class="form-control"  value="<?php echo $id;?>" >
                                        <div class="form-group">
                                            <label>Total Diskon Customer</label>
											<input autofocus="autofocus" type="text"  name="ttotaldisc" value="<?php echo $detail[0] -> ttotaldisc; ?>" class="form-control" placeholder="Discount"   >											
											
                                        </div>
										
                                        
                                        <div class="form-group">
                                            <label>Total Harga</label>
											<input type="text"  name="tgrandtotal"  class="form-control" value="<?php echo $detail[0] -> tgrandtotal; ?>" placeholder="Harga" id="theHiddenz"  >
                                        </div>											
										
                                          <div class="form-group">
                                            <label>Info</label>
								<textarea  name="tinfo" class="form-control" ><?php echo $detail[0] -> tinfo; ?></textarea>
                                        </div>                                											


   
                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
                                        <input type="submit" onkeydown="nginput();" class="btn btn-primary" value="Submit" > 
										<button class="btn btn-default" type="button" onclick="location.href='javascript:history.go(-1);'">Back</button>
                                    </div>
                                </form>
	  
                                  
                                </div><!-- /.box-body -->							
								
								
								
								
								
								
								
								
								
								
								
								
                            </div>
                        </div>
                    </div>

                </section><!-- /.content -->
            </aside><!-- /.right-side -->

	

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
		
		$( document ).ajaxComplete(function() {
			$('input[name="tqty"]').keyup(function(){
				var bstock = $(this).val();
				var cstock = $('#thestok').val();
				
				if (cstock == 0) $('#thestok').css('border','2px solid #c00');
				if (bstock > cstock) {
					$(this).focus();
					$('span#smsg').remove();
					$('#thestok').after('<span id="smsg" style="color:#c00;font-weight:bold">Stock yang dibeli melebihi persediaan.</span>');
					$('#thestok').css('border','2px solid #c00');
				}
			});
		});
	</script>
