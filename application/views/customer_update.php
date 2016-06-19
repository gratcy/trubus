<?php
$phone = explode('*', $detail[0] -> cphone);
?>
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Customer Update
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo site_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="<?php echo site_url('customer'); ?>">Customer</a></li>
                        <li class="active">Customer Update</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
	<?php echo __get_error_msg(); ?>
<div class="box box-primary">
                                <!-- form start -->
                                 <form role="form" action="<?php echo site_url('customer/customer_update'); ?>" method="post">
<input type="hidden" name="id" value="<?php echo $id; ?>">
                                    <div class="box-body">
                                        <div class="form-group" id="pbranch">
                                            <label>Branch</label>
                                            <select multiple class="form-control" name="branch">
												<?php echo $branch; ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Code</label>
                        <input type="text" placeholder="Customer Code" readonly name="code" class="form-control" value="<?php echo $detail[0] -> ccode; ?>" />
                                        </div>
                                        <div class="form-group">
                                            <label>Area</label>
                                            <select class="form-control" name="area">
												<?php echo $area; ?>
                                            </select>
                                            <input type="hidden" name="oarea" value="<?php echo $detail[0] -> carea;?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Account</label>
                                            <select class="form-control" name="cacc">
												<?php echo __customer_account($detail[0] -> cacc); ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Name</label>
                        <input type="text" placeholder="Customer Name" name="name" class="form-control" value="<?php echo $detail[0] -> cname; ?>" />
                                        </div>
                                        <div class="form-group">
                                            <label>NPWP</label>
                        <input type="text" placeholder="Customer NPWP" name="npwp" class="form-control" value="<?php echo $detail[0] -> cnpwp; ?>" />
                                        </div>
                                        <div class="form-group">
                                            <label>Address</label>
											<textarea name="addr" class="form-control" placeholder="Address"><?php echo $detail[0] -> caddr; ?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>City</label>
                        <select name="city" class="form-control"><?php echo $city; ?></select>
                                        </div>
                                        <div class="form-group">
                                            <label>Province</label>
                        <select name="prov" class="form-control"><?php echo $province; ?></select>
                                        </div>
                                        <div class="form-group">
                                            <label>Phone I</label>
                        <input type="text" placeholder="Phone I" name="phone1" class="form-control" value="<?php echo $phone[0]; ?>" />
                                        </div>
                                        <div class="form-group">
                                            <label>Phone II</label>
                        <input type="text" placeholder="Phone II" name="phone2" class="form-control" value="<?php echo $phone[1]; ?>" />
                                        </div>
                                        <div class="form-group">
                                            <label>Email</label>
                        <input type="text" placeholder="Email" name="email" class="form-control" value="<?php echo $detail[0] -> cemail; ?>" />
                                        </div>
                                        <div class="form-group">
                                            <label>Discount</label>
                        <input type="text" placeholder="Discount" name="disc" class="form-control" value="<?php echo $detail[0] -> cdisc; ?>" />
                                        </div>
                                        <div class="form-group">
                                            <label>Credit Limit</label>
                        <input type="text" placeholder="Credit Limit" name="limit" class="form-control" value="<?php echo $detail[0] -> ccreditlimit; ?>" />
                                        </div>
                                        <div class="form-group">
                                            <label>Credit Tenor</label>
                        <input type="text" placeholder="Credit Tenor" name="tenor" class="form-control" value="<?php echo $detail[0] -> ccredittime; ?>" />
                                        </div>
                                        <div class="form-group">
                                            <label>Tax</label>
                                            <?php echo __get_tax($detail[0] -> ctax,2); ?>
                                        </div>
                                        <div class="form-group">
                                            <label>Customer Type</label>
                                            <?php echo __get_customer_type($detail[0] -> ctype,2); ?>
                                        </div>
                                        <div class="form-group">
                                            <label>Description</label>
											<textarea name="desc" class="form-control" placeholder="Description"><?php echo $detail[0] -> cdesc; ?></textarea>
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
<script type="text/javascript">
$('select[name="branch"]').val(<?php echo $this -> memcachedlib -> sesresult['ubranchid']; ?>);
$('#pbranch').css('display','none');
</script>
