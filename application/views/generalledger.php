
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        General Ledger
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo site_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">General Ledger</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
	<?php echo __get_error_msg(); ?>
							<div class="box">
                                <div class="box-body">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
          <th>Month</th>
          <th>Date</th>
          <th>Account</th>
          <th>Reff</th>
          <th style="width:200px;">Debet</th>
          <th style="width:200px;">Credit</th>
                                        </tr>
                                    </thead>
                                    <tbody>
										<?php
										$tb = 0;
										$tc = 0;
										$thn = '';
										$bln = '';
										foreach($generalledger as $k => $v) :
										?>
										<tr>
										<td>
										<?php
										$date = __get_month(date('m',$v -> gdate));
if($bln <> $date){
	$bln = $date;
	echo $bln;
}
										?>
										</td>
										<td><?php echo __get_date($v -> gdate,1); ?></td>
										<td><?php echo $v -> cname; ?></td>
										<td><?php echo $v -> gdocref; ?></td>
										<td style="text-align:right;"><?php echo ($v -> gdebet ? __get_rupiah($v -> gdebet,1) : '-'); ?></td>
										<td style="text-align:right;"><?php echo ($v -> gcredit ? __get_rupiah($v -> gcredit,1) : '-'); ?></td>
										</tr>
										<?php
										$tb += $v -> gdebet;
										$tc += $v -> gcredit;
										endforeach;
										?>
										</tbody>
										<tfoot>
										<tr>
										<td></td>
										<td></td>
										<td><b>Total:</b></td>
										<td style="text-align:right;"><b><?php echo __get_rupiah($tb,1); ?></b></td>
										<td style="text-align:right;"><b><?php echo __get_rupiah($tc,1); ?></b></td>
										<td></td>
										</tr>
										</tfoot>
										</table>
                                </div><!-- /.box-body -->
                            </div>
                        </div>
                    </div>

                </section><!-- /.content -->
            </aside><!-- /.right-side -->
