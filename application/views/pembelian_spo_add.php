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

<script src="<?php echo site_url('application/views/assets/js/bootstrap-datepicker.js');?>"></script>

<link rel="stylesheet" href="<?php echo site_url('application/views/assets/css/datepicker.css'); ?>">

<link rel="stylesheet" href="<?php echo site_url('application/views/assets/jqjason/jquery-ui-1.css'); ?>">

<script>
$(function() {
$("#search").autocomplete({
delay:0, 
cacheLength: 0,
minLength: 1,
source: '<?php echo site_url('pembelian_spo/home/source'); ?>',
select: function(event, ui) { 
$("#theHidden").val(ui.item.pid) ,
 
$("#thecode").val(ui.item.pcode)

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
Pembelian SPO Add
</h1>
<ol class="breadcrumb">
<li><a href="<?php echo site_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
<li><a href="<?php echo site_url('pembelian_spo'); ?>">pembelian_spo</a></li>
<li class="active">pembelian_spo Add</li>
</ol>
</section>

<!-- Main content -->
<section class="content">
<div class="row">
<div class="col-xs-12">
<?php echo __get_error_msg(); ?>
<div class="box box-primary">
<!-- form start -->
<form role="form" action="<?php echo site_url('pembelian_spo/pembelian_spo_add'); ?>" method="post" id="form1">

<?php 
$branch=$this -> memcachedlib -> sesresult['ubranchid'];
?>
<div data-bind="nextFieldOnEnter:true">
<div class="box-body">
<div class="form-group">
<label>No SPO</label>
<input  name=branch type="hidden" value="<?=$branch;?>"  />	
<input type="text" placeholder="No Faktur" name="tnofaktur" class="form-control" value="SPO" />
</div>
<div class="form-group">
<label>Nama Penerbit</label>
<input autofocus="autofocus" name=pname type="text" id="search" class="form-control"   />					
</div>
<div class="form-group">
<label>Kode Penerbit</label>
<input  name=pcode type="text" id="thecode" class="form-control"   />				
<input  name=tpid type="hidden" id="theHidden" class="form-control"   />		
</div>		
<div class="form-group">	
<label>Type Transaksi</label><br>
<select  name="ttypetrans"  class="form-control" />	
<option value=1 >Konsinyasi</option>
<option value=2 >Kredit</option>
</select>			
	
</div>	
<div class="form-group">
<label>Tanggal</label>
<?php $tggl=date('Y-m-d'); ?>											
<input  type="text" name="ttanggal" class="form-control" placeholder="YYYY-MM-DD"  value="<?=$tggl;?>" >
<input type="hidden" name="ttype" value="3" class="form-control" placeholder="Type">
<!--input type="hidden" name="ttypetrans" value="2" class="form-control" placeholder="Type Trans"-->	
<input type="hidden" name="tstatus" value="1" class="form-control" placeholder="tstatus">						
</div>
<input type="hidden" name="tinfo" class="form-control"   >							
<!-- /.box-body -->
<div class="box-footer">
<input type="submit" onkeydown="nginput();" class="btn btn-primary" value="Submit" > 
<button class="btn btn-default" type="button" onclick="location.href='javascript:history.go(-1);'">Back</button>
</div>
</div>	
</form>
</div>
</div>
</div>

</section><!-- /.content -->
</aside><!-- /.right-side -->




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
