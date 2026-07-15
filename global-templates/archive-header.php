<?php
// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$ocultar_titulo = false;
$ocultar_descripcion = false;

if ( is_tax() ) {
    $term = get_queried_object();

    $ocultar_titulo = get_field( 'ocultar_titulo', $term );
    $ocultar_descripcion = get_field( 'ocultar_descripcion', $term );
}

if ( $ocultar_titulo && $ocultar_descripcion ) {
    return false;
}
?>

<div class="wp-block-cover archive-header is-light">

    <span aria-hidden="true" class="wp-block-cover__background has-white-background-color has-background-dim has-background-dim-70"></span>

    <div class="wp-block-cover__inner-container">

        <main class="site-main" id="main">

            <?php 
            echo '<div class="text-dark">';
                chic_breadcrumb();
            echo '</div>';
            ?>

            <?php if ( !$ocultar_titulo ) {
                the_archive_title( '<h1 class="page-title mb-4">', '</h1>' ); 
            } ?>
            <?php // smn_subcategories(); ?>
            <?php if ( !$ocultar_descripcion ) {
                the_archive_description( '<div class="taxonomy-description">', '</div>' ); 
            } ?>

        </main>

    </div>

</div>