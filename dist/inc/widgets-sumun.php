<?php 
/* Widget areas */
add_action( 'widgets_init', 'sumun_widgets_init', 20 );
function sumun_widgets_init() {
    
    register_sidebar(
        array(
            'name'          => __( 'Pre footer', 'understrap' ),
            'id'            => 'prefooter',
            'description'   => __( 'Aparece antes del Pie de Página Completo', 'understrap' ),
            'before_widget' => '<div id="%1$s" class="footer-widget %2$s dynamic-classes">',
            'after_widget'  => '</div><!-- .footer-widget -->',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
        )
    );

    register_sidebar(
        array(
            'name'          => __( 'Copyright', 'understrap' ),
            'id'            => 'copyright',
            'description'   => __( 'Full sized footer widget with dynamic grid', 'understrap' ),
            'before_widget' => '<div id="%1$s" class="footer-widget %2$s dynamic-classes">',
            'after_widget'  => '</div><!-- .footer-widget -->',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
        )
    );

}
/***/

/* Site info */
add_action( 'understrap_site_info', 'understrap_add_site_info' );

/**
 * Add site info content.
 */
function understrap_add_site_info() {
    if (is_active_sidebar( 'copyright' )) {
        echo '<div class="row">';
            dynamic_sidebar( 'copyright' );
        echo '</div>';
    }
}

/***/