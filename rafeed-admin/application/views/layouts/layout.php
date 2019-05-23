<!DOCTYPE html>
<html lang="en">

<?php $this->load->view('includes/header',$output);?>

<body class="fix-header fix-sidebar">
    <!-- All Jquery -->
    <?php //$this->load->view('includes/grocroy_script_files',$output);?>
    <script src="<?php echo base_url();?>/assets/js/lib/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url();?>/assets/js/lib/jquery-ui/jquery-ui.min.js"></script>
    <script src="<?php echo base_url();?>/assets/js/lib/jquery-ui/jquery.ui.touch-punch.min.js"></script>
    <!-- Preloader - style you can find in spinners.css -->
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
			<circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
    </div>
    <!-- Main wrapper  -->
    <div id="main-wrapper">
        <!-- header header  -->
        <?php $this->load->view('includes/top_bar');?>
        <!-- End header header -->
        <!-- Left Sidebar  -->
        <div class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <?php $this->load->view('includes/navigation');?>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </div>
        <!-- End Left Sidebar  -->
        <!-- Page wrapper  -->
        <div class="page-wrapper">
            <!-- Bread crumb -->
            <div class="row page-titles">
                <div class="col-md-4 align-self-left">
                    <?php if(!is_array($pageTitle))
                        echo '<h3 class="text-primary">'.$pageTitle.'</h3>';
                    else{
                        echo '<ol class="breadcrumb" style="float:left">';

                        foreach ($pageTitle as $key => $value) {
                            echo('<li class="breadcrumb-item"><a href="'.site_url($value).'" style="color: #607d8b;">'.$key.'</a></li>');
                        }
                        
                        echo('</ol>');
                    }

                    /*if (isset($breadcrumbs)) {
                        echo $breadcrumbs;
                    }*/
                    ?>

                </div>
                <div class="col-md-8 align-self-right" style="height: 30px;line-height: 30px;">                    
                    <?php 
                    if(isset($breadcrumb))
                        echo $breadcrumb;?>
                    <!-- <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">1</a></li>
                        <li class="breadcrumb-item active">2</li>
                    </ol> -->
                </div>
            </div>
            <!-- End Bread crumb -->
            <!-- Container fluid  -->
            <div class="container-fluid">
                <!-- Start Page Content -->
                <?php $this->load->view($subview,$output); ?>
                <!-- <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body"> 

                                

                             </div>
                        </div>
                    </div>
                </div> -->
                <!-- End PAge Content -->
            </div>
            <!-- End Container fluid  -->
            <!-- footer -->
            <?php $this->load->view('includes/footer');?>
            <!-- End footer -->
        </div>
        <!-- End Page wrapper  -->
    </div>
    <!-- End Wrapper -->





    
    <!-- <script src="<?php echo base_url();?>/assets/js/popup/jquery-1.8.2.min.js"></script> -->
    <!-- Bootstrap tether Core JavaScript -->
    <script src="<?php echo base_url();?>/assets/js/lib/bootstrap/js/popper.min.js"></script>
    <!-- <script src="<?php echo base_url();?>/assets/js/popup/jquery.popupoverlay.js"></script> -->
    <script src="<?php echo base_url();?>/assets/bootstrap 3.3.7/dist/js/bootstrap.min.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="<?php echo base_url();?>/assets/js/jquery.slimscroll.js"></script>

    <!--Menu sidebar -->
    <script src="<?php echo base_url();?>/assets/js/sidebarmenu.js"></script> 
    <!--stickey kit -->
    <!-- <script src="<?php echo base_url();?>/assets/js/lib/sticky-kit-master/dist/sticky-kit.min.js"></script> -->
    <script src="<?php echo base_url();?>/assets/js/jquery.sticky-kit.js"></script>

    <script type="text/javascript" src="<?php echo base_url();?>/assets/js/lib/sweetalert/sweetalert.min.js"></script>

    <script type="text/javascript" src="<?php echo base_url();?>/assets/js/Swal-Forms/swal-forms.js"></script>
    <!-- scripit init-->
    <script type="text/javascript" src="<?php echo base_url();?>/assets/js/lib/sweetalert/sweetalert.init.js"></script>
    

    <!--Custom JavaScript -->
    <script src="<?php echo base_url();?>/assets/js/custom.min.js"></script>

<!--     <script src="<?php echo base_url();?>/assets/js/custom.js"></script> -->
    
    <!-- <script src="<?php echo base_url();?>/assets/js/wizard.min.js"></script> -->

    <!-- Progress-Bar -->
    <script type="text/javascript" src="<?php echo base_url();?>/assets/js/Progress-Bar/index.js"></script>
    
    <!-- steps form -->
    <script type="text/javascript" src="<?php echo base_url();?>/assets/js/Steps_form/velocity.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>/assets/js/Steps_form/snap_svg.js"></script>
    <!-- <script src="<?php echo base_url();?>/assets/chosen_v1.8.5/chosen.jquery.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>/assets/chosen_v1.8.5/docsupport/prism.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>/assets/chosen_v1.8.5/docsupport/init.js" type="text/javascript" ></script> -->
      




    <script type="text/javascript" src="<?php echo base_url();?>/assets/DataTables/datatables.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>/assets/DataTables/Responsive-2.2.2/js/dataTables.responsive.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>/assets/DataTables/Responsive-2.2.2/js/responsive.bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>/assets/DataTables/DataTables-1.10.18/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>/assets/DataTables/DataTables-1.10.18/js/dataTables.bootstrap4.min.js"></script>

    <!-- grocroy crud -->
    <?php if ($output) {
      $this->load->view('includes/grocroy_script_files',$output);
    }
    else {?>
       <!-- multi select -->
        <script src="<?php echo base_url();?>/assets/chosen_v1.8.5/chosen.jquery.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>/assets/chosen_v1.8.5/docsupport/prism.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>/assets/chosen_v1.8.5/docsupport/init.js" type="text/javascript" ></script>
    <?php } ?>
</body>

</html>