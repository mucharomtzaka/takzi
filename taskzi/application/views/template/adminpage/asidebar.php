 <!-- =============================================== -->

  <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
        <?php if($this->ion_auth->is_admin()){?>
        <li class="treeview">
          <a href="<?php echo base_url('home/index');?>">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
        
        <li class="treeview">
          <a href="#">
            <i class="fa fa-users"></i> <span>Users</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>

          </a>
           <ul class="treeview-menu">
             <li><a href="<?php echo base_url('auth/create_user');?>"><i class="fa fa-plus"></i>Create Users</a></li>
             <li><a href="<?php echo base_url('auth/create_group');?>"><i class="fa fa-plus"></i>Create Groups</a></li>
             <li><a href="<?php echo base_url('auth/index');?>"><i class="fa fa-th-list"></i>List Users</a></li>
              <li><a href="<?php echo base_url('plugin/groups');?>"><i class="fa fa-th-list"></i>List Group Users</a></li>
             </ul>
        </li>
        <li class="treeview"><a href="<?php echo base_url('home/setting');?>"><i class="fa fa-gear"></i> <span>Setting</span></a></li>
        
        <?php } ?>
        <?php if($this->ion_auth->is_programmer()){?>
        <li class="treeview"><a href="<?php echo base_url('home/modules');?>"><i class="fa fa-sitemap"></i> <span>Module</span></a></li>
         <?php } ?>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-folder"></i> <span>Master Menu </span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="#"><i class="fa fa-circle-o"></i>Blog</a>
            <ul class="treeview-menu">
             <li><a href="<?php echo base_url('categoriespost');?>"><i class="fa fa-external-link-square"></i>Categories</a></li>
              <li><a href="<?php echo base_url('postartikel');?>"><i class="fa fa-external-link-square"></i>Article</a></li>
                <li><a href="<?php echo base_url('menubar');?>"><i class="fa fa-external-link-square"></i> Menubar</a></li>
                 <li><a href="<?php echo base_url('submenubar');?>"><i class="fa fa-external-link-square"></i> SubMenubar</a></li>
                    <li><a href="<?php echo base_url('groups_post');?>"><i class="fa fa-external-link-square"></i> PostGroup</a></li>
            </ul>
            </li>
            <li><a href="#"><i class="fa fa-circle-o"></i>Plugin</a>
            <ul class="treeview-menu">
              <li><a href="<?php echo base_url('plugin/menus');?>"><i class="fa fa-external-link-square"></i>Menus</a></li>
            <li><a href="<?php echo base_url('plugin/slideshow');?>"><i class="fa fa-external-link-square"></i>slideshow</a></li>
            <li><a href="<?php echo base_url('plugin/features');?>"><i class="fa fa-external-link-square"></i>features</a></li>
            <li><a href="<?php echo base_url('plugin/services');?>"><i class="fa fa-external-link-square"></i>services</a></li>
             <li><a href="<?php echo base_url('plugin/messages');?>"><i class="fa fa-external-link-square"></i>messages</a></li>
              <li><a href="<?php echo base_url('plugin/portofolio');?>"><i class="fa fa-external-link-square"></i>Portofolio</a></li>
               <li><a href="<?php echo base_url('plugin/groups_portfolio');?>"><i class="fa fa-external-link-square"></i>Group Portofolio</a></li>
            </ul>
            </li>
            <li><a href="#"><i class="fa fa-circle-o"></i>Links</a>
              <ul class="treeview-menu">
                <li><a href="<?php echo base_url('plugin/Linkscompany');?>"><i class="fa fa-external-link-square"></i>Company</a></li>
                <li><a href="<?php echo base_url('plugin/Linkssupport');?>"><i class="fa fa-external-link-square"></i>Support</a></li>
                <li><a href="<?php echo base_url('plugin/Linksdevelop');?>"><i class="fa fa-external-link-square"></i>Developers</a></li>
                <li><a href="<?php echo base_url('plugin/Linkspartner');?>"><i class="fa fa-external-link-square"></i>Partners</a></li>
              </ul>
            </li>
          </ul>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>