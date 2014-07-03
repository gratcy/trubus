
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Books Add
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo site_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="<?php echo site_url('books'); ?>">Books</a></li>
                        <li class="active">Books Add</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
	<?php echo __get_error_msg(); ?>
<div class="box box-primary">
                                <!-- form start -->
                                 <form role="form" action="<?php echo site_url('books/books_add'); ?>" method="post">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label>Code</label>
                        <input type="text" placeholder="Book Code" name="code" class="form-control" />
                                        </div>
                                        <div class="form-group">
                                            <label>Title</label>
                        <input type="text" placeholder="Book Title" name="title" class="form-control" />
                                        </div>
                                        <div class="form-group">
                                            <label>Group</label>
                                            <select class="form-control" name="group">
												<?php echo $groups; ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Publisher</label>
                                            <select class="form-control" name="publisher">
												<?php echo $publisher; ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Tax</label>
                                            	<?php echo __get_tax(0,2); ?>
                                            
                                        </div>
                                        <div class="form-group">
                                            <label>Price</label>
                        <input type="text" style="text-align:right;" value="0" name="price" class="form-control" />
                                        </div>
                                        <div class="form-group">
                                            <label>Pack</label>
                                            <select class="form-control" name="pack">
												<?php echo __get_packs(0,2); ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Discount</label>
                        <input type="text" style="text-align:right;" value="0" onkeyup="formatharga(this.value,this)" placeholder="Discount" name="disc" class="form-control" />
                                        </div>
                                        <div class="form-group">
                                            <label>Code ISBN</label>
                        <input type="text" placeholder="Code ISBN" name="isbn" class="form-control" />
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
