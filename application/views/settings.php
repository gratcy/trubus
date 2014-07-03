
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Settings
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo site_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Settings</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
	<?php echo __get_error_msg(); ?>
<div class="box box-primary">
                                <!-- form start -->
                                 <form role="form" action="<?php echo site_url('settings/settings'); ?>" method="post">
	<input type="hidden" name="uid" value="<?php echo $this -> memcachedlib -> sesresult['uid']; ?>">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="text" placeholder="Email" name="uemail" class="form-control" value="<?php echo $this -> memcachedlib -> sesresult['uemail']; ?>" readonly />
                                        </div>
                                        <div class="form-group">
                                            <label>Old Password</label>
                                            <input type="text" name="oldpass" class="form-control" placeholder="Old Password">
                                        </div>
                                        <div class="form-group">
                                            <label>New Password</label>
                                            <input type="text" name="newpass" class="form-control" placeholder="New Password">
                                        </div>
                                        <div class="form-group">
                                            <label>Confirm Password</label>
                                            <input type="text" name="confpass" class="form-control" placeholder="Confirm Password">
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
