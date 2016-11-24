
   <div class="content-wrapper">
   <section class="content">
    <div class="box">
 <div class="box-header with-border">
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
         <div class="box-body">
        <h2 style="margin-top:0px">Messages <?php echo $button ?></h2>
        <div class="col-md-5">
     <?php echo form_open($action);?>
	    <div class="form-group">
            <label for="varchar">Nameuser <?php echo form_error('nameuser') ?></label>
            <input type="text" class="form-control" name="nameuser" id="nameuser" placeholder="Nameuser" value="<?php echo $nameuser; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Emailuser <?php echo form_error('emailuser') ?></label>
            <input type="text" class="form-control" name="emailuser" id="emailuser" placeholder="Emailuser" value="<?php echo $emailuser; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Phoneuser <?php echo form_error('phoneuser') ?></label>
            <input type="text" class="form-control" name="phoneuser" id="phoneuser" placeholder="Phoneuser" value="<?php echo $phoneuser; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Companyuser <?php echo form_error('companyuser') ?></label>
            <input type="text" class="form-control" name="companyuser" id="companyuser" placeholder="Companyuser" value="<?php echo $companyuser; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Subject <?php echo form_error('subject') ?></label>
            <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" value="<?php echo $subject; ?>" />
        </div>
	    <div class="form-group">
            <label for="message">Message <?php echo form_error('message') ?></label>
            <textarea class="form-control" rows="3" name="message" id="message" placeholder="Message"><?php echo $message; ?></textarea>
        </div>
	    <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('plugin/messages') ?>" class="btn btn-default">Cancel</a>
      </div>
	<?php echo form_close();?>
 </div>
   </div>
        </section>
</div>