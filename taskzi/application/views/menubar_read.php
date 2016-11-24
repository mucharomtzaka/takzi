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
        <h2 style="margin-top:0px">Menubar Read</h2>
        <table class="table">
	    <tr><td>Menu</td><td><?php echo $menu; ?></td></tr>
	    <tr><td>Menu Link</td><td><?php echo $menu_link; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('menubar') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
   </div>
  </div>
        </div>
        </section>
</div>