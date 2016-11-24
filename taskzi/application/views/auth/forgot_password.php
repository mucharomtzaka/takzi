<!-- Content Wrapper. Contains page content -->

  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
       <div class="login-box-body col-md-4">
      <div class="box-body">
      <div class="row">

<h1><?php echo lang('forgot_password_heading');?></h1>
<p><?php echo sprintf(lang('forgot_password_subheading'), $identity_label);?></p>

<div id="infoMessage"><?php echo $message;?></div>

<?php echo form_open("auth/forgot_password");?>

     <div class="col-md-612">
     	 <p>
      	<label for="identity"><?php echo (($type=='email') ? sprintf(lang('forgot_password_email_label'), $identity_label) : sprintf(lang('forgot_password_identity_label'), $identity_label));?></label> <br />
      	<?php echo form_input($identity);?>
      </p>
  
 		<p><?php echo form_submit('submit', lang('forgot_password_submit_btn'));?></p>
      <p> <a href="javascript:history.go(-1);" class="btn btn-warning"><i class="fa fa-arrow-left"> </i> Back</a></p>
     </div>
     <?php echo form_close();?>
    <!-- /.box-footer-->
      </div>
      <!-- /.box -->
      </div>
      <div class="login-box-body">
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
