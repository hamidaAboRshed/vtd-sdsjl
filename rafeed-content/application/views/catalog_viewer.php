<!doctype html>
<html lang="en">
<head>
<title>Rafeed Catalog Viewer</title>
<meta charset="UTF-8">
<!-- <meta http-equiv="X-UA-Compatible" content="IE=edge"> -->
<!--<meta name="author" content="Hamida Abo Rshed, hamida.a@atclighting.co">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1"> 
<meta name="description" content="Lighting Company Catalog.">
<meta name="keywords" content="downlight, spotlight, Lamp, Commercial Light, Grille light, Panel light, Flood light, Street light">-->
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1"> 
<meta name="copyright"content="Rafeed">
<meta name="author" content="Hamida Abo Rshed, hamida.a@atclighting.co">
<meta name="designer" content="Mazen Kudmani, mazen.k@atclighting.co">
<meta name="designer" content="Kawther alhamwi, design@atclighting.co">
<meta name="owner" content="Rafeed Company">
<meta name="url" content="www.rafeed.co">
<meta name="category" content="First Arabic Brand in Middle East">

<link rel="shortcut icon" href="<?php echo base_url();?>/assets/images/home-product/logo-rafeed-dark.png" type="image/x-icon">
<script type="text/javascript" src="<?php echo base_url();?>/assets/flip/extras/jquery.min.1.7.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>/assets/flip/extras/jquery-ui-1.8.20.custom.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>/assets/flip/extras/modernizr.2.5.3.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>/assets/flip/lib/hash.js"></script>
<link rel="stylesheet" href="<?php echo base_url();?>/assets/theme/css/custom.css">
<link rel="stylesheet" href="<?php echo base_url();?>/assets/bootstrap/css/bootstrap-grid.min.css">
<link rel="stylesheet" href="<?php echo base_url();?>/assets/icons/font-awesome/css/font-awesome.min.css"/>
</head>
<style>

body{
	background-color: #f6f6f6;
	background-image: linear-gradient(315deg, #f6f6f6 0%, #e9e9e9 74%);
    height: 100vh;
}

.flip-header, .flip-footer{
    background-color: #333333; 
    margin: 0px;
}
.flip-header p{
	margin: 0px;
    /*padding: 10px;*/
    padding: 13px 0px;
    color: #F5F5F5;
    font-family: "Helvetica-Neue-Light";
    font-size: 1.2rem;
}
.brand img{
	margin: 10px;
}

.zoom-icon{
	top: 10px;
    right: 10px;
}

.flip-footer{
    padding: 0px;
    bottom: 0;
    position: absolute;
    width: 100%;
}
.flip-footer p{
	margin: 0;
	font-family: "Helvetica-Neue-Light";
}
#share-buttons{
    margin-bottom: 5px;
}
.flip-footer a{
    color: #ddd;
    font-family: "Helvetica-Neue-Light";
    font-size: 1.1rem;
}
.flip-footer i{
	color: #ddd;
	border-color: #ddd;
}
</style>
<body>
<h1 class="hide">Rafeed Product Catalogue</h1>
<div id="canvas">
<div class="flip-header row">
	<div class="col-5">
		<a class="brand" href="/Home">
	      <img src="<?php echo base_url();?>/assets/images/logo/rafeed/rafeed-logo.png" alt="rafeed-logo" title="" style="height: 1.3rem;">
	    </a>
	</div>
	<div class="col">
		<p>
			Catalogue Viewer
		</p>
	</div>
	<div class="zoom-icon zoom-icon-in"></div>
</div>
<div class="magazine-viewport">
	<div class="container">
		<div class="magazine">
			<!-- Next button -->
			<div ignore="1" class="next-button"></div>
			<!-- Previous button -->
			<div ignore="1" class="previous-button"></div>
		</div>
	</div>
	<div class="bottom">
		<div id="slider-bar" class="turnjs-slider">
			<div id="slider"></div>
		</div>
	</div>
</div>
<div class="flip-footer row">
	<div class="col" style="    padding: 15px;">
		<a class="brand" href="/Home">
			Go back to Rafeed website
		</a>
	</div>
	<div class="col" style="margin-top: 5px;    text-align: right;">
		<?php $this->load->view('includes/share_links');?>
	</div>
</div>

<script type="text/javascript">

function loadApp() {

 	$('#canvas').fadeIn(1000);

 	var flipbook = $('.magazine');

 	// Check if the CSS was already loaded
	
	if (flipbook.width()==0 || flipbook.height()==0) {
		setTimeout(loadApp, 10);
		return;
	}
	
	<?php $this->load->view('includes/'.$book_name.'_book.php');?>

	// Zoom.js

	$('.magazine-viewport').zoom({
		flipbook: $('.magazine'),

		max: function() { 
			
			return largeMagazineWidth()/$('.magazine').width();

		}, 

		when: {
			swipeLeft: function() {

				$(this).zoom('flipbook').turn('next');

			},

			swipeRight: function() {
				
				$(this).zoom('flipbook').turn('previous');

			},

			resize: function(event, scale, page, pageElement) {

				if (scale==1)
					loadSmallPage(page, pageElement);
				else
					loadLargePage(page, pageElement);

			},

			zoomIn: function () {

				$('#slider-bar').hide();
				$('.made').hide();
				$('.magazine').removeClass('animated').addClass('zoom-in');
				$('.zoom-icon').removeClass('zoom-icon-in').addClass('zoom-icon-out');
				
				if (!window.escTip && !$.isTouch) {
					escTip = true;

					$('<div />', {'class': 'exit-message'}).
						html('<div>Press ESC to exit</div>').
							appendTo($('body')).
							delay(2000).
							animate({opacity:0}, 500, function() {
								$(this).remove();
							});
				}
			},

			zoomOut: function () {

				$('#slider-bar').fadeIn();
				$('.exit-message').hide();
				$('.made').fadeIn();
				$('.zoom-icon').removeClass('zoom-icon-out').addClass('zoom-icon-in');

				setTimeout(function(){
					$('.magazine').addClass('animated').removeClass('zoom-in');
					resizeViewport();
				}, 0);

			}
		}
	});

	// Zoom event

	if ($.isTouch)
		$('.magazine-viewport').bind('zoom.doubleTap', zoomTo);
	else
		$('.magazine-viewport').bind('zoom.tap', zoomTo);


	// Using arrow keys to turn the page

	$(document).keydown(function(e){

		var previous = 37, next = 39, esc = 27;

		switch (e.keyCode) {
			case previous:

				// left arrow
				$('.magazine').turn('previous');
				e.preventDefault();

			break;
			case next:

				//right arrow
				$('.magazine').turn('next');
				e.preventDefault();

			break;
			case esc:
				
				$('.magazine-viewport').zoom('zoomOut');	
				e.preventDefault();

			break;
		}
	});

	// URIs - Format #/page/1 

	Hash.on('^page\/([0-9]*)$', {
		yep: function(path, parts) {
			var page = parts[1];

			if (page!==undefined) {
				if ($('.magazine').turn('is'))
					$('.magazine').turn('page', page);
			}

		},
		nop: function(path) {

			if ($('.magazine').turn('is'))
				$('.magazine').turn('page', 1);
		}
	});


	$(window).resize(function() {
		resizeViewport();
	}).bind('orientationchange', function() {
		resizeViewport();
	});

	// Regions

	if ($.isTouch) {
		$('.magazine').bind('touchstart', regionClick);
	} else {
		$('.magazine').click(regionClick);
	}

	// Events for the next button

	$('.next-button').bind($.mouseEvents.over, function() {
		
		$(this).addClass('next-button-hover');

	}).bind($.mouseEvents.out, function() {
		
		$(this).removeClass('next-button-hover');

	}).bind($.mouseEvents.down, function() {
		
		$(this).addClass('next-button-down');

	}).bind($.mouseEvents.up, function() {
		
		$(this).removeClass('next-button-down');

	}).click(function() {
		
		$('.magazine').turn('next');

	});

	// Events for the next button
	
	$('.previous-button').bind($.mouseEvents.over, function() {
		
		$(this).addClass('previous-button-hover');

	}).bind($.mouseEvents.out, function() {
		
		$(this).removeClass('previous-button-hover');

	}).bind($.mouseEvents.down, function() {
		
		$(this).addClass('previous-button-down');

	}).bind($.mouseEvents.up, function() {
		
		$(this).removeClass('previous-button-down');

	}).click(function() {
		
		$('.magazine').turn('previous');

	});


	// Slider

	$( "#slider" ).slider({
		min: 1,
		max: numberOfViews(flipbook),

		start: function(event, ui) {

			if (!window._thumbPreview) {
				_thumbPreview = $('<div />', {'class': 'thumbnail'}).html('<div></div>');
				setPreview(ui.value);
				_thumbPreview.appendTo($(ui.handle));
			} else
				setPreview(ui.value);

			moveBar(false);

		},

		slide: function(event, ui) {

			setPreview(ui.value);

		},

		stop: function() {

			if (window._thumbPreview)
				_thumbPreview.removeClass('show');
			
			$('.magazine').turn('page', Math.max(1, $(this).slider('value')*2 - 2));

		}
	});

	resizeViewport();

	$('.magazine').addClass('animated');

}

// Zoom icon

 $('.zoom-icon').bind('mouseover', function() { 
 	
 	if ($(this).hasClass('zoom-icon-in'))
 		$(this).addClass('zoom-icon-in-hover');

 	if ($(this).hasClass('zoom-icon-out'))
 		$(this).addClass('zoom-icon-out-hover');
 
 }).bind('mouseout', function() { 
 	
 	 if ($(this).hasClass('zoom-icon-in'))
 		$(this).removeClass('zoom-icon-in-hover');
 	
 	if ($(this).hasClass('zoom-icon-out'))
 		$(this).removeClass('zoom-icon-out-hover');

 }).bind('click', function() {

 	if ($(this).hasClass('zoom-icon-in'))
 		$('.magazine-viewport').zoom('zoomIn');
 	else if ($(this).hasClass('zoom-icon-out'))	
		$('.magazine-viewport').zoom('zoomOut');

 });

 $('#canvas').hide();


<?php $this->load->view('includes/'.$book_name.'_book_files.php');?>

</script>

</body>
</html>