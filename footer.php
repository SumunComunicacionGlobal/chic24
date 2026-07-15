<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$container = get_theme_mod( 'understrap_container_type' );
?>

<!-- <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/ilustraciones/ilustracion-espejos-h.png" alt="Decoración pie de página" class="imagen-footer" /> -->

<?php if ( is_active_sidebar( 'prefooter' ) && ( is_singular( 'ambiente' ) || is_singular( 'producto' ) || is_singular( 'componente') || is_singular( 'composicion') ) ) : ?>

	<!-- ******************* The Footer Full-width Widget Area ******************* -->

	<div class="wrapper" id="wrapper-prefooter">

		<div class="<?php echo esc_attr( $container ); ?>" id="prefooter-content" tabindex="-1">

			<div class="row">

				<?php dynamic_sidebar( 'prefooter' ); ?>

			</div>

		</div>

	</div><!-- #wrapper-footer-full -->

<?php endif; ?>


<?php get_template_part( 'sidebar-templates/sidebar', 'footerfull' ); ?>

<div class="wrapper bg-secondary" id="wrapper-footer">

	<div class="container-fluid">

		<footer class="site-footer" id="colophon">

			<div class="site-info">

				<?php


				echo '<div class="row">';
				
					echo '<div class="col-md-4">';
					
					    if (is_active_sidebar( 'copyright' )) {
					        echo '<div class="row">';
					            dynamic_sidebar( 'copyright' );
					        echo '</div>';
					    } else {
					    	echo '<span class="nav-link">' . get_bloginfo( 'name' ) . ' © ' . date('Y') . '</span>';
					    }

			        echo '</div>';

					echo '<div class="col-md-4 mb-4">';
					
						echo '<nav class="navbar-expand">';

							wp_nav_menu(
								array(
									'theme_location'  => 'legal',
									'container_class' => 'collapse navbar-collapse',
									'container_id'    => 'navbarLegal',
									'menu_class'      => 'navbar-nav mx-auto',
									'fallback_cb'     => '',
									'menu_id'         => 'legal-menu',
									'depth'           => 1,
									'walker'          => new Understrap_WP_Bootstrap_Navwalker(),
								)
							);


				        echo '</nav>';

			        echo '</div>';

					echo '<div class="col-md-4">';

						echo get_redes_sociales();

			        echo '</div>';

		        echo '</div>';


		        ?>

			</div><!-- .site-info -->

		</footer><!-- #colophon -->

	</div><!-- container end -->

</div><!-- wrapper end -->

</div><!-- #page we need this extra closing tag here -->

<?php wp_footer(); ?>

</body>

</html>

