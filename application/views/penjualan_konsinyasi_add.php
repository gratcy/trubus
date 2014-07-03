
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        penjualan_konsinyasi Add
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo site_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="<?php echo site_url('penjualan_konsinyasi'); ?>">penjualan_konsinyasi</a></li>
                        <li class="active">penjualan_konsinyasi Add</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
	<?php echo __get_error_msg(); ?>
<div class="box box-primary">
                                <!-- form start -->
                                 <form role="form" action="<?php echo site_url('penjualan_konsinyasi/penjualan_konsinyasi_add'); ?>" method="post">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label>No Faktur</label>
                        <input type="text" placeholder="No Faktur" name="tnofaktur" class="form-control" />
                                        </div>
                                        <div class="form-group">
                                            <label>Kode Customer</label>
                        <input type="text" name="tcid" class="form-control" placeholder="Kode Customer">
                                        </div>
                                        <div class="form-group">
                                            <label>Jenis Pajak</label>
											<input type="text" name="ttax" class="form-control" placeholder="Jenis Pajak">
                                        </div>
                                        <div class="form-group">
                                            <label>Tanggal</label>
                        <input type="text" name="ttanggal" class="form-control" placeholder="Tanggal">
						<input type="hidden" name="ttype" value="1" class="form-control" placeholder="Type">
						<input type="hidden" name="ttypetrans" value="3" class="form-control" placeholder="Type Trans">	
						<input type="hidden" name="tstatus" value="1" class="form-control" placeholder="tstatus">						
                                        </div>
                                        					
                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
                                        <button type="submit" class="btn btn-primary"> <i class="fa fa-save"></i> Submit</button>
										<button class="btn btn-default" type="button" onclick="location.href='javascript:history.go(-1);'">Back</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </section><!-- /.content -->
            </aside><!-- /.right-side -->
