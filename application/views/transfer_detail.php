            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Transfer Detail
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo site_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="<?php echo site_url('transfer'); ?>">Transfer</a></li>
                        <li class="active">Transfer Detail</li>
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
                        <?php echo $detail[0] -> dtitle;?>
                    </h2>
		<table class="table table-bordered">
		<thead>
		<tr><td>Doc No.</td><td><?php echo $detail[0] -> ddocno;?></td></tr>
		<tr><td>Request No.</td><td><?php echo ($detail[0] -> dtype == 1 ? 'R01' : 'R02').str_pad($detail[0] -> ddrid, 4, "0", STR_PAD_LEFT); ?></td></tr>
		<tr><td>Request Type</td><td><?php echo __get_request_type($detail[0] -> dtype,1);?></td></tr>
		<tr><td>Date</td><td><?php echo __get_date($detail[0] -> ddate,2);?></td></tr>
		<tr><td>Branch From</td><td><?php echo $detail[0] -> fbname;?></td></tr>
		<tr><td>Branch To</td><td><?php echo $detail[0] -> tbname;?></td></tr>
		<tr><td>Title</td><td><?php echo $detail[0] -> dtitle;?></td></tr>
		<tr><td>Description</td><td><?php echo $detail[0] -> ddesc;?></td></tr>
		<tr><td>Status</td><td><?php echo ($detail[0] -> dstatus == 3 ? 'Aproved' : 'Final Approved');?></td></tr>
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
		<?php foreach($books as $k => $v) : ?>
			<tr idnya="<?php echo $v -> dbid; ?>">
			<td><?php echo $v -> pname; ?></td>
			<td><?php echo $v -> bcode; ?></td>
			<td><?php echo $v -> btitle; ?></td>
			<td><?php echo $v -> bisbn; ?></td>
			<td><?php echo __get_rupiah($v -> bprice); ?></td>
			<td><?php echo $v -> dqty; ?></td>
			</tr>
		<?php endforeach; ?>
		</tbody>
		</table>
                                    </div><!-- /.box-body -->
                                    <div class="box-footer">
                <a href="<?php echo site_url('transfer/transfer_add'); ?>" class="btn btn-default"><i class="fa fa-plus"></i> Add Transfer</a></h3>
										<button class="btn btn-default" type="button" onclick="print_data('<?php echo site_url('printpage/dist_transfer/' . $id); ?>');"><i class="fa fa-print"></i> Print</button>
										<button class="btn btn-default" type="button" onclick="location.href='javascript:history.go(-1);'">Back</button>
                                    </div>
                            </div>
                        </div>
                    </div>
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
