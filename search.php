<?php get_header(); ?>
<div class="b_content clearfix" id="main">

    <!-- title bar -->
    <div class="content-title">
        <div class="left">&nbsp;</div>
        <div class="title">
            <?php
                if( have_posts () ){
                    ?><h1 class="entry-title search"><?php _e( 'Search results' , 'cosmotheme' ); ?></h1><?php
                    tools::switch_view( 'search' );
                }else{
                    ?><h1 class="entry-title search"><?php _e( 'Sorry, no results found.' , 'cosmotheme' ); ?></h1><?php
                }
            ?>
        </div>
        <div class="right">&nbsp;</div>
    </div>

    <!-- Start content -->
    <div class="b_page clearfix">

        <!-- left sidebar -->
        <?php layout::side( 'left' , 0 , 'search' ); ?>

        <div id="primary" <?php tools::primary_class( 0 , 'search' ); ?>>
            <div id="content" role="main">
                <div <?php tools::content_class( 0 , 'search' ) ?>>
                    <?php post::loop( 'search' ); ?>
                </div>
            </div>
        </div>
        
        <!-- right sidebar -->
        <?php layout::side( 'right' , 0 , 'search' ); ?>
    </div>
</div>
<?php get_footer(); ?>

