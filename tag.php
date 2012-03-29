<?php get_header(); ?>
<div class="b_content clearfix" id="main">

    <!-- title bar -->
    <div class="content-title">
        <div class="left">&nbsp;</div>
        <div class="title">
            <?php
                if( have_posts () ){
                    ?><h1 class="entry-title tag"><?php _e( 'Tags archives' , 'cosmotheme' ); echo ': ';  echo  urldecode(get_query_var('tag')); ?></h1><?php
                    tools::switch_view( 'tag' );
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
        <?php layout::side( 'left' , 0 , 'tag' ); ?>

        <div id="primary" <?php tools::primary_class( 0 , 'tag' ); ?>>
            <div id="content" role="main">
                <div <?php tools::content_class( 0 , 'tag' ); ?>>
                    <?php post::loop( 'tag' ); ?>
                </div>
            </div>
        </div>
        <!-- right sidebar -->
        <?php layout::side( 'right' , 0 , 'tag' ); ?>
    </div>
</div>
<?php get_footer(); ?>
