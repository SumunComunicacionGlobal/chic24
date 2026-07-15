<?php

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( !is_tax( 'categoria_producto') ) return false;

$term = get_queried_object();

$subcategories = get_terms( array(
	'taxonomy' => 'categoria_producto',
	'parent' => $term->term_id
) );

$col_class = 'col-sm-6 col-md-4';

switch ( count($subcategories) ) {
	case 1:
		$col_class = 'col-12';
		break;
	case 2:
		$col_class = 'col-sm-6';
		break;
	case 3:
		$col_class = 'col-sm-4';
		break;
	// case 4:
	// case 8:
	// 	$col_class = 'col-sm-6 col-lg-3';
	// 	break;
	// case 5:
	// case 6:
	// case 7:
	// 	$col_class = 'col-sm-6 col-md-4';
	// 	break;
	
}

$col_class .= ' mb-3';

if( $subcategories ) {
	?>

	<div class="wrapper py-2">
			
		<div class="subcategories container">

			<div class="row justify-content-center">

				<?php foreach ($subcategories as $subcat) { ?>

					<?php

					$term_thumbnail_id = get_field( 'imagen_fondo', $subcat );

					if( !$term_thumbnail_id ) {
					
						$args = array(
							'numberposts' => 1,
							'post_type' => 'producto',
							'tax_query' => array(
								array(
									'taxonomy' => 'categoria_producto',
									'field' => 'term_id',
									'terms' => $subcat->term_id
								)
							)
						);
						$q = new WP_Query($args);

						if( $q->have_posts() ) {
							$q->the_post();
							$term_thumbnail_id = get_post_thumbnail_id();
						}
						wp_reset_postdata();

					}
					?>

					<div class="<?php echo $col_class;?>">

						<div class="wp-block-cover ek-linked-block is-light">

							<span aria-hidden="true" class="wp-block-cover__background has-background-dim"></span>

							<?php if ( $term_thumbnail_id ) echo wp_get_attachment_image( $term_thumbnail_id, 'large', false, array('class' => 'wp-block-cover__image-background') ); ?>

							<div class="wp-block-cover__inner-container">
							
								<h2 class="text-light text-center h4"><?php echo $subcat->name; ?></h2>

							</div>

							<a href="<?php echo get_term_link( $subcat ); ?>" class="editorskit-block-link"></a>

						</div>
							
					</div>

				<?php } ?>

			</div>

		</div>

	</div>

<?php } ?>