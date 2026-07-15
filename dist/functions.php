<?php
/**
 * Understrap functions and definitions
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

define( 'CONTACTO_ID', 22);

$understrap_includes = array(
	'/theme-settings.php',                  // Initialize theme default settings.
	'/setup.php',                           // Theme setup and custom theme supports.
	'/widgets.php',                         // Register widget area.
	'/enqueue.php',                         // Enqueue scripts and styles.
	'/template-tags.php',                   // Custom template tags for this theme.
	'/pagination.php',                      // Custom pagination for this theme.
	'/hooks.php',                           // Custom hooks.
	'/extras.php',                          // Custom functions that act independently of the theme templates.
	'/customizer.php',                      // Customizer additions.
	'/custom-comments.php',                 // Custom Comments file.
	'/jetpack.php',                         // Load Jetpack compatibility file.
	'/class-wp-bootstrap-navwalker.php',    // Load custom WordPress nav walker.
	'/woocommerce.php',                     // Load WooCommerce functions.
	'/editor.php',                          // Load Editor functions.
	'/deprecated.php',                      // Load deprecated functions.
	'/post-types.php',
	'/shortcodes.php',
	// '/dummy-content.php',
    '/blocks-sumun.php',
    '/seo.php',
    '/smn-zoho-campaigns.php',
);

foreach ( $understrap_includes as $file ) {
	$filepath = locate_template( 'inc' . $file );
	if ( ! $filepath ) {
		trigger_error( sprintf( 'Error locating /inc%s for inclusion', $file ), E_USER_ERROR );
	}
	require_once $filepath;
}

$content_width = 1140;
add_theme_support('editor-styles');
add_filter( 'widget_text', 'do_shortcode');
add_filter( 'wpcf7_form_elements', 'do_shortcode' );
function understrap_wpdocs_theme_add_editor_styles() {
    add_editor_style( 'css/custom-editor-style.css' );
}

add_action( 'after_setup_theme', 'editor_color_palette' );
function editor_color_palette() {

    $colores = array(
        array(
            'nombre'    => 'Primary',
            // 'valor'     => '#3d3853',
            'valor'     => '#da8864',
        ),
        array(
            'nombre'    => 'Secondary',
            // 'valor'     => '#e7dcc7',
            'valor'     => '#d1c9be',
        ),
        array(
            'nombre'    => 'Yellow',
            // 'valor'     => '#fff69e',
            'valor'     => '#fffdec',
        ),
        array(
            'nombre'    => 'Blue',
            'valor'     => '#3174ba',
        ),
        array(
            'nombre'    => 'Red',
            // 'valor'     => '#d76265',
            'valor'     => '#da8864',
        ),
        array(
            'nombre'    => 'White',
            'valor'     => '#ffffff',
        ),
        array(
            'nombre'    => 'Light',
            // 'valor'     => '#f5f5f5',
            'valor'     => '#f7f1e9',
        ),
        array(
            'nombre'    => 'Gray',
            'valor'     => '#526367',
        ),
        array(
            'nombre'    => 'Dark',
            // 'valor'     => '#2c2d37',
            'valor'     => '#353534',
        ),
        array(
            'nombre'    => 'Black',
            'valor'     => '#000000',
        ),
        array(
            'nombre'    => 'Exclusiva',
            'valor'     => '#504133',
        ),
        array(
            'nombre'    => 'Esencial',
            'valor'     => '#776c61',
        ),
        array(
            'nombre'    => 'Express',
            'valor'     => '#cd916d',
        ),
    );

    $colores_atts = array();
    foreach ($colores as $color) {
        $colores_atts[] = array(
            'name'      => $color['nombre'] . ' ' . $color['valor'],
            'slug'      => sanitize_title_with_dashes( $color['nombre'] ),
            'color'     => $color['valor'],
        );
    }

    add_theme_support( 'editor-color-palette', $colores_atts );
}


function author_page_redirect() {
    if ( is_author() ) {
        wp_redirect( home_url() );
    }
}
add_action( 'template_redirect', 'author_page_redirect' );

function es_blog() {

    if( is_singular('post') || is_category() || is_tag() || ( is_home() && !is_front_page() ) ) {
        return true;
    }

    return false;
}

add_filter( 'theme_mod_understrap_sidebar_position', 'cargar_sidebar');
function cargar_sidebar( $valor ) {
    global $wp_query;
    if ( is_singular('post') ) {
        $valor = 'right';
    }
    return $valor;
}

add_filter( 'get_post_metadata', 'kyrya_thumbnail_id_placeholder', 10, 4 );
function kyrya_thumbnail_id_placeholder( $value, $object_id, $meta_key, $single ) {

    $has_thumb = true;
    
    $meta_cache = wp_cache_get( $object_id, 'post_meta' );
    if (!isset( $meta_cache['_thumbnail_id'] )) {
        $has_thumb = false;
    }


    if ( !$has_thumb && '_thumbnail_id' == $meta_key ) {
        $fotos = get_post_meta( $object_id, 'galeria_de_fotos', true );
        $croquis = get_post_meta( $object_id, 'galeria_de_croquis', true );

        if( $fotos ) {
            $value = $fotos[0];
        } elseif( $croquis ) {
            $value = $croquis[0];
        }


    }
    return $value;

}

function galerias() {
    echo get_galerias();
}
function get_galerias() {

    if (!is_singular()) return false;

    $tablas = get_post_meta( get_the_ID(), 'tablas', true );
    $fotos = get_post_meta( get_the_ID(), 'galeria_de_fotos', true );
    $croquis = get_post_meta( get_the_ID(), 'galeria_de_croquis', true );

    $r = '';
    $datos_tecnicos = '';

    if($tablas) {
        foreach ($tablas as $tabla_id ) {
            $datos_tecnicos .= wp_get_attachment_image( $tabla_id, 'large' );
        }
    }

    if($croquis) {
        foreach ($croquis as $croquis_id ) {
            $datos_tecnicos .= wp_get_attachment_image( $croquis_id, 'medium_large' );
        }
    }

    if ($datos_tecnicos) {
        $r .= '<div id="acordeon-datos-tecnicos my-5" class="mb-5">';

            $r .= '<div class="card">';

                $r .= '<div class="card-header" id="heading-datos-tecnicos">';

                    $r .= '<h5 class="mb-0">';
                        $r .= '<button class="btn btn-link" data-toggle="collapse" data-target="#collapse-datos-tecnicos" aria-expanded="true" aria-controls="collapse-datos-tecnicos">';
                            $r .= __( 'Datos técnicos', 'kyrya' );
                        $r .= '</button>';
                    $r .= '</h5>';

                $r .= '</div>';

                $r .= '<div class="collapse" id="collapse-datos-tecnicos" aria-labelledby="heading-datos-tecnicos">';

                    $r .= '<div class="card-body">';

                        $r .= $datos_tecnicos;

                    $r .= '</div>';

                $r .= '</div>';

            $r .= '</div>';

        $r .= '</div>';
    }

    if( is_active_sidebar( 'cta-producto' ) ) {

        ob_start();
        dynamic_sidebar( 'cta-producto' );
        $r .= ob_get_clean();

    }


    if($fotos) {
        foreach ($fotos as $foto_id ) {
            $r .= wp_get_attachment_image( $foto_id, 'large' );
        }
    }
    
    if($r) {
        $r = '<div class="gallery galeria-amplia">'.$r.'</div>';
    }


    return $r;
}

add_filter( 'the_content', 'quitar_saltos_de_linea' );
function quitar_saltos_de_linea( $content ) {

    $post_type = get_post_type();
    if ( $post_type == 'composicion' || $post_type == 'producto' || $post_type == 'componente' ) {
        $content = str_replace( "<br>", "" , $content);
    }


    return $content;
}


function galeria_de_producto() {
    echo get_galeria_de_producto();
}

function get_galeria_de_producto() {
    $fotos = get_post_meta( get_the_ID(), 'galeria_de_fotos', true );
    $croquis = get_post_meta( get_the_ID(), 'galeria_de_croquis', true );

    $todas = array();
    if($fotos) $todas = array_merge($todas, $fotos);
    if($croquis) $todas = array_merge($todas, $croquis);

    $fotos_y_croquis = array( $fotos, $croquis );

    if($todas) {

        $r .= '';

        // $r .= '<h3 class="h5">' . __( 'Detalles', 'kyrya' ) . '</h3>';

        if ( is_archive() ) {

            $r .= '<div class="gallery galeria-de-producto">';

            foreach ($todas as $img_id) {
                $r .= '<a href="'.wp_get_attachment_image_url( $img_id, 'large', false ).'" title="'.get_the_title( get_the_ID() ).'">';
                    $r .= wp_get_attachment_image( $img_id, 'thumbnail' );
                $r .= '</a>';

            }
            
            $r .= '</div>';

        } else {

            foreach( $fotos_y_croquis as $gallery ) {

                $r .= '<div class="slick-slider">';

                    foreach ($gallery as $img_id) {

                        $r .= wp_get_attachment_image( $img_id, 'medium_large', false, array( 'class' => 'mb-3' ) );

                    }

                $r .= '</div>';

            }

        }

        return $r;

    } elseif( is_singular() ) {

        the_post_thumbnail( 'medium_large' );
    }
}

function chic_breadcrumb() {

    if ( function_exists('bcn_display') ) {
        echo '<p id="breadcrumbs">';
            bcn_display();
        echo '</p>';
    } elseif ( function_exists('yoast_breadcrumb') ) {
      yoast_breadcrumb( '<p id="breadcrumbs">','</p>' );
    }

}


add_filter( 'bcn_breadcrumb_url', 'chic_modify_breadcrumb_2', 10, 4 );
function chic_modify_breadcrumb_2( $url, $type, $id ) {

    if ( isset( $type[0] ) && 'taxonomy' == $type[0] ) {

        if( isset( $type[1] ) && 'coleccion' == $type[1]  ) {

            $page_id = chic_map_coleccion_term_with_page( $id );

            if ( $page_id ) {

                $url = get_permalink( $page_id );
            }

        }

    }

    return $url;
}

add_action( 'bcn_after_fill', 'chic_bcn_after_fill' );
function chic_bcn_after_fill( $breadcrumb_obj ) {
    
    foreach ( $breadcrumb_obj->breadcrumbs as $key => $item ) {
        $type = $item->get_types();
        if ( 'taxonomy' === $type[0] && 'categoria_producto' === $type[1] ) {

            $args = array(
                'numberposts' => -1,
                'post_type' => 'producto',
                'tax_query' => array(
                    array(
                        'taxonomy' => 'categoria_producto',
                        'field' => 'term_id',
                        'terms' => $item->get_id()
                    )
                )
            );
            $q = new WP_Query($args);
            if ( $q->found_posts == 1 ) {
                unset( $breadcrumb_obj->breadcrumbs[ $key ] );
            }
            wp_reset_postdata();
            
        }
    }

}


if (!function_exists( 'chic_map_coleccion_term_with_page' ) ) :
    
    function chic_map_coleccion_term_with_page( $term_id ) {

        $term = get_term( $term_id );
        $slug = sprintf( __( 'serie-%s', 'kyrya' ), $term->slug );

        // get page by slug
        $page = get_page_by_path( $slug );

        if ( $page && !is_wp_error( $page ) ) {
            return $page->ID;
        }

        return false;

    }

endif;

add_filter( 'the_title', 'sobreescribir_title', 10, 2 );
function sobreescribir_title( $title, $id ) {
    if( is_admin() ) return $title;

    $frase_destacada = get_post_meta( $id, 'frase_destacada', true );
    if( $frase_destacada) $title = $frase_destacada;
    return $title;

}

function smn_subcategories() {

    if ( !is_tax() ) return;

    $subcategorias = get_terms( array(
        'taxonomy' => get_queried_object()->taxonomy,
        'parent' => get_queried_object_id(),
    ) );

    if ( $subcategorias ) {
        echo '<div class="btn-toolbar mt-4">';

        foreach ($subcategorias as $subcategoria) {
            echo '<a class="btn btn-lg btn-primary mr-2 mb-2" href="'.get_term_link( $subcategoria ).'">'.$subcategoria->name.'</a>';
        }

        echo '</div>';
    }

}

add_action( 'template_redirect', 'redirigir_si_solo_un_producto_en_categoria' );
function redirigir_si_solo_un_producto_en_categoria() {
    if ( is_tax() ) {
        global $wp_query;

        if ( $wp_query->post_count == 1 ) {
            $post = $wp_query->posts[0];
            wp_redirect( get_permalink( $post->ID ), 302 );
            exit;
        }
    }
}