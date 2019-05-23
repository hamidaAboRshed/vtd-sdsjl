<div class="header">
    <nav class="navbar top-navbar navbar-expand-md navbar-light">
        <!-- Logo -->
        <div class="navbar-header">
            <a class="navbar-brand" href="#">
                <!-- Logo icon -->
                <b><img src="<?php echo base_url();?>/assets/images/logo.png" alt="homepage" class="dark-logo" /></b>
                <!--End Logo icon -->
                <!-- Logo text -->
                <span><img src="<?php echo base_url();?>/assets/images/logo-text.png" alt="homepage" class="dark-logo" /></span>
            </a>
        </div>
        <!-- End Logo -->
        <div class="navbar-collapse row">
            <!-- toggle and nav items -->
            <ul class="navbar-nav mr-auto mt-md-0 col-md-2">
                <!-- This is  -->
                <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up text-muted  " href="javascript:void(0)"><i class="mdi mdi-menu"></i></a> </li>
                <li class="nav-item m-l-10"> <a class="nav-link sidebartoggler hidden-sm-down text-muted  " href="javascript:void(0)"><i class="ti-menu"></i></a> </li>
                
            </ul>
            <!-- User profile and search -->
            <ul class="navbar-nav my-lg-0" style="float:right; padding-right:15px">
                <!-- Profile -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-muted  " href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img src="<?php echo $this->navigation->get_includes_url()?>/upload_files/Employee_photos/<?php if(isset($this->session->userdata['Photo'])) echo $this->session->userdata['Photo']; else echo "default_photo.png";?>" alt="user" class="profile-pic" />
                    </a>
                    <div class="dropdown-menu dropdown-menu-right animated zoomIn">
                        <ul class="dropdown-user">
                            <li><a href="<?php echo site_url('Employee/view_profile'); ?>"><i class="ti-user"></i> Profile</a></li>
                            <li><a href="<?php echo site_url('User/change_password_form'); ?>"><i class="fa fa-key"></i> Change Password</a></li>
                            <li><a href="<?php echo site_url('User/login'); ?>"><i class="fa fa-power-off"></i> Logout</a></li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</div>
        