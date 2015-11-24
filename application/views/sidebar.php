            <aside class="left-side sidebar-offcanvas">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left info">
                            <p>Branch, <?php echo $this -> memcachedlib -> sesresult['ubranch']; ?></p>
                            <p>Hello, <?php echo $this -> memcachedlib -> sesresult['uemail']; ?></p>

                            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                        </div>
                    </div>
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">
                        <li class="active">
                            <a href="<?php echo site_url('/'); ?>">
                                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                            </a>
                        </li>
						<?php if (__get_roles('BranchView') || __get_roles('BooksView') || __get_roles('BooksLocationView') || __get_roles('AreaView') || __get_roles('PublisherView') || __get_roles('CustomerView') ||  __get_roles('TaxesView')  ||  __get_roles('CatalogView')  ||  __get_roles('CategoryArsipView')  ||  __get_roles('ArsipView')  ||  __get_roles('PromotionView')  ||  __get_roles('CityView')  ||  __get_roles('ProvinceView')) : ?>
                        <li class="treeview" rel="master">
                            <a href="#">
                                <i class="fa fa-tasks"></i>
                                <span>Master</span>
                                <i class="fa fa-angle-left pull-right"></i>
                                <small class="badge pull-right bg-red">14</small>
                            </a>
                            <ul class="treeview-menu">
								<?php if (__get_roles('BranchView')) : ?>
                                <li><a href="<?php echo site_url('branch'); ?>"><i class="fa fa-angle-double-right"></i> Branch</a></li>
								<?php endif; ?>
								<?php if (__get_roles('BooksView')) : ?>
                                <li><a href="<?php echo site_url('books'); ?>"><i class="fa fa-angle-double-right"></i> Books</a></li>
								<?php endif; ?>
								<?php if (__get_roles('BooksView')) : ?>
                                <li><a href="<?php echo site_url('categories'); ?>"><i class="fa fa-angle-double-right"></i> Category Books</a></li>
								<?php endif; ?>
								<?php if (__get_roles('BooksLocationView')) : ?>
                                <li><a href="<?php echo site_url('locator'); ?>"><i class="fa fa-angle-double-right"></i> Books Location</a></li>
								<?php endif; ?>
								<?php if (__get_roles('AreaView')) : ?>
                                <li><a href="<?php echo site_url('area'); ?>"><i class="fa fa-angle-double-right"></i> Area</a></li>
								<?php endif; ?>
								<?php if (__get_roles('PublisherView')) : ?>
                                <li><a href="<?php echo site_url('publisher'); ?>"><i class="fa fa-angle-double-right"></i> Publisher</a></li>
								<?php endif; ?>
								<?php if (__get_roles('CustomerView')) : ?>
                                <li><a href="<?php echo site_url('customer'); ?>"><i class="fa fa-angle-double-right"></i> Customer</a></li>
								<?php endif; ?>
								<?php if (__get_roles('TaxesView')) : ?>
                                <li><a href="<?php echo site_url('tax'); ?>"><i class="fa fa-angle-double-right"></i> Taxes</a></li>
								<?php endif; ?>
								<?php if (__get_roles('CatalogView')) : ?>
                                <li><a href="<?php echo site_url('catalog'); ?>"><i class="fa fa-angle-double-right"></i> Catalog</a></li>
								<?php endif; ?>
								<?php if (__get_roles('CategoryArsipView')) : ?>
                                <li><a href="<?php echo site_url('category_arsip'); ?>"><i class="fa fa-angle-double-right"></i> Category Arsip</a></li>
								<?php endif; ?>
								<?php if (__get_roles('ArsipView')) : ?>
                                <li><a href="<?php echo site_url('arsip'); ?>"><i class="fa fa-angle-double-right"></i> Arsip</a></li>
								<?php endif; ?>
								<?php if (__get_roles('PromotionView')) : ?>
                                <li><a href="<?php echo site_url('promo'); ?>"><i class="fa fa-angle-double-right"></i> Promotion</a></li>
								<?php endif; ?>
								<?php if (__get_roles('CityView')) : ?>
                                <li><a href="<?php echo site_url('city'); ?>"><i class="fa fa-angle-double-right"></i> City</a></li>
								<?php endif; ?>
								<?php if (__get_roles('ProvinceView')) : ?>
                                <li><a href="<?php echo site_url('province'); ?>"><i class="fa fa-angle-double-right"></i> Province</a></li>
								<?php endif; ?>
                            </ul>
                        </li>
						<?php endif; ?>
						<?php if (__get_roles('HasilPenjualanView') || __get_roles('PenjualanKreditView') || __get_roles('PenjualanKonsinyasiView') || __get_roles('PembelianView') || __get_roles('ReturHasilPenjualanView') || __get_roles('ReturPenjualanKreditView') || __get_roles('ReturPenjualanKonsinyasiView') || __get_roles('ReturPembelianView')) : ?>
                        <li class="treeview" rel="transaction">
                            <a href="#">
                                <i class="fa fa-money"></i>
                                <span>Sales &amp; Purchase</span>
                                <i class="fa fa-angle-left pull-right"></i>
                                <small class="badge pull-right bg-red">3</small>
                            </a>
                            <ul class="treeview-menu">
								<?php if (__get_roles('HasilPenjualanView') || __get_roles('PenjualanKreditView') || __get_roles('PenjualanKonsinyasiView')) : ?>
                                <li><a href="#"><i class="fa fa-angle-double-right"></i> Selling</a>
								<ul>
								<?php if (__get_roles('HasilPenjualanView')) : ?>
                                <li style="list-style:none;padding: 5px 5px 5px 5px;display:block;margin-left:-10px;"><a href="<?php echo site_url('hasil_penjualan'); ?>"><i class="fa fa-angle-double-right"></i> Hasil Penjualan</a></li>
								<?php endif; ?>
								<?php if (__get_roles('PenjualanKreditView')) : ?>
                                <li style="list-style:none;padding: 5px 5px 5px 5px;display:block;margin-left:-10px;"><a href="<?php echo site_url('penjualan_kredit'); ?>"><i class="fa fa-angle-double-right"></i> Penjualan Kredit</a></li>
								<?php endif; ?>
								<?php if (__get_roles('PenjualanKonsinyasiView')) : ?>
								<li style="list-style:none;padding: 5px 5px 5px 5px;display:block;margin-left:-10px;"><a href="<?php echo site_url('penjualan_konsinyasi'); ?>"><i class="fa fa-angle-double-right"></i> Penjualan Konsinyasi</a></li>
								<?php endif; ?>
								</ul>
								</li>
								<?php endif; ?>
<!--
								<?php if (__get_roles('PembelianView')) : ?>
                                <li><a href="#"><i class="fa fa-angle-double-right"></i> Buying</a>
								<ul>
								<?php if (__get_roles('PembelianView')) : ?>
                                <li style="list-style:none;padding: 5px 5px 5px 5px;display:block;margin-left:-10px;"><a href="<?php echo site_url('pembelian_spo'); ?>"><i class="fa fa-angle-double-right"></i> Pembelian </a></li>
								<?php endif; ?>
								</ul>
								</li>
								<?php endif; ?>
-->
								<?php if (__get_roles('ReturHasilPenjualanView') || __get_roles('ReturPenjualanKreditView') || __get_roles('ReturPenjualanKonsinyasiView') || __get_roles('ReturPembelianView')) : ?>
                                <li><a href="#"><i class="fa fa-angle-double-right"></i> Retur</a>
								<ul>
								<?php if (__get_roles('ReturHasilPenjualanView')) : ?>
                                <li style="list-style:none;padding: 5px 5px 5px 5px;display:block;margin-left:-10px;"><a href="<?php echo site_url('retur_hp'); ?>"><i class="fa fa-angle-double-right"></i> Retur Hasil Penjualan</a></li>
								<?php endif; ?>
								<?php if (__get_roles('ReturPenjualanKreditView')) : ?>
                                <li style="list-style:none;padding: 5px 5px 5px 5px;display:block;margin-left:-10px;"><a href="<?php echo site_url('retur_jc'); ?>"><i class="fa fa-angle-double-right"></i> Retur Penjualan Kredit</a></li>
								<?php endif; ?>
								<?php if (__get_roles('ReturPenjualanKonsinyasiView')) : ?>
								<li style="list-style:none;padding: 5px 5px 5px 5px;display:block;margin-left:-10px;"><a href="<?php echo site_url('retur_jk'); ?>"><i class="fa fa-angle-double-right"></i> Retur Penjualan Konsinyasi</a></li>
								<?php endif; ?>
								<?php if (__get_roles('ReturPembelianView')) : ?>
								<li style="list-style:none;padding: 5px 5px 5px 5px;display:block;margin-left:-10px;"><a href="<?php echo site_url('retur_bk'); ?>"><i class="fa fa-angle-double-right"></i> Retur Pembelian</a></li>
								<?php endif; ?>
								</ul>
								</li>
								<?php endif; ?>
                            </ul>
                        </li>
						<?php endif; ?>
						<?php if (__get_roles('DistributionRequestView') || __get_roles('DistributionTransferView')) : ?>
                        <li class="treeview" rel="dist">
                            <a href="#">
                                <i class="fa fa-link"></i>
                                <span>Distribution</span>
                                <i class="fa fa-angle-left pull-right"></i>
                                <small class="badge pull-right bg-green">2</small>
                            </a>
                            <ul class="treeview-menu">
								<?php if (__get_roles('DistributionRequestView')) : ?>
                                <li><a href="<?php echo site_url('request'); ?>"><i class="fa fa-angle-double-right"></i> Request</a></li>
								<?php endif; ?>
								<?php if (__get_roles('DistributionTransferView')) : ?>
                                <li><a href="<?php echo site_url('transfer'); ?>"><i class="fa fa-angle-double-right"></i> Transfer</a></li>
								<?php endif; ?>
                            </ul>
                        </li>
						<?php endif; ?>
						
						<?php if (__get_roles('KwitansiView') || __get_roles('KwitansiPembayaranView')) : ?>
                        <li class="treeview" rel="finance">
                            <a href="#">
                                <i class="fa fa-credit-card"></i>
                                <span>Finance</span>
                                <i class="fa fa-angle-left pull-right"></i>
                                <small class="badge pull-right bg-green">2</small>
                            </a>
                            <ul class="treeview-menu">
								<?php if (__get_roles('KwitansiView')) : ?>
                                <li><a href="<?php echo site_url('pembayaran'); ?>"><i class="fa fa-angle-double-right"></i> Invoice</a>
								
								<ul>
									<?php if (__get_roles('PenjualanKreditView')) : ?>
									<li style="list-style:none;padding: 5px 5px 5px 5px;display:block;margin-left:-10px;"><a href="<?php echo site_url('piutang/home/inv_area'); ?>"><i class="fa fa-angle-double-right"></i> Invoice By Area</a></li>
									<?php endif; ?>									
									<?php if (__get_roles('PenjualanKreditView')) : ?>
									<li style="list-style:none;padding: 5px 5px 5px 5px;display:block;margin-left:-10px;"><a href="<?php echo site_url('piutang/home/inv_cust'); ?>"><i class="fa fa-angle-double-right"></i> Invoice By Customer</a></li>
									<?php endif; ?>
									<?php if (__get_roles('PenjualanKreditView')) : ?>
									<li style="list-style:none;padding: 5px 5px 5px 5px;display:block;margin-left:-10px;"><a href="<?php echo site_url('piutang/home/pfaktur_lunas'); ?>"><i class="fa fa-angle-double-right"></i> Invoice By Faktur</a></li>
									<?php endif; ?>
								</ul>
								
								
								</li>
								<?php endif; ?>
								<?php if (__get_roles('KwitansiPembayaranView')) : ?>
                                <li><a href="<?php echo site_url('piutang/home'); ?>"><i class="fa fa-angle-double-right"></i> Piutang by Area</a></li>
								<?php endif; ?>
								<?php if (__get_roles('KwitansiPembayaranView')) : ?>
                                <li><a href="<?php echo site_url('piutang/home/piutang_cust'); ?>"><i class="fa fa-angle-double-right"></i> Piutang by Customer</a></li>
								<?php endif; ?>
								<?php if (__get_roles('KwitansiPembayaranView')) : ?>
                                <li><a href="<?php echo site_url('piutang/home/pfaktur'); ?>"><i class="fa fa-angle-double-right"></i> Piutang by Faktur</a></li>
								<?php endif; ?>
								
                            </ul>
                        </li>
						<?php endif; ?>
						<?php if (__get_roles('ItemReceivingView') || __get_roles('StockView') || __get_roles('StockShadowView') || __get_roles('StockCustomerView') || __get_roles('OpnameStockView') || __get_roles('OpnameStockCustomerView')) : ?>
                        <li class="treeview" rel="inventory">
                            <a href="#">
                                <i class="fa fa-th"></i>
                                <span>Inventory</span>
                                <i class="fa fa-angle-left pull-right"></i>
                                <small class="badge pull-right bg-green">5</small>
                            </a>
                            <ul class="treeview-menu">
								<?php if (__get_roles('ItemReceivingView')) : ?>
                                <li><a href="<?php echo site_url('receiving'); ?>"><i class="fa fa-angle-double-right"></i> Item Receiving</a></li>
								<?php endif; ?>
								<?php if (__get_roles('StockView')) : ?>
                                <li><a href="<?php echo site_url('inventory'); ?>"><i class="fa fa-angle-double-right"></i> Stock</a></li>
								<?php endif; ?>
                                <?php if ($this -> memcachedlib -> sesresult['ubranchid'] == 1) : ?>
								<?php if (__get_roles('StockShadowView')) : ?>
                                <!--li><a href="<?php echo site_url('inventory_shadow'); ?>"><i class="fa fa-angle-double-right"></i> Stock Shadow</a></li-->
								<?php endif; ?>
                                <?php endif; ?>
								<?php if (__get_roles('StockCustomerView')) : ?>
                                <li><a href="<?php echo site_url('inventory_customer'); ?>"><i class="fa fa-angle-double-right"></i> Stock Customer</a></li>
								<?php endif; ?>
								<?php if (__get_roles('OpnameStockView') || __get_roles('OpnameStockCustomerView')) : ?>
                                <li><a href="javascript:void(0);"><i class="fa fa-angle-double-right"></i> Opname</a>
                                <ul>
								<?php if (__get_roles('OpnameStockView')) : ?>
                                <li style="list-style:none;padding: 5px 5px 5px 5px;display:block;margin-left:-10px;"><a href="<?php echo site_url('opname'); ?>"><i class="fa fa-angle-double-right"></i> Stock</a></li>
								<?php endif; ?>
								<?php if (__get_roles('OpnameStockCustomerView')) : ?>
                                <li style="list-style:none;padding: 5px 5px 5px 5px;display:block;margin-left:-10px;"><a href="<?php echo site_url('opnamecustomer'); ?>"><i class="fa fa-angle-double-right"></i> Stock Customer</a></li>
								<?php endif; ?>
                                </ul>
								</li>
                                <?php endif; ?>
                            </ul>
                        </li>
						<?php endif; ?>
						<?php if (__get_roles('ReportStock') || __get_roles('ReportStockCustomer') || __get_roles('ReportOpnameStockCustomer') || __get_roles('ReportOpnameStock') || __get_roles('ReportingTransaction') || __get_roles('ReportItemReceiving')) : ?>
                        <li class="treeview" rel="report">
                            <a href="#">
                                <i class="fa fa-money"></i>
                                <span>Report</span>
                                <i class="fa fa-angle-left pull-right"></i>
                                <small class="badge pull-right bg-red">4</small>
                            </a>
                            <ul class="treeview-menu">
								<?php if (__get_roles('ReportStock') || __get_roles('ReportStockCustomer') || __get_roles('ReportItemReceiving') || __get_roles('ReportingTransaction')) : ?>
								<?php if (__get_roles('ReportingTransaction')) : ?>
								<li><a href="<?php echo site_url('reportingstock');?>"><i class="fa fa-angle-double-right"></i> Transaction</a></li>
                                <?php endif; ?>
								<?php if (__get_roles('ReportItemReceiving')) : ?>
								<li><a href="<?php echo site_url('reportitemreceiving');?>"><i class="fa fa-angle-double-right"></i> Item Receiving</a></li>
                                <?php endif; ?>
                                <li><a href="javascript:void(0);"><i class="fa fa-angle-double-right"></i> Opname</a>
                                <ul>
								<?php if (__get_roles('ReportStock')) : ?>
                                <li style="list-style:none;padding: 5px 5px 5px 5px;display:block;margin-left:-10px;"><a href="<?php echo site_url('reportopname'); ?>"><i class="fa fa-angle-double-right"></i> Stock</a></li>
                                <?php endif; ?>
								<?php if (__get_roles('ReportStockCustomer')) : ?>
                                <li style="list-style:none;padding: 5px 5px 5px 5px;display:block;margin-left:-10px;"><a href="<?php echo site_url('reportopnamecustomer'); ?>"><i class="fa fa-angle-double-right"></i> Stock Customer</a></li>
                                <?php endif; ?>
                                </ul>
                                </li>
                                <?php endif; ?>
								<?php if (__get_roles('ReportCardStock')) : ?>
                                <li><a href="<?php echo site_url('reportcardstock'); ?>"><i class="fa fa-angle-double-right"></i> Card Stock</a></li>
                                <?php endif; ?>
                            </ul>
                        </li>  
						<?php endif; ?>
                        <li class="treeview" rel="pm">
                            <a href="#">
                                <i class="fa fa-envelope"></i>
                                <span>Private Messages</span>
                                <i class="fa fa-angle-left pull-right"></i>
                                <small class="badge pull-right bg-aqua">3</small>
                            </a>
                            <ul class="treeview-menu">
                        <li class=""><a href="<?php echo site_url('pm/pm_new'); ?>"><i class="fa fa-angle-double-right"></i> New Private Message </a></li>
                        <li class=""><a href="<?php echo site_url('pm'); ?>"><i class="fa fa-angle-double-right"></i> Inbox </a></li>
                        <li class=""><a href="<?php echo site_url('pm/outbox'); ?>"><i class="fa fa-angle-double-right"></i> Outbox </a></li>
                            </ul>
                        </li>
						<?php if (__get_roles('UsersView') || __get_roles('UsersGroupView')) : ?>
                        <li class="treeview" rel="users">
                            <a href="#">
                                <i class="fa fa-group"></i>
                                <span>Users</span>
                                <i class="fa fa-angle-left pull-right"></i>
                                <small class="badge pull-right bg-yellow">2</small>
                            </a>
                            <ul class="treeview-menu">
								<?php if (__get_roles('UsersView')) : ?>
                                <li><a href="<?php echo site_url('users'); ?>"><i class="fa fa-angle-double-right"></i> Users</a></li>
								<?php endif; ?>
								<?php if (__get_roles('UsersGroupView')) : ?>
                                <li><a href="<?php echo site_url('users/users_group'); ?>"><i class="fa fa-angle-double-right"></i> Users Group</a></li>
								<?php endif; ?>
                            </ul>
                        </li>
						<?php endif; ?>
                        <li>
                            <a href="<?php echo site_url('login/logout'); ?>" onclick="return confirm('<?php echo $this -> memcachedlib -> sesresult['uemail']; ?>, are you sure you want to logout?');">
                                <i class="fa fa-sign-in"></i> <span>Logout</span>
                            </a>
                        </li>
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>
<script type="text/javascript">
	if (/\/users/.test(window.location.href) === true) {
		$('li[rel="users"]').addClass('active');
		$('li[rel="users"] > ul.treeview-menu').css({'display': 'block', 'overflow': 'hidden'});
	}
	else if (/\/pm/.test(window.location.href) === true) {
		$('li[rel="pm"]').addClass('active');
		$('li[rel="pm"] > ul.treeview-menu').css({'display': 'block', 'overflow': 'hidden'});
	}
	else if (/\/reportopname|reportopnamecustomer|reportstock|reportitemreceiving|reportingstock|reportstockcustomer|reportcardstock/.test(window.location.href) === true) {
		$('li[rel="report"]').addClass('active');
		$('li[rel="report"] > ul.treeview-menu').css({'display': 'block', 'overflow': 'hidden'});
	}
	else if (/\/receiving|inventory|inventory_shadow|inventorycustomer|opname|opnamecustomer/.test(window.location.href) === true) {
		$('li[rel="inventory"]').addClass('active');
		$('li[rel="inventory"] > ul.treeview-menu').css({'display': 'block', 'overflow': 'hidden'});
	}
	else if (/\/request|transfer/.test(window.location.href) === true) {
		$('li[rel="dist"]').addClass('active');
		$('li[rel="dist"] > ul.treeview-menu').css({'display': 'block', 'overflow': 'hidden'});
	}
	else if (/\/coa|coagroup|journal|generalledger|closingperiod/.test(window.location.href) === true) {
		$('li[rel="accounting"]').addClass('active');
		$('li[rel="accounting"] > ul.treeview-menu').css({'display': 'block', 'overflow': 'hidden'});
	}
	else if (/\/pembayaran|piutang/.test(window.location.href) === true) {
		$('li[rel="finance"]').addClass('active');
		$('li[rel="finance"] > ul.treeview-menu').css({'display': 'block', 'overflow': 'hidden'});
	}
	else if (/\/kwitansi|faktur|letter/.test(window.location.href) === true) {
		$('li[rel="print"]').addClass('active');
		$('li[rel="print"] > ul.treeview-menu').css({'display': 'block', 'overflow': 'hidden'});
	}
	else if (/\/hasil_penjualan|penjualan_kredit|penjualan_konsinyasi|pembelian_spo|retur_hp|retur_jc|retur_jk|retur_bk/.test(window.location.href) === true) {
		$('li[rel="transaction"]').addClass('active');
		$('li[rel="transaction"] > ul.treeview-menu').css({'display': 'block', 'overflow': 'hidden'});
	}
	else if (/\/branch|books|locator|area|publisher|customer|tax|catalog|categories|category_arsip|arsip|promo|city|province/.test(window.location.href) === true) {
		$('li[rel="master"]').addClass('active');
		$('li[rel="master"] > ul.treeview-menu').css({'display': 'block', 'overflow': 'hidden'});
	}
</script>
