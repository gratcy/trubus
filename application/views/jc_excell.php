<?php
/***** EDIT BELOW LINES *****/
$DB_Server = $hostname; // MySQL Server
$DB_Username = $username; // MySQL Username
$DB_Password = $password; // MySQL Password
$DB_DBName = $database; // MySQL Database Name
$DB_TBLName = "tablename"; // MySQL Table Name
$xls_filename = 'export_'.date('Y-m-d').'.xls'; // Define Excel (.xls) file name


$db['default']['database'] = 'niaga_db';
/***** DO NOT EDIT BELOW LINES *****/
// Create MySQL connection
$branch=$this -> memcachedlib -> sesresult['ubranchid'];
$sql = "SELECT a.tnofaktur as no_faktur,a.ttanggal as tanggal,
		(select d.ccode from customer_tab d where d.cid=a.tcid)as kode_pelanggan,
		(select d.cname from customer_tab d where d.cid=a.tcid)as pelanggan,		
		(select c.bcode from books_tab c where c.bid=b.tbid and c.bstatus=1)as kode_buku,
		(select c.btitle from books_tab c where c.bid=b.tbid and c.bstatus=1 )as judul_buku,
		b.tharga as harga,b.tqty as qty,b.ttharga as total_harga,b.tdisc as disc,b.ttotal as harga_setelah_disc,a.tinfo as deskripsi,a.approval
		FROM transaction_tab a,transaction_detail_tab b, customer_tab e WHERE a.tcid=e.cid AND (a.ttanggal between '$datefrom' and '$dateto') and a.tid=b.ttid AND a.tbid='$branch'  AND a.ttype='2' and a.ttypetrans='2' AND a.tstatus=1";
$Connect = @mysql_connect($DB_Server, $DB_Username, $DB_Password) or die("Failed to connect to MySQL:<br />" . mysql_error() . "<br />" . mysql_errno());
// Select database
$Db = @mysql_select_db($DB_DBName, $Connect) or die("Failed to select database:<br />" . mysql_error(). "<br />" . mysql_errno());
// Execute query
$result = @mysql_query($sql,$Connect) or die("Failed to execute query:<br />" . mysql_error(). "<br />" . mysql_errno());
 
// Header info settings
header("Content-Type: application/xls");
header("Content-Disposition: attachment; filename=$xls_filename");
header("Pragma: no-cache");
header("Expires: 0");
 
/***** Start of Formatting for Excel *****/
// Define separator (defines columns in excel &amp; tabs in word)
$sep = "\t"; // tabbed character
 
// Start of printing column names as names of MySQL fields
for ($i = 0; $i<mysql_num_fields($result); $i++) {
  echo mysql_field_name($result, $i) . "\t";
}
print("\n");
// End of printing column names
 
// Start while loop to get data
while($row = mysql_fetch_row($result))
{
  $schema_insert = "";
  for($j=0; $j<mysql_num_fields($result); $j++)
  {
    if(!isset($row[$j])) {
      $schema_insert .= "NULL".$sep;
    }
    elseif ($row[$j] != "") {
      $schema_insert .= "$row[$j]".$sep;
    }
    else {
      $schema_insert .= "".$sep;
    }
  }
  $schema_insert = str_replace($sep."$", "", $schema_insert);
  $schema_insert = preg_replace("/\r\n|\n\r|\n|\r/", " ", $schema_insert);
  $schema_insert .= "\t";
  print(trim($schema_insert));
  print "\n";
}
?>