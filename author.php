<?php get_header(); ?>
<div class="b_content clearfix" id="main">

    <!-- title bar -->
    <div class="content-title">
        <div class="left">&nbsp;</div>
        <div class="title">
            <?php
                if( have_posts () ){
                    ?>
                        <h1 class="entry-title archive">
                            <?php _e( 'Author archives: ', 'cosmotheme' ); ?>
                            <span class='vcard'>
                                <a class="url fn n" href="" title="<?php echo esc_attr( get_the_author_meta( 'display_name' , $post-> post_author ) ); ?>" rel="me">
                                    <?php echo get_the_author_meta( 'display_name' , $post-> post_author ); ?>
                                </a>
                            </span>
                        </h1>
                    <?php
                    tools::switch_view( 'author' );
                }else{
                    ?><h1 class="entry-title archive"><?php _e( 'Sorry, no posts found' , 'cosmotheme' ); ?></h1><?php
                }
            ?>
        </div>
        <div class="right">&nbsp;</div>
    </div>
    
    <!-- Start content -->
    <div class="b_page clearfix">

        <!-- left sidebar -->
        <?php layout::side( 'left' , 0 , 'author' ); ?>

        <div id="primary" <?php tools::primary_class( 0 , 'author' ); ?>>
            <div id="content" role="main">
                <div <?php tools::content_class( 0 , 'author' ) ?>>
                    <?php post::loop( 'author' ); ?>
                </div>
            </div>
        </div>

        <!-- right sidebar -->
        <?php layout::side( 'right' , 0 , 'author' ); ?>
    </div>
</div>
<?php get_footer(); ?>