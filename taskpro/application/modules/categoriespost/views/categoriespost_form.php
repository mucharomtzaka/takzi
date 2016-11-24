 <div class="content-wrapper">
   <section class="content">
        <h2 style="margin-top:0px">Categoriespost <?php echo $button ?></h2>
     <?php echo form_open($action);?>
	    <div class="form-group">
            <label for="varchar">Kategories Title <?php echo form_error('kategories_title') ?></label>
            <input type="text" class="form-control" name="kategories_title" id="kategories_title" placeholder="Kategories Title" value="<?php echo $kategories_title; ?>" />
        </div>
	    <div class="form-group">
            <label for="kategories_description">Kategories Description <?php echo form_error('kategories_description') ?></label>
            <textarea class="form-control" rows="3" name="kategories_description" id="kategories_description" placeholder="Kategories Description"><?php echo $kategories_description; ?></textarea>
        </div>
	    <input type="hidden" name="categories_id" value="<?php echo $categories_id; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('categoriespost') ?>" class="btn btn-default">Cancel</a>
        <?php echo form_close();?>
    </section>
    </div>

