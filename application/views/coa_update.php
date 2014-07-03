
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Chart of Account Update
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo site_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="<?php echo site_url('coa'); ?>">Chart of Account</a></li>
                        <li class="active">Chart of Account Update</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
	<?php echo __get_error_msg(); ?>
<div class="box box-primary">
                                <!-- form start -->
                                 <form role="form" action="<?php echo site_url('coa/coa_update'); ?>" method="post">
<input type="hidden" name="id" value="<?php echo $id; ?>">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label>Account Type</label>
                        <select name="atype" class="form-control"><?php echo __get_account_type($detail[0] -> catype,2); ?></select>
                                        </div>
                                        <div class="form-group">
                                            <label>Activa/Pasiva</label>
                                            <br />
                        <?php echo __get_acpas($detail[0] -> ctype,2); ?>
                                        </div>
                                        <div class="form-group">
                                            <label>Sub Account</label>
                        <select name="parent" class="form-control"><option value="0"></option><?php echo $scoa; ?></select>
                                        </div>
                                        <div class="form-group">
                                            <label>Code</label>
                        <input type="text" placeholder="Code" name="code" class="form-control" value="<?php echo $detail[0] -> ccode; ?>" />
                                        </div>
                                        <div class="form-group">
                                            <label>Name</label>
                        <input type="text" placeholder="Name" name="name" class="form-control" value="<?php echo $detail[0] -> cname; ?>" />
                                        </div>
                                        <div class="form-group">
                                            <label>Saldo</label>
                        <input type="text" placeholder="Saldo" name="saldo" style="text-align:right;" onkeyup="formatharga(this.value,this)" class="form-control" value="<?php echo __get_rupiah($detail[0] -> csaldo,2); ?>" />
                                        </div>
                                        <div class="form-group">
                                            <label>Description</label>
											<textarea name="desc" class="form-control" placeholder="Description"><?php echo $detail[0] -> cdesc; ?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Status</label>
                                            <br />
                                            <?php echo __get_status($detail[0] -> cstatus,2); ?>
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
