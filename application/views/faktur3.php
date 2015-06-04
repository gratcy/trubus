<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<style type="text/css">
<!--
body {
	font: 100%/1.4 Verdana, Arial, Helvetica, sans-serif;
	background-color: #42413C;
	margin: 0;
	padding: 0;
	color: #000;
}

/* ~~ Element/tag selectors ~~ */
ul, ol, dl { /* Due to variations between browsers, it's best practices to zero padding and margin on lists. For consistency, you can either specify the amounts you want here, or on the list items (LI, DT, DD) they contain. Remember that what you do here will cascade to the .nav list unless you write a more specific selector. */
	padding: 0;
	margin: 0;
}
h1, h2, h3, h4, h5, h6, p {
	margin-top: 0;	 /* removing the top margin gets around an issue where margins can escape from their containing div. The remaining bottom margin will hold it away from any elements that follow. */
	padding-right: 15px;
	padding-left: 15px; /* adding the padding to the sides of the elements within the divs, instead of the divs themselves, gets rid of any box model math. A nested div with side padding can also be used as an alternate method. */
}
a img { /* this selector removes the default blue border displayed in some browsers around an image when it is surrounded by a link */
	border: none;
}
/* ~~ Styling for your site's links must remain in this order - including the group of selectors that create the hover effect. ~~ */
a:link {
	color: #42413C;
	text-decoration: underline; /* unless you style your links to look extremely unique, it's best to provide underlines for quick visual identification */
}
a:visited {
	color: #6E6C64;
	text-decoration: underline;
}
a:hover, a:active, a:focus { /* this group of selectors will give a keyboard navigator the same hover experience as the person using a mouse. */
	text-decoration: none;
}

/* ~~ this fixed width container surrounds the other divs ~~ */
.container {
	width: 960px;
	background-color: #FFF;
	margin: 0 auto; /* the auto value on the sides, coupled with the width, centers the layout */
}

/* ~~ the header is not given a width. It will extend the full width of your layout. It contains an image placeholder that should be replaced with your own linked logo ~~ */
.header {
	background-color: #ADB96E;
}

/* ~~ This is the layout information. ~~ 

1) Padding is only placed on the top and/or bottom of the div. The elements within this div have padding on their sides. This saves you from any "box model math". Keep in mind, if you add any side padding or border to the div itself, it will be added to the width you define to create the *total* width. You may also choose to remove the padding on the element in the div and place a second div within it with no width and the padding necessary for your design.

*/

.content {

	padding: 10px 0;
}

/* ~~ The footer ~~ */
.footer {
	padding: 10px 0;
	background-color: #CCC49F;
}

/* ~~ miscellaneous float/clear classes ~~ */
.fltrt {  /* this class can be used to float an element right in your page. The floated element must precede the element it should be next to on the page. */
	float: right;
	margin-left: 8px;
}
.fltlft { /* this class can be used to float an element left in your page. The floated element must precede the element it should be next to on the page. */
	float: left;
	margin-right: 8px;
}
.clearfloat { /* this class can be placed on a <br /> or empty div as the final element following the last floated div (within the #container) if the #footer is removed or taken out of the #container */
	clear:both;
	height:0;
	font-size: 1px;
	line-height: 0px;
}
-->
</style></head>

<body>

<div class="container">

  <div class="content">
    
    
    <table width=100%>
   <tr>
   <td width="33%" height="126" rowspan="5" valign="top"><img src="<?php echo site_url('application/views/assets/img/niaga.png');?>" width="310" height="124"/></td>
   <td width="30%" valign="top">Kepada Yth. </td>
   <td width="19%" valign="top">NO REKENING</td>
   <td width="18%" valign="top">12345</td>
   </tr>
   <tr>
     <td width="30%" valign="top"><?php 
	 //print_r($detail[0]);
	 //echo $detail[0] -> ccode; ?></td>
     <td valign="top">FAKTUR PENJUALAN </td>
     <td valign="top">KONSINYASI</td>
   </tr>
   <tr>
     <td width="30%" height="32" valign="top"><?php echo $detail[0] -> cname; ?></td>
     <td valign="top">NO FAKTUR</td>
     <td valign="top"><?php echo $detail[0] -> tnofaktur; ?></td>
   </tr>
   <tr>
     <td width="30%" rowspan="2" valign="top"><?php //echo $detail[0] -> caddr; ?></td>
     <td valign="top">TANGGAL FAKTUR</td>
     <td valign="top"><?php echo $detail[0] -> ttanggal; ?></td>
   </tr>
   <tr>
     <td valign="top">INFO</td>
     <td valign="top"><?php echo $detail[0] -> tinfo; ?></td>
   </tr>
   <tr>
     <td colspan="4" valign="top" bgcolor="#F3F3F3"  ><br /><br /></td>
   </tr>     
   <tr>
     <td colspan="4">
       <table width=100% border=1 cellpadding=0 cellspacing=0 >
         <tr>
           <td width="13%" bgcolor="#E0E0E0">PLU</td>
           
           <td width="34%" bgcolor="#E0E0E0">Nama Barang</td>
           <td width="16%" bgcolor="#E0E0E0">Harga</td>
           <td width="6%" bgcolor="#E0E0E0">Qty</td>
           <td width="6%" bgcolor="#E0E0E0">Disc</td>
           <td width="9%" bgcolor="#E0E0E0">Jumlah</td>
           
           </tr>
         <!--tr>
           <td width="13%">1</td>
           <td width="16%">KODE-12345</td>
           <td width="34%">Buku A</td>
           <td width="16%">Rp 75.000,00</td>
           <td width="6%">10 </td>
           <td width="6%">10% </td>
           <td width="9%">100</td>
           
           </tr-->
		  <?php
		  $thargaqtyx=0;
		  $ttotalx=0;
		  foreach($penjualan_konsinyasi_detail as $k => $v) :
		  //$phone = explode('*', $v -> tnofaktur);
		  
		  $thargaqty=$v -> tharga*$v -> tqty;
		  $thargaqtyx=$thargaqty+$thargaqtyx;
		  $ttotal= $v -> ttotal; 
		  $ttotalx=$ttotalx+$ttotal;		  
		  ?>
          <tr>
		  								
          <td valign="top" ><?php echo $v -> bcode; ?></td>
          <td valign="top" ><?php echo $v -> btitle; ?></td>          
          <td valign="top" ><?php echo $v -> tharga; ?></td>
		  <td valign="top" ><?php echo $v -> tqty; ?></td>
		  <td valign="top" ><?php echo $v -> tdisc; ?>%</td>
		  <td valign="top" ><?php echo $v -> tharga*$v -> tqty; ?> </td>
          
          

		 
										</tr>
        <?php endforeach; ?>
         </table>
       
       
       </td>
   </tr>   
   </table> 
    
    
   
    
    <p>Keterangan:
    </p><table width=100% border=1 cellpadding=0 cellspacing=0 >

        <tr>
    <td width="18%" align="center">
    Hormat kami
    </td>
    <td width="21%" align="center">
    Expedisi
    </td>
    <td width="24%" align="center">
    Yang Menerima
    </td>
    <td colspan="2" align="center">Total Pembayaran</td>
    </tr>
    <tr>
    <td rowspan="3" align="center">
    <br /><br />
    ( .................... )
    </td>
    <td rowspan="3" align="center">
    <br /><br />
    ( ....................... ) </td>
    <td rowspan="3" align="center">
    <br /><br />
    ( ....................... ) <br /></td>
    <td width="21%" valign="top">Total Brutto</td>
    <td width="16%" valign="top"><?=$thargaqtyx;?></td>
    </tr>
    <tr>
      <td valign="top">Total Disc</td>
      <td valign="top"><?php $tdis=$thargaqtyx-$ttotalx;
	  echo $tdis;
	  ?></td>
    </tr>
    <tr>
      <td valign="top">Total Netto</td>
      <td valign="top"><?=$ttotalx;?></td>
    </tr>    
    </table>
    </p>
    <p><!-- end .content --></p>
  </div>
  <div class="footer">
   
    <table width=100% >
    <tr>
    <td width="39%" valign="top">Catatan</td>
    <td width="19%" valign="top">Kondisi Pembayaran:</td>
    <td width="20%" valign="top">Isi Kondisi Pembayaran</td>
    <td width="6%" valign="top">
    User :
    </td>
    <td width="16%" valign="top">
    Nama User
    </td>
    </tr>
    </table>
    
  </div>
  <!-- end .container --></div>
</body>
</html>
