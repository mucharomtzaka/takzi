<section id="blog" class="container">
<div class="center">
<h2>Blogs</h2>
<div class="widget search">
<?php echo $pagination ?>
</div>
<div class="blog">
<div class="row">
<?php if(isset($q)): ?>
<?php foreach ($postartikel_data as $postartikel){?> 
<div class="col-md-6">
        <div class="blog-item">
                <div class="row">
                    <div class="col-xs-12 col-sm-2 text-center">
                            <div class="entry-meta">
                            <span id="publish_date"><?php echo $postartikel->Date ?></span>
                            </div>
                    </div>
                            <div class="col-xs-12 col-sm-10 blog-content">
                            <a href="<?php echo base_url('welcome/detailBlog');?>/<?php echo $postartikel->article_id ?>/<?php echo str_replace(' ',"-",trim($postartikel->article_title)) ?>"><img class="img-responsive img-blog" src="<?php echo base_url('bootasset/uploadImages/blog');?>/<?php echo $postartikel->Image ?>" width="100%" alt=""/></a>
                            <h2><a href="<?php echo base_url('welcome/detailBlog');?>/<?php echo $postartikel->article_id ?>/<?php echo str_replace(' ',"-",trim($postartikel->article_title)) ?>"><?php echo $postartikel->article_title ?></a></h2>
                            <h3><?php echo substr($postartikel->article_description,1500); ?></h3>
                            <a class="btn btn-primary readmore" href="<?php echo base_url('welcome/detailBlog');?>/<?php echo $postartikel->article_id ?>/<?php echo str_replace(' ',"-",trim($postartikel->article_title)) ?>">Read More <i class="fa fa-angle-right"></i></a>
                            </div>
                </div>
        </div> 
</div>
<?php } ?>
<?php else : ?>
    <div class="col-md-5">
   <h> Data Not Found !! </h>
    </div>
<?php endif;?>
  
</div> 
            </div><!--/.row-->
        </div>
    </section><!--/#blog-->

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

