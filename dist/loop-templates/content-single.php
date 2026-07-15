<?php
/**
 * Single post partial template.
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>




<article <?php post_class('row'); ?> id="post-<?php the_ID(); ?>">
	

	<div class="entry-content col-md-6">

		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

		<?php if ( 'post' == get_post_type() ) : ?>

			<div class="entry-meta">

				<?php understrap_posted_on(); ?>

			</div><!-- .entry-meta -->

		<?php endif; ?>

		<?php the_content(); ?>

		<?php get_template_part( 'global-templates/descargables' ); ?>

		<?php
		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'understrap' ),
				'after'  => '</div>',
			)
		);
		?>

	</div><!-- .entry-content -->

	<div class="entry-image col-md-6">

		<?php // echo get_the_post_thumbnail( $post->ID, 'large' ); ?>

		<?php galeria_de_producto(); ?>

		<?php
			$frase_destacada = get_post_meta( get_the_ID(), 'frase_destacada', true );
			if($frase_destacada) {
				echo '<p class="font-weight-bold mb-0">' . $post->post_title . '</p>';
			}
			$texto_acabados = get_post_meta( get_the_ID(), 'texto_acabados', true );
			if( $texto_acabados ) {
				echo '<p class="entry-meta">'.$texto_acabados.'</p>';
			}
		?>

	</div>

	<footer class="entry-footer col">

		<?php // galerias(); ?>

		<?php understrap_entry_footer(); ?>

	</footer><!-- .entry-footer -->

</article><!-- #post-## -->