<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>PT. Niaga Swadaya</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        <link href="<?php echo site_url('application/views/assets/css/bootstrap.css'); ?>" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="<?php echo site_url('application/views/assets/css/font-awesome.min.css'); ?>" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="<?php echo site_url('application/views/assets/css/ionicons.min.css'); ?>" rel="stylesheet" type="text/css" />
        <!-- jvectormap -->
        <link href="<?php echo site_url('application/views/assets/css/jquery-ui.css'); ?>" rel="stylesheet" type="text/css" />
        <!-- Daterange picker -->
        <link href="<?php echo site_url('application/views/assets/css/daterangepicker/daterangepicker-bs3.css'); ?>" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
		<link rel="stylesheet" href="<?php echo site_url('application/views/assets/chosen/chosen.min.css'); ?>">
        <link href="<?php echo site_url('application/views/assets/css/AdminLTE.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo site_url('application/views/assets/css/suggestions.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo site_url('application/views/assets/plugins/datepicker/css/datepicker.css'); ?>" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" type="text/css" href="<?php echo site_url('application/views/assets/fancybox/fancybox/jquery.fancybox-1.3.4.css'); ?>" media="screen" />
		<link rel="icon" type="image/png" href="<?php echo site_url('application/views/assets/img/favico.png'); ?>">

        <!-- jQuery 2.0.2 -->
        <script src="<?php echo site_url('application/views/assets/js/jquery.min.js'); ?>"></script>
        <script src="<?php echo site_url('application/views/assets/plugins/datepicker/js/bootstrap-datepicker.js'); ?>" type="text/javascript"></script>
		<script type="text/javascript" src="<?php echo site_url('application/views/assets/fancybox/fancybox/jquery.mousewheel-3.0.4.pack.js'); ?>"></script>
		<script type="text/javascript" src="<?php echo site_url('application/views/assets/fancybox/fancybox/jquery.fancybox-1.3.4.pack.js'); ?>"></script>
		<link rel="stylesheet" type="text/css" href="<?php echo site_url('application/views/assets/dataTables/jquery.dataTables.min.css'); ?>">
		<script src="<?php echo site_url('application/views/assets/dataTables/jquery.dataTables.js'); ?>" type="text/javascript"></script>
		<link rel="stylesheet" type="text/css" href="<?php echo site_url('application/views/assets/dataTables/dataTables.bootstrap.css'); ?>">
		<script src="<?php echo site_url('application/views/assets/dataTables/dataTables.bootstrap.js'); ?>" type="text/javascript"></script>
        <!-- jQuery UI 1.10.3 -->
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="skin-blue">
        <!-- header logo: style can be found in header.less -->
        <header class="header">
            <a href="<?php echo site_url(); ?>" class="logo">
                <!-- Add the class icon to your logo image or logo icon to add the margining -->
                Niaga Swadaya <img src="<?php echo site_url('application/views/assets/img/logo.png'); ?>" style="float: right;position: absolute;">
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-right">
                    <ul class="nav navbar-nav">
                        <!-- Messages: style can be found in dropdown.less-->
                        <li class="dropdown messages-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-book"></i>
                                <?php echo ($this -> memcachedlib -> get('__new_books', true)['total'] > 0 ? '<span class="label label-warning">'.$this -> memcachedlib -> get('__new_books', true)['total'].'</span>' : ''); ?>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header">There is <?php echo ($this -> memcachedlib -> get('__new_books', true)['total'] ? $this -> memcachedlib -> get('__new_books', true)['total'] : 0); ?> new books!</li>
                                <li class="footer"><a href="<?php echo site_url('books'); ?>">See New Books</a></li>
                            </ul>
                        </li>
                        <li class="dropdown messages-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-envelope"></i>
                                <?php echo (__get_total_new_pm($this -> memcachedlib -> sesresult['uid']) > 0 ? '<span class="label label-success">'.__get_total_new_pm($this -> memcachedlib -> sesresult['uid']).'</span>' : ''); ?>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header">You have <?php echo __get_total_new_pm($this -> memcachedlib -> sesresult['uid']); ?> new messages</li>
                                <?php echo __get_new_pm($this -> memcachedlib -> sesresult['uid']); ?>
                                <li class="footer"><a href="<?php echo site_url('pm'); ?>">See All Messages</a></li>
                            </ul>
                        </li>
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="glyphicon glyphicon-user"></i>
                                <span><?php echo $this -> memcachedlib -> sesresult['uemail']; ?> <i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header bg-light-blue">
                                    <p>
                                        <?php echo $this -> memcachedlib -> sesresult['uemail']; ?> - <?php echo $this -> memcachedlib -> sesresult['ubranch']; ?>
                                        <small>Login, <?php echo date('d/m/Y H:i:s',$this -> memcachedlib -> sesresult['ldate']); ?></small>
                                    </p>
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="<?php echo site_url('settings'); ?>" class="btn btn-default btn-flat">Profile</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="<?php echo site_url('login/logout'); ?>" class="btn btn-default btn-flat" onclick="return confirm('<?php echo $this -> memcachedlib -> sesresult['uemail']; ?>, are you sure you want to logout?');">Sign out</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <div class="wrapper row-offcanvas row-offcanvas-left">
