<?php
	if ( options::logic( 'styling' , 'front_end' ) ){
?>
<script type="text/javascript">
	jQuery(document).ready(function() {
		<?php
			if( is_single() || is_page() ){
				$settings = meta::get_meta( $post -> ID , 'settings' );
				if( ( isset( $settings['post_bg'] ) && !empty( $settings['post_bg'] ) ) || ( isset( $settings['color'] ) && !empty( $settings['color'] ) ) ){
					echo 'return 0;';
				}
			}
		?>
		jQuery('.style_switcher input[id^="pick_"]').each(function(index) { 
			
			var farbtastic;
			var $obj = this;
			(function(jQuery){
				var pickColor = function(a) { 
					farbtastic.setColor(a);
					jQuery('#pick_' + jQuery($obj).attr('op_name') ).val(a);
					jQuery('#link_pick_' + jQuery($obj).attr('op_name') ).css('background-color', a); 
					setPickedColor(a,jQuery($obj).attr('zone'));
				};
			
				jQuery(document).ready( function() {
				
					farbtastic = jQuery.farbtastic('#colorPickerDiv_'  + jQuery($obj).attr('op_name') , pickColor);
			
					pickColor( jQuery('#pick_' + jQuery($obj).attr('op_name') ).val() );
			
					jQuery('#link_pick_' + jQuery($obj).attr('op_name') ).click( function(e) {
						jQuery('#colorPickerDiv_'  + jQuery($obj).attr('op_name') ).show();
						e.preventDefault();
					});
			
					jQuery('#pick_' + jQuery($obj).attr('op_name') ).keyup( function() { 
						var a = jQuery('#pick_' + jQuery($obj).attr('op_name') ).val(),
							b = a;
			
						a = a.replace(/[^a-fA-F0-9]/, '');
						if ( '#' + a !== b )
							jQuery('#pick_' + jQuery($obj).attr('op_name') ).val(a);
						if ( a.length === 3 || a.length === 6 )
							pickColor( '#' + a );
					});
			
					jQuery(document).mousedown( function() {
						jQuery('#colorPickerDiv_'  + jQuery($obj).attr('op_name')).hide();
					});
				});
			})(jQuery);
			
		});
	});

	function changeBgImage(rd_id){ 
	
		jQuery('body').css('background-image', 'url(<?php echo get_template_directory_uri(); ?>/lib/images/pattern/pattern.'+jQuery("#"+rd_id).val()+'.png)' );
		jQuery('.b_f_c').css('background-image', 'url(<?php echo get_template_directory_uri(); ?>/lib/images/pattern/pattern.'+jQuery("#"+rd_id).val()+'.png)' );

		jQuery.cookie(cookies_prefix+"_bg_image",jQuery('#'+rd_id).val(), {expires: 365, path: '/'});
		return false;
	}	

</script>
<?php
		$background_img = get_bg_image();
        $footer_background_color = get_footer_bg_color();
        $background_color = get_content_bg_color();
		
        $theme_bgs = array(
	        "flowers"=>"flowers" , "flowers_2"=>"flowers_2" , "flowers_3"=>"flowers_3" , "flowers_4"=>"flowers_4" ,"circles"=>"circles","dots"=>"dots","grid"=>"grid","noise"=>"noise",
	        "paper"=>"paper","rectangle"=>"rectangle","squares_1"=>"squares_1","squares_2"=>"squares_2","thicklines"=>"thicklines","thinlines"=>"thinlines"
    	);
?>
	<div class="cosmo-tabs style_switcher" >
		<div class="show_colors fr"></div>
		<div class="tabs-container fl">
			<div id="header_footer_inputs" class="switcher-inputs">
				<?php
					
						  
					if ( isset($_COOKIE[ZIP_NAME."_bg_image"]) ){
						$current_body_bg_img = $_COOKIE[ZIP_NAME."_bg_image"];
					}else{
						$current_body_bg_img = options::get_value( 'styling' , 'background' ) ;
					}


					
				?>
				<div>
					<p><?php _e('Footer bg color','cosmotheme'); ?></p> <br/>
					<a href="#" class="pickcolor hide-if-no-js" id="link_pick_b_f_bg_color" ></a>
					<input type="text"  id="pick_b_f_bg_color" op_name="b_f_bg_color" zone="footer" value="<?php echo $footer_background_color ?>" />
					<div id="colorPickerDiv_b_f_bg_color" class="colorPickerDiv" style="z-index: 100;  background:#eee; border:1px solid #ccc; position:absolute; display:none;"></div>
				</div>
			</div>
			
			<div id="content_inputs" class="switcher-inputs" >
				<?php 
					$current_content_style = get_content_bg_color();
					/*if ( isset($_COOKIE["content_bg_color"]) ){
						$current_content_style = $_COOKIE["content_bg_color"];
					}else{
						$current_content_style = admin_options::get_values('styling_options' , 'content_background_color') ; 

					}*/
					
				?>
				<div>
					<p><?php _e('Content bg color','cosmotheme'); ?></p> <br/>
					<a href="#" class="pickcolor hide-if-no-js" id="link_pick_content_bg_color"></a>
					<input type="text" id="pick_content_bg_color" op_name="content_bg_color" zone="content" value="<?php echo $background_color ?>" />
					<div id="colorPickerDiv_content_bg_color" class="colorPickerDiv" style="z-index: 100; background:#eee; border:1px solid #ccc; position:absolute; display:none;"></div>
				</div>
			</div>
			
			<div id="patterns_inputs">
				<p><?php _e('Patterns','cosmotheme'); ?></p>
				<?php
				foreach ($theme_bgs as $theme_bg) {
					if( trim($current_body_bg_img) == trim(array_search($theme_bg,$theme_bgs)) ){
							$rd_selected = 'checked="checked"';
						}
						else{
							$rd_selected = '';
						}
					//$sample_bg_image = get_template_directory_uri().'/images/backend/pattern/b.pattern.'.array_search($theme_bg,$theme_bgs).'.png';
					$sample_bg_image = get_template_directory_uri().'/lib/images/pattern/b.pattern.'.array_search($theme_bg,$theme_bgs).'.png';  
					  
					echo '<a href="javascript:void(0)" onclick="setBgImage(\'rb_'.array_search($theme_bg,$theme_bgs).'\')" class=" cosmo-pattern active" style="background-image:url('.$sample_bg_image.');" title="'.$theme_bg.'">'.$theme_bg.'</a>';
					echo '<input type="radio" name="skin_bg_rb" value="'.array_search($theme_bg,$theme_bgs).'" '.$rd_selected.' id="rb_'.array_search($theme_bg,$theme_bgs).'"  style="display:none"/>';
				}
				/*for No BG image*/
						if( trim($current_body_bg_img) == 'none' ){
							$rd_selected = 'checked="checked"';
						}
						else{
							$rd_selected = '';
						}
				/*$sample_bg_image = get_template_directory_uri().'/images/backend/pattern/b.pattern.none.png';*/
				echo '<div style=" margin: 0 0 0 13px;">';
				echo '<a href="javascript:void(0)" onclick="setBgImage(\'rb_none\')" class=" cosmo-pattern active"  title="none">none</a>';
				echo '<input type="radio" name="skin_bg_rb" value="none" '.$rd_selected.' id="rb_none"  style="display:none"/>';
				echo '</div>';	
				?>
			</div>
		</div>
	</div>
<?php
	}
?>