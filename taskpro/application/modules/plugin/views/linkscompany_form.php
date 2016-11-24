
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
        <h2 style="margin-top:0px">Linkscompany <?php echo $button ?></h2>
     <?php echo form_open($action);?>
	    <div class="form-group">
            <label for="varchar">Title Link Menu <?php echo form_error('title_link_menu') ?></label>
            <input type="text" class="form-control" name="title_link_menu" id="title_link_menu" placeholder="Title Link Menu" value="<?php echo $title_link_menu; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Desc Link Menu <?php echo form_error('desc_link_menu') ?></label>
            <input type="text" class="form-control" name="desc_link_menu" id="desc_link_menu" placeholder="Desc Link Menu ,example:welcome/blog" value="<?php echo $desc_link_menu; ?>" />
        </div>
	    <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('plugin/linkscompany') ?>" class="btn btn-default">Cancel</a>
	<?php echo form_close();?>
 </div>
   </div>
        </section>
</div>