<?php if($message){?>
  <h1> <?php echo $message;?></h1>
<?php } ?>
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

<section id="feature">
<div class="container">
<div class="center wow fadeInDown">
<h2>Features</h2>
</div>
<div class="row">
<div class="features">
<?php foreach($features_data as $features){?>
      <div class="col-md-4 col-sm-6 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
          <div class="feature-wrap">
              <?php echo $features->icon_features;?>
              <h2><?php echo $features->title_features;?></h2>
              <h3><?php echo $features->desc_features;?></h3>
          </div>
      </div> 
  <?php } ?>
</div> 
</div> 
</div> 
</section> 
<section id="portfolio">
<div class="container">
    <div class="center wow">
      <?php echo $name_company_profil_des;?>
    <h2>Product</h2>
    <p class="lead">Development and project work</p> CATEGORIES
    </div>
      <ul class="portfolio-filter text-center">
       <li><a class="btn btn-default active" href="#" data-filter="*">All items</a></li>
      <?php foreach($categories_data as $listdata){?>
      <li><a class="btn btn-default" href="#" data-filter=".<?php echo $listdata->categories_id;?>"><?php echo $listdata->kategories_title;?></a></li>
      <!-- <li><a class="btn btn-default" href="#" data-filter=".bootstrap">Creative</a></li>
      <li><a class="btn btn-default" href="#" data-filter=".html">Photography</a></li>
      <li><a class="btn btn-default" href="#" data-filter=".wordpress">Web Development</a></li> -->
      <?php } ?>
      </ul> 
      <div class="row">
                  <div class="portfolio-items">
                  <?php foreach($data_categories_porto as $listporto){?>
                    <div class="portfolio-item  joomla <?php echo $listporto->categories_id ?> col-xs-12 col-sm-4 col-md-3">
                          <div class="recent-work-wrap">
                              <img class="img-responsive" src="<?php echo base_url('bootasset/uploadImages/portfolio');?>/<?php echo $listporto->image_porto ?>" alt="">
                                  <div class="overlay">
                                      <div class="recent-work-inner">
                                      <h3><a href="#"><?php echo $listporto->title_porto ?></a></h3>
                                      <p><?php echo substr($listporto->desc_porto,100) ?></p>
                                      <a class="preview" href="<?php echo base_url('bootasset/uploadImages/portfolio');?>/<?php echo $listporto->image_porto ?>" rel="prettyPhoto"><i class="fa fa-eye"></i> View</a>
                                      </div>
                                  </div>
                          </div>
                    </div>
                        <?php } ?>
                </div> 

      </div>
</div>
</section> 
<section id="services" class="service-item">
<div class="container">
<div class="center wow fadeInDown">
<h2>Our Service</h2>

</div>
<div class="row">
<?php foreach($services_data as $service){?>
        <div class="col-sm-6 col-md-4">
        <div class="media services-wrap wow fadeInDown">
        <div class="pull-left">
        <img class="img-responsive" src="<?php echo base_url('bootasset/uploadImages/services');?>/<?php  echo $service->icon_services;?>">
        </div>
        <div class="media-body">
        <h3 class="media-heading"><?php echo $service->title_services;?></h3>
        <p><?php echo $service->desc_services;?></p>
        </div>
        </div>
        </div>
<?php } ?>

  </div> 
  </div> 
</section> 
<section id="conatcat-info">
<div class="container">
<div class="row">
<div class="col-sm-8">
<div class="media contact-info wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
<div class="pull-left">
<i class="fa fa-phone"></i>
</div>
<div class="media-body">
<h2>Have a question or need a custom quote?</h2>
<p><?php echo $contact_company;?></p>
</div>
</div>
</div>
</div>
</div> 
</section> 
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

