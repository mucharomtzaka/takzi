
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
        <h2 style="margin-top:0px">Slideshow <?php echo $button ?></h2>
     <?php echo form_open_multipart($action);?>
	    <div class="form-group col-md-6">
       <label for="varchar">Image Front <?php echo form_error('image_front') ?></label>
      <?php if($image_front==''){?>
             <image src="<?php echo base_url('bootasset/uploadImages/logo.png');?>" id="output1" width="150" height="150"></image>
      <?php }else{?>
            <image src="<?php echo base_url('bootasset/uploadImages/slider');?>/<?php  echo $image_front;?>" id="output1" width="150" height="150"></image>
      <?php } ?>
           
            <input type="file" name="image_front" id="image_front" class="form-control"  onchange="document.getElementById('output1').src = window.URL.createObjectURL(this.files[0])">
        </div>
	    <div class="form-group col-md-6">
       <label for="varchar">Image Back <?php echo form_error('image_back') ?></label>
      <?php if($image_back==''){?>
            <image src="<?php echo base_url('bootasset/uploadImages/logo.png');?>" id="output2" width="150" height="150"></image>
        <?php }else{?>
         <image src="<?php echo base_url('bootasset/uploadImages/slider');?>/<?php  echo $image_back;?>" id="output2" width="150" height="150"></image>
      <?php } ?> 
           
            <input type="file" name="image_back" id="image_back" class="form-control"  onchange="document.getElementById('output2').src = window.URL.createObjectURL(this.files[0])">
                      
        </div>
	    <div class="form-group col-md-12">
            <label for="description">Description <?php echo form_error('description') ?></label>
            <textarea class="form-control textarea" rows="10" name="description" id="description" placeholder="Description"><?php echo $description; ?></textarea>
            <span class="glyphicon glyphicon-edit form-control-feedback"></span>
        </div>
	    <div class="form-group col-md-2">
            <label for="tinyint">Active <?php echo form_error('active') ?></label>
            <select name="active" class="form-control">
           <?php if($active =='1'){ ?>
              <option value="1" selected>Active</option>
           <?php }else{ ?>
             <option value="0" selected>Deactive</option>
           <?php } ?>
          <option> ------------------------------</option>
            <option value="1" >Active</option>
            <option value="0" >Deactive</option>
            </select>
        </div>
	    <div class="body-footer  col-md-2">
      <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
      <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
      <a href="<?php echo site_url('plugin/slideshow') ?>" class="btn btn-default">Cancel</a>
      </div>
	<?php echo form_close();?>
 </div>
   </div>
        </section>
</div>