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
						<?php if (__get_roles('BranchView') || __get_roles('BooksView') || __get_roles('BooksGroupView') || __get_roles('BooksLocationView') || __get_roles('AreaView') || __get_roles('PublisherView') || __get_roles('CustomerView') ||  __get_roles('TaxesView')  ||  __get_roles('CatalogView')  ||  __get_roles('CategoryArsipView')  ||  __get_roles('ArsipView')  ||  __get_roles('PromotionView')  ||  __get_roles('CityView')  ||  __get_roles('ProvinceView')) : ?>
                        <li class="treeview" rel="master">
                            <a href="#">
                                <i class="fa fa-tasks"></i>
                                <span>Master</span>
                                <i class="fa fa-angle-left pull-right"></i>
                                <small class="badge pull-right bg-red">13</small>
                            </a>
                            <ul class="treeview-menu">
								<?php if (__get_roles('BranchView')) : ?>
                                <li><a href="<?php echo site_url('branch'); ?>"><i class="fa fa-angle-double-right"></i> Branch</a></li>
								<?php endif; ?>
								<?php if (__get_roles('BooksView')) : ?>
                                <li><a href="<?php echo site_url('books'); ?>"><i class="fa fa-angle-double-right"></i> Books</a></li>
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
                        <li class="treeview" rel="transaction">
                            <a href="#">
                                <i class="fa fa-money"></i>
                                <span>Sales &amp; Purchase</span>
                                <i class="fa fa-angle-left pull-right"></i>
                                <small class="badge pull-right bg-red">3</small>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="#"><i class="fa fa-angle-double-right"></i> Selling</a>
								
                            <ul>
                                <li style="list-style:none;padding: 5px 5px 5px 5px;display:block;margin-left:-10px;"><a href="<?php echo site_url('hasil_penjualan'); ?>"><i class="fa fa-angle-double-right"></i> Hasil Penjualan</a></li>
                                <li style="list-style:none;padding: 5px 5px 5px 5px;display:block;margin-left:-10px;"><a href="<?php echo site_url('penjualan_kredit'); ?>"><i class="fa fa-angle-double-right"></i> Penjualan Kredit</a></li>
								<li style="list-style:none;padding: 5px 5px 5px 5px;display:block;margin-left:-10px;"><a href="<?php echo site_url('penjualan_konsinyasi'); ?>"><i class="fa fa-angle-double-right"></i> Penjualan Konsinyasi</a></li>
                            </ul>
								</li>
                                <li><a href="#"><i class="fa fa-angle-double-right"></i> Buying</a>
                            <ul>
                               
                                <li style="list-style:none;padding: 5px 5px 5px 5px;display:block;margin-left:-10px;"><a href="<?php echo site_url('pembelian_spo'); ?>"><i class="fa fa-angle-double-right"></i> Pembelian </a></li>

                            </ul>
								</li>
                                <li><a href="#"><i class="fa fa-angle-double-right"></i> Retur</a>
                            <ul>
                                <li style="list-style:none;padding: 5px 5px 5px 5px;display:block;margin-left:-10px;"><a href="<?php echo site_url('retur_hp'); ?>"><i class="fa fa-angle-double-right"></i> Retur Hasil Penjualan</a></li>
                                <li style="list-style:none;padding: 5px 5px 5px 5px;display:block;margin-left:-10px;"><a href="<?php echo site_url('retur_jc'); ?>"><i class="fa fa-angle-double-right"></i> Retur Penjualan Kredit</a></li>
								<li style="list-style:none;padding: 5px 5px 5px 5px;display:block;margin-left:-10px;"><a href="<?php echo site_url('retur_jk'); ?>"><i class="fa fa-angle-double-right"></i> Retur Penjualan Konsinyasi</a></li>
								<li style="list-style:none;padding: 5px 5px 5px 5px;display:block;margin-left:-10px;"><a href="<?php echo site_url('retur_bk'); ?>"><i class="fa fa-angle-double-right"></i> Retur Pembelian</a></li>
                            </ul>										
								
								
								</li>
								
                            </ul>
                        </li>
                        <li class="treeview" rel="dist">
                            <a href="#">
                                <i class="fa fa-link"></i>
                                <span>Distribution</span>
                                <i class="fa fa-angle-left pull-right"></i>
                                <small class="badge pull-right bg-green">2</small>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="<?php echo site_url('request'); ?>"><i class="fa fa-angle-double-right"></i> Request</a></li>
                                <li><a href="<?php echo site_url('transfer'); ?>"><i class="fa fa-angle-double-right"></i> Transfer</a></li>
                            </ul>
                        </li>
                        <li class="treeview" rel="inventory">
                            <a href="#">
                                <i class="fa fa-th"></i>
                                <span>Inventory</span>
                                <i class="fa fa-angle-left pull-right"></i>
                                <small class="badge pull-right bg-green">4</small>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="<?php echo site_url('receiving'); ?>"><i class="fa fa-angle-double-right"></i> Item Receiving</a></li>
                                <li><a href="<?php echo site_url('inventory'); ?>"><i class="fa fa-angle-double-right"></i> Stock</a></li>
                                <?php if ($this -> memcachedlib -> sesresult['ubranchid'] == 1) : ?>
                                <li><a href="<?php echo site_url('inventory_shadow'); ?>"><i class="fa fa-angle-double-right"></i> Stock Shadow</a></li>
                                <?php endif; ?>
                                <li><a href="<?php echo site_url('inventory_customer'); ?>"><i class="fa fa-angle-double-right"></i> Stock Customer</a></li>
                                <li><a href="javascript:void(0);"><i class="fa fa-angle-double-right"></i> Opname</a>
                                <ul>
                                <li style="list-style:none;padding: 5px 5px 5px 5px;display:block;margin-left:-10px;"><a href="<?php echo site_url('opname'); ?>"><i class="fa fa-angle-double-right"></i> Stock</a></li>
                                <li style="list-style:none;padding: 5px 5px 5px 5px;display:block;margin-left:-10px;"><a href="<?php echo site_url('opnamecustomer'); ?>"><i class="fa fa-angle-double-right"></i> Stock Customer</a></li>
                                </ul>
                            </ul>
                        </li>
                        <li class="treeview" rel="accounting">
                            <a href="#">
                                <i class="fa fa-book"></i>
                                <span>Accounting</span>
                                <i class="fa fa-angle-left pull-right"></i>
                                <small class="badge pull-right bg-blue">5</small>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="<?php echo site_url('coa'); ?>"><i class="fa fa-angle-double-right"></i> Chart of Account</a></li>
                                <li><a href="<?php echo site_url('coagroup'); ?>"><i class="fa fa-angle-double-right"></i> COA Group</a></li>
                                <li><a href="<?php echo site_url('journal'); ?>"><i class="fa fa-angle-double-right"></i> Journal</a></li>
                                <li><a href="<?php echo site_url('generalledger'); ?>"><i class="fa fa-angle-double-right"></i> General Ledger</a></li>
                                <li><a href="<?php echo site_url('closingperiod'); ?>"><i class="fa fa-angle-double-right"></i> Closing Period</a></li>
                            </ul>
                        </li>
                        <li class="treeview" rel="report">
                            <a href="#">
                                <i class="fa fa-money"></i>
                                <span>Report</span>
                                <i class="fa fa-angle-left pull-right"></i>
                                <small class="badge pull-right bg-red">2</small>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="javascript:void(0);"><i class="fa fa-angle-double-right"></i> Opname</a>
                                <ul>
                                <li style="list-style:none;padding: 5px 5px 5px 5px;display:block;margin-left:-10px;"><a href="<?php echo site_url('reportopname'); ?>"><i class="fa fa-angle-double-right"></i> Stock</a></li>
                                <li style="list-style:none;padding: 5px 5px 5px 5px;display:block;margin-left:-10px;"><a href="<?php echo site_url('reportopnamecustomer'); ?>"><i class="fa fa-angle-double-right"></i> Stock Customer</a></li>
                                </ul>
                                </li>
                                <li><a href="javascript:void(0);"><i class="fa fa-angle-double-right"></i> Stock</a>
                                <ul>
                                <li style="list-style:none;padding: 5px 5px 5px 5px;display:block;margin-left:-10px;"><a href="<?php echo site_url('reportstock'); ?>"><i class="fa fa-angle-double-right"></i> Stock</a></li>
                                <li style="list-style:none;padding: 5px 5px 5px 5px;display:block;margin-left:-10px;"><a href="<?php echo site_url('reportstockcustomer'); ?>"><i class="fa fa-angle-double-right"></i> Stock Customer</a></li>
                                </ul>
                                </li>
                            </ul>
                        </li>  
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
	else if (/\/reportopname|reportopnamecustomer|reportstock|reportstockcustomer/.test(window.location.href) === true) {
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
	else if (/\/kwitansi|faktur|letter/.test(window.location.href) === true) {
		$('li[rel="print"]').addClass('active');
		$('li[rel="print"] > ul.treeview-menu').css({'display': 'block', 'overflow': 'hidden'});
	}
	else if (/\/hasil_penjualan|penjualan_kredit|penjualan_konsinyasi|pembelian_spo|retur_hp|retur_jc|retur_bk/.test(window.location.href) === true) {
		$('li[rel="transaction"]').addClass('active');
		$('li[rel="transaction"] > ul.treeview-menu').css({'display': 'block', 'overflow': 'hidden'});
	}
	else if (/\/branch|books|locator|area|publisher|customer|tax|catalog|category_arsip|arsip|promo|city|province/.test(window.location.href) === true) {
		$('li[rel="master"]').addClass('active');
		$('li[rel="master"] > ul.treeview-menu').css({'display': 'block', 'overflow': 'hidden'});
	}
</script>
