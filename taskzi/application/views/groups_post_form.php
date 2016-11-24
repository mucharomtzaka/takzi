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
         <div class="box-body ">
          <h2 style="margin-top:0px">Groups_post <?php echo $button ?></h2>
         <div class="row">
               <?php echo form_open_multipart( $action);?>
         <div class="col-md-3">
	    <div class="form-group">
            <label for="mediumint">Categories Id <?php echo form_error('categories_id') ?></label>
            <input type="text" class="form-control" name="categories_id" id="categories_id" placeholder="Categories Id" value="<?php echo $categories_id; ?>" />
           
        </div>
	    <div class="form-group">
            <label for="mediumint">Article Id <?php echo form_error('article_id') ?></label>
            <input type="text" class="form-control" name="article_id" id="article_id" placeholder="Article Id" value="<?php echo $article_id; ?>" />
        </div>
        </div>
        <div class="col-md-3">
         <div class="form-group">
         <label for="mediumint">Categories List</label>
             <select name="listcategori" id="listcategori" class="form-control">
                <?php foreach ($group_categori as $key ) { ?>
                <option value="<?php echo $key->categories_id;?>"> <?php echo $key->kategories_title;?></option>
                <?php }?>
            </select>
            </div>

            <div class="form-group">
         <label for="mediumint">Article List</label>
             <select name="articlelist" id="articlelist" class="form-control">
                <?php foreach ($group_artikel as $key ) { ?>
                <option value="<?php echo $key->article_id;?>"> <?php echo $key->article_title;?></option>
                <?php }?>
            </select>
            </div>
        </div>
        </div>
        </div>
	    <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('groups_post') ?>" class="btn btn-default">Cancel</a>
 <?php echo form_close();?>
       </div>
      </div>
   </div>
        </section>
</div>
