
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
        <h2 style="margin-top:0px">Features <?php echo $button ?></h2>
        <div class="col-md-7">
     <?php echo form_open($action);?>
	    <div class="form-group">
            <label for="varchar">Title Features <?php echo form_error('title_features') ?></label>
            <input type="text" class="form-control" name="title_features" id="title_features" placeholder="Title Features" value="<?php echo $title_features; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Desc Features <?php echo form_error('desc_features') ?></label>
            <input type="text" class="form-control" name="desc_features" id="desc_features" placeholder="Desc Features" value="<?php echo $desc_features; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Icon Features <?php echo form_error('icon_features') ?></label>
            <input type="text" class="form-control" name="icon_features" id="icon_features" placeholder="Icon Features" value="<?php echo $icon_features; ?>" />
        </div>
	    <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('plugin/features') ?>" class="btn btn-default">Cancel</a>
      </div>
	<?php echo form_close();?>
 </div>
   </div>
        </section>
</div>