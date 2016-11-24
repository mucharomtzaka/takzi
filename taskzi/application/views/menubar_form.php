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
               <h2 style="margin-top:0px">Menubar <?php echo $button ?></h2>  
         <div class="row">
          <div class="col-sm-5">
           <?php echo form_open_multipart( $action);?>
	    <div class="form-group">
            <label for="varchar">Menu <?php echo form_error('menu') ?></label>
            <input type="text" class="form-control" name="menu" id="menu" placeholder="Menu" value="<?php echo $menu; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Menu Link <?php echo form_error('menu_link') ?></label>
            <input type="text" class="form-control" name="menu_link" id="menu_link" placeholder="Menu Link" value="<?php echo $menu_link; ?>" />
        </div>
	    <input type="hidden" name="menu_id" value="<?php echo $menu_id; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('menubar') ?>" class="btn btn-default">Cancel</a>
	   <?php echo form_close();?>
       </div>
      </div>
   </div>
        </section>
</div>