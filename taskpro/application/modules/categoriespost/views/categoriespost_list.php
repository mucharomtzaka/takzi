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
         <h2 style="margin-top:0px">Categoriespost List</h2>
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <?php echo anchor(site_url('categoriespost/create'),'Create', 'class="btn btn-primary"'); ?>
            </div>
            <div class="col-md-4 text-center">
               <?php if($message){?>
              <div class="span4 offset4 alert alert-info text-center"><button type="button" class="close" data-dismiss="alert"><i class="fa fa-times"></i></button>
                 <p><?php echo $message;?></p>
              </div>
              <?php } ?>
            </div>
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right">
                <form action="<?php echo site_url('categoriespost/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('categoriespost'); ?>" class="btn btn-default">Reset</a>
                                    <?php
                                }
                            ?>
                          <button class="btn btn-primary" type="submit">Search</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
          <div class="table-responsive">
        <table class="table table-bordered table-hover text-center ">
            <tr>
                <th>No</th>
		<th>Kategories Title</th>
		<th>Kategories Description</th>
		<th colspan="3">Action</th>
            </tr><?php
            foreach ($categoriespost_data as $categoriespost)
            {
                ?>
                <tr>
			<td width="80px"><?php echo ++$start ?></td>
			<td><?php echo $categoriespost->kategories_title ?></td>
			<td><?php echo $categoriespost->kategories_description ?></td>
			<td><i class="fa fa-edit"></i><?php echo anchor("categoriespost/update/".$categoriespost->categories_id, 'Edit','class=" btn btn-info" ') ;?></td>
        <td><i class="fa fa-remove"></i><?php echo anchor("categoriespost/delete/".$categoriespost->categories_id, 'Delete','class=" btn btn-info" ') ;?></td>
          <td><i class="fa fa-list"></i><?php echo anchor("categoriespost/read/".$categoriespost->categories_id, 'Read','class=" btn btn-info" ','onclick="javasciprt: return confirm(\'Are You Sure ?\')"') ;?></td>

		</tr>
                <?php
            }
            ?>
        </table>
        </div>
        <div class="row">
            <div class="col-md-6">
                <a href="#" class="btn btn-primary">Total Record : <?php echo $total_rows ?></a>
	    </div>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
            </div>
        </div>
        </div>
        </section>
</div>
