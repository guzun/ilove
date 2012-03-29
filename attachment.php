<?php get_header(); ?>
<div class="b_content clearfix" id="main">
	<?php
        while( have_posts () ){
            the_post();
            $post_id = $post -> ID
    ?>
	<div class="content-title">
		<div class="left">&nbsp;</div>
		<div class="title">
			<h1 class="entry-title">
				<span><?php the_title(); ?></span>
			</h1>
		</div>
		<div class="right">&nbsp;</div>
	</div>
    <!-- Start content -->
    <div class="b_page clearfix">

        <!-- left sidebar -->
        <?php layout::side( 'left' , 0 , 'attachment' ); ?>

        <div id="primary" <?php tools::primary_class( 0 , 'attachment' ); ?>>
            <div id="content" role="main">
                <div <?php tools::content_class( 0 , 'attachment' , $side = '' , $with_grid = false )?>>
                     <div class="featimg readmore"   >
						<div class="img">
						<?php
							$img_src = wp_get_attachment_image_src(  $post_id  , 'tmedium' );
							echo '<img src="'.$img_src[0].'" alt="" />';

							
						?>                
						</div>
					</div>
                </div>
            </div>
        </div>
        
        <!-- right sidebar -->
        <?php layout::side( 'right' , 0 , 'attachment' ); ?>
    </div>

	<?php
	  }
	?>
</div>
<?php get_footer(); ?>