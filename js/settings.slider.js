jQuery(function(){
    jQuery('.cosmo-slider').slides({
        "generateNextPrev":SL_BUTTONS ,
        pagination: true,
        "generatePagination":SL_PAGINATION ,
        "slideSpeed":SL_SLIDESPEED ,
        "effect":SL_EFFECT,
        "randomize":SL_RANDOMIZE,
        "hoverPause":SL_PAUSE,
        "play":SL_PLAYSPEED,
        "next":'next_navigation',
        "prev":'prev_navigation',
		"preload":false,
        paginationClass: 'pagination',

		"pause":2500,
		"animationStart":function(){
			jQuery('.caption').animate({
				"bottom":-250
			},100);
		},
		"animationComplete": function(current){
			jQuery('.caption').animate({
				"bottom":30
			},400);
			if (window.console && console.log) {
				console.log(current);
			};
		}
	});

    jQuery('.caption').animate({
        "bottom":30
    } , 400 );

    
    /*	slider show/hide navigation */
	
	jQuery('.slides_control').mouseover(function() {
		jQuery('.next_navigation').show();
		jQuery('.prev_navigation').show();
	}).mouseout(function(){
		jQuery('.next_navigation').hide();
		jQuery('.prev_navigation').hide();  
	});
	
	jQuery('.next_navigation').mouseover(function() {
		jQuery('.next_navigation').show();
		jQuery('.prev_navigation').show();
	}).mouseout(function(){
		jQuery('.next_navigation').hide();
		jQuery('.prev_navigation').hide();  
	});
	
	jQuery('.prev_navigation').mouseover(function() {
		jQuery('.next_navigation').show();
		jQuery('.prev_navigation').show();
	}).mouseout(function(){
		jQuery('.next_navigation').hide();
		jQuery('.prev_navigation').hide();  
	});
	
	/*slider for animated sponsors*/
	//Sponsor widget
	if (jQuery().slides) { 
		jQuery(".cosmo-sponsor").slides({
			play: 5000,
			effect: 'fade',
			generatePagination: false,
			autoHeight: true
		});	
		
	}	
	
	/* testimonials */
    if (jQuery().slides) {
        jQuery(".cosmo-testimonials").slides({
            play: 0,
            //generateNextPrev: true,
            next: "next",
            prev: "prev",
            generatePagination: false,
            autoHeight: true
        });

    }
});

