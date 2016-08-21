<?php
$branch = $this -> memcachedlib -> sesresult['ubranchid'];
$arrtype = array($pt['typea'],$pt['typeb'],$pt['typec'],$pt['typed'],$pt['typee'],$pt['typef'],$pt['typeg'],$pt['typei'],$pt['typej'],$pt['typel'],$pt['typek']);
if ($pt['format'] == 2) {
$filename ="excelreport-".date('d-m-Y').".xls";
header('Content-type: application/vnd.ms-excel; charset=utf-8');
header('Content-Disposition: attachment; filename='.$filename);
header("Cache-Control: max-age=0");
}
?>
<html>
	<title>Reporting Transaction</title>
<body>
									<h2>PT. NIAGA SWADAYA</h2>
		<h3>Laporan Transaksi</h3>
<table border="0">
<?php if ($pt['datesort']) : ?>
<tr><td>Tanggal</td><td>: <?php echo $pt['datesort']; ?></td></tr>
<?php endif; ?>
<?php if ($pt['customer'] && $pt['customerr']) : ?>
<tr><td>Customer</td><td>: <?php echo __get_reporting_name_option($pt['customer'],1) . ' s/d ' . __get_reporting_name_option($pt['customerr'],1); ?></td></tr>
<?php endif; ?>
<?php if ($pt['area'] && $pt['areax']) : ?>
<tr><td>Area</td><td>: <?php echo __get_reporting_name_option($pt['area'],2) . ' s/d ' . __get_reporting_name_option($pt['areax'],2); ?></td></tr>
<?php endif; ?>
<?php if ($pt['publisher'] && $pt['publisherx']) : ?>
<tr><td>Publisher</td><td>: <?php echo __get_reporting_name_option($pt['publisher'],3) . ' s/d ' . __get_reporting_name_option($pt['publisherx'],3); ?></td></tr>
<?php endif; ?>
<?php if ($pt['kode_buku'] && $pt['kode_bukux']) : ?>
<tr><td>Buku</td><td>: <?php echo __get_reporting_name_option($pt['kode_buku'],4) . ' s/d ' . __get_reporting_name_option($pt['kode_bukux'],4); ?></td></tr>
<?php endif; ?>
<tr><td>Transaksi</td><td>: <?php echo __get_reporting_transaction_type($arrtype); ?></td></tr>
<tr><td>Laporan</td><td>: <?php echo __get_reporting_type($pt['rtype'],1); ?></td></tr>
</table>
<br />
<?php if ($pt['rtype'] == 0) { ?>
                            <table border="0" style="border-collapse: collapse;">
								<thead>
							<tr>
							<th style="border:1px solid #000;padding:3px;">No Faktur</th>
							<th style="border:1px solid #000;padding:3px;">Tanggal Faktur</th>
							<th style="border:1px solid #000;padding:3px;">Publisher</th>
			<?php if($pt['typei']!='RB'){ ?>				
							
							<th style="border:1px solid #000;padding:3px;">Kode Cust</th>
							<th style="border:1px solid #000;padding:3px;">Customer</th>
							<th style="border:1px solid #000;padding:3px;">Area</th>
			<?php }?>			
							<th style="border:1px solid #000;padding:3px;">Kode Buku</th>
							<th style="border:1px solid #000;padding:3px;">Nama Buku</th>
							<th style="border:1px solid #000;padding:3px;">Desc</th>
							<th style="border:1px solid #000;padding:3px;">Harga Satuan</th>
							<th style="border:1px solid #000;padding:3px;width:50px">Qty</th>
							<th style="border:1px solid #000;padding:3px;width:150px">Bruto</th>
							<th style="border:1px solid #000;padding:3px;width:150px">Disc</th>
							<th style="border:1px solid #000;padding:3px;width:150px">Netto</th>

							</tr>
							</thead>
							<tbody>
						<?php
					$tqt=0;	
					$totalharga=0;
					$totdisc=0;
					$tthargax=0;
						foreach ($data as $k=>$v){
						?>
							<tr>
						<?php if($pt['typei'] == 'RB'){	?>
						<td><?php echo (isset($data[$k]->tnospo) ? $data[$k]->tnospo : $data[$k] -> tnofaktur . (isset($data[$k] -> dtype) && isset($data[$k] -> ddrid) ? ' / '.($data[$k] -> dtype == 1 ? 'R01' : 'R02').str_pad($data[$k] -> ddrid, 4, "0", STR_PAD_LEFT) : '')); ?></td>
						<?php }else if (isset($data[$k] -> rtype)){?>
							<td><?php echo isset($data[$k] -> tnofaktur) ? $data[$k] -> tnofaktur . ($data[$k] -> rtype == 1 ? ' / Branch' : ' / Publisher'): ''; ?></td>
						<?php }else{?>
								<td><?php echo isset($data[$k] -> tnofaktur) ? $data[$k] -> tnofaktur . (isset($data[$k] -> dtype) && isset($data[$k] -> ddrid) ? ' / ' . ($data[$k] -> dtype == 1 ? 'R01' : 'R02').str_pad($data[$k] -> ddrid, 4, "0", STR_PAD_LEFT) : '') : $data[$k]->tnospo . (isset($data[$k] -> dtype) && isset($data[$k] -> ddrid) ? ' / '.($data[$k] -> dtype == 1 ? 'R01' : 'R02').str_pad($data[$k] -> ddrid, 4, "0", STR_PAD_LEFT) : ''); ?></td>
						<?php } ?>	
							<td><?php echo date('d-m-Y',strtotime($data[$k]->ttanggal)); ?></td>
							<td><?php echo $data[$k]->pname; ?></td>
						<?php if($pt['typei']!='RB'){	?>
							<td><?php echo (isset($data[$k]->ccode) ? $data[$k]->ccode : ''); ?></td>
							<td><?php echo (isset($data[$k]->cname) ? $data[$k]->cname : ''); ?></td>
							<td><?php echo (isset($data[$k]->narea) ? $data[$k]->narea : ''); ?></td>
						<?php }?>
							<td><?php echo $data[$k]->bcode; ?></td>
							<td><?php echo $data[$k]->btitle; ?></td>
							<td><?php echo $data[$k]->ket; ?></td>
							<td><?php echo __get_rupiah($data[$k]->bprice,1); ?></td>
							<td><?php echo $data[$k]->tqty; ?></td>	
							<td><?php echo __get_rupiah(!$data[$k]->ttharga && $data[$k]->tqty > 0 ? $data[$k]->bprice * $data[$k]->tqty :$data[$k]->ttharga,1); ?></td>	
							<td><?php echo $data[$k]->tdisc; ?> %</td>
							<td><?php echo __get_rupiah(!$data[$k]->ttotal && $data[$k]->tqty > 0 ? ($data[$k]->bprice * $data[$k]->tqty) - ((($data[$k]->bprice * $data[$k]->tdisc) / 100) * $data[$k]->tqty) : $data[$k]->ttotal,1); ?></td>	

							</tr>
							</tbody>
						<?php 	
						    $tqt += $data[$k]->tqty;
							$tthargax += (!$data[$k]->ttharga && $data[$k]->tqty > 0 ? $data[$k]->bprice * $data[$k]->tqty :$data[$k]->ttharga);
							$totalharga += (!$data[$k]->ttotal && $data[$k]->tqty > 0 ? ($data[$k]->bprice * $data[$k]->tqty) - ((($data[$k]->bprice * $data[$k]->tdisc) / 100) * $data[$k]->tqty) : $data[$k]->ttotal);
						}	
						$totdisc=$tthargax-$totalharga;
						?>	
							
							<tfoot>
								<tr>
							<td style="font-weight:bold;">TOTAL</td>
							<td></td>						
							<td></td>
			<?php if($pt['typei']!='RB'){ ?>	
							<td></td>
							<td></td>			
							<td></td>
			<?php } ?>		
							<td></td>						
							<td></td>						
							<td></td>	
							<td style="font-weight:bold;width:150px"><?php echo __get_rupiah($tthargax,1); ?></td>	
							<td style="font-weight:bold;width:50px"><?php echo number_format($tqt,0,'','.'); ?></td>	
							<td style="font-weight:bold;width:150px"><?php echo __get_rupiah($totdisc); ?> </td>
							<td></td>	
							<td style="font-weight:bold;width:150px"><?php echo __get_rupiah($totalharga,1); ?></td>
							</tr>						
							</tfoot>
							</table>
							
							<?php } else if ($pt['rtype'] == 1) { ?>
                            <table border="0" style="border-collapse: collapse;">
							<thead>
							<tr>
							<th style="border:1px solid #000;padding:3px;">Kode</th>
							<th style="border:1px solid #000;padding:3px;">Nama</th>
							<th style="border:1px solid #000;padding:3px;">Bruto</th>
							<th style="border:1px solid #000;padding:3px;">Discount</th>
							<th style="border:1px solid #000;padding:3px;">Netto</th>
							<th style="border:1px solid #000;padding:3px;">Qty</th>
							</tr>
							</thead>
							<tbody>
						<?php
						$totalqty = 0;
						$totaldisc = 0;
						$totalbruto = 0;
						$totalnetto = 0;
						foreach ($data as $k => $v) :
						?>
							<tr>
							<td><?php echo $v -> acode.__get_publisher_imprint($v -> pid,1); ?></td>
							<td><?php echo $v -> aname; ?></td>
							<td><?php echo (isset($v -> bno) && $v -> bno == 1 ? __get_rupiah($v -> bprice * $v -> totalqty,1) : __get_rupiah($v -> bruto ? $v -> bruto : 0,1)); ?></td>
								<td><?php echo (isset($v -> bno) && $v -> bno == 1 ? __get_rupiah((($v -> bprice * $v -> tdisc) / 100) * $v -> totalqty,1) : __get_rupiah($v -> bruto - $v -> netto,1)); ?></td>
								<td><?php echo (isset($v -> bno) && $v -> bno == 1 ? __get_rupiah(($v -> bprice - (($v -> bprice * $v -> tdisc) / 100)) * $v -> totalqty,1) : __get_rupiah($v -> netto ? $v -> netto : 0,1)); ?></td>
							<td><?php echo $v -> totalqty; ?></td>
							</tr>
						<?php
						$totalbruto += (isset($v -> bno) && $v -> bno == 1 ? $v -> bprice * $v -> totalqty : $v -> bruto ? $v -> bruto : 0);
						$totalnetto += (isset($v -> bno) && $v -> bno == 1 ? ($v -> bprice - (($v -> bprice * $v -> tdisc) / 100)) * $v -> totalqty : ($v -> netto ? $v -> netto : 0));
						$totalqty += $v -> totalqty;
						$totaldisc += (isset($v -> bno) && $v -> bno == 1 ? (($v -> bprice * $v -> tdisc) / 100) * $v -> totalqty : $v -> bruto - $v -> netto);
						endforeach;
						?>
						</tbody>
							<tfoot>
								<tr>
								<td>Total</td>
								<td></td>
								<td><?php echo __get_rupiah($totalbruto,1); ?></td>
								<td><?php echo __get_rupiah($totaldisc,1); ?></td>
								<td><?php echo __get_rupiah($totalnetto,1); ?></td>
								<td><?php echo number_format($totalqty,0,'','.'); ?></td>
								</tr>
							</tfoot>
							</table>
							<?php } else if ($pt['rtype'] == 2) { ?>
                            <table border="0" style="border-collapse: collapse;">
							<thead>
							<tr>
							<th style="border:1px solid #000;padding:3px;">Kode Buku</th>
							<th style="border:1px solid #000;padding:3px;">Judul</th>
							<th style="border:1px solid #000;padding:3px;">Harga Satuan</th>
							<th style="border:1px solid #000;padding:3px;">Bruto</th>
							<th style="border:1px solid #000;padding:3px;">Discount</th>
							<th style="border:1px solid #000;padding:3px;">Netto</th>
							<th style="border:1px solid #000;padding:3px;">Qty</th>
							</tr>
							</thead>
							<tbody>
						<?php
						$tharga = 0;
						$tbruto = 0;
						$tnetto = 0;
						$tdisc = 0;
						$tqty = 0;
						foreach ($data as $k => $v) :
						?>
							<tr>
							<td><?php echo $v -> bcode; ?></td>
							<td><?php echo $v -> btitle; ?></td>
							<td><?php echo __get_rupiah(($v -> tharga ? $v -> tharga : $v -> bprice),1); ?></td>
							<td><?php echo (isset($v -> bno) && $v -> bno == 1 ? __get_rupiah($v -> bprice * $v -> totalqty,1) : __get_rupiah($v -> bruto ? $v -> bruto : 0,1)); ?></td>
								<td><?php echo (isset($v -> bno) && $v -> bno == 1 ? __get_rupiah((($v -> bprice * $v -> tdisc) / 100) * $v -> totalqty,1) : __get_rupiah($v -> bruto - $v -> netto,1)); ?></td>
								<td><?php echo (isset($v -> bno) && $v -> bno == 1 ? __get_rupiah(($v -> bprice - (($v -> bprice * $v -> tdisc) / 100)) * $v -> totalqty,1) : __get_rupiah($v -> netto ? $v -> netto : 0,1)); ?></td>
							<td><?php echo $v -> totalqty; ?></td>
							</tr>
						<?php
						$tharga += ($v -> tharga ? $v -> tharga : $v -> bprice);
						$tbruto += (isset($v -> bno) && $v -> bno == 1 ? $v -> bprice * $v -> totalqty : ($v -> bruto ? $v -> bruto : 0));
						$tnetto += (isset($v -> bno) && $v -> bno == 1 ? ($v -> bprice - (($v -> bprice * $v -> tdisc) / 100)) * $v -> totalqty : ($v -> netto ? $v -> netto : 0));
						$tqty += $v -> totalqty;
						$tdisc += (isset($v -> bno) && $v -> bno == 1 ? (($v -> bprice * $v -> tdisc) / 100) * $v -> totalqty : $v -> bruto - $v -> netto);
						endforeach;
						?>
							</tbody>
							<tfoot>
								<tr>
								<td>Total</td>
								<td></td>
								<td><?php echo __get_rupiah($tharga,1); ?></td>
								<td><?php echo __get_rupiah($tbruto,1); ?></td>
								<td><?php echo __get_rupiah($tdisc,1); ?></td>
								<td><?php echo __get_rupiah($tnetto,1); ?></td>
								<td><?php echo number_format($tqty,0,'','.'); ?></td>
								</tr>
							</tfoot>
							</table>
							<?php } else if ($pt['rtype'] == 3) { ?>
                            <table border="0" style="border-collapse: collapse;">
								<thead>
							<tr>
							<th style="border:1px solid #000;padding:3px;">No.</th>
							<th style="border:1px solid #000;padding:3px;">No Faktur</th>
							<th style="border:1px solid #000;padding:3px;">Tanggal Faktur</th>
							<th style="border:1px solid #000;padding:3px;">Kode Customer</th>
							<th style="border:1px solid #000;padding:3px;">Nama Customer</th>
							<th style="border:1px solid #000;padding:3px;width:150px">Bruto</th>
							<th style="border:1px solid #000;padding:3px;width:150px">Disc</th>
							<th style="border:1px solid #000;padding:3px;width:150px">Netto</th>
							<th style="border:1px solid #000;padding:3px;width:50px">Qty</th>
							</tr>
							</thead>
							<tbody>
								<?php
								$tbruto = 0;
								$tdisc = 0;
								$tnetto = 0;
								$tqty = 0;
								$i=1;
								foreach($data as $k => $v) :
								?>
								<tr>
								<td><?php echo $i; ?>.</td>
								<?php if (isset($data[$k] -> rtype)){?>
								<td><?php echo isset($data[$k] -> tnofaktur) ? $data[$k] -> tnofaktur . ($data[$k] -> rtype == 1 ? ' / Branch' : ' / Publisher'): ''; ?></td>
								<?php } else { ?>
								<td><?php echo $v -> tnofaktur . (isset($v -> dtype) && isset($v -> ddrid) ? ' / '.($v -> dtype == 1 ? 'R01' : 'R02').str_pad($v -> ddrid, 4, "0", STR_PAD_LEFT) : ''); ?></td>
								<?php } ?>
								<td><?php echo date('d-m-Y',strtotime($v->ttanggal)); ?></td>
								<td><?php echo (isset($v -> ccode) ? $v -> ccode : ''); ?></td>
								<td><?php echo (isset($v->cname) ? $v->cname : ''); ?></td>
								<td><?php echo (isset($v -> bno) && $v -> bno == 1 ? __get_rupiah($v -> bprice * $v -> totalqty,1) : __get_rupiah($v -> bruto ? $v -> bruto : 0,1)); ?></td>
								<td><?php echo (isset($v -> bno) && $v -> bno == 1 ? __get_rupiah((($v -> bprice * $v -> tdisc) / 100) * $v -> totalqty,1) : __get_rupiah($v -> bruto - $v -> netto,1)); ?></td>
								<td><?php echo (isset($v -> bno) && $v -> bno == 1 ? __get_rupiah(($v -> bprice - (($v -> bprice * $v -> tdisc) / 100)) * $v -> totalqty,1) : __get_rupiah($v -> netto ? $v -> netto : 0,1)); ?></td>
								<td><?php echo ($v -> totalqty ? $v -> totalqty : 0); ?></td>
								</tr>
								<?php
								$tbruto += (isset($v -> bno) && $v -> bno == 1 ? $v -> bprice * $v -> totalqty : $v -> bruto ? $v -> bruto : 0);
								$tnetto += (isset($v -> bno) && $v -> bno == 1 ? ($v -> bprice - (($v -> bprice * $v -> tdisc) / 100)) * $v -> totalqty : ($v -> netto ? $v -> netto : 0));
								$tqty += $v -> totalqty;
								$tdisc += (isset($v -> bno) && $v -> bno == 1 ? (($v -> bprice * $v -> tdisc) / 100) * $v -> totalqty : $v -> bruto - $v -> netto);
								++$i;
								endforeach;
								?>
							</tbody>
							<tfoot>
								<tr>
								<td>Total</td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td><?php echo __get_rupiah($tbruto,1); ?></td>
								<td><?php echo __get_rupiah($tdisc,1); ?></td>
								<td><?php echo __get_rupiah($tnetto,1); ?></td>
								<td><?php echo number_format($tqty,0,'','.'); ?></td>
								</tr>
							</tfoot>
							</table>
								<?php } ?>
</body>
</html>

