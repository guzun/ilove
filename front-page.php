<?php get_header(); ?>
<div class="b_content clearfix" id="main">

    <!-- Start content -->
    <div class="b_page clearfix">

        <!-- left sidebar -->
        <?php $left = layout::side( 'left' , 0 , 'front_page' ); ?>

        <div id="primary" <?php tools::primary_class( 0 , 'front_page' ); ?>>
            <div id="content" role="main">
                <?php
                    /* if hot or new  */
                    if( isset( $_GET[ 'fp_type' ] ) ){
                        switch( $_GET[ 'fp_type' ] ){
                            case 'hot' : {
                                post::hot_posts();
                                break;
                            }
                            case 'news' : {
                                post::new_posts();
                                break;
                            }
                            
                            
                            default : {
                                
                                if(is_user_logged_in() ){
                                    if( $_GET['fp_type'] == 'like' ){
                                        post::like();
                                        break;
                                    }
                                }
                                if( options::get_value( 'front_page' , 'type' ) == 'hot_posts' ){
                                    post::hot_posts();
                                }
                                if( options::get_value( 'front_page' , 'type' ) == 'new_posts' ){
                                    post::new_posts();
                                }
                                if( options::get_value( 'front_page' , 'type' ) == 'new_hot_posts' ){
                                    post::new_hot_posts();
                                }
                                break;
                            }
                        }
                    }else{
                        /* if not set params for hot or new */
                        if( options::get_value( 'front_page' , 'type' ) != 'page' ){
                            if( options::get_value( 'front_page' , 'type' ) == 'hot_posts' ){
                                post::hot_posts( false );
                            }
                            if( options::get_value( 'front_page' , 'type' ) == 'new_posts' ){
                                post::new_posts( false );
                            }
                            if( options::get_value( 'front_page' , 'type' ) == 'new_hot_posts' ){
                                post::new_hot_posts( false );
                            }
                            $post_id = 0;
                        }else{
                ?>
                        <div <?php tools::content_class( 0 , 'front_page' ) ?>>
                        <?php
                            $wp_query = new WP_Query( array( 'page_id' => options::get_value( 'front_page' , 'page' ) ) );

                            if( $wp_query -> post_count > 0 ){
                                foreach( $wp_query -> posts as $post ){
                                    $wp_query -> the_post();
                                    $post_id = $post -> ID;
                        ?>
                                    <article id="post-<?php the_ID(); ?>" <?php post_class() ?>>
                                        <header class="entry-header">
                                            <h1 class="entry-title"><?php the_title(); ?></h1>
                                            <!-- post meta top -->
                                            <?php
                                                if( meta::logic( $post , 'settings' , 'meta' ) ){
                                                    get_template_part( 'post-meta-top' );
                                                }
                                            ?>
                                        </header>
                                        <div class="entry-content">
                                            <?php
                                                /* if show featured image */
                                                if( options::logic( 'blog_post' , 'show_featured' ) ){
                                                    if( has_post_thumbnail ( $post -> ID ) ){
                                                        $src = image::thumbnail( $post -> ID , 'tlarge' );
                                                        $caption = image::caption( $post -> ID );
                                            ?>
                                                        <div class="featimg circle">
                                                            <div class="img">
                                                                <a href="<?php echo $src[0]; ?>" title="<?php echo $caption  ?>" class="mosaic-overlay" rel="prettyPhoto-<?php echo $post -> ID; ?>">&nbsp;</a>
                                                                <?php the_post_thumbnail( '600x200' ); ?>
                                                                <?php
                                                                    if( strlen( trim( $caption ) ) ){
                                                                ?>
                                                                        <p class="wp-caption-text"><?php echo $caption; ?></p>
                                                                <?php
                                                                    }
                                                                ?>
                                                            </div>
                                                        </div>
                                            <?php
                                                    }
                                                }
                                            ?>
                                        </div>

                                        <footer class="entry-footer">
                                            <div class="share">
                                                <?php get_template_part( 'social-sharing' ); ?>
                                            </div>
                                            <div class="excerpt">
                                                <?php the_content(); ?>
                                                <?php wp_link_pages(); ?>
                                            </div>
                                        </footer>
                                    </article>
                <?php
                                }
                            }else{
                                /* not found page */
                                get_template_part( 'loop' , '404' );
                            }

                            ?></div><?php
                        }
                    }
                ?>
            </div>
        </div>
        <!-- right sidebar -->
        <?php layout::side( 'right' , 0 , 'front_page' ); ?>
    </div>
</div>
<?php get_footer(); ?>