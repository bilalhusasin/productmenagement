<!DOCTYPE html>
<html>
<head>
    <title><?php echo $title; ?></title>
    <base href="<?php echo base_url(); ?>" />
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="Devs Palace" />
    <meta name="description" content="" />
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="shortcut icon" href="assets/images/favicon.png" type="image/x-icon" />
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="assets/adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="assets/adminlte/bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <!-- <link rel="stylesheet" href="assets/adminlte/bower_components/Ionicons/css/ionicons.min.css"> -->
    <!-- Theme style -->
    <link rel="stylesheet" href="assets/adminlte/dist/css/AdminLTE.min.css">
    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<!-- END HEAD -->

<!-- BEGIN BODY -->
<body class="hold-transition login-page">
    <div class="login-box">
        <!-- BEGIN LOGO -->
        <div class="login-logo" href="">
            <img class="center" alt="logo" src="assets/images/logo.png" width="250">
        </div>
        <!-- END LOGO -->
        <div class="login-box-body">
            <p class="login-box-msg">Forget Password</p>
            <?php $this->load->view('flash_message'); ?>

            <form id="frmForgot" action="auth/forgot-password" method="post">
                <div class="form-group has-feedback">
                    <input type="text" name="email" id="email" class="form-control" placeholder="Email">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                <div class="row">
                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
                    <div class="col-md-12">
                        <button type="submit" name="submit" class="btn btn-primary btn-block btn-flat">Send Reset Link</button>
                    </div>
                </div>
            </form>
            <div class="login-footer">
                <div class="forgot-hint pull-right">
                    <a id="forget-password" class="" href="">Go Back.</a>
                </div>
                <div class="forgot-hint pull-left">
                    <strong>Software Version: <?php echo $version; ?></strong>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery 3.3.1 -->
    <script src="assets/adminlte/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="assets/adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
</body>
<!-- END BODY -->
</html>