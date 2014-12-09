<html>
<head>
<title>Print Penawaran</title>
</head>
<body style="font-size:18px;">
<h1>Cetak Penawaran Buku</h1>
<div style="width:850px;padding:5px 5px 5px 10px;">
	<form action="<?php echo current_url(); ?>" method="post">
	Pilih Customer: <select name="cust"><?php echo $customer; ?></select>
	<input type="submit" name="submit" value="Save">
	</form>
</div>
</body>
</html>
