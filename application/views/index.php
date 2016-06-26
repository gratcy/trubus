            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Dashboard
                        <small>Control panel</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Dashboard</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
					<div class="row">
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-aqua">
                                <div class="inner">
                                    <h3>
                                        <?php echo $total['order'];?>
                                    </h3>
                                    <p>
                                        New Orders
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-bag"></i>
                                </div>
                                <a href="<?php echo site_url('penjualan_kredit'); ?>" title="Today Order Total" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-yellow">
                                <div class="inner">
                                    <h3>
                                        <?php echo $total['customer'];?>
                                    </h3>
                                    <p>
                                        Customer
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-person-add"></i>
                                </div>
                                <a href="<?php echo site_url('customer'); ?>" title="Customer Total" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-green">
                                <div class="inner">
                                    <h3>
                                        <?php echo $total['books'];?>
                                    </h3>
                                    <p>
                                        Books
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-android-book"></i>
                                </div>
                                <a href="<?php echo site_url('books'); ?>" title="Books Total" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-red">
                                <div class="inner">
                                    <h3>
                                        <?php echo $total['stock'];?>
                                    </h3>
                                    <p>
                                        Current Stock
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-social-buffer"></i>
                                </div>
                                <a href="<?php echo site_url('inventory'); ?>" title="Stock Total" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                    </div>
                    <div class="box" style="padding:5px;">
					<p>Selamat Datang <b><?php echo $this -> memcachedlib -> sesresult['uemail']; ?></b> Di Sistem Inventory PT. NIAGA SWADAYA.</p>
					<p>*) Disaranakan Menggunakan Tidak Menggunakan Internet Explorer</p>
                </div>
                </section>
            </aside><!-- /.right-side -->
