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



  
<link rel="stylesheet" href="assets/jqjason/jquery-ui-1.css">


<?php $ur=site_url('application/views/assets/source.php'); ?>

<script>
$(function() {
$("#search").autocomplete({
delay:0, EnableCaching:true,
    source: '<?php echo site_url('application/views/assets/source.php'); ?>',
     select: function(event, ui) { 
        $("#theHidden").val(ui.item.cid) ,
		$("#theHiddenx").val(ui.item.cdisc) 
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
                        hasil_penjualan Add
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo site_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="<?php echo site_url('hasil_penjualan'); ?>">hasil_penjualan</a></li>
                        <li class="active">hasil_penjualan Add</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
	<?php echo __get_error_msg(); ?>
<div class="box box-primary">
                                <!-- form start -->
                                 <form role="form" action="<?php echo site_url('hasil_penjualan/hasil_penjualan_add'); ?>" method="post" id="form1">
								 
								 
								 
								 
 <div data-bind="nextFieldOnEnter:true">
<!--form id="form1" >
<input autofocus="autofocus" name=x type="text" id="search"  />	
<input name=y type="text" id="theHidden"  /> 
<input name=z type="text" id="theHiddenx"  />	
<input type=submit onkeydown="nginput();" >
 <div id="selction-ajax"></div-->								 
								 
								 
								 
								 
								 
								 
								 
								 
								 
								 
								 
								 
								 
								 
								 
								 
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label>No Faktur</label>
                        <input type="text" placeholder="No Faktur" name="tnofaktur" class="form-control" />
                                        </div>
                                        <div class="form-group">
                                            <label>Kode Customer</label>
<input autofocus="autofocus" name=cname type="text" id="search" class="form-control"   />					
										</div>

                                        <div class="form-group">
                                            <label>Discount</label>
<input autofocus="autofocus" name=cdisc type="text" id="theHidden" class="form-control"   />					
										</div>


                                        <div class="form-group">
                                            <label>cid</label>
<input autofocus="autofocus" name=branch type="text" id="theHiddenx" class="form-control"   />					
										</div>										
										
										
                                        <div class="form-group">
                                            <label>Jenis Pajak</label>
											<input type="text" name="ttax" class="form-control" placeholder="Jenis Pajak">
                                        </div>
                                        <div class="form-group">
                                            <label>Tanggal</label>
                        <input type="text" name="ttanggal" class="form-control" placeholder="Tanggal">
						<input type="hidden" name="ttype" value="1" class="form-control" placeholder="Type">
						<input type="hidden" name="ttypetrans" value="1" class="form-control" placeholder="Type Trans">	
						<input type="hidden" name="tstatus" value="1" class="form-control" placeholder="tstatus">						
                                        </div>
                                        					
                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
                                        <input type="submit" onkeydown="nginput();" class="btn btn-primary" value=submit > 
										<button class="btn btn-default" type="button" onclick="location.href='javascript:history.go(-1);'">Back</button>
                                    </div>
									
 <div id="selction-ajax"></div>										
									
									
                                </form>
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
				