<?php
/**
 * The template for displaying all single posts.
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();
$container = get_theme_mod( 'understrap_container_type' );
$post_type = get_post_type();
$url_simulador = get_post_meta( get_the_ID(), 'url_simulador', true );
?>

<?php if( 'post' != $post_type ) : ?>

	<?php if ( $url_simulador ) : ?>

		<div class="imagen-cabecera-wrapper">
			<?php echo do_shortcode( '[simulador src="'.$url_simulador.'"]' ); ?>
		</div>

	<?php elseif ( !is_singular( 'componente' ) && !is_singular('producto') ) : ?>

		<div class="imagen-cabecera-wrapper">
			<?php the_post_thumbnail( 'large', array('class' => 'imagen-cabecera') ); ?>
		</div>

	<?php endif; ?>

<?php endif; ?>

<div class="wrapper" id="single-wrapper">

	<div class="<?php echo esc_attr( $container ); ?>" id="content" tabindex="-1">

		<div class="row">

			<!-- Do the left sidebar check -->
			<?php get_template_part( 'global-templates/left-sidebar-check' ); ?>

			<main class="site-main" id="main">

				<?php chic_breadcrumb(); ?>

				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'loop-templates/content-single', $post_type ); ?>

					<?php // understrap_post_nav(); ?>

					<?php
					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;
					?>

				<?php endwhile; // end of the loop. ?>

			</main><!-- #main -->

			<!-- Do the right sidebar check -->
			<?php get_template_part( 'global-templates/right-sidebar-check' ); ?>

		</div><!-- .row -->

	</div><!-- #content -->

</div><!-- #single-wrapper -->

<?php get_footer(); ?>
