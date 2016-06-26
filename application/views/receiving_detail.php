            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Receiving Detail
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo site_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="<?php echo site_url('receiving'); ?>">receiving</a></li>
                        <li class="active">Receiving Detail</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
<div class="box box-primary">
                                <!-- form start -->
         <div class="box-body">
                    <h2>
                        <?php echo __get_receiving_name($detail[0] -> riid, $detail[0] -> rtype);?>
                    </h2>
		<table class="table table-bordered">
		<thead>
		<tr><td>Doc No.</td><td><?php echo $detail[0] -> rdocno;?></td></tr>
		<tr><td>Type</td><td><?php echo __get_receiving_type($detail[0] -> rtype,1);?></td></tr>
		<tr><td>Request No. / Publisher</td><td><?php echo __get_receiving_name($detail[0] -> riid, $detail[0] -> rtype);?></td></tr>
		<tr><td>Date</td><td><?php echo __get_date($detail[0] -> rdate,2);?></td></tr>
		<tr><td>Description</td><td><?php echo $detail[0] -> rdesc;?></td></tr>
		<tr><td>Status</td><td>Approved</td></tr>
		</thead>
		</tbody>
		</table>
                                    </div><!-- /.box-body -->
         <div class="box-body">
                    <h2>
                        Books
                    </h2>
		<table class="table table-bordered">
		<thead>
		<tr><th>Publisher</th><th>Code</th><th>Title</th><th>ISBN</th><th>Price</th><th>QTY</th></tr>
		</thead>
		<tbody>
		<?php
		$tqty = 0;
		foreach($books as $k => $v) :
		?>
			<tr>
			<td><?php echo $v -> pname; ?></td>
			<td><?php echo $v -> bcode; ?></td>
			<td><?php echo $v -> btitle; ?></td>
			<td><?php echo $v -> bisbn; ?></td>
			<td><?php echo __get_rupiah($v -> bprice); ?></td>
			<td><?php echo $v -> rqty; ?></td>
			</tr>
		<?php
		$tqty += $v -> dqty;
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
		<td><?php echo $tqty; ?></td>
		</tr>
		</tfoot>
		</table>
                                    </div><!-- /.box-body -->
                                    <div class="box-footer">
                <a href="<?php echo site_url('receiving/receiving_add'); ?>" class="btn btn-default"><i class="fa fa-plus"></i> Add Receiving</a></h3>
										<button class="btn btn-default" type="button" onclick="print_data('<?php echo site_url('printpage/receiving/' . $detail[0] -> rid); ?>');"><i class="fa fa-print"></i> Print</button>
										<button class="btn btn-default" type="button" onclick="location.href='javascript:history.go(-1);'">Back</button>
                                    </div>
                            </div>
                        </div>
                    </div>
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
