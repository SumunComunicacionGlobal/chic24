<?php

/**
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'ambientes-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'ambientes';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

// Load values and assign defaults.
$term_id = get_field('serie');

if (!$term_id) return false;

?>

	<?php //echo do_shortcode( '[ambientes serie="'.$term_id.'"]' ); ?>

	<?php
    $query_args = array(
    	'post_type'			=> 'composicion',
    	'posts_per_page'	=> 10,
    	'orderby'			=> 'menu_order',
    	'order'				=> 'ASC',
    	'meta_query'		=> array(
    								array(
    									'key'			=> 'destacado',
    									'value'			=> 1,
    								)
    	),
    );

	$query_args['tax_query'] = array(
		array(
			'taxonomy'		=> 'coleccion',
			'terms'			=> $term_id,
		)
	);

    $q = new WP_Query($query_args);

	if ( ! $q->have_posts() ) {
		if ( isset( $query_args['meta_query'] ) ) {
			unset( $query_args['meta_query'] );
		}
		$q = new WP_Query($query_args);
	}

    if($q->have_posts()) { 

			$r = '';
    	?>

		<div id="<?php echo esc_attr($id); ?>" class="slick-carousel-ambientes <?php echo esc_attr($className); ?>">
    	
	    	<?php while ($q->have_posts()) { $q->the_post();

	    		global $post;

				$title = sprintf( __( 'Ver ambiente %s', 'kyrya' ), get_the_title() );

	    		$r .= '<div class="slick-carousel-item">';

	    			$r .= get_the_post_thumbnail( get_the_ID(), 'full' );

	    			$r .= '<div class="slick-carousel-caption">';

	    				$mas_info = '<a href="'.get_the_permalink().'" title="'.get_the_title().'" class="btn btn-outline-white">'. $title .'</a>';

	    				$r .= '<p>'.$mas_info.'</p>';

	    			$r .= '</div>';

	    		$r .= '</div>';

    		} 

    		echo $r;

    		?>

    	</div>

    <?php }

    wp_reset_postdata();