<?php
/**
 * Post rendering content according to caller of get_template_part.
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<article <?php post_class('col-4 col-md-3 col-lg-2 mb-4'); ?> id="post-<?php the_ID(); ?>">

	<?php echo get_the_post_thumbnail( $post->ID, 'medium_large', array('class' => 'rounded-circle border') ); ?>


		<header class="entry-header">

			<?php
			the_title( '<p class="entry-title">', '</p>' );
			?>

		</header><!-- .entry-header -->

</article><!-- #post-## -->
