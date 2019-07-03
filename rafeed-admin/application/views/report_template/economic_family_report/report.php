<html>
<head>
    <meta charset="utf-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Premium family report">
    <meta name="author" content="Hamida Abo Rshed">
    <!-- <title> <?php echo $cover_data['family_name'] ;?></title> -->
    
	<link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url();?>/assets/images/favicon.png">
	
	<link href="<?php echo base_url();?>/assets/report/economic_family_theme.css" rel="stylesheet">
</head>
<body>

	<?php $this->load->view('report_template/economic_family_report/cover.php',$cover_data); ?>

	<pagebreak/>

	<?php $this->load->view('report_template/economic_family_report/basic_info.php',$basic_data); ?>
	<pagebreak />

	<?php $this->load->view('report_template/economic_family_report/collection_info',$collection_data); ?>
	<!-- <pagebreak />

	<?php $this->load->view('report_template/economic_family_report/led_info',$led_data); ?>
	<pagebreak />

	<?php $this->load->view('report_template/economic_family_report/driver_info',$driver_data); ?> -->
</body>
</html>