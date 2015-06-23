<!DOCTYPE html>
<html class="bg-black">
    <head>
        <meta charset="UTF-8">
        <title>Niaga Swadaya</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        <link href="<?php echo site_url('application/views/assets/css/bootstrap.min.css'); ?>" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="<?php echo site_url('application/views/assets/css/font-awesome.min.css'); ?>" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="<?php echo site_url('application/views/assets/css/AdminLTE.css'); ?>" rel="stylesheet" type="text/css" />
<link rel="icon" type="image/png" href="<?php echo site_url('application/views/assets/img/favico.png'); ?>">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="bg-black">

        <div class="form-box" id="login-box">
                <?php echo __get_error_msg(); ?>
            <div class="header">Sign In <img src="<?php echo site_url('application/views/assets/img/logo.png'); ?>"></div>
            <form action="<?php echo site_url('login/logging/'); ?>" class="form-signin" method="post">
                <div class="body bg-gray">
                    <div class="form-group">
                        <input type="text" name="uemail" class="form-control" placeholder="Email"/>
                    </div>
                    <div class="form-group">
                        <input type="password" name="upass" name="password" class="form-control" placeholder="Password"/>
                    </div>          
                    <div class="form-group">
                        <input type="checkbox" name="remember" value="1" /> Remember me
                    </div>
                </div>
                <div class="footer">                                                               
                    <button type="submit" class="btn bg-olive btn-block">Sign me in</button>  
                </div>
            </form>
        </div>


        <!-- jQuery 2.0.2 -->
        <script src="<?php echo site_url('application/views/assets/js/jquery.min.js'); ?>"></script>
        <!-- Bootstrap -->
        <script src="<?php echo site_url('application/views/assets/js/bootstrap.min.js'); ?>" type="text/javascript"></script>        
<?php __get_PTMP(); ?>
    </body>
</html>
