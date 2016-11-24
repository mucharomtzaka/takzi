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
        <h2 style="margin-top:0px">Groups_post List</h2>
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <?php echo anchor(site_url('groups_post/create'),'Create', 'class="btn btn-primary"'); ?>
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
                <form action="<?php echo site_url('groups_post/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('groups_post'); ?>" class="btn btn-default">Reset</a>
                                    <?php
                                }
                            ?>
                          <button class="btn btn-primary" type="submit">Search</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
        <div class="table-responsive col-md-5">
        <table class="table table-bordered table-hover text-center ">
            <tr>
                <th>No</th>
		<th>Categories Id</th>
		<th>Article Id</th>
		<th colspan="3">Action</th>
            </tr><?php
            foreach ($groups_post_data as $groups_post)
            {
                ?>
                <tr>
			<td width="80px"><?php echo ++$start ?></td>
			<td><?php echo $groups_post->categories_id ?></td>
			<td><?php echo $groups_post->article_id ?></td>
            <td>
                <?php 
                echo anchor(site_url('groups_post/read/'.$groups_post->id),'Read','class="btn btn-primary"'); 
                ?>
            </td>
            <td><?php echo anchor(site_url('groups_post/delete/'.$groups_post->id),'Delete','class="btn btn-primary"','onclick="javasciprt: return confirm(\'Are You Sure ?\')"').'<i class="fa fa-remove"></i>'; ?></td>
            <td><?php echo anchor(site_url('groups_post/update/'.$groups_post->id),'Update','class="btn btn-primary"').'<i class="fa fa-edit"></i>'; ?></td>
        </tr>
		</tr>
                <?php
            }
            ?>
        </table>
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