<header class="main-header">
  <!-- Logo -->
  <a href="<?= site_url('dashboard'); ?>" class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini"><i class="fa fa-home"></i></span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg"><img src="<?= site_url(IMAGES_WEB.'logo.png'); ?>" alt="Logo" title="<?= $global_var['app_name'] ?>" width="100px"></span>
  </a>
  <!-- Header Navbar: style can be found in header.less -->
  <nav class="navbar navbar-static-top" role="navigation">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
      <span class="sr-only">Toggle navigation</span>
    </a>
    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">

        <li class="dropdown user user-menu notifications-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <img src="<?= site_url(IMAGES_USER.$user_info['user_avatar']) ?>" class="user-image" alt="Avatar">
            <span class="hidden-xs"><?= $user_info['user_nama'] ?></span>
          </a>
          <ul class="dropdown-menu" style="border-radius:0 0 10px 10px;">
            <li>
              <!-- inner menu: contains the actual data -->
              <ul class="menu">
                <li>
                  <a href="<?= site_url('dashboard/user/edit_profile'); ?>">
                    <i class="fa fa-users text-blue"></i> Profile
                  </a>
                </li>
                <li>
                  <a id="logout">
                    <i class="fa fa-sign-out text-red"></i> Log Out
                  </a>
                </li>
              </ul>
            </li>
          </ul>


        </li>
      </ul>
    </div>
  </nav>
</header>
