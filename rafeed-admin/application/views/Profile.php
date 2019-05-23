<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
   <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url();?>/assets/images/favicon.png">
    <title>Rafeed</title> 
  
  <link rel='stylesheet prefetch' href='<?php echo base_url();?>/assets/css/Profile/bootstrap.min.css'>
<link rel='stylesheet prefetch' href='<?php echo base_url();?>/assets/css/Profile/font-awesome.min.css'>
<link rel='stylesheet prefetch' href='<?php echo base_url();?>/assets/css/Profile/font.css'>

      <link rel="stylesheet" href="<?php echo base_url();?>/assets/css/Profile/style.css">

  
</head>

<body>
  <div class="container">
  <header>
    
  </header>
  <main>
    <div class="row">
          <?php $this->load->view($subview,$output); ?>
    </div>
    <?php echo $this->navigation->get_includes_url().'/upload_files/Employee_photos/';?>
  </main>
  <a href="<?php echo(site_url('Welcome/index'));?>"><span class="follow">Back to app</span></a>
</div>
  
  
</body>
</html>
