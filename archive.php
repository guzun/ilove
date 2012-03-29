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
                            <?php
                                if ( is_day() ) {
                                    echo '<h1 class="entry-title archive">' . __( 'Daily archives' , 'cosmotheme' ) . ': <span>' . get_the_date() . '</span></h1>';
                                }else if ( is_month() ) {
                                    echo '<h1 class="entry-title archive">' . __( 'Monthly archives' , 'cosmotheme' ) . ': <span>' . get_the_date( 'F Y' ) . '</span></h1>';
                                }else if ( is_year() ) {
                                    echo '<h1 class="entry-title archive">' . __( 'Yearly archives' , 'cosmotheme' ) . ': <span>' . get_the_date( 'Y' ) . '</span></h1>';
                                }else {
                                    echo '<h1 class="entry-title archive">' . __( 'Blog archives' , 'cosmotheme' ) . '</h1>';
                                }
                            ?>
                        </h1>
                    <?php
                    tools::switch_view( 'archive' );
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
        <?php layout::side( 'left' , 0 , 'archive' ); ?>

        <div id="primary" <?php tools::primary_class( 0 , 'archive' ); ?>>
            <div id="content" role="main">
                <div <?php tools::content_class( 0 , 'archive' ) ?>>
                    <?php post::loop( 'archive' ); ?>
                </div>
            </div>
        </div>
        <!-- right sidebar -->
        <?php layout::side( 'right' , 0 , 'archive' ); ?>
    </div>
</div>
<?php get_footer(); ?>
