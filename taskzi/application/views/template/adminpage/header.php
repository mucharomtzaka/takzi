<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title> <?php echo $header_title;?> Blog</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <meta keyword="<?php echo $meta_title;?>" name="keyword">
  <meta description="<?php echo $meta_title;?>" name="description">
  <meta property="og:title" content="<?php echo $header_title;?>">
  <meta property="og:url" content="<?php echo base_url();?>">
  <meta property="og:image" content="<?php echo base_url('bootasset/uploadImages');?>/<?php echo $image_favicon;?>">
  <meta property="og:description" content="<?php echo $meta_title;?>">
  <meta property="og:site_name" content="<?php echo $header_title;?>">
  <meta property="fb:admins" content="1475630092715743">
    <link href="<?php echo base_url('bootasset/uploadImages');?>/<?php echo $image_favicon;?>" rel="shortcut icon" type="image/vnd.microsoft.icon" />
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo base_url('bootstrap/css/bootstrap.css');?>">
  <link rel="stylesheet" href="<?php echo base_url('bootstrap/css/ionicons.min.css');?>">
  <link rel="stylesheet" href="<?php echo base_url('bootstrap/css/font-awesome.min.css');?>">
  <link rel="stylesheet" href="<?php echo base_url('dist/css/AdminLTE.min.css');?>">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url('dist/css/skins/_all-skins.min.css');?>">
  <link rel="stylesheet" href="<?php echo base_url('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css');?>">

<body class="hold-transition <?php echo $themes;?>  sidebar-collapse sidebar-mini">
<div class="wrapper">