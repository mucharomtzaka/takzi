
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
        <h2 style="margin-top:0px">Services <?php echo $button ?></h2>
        <div class="col-md-5">
     <?php echo form_open_multipart($action);?>
	    <div class="form-group">
            <label for="varchar">Title Services <?php echo form_error('title_services') ?></label>
            <input type="text" class="form-control" name="title_services" id="title_services" placeholder="Title Services" value="<?php echo $title_services; ?>" />
        </div>
	    <div class="form-group">
            <label for="tinytext">Desc Services <?php echo form_error('desc_services') ?></label>
            <input type="text" class="form-control" name="desc_services" id="desc_services" placeholder="Desc Services" value="<?php echo $desc_services; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Icon Services <?php echo form_error('icon_services') ?></label>
            <?php if($icon_services==''){?>
            <image src="<?php echo base_url('bootasset/uploadImages/logo.png');?>" id="output2" width="150" height="150"></image>
        <?php }else{?>
             <image src="<?php echo base_url('bootasset/uploadImages/services');?>/<?php  echo $icon_services;?>" id="output2" width="150" height="150"></image>
          <?php } ?> 
            <input type="file" name="icon_services" id="icon_services" class="form-control"  onchange="document.getElementById('output2').src = window.URL.createObjectURL(this.files[0])">                    
        </div>
	    <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('plugin/services') ?>" class="btn btn-default">Cancel</a>
      </div>
	<?php echo form_close();?>
 </div>
   </div>
        </section>
</div>