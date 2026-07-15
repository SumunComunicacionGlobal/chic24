<?php
/**
 * Hero setup.
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( !is_singular( array( 'componente', 'producto' ) ) && !is_tax( array( 'categoria_producto', 'coleccion' ) ) ) return false;

if ( is_singular() ) {
	$pt = get_post_type();
	$taxonomy = 'coleccion';
	if ( 'producto' == $pt ) {
		$taxonomy = 'categoria_producto';
	}


	$terms = get_the_terms( get_the_ID(), $taxonomy );
	if ( $terms && !is_wp_error( $terms ) ) {
		$term = $terms[0];
	} else {
		return false;
	}

	$img_id = get_field( 'imagen_cabecera', $term );
	$img_id_mobile = get_field( 'imagen_cabecera_movil', $term );

} elseif ( is_tax() ) {

	$term = get_queried_object();
	$img_id = get_field( 'imagen_cabecera', $term );
	$img_id_mobile = get_field( 'imagen_cabecera_movil', $term );

}

if ( $img_id ) {

	if ( $img_id_mobile ) {

		echo wp_get_attachment_image( $img_id, 'full', false, array( 'class' => 'w-100 d-none d-md-block' ) );
		echo wp_get_attachment_image( $img_id_mobile, 'large', false, array( 'class' => 'w-100 d-md-none' ) );

	} else {

		echo wp_get_attachment_image( $img_id, 'full', false, array( 'class' => 'w-100' ) );
		
	}

}