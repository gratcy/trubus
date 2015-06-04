<?php
$phone = explode('*', $detail[0] -> bphone);
?>
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Penjualan Konsinyasi
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo site_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="<?php echo site_url('penjualan_konsinyasi'); ?>">penjualan_konsinyasi</a></li>
                        <li class="active">penjualan_konsinyasi Update</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
	<?php echo __get_error_msg(); ?>
<div class="box box-primary">
                                <!-- form start -->
                                 <form role="form" action="<?php echo site_url('penjualan_konsinyasi/penjualan_konsinyasi_update'); ?>" method="post">
<input type="hidden" name="id" value="<?php echo $id; ?>">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label>Name</label>
                        <input type="text" placeholder="penjualan_konsinyasi Name" name="name" class="form-control" value="<?php echo $detail[0] -> bname; ?>" />
                                        </div>
                                        <div class="form-group">
                                            <label>NPWP</label>
                        <input type="text" placeholder="penjualan_konsinyasi NPWP" name="npwp" class="form-control" value="<?php echo $detail[0] -> bnpwp; ?>" />
                                        </div>
                                        <div class="form-group">
                                            <label>Address</label>
											<textarea name="addr" class="form-control" placeholder="Address"><?php echo $detail[0] -> baddr; ?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>City</label>
                        <select name="city" class="form-control"><?php echo __get_cities($detail[0] -> bcity,2); ?></select>
                                        </div>
                                        <div class="form-group">
                                            <label>Province</label>
                        <select name="prov" class="form-control"><?php echo __get_province($detail[0] -> bprovince,2); ?></select>
                                        </div>
                                        <div class="form-group">
                                            <label>Phone I</label>
                        <input type="text" placeholder="Phone I" name="phone1" class="form-control" value="<?php echo $phone[0]; ?>" />
                                        </div>
                                        <div class="form-group">
                                            <label>Phone II</label>
                        <input type="text" placeholder="Phone II" name="phone2" class="form-control" value="<?php echo $phone[1]; ?>" />
                                        </div>
                                        <div class="form-group">
                                            <label>Status</label>
                                            <?php echo __get_status($detail[0] -> bstatus,2); ?>
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
