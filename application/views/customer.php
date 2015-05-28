
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Customer
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo site_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Customer</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
						<form action="<?php echo site_url('customer/customer_search/'); ?>" method="post">
                <div class="form-group">
                    <label for="text1" class="control-label col-lg-1">Name/Code</label>
                        <div class="col-xs-4">
                        <input type="text" style="width:200px!important;display:inline!important;" placeholder="Customer Name/Code" name="keyword" class="form-control" autocomplete="off" />
                        <button class="btn text-muted text-center btn-danger" type="submit">Go!</button>
                        <span id="sg1"></span>
                        <input type="hidden" name="cid" />
						</div>
						</div>
						</form>
						</div>
						<br />
                    <div class="row">
                        <div class="col-xs-12">
	<?php echo __get_error_msg(); ?>
							<div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">
				<?php if (__get_roles('CustomerAdd')) : ?>
                <a href="<?php echo site_url('customer/customer_add'); ?>" class="btn btn-default"><i class="fa fa-plus"></i> Add Customer</a></h3>
                <?php endif; ?>
                                </div><!-- /.box-header -->
                                <div class="box-body">
                                    <table class="table table-bordered">
                                    <thead>
                                        <tr>
          <th>Branch</th>
          <th>Code</th>
          <th>Type</th>
          <th>Name</th>
          <th>Area</th>
          <th>Phone</th>
          <th>Email</th>
          <th>NPWP</th>
          <th>Discount</th>
          <th>Tax</th>
          <th>Status</th>
          <th style="width: 50px;"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
		  <?php
		  foreach($customer as $k => $v) :
		  $phone = explode('*', $v -> cphone);
		  ?>
                                        <tr>
          <td><?php echo $v -> bname; ?></td>
          <td><?php echo $v -> ccode; ?></td>
          <td><?php echo __get_customer_type($v -> ctype,1); ?></td>
          <td><?php echo $v -> cname; ?></td>
          <td><?php echo $v -> aname; ?></td>
          <td><?php echo $phone[0] . ' / ' . (isset($phone[1]) ? $phone[1] : ''); ?></td>
          <td><?php echo $v -> cemail; ?></td>
          <td><?php echo $v -> cnpwp; ?></td>
          <td><?php echo $v -> cdisc; ?></td>
          <td><?php echo __get_tax($v -> ctax,1); ?></td>
          <td><?php echo __get_status($v -> cstatus,1); ?></td>
		  <td>
              <a href="<?php echo site_url('customer/customer_update/' . $v -> cid); ?>"><i class="fa fa-pencil"></i></a>
              <a href="<?php echo site_url('customer/customer_delete/' . $v -> cid); ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-times"></i></a>
		</td>
										</tr>
        <?php endforeach; ?>
                                    </tbody>
                                    </table>
                                </div><!-- /.box-body -->
                                <div class="box-footer clearfix">
                                    <ul class="pagination pagination-sm no-margin pull-right">
                                        <?php echo $pages; ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                </section><!-- /.content -->
            </aside><!-- /.right-side -->

<script type="text/javascript">
$(function(){
	$('input[name="keyword"]').sSuggestion('span#sg1','<?php echo site_url('customer/get_suggestion'); ?>', 'cid');
});
</script>
