<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();

$container = get_theme_mod( 'understrap_container_type' );
$post_type = get_post_type();
if ( isset( $_GET['post_type'] ) ) {
	$post_type = $_GET['post_type'];
}
$img_fondo_id = false;
$img_fondo_url = '';
if( is_tax() ) {
	$img_fondo_id = get_term_meta( get_queried_object_id(), 'imagen_fondo', true );
	$img_fondo_url = wp_get_attachment_image_url( $img_fondo_id, 'full', false );
}
$has_bg_img = false;
if( $img_fondo_id ) {
	$has_bg_img = 'has-background-image';
}
?>

<div id="archive-wrapper">

	<?php get_template_part( 'global-templates/archive-header' ); ?>
	
	<?php 
	ob_start();
	get_template_part( 'global-templates/subcategories' ); 
	$subcategories = ob_get_clean();

	echo $subcategories;

	if ( !$subcategories ) {
	?>

		<!-- <div class="container"> -->

			<?php if ( have_posts() ) : ?>

				<div class="row no-gutters">

					<?php /* Start the Loop */ ?>
					<?php while ( have_posts() ) : the_post(); ?>

						<?php

						/*
						* Include the Post-Format-specific template for the content.
						* If you want to override this in a child theme, then include a file
						* called content-___.php (where ___ is the Post Format name) and that will be used instead.
						*/
						if ( 'post' == $post_type ) {
							get_template_part( 'loop-templates/content', get_post_format() );
						} else {
							get_template_part( 'loop-templates/content', $post_type );
						}
						?>

					<?php endwhile; ?>

				</div>

			<?php else : ?>

				<?php get_template_part( 'loop-templates/content', 'none' ); ?>

			<?php endif; ?>

		<!-- </div> -->

		<div class="<?php echo esc_attr( $container ); ?>" id="content" tabindex="-1">

			<!-- The pagination component -->
			<?php understrap_pagination(); ?>

		</div><!-- .container -->

	<?php } ?>

</div><!-- #archive-wrapper -->

<?php get_footer(); ?>
