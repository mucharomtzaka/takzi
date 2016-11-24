<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $header_title;?> Blog</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <meta keyword="<?php echo $meta_title;?>" name="keyword">
  <meta description="<?php echo $meta_title;?>" name="description">
  <meta property="og:title" content="<?php echo $header_title;?>">
  <meta property="og:url" content="<?php echo base_url();?>">
  <meta property="og:image" content="<?php echo base_url('bootasset');?>/<?php echo $image_favicon;?>">
  <meta property="og:description" content="<?php echo $meta_title;?>">
  <meta property="og:site_name" content="<?php echo $header_title;?>">
  <meta property="fb:admins" content="1475630092715743">

    <link href="<?php echo base_url('bootasset/uploadImages');?>/<?php echo $image_favicon;?>" rel="shortcut icon" type="image/vnd.microsoft.icon" />
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo base_url('bootstrap/css/bootstrap.min.css');?>">
  <link rel="stylesheet" href="<?php echo base_url('bootstrap/css/ionicons.min.css');?>">
  <link rel="stylesheet" href="<?php echo base_url('bootstrap/css/font-awesome.min.css');?>">
  <!-- Font Awesome -->
<!--   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  Ionicons
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css"> -->
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url('dist/css/AdminLTE.min.css');?>">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo base_url('plugins/iCheck/square/blue.css');?>">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition login-page" style="background-color: white;">
<div class="login-box">
<div class="box box-success box-solid">
            <div class="box-header with-border">
               <div class="login-logo text-center">
            <a href="<?php echo base_url('auth');?>" class="box-title"><b><?php echo $header_title;?> Login </b></a>
            <a class="navbar-brand" href="<?php echo base_url();?>"><img src="<?php echo base_url('bootasset/uploadImages');?>/<?php echo $backgrounds;?>" alt="logo" width="300"></a>
              </div>
        </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">
        <?php echo $message;?>
    </p>

    <?php echo form_open("auth/login");?>
      <div class="form-group has-feedback">
        <input type="email" class="form-control" placeholder="Email" name="identity">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Password"  name="password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox" checked> Remember Me
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat"><i class="fa fa-sign-in"></i>Sign In</button>
        </div>
        <!-- /.col -->
      </div>
   <?php echo form_close();?>

    <a href="forgot_password"><?php echo lang('login_forgot_password');?></a><br>
    <a href="<?php echo base_url('welcome/register');?>">Register New User </a>|
    <a href="<?php echo base_url();?>">Halaman Front User </a><br>

  </div>
</div>
</div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 2.2.3 -->
<script src="<?php echo base_url('plugins/jQuery/jquery-2.2.3.min.js');?>"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo base_url('bootstrap/js/bootstrap.min.js');?>"></script>
<!-- iCheck -->
<script src="<?php echo base_url('plugins/iCheck/icheck.min.js');?>"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
</body>
</html>
