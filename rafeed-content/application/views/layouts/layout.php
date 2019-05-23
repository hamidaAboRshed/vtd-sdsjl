<!DOCTYPE html>
<html >
<head>
  <?php $this->load->view('includes/header');?>
</head>
<!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
<!-- <meta name='viewport' content='width=device-width' /> -->
<!-- <meta name='viewport' content='width=device-width,
    initial-scale=1, maximum-scale=1, minimum-scale=1'/> -->
<?php 
	$series_name='';
	foreach ($this->session->userdata('navdata') as $key => $value) {
		if($value['active']==1)
			$series_name=$value['Name'];
}?>

<style type="text/css">
	.section-one-page { height: 100vh; }
</style>
<body class="<?php echo($series_name);?>">
	<script src="<?php echo base_url();?>/assets/web/assets/jquery/jquery.min.js"></script>

	<!-- <nav class="navbar fixed-top navbar-expand navbar-light bg-light">
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item-active">
                    <a class="nav-link" href="#/">Home<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#/product">Products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#/services">Services</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#/career">Career</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#/contact">Contact Us</a>
                </li>
            </ul>
        </div>
    </nav> -->
    
	<section class="menu cid-1" once="menu" id="menu2-5">
		<?php $this->load->view('includes/navigation');?>
	</section>
		
	<section>
	  <?php $this->load->view('includes/secondary_navigation');?>
	</section>
	
    <link rel="stylesheet" href="<?php echo base_url();?>/assets/priority-nav-scroller-master/styles/priority-nav-scroller.css">
    
    <script src="<?php echo base_url();?>/assets/priority-nav-scroller-master/scripts/bundle.js"></script>

	<?php $this->load->view($subview); ?>
	
	<!-- sitemap -->
	<section class="footer3 cid-qTljV9dz7X" id="footer3-a">
		<?php $this->load->view('includes/sitemap');?>	    
	</section>

	

	<?php $this->load->view('includes/footer');?>

	
	<script src="<?php echo base_url();?>/assets/popper/popper.min.js"></script>
	<script src="<?php echo base_url();?>/assets/tether/tether.min.js"></script>
	<script src="<?php echo base_url();?>/assets/bootstrap/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url();?>/assets/dropdown/js/script.min.js"></script>
	<script src="<?php echo base_url();?>/assets/touchswipe/jquery.touch-swipe.min.js"></script>
	<script src="<?php echo base_url();?>/assets/parallax/jarallax.min.js"></script>
	<script src="<?php echo base_url();?>/assets/ytplayer/jquery.mb.ytplayer.min.js"></script>
	<script src="<?php echo base_url();?>/assets/vimeoplayer/jquery.mb.vimeo_player.js"></script>
	<script src="<?php echo base_url();?>/assets/smoothscroll/smooth-scroll.js"></script>
	<script src="<?php echo base_url();?>/assets/theme/js/script.js"></script>
	<script src="<?php echo base_url();?>/assets/formoid/formoid.min.js"></script>
<!-- <script type="text/javascript">
	// Adjust the "querySelector" value to target your image
	document.addEventListener('DOMContentLoaded', function () {
		document.body.classList.add('js-loading');
		window.addEventListener("load", showPage);
	}
	

	function showPage() {
	  document.body.classList.remove('js-loading');
	}
</script> -->


</body>
</html>