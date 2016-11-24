
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
        <h2 style="margin-top:0px">Portofolio <?php echo $button ?></h2>
     <?php echo form_open_multipart($action);?>
	    <div class="form-group">
            <label for="varchar">Title Porto <?php echo form_error('title_porto') ?></label>
            <input type="text" class="form-control" name="title_porto" id="title_porto" placeholder="Title Porto" value="<?php echo $title_porto; ?>" />
        </div>
	    <div class="form-group">
            <label for="desc_porto">Desc Porto <?php echo form_error('desc_porto') ?></label>
            <textarea class="form-control textarea" rows="10" name="desc_porto" id="desc_porto" placeholder="Desc Porto"><?php echo $desc_porto; ?></textarea>
        </div>
        <div class="col-md-4">
	    <div class="form-group">
            <?php if($image_porto==''){?>
             <image src="<?php echo base_url('bootasset/uploadImages/logo.png');?>" id="output2" width="150" height="150"></image>
           <?php }else{?>
            <image src="<?php echo base_url('bootasset/uploadImages/portfolio');?>/<?php echo $image_porto;?>" id="output2" width="150" height="150"></image>
              <?php } ?>
            <label for="varchar">Image Porto <?php echo form_error('image_porto') ?></label>
            <input type="file" class="form-control" name="image_porto" id="image_porto" placeholder="Image Porto"onchange="document.getElementById('output2').src = window.URL.createObjectURL(this.files[0])"/>
        </div>
        </div>
	    <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('plugin/portofolio') ?>" class="btn btn-default">Cancel</a>
	<?php echo form_close();?>
 </div>
   </div>
        </section>
</div>