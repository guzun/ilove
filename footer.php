	        
			<footer id="colophon" role="contentinfo" class="b_body_f clearfix">
				
                <script type="text/javascript">
                    (function() {
                        var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
                        po.src = 'https://apis.google.com/js/plusone.js';
                        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
                    })();
                </script>

                <?php
                	if(get_background_image() == '' && get_bg_image() != 'pattern.day' && get_bg_image() != 'pattern.night' && !strpos(get_bg_image(),'.jpg') ){	
						//echo get_bg_image();
                        if(get_bg_image() != 'pattern.none.png'){
                            $background_img = 'background-image: url('.get_template_directory_uri().'/lib/images/pattern/'.get_bg_image().');';
                        }else{
                            $background_img = '';
                        }    
		            }else{
		            	$background_img = '';
		            }	
                	$footer_background_color = "background-color: " . get_footer_bg_color() . "; ";
                	
				?>
				
				<div class="b_f_c w_990" style="<?php echo $footer_background_color; ?> <?php echo $background_img; ?>" >
                    <?php
                        ob_start();
                        ob_clean();
                        get_sidebar( 'footer-first' );
                        $f1 = ob_get_clean();
                        ob_start();
                        ob_clean();
                        get_sidebar( 'footer-second' );
                        $f2 = ob_get_clean();
                        ob_start();
                        ob_clean();
                        get_sidebar( 'footer-third' );
                        $f3 = ob_get_clean();
                        ob_start();
                        ob_clean();
                        get_sidebar( 'footer-fourth' );
                        $f4 = ob_get_clean();
						ob_start();
                        ob_clean();	
						get_sidebar( 'social-media' );
                        $social_media = ob_get_clean();

                        if( strlen( $f1 . $f2 . $f3 . $f4 ) ){
                    ?>
                            <div class="b_page clearfix footer-area">
                                <div class="b w_210">
                                    <?php echo $f1; ?>
                                </div>
                                <div class="b w_210">
                                    <?php echo $f2; ?>
                                </div>
                                <div class="b w_210">
                                    <?php echo $f3; ?>
                                </div>
                                <div class="b w_210">
                                    <?php echo $f4; ?>
                                </div>
                            </div>
                    <?php
                        }
                    ?>
					<div class="bottom">
						<div class="b_page clearfix">
							<div class="b w_450">
								<p class="copyright"><?php echo str_replace('%year%',date('Y') , options::get_value('general' , 'copy_right') ); ?></p>
							</div>
							<div class="b w_450 fr">
								<?php echo $social_media;  ?>
							</div>
						</div>
					</div>
				</div>
			</footer>
			<?php
					if( options::logic( 'general' , 'enb_keyboard' ) ){
				?>
						<div id="lightbox-shadow" onclick="javascript:keyboard.hide();"></div>
						<div id="keyboard-container">
							<div id="img">
							<img src="<?php echo get_template_directory_uri()?>/images/keyboard.png"  alt=""/>
							<p class="hint">
								<?php _e( 'Use advanced navigation for a better experience.' , 'cosmotheme' ); ?>
								<br />
								<?php _e( 'You can quickly scroll through posts by pressing the above keyboard keys. Now press <strong>Esc</strong> to close this window.' , 'cosmotheme' ); ?>
							</p>
							</div>
						</div>
				<?php
					}
				?>
				<?php
                    if( options::logic( 'general' , 'enb_keyboard' ) ){
                ?>
                        <div class="keyboard-demo" style=" cursor:pointer;" onclick="javascript:keyboard.show();">
                            <img src="<?php echo get_template_directory_uri()?>/images/small-keyboard.png" alt="small_keyboard" />
                        </div>
                <?php
                    }
                ?>    
            <script type="text/javascript" src="//platform.twitter.com/widgets.js"></script>
            <?php
                wp_footer();
                echo options::get_value('general' , 'tracking_code');
            ?>
			<div id="toTop"><?php _e('Back to top','cosmotheme'); ?> <span class="arrow">&uarr;</span></div>
		</div>
	</div>
</body>
</html>