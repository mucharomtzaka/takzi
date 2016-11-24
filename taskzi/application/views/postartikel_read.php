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
        <h2 style="margin-top:0px">Postartikel Read</h2>
         <div class="table-responsive col-sm-5">
        <table class="table table-bordered table-hover text-center ">
	    <tr><td>Article Title</td><td><?php echo $article_title; ?></td></tr>
	    <tr><td>Article Description</td><td><?php echo $article_description; ?></td></tr>
	    <tr><td>Date</td><td><?php echo $Date; ?></td></tr>
	    <tr><td>Image</td><td><?php echo $Image; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('postartikel') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
  </div>
  </div>
        </div>
        </section>
</div>