<!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Private Messages
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo site_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="<?php echo site_url('pm'); ?>">Private Messages</a></li>
                        <li class="active">Private Messages</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
	<?php echo __get_error_msg(); ?>
<div class="box box-primary">
                                <!-- form start -->
                                    <div class="box-body">
                <div class="form-group">
                    <label>From &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;: <?php echo $detail[0] -> ufrom; ?></label>
                </div>
                <div class="form-group">
                    <label>To &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;: <?php echo $detail[0] -> uto; ?></label>
                </div>
                <div class="form-group">
                    <label>Subject &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;: <?php echo $detail[0] -> psubject; ?></label>
                </div>
                <div class="form-group">
                    <label>Message &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;: <?php echo $detail[0] -> pmsg; ?></label>
                </div>
                </div>

                                    <div class="box-footer">
				<?php if (!preg_match('/outbox/i', $_SERVER['HTTP_REFERER'])) : ?>
				 <button type="button" class="btn btn-primary" onclick="location.href='<?php echo site_url('pm/pm_reply/' . $id); ?>'"> <i class="fa fa-save"></i> Reply</button>
				<?php endif; ?>
                                       
										<button class="btn btn-default" type="button" onclick="location.href='javascript:history.go(-1);'">Back</button>
                                    </div>
                            </div>
                        </div>
                    </div>

                </section><!-- /.content -->
            </aside><!-- /.right-side -->
