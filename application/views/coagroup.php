
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Coa Group
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo site_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Coa Group</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
	<?php echo __get_error_msg(); ?>
							<div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">
                <a href="<?php echo site_url('coagroup/coagroup_add'); ?>" class="btn btn-default"><i class="fa fa-plus"></i> Add Coa Group</a></h3>
                                </div><!-- /.box-header -->
                                <div class="box-body">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
          <th>Class</th>
          <th>Name</th>
          <th>Description</th>
          <th>Status</th>
          <th style="width: 50px;"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
<?php foreach($coagroup as $k => $v) : ?>
<tr>
<td><?php echo __get_coa_class($v -> cclass,1); ?></td>
<td><?php echo $v -> cname; ?></td>
<td><?php echo $v -> cdesc; ?></td>
<td><?php echo __get_status($v -> cstatus,1); ?></td>
<td>
              <a href="<?php echo site_url('coagroup/coagroup_update/' . $v -> cid); ?>"><i class="fa fa-pencil"></i></a>
              <a href="<?php echo site_url('coagroup/coagroup_delete/' . $v -> cid); ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-times"></i></a>
              </td>
</tr>
<?php endforeach; ?>
                                    </tbody>
                                    </table>
                                </div><!-- /.box-body -->
                            </div>
                        </div>
                    </div>

                </section><!-- /.content -->
            </aside><!-- /.right-side -->
