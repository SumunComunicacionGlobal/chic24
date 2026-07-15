<?php
/**
 * Post rendering content according to caller of get_template_part.
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$url_simulador = get_post_meta( get_the_ID(), 'url_simulador', true );
$ocultar_contenido = get_post_meta( get_the_ID(), 'ocultar_contenido_en_listado', true );

?>

<?php
if ( $url_simulador ) { ?>

	<div class="col-12 col-md-8 col-lg-6 px-2 px-md-5 py-5">

		<header class="entry-header">

			<?php
			if(!$ocultar_contenido) {
				the_title(
					sprintf( '<h2 class="entry-title">', esc_url( get_permalink() ) ),
					'</h2>'
				);
			}
			?>

		</header><!-- .entry-header -->

		<div class="entry-content">

			<?php if ( get_the_title() != $post->post_title ) {

				echo '<p class="font-weight-bold mb-0">' . $post->post_title . '</p>'; 
				
			} ?>

			<?php // the_excerpt(); ?>
			<?php the_content(); ?>

			<footer class="entry-footer">

				<?php understrap_entry_footer(); ?>

			</footer><!-- .entry-footer -->

		</div><!-- .entry-content -->

	</div>


	</div>

		<div class="col has-white-background-color">

			<?php echo do_shortcode( '[simulador src="'.$url_simulador.'"]' ); ?>

		</div>

	<div class="row no-gutters">

<?php } else { ?>

	<article <?php post_class('archive-post col-12'); ?> id="post-<?php the_ID(); ?>">

		<div class="col-imagen">
		
			<?php echo get_the_post_thumbnail( $post->ID, 'large' ); ?>
		
		</div>

		<div class="p-5 col-contenido">

			<header class="entry-header">

				<?php
				if(!$ocultar_contenido) {
					the_title(
						sprintf( '<h2 class="entry-title">', esc_url( get_permalink() ) ),
						'</h2>'
					);
				}
				?>

			</header><!-- .entry-header -->

			<div class="entry-content">

				<?php if ( get_the_title() != $post->post_title ) {

					echo '<p class="font-weight-bold mb-0">' . $post->post_title . '</p>'; 
					
				} ?>

				<?php
					$frase_destacada = get_post_meta( get_the_ID(), 'frase_destacada', true );
					if($frase_destacada) {
						echo '<p class="font-weight-bold mb-0">' . $post->post_title . '</p>';
					}
					$texto_acabados = get_post_meta( get_the_ID(), 'texto_acabados', true );
					if( $texto_acabados ) {
						echo '<p class="entry-meta font-weight-bold">'.$texto_acabados.'</p>';
					}
				?>

				<?php // the_excerpt(); ?>
				<?php the_content(); ?>

				<div class="entry-image">

					<?php galeria_de_producto(); ?>

				</div>

				<footer class="entry-footer">

					<?php galerias(); ?>

					<?php understrap_entry_footer(); ?>

				</footer><!-- .entry-footer -->

			</div><!-- .entry-content -->

		</div>

	</article><!-- #post-## -->

<?php } ?>