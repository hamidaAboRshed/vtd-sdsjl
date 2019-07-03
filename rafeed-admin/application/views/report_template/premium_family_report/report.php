<link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url();?>/assets/images/favicon.png">

<link href="<?php echo base_url();?>/assets/report/premium_family_theme.css" rel="stylesheet">

<?php $this->load->view('report_template/premium_family_report/cover.php',$cover_data); ?>

<pagebreak/>

<?php $this->load->view('report_template/premium_family_report/basic_info.php',$basic_data); ?>
<pagebreak />

<?php $this->load->view('report_template/premium_family_report/dimension_info',$dimension_data); ?>
<pagebreak />

<?php $this->load->view('report_template/premium_family_report/color_info',$color_data); ?>
<pagebreak />

<?php $this->load->view('report_template/premium_family_report/collection_info',$collection_data); ?>
<pagebreak />

<?php $this->load->view('report_template/premium_family_report/led_info',$led_data); ?>
<pagebreak />

<?php $this->load->view('report_template/premium_family_report/driver_info',$driver_data); ?>