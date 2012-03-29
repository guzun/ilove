/*
 * SimpleModal Login
 * Theme: default
 * Copyright (c) 2010 Eric Martin http://www.ericmmartin.com
 */
jQuery(function ($) {
    var SimpleModalLogin = {
        init: function () {
            var s = this;
            s.error = [];

            $('.simplemodal-overlay, .simplemodal-close').live('click' , function( e ){
                jQuery('.fb_connect').html( '<span class="fb-loading"></span>' );
            });

            $('.simplemodal-login, .simplemodal-register, .simplemodal-forgotpw, .simplemodal-nsfw , .simplemodal-none , .simplemodal-love ').live('click.simplemodal-login', function (e) {
                jQuery.post( ajaxurl , {
                    action : "fb_login"
                } , function( result ){
                    jQuery('.fb_connect').html( result );
                } );

                s.login = $('#loginform'),
                s.lostpw = $('#lostpasswordform'),
                s.register = $('#registerform');

                if ($(this).hasClass('simplemodal-login')) {
                    if( $(this).hasClass('simplemodal-none') ){
                        jQuery('.cosmo-box.warning').hide();
                    }

                    if( $(this).hasClass('simplemodal-submit')){
                        jQuery('.cosmo-box.warning').hide();
                        jQuery('.cosmo-box.submit-content').show();
                    }
                    s.form = '#loginform';
                    s.login.show();
                    s.lostpw.hide();
                    s.register.hide();
                }else if ($(this).hasClass('simplemodal-register')) {
                    s.form = '#registerform';
                    s.register.show();
                    s.login.hide();
                    s.lostpw.hide();
                }else if( $(this).hasClass('simplemodal-love') ){
                    jQuery('.cosmo-box').hide();
                    jQuery('.cosmo-box.love').show();
                    s.form = '#loginform';
                    s.login.show();
                    s.lostpw.hide();
                    s.register.hide();
                }else if( $(this).hasClass('simplemodal-nsfw') ){
                    jQuery('.cosmo-box').hide();
                    jQuery('.cosmo-box.nsfw').show();
                    s.form = '#loginform';
                    s.login.show();
                    s.lostpw.hide();
                    s.register.hide();
                }else {
                    s.form = '#lostpasswordform';
                    s.lostpw.show();
                    s.login.hide();
                    s.register.hide();
                }

                /*$("#simplemodal-login-form").modal({onOpen: function (dialog) {
					dialog.overlay.fadeIn('slow', function () {
						dialog.container.slideDown('slow', function () {
							dialog.data.fadeIn('slow');
						});
					});
				}});*/

                s.url = this.href;

                if (!$('#simplemodal-login-container').length) {
                    /*$('#simplemodal-login-form').modal({
                        overlayId: 'simplemodal-login-overlay',
                        containerId: 'simplemodal-login-container',
                        opacity:80,
                        onShow: SimpleModalLogin.show,
                        position: ['15%', null],
                        overlayClose:true  
                    });*/
					
					$('#simplemodal-login-form').modal({
						overlayId: 'simplemodal-login-overlay',
						containerId: 'simplemodal-login-container',
						minWidth: '350px',
						/*closeHTML: '<div class="close"><a href="#" class="simplemodal-close">x</a></div>',*/
						opacity:65,
						overlayClose:true,
						position:['0', null],
						onOpen:SimpleModalLogin.open,
						onShow:SimpleModalLogin.show,
						onClose:SimpleModalLogin.close
					});  
                }
                else {
                    SimpleModalLogin.show();
                }
                return false;
            });

            if (SimpleModalLoginL10n['shortcut'] === "true") {
                $(document).bind('keydown.simplemodal-login', SimpleModalLogin.keydown);
            }
        },
		open: function (d) {
			var s = SimpleModalLogin;
			s.modal = this;
			s.container = d.container[0];
			d.overlay.fadeIn('slow', function () {
				d.data.show();
				d.container.slideDown('slow', function () {
					s.modal.focus();
				});
			});
		},
        show: function (obj) { 
            var s = SimpleModalLogin;
            s.dialog = obj || s.dialog;
            s.modal = s.modal || this;
            var form = $(s.form, s.dialog.data[0]),
            fields = $('.simplemodal-login-fields', form[0]),
            activity = $('.simplemodal-login-activity', form[0]);

            // update and focus dialog
            s.dialog.container.css({
                height:'auto'
            });

            // remove any existing errors or messages
            s.clear(s.dialog.container[0]);

            form.unbind('submit.simplemodal-login').bind('submit.simplemodal-login', function (e) { 
                e.preventDefault();

                // remove any existing errors or messages
                s.clear(s.dialog.container[0]);

                if (s.isValid(form)) { 
                    fields.hide();
                    activity.show();

                    if (s.url && s.url.indexOf('redirect_to') !== -1) {
                        var p = s.url.split('=');
                        form.append($('<input type="hidden" name="redirect_to">').val(unescape(p[1])));
                    }

                    $.ajax({
                        url: form[0].action,
                        data: form.serialize(),
                        type: 'POST',
                        cache: false,
                        success: function (resp) {
                            var data = $(document.createElement('div')).html(resp),
                            redirect = $('#simplemodal-login-redirect', data[0]);

                            if (redirect.length) {
                                var href = location.href;
                                if (redirect.html().length) {
                                    href = redirect.html();
                                }
                                window.location = href;
                            }
                            else {
                                var error = $('#login_error', data[0]),
                                message = $('.message', data[0]),
                                loginform = $(s.form, data[0]);

                                if (error.length) {
                                    error.find('a').addClass('simplemodal-forgotpw');
                                    $('p:first', form[0]).before(error);
                                    activity.hide();
                                    fields.show();
                                }
                                else if (message.length) {
                                    if (s.form === '#lostpasswordform' || s.form === '#registerform') {
                                        form = s.login;
                                        s.lostpw.hide();
                                        s.register.hide();
                                        s.login.show();
                                    }
                                    $('p:first', form[0]).before(message);
                                    activity.hide();
                                    fields.show();
                                }
                                else if (loginform.length) {
                                    s.showError(form, ['empty_both']);
                                    activity.hide();
                                    fields.show();
                                }
                            }
                        },
                        error: function (xhr) {
                            $('p:first', form[0]).before(
                                $(document.createElement('div'))
                                .html('<strong>ERROR</strong>: ' + xhr.statusText)
                                .attr('id', 'login_error')
                                );
                            activity.hide();
                            fields.show();
                        }
                    });
                }
                else { 
                    s.showError(form, s.error);
                }
            });
        },
        /* utility functions */
        clear: function (context) {
            $('#login_error, .message', context).remove();
        },
        isValid: function (form) {
            var log = $('.user_login', form[0]),
            pass = $('.user_pass', form[0]),
            email = $('.user_email', form[0]),
            fields = $(':text, :password', form[0]),
            valid = true;

            SimpleModalLogin.error = [];

            if (log.length && !$.trim(log.val())) {
                SimpleModalLogin.error.push('empty_username');
                valid = false;
            }
            else if (pass.length && !$.trim(pass.val())) {
                SimpleModalLogin.error.push('empty_password');
                valid = false;
            }
            else if (email.length && !$.trim(email.val())) {
                SimpleModalLogin.error.push('empty_email');
                valid = false;
            }

            var empty_count = 0;
            fields.each(function () {
                if (!$.trim(this.value)) {
                    empty_count++;
                }
            });
            if (fields.length > 1 && empty_count === fields.length) {
                SimpleModalLogin.error = ['empty_all'];
                valid = false;
            }

            return valid;
        },
        keydown: function (e) {
            if (e.altKey && e.ctrlKey && e.keyCode === 76) {
                $('.simplemodal-login').trigger('click.simplemodal-login');
            }
        },
        message: function (key) {
            return SimpleModalLoginL10n[key] ?
            SimpleModalLoginL10n[key].replace(/&gt;/g, '>').replace(/&lt;/g, '<') :
            key;
        },
        showError: function (form, keys) {
            keys = $.map(keys, function (key) {
                return SimpleModalLogin.message(key);
            });
            $('p:first', form[0])
            .before($('<div id="login_error"></div>').html(
                keys.join('<br/>')
                ));
        }
    };

    SimpleModalLogin.init();
});