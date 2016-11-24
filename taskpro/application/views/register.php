<section id="contact-page">
<div class="container">
<?php if($message){?>
              <div class="span4 offset4 alert alert-errors text-center"><button type="button" class="close" data-dismiss="alert"><i class="fa fa-times"></i></button>
                 <p><?php echo $message;?></p>
              </div>
              <?php } ?>
<div class="center">
<p color="red">
Register New User</p>

 <h3 class="box-title">
<p><?php echo lang('create_user_subheading');?></p></h3>
</div>
<div class="row contact-wrap">
<div class="status alert alert-success" style="display: none"></div>
          <?php echo form_open("welcome/register");?>
        <div class="box-body">
        <div class="form-horizontal">
          <div class="row">
            <div class="col-md-5">
                 <p>
            <?php echo lang('create_user_fname_label', 'first_name');?> <br />
            <?php echo form_input($first_name);?>
      </p>

      <p>
            <?php echo lang('create_user_lname_label', 'last_name');?> <br />
            <?php echo form_input($last_name);?>
      </p>
      
      <?php
      if($identity_column!=='email') {
          echo '<p>';
          echo lang('create_user_identity_label', 'identity');
          echo '<br />';
          echo form_error('identity');
          echo form_input($identity,array('class'=>'form-control'));
          echo '</p>';
      }
      ?>

      <p>
            <?php echo lang('create_user_company_label', 'company');?> <br />
            <?php echo form_input($company);?>
      </p>

      <p>
            <?php echo lang('create_user_email_label', 'email');?> <br />
            <?php echo form_input($email);?>
      </p>

      <p>
            <?php echo lang('create_user_phone_label', 'phone');?> <br />
            <?php echo form_input($phone);?>
      </p>

      <p>
            <?php echo lang('create_user_password_label', 'password');?> <br />
            <?php echo form_input($password);?>
      </p>

      <p>
            <?php echo lang('create_user_password_confirm_label', 'password_confirm');?> <br />
            <?php echo form_input($password_confirm);?>
      </p>

            </div>
         <div class="col-md-5">
          <div class="box-footer">
          <p> <button type="submit" class="btn btn-primary"><i class="fa fa-sign-in"> </i><?php echo 'Register';?></button></p>
           <p> <button type="reset" class="btn btn-primary"><i class="fa fa-cancel"> </i><?php echo 'Reset';?></button></p>
             <p> <a href="javascript:history.go(-1);" class="btn btn-warning"><i class="fa fa-arrow-left"> </i> Back</a></p>
        </div>
        </div>
          </div>
          </div>
        </div>
        <!-- /.box-body -->
       
        <?php echo form_close();?>
        <!-- /.box-footer-->
       
</div> 
</div> 
</section> 
