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
    <div class="item active" style="background-image:url(<?php echo base_url('bootasset/uploadImages/slider');?>/<?php  echo $slideshow->image_back;?>)">
    <?php }else{ ?>
    <div class="item " style="background-image:url(<?php echo base_url('bootasset/uploadImages/slider');?>/<?php  echo $slideshow->image_back;?>)">
      <?php }?>
      <div class="container">
      <div class="row slide-margin">
          <div class="col-sm-6">
                <div class="carousel-content">
                <h1 class="animation animated-item-1"></h1>
                        <h2 class="animation animated-item-2"><?php echo substr($slideshow->description,100);?></h2>
                <a class="btn-slide animation animated-item-3" href="#">Read More</a>
                </div>
          </div>
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
<a class="prev hidden-xs" href="#main-slider" data-slide="prev"><i class="fa fa-chevron-left"></i>
</a>
<a class="next hidden-xs" href="#main-slider" data-slide="next"><i class="fa fa-chevron-right"></i>
</a>
</section> 
  <section id="about-us">
  <div class="container">
        <div class="center wow fadeInDown">
        <h2>About <?php echo $name_company;?> </h2>
        <p class="lead"><?php echo $name_company_profil_des;?></p>
        </div>   
  </div>  <!--/.row-->
    </div><!--/.container-->
    </section><!--/about-us-->  
   <section id="bottom">
<div class="container wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
<div class="row">
<div class="col-md-3 col-sm-6">
<div class="widget">
<h3>Company</h3>
<ul>
<?php foreach($links_company_data as $linksdata){?>
<li><a href="<?php echo base_url($linksdata->desc_link_menu);?>"><?php echo $linksdata->title_link_menu ?></a></li>
<?php } ?>
</ul>
</div>
</div> 
<div class="col-md-3 col-sm-6">
<div class="widget">
<h3>Support</h3>
<ul>
<?php foreach($links_support_data as $linksdata){?>
<li><a href="<?php echo base_url($linksdata->desc_link_menu_support);?>"><?php echo $linksdata->title_link_menu_support ?></a></li>
<?php } ?>
</ul>
</div>
</div> 
<div class="col-md-3 col-sm-6">
<div class="widget">
<h3>Developers</h3>
<ul>
<?php foreach($links_develop_data as $linksdata){?>
<li><a href="<?php echo base_url($linksdata->desc_link_menu_develop);?>"><?php echo $linksdata->title_link_menu_develop ?></a></li>
<?php } ?>
</ul>
</div>
</div> 
<div class="col-md-3 col-sm-6">
<div class="widget">
<h3>Our Partners</h3>
<ul>
<?php foreach($links_partner_data as $linksdata){?>
<li><a href="<?php echo base_url($linksdata->desc_link_menu_partner);?>"><?php echo $linksdata->title_link_menu_partner ?></a></li>
<?php } ?>
</ul>
</div>
</div> 
</div>
</div>
</section> 

