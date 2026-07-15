<?php

add_filter( 'wp_get_attachment_image_attributes', 'wpdocs_filter_gallery_img_atts', 10, 2 );
function wpdocs_filter_gallery_img_atts( $atts, $attachment ) {
    if ( !$atts['alt'] ) {
        global $post;
        $atts['alt'] = get_the_title($post);
    }
    return $atts;
}