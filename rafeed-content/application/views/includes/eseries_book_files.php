// Load the HTML4 version if there's not CSS transform

yepnope({
	test : Modernizr.csstransforms,
	yep: ['<?php echo base_url();?>/assets/flip/lib/turn.min.js'],
	nope: ['<?php echo base_url();?>/assets/flip/lib/turn.html4.min.js', '<?php echo base_url();?>/assets/flip/e-series/css/jquery.ui.html4.css'],
	both: ['<?php echo base_url();?>/assets/flip/lib/zoom.min.js', '<?php echo base_url();?>/assets/flip/e-series/css/jquery.ui.css', '<?php echo base_url();?>/assets/flip/e-series/js/magazine.js', '<?php echo base_url();?>/assets/flip/e-series/css/magazine.css'],
	complete: loadApp
});