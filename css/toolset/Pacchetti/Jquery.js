jQuery(document).scroll(function() {
    if (jQuery(this).scrollTop() > 1050) {
        jQuery('#sub-nav').addClass('lg-sticky');
        jQuery('.lg-after-sub-menu').addClass('lg-sticky');
    }
  else {
    jQuery('#sub-nav').removeClass('lg-sticky');
    jQuery('.lg-after-sub-menu').removeClass('lg-sticky');
  }
});


jQuery(document).scroll(function(){
  	var top = jQuery('#sub-nav').offset().top - jQuery(document).scrollTop();
    if (top < 0){
        jQuery('#sub-nav').addClass('lg-sticky');
    }
    if (top > 90){
        jQuery('#sub-nav').removeClass('lg-sticky');
    }
});
