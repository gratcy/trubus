<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<style type="text/css">

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
     <td valign="top">FAKTUR  </td>
     <td valign="top">PEMBELIAN</td>
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
        
           <td width="6%" bgcolor="#E0E0E0">Qty</td>
    
           
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
		  foreach($retur_bk_detail as $k => $v) :
		  //$phone = explode('*', $v -> tnofaktur);
		  
		  $thargaqty=$v -> tharga*$v -> tqty;
		  $thargaqtyx=$thargaqty+$thargaqtyx;
		  $ttotal= $v -> ttotal; 
		  $ttotalx=$ttotalx+$ttotal;		  
		  ?>
          <tr>
										
          <td valign="top" ><?php echo $v -> bcode; ?></td>
          <td valign="top" ><?php echo $v -> btitle; ?></td>          
        
		  <td valign="top" ><?php echo $v -> tqty; ?></td>
	
          
          

		 
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
    <td colspan="2" align="center"></td>
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
