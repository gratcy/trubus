            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Arsip Update
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo site_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="<?php echo site_url('arsip'); ?>">Arsip</a></li>
                        <li class="active">Arsip Update</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
	<?php echo __get_error_msg(); ?>
<div class="box box-primary">
                                <!-- form start -->
                                 <form role="form" action="<?php echo site_url('arsip/arsip_update'); ?>" method="post" enctype="multipart/form-data">
<input type="hidden" name="id" value="<?php echo $id; ?>">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label>Title</label>
                        <input type="text" placeholder="Title Arsip" name="title" class="form-control" value="<?php echo $detail[0] -> atitle; ?>" />
                                        </div>
                                        <div class="form-group">
                                            <label>Category</label>
										<select name="cat" class="form-control"><?php echo $category; ?></select>
                                        </div>
                                        <div class="form-group">
                                            <label>Description</label>
											<textarea name="desc" class="form-control" placeholder="Description"><?php echo $detail[0] -> adesc; ?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>File</label>
                        <input type="file" placeholder="File" name="file" class="form-control" />
                        <a href="<?php echo __get_path_upload('arsip',2,$detail[0] -> acid.'/'.$detail[0] -> afile); ?>" target="_blank">Download</a>
<input type="hidden" name="sfile" value="<?php echo $detail[0] -> afile; ?>">
<input type="hidden" name="scat" value="<?php echo $detail[0] -> acid; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Status</label>
                                            <?php echo __get_status($detail[0] -> astatus,2); ?>
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
