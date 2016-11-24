<section id="blog" class="container">
<h1><?php echo $title;?></h1>
        <p><?php echo lang('edit_user_subheading');?></p>
  <div class="container">
  <div class="left">
        <div id="infoMessage"><?php echo $message;?></div>
        <?php echo form_open(uri_string());?>
        <div class="form-horizontal">
        <div class="col-md-4">
               <p>
            <?php echo lang('edit_user_fname_label', 'first_name');?> <br />
            <?php echo form_input($first_name);?>
      </p>

      <p>
            <?php echo lang('edit_user_lname_label', 'last_name');?> <br />
            <?php echo form_input($last_name);?>
      </p>

      <p>
            <?php echo lang('edit_user_company_label', 'company');?> <br />
            <?php echo form_input($company);?>
      </p>

      <p>
            <?php echo lang('edit_user_phone_label', 'phone');?> <br />
            <?php echo form_input($phone);?>
      </p>

      <p>
            <?php echo lang('edit_user_password_label', 'password');?> <br />
            <?php echo form_input($password);?>
      </p>

      <p>
            <?php echo lang('edit_user_password_confirm_label', 'password_confirm');?><br />
            <?php echo form_input($password_confirm);?>
      </p>
        </div>

        <div class="col-md-4">
          <?php if ($this->ion_auth->logged_in()||$this->ion_auth->is_admin()): ?>

    <!--       <h3><?php echo lang('edit_user_groups_heading');?></h3> -->
          <?php foreach ($groups as $group):?>
              <!-- <label class="checkbox">
              <?php
                  $gID=$group['id'];
                  $checked = null;
                  $item = null;
                  foreach($currentGroups as $grp) {
                      if ($gID == $grp->id) {
                          $checked= ' checked="checked"';
                      break;
                      }
                  }
              ?> -->
              <input type="hidden" name="groups[]"  class="form-contro-checbox" disabled value="<?php echo $group['id'];?>"<?php echo $checked;?> >
           <!--    <?php echo htmlspecialchars($group['name'],ENT_QUOTES,'UTF-8');?> -->
           <!--    </label> -->
          <?php endforeach?>

      <?php endif ?>
      <button type="submit" class="btn btn-primary"><i class="fa fa-save"> </i><?php echo 'Update';?></button></p>
        <?php echo form_close();?>
          <p> <a href="javascript:history.go(-1);" class="btn btn-warning"><i class="fa fa-arrow-left"> </i> Back</a></p>
        </div>

      <?php echo form_hidden('id', $user->id);?>
      <?php echo form_hidden($csrf); ?>

      </div>

      </div>
      </div>
</section>