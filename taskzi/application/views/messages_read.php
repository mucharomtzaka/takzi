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
        <h2 style="margin-top:0px">Messages Read</h2>
        <table class="table">
	    <tr><td>Nameuser</td><td><?php echo $nameuser; ?></td></tr>
	    <tr><td>Emailuser</td><td><?php echo $emailuser; ?></td></tr>
	    <tr><td>Phoneuser</td><td><?php echo $phoneuser; ?></td></tr>
	    <tr><td>Companyuser</td><td><?php echo $companyuser; ?></td></tr>
	    <tr><td>Subject</td><td><?php echo $subject; ?></td></tr>
	    <tr><td>Message</td><td><?php echo $message; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('plugin/messages') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
       </div>
   </div>
        </section>
</div>