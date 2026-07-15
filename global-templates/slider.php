<?php
/**
 * Hero setup.
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<?php
$args = array(
	'post_type'			=> 'slide',
	'posts_per_page'	=> -1,
	'orderby'			=> 'menu_order',
	'order'				=> 'ASC',

);

$q = new WP_Query($args);

if ($q->have_posts()) {

	echo '<div id="slider-home" class="slick-slider">';

			while( $q->have_posts() ) {

				$q->the_post();

				$bg_url = get_the_post_thumbnail_url( null, 'full' );
				$bg_url_mobile_id = get_post_meta( get_the_ID(), 'imagen_para_movil', true );
				if ( $bg_url_mobile_id ) {
					$bg_url_mobile = wp_get_attachment_image_url( $bg_url_mobile_id, 'large', false );
				} else {
					$bg_url_mobile = $bg_url;
				}

				$link_url = get_post_meta( get_the_ID(), 'link_url', true );
				if ( !$link_url ) {
					$link_post_id = get_post_meta( get_the_ID(), 'link', true );
					if ( $link_post_id ) {
						$link_url = get_permalink( $link_post_id );
					}
				}

				echo '<div class="slider-item">';

					if ( $link_url ) {
						echo '<a href="'. $link_url .'">';
					}

					echo '<div class="wp-block-cover px-0">';
							
						// echo '<span aria-hidden="true" class="wp-block-cover__background has-primary-background-color has-background-dim has-background-dim-60"></span>';
						
						echo '<img src="'.$bg_url.'" class="wp-block-cover__image-background d-none d-md-block" />';
						echo '<img src="'.$bg_url_mobile.'" class="wp-block-cover__image-background d-md-none" />';
						
						echo '<div class="wp-block-cover__inner-container container">';

							echo '<div class="slide-content">';
								// the_content();
							echo '</div>';

						echo '</div>';
						
					echo '</div>';

					if ( $link_url ) {
						echo '</a>';
					}

				echo '</div>';

			}

		echo '</div>';
		
	echo '</div>';

}

wp_reset_postdata();
