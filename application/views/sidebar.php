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
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-tasks"></i>
                                <span>Master</span>
                                <i class="fa fa-angle-left pull-right"></i>
                                <small class="badge pull-right bg-red">10</small>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="<?php echo site_url('branch'); ?>"><i class="fa fa-angle-double-right"></i> Branch</a></li>
                                <li><a href="<?php echo site_url('books'); ?>"><i class="fa fa-angle-double-right"></i> Books</a></li>
                                <li><a href="<?php echo site_url('books_group'); ?>"><i class="fa fa-angle-double-right"></i> Books Group</a></li>
                                <li><a href="<?php echo site_url('area'); ?>"><i class="fa fa-angle-double-right"></i> Area</a></li>
                                <li><a href="<?php echo site_url('publisher'); ?>"><i class="fa fa-angle-double-right"></i> Publisher</a></li>
                                <li><a href="<?php echo site_url('customer'); ?>"><i class="fa fa-angle-double-right"></i> Customer</a></li>
                                <li><a href="<?php echo site_url('tax'); ?>"><i class="fa fa-angle-double-right"></i> Taxes</a></li>
                                <li><a href="<?php echo site_url('catalog'); ?>"><i class="fa fa-angle-double-right"></i> Catalog</a></li>
                                <li><a href="<?php echo site_url('category_arsip'); ?>"><i class="fa fa-angle-double-right"></i> Category Arsip</a></li>
                                <li><a href="<?php echo site_url('arsip'); ?>"><i class="fa fa-angle-double-right"></i> Arsip</a></li>
                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-money"></i>
                                <span>Sales &amp; Purchase</span>
                                <i class="fa fa-angle-left pull-right"></i>
                                <small class="badge pull-right bg-red">2</small>
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
                               
                                <li style="list-style:none;padding: 5px 5px 5px 5px;display:block;margin-left:-10px;"><a href="<?php echo site_url('pembelian_kredit'); ?>"><i class="fa fa-angle-double-right"></i> Pembelian Kredit</a></li>
								<li style="list-style:none;padding: 5px 5px 5px 5px;display:block;margin-left:-10px;"><i class="fa fa-angle-double-right"></i> Pembelian Konsinyasi</li>
                            </ul>
								</li>
                                <li><a href="#"><i class="fa fa-angle-double-right"></i> Retur</a>
                            <ul>
                                <li style="list-style:none;padding: 5px 5px 5px 5px;display:block;margin-left:-10px;"><a href="<?php echo site_url('stock'); ?>"><i class="fa fa-angle-double-right"></i> Retur Hasil Penjualan</a></li>
                                <li style="list-style:none;padding: 5px 5px 5px 5px;display:block;margin-left:-10px;"><a href="<?php echo site_url('stockcustomer'); ?>"><i class="fa fa-angle-double-right"></i> Retur Penjualan</a></li>
								<li style="list-style:none;padding: 5px 5px 5px 5px;display:block;margin-left:-10px;"><a href="<?php echo site_url('stockcustomer'); ?>"><i class="fa fa-angle-double-right"></i> Retur Pembelian</a></li>
                            </ul>										
								
								
								</li>
								
                            </ul>
                        </li>
                        <li class="treeview">
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
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-th"></i>
                                <span>Inventory</span>
                                <i class="fa fa-angle-left pull-right"></i>
                                <small class="badge pull-right bg-green">4</small>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="<?php echo site_url('receiving'); ?>"><i class="fa fa-angle-double-right"></i> Item Receiving</a></li>
                                <li><a href="<?php echo site_url('inventory'); ?>"><i class="fa fa-angle-double-right"></i> Stock</a></li>
                                <li><a href="<?php echo site_url('inventory_customer'); ?>"><i class="fa fa-angle-double-right"></i> Stock Customer</a></li>
                                <li><a href="javascript:void(0);"><i class="fa fa-angle-double-right"></i> Opname</a>
                                <ul>
                                <li style="list-style:none;padding: 5px 5px 5px 5px;display:block;margin-left:-10px;"><a href="<?php echo site_url('opname'); ?>"><i class="fa fa-angle-double-right"></i> Stock</a></li>
                                <li style="list-style:none;padding: 5px 5px 5px 5px;display:block;margin-left:-10px;"><a href="<?php echo site_url('opnamecustomer'); ?>"><i class="fa fa-angle-double-right"></i> Stock Customer</a></li>
                                </ul>
                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-book"></i>
                                <span>Accounting</span>
                                <i class="fa fa-angle-left pull-right"></i>
                                <small class="badge pull-right bg-blue">5</small>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="<?php echo site_url('coa'); ?>"><i class="fa fa-angle-double-right"></i> Chart of Account</a></li>
                                <li><a href="<?php echo site_url('trialbalance'); ?>"><i class="fa fa-angle-double-right"></i> Trial Balance</a></li>
                                <li><a href="<?php echo site_url('generalledger'); ?>"><i class="fa fa-angle-double-right"></i> General Ledger</a></li>
                                <li><a href="<?php echo site_url('journal'); ?>"><i class="fa fa-angle-double-right"></i> Journal</a></li>
                                <li><a href="<?php echo site_url('closingperiod'); ?>"><i class="fa fa-angle-double-right"></i> Closing Period</a></li>
                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-money"></i>
                                <span>Report</span>
                                <i class="fa fa-angle-left pull-right"></i>
                                <small class="badge pull-right bg-red">1</small>
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
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-print"></i>
                                <span>Print</span>
                                <i class="fa fa-angle-left pull-right"></i>
                                <small class="badge pull-right bg-green">3</small>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="<?php echo site_url('kwitansi'); ?>"><i class="fa fa-angle-double-right"></i> Kwitansi</a></li>
                                <li><a href="<?php echo site_url('faktur'); ?>"><i class="fa fa-angle-double-right"></i> Faktur</a></li>
                                <li><a href="<?php echo site_url('letter'); ?>"><i class="fa fa-angle-double-right"></i> Letter</a></li>
                            </ul>
                        </li>
                        <li class="treeview">
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
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-group"></i>
                                <span>Users</span>
                                <i class="fa fa-angle-left pull-right"></i>
                                <small class="badge pull-right bg-yellow">2</small>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="<?php echo site_url('users'); ?>"><i class="fa fa-angle-double-right"></i> Users</a></li>
                                <li><a href="<?php echo site_url('users/users_group'); ?>"><i class="fa fa-angle-double-right"></i> Users Group</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="<?php echo site_url('login/logout'); ?>" onclick="return confirm('<?php echo $this -> memcachedlib -> sesresult['uemail']; ?>, are you sure you want to logout?');">
                                <i class="fa fa-sign-in"></i> <span>Logout</span>
                            </a>
                        </li>
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>
