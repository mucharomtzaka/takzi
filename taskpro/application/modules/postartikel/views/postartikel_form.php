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
           <h2 style="margin-top:0px">Postartikel <?php echo $button ?></h2>
         <div class="row">
           <?php echo form_open_multipart( $action);?>
         <div class="col-sm-5">
           
        <div class="form-group">
        <label for="varchar">Article Title <?php echo form_error('article_title') ?></label>
        <input type="text" class="form-control" name="article_title" id="article_title" placeholder="Article Title" value="<?php echo $article_title; ?>"/>
        </div>
         <div class="form-group">
         <?php if($Image ==''){?>
          <image src="<?php echo base_url('bootasset/uploadImages');?>/logo.png" id="output3" width="150" height="150"></image>
         <?php }else{?>
             <image src="<?php echo base_url('bootasset/uploadImages');?>/<?php echo $Image;?>" id="output3" width="150" height="150"></image>
          <?php } ?>
            <label for="varchar">Image </label>
            <input type="file" name="Image" class="form-control" onchange="document.getElementById('output3').src = window.URL.createObjectURL(this.files[0])">
        </div>
        
        <div class="form-group">
            <label for="date">Date <?php echo form_error('Date') ?></label>
            <input type="date" class="form-control" name="Date" id="Date" placeholder="Date" value="<?php echo $Date; ?>" />
        </div>
         </div>
         <div class="col-sm-5">
             <div class="form-group">
            <label for="article_description">Article Description <?php echo form_error('article_description') ?></label>
            <textarea class="form-control textarea" rows="15" cols="100" name="article_description" id="editor1" placeholder="Article Description"><?php echo $article_description; ?></textarea>
        </div>
         </div>
         </div>
	    <input type="hidden" name="article_id" value="<?php echo $article_id; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('postartikel') ?>" class="btn btn-default">Cancel</a>
	   <?php echo form_close();?>

      </div>
   </div>
        </section>
</div>