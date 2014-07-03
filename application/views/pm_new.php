<style type="text/css">
#txtHint {width:98%!important;left:10px!important;}
</style>
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Private Messages New
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo site_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="<?php echo site_url('pm'); ?>">Private Messages</a></li>
                        <li class="active">Private Messages New</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
	<?php echo __get_error_msg(); ?>
<div class="box box-primary">
                                <!-- form start -->
                                 <form role="form" action="<?php echo site_url('pm/pm_new'); ?>" method="post">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label>To</label>
                        <input type="text" placeholder="To" name="to" class="form-control" autocomplete="off" />
                        <span id="sg1"></span>
                        <input type="hidden" name="pto" />
                                        </div>
                                        <div class="form-group">
                                            <label>Subject</label>
                        <input type="text" placeholder="Subject" name="subject" class="form-control" />
                                        </div>
                                        <div class="form-group">
                                            <label>Message</label>
                        <textarea name="msg" class="form-control" placeholder="Message"></textarea>
                                        </div>
                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
                                        <button type="submit" class="btn btn-primary"> <i class="fa fa-save"></i> Send</button>
										<button class="btn btn-default" type="button" onclick="location.href='javascript:history.go(-1);'">Back</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </section><!-- /.content -->
            </aside><!-- /.right-side -->

<script type="text/javascript">
$(function(){
	$('input[name="to"]').sSuggestion('span#sg1','<?php echo site_url('pm/get_suggestion'); ?>', 'pto');
});
</script>
