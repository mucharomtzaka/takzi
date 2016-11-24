<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
       <p><?php echo $message;?></p>
      <!-- Default box -->

      <!-- /.box -->
       <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-user"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Users</span>
              <span class="info-box-number"><?php echo $count_users;?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-users"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Users Groups</span>
              <span class="info-box-number"><?php echo $count_groups;?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-newspaper-o"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Blogs</span>
              <span class="info-box-number"><?php echo $count_blog;?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
<?php if($this->ion_auth->is_admin()||$this->ion_auth->is_programmer()){?>
         <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-gear"></i></span>
            <div class="info-box-content">
             <a href="<?php echo base_url('home/setting');?>"> <span class="info-box-text">Setting</span></a>
             <br>
             <a href="<?php echo base_url('home/modules');?>"> <span class="info-box-text">Modules</span></a>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
<?php } ?>
        </div>

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
          <section id="main-slider" class="no-margin">
<div class="carousel slide animate-in"  id="carousel-slider"  data-ride="carousel" data-anim-type="fade-in-up">
<ol class="carousel-indicators">
<?php foreach($slideshow_data as $slideshow){?>
     <?php if($slideshow->active=='1'){?>
    <li data-target="#main-slider" data-slide-to="<?php echo $slideshow->id;?>" class="active"></li>
      <?php }else{ ?>
   <li data-target="#main-slider" data-slide-to="<?php echo $slideshow->id;?>"></li>
      <?php }?>
    <?php } ?>
</ol>
<div class="carousel-inner">
  <?php foreach($slideshow_data as $slideshow){?>
  <?php if($slideshow->active=='1'){?>
    <div class="item active">
    <?php }else{ ?>
    <div class="item ">
      <?php }?>
      <div class="container">
      <div class="row slide-margin">
          <div class="col-sm-6 hidden-xs animation animated-item-4">
                <div class="slider-img">
                <img src="<?php echo base_url('bootasset/uploadImages/slider');?>/<?php  echo $slideshow->image_front;?>" class="img-responsive">
                </div>
          </div>
           </div>
        </div>  
      </div>
 <?php } ?> 
</div>
</div>
</section> 
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
         
        </div>

        <!-- /.box-footer-->
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->