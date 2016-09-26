<html>
<head>
	<?php if ($format == 1) : ?>
<title>Print Report Penjualan Publisher</title>
<style>
html,body{margin:0;padding:0;}
</style>
<?php else: ?>
<?php
$filename ="report_penjualan_publisher-".$datesort[0]."-".$datesort[0].".xls";
header('Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename='.$filename);
header("Cache-Control: max-age=0");
?>
<?php endif; ?>
</head>
<body style="font-size:18px;">
<div style="width:1000px;padding:3px 3px 3px 5px;">
<?php foreach($publisher as $k => $v) : ?>
		<div style="width:500px;float:left">
		<table border="0" width="500" style="border-collapse: collapse;">
		<tr><td><h3>PT. NIAGA SWADAYA</h3></td></tr>
		<tr><td><h3><?php echo __get_branch_address(); ?></h3></td></tr>
		<tr><td><h3><?php echo ($this -> memcachedlib -> sesresult['ubranchid'] == 1 ? 'JAKARTA' : $this -> memcachedlib -> sesresult['ubranch']); ?></h3></td></tr>
		</table>
		</div>
		<div style="width:400px;float:right;">
		<table border="0" width="400" style="border-collapse: collapse;">
		<tr><td><h3>LAPORAN PENJUALAN</h3></td></tr>
		<tr><td><h3><?php echo $v -> pname; ?></h3></td></tr>
		<tr><td><h3>Bulan: <?php echo __get_month($datesort[0]);?> <?php echo $datesort[1]; ?></h3></td></tr>
		</table>
		</div>
		<div style="width:1000">
		<div style="float:right;"><b>Tgl. Cetak : <?php echo date('d/m/Y');?> | Reguler</b></div>
		</div>
		<table border="0" width="1000" style="border-collapse: collapse;">
		<thead>
		<tr style="border:1px solid #000;padding:3px;">
		<th style="border:1px solid #000;padding:3px;">Kode</th>
		<th style="border:1px solid #000;padding:3px;">Judul</th>
		<th style="border:1px solid #000;padding:3px;">Harga</th>
		<th style="border:1px solid #000;padding:3px;">Q Jual</th>
		<th style="border:1px solid #000;padding:3px;">Q Retur</th>
		<th style="border:1px solid #000;padding:3px;">Q Bayar</th>
		<th style="border:1px solid #000;padding:3px;">Bruto Jual</th>
		<th style="border:1px solid #000;padding:3px;">Bruto Retur</th>
		<th style="border:1px solid #000;padding:3px;">Total Bayar</th>
		<th style="border:1px solid #000;padding:3px;">Disc Penerbit</th>
		<th style="border:1px solid #000;padding:3px;">Netto</th>
		</tr>
		</thead>
		<tbody>
			<?php
			$all_totalharga = 0;
			$all_qjual = 0;
			$all_qretur = 0;
			$all_qbayar = 0;
			$all_totalbrutojual = 0;
			$all_totalbrutoretur = 0;
			$all_totalbayar = 0;
			$all_totalnetto = 0;
			$all_totaldiscadd = 0;
			$all_totaldiscaddnetto = 0;

			$pubc = $this -> reportpublisher_model -> __get_publisher_child($v -> pid);
			$data = $this -> reportpublisher_model -> __get_report($this -> memcachedlib -> sesresult['ubranchid'],$datesort,$v -> pid,$pubc,1);
			$harga = 0;
			$jual = 0;
			$retur = 0;
			$totalharga = 0;
			$totaljual = 0;
			$totalretur = 0;
			$totalbayar = 0;
			$totalbayar2 = 0;
			$totalbrutojual = 0;
			$totalbrutoretur = 0;
			$totalnetto = 0;
			foreach($data as $k1 => $v1) :
			$jual = (int) $v1 -> qjual;
			$retur = (int) $v1 -> qretur;
			$harga = $v1 -> tharga;
			$tbayar = ($jual - $retur) * $harga;
			$netto = $tbayar - (($tbayar * $v1 -> bdisc) / 100);
			?>
			<tr style="border:1px solid #000;padding:3px;">
			<td style="border:1px solid #000;padding:3px;"><?php echo $v1 -> bcode; ?></td>
			<td style="border:1px solid #000;padding:3px;"><?php echo $v1 -> btitle; ?></td>
			<td style="border:1px solid #000;padding:3px;"><?php echo __get_rupiah($harga,2); ?></td>
			<td style="border:1px solid #000;padding:3px;"><?php echo $jual; ?></td>
			<td style="border:1px solid #000;padding:3px;"><?php echo $retur; ?></td>
			<td style="border:1px solid #000;padding:3px;"><?php echo ($jual - $retur); ?></td>
			<td style="border:1px solid #000;padding:3px;"><?php echo __get_rupiah($jual * $harga); ?></td>
			<td style="border:1px solid #000;padding:3px;"><?php echo __get_rupiah($retur * $harga); ?></td>
			<td style="border:1px solid #000;padding:3px;"><?php echo __get_rupiah($tbayar); ?></td>
			<td style="border:1px solid #000;padding:3px;"><?php echo ($v1 -> bdisc ? $v1 -> bdisc : ''); ?></td>
			<td style="border:1px solid #000;padding:3px;"><?php echo __get_rupiah($netto); ?></td>
			</tr>
			<?php
			$totalharga += $harga;
			$totaljual += $jual;
			$totalretur += $retur;
			$totalbayar += ($jual - $retur);
			$totalbrutojual += ($jual * $harga);
			$totalbrutoretur += ($retur * $harga);
			$totalbayar2 += $tbayar;
			$totalnetto += $netto;
			endforeach;
			?>
		</tbody>
		<tfoot>
			<tr style="border:1px solid #000;padding:3px;">
			<td style="border:1px solid #000;padding:3px;"></td>
			<td style="border:1px solid #000;padding:3px;"></td>
			<td style="border:1px solid #000;padding:3px;"><?php echo __get_rupiah($totalharga); ?></td>
			<td style="border:1px solid #000;padding:3px;"><?php echo $totaljual; ?></td>
			<td style="border:1px solid #000;padding:3px;"><?php echo $totalretur; ?></td>
			<td style="border:1px solid #000;padding:3px;"><?php echo $totalbayar; ?></td>
			<td style="border:1px solid #000;padding:3px;"><?php echo __get_rupiah($totalbrutojual); ?></td>
			<td style="border:1px solid #000;padding:3px;"><?php echo __get_rupiah($totalbrutoretur); ?></td>
			<td style="border:1px solid #000;padding:3px;"><?php echo __get_rupiah($totalbayar2); ?></td>
			<td style="border:1px solid #000;padding:3px;">-</td>
			<td style="border:1px solid #000;padding:3px;"><?php echo __get_rupiah($totalnetto); ?></td>
		</tr>
		</tfoot>
		<?php
			$all_totalharga += $totalharga;
			$all_qjual += $totaljual;
			$all_qretur += $totalretur;
			$all_qbayar += $totalbayar;
			$all_totalbrutojual += $totalbrutojual;
			$all_totalbrutoretur += $totalbrutoretur;
			$all_totalbayar += $totalbayar2;
			$all_totalnetto += $totalnetto;
			$all_totaldiscadd += $totaldiskadd;
			$all_totaldiscaddnetto += $totalnettodisc;
		?>
		</table>
		<p>&nbsp;</p>
		<div style="width:500px;float:left">
		<table border="0" width="500" style="border-collapse: collapse;">
		<tr><td><h3>PT. NIAGA SWADAYA</h3></td></tr>
		<tr><td><h3><?php echo __get_branch_address(); ?></h3></td></tr>
		<tr><td><h3><?php echo ($this -> memcachedlib -> sesresult['ubranchid'] == 1 ? 'JAKARTA' : $this -> memcachedlib -> sesresult['ubranch']); ?></h3></td></tr>
		</table>
		</div>
		<div style="width:400px;float:right;">
		<table border="0" width="400" style="border-collapse: collapse;">
		<tr><td><h3>LAPORAN PENJUALAN</h3></td></tr>
		<tr><td><h3><?php echo $v -> pname; ?></h3></td></tr>
		<tr><td><h3>Bulan: <?php echo __get_month($datesort[0]);?> <?php echo $datesort[1]; ?></h3></td></tr>
		</table>
		</div>
		<div style="width:1000">
		<div style="float:right;"><b>Tgl. Cetak : <?php echo date('d/m/Y');?> | Proyek</b></div>
		</div>
		<table border="0" width="1000" style="border-collapse: collapse;">
		<thead>
		<tr style="border:1px solid #000;padding:3px;">
		<th style="border:1px solid #000;padding:3px;">Kode</th>
		<th style="border:1px solid #000;padding:3px;">Judul</th>
		<th style="border:1px solid #000;padding:3px;">Harga</th>
		<th style="border:1px solid #000;padding:3px;">Q Jual</th>
		<th style="border:1px solid #000;padding:3px;">Q Retur</th>
		<th style="border:1px solid #000;padding:3px;">Q Bayar</th>
		<th style="border:1px solid #000;padding:3px;">Bruto Jual</th>
		<th style="border:1px solid #000;padding:3px;">Bruto Retur</th>
		<th style="border:1px solid #000;padding:3px;">Total Bayar</th>
		<th style="border:1px solid #000;padding:3px;">Disc Penerbit</th>
		<th style="border:1px solid #000;padding:3px;">Netto</th>
		<th style="border:1px solid #000;padding:3px;">Disc Tambahan</th>
		<th style="border:1px solid #000;padding:3px;">Total Netto</th>
		</tr>
		</thead>
		<tbody>
		<?php
			$data = $this -> reportpublisher_model -> __get_report($this -> memcachedlib -> sesresult['ubranchid'],$datesort,$v -> pid,$pubc,2);
			$harga = 0;
			$jual = 0;
			$retur = 0;
			$totalharga = 0;
			$totaljual = 0;
			$totalretur = 0;
			$totalbayar = 0;
			$totalbayar2 = 0;
			$totalbrutojual = 0;
			$totalbrutoretur = 0;
			$totalnetto = 0;
			$totaldiskadd = 0;
			$totalnettodisc = 0;
			$diskadd = 0;
			foreach($data as $k1 => $v1) :
			$jual = (int) $v1 -> qjual;
			$retur = (int) $v1 -> qretur;
			$harga = $v1 -> tharga;
			$tbayar = ($jual - $retur) * $harga;
			$netto = $tbayar - (($tbayar * $v1 -> bdisc) / 100);
			$diskadd = ($netto*$v1 -> tongkos/100);
			?>
			<tr style="border:1px solid #000;padding:3px;">
			<td style="border:1px solid #000;padding:3px;"><?php echo $v1 -> bcode; ?></td>
			<td style="border:1px solid #000;padding:3px;"><?php echo $v1 -> btitle; ?></td>
			<td style="border:1px solid #000;padding:3px;"><?php echo __get_rupiah($harga,2); ?></td>
			<td style="border:1px solid #000;padding:3px;"><?php echo $jual; ?></td>
			<td style="border:1px solid #000;padding:3px;"><?php echo $retur; ?></td>
			<td style="border:1px solid #000;padding:3px;"><?php echo ($jual - $retur); ?></td>
			<td style="border:1px solid #000;padding:3px;"><?php echo __get_rupiah($jual * $harga); ?></td>
			<td style="border:1px solid #000;padding:3px;"><?php echo __get_rupiah($retur * $harga); ?></td>
			<td style="border:1px solid #000;padding:3px;"><?php echo __get_rupiah($tbayar); ?></td>
			<td style="border:1px solid #000;padding:3px;"><?php echo ($v1 -> bdisc ? $v1 -> bdisc : ''); ?></td>
			<td style="border:1px solid #000;padding:3px;"><?php echo __get_rupiah($netto); ?></td>
			<td style="border:1px solid #000;padding:3px;"><?php echo __get_rupiah($diskadd); ?></td>
			<td style="border:1px solid #000;padding:3px;"><?php echo __get_rupiah($netto-$diskadd); ?></td>
			</tr>
			<?php
			$totaldiskadd += $diskadd;
			$totalnettodisc += $netto-$diskadd;
			$totalharga += $harga;
			$totaljual += $jual;
			$totalretur += $retur;
			$totalbayar += ($jual - $retur);
			$totalbrutojual += ($jual * $harga);
			$totalbrutoretur += ($retur * $harga);
			$totalbayar2 += $tbayar;
			$totalnetto += $netto;
			endforeach;
			?>
		</tbody>
		<tfoot>
			<tr style="border:1px solid #000;padding:3px;">
			<td style="border:1px solid #000;padding:3px;"></td>
			<td style="border:1px solid #000;padding:3px;"></td>
			<td style="border:1px solid #000;padding:3px;"><?php echo __get_rupiah($totalharga); ?></td>
			<td style="border:1px solid #000;padding:3px;"><?php echo $totaljual; ?></td>
			<td style="border:1px solid #000;padding:3px;"><?php echo $totalretur; ?></td>
			<td style="border:1px solid #000;padding:3px;"><?php echo $totalbayar; ?></td>
			<td style="border:1px solid #000;padding:3px;"><?php echo __get_rupiah($totalbrutojual); ?></td>
			<td style="border:1px solid #000;padding:3px;"><?php echo __get_rupiah($totalbrutoretur); ?></td>
			<td style="border:1px solid #000;padding:3px;"><?php echo __get_rupiah($totalbayar2); ?></td>
			<td style="border:1px solid #000;padding:3px;">-</td>
			<td style="border:1px solid #000;padding:3px;"><?php echo __get_rupiah($totalnetto); ?></td>
			<td style="border:1px solid #000;padding:3px;"><?php echo __get_rupiah($totaldiskadd); ?></td>
			<td style="border:1px solid #000;padding:3px;"><?php echo __get_rupiah($totalnettodisc); ?></td>
		</tr>
		</tfoot>
		<?php
			$all_totalharga += $totalharga;
			$all_qjual += $totaljual;
			$all_qretur += $totalretur;
			$all_qbayar += $totalbayar;
			$all_totalbrutojual += $totalbrutojual;
			$all_totalbrutoretur += $totalbrutoretur;
			$all_totalbayar += $totalbayar2;
			$all_totalnetto += $totalnetto;
			$all_totaldiscadd += $totaldiskadd;
			$all_totaldiscaddnetto += $totalnettodisc;
		?>
		</table>
		<p>&nbsp;</p>
		<div style="width:500px;float:left">
		<table border="0" width="500" style="border-collapse: collapse;">
		<tr><td><h3>PT. NIAGA SWADAYA</h3></td></tr>
		<tr><td><h3><?php echo __get_branch_address(); ?></h3></td></tr>
		<tr><td><h3><?php echo ($this -> memcachedlib -> sesresult['ubranchid'] == 1 ? 'JAKARTA' : $this -> memcachedlib -> sesresult['ubranch']); ?></h3></td></tr>
		</table>
		</div>
		<div style="width:400px;float:right;">
		<table border="0" width="400" style="border-collapse: collapse;">
		<tr><td><h3>LAPORAN PENJUALAN</h3></td></tr>
		<tr><td><h3><?php echo $v -> pname; ?></h3></td></tr>
		<tr><td><h3>Bulan: <?php echo __get_month($datesort[0]);?> <?php echo $datesort[1]; ?></h3></td></tr>
		</table>
		</div>
		<div style="width:1000">
		<div style="float:right;"><b>Tgl. Cetak : <?php echo date('d/m/Y');?> | Pameran</b></div>
		</div>
		<table border="0" width="1000" style="border-collapse: collapse;">
		<thead>
		<tr style="border:1px solid #000;padding:3px;">
		<th style="border:1px solid #000;padding:3px;">Kode</th>
		<th style="border:1px solid #000;padding:3px;">Judul</th>
		<th style="border:1px solid #000;padding:3px;">Harga</th>
		<th style="border:1px solid #000;padding:3px;">Q Jual</th>
		<th style="border:1px solid #000;padding:3px;">Q Retur</th>
		<th style="border:1px solid #000;padding:3px;">Q Bayar</th>
		<th style="border:1px solid #000;padding:3px;">Bruto Jual</th>
		<th style="border:1px solid #000;padding:3px;">Bruto Retur</th>
		<th style="border:1px solid #000;padding:3px;">Total Bayar</th>
		<th style="border:1px solid #000;padding:3px;">Disc Penerbit</th>
		<th style="border:1px solid #000;padding:3px;">Netto</th>
		<th style="border:1px solid #000;padding:3px;">Disc Tambahan</th>
		<th style="border:1px solid #000;padding:3px;">Total Netto</th>
		</tr>
		</thead>
		<tbody>
		<?php
			$data = $this -> reportpublisher_model -> __get_report($this -> memcachedlib -> sesresult['ubranchid'],$datesort,$v -> pid,$pubc,3);
			$harga = 0;
			$jual = 0;
			$retur = 0;
			$totalharga = 0;
			$totaljual = 0;
			$totalretur = 0;
			$totalbayar = 0;
			$totalbayar2 = 0;
			$totalbrutojual = 0;
			$totalbrutoretur = 0;
			$totalnetto = 0;
			$diskadd = 0;
			$totaldiskadd = 0;
			$totalnettodisc = 0;
			foreach($data as $k1 => $v1) :
			$jual = (int) $v1 -> qjual;
			$retur = (int) $v1 -> qretur;
			$harga = $v1 -> tharga;
			$tbayar = ($jual - $retur) * $harga;
			$netto = $tbayar - (($tbayar * $v1 -> bdisc) / 100);
			$diskadd = ($netto*$v1 -> tongkos/100);
			?>
			<tr style="border:1px solid #000;padding:3px;">
			<td style="border:1px solid #000;padding:3px;"><?php echo $v1 -> bcode; ?></td>
			<td style="border:1px solid #000;padding:3px;"><?php echo $v1 -> btitle; ?></td>
			<td style="border:1px solid #000;padding:3px;"><?php echo __get_rupiah($harga,2); ?></td>
			<td style="border:1px solid #000;padding:3px;"><?php echo $jual; ?></td>
			<td style="border:1px solid #000;padding:3px;"><?php echo $retur; ?></td>
			<td style="border:1px solid #000;padding:3px;"><?php echo ($jual - $retur); ?></td>
			<td style="border:1px solid #000;padding:3px;"><?php echo __get_rupiah($jual * $harga); ?></td>
			<td style="border:1px solid #000;padding:3px;"><?php echo __get_rupiah($retur * $harga); ?></td>
			<td style="border:1px solid #000;padding:3px;"><?php echo __get_rupiah($tbayar); ?></td>
			<td style="border:1px solid #000;padding:3px;"><?php echo ($v1 -> bdisc ? $v1 -> bdisc : ''); ?></td>
			<td style="border:1px solid #000;padding:3px;"><?php echo __get_rupiah($netto); ?></td>
			<td style="border:1px solid #000;padding:3px;"><?php echo __get_rupiah($diskadd); ?></td>
			<td style="border:1px solid #000;padding:3px;"><?php echo __get_rupiah($netto-$diskadd); ?></td>
			</tr>
			<?php
			$totalnettodisc += $netto-$diskadd;
			$totalharga += $harga;
			$totaljual += $jual;
			$totalretur += $retur;
			$totalbayar += ($jual - $retur);
			$totalbrutojual += ($jual * $harga);
			$totalbrutoretur += ($retur * $harga);
			$totalbayar2 += $tbayar;
			$totalnetto += $netto;
			endforeach;
			?>
		</tbody>
		<tfoot>
			<tr style="border:1px solid #000;padding:3px;">
			<td style="border:1px solid #000;padding:3px;"></td>
			<td style="border:1px solid #000;padding:3px;"></td>
			<td style="border:1px solid #000;padding:3px;"><?php echo __get_rupiah($totalharga); ?></td>
			<td style="border:1px solid #000;padding:3px;"><?php echo $totaljual; ?></td>
			<td style="border:1px solid #000;padding:3px;"><?php echo $totalretur; ?></td>
			<td style="border:1px solid #000;padding:3px;"><?php echo $totalbayar; ?></td>
			<td style="border:1px solid #000;padding:3px;"><?php echo __get_rupiah($totalbrutojual); ?></td>
			<td style="border:1px solid #000;padding:3px;"><?php echo __get_rupiah($totalbrutoretur); ?></td>
			<td style="border:1px solid #000;padding:3px;"><?php echo __get_rupiah($totalbayar2); ?></td>
			<td style="border:1px solid #000;padding:3px;">-</td>
			<td style="border:1px solid #000;padding:3px;"><?php echo __get_rupiah($totalnetto); ?></td>
			<td style="border:1px solid #000;padding:3px;"><?php echo __get_rupiah($totaldiskadd); ?></td>
			<td style="border:1px solid #000;padding:3px;"><?php echo __get_rupiah($totalnettodisc); ?></td>
		</tr>
		<?php
			$all_totalharga += $totalharga;
			$all_qjual += $totaljual;
			$all_qretur += $totalretur;
			$all_qbayar += $totalbayar;
			$all_totalbrutojual += $totalbrutojual;
			$all_totalbrutoretur += $totalbrutoretur;
			$all_totalbayar += $totalbayar2;
			$all_totalnetto += $totalnetto;
			$all_totaldiscadd += $totaldiskadd;
			$all_totaldiscaddnetto += $totalnettodisc;
		?>
		</tfoot>
		</table>
		<p>&nbsp;</p>
		<hr />
		<br />
		<b>Grand Total</b>
		<table border="0" width="1000" style="border-collapse: collapse;">
		<thead>
		<tr style="border:1px solid #000;padding:3px;">
		<th style="border:1px solid #000;padding:3px;">Harga</th>
		<th style="border:1px solid #000;padding:3px;">Q Jual</th>
		<th style="border:1px solid #000;padding:3px;">Q Retur</th>
		<th style="border:1px solid #000;padding:3px;">Q Bayar</th>
		<th style="border:1px solid #000;padding:3px;">Bruto Jual</th>
		<th style="border:1px solid #000;padding:3px;">Bruto Retur</th>
		<th style="border:1px solid #000;padding:3px;">Total Bayar</th>
		<th style="border:1px solid #000;padding:3px;">Netto</th>
		<th style="border:1px solid #000;padding:3px;">Disc Tambahan</th>
		<th style="border:1px solid #000;padding:3px;">Total Netto</th>
		</tr>
		</thead>
		<tbody>
			<tr style="border:1px solid #000;padding:3px;">
			<td style="border:1px solid #000;padding:3px;"><?php echo __get_rupiah($all_totalharga); ?></td>
			<td style="border:1px solid #000;padding:3px;"><?php echo $all_qjual; ?></td>
			<td style="border:1px solid #000;padding:3px;"><?php echo $all_qretur; ?></td>
			<td style="border:1px solid #000;padding:3px;"><?php echo $all_qbayar; ?></td>
			<td style="border:1px solid #000;padding:3px;"><?php echo __get_rupiah($all_totalbrutojual); ?></td>
			<td style="border:1px solid #000;padding:3px;"><?php echo __get_rupiah($all_totalbrutoretur); ?></td>
			<td style="border:1px solid #000;padding:3px;"><?php echo __get_rupiah($all_totalbayar); ?></td>
			<td style="border:1px solid #000;padding:3px;"><?php echo __get_rupiah($all_totalnetto); ?></td>
			<td style="border:1px solid #000;padding:3px;"><?php echo __get_rupiah($all_totaldiscadd); ?></td>
			<td style="border:1px solid #000;padding:3px;"><?php echo __get_rupiah($all_totalnetto-$all_totaldiscadd); ?></td>
		</tr>
		</tbody>
		</table>
		<p><i>Ket: Pembayaran Bulan <?php echo __get_month($datesort[0]);?> <?php echo $datesort[1]; ?></i></p>
		<p>&nbsp;</p>
		<div style="float:left;">
		<table border="0" style="width:250px;">
		<tr><td>Mengetahui,</td></tr>
		<tr><td><br /><br /><br />Aryo Prabowo</td></tr>
		<tr><td style="border-top:1px solid #000">Manajer Pemasaran</td></tr>
		</table>
		</div>
		<div style="float:left;padding-left:75px">
		<table border="0" style="width:250px;">
		<tr><td>Keuangan,</td></tr>
		<tr><td><br /><br /><br />Aulia Rahman</td></tr>
		<tr><td style="border-top:1px solid #000">Staf keuangan</td></tr>
		</table>
		</div>
		<div style="float:right;">
		<table border="0" style="width:250px;">
		<tr><td>Dibuat oleh,</td></tr>
		<tr><td><br /><br /><br />Rintono</td></tr>
		<tr><td style="border-top:1px solid #000">Spv.Pengadaan Produk</td></tr>
		</table>
		</div>
		<p>&nbsp;</p>
		<p>&nbsp;</p>
		<div style="clear:both;"></div>
		<p>&nbsp;</p>
		<p>&nbsp;</p>
<?php endforeach; ?>
		</div>
</body>
</html>
<?php die; ?>
