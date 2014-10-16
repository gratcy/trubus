
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Catalog Update
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo site_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="<?php echo site_url('catalog'); ?>">Catalog</a></li>
                        <li class="active">Catalog Update</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
	<?php echo __get_error_msg(); ?>
<div class="box box-primary">
                                <!-- form start -->
                                 <form role="form" action="<?php echo site_url('catalog/catalog_update'); ?>" method="post" enctype="multipart/form-data">
<input type="hidden" name="id" value="<?php echo $id; ?>">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label>Book</label>
										<select name="book" class="form-control"><?php echo $books; ?></select>
                                        </div>
                                        <div class="form-group">
                                            <label>Description</label>
											<textarea name="desc" class="form-control" placeholder="Description"><?php echo $detail[0] -> cdesc; ?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>File</label>
                        <input type="file" placeholder="File" name="file" class="form-control" />
                        <a href="<?php echo __get_path_upload('catalog', 2, $detail[0] -> cfile); ?>" target="_blank">Cover</a>
                                        </div>
                                        <div class="form-group">
                                            <label>Status</label>
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
