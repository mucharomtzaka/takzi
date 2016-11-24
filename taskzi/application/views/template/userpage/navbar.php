<header id="header" class="main-header">
  <div class="top-bar">
    <div class="container">
      <div class="row">

        <div class="col-sm-5 col-xs-6">
        <div class="top-number"><p><i class="fa fa-phone-square"></i><?php echo $contact_company;?></p>
        
        </div>
        </div>

            <div class="col-sm-6 col-xs-4">
              <div class="social">
              
                        <div class="search">
                             <form action="<?php echo site_url('welcome/Blog'); ?>" class="form-inline" method="get">

                              <input type="text" class="search-form" autocomplete="off" placeholder="Search" name="q" value="<?php echo $q; ?>">
                              <?php 
                                if ($q <> ''){?>
                                    <a href="<?php echo site_url('welcome/Blog'); ?>"><i class="fa fa-remove"></i>Reset</a>
                               <?php }else{?>
                               <i class="fa fa-search"></i>
                               <?php } ?>
                              </form>  
                      </div>

                    </div>
                  </div>
                </div>
              </div>
              <nav class="navbar navbar-inverse" role="banner">
              <div class="container">
              <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              </button>
               <a class="navbar-brand" href="<?php echo base_url();?>"><img src="<?php echo base_url('bootasset/uploadImages');?>/<?php echo $backgrounds;?>" alt="logo" width="200"></a>
              </div>
              <div class="collapse navbar-collapse navbar-right">
              <ul class="nav navbar-nav">
                <?php if($this->ion_auth->is_admin() || $this->ion_auth->is_programmer()){?>
                              <li>
                                <a href="<?php echo base_url('home/index');?>">
                                  <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                                </a>
                              </li>
                <?php } ?>
               <?php if ($this->ion_auth->logged_in()){?>
                      <li><a href="<?php echo base_url('');?>"><i class="fa fa-home"></i> Home</a></li>
                      <li><a href="<?php echo base_url('welcome/Profil');?>"><i class="fa fa-bank"></i>Profil</a></li>
                      <li><a href="<?php echo base_url('welcome/Service');?>"><i class="fa fa-cloud"></i>Service</a></li>
                      <li><a href="<?php echo base_url('welcome/Blog');?>"><i class=" fa fa-newspaper-o"></i>Blog</a></li>
                       <li><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-page"></i>Pages</a>
                         <ul class="dropdown-menu">
                         <?php foreach($menu as $listmenu){?>
                              <li><a href=" <?php echo $listmenu->menu_link ?>" class="dropdown-toggle" data-toggle="dropdown"><?php echo $listmenu->menu ?></a></li>
                          <?php } ?>
                         </ul>
                       </li>
                      <li><a href="<?php echo base_url('welcome/Contact');?>"><i class=" fa fa-phone"></i>Contact</a></li>
                      <?php if($this->ion_auth->logged_in()){?>
                      <li class="dropdwon"> <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                      <i class="fa fa-user"></i>
                      <?php echo $this->session->userdata('email');?>
                        <ul class="dropdown-menu">
                         <li ><a href="<?php echo base_url('welcome/myprofil');?>">My Profile</a></li>
                          <li> <a href="<?php echo base_url('auth/logout');?>">|[<i class="fa fa-sign-out"></i> &nbsp; Sign out]</a></li>
                        </ul>
                      </a></li>
                     
                      <?php } ?>
                  <?php }else{ ?>
                  <li><a href="<?php echo base_url();?>"><i class="fa fa-home"></i>Home</a></li>
                      
                      <li><a href="<?php echo base_url('welcome/Profil');?>"><i class="fa fa-bank"></i>About Us</a></li>
                      <li><a href="<?php echo base_url('welcome/Service');?>"><i class="fa fa-cloud"></i>Service</a></li>
                       <li><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-page"></i>Pages</a>
                         <ul class="dropdown-menu">
                         <?php foreach($menu as $listmenu){?>
                              <li><a href=" <?php echo $listmenu->menu_link ?>" class="dropdown-toggle" data-toggle="dropdown"><?php echo $listmenu->menu ?></a></li>
                          <?php } ?>
                         </ul>
                       </li>

                      <li><a href="<?php echo base_url('welcome/Blog');?>"><i class=" fa fa-newspaper-o"></i>Blog</a></li>
                      <li><a href="<?php echo base_url('welcome/Contact');?>"><i class=" fa fa-phone"></i>Contact</a></li>
                      <li><a href="<?php echo base_url('auth');?>"><i class="fa fa-sign-in"></i>Login</a>
                      </li>
                      <li><a href="<?php echo base_url('welcome/register');?>"><i class="fa fa-sign-up"></i>Register</a>
                      </li>
                <?php }?>


              </ul>

              </div>

              </div> 
</nav>
</header> 


