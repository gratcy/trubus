
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Report Asset
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo site_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Report Asset</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
							<div class="box">
                                <div class="box-body table-responsive">
                                <div class="box-header">
                                    <h3 class="box-title">Asset Gudang</h3>
                                </div><!-- /.box-header -->
                                    <table class="table table-bordered">
                                    <thead>
                                        <tr>
          <th>Total QTY</th>
          <th>Bruto</th>
                                        </tr>
                                    </thead>
                                    <tbody>
										<tr>
										<td><?php echo $reportstock['total'];?></td>
										<td><?php echo __get_rupiah($reportstock['bruto']);?></td>
										</tr>
                                    </tbody>
                                    </table>
                                    <p>&nbsp;</p>
                                <div class="box-header">
                                    <h3 class="box-title">Asset Gudang Customer</h3>
                                </div><!-- /.box-header -->
                                    <table class="table table-bordered">
                                    <thead>
                                        <tr>
          <th>Total QTY</th>
          <th>Bruto</th>
                                        </tr>
                                    </thead>
                                    <tbody>
										<tr>
										<td><?php echo $reportstockcustomer['total'];?></td>
										<td><?php echo __get_rupiah($reportstockcustomer['bruto']);?></td>
										</tr>
                                    </tbody>
                                    </table>
                                </div><!-- /.box-body -->
                            </div>
                        </div>
                    </div>

                </section><!-- /.content -->
            </aside><!-- /.right-side -->
