            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Request Detail
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo site_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="<?php echo site_url('request'); ?>">Request</a></li>
                        <li class="active">Request Detail</li>
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
		<tr><td>Request No.</td><td><?php echo ($detail[0] -> dtype == 1 ? 'R01' : 'R02').str_pad($id, 4, "0", STR_PAD_LEFT); ?></td></tr>
		<tr><td>Request Type</td><td><?php echo __get_request_type($detail[0] -> dtype,1);?></td></tr>
		<tr><td>Date</td><td><?php echo __get_date($detail[0] -> ddate,2);?></td></tr>
		<tr><td>Branch From</td><td><?php echo $detail[0] -> fbname;?></td></tr>
		<tr><td>Branch To</td><td><?php echo $detail[0] -> tbname;?></td></tr>
		<tr><td>Title</td><td><?php echo $detail[0] -> dtitle;?></td></tr>
		<tr><td>Description</td><td><?php echo $detail[0] -> ddesc;?></td></tr>
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
			<tr idnya="<?php echo $v -> dbid; ?>">
			<td><?php echo $v -> pname; ?></td>
			<td><?php echo $v -> bcode; ?></td>
			<td><?php echo $v -> btitle; ?></td>
			<td><?php echo $v -> bisbn; ?></td>
			<td><?php echo __get_rupiah($v -> bprice); ?></td>
			<td><?php echo $v -> dqty; ?></td>
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
                <a href="<?php echo site_url('request/request_add'); ?>" class="btn btn-default"><i class="fa fa-plus"></i> Add Request</a></h3>
										<button class="btn btn-default" type="button" onclick="print_data('<?php echo site_url('printpage/dist_request/' . $id); ?>');"><i class="fa fa-print"></i> Print</button>
										<button class="btn btn-default" type="button" onclick="location.href='javascript:history.go(-1);'">Back</button>
                                    </div>
                            </div>
                        </div>
                    </div>
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
