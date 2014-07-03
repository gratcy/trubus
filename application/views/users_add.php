
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Users Add
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo site_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="<?php echo site_url('users'); ?>">Users</a></li>
                        <li class="active">Users Add</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
	<?php echo __get_error_msg(); ?>
<div class="box box-primary">
                                <!-- form start -->
                                 <form role="form" action="<?php echo site_url('users/users_add'); ?>" method="post">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="text" name="uemail" class="form-control" placeholder="Email">
                                        </div>
                                        <div class="form-group">
                                            <label>Branch</label>
                                            <select multiple class="form-control" name="branch">
												<?php echo $branch; ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Group</label>
                                            <select class="form-control" name="group">
												<?php echo $groups; ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Password</label>
                                            <input type="text" name="newpass" class="form-control" placeholder="Password">
                                        </div>
                                        <div class="form-group">
                                            <label>Confirm Password</label>
                                            <input type="text" name="confpass" class="form-control" placeholder="Confirm Password">
                                        </div>
                                        <div class="form-group">
                                            <label>Status</label>
                                            <?php echo __get_status(0,2); ?>
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
