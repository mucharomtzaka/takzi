
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
           <h2 style="margin-top:0px">Groups_portfolio <?php echo $button ?></h2>
         <div class="row">
                 <div class="col-md-2">
                
                <?php echo form_open($action);?>
        	    <div class="form-group">
                    <label for="int">Id Categories <?php echo form_error('id_categories') ?></label>
                    <input type="text" class="form-control" name="id_categories" id="id_categories" placeholder="Id Categories" value="<?php echo $id_categories; ?>" />
                </div>
        	    <div class="form-group">
                    <label for="int">Id Porto <?php echo form_error('id_porto') ?></label>
                    <input type="text" class="form-control" name="id_porto" id="id_porto" placeholder="Id Porto" value="<?php echo $id_porto; ?>" />
                </div>
              </div>
              <div class="col-md-5">
                 <div class="form-group">
                  <label for="mediumint">Categories List</label>
                   <select name="listcategori" id="listcategori" class="form-control">
                      <?php foreach ($group_categori as $key ) { ?>
                      <option value="<?php echo $key->categories_id;?>"> <?php echo $key->kategories_title;?></option>
                      <?php }?>
                  </select>
                  </div>
                  <div class="form-group">
                  <label for="mediumint">Portofolio List</label>
                   <select name="listporto" id="listporto" class="form-control">
                      <?php foreach ($group_portfolio as $key ) { ?>
                      <option value="<?php echo $key->id;?>"> <?php echo $key->title_porto;?></option>
                      <?php }?>
                  </select>
                  </div>
            </div>
        
        </div>
      </div>
	    <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('plugin/groups_portfolio') ?>" class="btn btn-default">Cancel</a>
	<?php echo form_close();?>
 </div>
   </div>
        </section>
</div>