// makes sure the whole site is loaded
	jQuery(window).load(function() {
        // will first fade out the loading animation
    jQuery("#status1").fadeOut();
        // will fade out the whole DIV that covers the website.
    jQuery("#preloader").delay(10).fadeOut("slow");
})