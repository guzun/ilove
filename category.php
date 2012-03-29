<?php get_header(); ?>
<div class="b_content clearfix" id="main">

    <!-- title bar -->
    <div class="content-title">
        <div class="left">&nbsp;</div>
        <div class="title">
            <?php
                if( have_posts () ){
                    ?><h1 class="entry-title category"><?php _e( 'Category archives: ' , 'cosmotheme' ); echo get_cat_name( get_query_var('cat') ); ?></h1><?php
                    tools::switch_view( 'category' );
                }else{
                    ?><h1 class="entry-title category"><?php _e( 'Sorry, no posts found' , 'cosmotheme' ); ?></h1><?php

                }
            ?>
        </div>
        <div class="right">&nbsp;</div>
    </div>

    <!-- Start content -->
    <div class="b_page clearfix">

        <!-- left sidebar -->
        <?php layout::side( 'left' , 0 , 'category' ); ?>

        <div id="primary" <?php tools::primary_class( 0 , 'category' ); ?>>
            <div id="content" role="main">
                <div <?php tools::content_class( 0 , 'category' ) ?>>
                    <?php post::loop( 'category' ); ?>
                </div>
            </div>
        </div>
        
        <!-- right sidebar -->
        <?php layout::side( 'right' , 0 , 'category' ); ?>
    </div>
</div>
<?php get_footer(); ?>
