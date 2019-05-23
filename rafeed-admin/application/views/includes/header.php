<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="RafeedWebApplication">
    <meta name="author" content="HamidaAboRshed">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url();?>/assets/images/favicon.png">
    <title>Rafeed</title>

    <link href="<?php echo base_url();?>/assets/css/lib/sweetalert/sweetalert.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url();?>/assets/css/Swal-Forms/swal-forms.css">

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url();?>/assets/bootstrap 3.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- <link href="<?php echo base_url();?>/assets/bootstrap 3.3.7/dist/css/bootstrap-theme.min.css" rel="stylesheet"> -->
    <!-- Custom CSS -->
    <link href="<?php echo base_url();?>/assets/css/helper.css" rel="stylesheet">

    <link href="<?php echo base_url();?>/assets/css/wizard.css" rel="stylesheet">

    <link href="<?php echo base_url();?>/assets/css/radio-style.css" rel="stylesheet">

    <link href="<?php echo base_url();?>/assets/css/multiple_select/chosen.min.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>/assets/css/Steps_form/reset.css"/> 
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>/assets/css/Steps_form/main.css"/>    

    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>/assets/css/Progress_Bar/style.css"/>

    <!-- font icon -->
    <link rel="stylesheet" href="<?php echo base_url();?>/assets/icons/app-icon/style.css"/>

    <!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>/assets/DataTables/DataTables-1.10.18/css/dataTables.bootstrap4.css"/> -->
    
     <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>/assets/DataTables/Buttons-1.5.2/css/buttons.bootstrap.min.css"></link>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>/assets/DataTables/Buttons-1.5.2/css/buttons.dataTables.min.css"></link>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>/assets/DataTables/Buttons-1.5.2/css/buttons.jqueryui.min.css"></link>

    <!-- <link rel="stylesheet" href="<?php echo base_url();?>/assets/chosen_v1.8.5/chosen.css"> 
    <link rel="stylesheet" href="<?php echo base_url();?>/assets/chosen_v1.8.5/docsupport/style.css"> 
    <link rel="stylesheet" href="<?php echo base_url();?>/assets/chosen_v1.8.5/docsupport/prism.css"> -->

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:** -->
    <!--[if lt IE 9]>
    <script src="https:**oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https:**oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->

    <?php if ($output) {
             foreach($css_files as $file): ?>
            <link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
     
            <?php endforeach;
        }
        else {?>
           <!-- multi select -->
            <link rel="stylesheet" href="<?php echo base_url();?>/assets/chosen_v1.8.5/chosen.css"> 
            <link rel="stylesheet" href="<?php echo base_url();?>/assets/chosen_v1.8.5/docsupport/style.css"> 
            <link rel="stylesheet" href="<?php echo base_url();?>/assets/chosen_v1.8.5/docsupport/prism.css">
        <?php } ?>
        
 <style type='text/css'>
body
{
    font-family: Arial;
    font-size: 14px;
}
a {
    color: blue;
    text-decoration: none;
    font-size: 14px;
}
a:hover
{
    text-decoration: underline;
}
</style>

    <link href="<?php echo base_url();?>/assets/css/style.css" rel="stylesheet">

    <link href="<?php echo base_url();?>/assets/css/custom.css" rel="stylesheet">
</head>
