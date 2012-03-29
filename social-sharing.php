<?php
    /* social sharing  */
    if( meta::logic( $post , 'settings' , 'sharing' ) ){
?>      <div class="share">
            <a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php echo get_permalink( $post -> ID ); ?>" data-text="<?php echo $post -> post_title; ?>" data-count="horizontal">Tweet</a>
            <g:plusone size="medium"  href="<?php echo get_permalink( $post -> ID ); ?>"></g:plusone>
			<a name="fb_share" class="share_button" type="button" share_url="<?php echo get_permalink( $post->ID ); ?>"> <?php _e('Share','cosmotheme')?> </a>  
            <iframe src="http://www.facebook.com/plugins/like.php?href=<?php echo urlencode( get_permalink( $post->ID ) ); ?>&amp;layout=button_count&amp;show_faces=false&amp;&amp;action=like&amp;colorscheme=light" scrolling="no" frameborder="0" height="20" width="109"></iframe>
        </div>
<?php
    }
?>
