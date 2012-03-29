/* when j is pressed we go to the next post */

var h2top = 0;

function go_to_next_post(){

    jQuery(function(){
        if( jQuery('nav.hotkeys-meta span').length ){
            jQuery('nav.hotkeys-meta span').each(function(){
                if( jQuery( this ).hasClass( 'nav-next' ) ){
                    if( jQuery( 'a' , this ).length ){
                        document.location.href= jQuery( 'a' , this ).attr('href');
                        return 0;
                    }
                }
            });
        }else{
            scrollTop = jQuery(window).scrollTop();
            jQuery('#main .post').each(function(i, h2){ /* loop through article headings */
                h2top = jQuery(h2).offset().top ; /* get article heading top */
                if ( scrollTop < h2top - 65 ) { /* compare if document is below heading */
                    jQuery.scrollTo( h2top - 55, 400); /* scroll to in .8 of a second */
                    return false; /* exit function */
                }
            });
        }
    });
}

function go_to_prev_post(){
	/* when k is pressed we go to the previous post */
	/* first add the reverse plugin to reverse the headings: */
    jQuery(function(){
        if( jQuery('nav.hotkeys-meta span').length ){
            jQuery('nav.hotkeys-meta span').each(function(){
                if( jQuery( this ).hasClass( 'nav-previous' ) ){
                    if( jQuery( 'a' , this ).length ){
                        document.location.href= jQuery( 'a' , this ).attr('href');
                        return 0;
                    }
                }
            });
        }else{
            jQuery.fn.reverse = function() {
                return this.pushStack(this.get().reverse(), arguments);
            };

            scrollTop = jQuery(window).scrollTop();

            jQuery('.post').reverse().each(function(i, h2){ /* loop through article headings */
                h2top = jQuery(h2).offset().top; /* get article heading top */
                if (scrollTop > h2top - 55) { /* compare if document is above heading */
                    jQuery.scrollTo(h2top-55, 400); /* scroll to in .8 of a second */
                    return false; /* exit function */
                }
            });
        }
    });
}

/* comments */
function go_to_comments(){
    var scrollTop = jQuery(window).scrollTop();

    var comments = jQuery('#comments').offset().top;
    if (scrollTop < comments - 50 || scrollTop > comments - 50 ) { /* compare if document is above heading */
        jQuery.scrollTo( comments - 50 , 400); /* scroll to in .8 of a second */
        return false; /* exit function */
    }
    return false;
}

function open_next_post_comments(){

	scrollTop = jQuery(window).scrollTop();
	jQuery('#main .post').each(function(i, h3){ /* loop through article headings */
	  h2top = jQuery(h3).offset().top ; /* get article heading top */

	  if ( scrollTop < h2top ) { /* compare if document is below heading */
		if(jQuery(h3).find('h2 a , h1 a').hasClass('simplemodal-nsfw')){
			jQuery(h3).find('h2 a , h1 a').click();
		}else{
			var permalink = (jQuery(h3).find('h2 a , h1 a').attr('href'));
			if( jQuery('#comments').length > 0 ){
				go_to_comments();
				return false;
			}
			if(permalink){
				window.location.href = permalink + '#comments';
			}
		}	
		return false; /* exit function */
	  }
	});
}

/* preview post */
function open_next_post(){

	scrollTop = jQuery(window).scrollTop();
	jQuery('#main .post').each(function(i, h3){ /* loop through article headings */
	  h2top = jQuery(h3).offset().top ; /* get article heading top */

	  if (scrollTop<h2top) { /* compare if document is below heading */
		if(jQuery(h3).find('h2 a , h1 a').hasClass('simplemodal-nsfw')){
			jQuery(h3).find('h2 a , h1 a').click();
		}else{	
		
			var permalink = (jQuery(h3).find('h2 a , h1 a').attr('href'));
			if(permalink){
				window.location.href = permalink;
			}
		}
		return false; /* exit function */
	  }
	});
}



function like(){
	scrollTop = jQuery(window).scrollTop();
 	jQuery('#main .post,.single h1.entry-title').each(function(i, h2){ /* loop through article headings */

        h2top = jQuery(h2).offset().top ; /* get article heading top */

        if (scrollTop<h2top-19) { /* compare if document is below heading */

        	jQuery(this).find('span.set-like.voteaction').click();
        	return false; /* exit function */
        }
    });
}

function share(){
	scrollTop = jQuery(window).scrollTop();
 	jQuery('#main .post').each(function(i, h2){ /* loop through article headings */
        h2top = jQuery(h2).offset().top ; /* get article heading top */
        if (scrollTop<h2top-10) { /* compare if document is below heading */
        	jQuery.scrollTo(h2top-30, 800); // scroll to in .8 of a second
            return false; /* exit function */
        }
    });

}

jQuery(document).ready(function(){

	jQuery(document).focus();
	jQuery(document).keyup(function(e){

		if (jQuery(e.target).is("textarea, input[type=text], input[type=password]")) return true;

		/* list all CTRL + key combinations you want to disable */
        var forbiddenKeys = new Array( 'j' , 'k' , 'v' , 'c' , 'l' , 's' , 'r' );

        if(window.event)
        {
                key = window.event.keyCode;     /* IE */
                if(window.event.ctrlKey)
                        isCtrl = true;
                else
                        isCtrl = false;
        }else{
                key = e.which;     /* firefox & others */
                if(e.ctrlKey)
                        isCtrl = true;
                else
                        isCtrl = false;
        }

        /* if ctrl is pressed check if other key is in forbidenKeys array */
        if(isCtrl)
        {
                for(i=0; i<forbiddenkeys.length; i++)
                {
                        /* case-insensitive comparation */
                        if(forbiddenKeys[i].toLowerCase() == String.fromCharCode(key).toLowerCase())
                        {
                                return false;
                        }
                }
        }

		if (e.keyCode) {
			key = e.keyCode; /* for all Browser */
		}else if(e.which) {
			key = e.which;   /* for ie */
		}

		switch(key)
		{
		case 74: /* J */
            if( jQuery('.hotkeys-meta.sticky-bar span.nav-next a').length > 0 ){
                document.location.href=jQuery('.hotkeys-meta.sticky-bar span.nav-next a').attr('href');
            }else{
                go_to_next_post();
            }
			jQuery(document).focus();
            break;
		case 75: /* K */
            if( jQuery('.hotkeys-meta.sticky-bar span.nav-previous a').length > 0 ){
                document.location.href=jQuery('.hotkeys-meta.sticky-bar span.nav-previous a').attr('href');
            }else{
                go_to_prev_post();
            }
			jQuery(document).focus();
            break;
		case 86: /* V */
			open_next_post();
			jQuery(document).focus();
            break;
		case 67: /* C */
			open_next_post_comments()
			jQuery(document).focus();
            break;
		case 76: /* L for like */
			like();
			jQuery(document).focus();
            break;
		case 83: /* S for Share */
			share();
			jQuery(document).focus();
            break;
		case 82: /* R for Random */
			act.go_random();
			jQuery(document).focus();
            break;
		case 39: /* right arrow */
			/*add here code for next page*/
			if(jQuery('.hotkeys-meta.sticky-bar span.nav-next a').attr('href')){
				document.location.href=jQuery('.hotkeys-meta.sticky-bar span.nav-next a').attr('href');
			}	
			jQuery(document).focus();
            break;
		case 37: /* left arrow */
			/*add here code for prev page*/ 
			if(jQuery('.hotkeys-meta.sticky-bar span.nav-previous a').attr('href')){
				document.location.href=jQuery('.hotkeys-meta.sticky-bar span.nav-previous a').attr('href');
			}	
			jQuery(document).focus();
            break;
        case 27 : {
            if( jQuery('#keyboard-container').length > 0 ){
                keyboard.hide();
            }
            jQuery(document).focus();
            break;
        }
		default:

		}
	});

	jQuery('#keywords').unbind('keyup');

    jQuery(function(){
        jQuery( 'nav.hotkeys-meta.nav a' ).click(function(){
            if( jQuery( this ).attr('href') == '#next' ){
                go_to_next_post();
                jQuery(document).focus();
            }else{
                go_to_prev_post();
                jQuery(document).focus();
            }
        });
    });

	
	
});