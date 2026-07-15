<?php
/**
 * Understrap enqueue scripts
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'understrap_scripts' ) ) {
	/**
	 * Load theme's JavaScript and CSS sources.
	 */
	function understrap_scripts() {
		// Get the theme data.
		$the_theme     = wp_get_theme();
		$theme_version = $the_theme->get( 'Version' );

		echo '<link rel="preconnect" href="https://fonts.gstatic.com">';
		// echo '<link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,wght@0,400;0,700;1,400&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">';
		// echo '<link href="https://fonts.googleapis.com/css2?family=Noto+Serif+Display:wght@500;900&family=Reem+Kufi:wght@600&family=Sen:wght@400;700&display=swap" rel="stylesheet">';
		// echo '<link href="https://fonts.googleapis.com/css2?family=Reem+Kufi:wght@600&family=Sen:wght@400;700&display=swap" rel="stylesheet">';
		echo '<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">';

	    // wp_enqueue_style( 'google-fonts', 'https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,400;0,600;0,700;1,400&display=swap' );

	    wp_enqueue_style( 'slick', get_stylesheet_directory_uri() . '/js/slick/slick.css' );
	    wp_enqueue_style( 'slick-theme', get_stylesheet_directory_uri() . '/js/slick/slick-theme.css' );

		$css_version = $theme_version . '.' . filemtime( get_template_directory() . '/css/theme.min.css' );
		wp_enqueue_style( 'sumun-styles', get_template_directory_uri() . '/css/theme.min.css', array(), $css_version );

		wp_enqueue_script( 'jquery' );

	    // wp_enqueue_script( 'sticky-sidebar', get_stylesheet_directory_uri() . '/js/jquery.sticky-sidebar.min.js', array(), false, true );
	    wp_enqueue_script( 'slick', get_stylesheet_directory_uri() . '/js/slick/slick.min.js', null, null, true );

		$js_version = $theme_version . '.' . filemtime( get_template_directory() . '/js/theme.min.js' );
		wp_enqueue_script( 'sumun-scripts', get_template_directory_uri() . '/js/theme.min.js', array(), $js_version, true );
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}
} // endif function_exists( 'understrap_scripts' ).

add_action( 'wp_enqueue_scripts', 'understrap_scripts' );

function wpdocs_dequeue_script() {
    wp_dequeue_script( 'uacf7-country-select-script' );
}
add_action( 'wp_print_scripts', 'wpdocs_dequeue_script', 100 );
