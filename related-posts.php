<?php
    /* related posts by herarchical taxonomy */
    /* get tax slugs and number of similar posts  */ 
    function similar_query( $post_id , $taxonomy , $nr ){
        if( $nr > 0 ){
            $topics = wp_get_post_terms( $post_id , $taxonomy );

            $terms = array();
            if( !empty( $topics ) ){
                foreach ( $topics as $topic ) {
                    $term = get_category( $topic );
                    array_push( $terms, $term -> slug );
                }
            }

            if( !empty( $terms ) ){
                $query = new WP_Query( array(
                    'post__not_in' => array( $post_id ) ,
                    'posts_per_page' => $nr,
                    'orderby' => 'rand',
                    'tax_query' => array(
                        array(
                        'taxonomy' => $taxonomy ,
                        'field' => 'slug',
                        'terms' => $terms ,
                        )
                    )
                ));
            }else{
                $query = array();
            }
        }else{
            $query = array();
        }

        return $query;
    }

    /* post taxonomy */
    $tax = options::get_value( 'blog_post' , 'similar_type' );
    $layout = meta::get_meta( $post -> ID , 'layout' );
    
    if( isset( $layout['type'] ) ){
        if( $layout['type'] != 'full' ){
            $nr = (int)options::get_value( 'blog_post' , 'post_similar_side' );
        }else{
            $nr = (int)options::get_value( 'blog_post' , 'post_similar_full' );
        }
    }else{
        $layout = options::get_value( 'layout' , 'single' );
        if( $layout != 'full' ){
            $nr = (int)options::get_value( 'blog_post' , 'post_similar_side' );
        }else{
            $nr = (int)options::get_value( 'blog_post' , 'post_similar_full' );
        }
    }
    
    $label  = __( 'Related Posts' , 'cosmotheme' );
    $query  = similar_query( $post -> ID , $tax , $nr );
    $length = layout::length( $post -> ID , 'single' );

    if( !empty( $query ) ){
        if( $query -> found_posts < $nr ){
            $nr = $query -> found_posts;
        }

        $result = $query -> posts;
    }
        


    

    if( !empty( $result) && meta::logic( $post , 'settings' , 'related' ) ){
?>
        <div class="box-related clearfix grid-view">
            <h3 class="related-title"><?php _e( 'Related posts' , 'cosmotheme' ); ?></h3>
            <p class="delimiter">&nbsp;</p>
            <div>
            <?php
                if( (int)$length == layout::$size['large'] ){
                    $div = 3;
                }else{
                    $div = 2;
                }

                $i = 1;
                $k = 1;

                foreach( $result as $similar ){
                    if( $i == 1 ){
                        if( ( $nr - $k ) < $div  ){
                            $classes = 'class="last"';
                        }else{
                            $classes = '';
                        }
                        echo '<div ' . $classes . '>';
                    }
                    post::grid_view( $similar , 'single' );

                    if( $i % $div == 0 ){
                        echo '</div>';
                        $i = 0;
                    }
                    $i++;
                    $k++;

                }

            /* if div container is open */
            if( $i > 1 ){
                echo '</div>';
            }

            ?>
        </div> <!--  end container related posts -->
    </div>
<?php

        wp_reset_postdata();
    }
?>
    