<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="RafeedWebApplication">
    <meta name="author" content="HamdiaAboRshed">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url();?>/assets/images/favicon.png">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url();?>images/favicon.png">
    <title>Rafeed Web Application</title>
    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url();?>assets/css/lib/bootstrap/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?php echo base_url();?>assets/css/helper.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/css/style.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/css/custom.css" rel="stylesheet">

    <!-- animation-->

    <!-- Plugin css -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/animation/css/jquery.animateSlider.css">


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:** -->
    <!--[if lt IE 9]>
    <script src="https:**oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https:**oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
	<style>
         
         .animated {
            -webkit-animation-duration: 5s;
            animation-duration: 5s;
            -webkit-animation-fill-mode: both;
            animation-fill-mode: both;
         }
         
         @-webkit-keyframes fadeIn {
            0% {opacity: 0;}
            100% {opacity: 1;}
         }
         
         @keyframes fadeIn {
            0% {opacity: 0;}
            100% {opacity: 1;}
         }
         
         .fadeIn {
            -webkit-animation-name: fadeIn;
            animation-name: fadeIn;
         }

         .login-control{
              font-size: 14px;
         }
         .fa{
              color: white;
              font-size: 22px !important;
         }
      </style>
</head>
	

<body class="fix-header fix-sidebar">
    <!-- Preloader - style you can find in spinners.css -->
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
			<circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
    </div>
    <!-- Main wrapper  -->
	<div style="width:650px; margin:30px auto;">
		<embed src="<?php echo base_url();?>/assets/images/login/bg.svg" width="650" height="650" align="center">
		  <!--Your browser does not support iframes-->
		</embed >
	</div>
    <div id="main-wrapper">

        <div class="unix-login">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-lg-4">
						<div class="golden-logo ">
                            <li class="anim-slide">
    							<p class="welcome-p " id="Welcome">Welcome to</p>
    							<img src="<?php echo base_url();?>/assets/images/login/logo.gif" id="rafeed" />
    							<p class="application-p" id="application">Application...</p>
                            </li>
						</div>
                        <div class="login-content card" style="width: 371px;top: 194px;margin: auto;">
							
                            <div class="login-form">
                                <h4 style="color: #99abb4;">Login</h4>
                                 <?php echo form_open('User/validate_credentials');?>
                                    <div class="form-group">
                                        <!--<label>Username</label>-->
                                        <input type="text" id="username" name="username" class="login-control form-control" placeholder="Username">
                                    </div>
                                    <div class="form-group">
                                        <!--<label>Password</label>-->
                                        <input type="password" id="password" name="password" class="login-control form-control" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;">
                                    </div>
                                  
                                     <?php echo validation_errors('<p class="error">');?>
                                    <p class="error">
                                    <?php if ($bool) {
                                            echo $string;
                                        } 
                                    ?>
                                    </p>
                                     <button type="submit" class="btn btn-flat m-b-30 m-t-30 login-btn"><i class="fa fa-sign-in"></i></button> 
                                     
                                    
                                <?php echo form_close();?>
                                  
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
<div class="login-footer"><p>@2018 Rafeed</p></div>
    <!-- End Wrapper -->
	<!-- All Jquery -->
    <script src="<?php echo base_url();?>assets/js/lib/jquery/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="<?php echo base_url();?>assets/js/lib/bootstrap/js/popper.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/lib/bootstrap/js/bootstrap.min.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="<?php echo base_url();?>assets/js/jquery.slimscroll.js"></script>
    <!--Menu sidebar -->
    <script src="<?php echo base_url();?>assets/js/sidebarmenu.js"></script>
    <!--stickey kit -->
    <script src="<?php echo base_url();?>assets/js/lib/sticky-kit-master/dist/sticky-kit.min.js"></script>
    <!--Custom JavaScript -->
    <script src="<?php echo base_url();?>assets/js/custom.min.js"></script>

    <script src="<?php echo base_url();?>assets/animation/js/modernizr.js"></script> 
    <!-- Load the plugin --> 
    <script src="<?php echo base_url();?>assets/animation/js/jquery.animateSlider.js"></script> 

    <script>
         $(".golden-logo").animateSlider(
            {
                autoplay    :true,
                interval    :500,
                animations  : 
                {
                    0   : //Slide No2
                    {   
                        "#Welcome":
                        {
                            show        : "fadeInLeft",
                            hide        : "fadeOut",
                            delayShow   : "delay0s"
                        },
                        "#rafeed"   :
                        {
                            show        : "fadeInUp",
                            hide        : "bounceOut",
                            delayShow   : "delay2s"
                        },
                        "#application":
                        {
                            show        : "flipInY",
                            hide        : "flipOutY",
                            delayShow   : "delay3-5s"
                        }
                    }
                }
            });
        </script>

</html>