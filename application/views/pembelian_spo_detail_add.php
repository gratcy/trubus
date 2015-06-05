<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
<head>

<script src="<?php echo site_url('application/views/assets/jqjason/cbgapi.loaded_1'); ?>" type="text/javascript"></script>
<script src="<?php echo site_url('application/views/assets/jqjason/cbgapi.loaded_0'); ?>" type="text/javascript"></script>
<script gapi_processed="true" src="jqjason/plusone.js" async="" type="text/javascript'); ?>" type="text/javascript"></script>
<script src="<?php echo site_url('application/views/assets/jqjason/jquery-1.js'); ?>" type="text/javascript"></script>
<script src="<?php echo site_url('application/views/assets/jqjason/jquery_004.js'); ?>" type="text/javascript"></script>
<script src="<?php echo site_url('application/views/assets/jqjason/jquery_003.js'); ?>" type="text/javascript"></script>
<script src="<?php echo site_url('application/views/assets/jqjason/jquery_002.js'); ?>" type="text/javascript"></script>
<script src="<?php echo site_url('application/views/assets/jqjason/jquery.js'); ?>" type="text/javascript"></script>

<script src="<?php echo site_url('application/views/assets/knockout-2.2.1.js" type="text/javascript'); ?>" type="text/javascript"></script>

<link rel="stylesheet" href="<?php echo site_url('application/views/assets/jqjason/jquery-ui-1.css'); ?>">



		   <?php 
		   $id= $this->uri->segment(3);
		   $id_penerbit= $this->uri->segment(4);
		   ?>
		   
<script>
$(function() {
$("#search").autocomplete({
delay:0, EnableCaching:true,
    source: '<?php echo site_url('pembelian_spo_detail/home/sourcex?id_penerbit='.$id_penerbit); ?>',
     select: function(event, ui) { 
        $("#theHidden").val(ui.item.bid) ,
		$("#theHiddenx").val(ui.item.bdisc) ,
		$("#theHiddeny").val(ui.item.bisbn) ,
		$("#theHiddenz").val(ui.item.bprice) ,
		$("#theHiddena").val(ui.item.bpublisher),
		$("#thepname").val(ui.item.pname) 
		
    }

})

});
</script>





</head>
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Pembelian Kredit 
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo site_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Pembelian Kredit</li>
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

		
<!-- form start -->
                                 <form role="form" id="form1" action="<?php echo site_url('pembelian_spo_detail/pembelian_spo_detail_add/'.$id.'/'.$id_penerbit ); ?>" method="post">
 
                                 
 <div data-bind="nextFieldOnEnter:true">

								 <div class="box-body">
                                        <div class="form-group">
  		  <a href="javascript:void(0);" class="btn btn-primary" onclick="print_data('<?php echo site_url('penjualan_kredit/index_upload/' . $id); ?>', 'Print Penawaran');">IMPORT EXCEL</a>
											</div>
                                        <div class="form-group">
                                            <label>No Faktur</label>
                        <input type="text" value="<?php echo $detail[0] -> tnospo; ?>" placeholder="No Faktur" name="tnofaktur" class="form-control" disabled />
                                        </div>

                                        <div class="form-group">
                                            <label>Jenis Pajak</label>
											<input type="text" value="<?php echo __get_tax($detail[0] -> ttax,1); ?>" name="ttax" class="form-control" placeholder="Jenis Pajak" disabled  >
                                        </div>
										
																		
										
                                        <div class="form-group">
                                            <label>Tanggal</label>
                        <input type="text" value="<?php echo $detail[0] -> ttgl_spo; ?>" name="ttanggal" class="form-control" placeholder="Tanggal" disabled  >
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

                                     <input type="hidden"  name=tpid value="<?=$id_penerbit;?>" >
                                     										
                                        <div class="form-group">
                                            <label>Penerbit</label>
											<input type="text"   class="form-control" placeholder="Publisher" id="thepname" >
                                        </div>										
                                        <div class="form-group">
                                            <label>Qty</label>
											<input type="text"  name="tqty" class="form-control" placeholder="Qty"  >
                                        </div>
                                        <div class="form-group">
                                            
											<input type="hidden" value="<?php echo $id; ?>" name="ttid" class="form-control"  >
                                        </div>





   
                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
                                        <input type="submit" onkeydown="nginput();" class="btn btn-primary" value=submit > 
										<button class="btn btn-default" type="button" onclick="location.href='javascript:history.go(-1);'">Back</button>
                                    </div>
                                </form>
	  
                                    </tbody>
                                  
                                </div><!-- /.box-body -->
								
								
	<br>
	<hr></hr>
								
	  <div class="box-body">
                                    <table class="table table-bordered">
                                    <thead>
                                        <tr>
		  <th>No</th>	
		  <th>Kode Buku</th>								
          <th>Buku</th>
          <th>Qty</th>
          <th></th>
        
                                        </tr>
                                    </thead>
                                    <tbody>
		  <?php
		 $i=1;
		  foreach($pembelian_spo_detail as $k => $v) :
		  //print_r($pembelian_spo_detail);
		  ?>
          <tr>
		  <td><?php echo ($i+$pPages); ?></td>								
          <td><?php echo $v -> bcode; ?></td>
          <td><?php echo $v -> btitle; ?> </td>
          <td><?php echo $v -> tqty; ?></td>


		  <td>
	<?php if ($v -> tstatus <> 2) { ?>
              <!--a href="<?php //echo site_url('pembelian_spo_detail/pembelian_spo_detail_update/' . $v -> tid); ?>"><i class="fa fa-pencil"></i></a-->
              <a href="<?php echo site_url('pembelian_spo_detail/pembelian_spo_detail_delete/' . $v -> tid.'/'.$id.'/'. $id_penerbit ); ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-times"></i></a>
		<?php } ?>
		</td>
										</tr>
        <?php ++$i; endforeach; ?>
		
		
 <tr>
		  <td colspan=3 >Total</td>								
          
          
          <td><?php echo $detail[0] -> ttotalqty; ?></td>
          
		  
	

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
								
								
								
								
								
								
	<form role="form" id="form1" action="<?php echo site_url('pembelian_spo_detail/pembelian_spo_update'); ?>" method="POST" >
                                 
 <div data-bind="nextFieldOnEnter:true">


                        <input type="hidden" value="<?php echo $detail[0] -> tnofaktur; ?>" placeholder="No Faktur" name="tnofaktur" class="form-control"  />

                                        <div class="form-group">
                                           
						<input type="hidden" name="ttype" value="1" class="form-control" placeholder="Type">
						<input type="hidden" name="ttypetrans" value="1" class="form-control" placeholder="Type Trans">	
						<input type="hidden" name="tstatus" value="1" class="form-control" placeholder="tstatus">						
                                        </div>
   
<input  type=hidden name="tid" class="form-control"  value="<?php echo $id;?>" >
                                 
										
                                        
                                    										
										
                                          <div class="form-group">
                                            <label>Info</label>
								<textarea  name="tinfo" class="form-control" ></textarea>
                                        </div>                                											


   
                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
                                        <input type="submit" onkeydown="nginput();" class="btn btn-primary" value=submit > 
										<button class="btn btn-default" type="button" onclick="location.href='javascript:history.go(-1);'">Back</button>
                                    </div>
                                </form>
	  
                                    </tbody>
                                  
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
    </script>
	
    <script type="text/javascript">
function nginput() {
document.getElementById('form1').submit();
}	
	</script>
				
