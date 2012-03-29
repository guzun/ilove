<?php    
    if( is_front_page() && (int)options::get_value( 'slider' , 'slideshow' ) > 0 ){
        $sl = get_post( options::get_value( 'slider' , 'slideshow' ) );
        if( $sl -> post_status == 'publish' ){
            $sl_id = options::get_value( 'slider' , 'slideshow' );
        }
    }else{
        if( is_single() || is_page() ){
            if( meta::logic( $post , 'settings' , 'slideshow' ) ){
                $stt = meta::get_meta( $post -> ID , 'settings' );
                if( $stt['slideshow_select'] > 0 && is_numeric( $stt['slideshow_select'] ) ){
                    $sl    = get_post( $stt[ 'slideshow_select' ] );
                    if( $sl -> post_status == 'publish' ){
                        $sl_id = (int)$stt['slideshow_select'];
                    }else{
                        $sl_id = 0;
                    }
                }
            }
        }
    }
    
    if( isset( $sl_id ) && !empty( $sl_id ) ){
        $meta   = meta::get_meta( $sl_id , 'box' );

        $result = '';
        $pag = '';
        if( !empty ( $meta ) && is_array( $meta ) ){
            foreach( $meta as $index => $slider ){
                $description = '';
                $title = '';
                $link = '';
                $sl_item = '';
                $classes = '';
                $nsfw = false;

                /* post from blog */
                if( isset( $slider['resources'] )  && (int) $slider['resources'] > 0 ){
                    $sl_item = get_post( $slider['resources'] );
                    
                    if(is_user_logged_in() ){
                        $nsfw = false;
                    }else{
                        if( tools::is_nsfw( $sl_item -> ID ) ){
                            $nsfw = true;
                        }else{
                            $nsfw = false;
                        }
                    }
                    /* classes */
                    $classes = $sl_item -> post_type;
                }

                /* description */
                if( $nsfw ){
                    $description = options::get_value( 'general' , 'nsfw_content' );
                }else{
                    if( !empty( $slider['description'] ) ){
                        $description = __(trim( ( $slider['description'] ) ));
                    }else{
                        if( isset( $sl_item ) && !empty( $sl_item ) ){
                            if( !empty( $sl_item -> post_excerpt ) ){
                                $description = trim( mb_substr( strip_tags( __($sl_item -> post_excerpt)  ) , 0 , 170 ) );
                                if( strlen( $sl_item -> post_excerpt ) > strlen( $description ) ){
                                    $description .= ' [...]';
                                }
                            }else{
                                $description = trim( mb_substr(  strip_tags( strip_shortcodes( __($sl_item -> post_content) ) ) , 0 , 170 ) );
                                if( strlen( $sl_item -> post_content ) > strlen( $description ) ){
                                    $description .= ' [...]';
                                }
                            }
                        }
                    }
                }

                /* title */
                if( isset( $slider['title'] ) && !empty( $slider['title'] ) ){
                	$title = __( trim( $slider['title'] ) );
                }elseif ( !empty( $sl_item ) ){
                    $title = __( $sl_item -> post_title );
                }else{
                    $title = '';
                }

				/* overwright the URL if it is defined by user */
                if( $nsfw ){
                    $link = wp_login_url( );
                }else{
                    if( isset( $slider['url'] ) && !empty( $slider['url'] ) ){
                        $link = $slider['url'];
                    }else{
                        if( isset( $sl_item ) && !empty( $sl_item ) ){
                            $link = get_permalink( $sl_item -> ID );
                        }else{
                            $link = '';
                        }
                    }
                }

                /* slider image */
                if( $nsfw ){
                    $src = image::mis( 0 , '' , 'tslide' , '' , 'nsfw' );
                    $alt = '';
                }else{
                    if( (int) $slider['slide_id'] > 0 ){
                        if( wp_attachment_is_image( $slider['slide_id'] ) ){
                            $src = wp_get_attachment_image_src( $slider['slide_id'] , 'tslide' );
                            $image = get_post( $slider['slide_id'] );
                            $alt = $image -> post_excerpt;
                        }else{
                            if( isset( $sl_item ) && is_object($sl_item)){
                                if( has_post_thumbnail( $sl_item -> ID ) ){
                                    $src = wp_get_attachment_image_src( get_post_thumbnail_id( $sl_item -> ID ) ,  'tslide' );
                                    $image = get_post( get_post_thumbnail_id( $sl_item -> ID ) );
                                    $alt = $image -> post_excerpt;
                                }else{
                                    $src[0] = get_template_directory_uri() . '/images/no.image.990x300.jpg';
                                    $alt = '';
                                }
                            }
                        }
                    }else{
                        if( isset( $sl_item ) && !empty( $sl_item ) ){
                            if( has_post_thumbnail( $sl_item -> ID ) ){
                                $src = wp_get_attachment_image_src( get_post_thumbnail_id( $sl_item -> ID ) ,  'tslide' );
                                $image = get_post( get_post_thumbnail_id( $sl_item -> ID ) );
                                $alt = $image -> post_excerpt;
                            }else{
                                $src[0] = get_template_directory_uri() . '/images/no.image.990x300.jpg';
                                $alt = '';
                            }
                        }
                    }
                }

                $result .= '<div>';
                if( isset( $src[0] ) ){
                    if( $nsfw ){
                        $result .= $src;
                    }else{
                        $result .= '<img src="' . $src[0] . '" alt="' . $alt . '"/>';
                    }
                }
                /* caption */
                if( strlen( $title . $description ) ){

                    if( isset( $slider['position'] ) ){
                        $classes = $slider['position'];
                    }
                    $result .= '<div class="caption ' . $classes . '">';

                    if( !empty( $sl_item ) ){
                        $id = $sl_item -> ID;
                    }

                    if( empty( $link  ) ){
                        if( !empty( $title  ) ){
                            $result .= '<h2>' . $title . '</h2>';
                        }
                    }else{
                        if( !empty( $title  ) ){
                            if( $nsfw ){
                                $result .= '<h2><a class="simplemodal-nsfw" href="' . $link . '">' . $title . '</a>'; 
                            }else{
                                $result .= '<h2><a href="' . $link . '">' . $title . '</a>'; 
                            }
                            if( $id > 0 ){
                                $result .= like::content( $id , 1 , true );
                            }
                            $result .= '</h2>';
                        }
                    }

                    if( !empty( $description  ) ){
                        $result .= '<p>'. str_replace( "\n" , "<br />" , $description ) . '</p>';
                    }

                    $result .= '<span class="shadow">&nbsp;</span>';
                    $result .= '</div>';
                }

                if( options::logic( 'styling' , 'stripes' ) ){
                    $result .= '<div class="stripes">&nbsp;</div>';
                }
                
                $result .= '</div>';
                
                $pag .= '<li><a href="#' . $index . '">slider ' . $index . ' </a></li>';
            }
        }
    }

    if( isset( $result) && strlen( $result ) ){
?>
        <div class="auto-margin w_990">
            <div class="b w_940">
            	<div class="slides_control" id="slides_control" style="position: absolute; width: 120%; left: -10%; height: 320px;"></div>
                <div class="cosmo-slider">
                    <div class="slide slides_container"  >
                        <?php echo $result; ?>
                    </div>
                    <?php
                        if( !empty( $pag ) ){
                    ?>
                            <!-- <ul class="pagination">
                                <?php echo $pag; ?>
                            </ul> -->
                    <?php
                        }
                    ?>
                </div>
            </div>
        </div>

<?php
    }else{
        if( is_front_page() ){
?>
            <div class="b_page initial">
                <p class="delimiter noslide">&nbsp;</p>
            </div>
<?php
        }
    }
?>

