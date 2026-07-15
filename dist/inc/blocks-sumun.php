<?php 

add_action('acf/init', 'chic_acf_init_block_types');
function chic_acf_init_block_types() {

    // Check function exists.
    if( function_exists('acf_register_block_type') ) {

        acf_register_block_type(array(
            'name'              => 'ambientes',
            'title'             => __('Ambientes'),
            'description'       => __('Muestra un pase de diapositivas con los ambientes de la categoría seleccionada'),
            'render_template'   => 'block-templates/ambientes.php',
            'category'          => 'common',
            'icon'              => 'slides',
            'keywords'          => array( 'slider', 'ambientes' ),
            'mode'              => 'edit',
        ));

        acf_register_block_type(array(
            'name'              => 'componentes',
            'title'             => __('Componentes'),
            'description'       => __('Muestra un grid con los componentes de la categoría seleccionada'),
            'render_template'   => 'block-templates/componentes.php',
            'category'          => 'common',
            'icon'              => 'format-gallery',
            'keywords'          => array( 'componentes', 'productos', 'galeria' ),
            'mode'              => 'edit',
        ));

        acf_register_block_type(array(
            'name'              => 'acabados',
            'title'             => __('Acabados'),
            'description'       => __('Muestra un grid con los acabados de la categoría seleccionada'),
            'render_template'   => 'block-templates/acabados.php',
            'category'          => 'common',
            'icon'              => 'format-gallery',
            'keywords'          => array( 'acabados', 'productos', 'galeria' ),
            'mode'              => 'edit',
        ));

        acf_register_block_type(array(
            'name'              => 'productos',
            'title'             => __('Productos'),
            'description'       => __('Muestra un grid con los productos de la categoría seleccionada'),
            'render_template'   => 'block-templates/productos.php',
            'category'          => 'common',
            'icon'              => 'format-gallery',
            'keywords'          => array( 'productos', 'galeria' ),
            'mode'              => 'edit',
        ));
    }
}

function sumun_nocookie_youtube_block( $block_content, $block ) {
    // echo '<pre>'; print_r($block); echo '</pre>';

    $aviso = '<p class="small text-muted">' . __( 'Al reproducir el vídeo aceptas la <a href="https://policies.google.com/technologies/cookies?hl=es" target="_blank" rel="nofollow">política de cookies y de privacidad de Google</a>.', 'sumun' ) . '</p>';
    if ( function_exists( 'gdpr_cookie_is_accepted' ) ) {
        if ( gdpr_cookie_is_accepted( 'thirdparty' ) ) {
            $aviso = '';
        }
    }

    if ( $block['blockName'] === 'core-embed/youtube' ) {
        $block_content = str_replace('www.youtube.com', 'www.youtube-nocookie.com', $block_content);
        $block_content .= $aviso;
    }
    if ( $block['blockName'] === 'acf/video-emergente' ) {
        $block_content .= $aviso;
    }
    return $block_content;
}
 
add_filter( 'render_block', 'sumun_nocookie_youtube_block', 10, 2 );

// add_action('acf/init', 'sumun_init_block_types');
function sumun_init_block_types() {

    // Check function exists.
    if( function_exists('acf_register_block_type') ) {

        // register a block.
        acf_register_block_type(array(
            'name'              => 'team',
            'title'             => __('Equipo', 'sumun-admin'),
            'description'       => __('Muestra a los miembros del equipo'),
            'render_template'   => 'loop-templates/blocks/team.php',
            'category'          => 'embed',
            'icon'              => 'id',
            'keywords'          => array( 'team', 'equipo', 'persona', 'people' ),
        ));
    }
}

// add_filter( 'render_block', 'sumun_bootstrap_buttons', 10, 2 );
function sumun_bootstrap_buttons( $block_content, $block ) {

    if ( $block['blockName'] !== 'core/button' ) return $block_content;

    $block_content = str_replace( 'wp-block-button__link', 'wp-block-button__link btn btn-secondary btn-lg', $block_content);
    return $block_content;

}

add_filter( 'render_block', 'sumun_slider_home', 10, 2 );
function sumun_slider_home( $block_content, $block ) {

    if ( $block['blockName'] !== 'core/group' ) return $block_content;

    $block_content = str_replace( 
        array(
            'wp-block-gallery', 
        ),
        array(
            'slick-carousel-home', 
        ),
        $block_content
    );
    
    return $block_content;

}