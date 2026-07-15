<?php
/**
 * Post rendering content according to caller of get_template_part.
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<article <?php post_class('col-6 col-md-4 col-xl-3 mb-4'); ?> id="post-<?php the_ID(); ?>">

	<a href="<?php the_permalink(); ?>">

		<?php echo get_the_post_thumbnail( $post->ID, 'medium_large' ); ?>

	</a>

	<header class="entry-header">

		<?php
		the_title(
			sprintf( '<h3 class="entry-title text-center h6"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ),
			'</a></h3>'
		);
		?>

		<?php if ( 'post' == get_post_type() ) : ?>

			<div class="entry-meta">
				<?php understrap_posted_on(); ?>
			</div><!-- .entry-meta -->

		<?php endif; ?>

	</header><!-- .entry-header -->

	<footer class="entry-footer">

		<?php understrap_entry_footer(); ?>

	</footer><!-- .entry-footer -->


</article><!-- #post-## -->
