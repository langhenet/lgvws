(function($)
{ 
	"use strict";

	
	$('body').on('click','.av-lazyload-video-embed .av-click-to-play-overlay', function(e){
		
		//	check if videos are disabled by user setting via cookie - or user must opt in.
		var cookie_check = $('html').hasClass('av-cookies-needs-opt-in') || $('html').hasClass('av-cookies-can-opt-out');
		var allow_continue = true;

		if( cookie_check )
		{
			if( ! document.cookie.match(/aviaCookieConsent/) || sessionStorage.getItem( 'aviaCookieRefused' ) )
			{
				allow_continue = false;
			}
			else
			{
				if( ! document.cookie.match(/aviaPrivacyRefuseCookiesHideBar/) )
				{
					allow_continue = false;
				}
				else if( ! document.cookie.match(/aviaPrivacyEssentialCookiesEnabled/) )
				{
					allow_continue = false;
				}
				else if( document.cookie.match(/aviaPrivacyVideoEmbedsDisabled/) )
				{
					allow_continue = false;
				}
			}
		}
		
		if( ! allow_continue )
		{
			if( typeof e.originalEvent == 'undefined' ) { return; } //human click only
			
			var src_url = $(this).parents('.avia-video').data('original_url');
			if( src_url ) window.open(src_url , '_blank'); 
			
			return;
		}
		
		
		var clicked 	= $(this),
			container	= clicked.parents('.av-lazyload-video-embed'),
			video		= container.find('.av-video-tmpl').html();
			
			container.html(video);
	});
	
	$('.av-lazyload-immediate .av-click-to-play-overlay').trigger('click');
	
}(jQuery));