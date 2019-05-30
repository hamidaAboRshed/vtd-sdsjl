<link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url();?>/assets/images/favicon.png">

<link href="<?php echo base_url();?>/assets/report/premium_family_theme.css" rel="stylesheet">

<?php $this->load->view('report_template/content/cover.php',$cover_data); ?>

<pagebreak/>

<?php $this->load->view('report_template/content/basic_info.php',$basic_data); ?>
<pagebreak />

<?php $this->load->view('report_template/content/dimension_info',$dimension_data); ?>
<pagebreak />

<?php $this->load->view('report_template/content/color_info',$color_data); ?>
<pagebreak />

<?php $this->load->view('report_template/content/collection_info',$collection_data); ?>
<pagebreak />

<?php $this->load->view('report_template/content/led_info',$led_data); ?>
<pagebreak />

<?php $this->load->view('report_template/content/driver_info',$driver_data); ?>