<section id="services" class="service-item">
<div class="container">
<div class="center wow fadeInDown">
<h2>Our Service</h2>
<p class="lead"></p>
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
<section id="feature">
<div class="container">
<div class="center wow fadeInDown">
<h2>Features</h2>
<p class="lead"></p>
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
<section id="bottom">
<div class="container wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
<div class="row">
<div class="col-md-3 col-sm-6">
<div class="widget">
<h3>Company</h3>
<ul>
<?php foreach($links_company_data as $linksdata){?>
<li><a href="<?php echo base_url('$linksdata->desc_link_menu');?>"><?php echo $linksdata->title_link_menu ?></a></li>
<?php } ?>
</ul>
</div>
</div> 
<div class="col-md-3 col-sm-6">
<div class="widget">
<h3>Support</h3>
<ul>
<?php foreach($links_support_data as $linksdata){?>
<li><a href="<?php echo base_url('$linksdata->desc_link_menu_support');?>"><?php echo $linksdata->title_link_menu_support ?></a></li>
<?php } ?>
</ul>
</div>
</div> 
<div class="col-md-3 col-sm-6">
<div class="widget">
<h3>Developers</h3>
<ul>
<?php foreach($links_develop_data as $linksdata){?>
<li><a href="<?php echo base_url('$linksdata->desc_link_menu_develop');?>"><?php echo $linksdata->title_link_menu_develop ?></a></li>
<?php } ?>
</ul>
</div>
</div> 
<div class="col-md-3 col-sm-6">
<div class="widget">
<h3>Our Partners</h3>
<ul>
<?php foreach($links_partner_data as $linksdata){?>
<li><a href="<?php echo base_url('$linksdata->desc_link_menu_partner');?>"><?php echo $linksdata->title_link_menu_partner ?></a></li>
<?php } ?>
</ul>
</div>
</div> 
</div>
</div>
</section> 
