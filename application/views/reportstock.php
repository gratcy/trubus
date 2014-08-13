
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Report Stock
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo site_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Report Stock</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
						<form action="<?php echo site_url('reportstock/sortreport/'); ?>" method="post">
                        <div class="col-xs-6">

                                    <div class="form-group">
                                        <label>Date range:</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="text" class="form-control pull-right" id="datesort" name="datesort" autocomplete="off" />
                                        </div><!-- /.input group -->
                        <button class="btn text-muted text-center btn-danger" type="submit" style="position: relative;
top: -34px;
float: right;">Go!</button>
                                    </div><!-- /.form group -->
						</div>
						</div>
						</form>
						<br />
                    <div class="row">
                        <div class="col-xs-12">
	<?php echo __get_error_msg(); ?>
							<div class="box">
                                <div class="box-body">
                                    <table class="table table-bordered">
                                    <thead>
                                        <tr>
          <th style="width:20%;text-align:center;">Product</th>
          <th style="width:18%;text-align:center;">Price</th>
          <th style="width:18%;text-align:center;">Penerimaan</th>
          <th style="width:18%;text-align:center;">Pengeluaran</th>
          <th style="width:27%;text-align:center;">Adjustment</th>
                                        </tr>
                                        </thead>
                                        </table>
                                    <table class="table table-bordered">
                                        <tr>
          <th style="width:8%;">W/H</th>
          <th style="width:12%;">Title</th>
          <th style="width:9%;">Buy</th>
          <th style="width:9%;">Sell</th>
          <th style="width:9%;">Transfer</th>
          <th style="width:9%;">Retur</th>
          <th style="width:9%;">Jual</th>
          <th style="width:9%;">Transfer</th>
          <th style="width:9%;">Adjust (-)</th>
          <th style="width:9%;">Adjust (+)</th>
          <th style="width:9%;">Final</th>
                                        </tr>
                                    </thead>
                                    <tbody>
										<?php foreach($reportstock as $k => $v) : ?>
										<tr>
										<td><?php echo str_replace('*','/',$v -> bhw);?></td>
										<td><?php echo $v -> btitle;?></td>
										<td style="text-align:right;"><?php echo __get_rupiah($v -> bprice,1);?></td>
										<td style="text-align:right;"><?php echo __get_rupiah($v -> bprice + ($v -> bprice / 10),1);?></td>
										<td style="text-align:right;"><?php echo __get_total_receiving($v -> ibcid, $v -> ibid);?></td>
										<td style="text-align:right;"><?php echo ($v -> istockretur ? $v -> istockretur : 0);?></td>
										<td style="text-align:right;"><?php echo __get_total_selling($v -> ibcid, $v -> ibid);?></td>
										<td style="text-align:right;"><?php echo ($v -> istockout ? $v -> istockout : 0);?></td>
          <td style="text-align:right;"><?php echo __get_total_adjustment(1,0,$v -> ibcid,$v -> ibid); ?></td>
          <td style="text-align:right;"><?php echo __get_total_adjustment(1,1,$v -> ibcid,$v -> ibid); ?></td>
										<td style="text-align:right;"><?php echo ($v -> istock ? $v -> istock : 0);?></td>
										</tr>
										<?php endforeach; ?>
                                    </tbody>
                                    </table>
                                </div><!-- /.box-body -->
                                <div class="box-footer clearfix">
                                    <ul class="pagination pagination-sm no-margin pull-right">
                                        <?php echo $pages; ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
<script type="text/javascript">
$(function(){
	$('#datesort').daterangepicker();
});
</script>
