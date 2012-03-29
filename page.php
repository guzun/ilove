<?php 
if( $post -> ID == options::get_value( 'general' , 'user_profile_page' ) ){
	get_template_part( 'user_profile_update' );
}
get_header(); 

?>
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
                        <span>
                            <?php
                                if( (int)options::get_value( 'general' , 'my_posts_page' ) == $post_id ){
                                    _e( 'My posts' , 'cosmotheme' );
                                }else{
                                    the_title();
                                }
                            ?>
                        </span>
                    </h1>
                </div>
                <div class="right">&nbsp;</div>
            </div>
                    
            <!-- Start content -->
            <div class="b_page clearfix">

                <!-- left sidebar -->
                <?php layout::side( 'left' , $post_id , 'page'); ?>

                <div id="primary" <?php tools::primary_class( $post_id , 'page' ); ?>>
                    <div id="content" role="main">
						<?php
                            if( (int)options::get_value( 'general' , 'my_posts_page' ) == $post_id ){
                        ?>
                                <div class="w_<?php echo layout::length( $post_id , 'page' ); ?> my-posts"><!--add class my posts-->
                                    <div class="list">
                                        <?php post::my_posts( get_current_user_id() ); ?>
                                    </div>
                                </div> 
                        <?php
                            }else{
                        ?>
                                <div <?php tools::content_class( $post_id , 'page' , '' , false ); ?>>
                        
                                <?php 
                                    if( $post_id == options::get_value( 'upload' , 'post_item_page' ) ){
                                        get_template_part( 'post_item' );
                                    }elseif( $post_id == options::get_value( 'general' , 'user_profile_page' ) ){
                                        get_template_part( 'user_profile' );
                                    }else{

                                ?>  	
                                <!-- post -->
                                <article id="post-<?php the_ID(); ?>" <?php post_class( 'post' , $post -> ID ); ?>>

                                    <!-- header -->
                                    <?php
                                        $template = 'page';
                                        $attr = tools::login_attr( $post -> ID , 'nsfw mosaic-overlay' , get_permalink( $post -> ID ) );
                                        $size = 'tmedium';
                                        $s = image::asize( image::size( $post->ID , $template , $size ) );

                                        if( options::logic( 'general' , 'enb_featured' ) ){
                                            if ( has_post_thumbnail( $post -> ID ) && get_post_format( $post -> ID ) != 'video' ) {
                                                $src = image::thumbnail( $post -> ID , $template , $size );
                                                $caption = image::caption( $post -> ID );
                                    ?>
                                                <!-- thumbnail -->
                                                <header class="entry-header">
                                                    <div class="featimg">
                                                        <div class="img">
                                                            <?php echo '<img src="' . $src[0] . '" alt="' . $caption . '" >'; ?>
                                                        </div>
                                                    </div>
                                                </header>
                                    <?php
                                            }
                                        }
                                    ?>

                                    <!-- content -->
                                    <div class="entry-content">

                                        <!-- meta -->
                                        <?php
                                            if( meta::logic( $post , 'settings' , 'meta' ) ){
                                                post::meta( $post );
                                            }
                                        ?>
                                        <!-- text content -->
                                        <div class="b_text">
                                            <?php the_content(); ?>
                                        </div>
                                    </div>

                                    <!-- footer -->
                                    <footer class="entry-footer">
                                        <div class="share">
                                            <?php get_template_part('social-sharing'); ?>
                                        </div>
                                        <?php
                                            if( strlen( options::get_value( 'advertisement' , 'content' ) ) > 0 ){
                                        ?>
                                                <div class="cosmo-ads zone-2">
                                                    <?php echo options::get_value( 'advertisement' , 'content' ); ?>
                                                </div>
                                        <?php
                                            }
                                        ?>
                                    </footer>
                                </article>

                                <p class="delimiter blank">&nbsp;</p>

                                <?php
                                    /* comments */
                                    if( comments_open() ){
                                        if( options::logic( 'general' , 'fb_comments' ) ){
                                            ?>
                                            <div id="comments">
                                                <h3 id="reply-title"><?php _e( 'Leave a reply' , 'cosmotheme' ); ?></h3>
                                                <p class="delimiter">&nbsp;</p>
                                                <fb:comments href="<?php the_permalink(); ?>" num_posts="5" width="620" height="120" reverse="true"></fb:comments>
                                            </div>
                                            <?php
                                        }else{
                                            comments_template( '', true );
                                        }
                                    }
                                }
                            ?>
                            </div>
                        <?php
                            }
                        ?>
					</div>
                </div>
                
                <!-- right sidebar -->
                <?php layout::side( 'right' , $post_id , 'page' ); ?>
            </div>
    <?php
        }
    ?>
</div>
<?php get_footer(); ?>