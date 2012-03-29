<?php get_header(); ?>
<div class="b_content clearfix" id="main">

    <!-- title bar -->
    <div class="content-title">
        <div class="left">&nbsp;</div>
        <div class="title">
            <h1 class="entry-title category"><?php _e( 'Error 404, page, post or resource can not be found' , 'cosmotheme' ); ?></h1>
        </div>
        <div class="right">&nbsp;</div>
    </div>

    <!-- start 404 content -->
    <div class="b_page clearfix">

        <!-- left sidebar -->
        <?php layout::side( 'left' , 0 , '404' ); ?>

        <div id="primary" <?php tools::primary_class( 0 , '404' ); ?>>
            <div id="content" role="main">
                <div <?php tools::content_class( 0 , '404' ) ?>>
                    <?php get_template_part( 'loop' , '404' ); ?>
                </div>
            </div>
        </div>

        <!-- right sidebar -->
        <?php layout::side( 'right' , 0 , '404' ); ?>
    </div>
</div>
<?php get_footer(); ?>