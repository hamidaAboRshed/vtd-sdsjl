<nav class="navbar fixed-top navbar-expand-lg navbar-dark align-items-center" style="width: 100%">
  <div class="container">
    <a class="navbar-brand" href="<?php echo base_url();?>index.php/Home" style="z-index: 9999;">
      <img src="<?php echo base_url();?>/assets/images/logo/rafeed/rafeed-logo.png" alt="rafeed-logo" title="" style="height: 1.3rem;">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav" style="margin: 0 auto;width: 100%;">
      <ul class="navbar-nav align-items-center" data-app-modern-menu="true" style="margin: 0 auto;font-family: logo_login;">
        <?php 
          foreach ($this->session->userdata('navdata') as $key => $value) {
              echo '<li class="nav-item '. ($value["active"]==1? "active":"") .'" >
                  <a class="nav-link text-white link display-4 " href="'.base_url().'index.php/Product/Product_series_list/'.$value["ID"].'" >'.
                  $value['Name'].'</a></li>';
          }
          ?>
      </ul>
    </div>
  </div>
</nav>