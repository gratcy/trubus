
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Users Group Update
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo site_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="<?php echo site_url('users/users_group'); ?>">Users Group</a></li>
                        <li class="active">Users Group Update</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
	<?php echo __get_error_msg(); ?>
<div class="box box-primary">
                                <!-- form start -->
                                 <form role="form" action="<?php echo site_url('users/users_group_update'); ?>" method="post">
	<input type="hidden" name="id" value="<?php echo $id; ?>">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label>Group Name</label>
                                            <input type="text" name="name" class="form-control" placeholder="Group Name" value="<?php echo $group[0] -> gname; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Description</label>
											<textarea name="desc" class="form-control" placeholder="Group Description"><?php echo $group[0] -> gdesc; ?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Status</label>
                                            <?php echo __get_status($group[0] -> gstatus,2); ?>
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
        <td><?php echo ($v -> pparent != 0 ? '-- '.$v -> pname.'' : $v -> pname); ?></td>
		<td><label>Yes <?php if ($v -> aaccess == 1) { ?> <input class="uniform" type="radio" value="1" name="perm[<?php echo $v -> pid?>]" checked></label><label> No <input class="uniform" type="radio" value="0" name="perm[<?php echo $v -> pid?>]"></label> <?php } else { ?><label><input class="uniform" type="radio" value="1" name="perm[<?php echo $v -> pid?>]"> No</label><label> <input class="uniform" type="radio" value="0" name="perm[<?php echo $v -> pid?>]" checked><label><?php } ?></td>
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
