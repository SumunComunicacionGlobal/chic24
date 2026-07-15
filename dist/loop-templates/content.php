<?php
/**
 * Post rendering content according to caller of get_template_part.
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
$cols_class = 'col-sm-6 col-md-4 col-xl-3';
$post_type = get_post_type();
if ( 'producto' == $post_type ) {
	$cols_class = 'col-sm-6 col-md-4 col-lg-3 col-xl-2';
}
?>

<article <?php post_class('archive-post ' . $cols_class ); ?> id="post-<?php the_ID(); ?>">

	<a href="<?php the_permalink(); ?>">
	
		<?php echo get_the_post_thumbnail( $post->ID, 'medium_large' ); ?>
	
	</a>

	<div class="bg-random">

		<header class="entry-header">

			<?php
			the_title(
				sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ),
				'</a></h2>'
			);
			?>

			<?php if ( 'post' == get_post_type() ) : ?>

				<div class="entry-meta">
					<?php understrap_posted_on(); ?>
				</div><!-- .entry-meta -->

			<?php endif; ?>

		</header><!-- .entry-header -->

		<div class="entry-content small">

			<?php the_excerpt(); ?>

			<?php
			wp_link_pages(
				array(
					'before' => '<div class="page-links">' . __( 'Pages:', 'understrap' ),
					'after'  => '</div>',
				)
			);
			?>

		</div><!-- .entry-content -->

		<footer class="entry-footer">

			<?php understrap_entry_footer(); ?>

		</footer><!-- .entry-footer -->

	</div>

</article><!-- #post-## -->
