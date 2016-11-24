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
        <h2 style="margin-top:0px">Submenubar <?php echo $button ?></h2>
        <div class="row">
              <?php echo form_open_multipart( $action);?>
        <div class="col-md-5">

	    <div class="form-group">
            <label for="varchar">Submenu <?php echo form_error('submenu') ?></label>
            <input type="text" class="form-control" name="submenu" id="submenu" placeholder="Submenu" value="<?php echo $submenu; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Menu Id <?php echo form_error('menu_id') ?></label>
            <input type="text" class="form-control" name="menu_id" id="menu_id" placeholder="Menu Id" value="<?php echo $menu_id; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Submenu Link <?php echo form_error('submenu_link') ?></label>
            <input type="text" class="form-control" name="submenu_link" id="submenu_link" placeholder="Submenu Link" value="<?php echo $submenu_link; ?>" />
        </div>
        </div>
        <div class="col-md-2">
         <div class="form-group">
        <label for="varchar">List Menu Id </label>
             <select name="listmenuid" id="listmenuid" class="form-control">
                <?php foreach ($group_menubar as $key ) { ?>
                <option value="<?php echo $key->menu_id;?>"> <?php echo $key->menu;?></option>
                <?php }?>
            </select>
            </div>
        </div>
        </div>
	    <input type="hidden" name="submenu_id" value="<?php echo $submenu_id; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	   <a href="<?php echo site_url('postartikel') ?>" class="btn btn-default">Cancel</a>
       <?php echo form_close();?>
       </div>
      </div>
   </div>
        </section>
</div>