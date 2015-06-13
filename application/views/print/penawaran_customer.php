<html>
<head>
<title>Print Penawaran</title>
		<link rel="stylesheet" href="<?php echo site_url('application/views/assets/chosen/chosen.min.css'); ?>">
        <script src="<?php echo site_url('application/views/assets/js/jquery.min.js'); ?>"></script>
</head>
<body style="font-size:18px;">
<h1>Cetak Penawaran Buku</h1>
<div style="width:850px;padding:5px 5px 5px 10px;">
	<form action="<?php echo current_url(); ?>" method="post">
	<table border="0">
	<tr><td>Pilih Customer</td><td>: <select name="cust"><?php echo $customer; ?></select></td></tr>
	<tr><td>Diskon</td><td>: <input type="checkbox" name="usedefault" value="1" checked> Use Default <input type="text" name="disc" readonly></td></tr>
	<tr><td></td><td>&nbsp;&nbsp;<input type="submit" name="submit" value="Save"></td></tr>
	</table>
	</form>
</div>
		<script src="<?php echo site_url('application/views/assets/chosen/chosen.jquery.min.js'); ?>" type="text/javascript"></script>
		<script>
			$('input[name="usedefault"]').click (function(){
				if ($(this).prop('checked')) {
					$('input[name="disc"]').attr('readonly','true');
				}
				else {
					$('input[name="disc"]').removeAttr('readonly','');
				}
			});
			$('select[name="cust"]').chosen({no_results_text: "Oops, nothing found!"}); 
		</script>
</body>
</html>
