<html>
<head>
	<?php if ($pt['etype'] == 1) : ?>
<title>Print Report Item Receiving</title>
<style>
html,body{margin:0;padding:0;}
</style>
<?php else: ?>
<?php
$filename ="report_item_receiving-".date('d-m-Y').".xls";
header('Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename='.$filename);
header("Cache-Control: max-age=0");
?>
<?php endif; ?>
</head>
<body style="font-size:18px;">
<div style="width:850px;padding:3px 3px 3px 5px;">
									<h2>PT. NIAGA SWADAYA</h2>
		<div style="font-size:20px;font-weight:bold;padding-bottom:5px">Report Item Receiving</div>
		<div style="clear:both;"></div>
		<div style="width:500px;">
		<table border="0" width="500" style="border-collapse: collapse;">
		<thead>
		<tr><td>Branch</td><td>: <?php echo __get_pb_list(array($pt['branchid']),1); ?></td></tr>
		<tr><td>Type</td><td>: <?php echo __get_receiving_type($pt['rtype'],1); ?></td></tr>
		<tr><td>Publisher</td><td>: <?php echo (__get_pb_list(($pt['rtype'] == 1 ? $pt['branch'] : $pt['publisher']),$pt['rtype']) ? __get_pb_list(($pt['rtype'] == 1 ? $pt['branch'] : $pt['publisher']),$pt['rtype']) : 'All'); ?></td></tr>
		<?php if ($pt['datesort']) : ?>
		<tr><td>Date</td><td>: <?php echo str_replace(' - ',' s/d ',$pt['datesort']); ?></td></tr>
		<?php endif; ?>
		</thead>
		</tbody>
		</table>
		</div>
		<br />
		<div style="font-size:20px;font-weight:bold;padding-bottom:5px">Receiving List</div>
		
		<table border="0" width="850" style="border-collapse: collapse;">
		<thead>
		<tr style="border:1px solid #000;padding:3px;"><th style="border:1px solid #000;padding:3px;">Date</th><th style="border:1px solid #000;padding:3px;">Doc No.</th><th style="border:1px solid #000;padding:3px;">Publisher</th><th style="border:1px solid #000;padding:3px;">Code</th><th style="border:1px solid #000;padding:3px;">Title</th><th style="border:1px solid #000;padding:3px;">ISBN</th><th style="border:1px solid #000;padding:3px;">Price</th><th style="border:1px solid #000;padding:3px;">QTY</th><th style="border:1px solid #000;padding:3px;">Description</th></tr>
		</thead>
		<tbody>
			<?php
				$tgl = '';
				foreach($data as $k => $v) :
			?>
			<tr style="border:1px solid #000;padding:3px;">
			<td style="border:1px solid #000;padding:3px;">
				<?php
					$date = __get_date($v -> rdate,1);
					if($tgl <> $date){
						$tgl = $date;
						echo $tgl;
					}
				?>		
			</td>
			<td style="border:1px solid #000;padding:3px;"><?php echo $v -> rdocno; ?></td>
			<td style="border:1px solid #000;padding:3px;"><?php echo $v -> pname; ?></td>
			<td style="border:1px solid #000;padding:3px;"><?php echo $v -> bcode; ?></td>
			<td style="border:1px solid #000;padding:3px;"><?php echo $v -> btitle; ?></td>
			<td style="border:1px solid #000;padding:3px;"><?php echo $v -> bisbn; ?></td>
			<td style="border:1px solid #000;padding:3px;"><?php echo $v -> bprice; ?></td>
			<td style="border:1px solid #000;padding:3px;"><?php echo $v -> rqty; ?></td>
			<td style="border:1px solid #000;padding:3px;"><?php echo $v -> rdesc; ?></td>
			</tr>
			<?php endforeach; ?>
		</tbody>
		</table>
		</div>
                                    </body>
                                    </html>
<?php die; ?>
