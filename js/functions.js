
function setCookie(c_name,value,exdays)
{
	var exdate=new Date();
	exdate.setDate(exdate.getDate() + exdays);
	var c_value=escape(value) + ((exdays==null) ? "" : "; expires="+exdate.toUTCString());
	document.cookie=c_name + "=" + c_value;
}


jQuery(document).ready(function(){
  
	/* Accordion */
	jQuery('.cosmo-acc-container').hide();
	jQuery('.cosmo-acc-trigger:first').addClass('active').next().show();
	jQuery('.cosmo-acc-trigger').click(function(){
		if( jQuery(this).next().is(':hidden') ) {
			jQuery('.cosmo-acc-trigger').removeClass('active').next().slideUp();
			jQuery(this).toggleClass('active').next().slideDown();
		}
		return false;
	});
	
	//Superfish menu
	jQuery("ul.sf-menu").supersubs({
			minWidth:    12,
			maxWidth:    32,
			extraWidth:  1
		}).superfish({
			delay: 200,
			speed: 250
		});
		
	/*Fixed user bar*/
	jQuery(function () {
		var msie6 = jQuery.browser == 'msie' && jQuery.browser.version < 7;
		if (!msie6 && jQuery('.sticky-bar').length != 0) {
			var top = jQuery('#sticky-bar').offset().top - parseFloat(jQuery('#sticky-bar').css('margin-top').replace(/auto/, 0));
			jQuery(window).scroll(function (event) {
				// what the y position of the scroll is
				var y = jQuery(this).scrollTop();
				// whether that's below the form
				if (y >= top-0) {
					// if so, ad the fixed class
					jQuery('#sticky-bar').addClass('fixed');
				} else {
					// otherwise remove it
					jQuery('#sticky-bar').removeClass('fixed');
				}
			});
		}
	});
	
	/* Hide Tooltip */
	jQuery(function() {
		jQuery('a.close').click(function() {
			jQuery(jQuery(this).attr('href')).slideUp();
            jQuery.cookie(cookies_prefix + "_tooltip" , 'closed' , {expires: 365, path: '/'});
            jQuery('.header-delimiter').removeClass('hidden');
			return false;
		});
	});
	
	/* Mosaic fade */
	jQuery('.readmore').mosaic();
	jQuery('.circle, .gallery-icon').mosaic({
		opacity:	0.5
	});
	jQuery('.fade').mosaic({
		animation:	'slide'
	});

	
	/* Hide title from menu items */
	jQuery(function(){
		jQuery("li.menu-item > a").hover(function(){
			jQuery(this).stop().attr('title', '');},
			function(){jQuery(this).stop().attr();
		});
		
		  
	});
	
	/* twitter widget */
	if (jQuery().slides) {
		jQuery(".dynamic .cosmo_twitter").slides({
			play: 5000,
			effect: 'fade',
			generatePagination: false,
			autoHeight: true
		});
	}
	
	/* show/hide color switcher */
	jQuery('.show_colors').toggle(function(){
		jQuery(".style_switcher").animate({
		    left: "10px"

		  }, 500 );
	}, function () {
		jQuery(".style_switcher").animate({
		    left: "-152px"

		  }, 500 );

	});
	
	 /* widget tabber */
    jQuery( 'ul.widget_tabber li a' ).click(function(){
        jQuery(this).parent('li').parent('ul').find('li').removeClass('active');
        jQuery(this).parent('li').parent('ul').parent('div').find( 'div.tab_menu_content.tabs-container').fadeTo( 200 , 0 );
        jQuery(this).parent('li').parent('ul').parent('div').find( 'div.tab_menu_content.tabs-container').hide();
        jQuery( jQuery( this ).attr('href') + '_panel' ).fadeTo( 600 , 1 );
        jQuery( this ).parent('li').addClass('active');
    });
	
	/*initialize tabs*/
	jQuery(function() { 
		jQuery('.cosmo-tabs').tabs({ fxFade: true, fxSpeed: 'fast' }); 
		jQuery('.tabs-nav li:first-child a').click();
	});
	
	/*toogle*/
	/*Case when by default the toggle is closed */
	jQuery(".open_title").toggle(function(){ 
			jQuery(this).next('div').slideDown();
			jQuery(this).find('a').removeClass('show');
			jQuery(this).find('a').addClass('hide');
			jQuery(this).find('.title_closed').hide();
			jQuery(this).find('.title_open').show();
		}, function () {
		
			jQuery(this).next('div').slideUp();
			jQuery(this).find('a').removeClass('hide');
			jQuery(this).find('a').addClass('show');		 
			jQuery(this).find('.title_open').hide();
			jQuery(this).find('.title_closed').show();
			
	});
	
	/*Case when by default the toggle is oppened */		
	jQuery(".close_title").toggle(function(){ 
			jQuery(this).next('div').slideUp();
			jQuery(this).find('a').removeClass('hide');
			jQuery(this).find('a').addClass('show');		 
			jQuery(this).find('.title_open').hide();
			jQuery(this).find('.title_closed').show();
		}, function () {
			jQuery(this).next('div').slideDown();
			jQuery(this).find('a').removeClass('show');
			jQuery(this).find('a').addClass('hide');
			jQuery(this).find('.title_closed').hide();
			jQuery(this).find('.title_open').show();
			
	});	
	
	/*Accordion*/
	jQuery('.cosmo-acc-container').hide();
	jQuery('.cosmo-acc-trigger:first').addClass('active').next().show();
	jQuery('.cosmo-acc-trigger').click(function(){
		if( jQuery(this).next().is(':hidden') ) {
			jQuery('.cosmo-acc-trigger').removeClass('active').next().slideUp();
			jQuery(this).toggleClass('active').next().slideDown();
		}
		return false;
	}); 
	
	//Scroll to top
	jQuery(window).scroll(function() {
		if(jQuery(this).scrollTop() != 0) {
			jQuery('#toTop').fadeIn();	
		} else {
			jQuery('#toTop').fadeOut();
		}
	});
	jQuery('#toTop').click(function() {
		jQuery('body,html').animate({scrollTop:0},300);
	});
	
	jQuery('div.sticky-bar li.my-add').mouseover(function () {
		jQuery('.show-first').hide();
		jQuery('.show-hover').fadeIn(10);
	});
	
	jQuery('#sticky-bar').mouseleave(function () {
		jQuery('.show-hover').hide(); 
		//jQuery('.show-first').show('slow');
		jQuery('.show-first').fadeIn(10);
	});
});

/* grid / list switch */
jQuery(document).ready(function(){
    jQuery('span.list-grid  a.switch').click(function(){
        var self = this;
        if( jQuery( this ).hasClass('side') ){
            if( jQuery( this ).hasClass('swap') ){
                jQuery( self ).parent('span').parent('div.grid-view').children('div.loop-container-view').html( '<img src="'+ themeurl +'/images/loading.gif" style="background:none; float:none; text-align:center; width:auto; height:auto; margin:0px auto !important; clear:both; display:block;" />' );
                /* toogle grid -> list */
                jQuery.post( ajaxurl , 
                { 'action' : 'switch' , 'template' : jQuery( self ).attr('rel') , 'grid' : 0 , 'query' : jQuery( '#query-' + jQuery( self ).attr('rel') ).val() } , 
                function( result ){
                    jQuery( self ).parent('span').parent('div.grid-view').children('div.loop-container-view.grid').html( result );
                    if( typeof jQuery( self ).attr('index') !== "undefined" && jQuery( self ).attr('index') !== false ){
                        if( !( jQuery('div.clearfix.get-more p a').length ) ){
                            jQuery( self ).parent('span').parent('div.grid-view').append('<div class="clearfix get-more"><p class="button"><a id="get-more" index="' + jQuery( self ).attr('index') + '" href="javascript:act.my_likes( jQuery(\'#get-more\').attr(\'index\') , [] , 0 );">get more</a></p></div>');
                        }
                    }
                    jQuery( self ).removeClass('swap');
                    jQuery( self ).parent('span').parent('div.grid-view').children('div.loop-container-view.grid').addClass('list');
                    jQuery( self ).parent('span').parent('div.grid-view').children('div.loop-container-view.grid').removeClass('grid');
                    jQuery( self ).parent('span').parent('div.grid-view').addClass('list-view');
                    jQuery( self ).parent('span').parent('div.grid-view').removeClass('grid-view');
                    jQuery.cookie(cookies_prefix + "_grid_" + jQuery( self ).attr('rel') , '' , {expires: 365, path: '/'});
                    var e = document.createElement('script');
                    e.src = document.location.protocol + '//connect.facebook.net/en_US/all.js';
                    e.async = true;
                    document.getElementById('fb-root').appendChild(e);
                    jQuery('.readmore').mosaic();
                });
                
            }else{
                jQuery( self ).parent('span').parent('div.list-view').children('div.loop-container-view').html( '<img src="'+ themeurl +'/images/loading.gif" style="background:none; float:none; text-align:center; width:auto; height:auto; margin:0px auto !important; clear:both; display:block;" />' );
                /* toogle list -> grid */
                jQuery.post( ajaxurl , 
                { 'action' : 'switch' , 'template' : jQuery( this ).attr('rel') , 'grid' : 1 , 'query' : jQuery( '#query-' + jQuery( self ).attr('rel') ).val() } , 
                function( result ){
                    jQuery( self ).parent('span').parent('div.list-view').children('div.loop-container-view.list').html( result );
                    if( typeof jQuery( self ).attr('index') !== "undefined" && jQuery( self ).attr('index') !== false ){
                        if( !( jQuery('div.clearfix.get-more p a').length ) ){
                            jQuery( self ).parent('span').parent('div.list-view').append('<div class="clearfix get-more"><p class="button"><a id="get-more" index="' + jQuery( self ).attr('index') + '" href="javascript:act.my_likes( jQuery(\'#get-more\').attr(\'index\') , [] , 0 );">get more</a></p></div>');
                        }
                    }
                    jQuery( self ).addClass('swap');
                    jQuery( self ).parent('span').parent('div.list-view').children('div.loop-container-view.list').addClass('grid');
                    jQuery( self ).parent('span').parent('div.list-view').children('div.loop-container-view.list').removeClass('list');
                    jQuery( self ).parent('span').parent('div.list-view').addClass('grid-view');
                    jQuery( self ).parent('span').parent('div.list-view').removeClass('list-view');
                    jQuery.cookie(cookies_prefix + "_grid_" + jQuery( self ).attr('rel') , 'grid' , {expires: 365, path: '/'});
                    jQuery('.readmore').mosaic();
                });
                
            }
        }else{
            jQuery('div.loop-container-view').html( '<img src="'+ themeurl +'/images/loading.gif"  style="background:none; text-align:center; float:none; width:auto; height:auto; margin:0px auto !important; clear:both; display:block;" />' );
            if( jQuery( this ).hasClass('swap') ){
                /* toogle grid -> list */
                jQuery.post( ajaxurl , 
                { 'action' : 'switch' , 'template' : jQuery( self ).attr('rel') , 'grid' : 0 , 'query' : jQuery( '#query-' + jQuery( self ).attr('rel') ).val() } , 
                function( result ){ 
                    jQuery('div.loop-container-view.grid').html( result );
                    jQuery( self ).removeClass('swap');
                    jQuery('div.loop-container-view.grid').addClass('list');
                    jQuery('div.loop-container-view.grid').removeClass('grid');
                    jQuery('div.grid-view').addClass('list-view');
                    jQuery('div.grid-view').removeClass('grid-view');
                    jQuery.cookie(cookies_prefix + "_grid_" + jQuery( self ).attr('rel') , '' , {expires: 365, path: '/'});
                    var e = document.createElement('script');
                    e.src = document.location.protocol + '//connect.facebook.net/en_US/all.js';
                    e.async = true;
                    document.getElementById('fb-root').appendChild(e);
                    jQuery('.readmore').mosaic();
                });
            }else{
                /* toogle list -> grid */
                jQuery.post( ajaxurl , 
                { 'action' : 'switch' , 'template' : jQuery( self ).attr('rel') , 'grid' : 1 , 'query' : jQuery( '#query-' + jQuery( self ).attr('rel') ).val() } , 
                function( result ){
                    jQuery('div.loop-container-view.list').html( result ); 
                    jQuery( self ).addClass('swap');
                    jQuery('div.loop-container-view.list').addClass('grid');
                    jQuery('div.loop-container-view.list').removeClass('list');
                    jQuery('div.list-view').addClass('grid-view');
                    jQuery('div.list-view').removeClass('list-view');
                    jQuery.cookie(cookies_prefix + "_grid_" + jQuery( self ).attr('rel') , 'grid' , {expires: 365, path: '/'});
                    jQuery('.readmore').mosaic();
                });
            }
        }
    });
});


/*functions for style switcher*/

function changeBgColor(rd_id,element){

    if(element == "footer"){
		jQuery('.b_head').css('background-color', '#'+jQuery('#'+rd_id).val());
		jQuery('.b_body_f').css('background-color', '#'+jQuery('#'+rd_id).val());

		jQuery('#link-color').val('#'+jQuery('#'+rd_id).val());
		jQuery.cookie(cookies_prefix + "_b_f_color",'#' + jQuery('#'+rd_id).val(), {expires: 365, path: '/'});
    }
    else if(element == "content"){
    	jQuery('#main').css('background-color', '#'+jQuery('#'+rd_id).val());
    	jQuery('#content-link-color').val('#'+jQuery('#'+rd_id).val());
    	jQuery.cookie(cookies_prefix + "_content_bg_color",'#' + jQuery('#'+rd_id).val(), {expires: 365, path: '/'});
    }


    return false;
}

function setPickedColor(a,element){
	if(element == 'footer'){
		jQuery('.b_f_c').css('background-color', a);
		jQuery.cookie(cookies_prefix + "_footer_bg_color",a, {expires: 365, path: '/'}); /*de_css*/
	}
	else if(element == "content"){
		jQuery('body').css('background-color', a);
		jQuery.cookie(cookies_prefix + "_content_bg_color",a, {expires: 365, path: '/'});
	}

}

function setBgColor(rb_id,element){
	jQuery('#' + rb_id).trigger('click');
	changeBgColor(rb_id,element);
}

function setBgImage(rb_id){
	jQuery('#' + rb_id).trigger('click');
	changeBgImage(rb_id);
}

var keyboard = new Object();
keyboard.show = function( ){
    jQuery( document ).ready(function(){
        jQuery( '#lightbox-shadow' ).show();
        jQuery( '#keyboard-container #img' ).show();
        jQuery( '#keyboard-container img' ).show();
        jQuery( '#keyboard-container #img').css( { 'left' : parseInt( jQuery(document).width() - 35 ) + 'px' });
        jQuery( '#keyboard-container #img').animate({ 'width' : '748px' , 'top' : '100px' , 'left' : parseInt( ( jQuery(document).width() - 748) / 2 ) + 'px' , 'zIndex' : 9999 } , 200 );
        jQuery( '#keyboard-container img').animate({ 'width' : '748px' } , 200 );
        jQuery( '#keyboard-container #img p' ).css( { 'width' : '748px' });
        jQuery( '#keyboard-container #img p' ).show( 'slow' );
    });
}
keyboard.hide = function( ){
    jQuery( document ).ready(function(){
        jQuery( '#keyboard-container #img p' ).hide();
        jQuery( '#keyboard-container img').animate({ 'width' : '50px' } , 500 );
        jQuery( '#keyboard-container #img').animate({ 'width' : '50px' , 'top' : '45px' , 'left' :  parseInt( jQuery(document).width() - 35 ) + 'px'  } , 500 );
        jQuery( '#keyboard-container img' ).hide( 'slow' );
        jQuery( '#keyboard-container #img' ).hide( 'slow' );
        jQuery( '#lightbox-shadow' ).hide( );
    });
}
/*EOF functions for style switcher*/