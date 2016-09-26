
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
                                 <form role="form" action="<?php echo site_url('books/books_add'); ?>" method="post" enctype="multipart/form-data">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label>Title</label>
                        <input type="text" placeholder="Book Title" name="title" class="form-control" />
                                        </div>
                                        <div class="form-group">
                                            <label>Publisher</label>
                                            <select class="form-control" name="publisher">
												<?php echo $publisher; ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Category Book</label>
                        <select name="cid" class="form-control"><?php echo $categories; ?></select>
                                        </div>
                                        <div class="form-group">
                                            <label>Author</label>
                        <input type="text" placeholder="Author" name="pengarang" class="form-control" value="" />
                                        </div>
                                        <div class="form-group">
                                            <label>Tax</label>
                                            	<?php echo __get_tax(0,2); ?>
                                            
                                        </div>
                                        <div class="form-group">
                                            <label>Price</label>
                        <input type="text" value="0" autocomplete="off" name="price" class="form-control" onkeyup="formatharga(this.value,this)" />
                                        </div>
                                        <div class="form-group">
                                            <label>Pack</label>
                                            <select class="form-control" name="pack">
												<?php echo __get_packs(0,2); ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Discount</label>
                        <input type="text" style="text-align:right;" value="0" placeholder="Discount" name="disc" class="form-control" />
                                        </div>
                                        <div class="form-group">
                                            <label>Code ISBN</label>
                        <input type="text" placeholder="Code ISBN" name="isbn" class="form-control" />
                                        </div>
                                        <div class="form-group">
                                            <label>Day / Month / Year</label>
                        <input type="text" placeholder="Month / Year" name="my" class="form-control" value="" data-date-format="dd/mm/yyyy" />
                                        </div>
                                        <div class="form-group">
                                            <label>Height x Width of Book</label><br />
                        <input type="text" placeholder="Height of Book" name="height" class="form-control" value="" style="width:200px!important;display:inline!important;" /> x 
                        <input type="text" placeholder="Width of Book" name="width" class="form-control" value="" style="width:200px!important;display:inline!important;" />
                                        </div>
                                        <div class="form-group">
                                            <label>Total Pages</label>
                        <input type="text" placeholder="Total Pages" name="pages" class="form-control" value="" />
                                        </div>
                                        <div class="form-group">
                                            <label>Cover</label>
                        <input type="file" placeholder="File" name="file" class="form-control" />
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

<script type="text/javascript">
$('input[name="my"]').datepicker();

$('select[name="publisher"]').change(function(){
	$.post('<?php echo site_url('publisher/get_description'); ?>', {'pid' : $(this).val()},
	function(data) {
		$('textarea[name="desc"]').val(data);
	});
});
</script>
