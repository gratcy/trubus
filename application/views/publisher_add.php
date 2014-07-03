
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Publisher Add
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo site_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="<?php echo site_url('publisher'); ?>">Publisher</a></li>
                        <li class="active">Publisher Add</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
	<?php echo __get_error_msg(); ?>
<div class="box box-primary">
                                <!-- form start -->
                                 <form role="form" action="<?php echo site_url('publisher/publisher_add'); ?>" method="post">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label>Code</label>
                        <input type="text" placeholder="publisher Code" name="code" class="form-control" />
                                        </div>
                                        <div class="form-group">
                                            <label>Category</label>
                        <select name="category" class="form-control">
						<option value=""></option>
						<option value="External">External</option>
						<option value="Internal">Internal</option>
						<option value="Majalah">Majalah</option>
						</select>
                                        </div>										
                                        <div class="form-group">
                                            <label>Name</label>
                        <input type="text" placeholder="publisher Name" name="name" class="form-control" />
                                        </div>
                                        <div class="form-group">
                                            <label>Address</label>
						<textarea name="addr" class="form-control" placeholder="Address"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>City</label>
                        <select name="city" class="form-control"><?php echo __get_cities('',2); ?></select>
                                        </div>
                                        <div class="form-group">
                                            <label>Province</label>
                        <select name="prov" class="form-control"><?php echo __get_province('',2); ?></select>
                                        </div>
                                        <div class="form-group">
                                            <label>Phone I</label>
                        <input type="text" placeholder="Phone I" name="phone1" class="form-control" />
                                        </div>
                                        <div class="form-group">
                                            <label>Phone II</label>
                        <input type="text" placeholder="Phone II" name="phone2" class="form-control" />
                                        </div>
                                        <div class="form-group">
                                            <label>Email</label>
                        <input type="text" placeholder="Email" name="email" class="form-control" />
                                        </div>
                                        <div class="form-group">
                                            <label>NPWP</label>
                        <input type="text" placeholder="NPWP" name="npwp" class="form-control" />
                                        </div>
                                        <div class="form-group">
                                            <label>Credit Limit</label>
                        <input type="text" placeholder="Credit Limit" name="climit" class="form-control" />
                                        </div>
                                        <div class="form-group">
                                            <label>Credit Duration (Days)</label>
                        <input type="text" placeholder="Credit Duration" name="cday" class="form-control" />
                                        </div>
                                        <div class="form-group">
                                            <label>Contact Person</label>
                        <input type="text" placeholder="Contact Person" name="cp" class="form-control" />
                                        </div>
                                        <div class="form-group">
                                            <label>Contact Person Phone</label>
                        <input type="text" placeholder="Contact Person Phone" name="phone3" class="form-control" />
                                        </div>
                                        <div class="form-group">
                                            <label>Description</label>
						<textarea name="desc" class="form-control" placeholder="Description"></textarea>
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
