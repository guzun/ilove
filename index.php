<?php get_header(); ?>
<div class="b_content clearfix" id="main">

    <!-- title bar -->
    <div class="content-title">
        <div class="left">&nbsp;</div>
        <div class="title">
            <?php
                if( have_posts () ){
                    ?><h1 class="entry-title blog_page"><?php _e( 'Blog page' , 'cosmotheme' ); ?></h1><?php
                    tools::switch_view( 'blog_page' );
                }else{
                    ?><h1 class="entry-title archive"><?php _e( 'Sorry, no posts found' , 'cosmotheme' ); ?></h1></h1><?php
                }
            ?>
        </div>
        <div class="right">&nbsp;</div>
    </div>

    <!-- Start content -->
    <div class="b_page clearfix">

        <!-- left sidebar -->
        <?php layout::side( 'left' , 0 , 'blog_page' ); ?>

        <div id="primary" <?php tools::primary_class( 0 , 'blog_page' ); ?>>
            <div id="content" role="main">
                <div <?php tools::content_class( 0 , 'blog_page' ) ?>>
                    <?php post::loop( 'blog_page' ); ?>
                </div>
            </div>
        </div>

        <!-- right sidebar -->
        <?php layout::side( 'right' , 0 , 'blog_page' ); ?>
    </div>
</div>
<?php get_footer(); ?>
