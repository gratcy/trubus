<html>
<head>
<title>Print Distribution Transfer</title>
<style>
html,body{margin:0;padding:0;}
</style>
</head>
<body style="font-size:18px;">
<div style="width:850px;padding:3px 3px 3px 5px;">
									<h2>PT. NIAGA SWADAYA</h2>
		<h3><?php echo $detail[0] -> dtitle;?></h3>
		<div style="clear:both;"></div>
		<div style="width:500px;">
		<table border="0" width="600" style="border-collapse: collapse;">
		<thead>
		<tr><td style="width:140px">Doc No.</td><td>: <?php echo $detail[0] -> ddocno;?></td></tr>
		<tr><td>Request No.</td><td>: <?php echo ($detail[0] -> dtype == 1 ? 'R01' : 'R02').str_pad($detail[0] -> ddrid, 4, "0", STR_PAD_LEFT); ?></td></tr>
		<tr><td>Request Type</td><td>: <?php echo __get_request_type($detail[0] -> dtype,1);?></td></tr>
		<tr><td>Date</td><td>: <?php echo __get_date($detail[0] -> ddate,2);?></td></tr>
		<tr><td>Branch From</td><td>: <?php echo $detail[0] -> fbname;?></td></tr>
		<tr><td>Branch To</td><td>: <?php echo $detail[0] -> tbname;?></td></tr>
		<tr><td>Title</td><td>: <?php echo $detail[0] -> dtitle;?></td></tr>
		<tr><td>Description</td><td>: <?php echo $detail[0] -> ddesc;?></td></tr>
		<tr><td>Status</td><td>: Approved</td></tr>
		</thead>
		</tbody>
		</table>
		</div>
		<h3>List Books</h3>
		<table border="0" width="850" style="border-collapse: collapse;">
		<thead>
		<tr style="border:1px solid #000;padding:3px;"><th style="border:1px solid #000;padding:3px;">Publisher</th><th style="border:1px solid #000;padding:3px;">Code</th><th style="border:1px solid #000;padding:3px;">Title</th><th style="border:1px solid #000;padding:3px;">ISBN</th><th style="border:1px solid #000;padding:3px;">Price</th><th style="border:1px solid #000;padding:3px;">QTY</th></tr>
		</thead>
		<tbody>
		<?php
		$tqty = 0;
		foreach($books as $k => $v) :
		?>
			<tr style="border:1px solid #000;padding:3px;">
			<td style="border:1px solid #000;padding:3px;"><?php echo $v -> pname; ?></td>
			<td style="border:1px solid #000;padding:3px;"><?php echo $v -> bcode; ?></td>
			<td style="border:1px solid #000;padding:3px;"><?php echo $v -> btitle; ?></td>
			<td style="border:1px solid #000;padding:3px;"><?php echo $v -> bisbn; ?></td>
			<td style="border:1px solid #000;padding:3px;"><?php echo __get_rupiah($v -> bprice); ?></td>
			<td style="border:1px solid #000;padding:3px;"><?php echo $v -> dqty; ?></td>
			</tr>
		<?php
		$tqty += $v -> dqty;
		endforeach;
		?>
		</tbody>
		<tfoot>
		<tr style="border:1px solid #000;padding:3px;">
		<td style="border:1px solid #000;padding:3px;"><b>Total</b></td>
		<td style="border:1px solid #000;padding:3px;"></td>
		<td style="border:1px solid #000;padding:3px;"></td>
		<td style="border:1px solid #000;padding:3px;"></td>
		<td style="border:1px solid #000;padding:3px;"></td>
		<td style="border:1px solid #000;padding:3px;"><?php echo $tqty; ?></td>
		</tr>
		</tfoot>
		</table>
		</div>
                                    </body>
                                    </html>
