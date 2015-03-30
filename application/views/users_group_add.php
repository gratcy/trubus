
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Users Group Add
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo site_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="<?php echo site_url('users/users_group'); ?>">Users Group</a></li>
                        <li class="active">Users Group Add</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
	<?php echo __get_error_msg(); ?>
<div class="box box-primary">
                                <!-- form start -->
                                 <form role="form" action="<?php echo site_url('users/users_group_add'); ?>" method="post">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label>Group Name</label>
                                            <input type="text" name="name" class="form-control" placeholder="Group Name">
                                        </div>
                                        <div class="form-group">
                                            <label>Description</label>
											<textarea name="desc" class="form-control" placeholder="Group Description"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Status</label>
                                            <?php echo __get_status(0,2); ?>
                                        </div>
                                    </div><!-- /.box-body -->
                                <div class="box-body">
                                <div class="box-header">
                                    <label>Group Permission</label>
                                </div><!-- /.box-header -->
                                    <table class="table table-bordered">
      <thead>
		<tr>
		<th>Name</th>
		<th>Access</th>
		</tr>
      </thead>
      <tbody>
        <?php foreach($permission as $k => $v) : ?>
		<tr>
        <td><?php echo ($v -> pparent != 0 ? '-- '.$v -> pdesc.'' : $v -> pdesc); ?></td>
        <td><label>Yes <input type="radio" class="uniform" value="1" name="perm[<?php echo $v -> pid?>]"></label><label> No <input class="uniform" type="radio" value="0" name="perm[<?php echo $v -> pid?>]" checked></label></td>
        </tr>
        <?php endforeach; ?>
      </tbody>
      </table>
                            </div>
<br />
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
