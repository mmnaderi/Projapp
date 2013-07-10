$(document).ready(function() {
	
	// Nivo slider
	$('#slideshow').nivoSlider({
		effect: 'random',
		slices: 10,
		animSpeed: 500,
		pauseTime: 5000,
		directionNav: true, //Next & Prev
		directionNavHide: true, //Only show on hover
		controlNav: true, //1,2,3...
		keyboardNav: true, //Use left & right arrows
		captionOpacity: 1, //Universal caption opacity
		pauseOnHover: true //Stop animation while hovering
	});
	
	$('#slideshow').find('.nivo-slice:first').addClass('roundleft');
	$('#slideshow').find('.nivo-slice:last').addClass('roundright');
	
	
	// Fancy modals
	$("a.fancybox, #portfolio .project_small a").fancybox({
		'overlayOpacity' : 0.5,
		'overlayColor' : '#000'
	});


	// Pagetitle search bar
	$('.pagetitle form input.text').click(function() { $(this).attr('value', ''); });
	
	
	// PNG fix
	if(jQuery.browser.version.substr(0,1) < 7) {
		DD_belatedPNG.fix('#header h1, #holder, #content blockquote, #content form input.text, #content form textarea, .blogpost .cmntshead .rss, #services ul li h3, .project_small, #logos li img, #footer .left a, .nivo-controlNav, .nivo-controlNav a, .nivo-directionNav a');
	}
	
});