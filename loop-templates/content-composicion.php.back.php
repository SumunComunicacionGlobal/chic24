<?php
/**
 * Post rendering content according to caller of get_template_part.
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$ocultar_contenido = get_post_meta( get_the_ID(), 'ocultar_contenido_en_listado', true );
?>

<article <?php post_class('archive-post col-12'); ?> id="post-<?php the_ID(); ?>">

	<div class="row no-gutters">

		<a class="col-md-6 col-lg-8 col-imagen" href="<?php the_permalink(); ?>">
		
			<?php echo get_the_post_thumbnail( $post->ID, 'large' ); ?>
		
		</a>

		<div class="col-md-6 col-lg-4 p-5 col-contenido">

			<header class="entry-header">

				<?php
				if(!$ocultar_contenido) {
					the_title(
						sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ),
						'</a></h2>'
					);
				}
				?>

			</header><!-- .entry-header -->

			<div class="entry-content">

				<?php echo '<p class="font-weight-bold mb-0">' . $post->post_title . '</p>'; ?>
				<?php the_excerpt(); ?>

				<footer class="entry-footer">

					<?php understrap_entry_footer(); ?>

				</footer><!-- .entry-footer -->

			</div><!-- .entry-content -->

		</div>

	</div>

</article><!-- #post-## -->
