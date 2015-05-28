
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Closing Period
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo site_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Closing Period</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
	<?php echo __get_error_msg(); ?>
							<div class="box">
                                <div class="box-body">
									            <form class="form-horizontal" action="<?php echo site_url('closingperiod'); ?>" method="post">
	<input type="hidden" name="periodid" value="<?php echo $pactive[0] -> aid; ?>">
                <div class="form-group">
							<label for="status" class="control-label col-lg-2"></label>
                    <div class="col-lg-8" style="text-align: center;">
	<h1>Closing Period | <?php echo $pactive[0] -> aname; ?></h1>	
	</div>
	</div>
                <div class="form-group">
							<label for="status" class="control-label col-lg-2"></label>
                    <div class="col-lg-8" style="text-align: center;">
				<button class="btn text-muted text-center btn-danger" type="submit">Closing Period</button>
				<button class="btn text-muted text-center btn-primary" type="button" onclick="location.href='javascript:history.go(-1);'">Back</button>
					</div>
				</div>
				<?php if (isset($history)) : ?>
				<p>&nbsp;</p>
                            <div class="table-responsive">
	<h3>History Closing Period</h3>	
<table class="table table-striped table-bordered table-hover">
<thead>
<tr>
<th>Name</th>
<th>Start</th>
<th>End</th>
</tr>
</thead>
<tbody>
	<?php foreach($history as $k => $v) : ?>
<tr>
	<td><?php echo $v['aname']; ?></td>
	<td><?php echo __get_date($v['astart'],2); ?></td>
	<td><?php echo __get_date($v['aend'],2); ?></td>
</tr>
<?php endforeach;?>
</tbody>
</table>
          </div>
				<p>&nbsp;</p>
				<?php endif; ?>
				<p><b><i>Note: Jika anda menekan tombol "Closing Period", itu berarti anda sudah melakukan tutup buku (Akunting). dan transaksi dapat dilakukan keesokan harinya.</i></b></p>
            </form>
                                </div><!-- /.box-body -->
                            </div>
                        </div>
                    </div>

                </section><!-- /.content -->
            </aside><!-- /.right-side -->

<script type="text/javascript">
$(function(){
	$('input[name="keyword"]').sSuggestion('span#sg1','<?php echo site_url('arsip/get_suggestion'); ?>', 'id');
});
</script>
