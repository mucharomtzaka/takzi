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
            <h2 style="margin-top:0px">Categoriespost Read</h2>
          <div class="table-responsive col-sm-3">
                <table class="table table-bordered table-hover">
        	    <tr>
                <td>Kategories Title</td>
                <td colspan="3">:</td>
                <td><?php echo $kategories_title; ?></td>
                </tr>
        	    <tr>
                <td>Kategories Description</td>
                  <td colspan="3">:</td>
                <td><?php echo $kategories_description; ?></td
                ></tr>
        	 	</table>
    </div>
    <a href="<?php echo site_url('categoriespost') ?>" class="btn btn-default">Cancel</a>
    </div>
    </div>
    </section>
</div>
       