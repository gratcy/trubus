<?php $hw = explode('*',$detail[0] -> bhw); ?>
<html>
<head>
<title>Print Penawaran</title>
</head>
<body style="font-size:18px;" onload="window.print();">
<div style="width:850px;padding:5px 5px 5px 10px;">
		<span style="font-size:20px;font-weight:bold;">Niaga Swadaya</span>
		<div style="clear:both;"></div>
		<div style="float:left;">
		<div style="width:500px;">
		<h1><?php echo $cdetail[0] -> cname; ?></h1>
		Merchandising Division Local Books<br />
		<?php echo $cdetail[0] -> caddr. ', ' .$cdetail[0] -> city. ', '.$cdetail[0] -> pname; ?><br />
		Telp. <?php echo str_replace('*',' / ',$cdetail[0] -> cphone); ?><br />
		Email: <?php echo $cdetail[0] -> cemail; ?><br /></div>
		<hr />
		<br>
		Tanggal Penawaran<br>
		<?php echo __get_date(time(),1);?><br>
		<br><br>
		<h1>PENAWARAN ITEM BARU PEMASOK</h1>
		<u>A. Informasi Buku</u>
		<br>
		<table border="0">
		<tr><td>Nama Pemasok</td><td>: PT. Niaga Swadaya</td></tr>
		<tr><td>Kode TU</td><td>: N. 802</td></tr>
		<tr><td>Status Pemasok</td><td>: PKP</td></tr>
		<tr><td>Status Pajak Produk / Buku</td><td>: DTP</td></tr>
		<tr><td>Judul Buku</td><td>: <?php echo $detail[0] -> btitle; ?></td></tr>
		<tr><td>Pengarang</td><td>: <?php echo $detail[0] -> bauthor; ?></td></tr>
		<tr><td>Penerbit</td><td>: <?php echo $detail[0] -> pname; ?></td></tr>
		<tr><td>Harga Jual</td><td>: <?php echo __get_rupiah($detail[0] -> bprice,2); ?></td></tr>
		<tr><td>Diskon</td><td>: <?php echo ($disc === false ? $detail[0] -> bdisc : $disc); ?>%</td></tr>
		<tr><td>ISBN</td><td>: <?php echo $detail[0] -> bisbn; ?></td></tr>
		<tr><td>Kode Buku</td><td>: <?php echo $detail[0] -> bcode; ?></td></tr>
		<tr><td>Bulan / Tahun</td><td>: <?php echo $detail[0] -> bmonthyear; ?></td></tr>
		<tr><td>Group / Kategori</td><td>: <?php echo $detail[0] -> cname; ?></td></tr>
		<tr><td>Sistem Pembayaran</td><td>: KONSINYASI</td></tr>
		<tr><td>Panjang x Lebar Buku</td><td>: <?php echo $hw[0]; ?>cm x <?php echo $hw[1]; ?>cm</td></tr>
		<tr><td>Jumlah Halaman</td><td>: <?php echo $detail[0] -> btotalpages; ?> Halaman</td></tr>
		<tr><td>Oplah Cetak</td><td>: <?php echo (isset($oplah[0] -> istock) ? $oplah[0] -> istock : '-'); ?></td></tr>
		<tr><td>Note / Catatan</td><td>: <?php echo $detail[0] -> bdesc; ?> </td></tr>
		<tr><td>Cover</td><td>: <img src="<?php echo __get_path_upload('cover', 2, $detail[0] -> bcover); ?>" width="150"> </td></tr>
		</table>
		<hr />
		<table border="0" width="800">
		<tr>
		<td style="width:300px;">Pemohon <br><br><br><br>Merchadiser</td>
		<td style="width:300px;">Disetujui<br><br><br><br>Md. Manager</td>
		<td style="width:400px;">Diperiksa dan Diinput Oleh Central DMT<br><br><br><br> Diterima  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp; Diinput</td>
		</tr>
		</table>
		</div>
</body>
</html>
