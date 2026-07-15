<?php 
add_post_type_support( 'page', 'excerpt' );
// add_action( 'init', 'sumun_settings', 1000 );
function sumun_settings() {  
    // register_taxonomy_for_object_type('category', 'page');  
}


if ( ! function_exists('custom_post_type_slide') ) {

// Register Custom Post Type
function custom_post_type_slide() {

	$labels = array(
		'name'                  => _x( 'Slides', 'Post Type General Name', 'sumun' ),
		'singular_name'         => _x( 'Slide', 'Post Type Singular Name', 'sumun' ),
		'menu_name'             => __( 'Slides', 'sumun-admin' ),
		'name_admin_bar'        => __( 'Slides', 'sumun-admin' ),
		'add_new'               => __( 'Añadir nueva Slide', 'sumun-admin' ),
		'new_item'              => __( 'Nueva Slide', 'sumun-admin' ),
		'edit_item'             => __( 'Editar Slide', 'sumun-admin' ),
		'update_item'           => __( 'Actualizar Slide', 'sumun-admin' ),
		'view_item'             => __( 'Ver Slide', 'sumun-admin' ),
		'view_items'            => __( 'Ver Slide', 'sumun-admin' ),
	);
	$args = array(
		'label'                 => __( 'Slides', 'sumun' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'page-attributes', 'post-formats' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 3,
		'menu_icon'             => 'dashicons-slides',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => false,
		'can_export'            => true,
		'has_archive'           => false,
		'exclude_from_search'   => true,
		'publicly_queryable'    => true,
		'capability_type'       => 'post',
		'show_in_rest' 			=> true,
		'taxonomies'			=> array( 'cat_slide'),
	);
	register_post_type( 'slide', $args );

}
add_action( 'init', 'custom_post_type_slide', 0 );

}


if ( ! function_exists('custom_post_type_composicion') ) {

// Register Custom Post Type
function custom_post_type_composicion() {

	$labels = array(
		'name'                  => _x( 'Ambientes', 'Post Type General Name', 'kyrya' ),
		'singular_name'         => _x( 'Ambiente', 'Post Type Singular Name', 'kyrya' ),
		'menu_name'             => __( 'Ambientes', 'kyrya-admin' ),
		'name_admin_bar'        => __( 'Ambientes', 'kyrya-admin' ),
		'add_new'               => __( 'Añadir nueva Ambiente', 'kyrya-admin' ),
		'new_item'              => __( 'Nueva Ambiente', 'kyrya-admin' ),
		'edit_item'             => __( 'Editar Ambiente', 'kyrya-admin' ),
		'update_item'           => __( 'Actualizar Ambiente', 'kyrya-admin' ),
		'view_item'             => __( 'Ver Ambiente', 'kyrya-admin' ),
		'view_items'            => __( 'Ver Ambientes', 'kyrya-admin' ),
	);
	$args = array(
		'label'                 => __( 'Ambientes', 'kyrya' ),
		// 'description'           => __( 'Design attitude', 'kyrya' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'excerpt', 'thumbnail', 'custom-fields' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-images-alt',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => __( 'ambientes', 'kyrya' ),
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
		'taxonomies'			=> array('coleccion'),
		'show_in_rest' 			=> true,

	);
	register_post_type( 'composicion', $args );

}
add_action( 'init', 'custom_post_type_composicion', 0 );

}


if ( ! function_exists('custom_post_type_productos') ) {

// Register Custom Post Type
function custom_post_type_productos() {

	$labels = array(
		'name'                  => _x( 'Productos', 'Post Type General Name', 'kyrya' ),
		'singular_name'         => _x( 'Producto', 'Post Type Singular Name', 'kyrya' ),
		'menu_name'             => __( 'Productos', 'kyrya-admin' ),
		'name_admin_bar'        => __( 'Productos', 'kyrya-admin' ),
		'add_new'               => __( 'Añadir nuevo Producto', 'kyrya-admin' ),
		'new_item'              => __( 'Nuevo Producto', 'kyrya-admin' ),
		'edit_item'             => __( 'Editar Producto', 'kyrya-admin' ),
		'update_item'           => __( 'Actualizar Producto', 'kyrya-admin' ),
		'view_item'             => __( 'Ver Producto', 'kyrya-admin' ),
		'view_items'            => __( 'Ver Productos', 'kyrya-admin' ),
	);
	$args = array(
		'label'                 => __( 'Producto', 'kyrya' ),
		'description'           => __( 'Nuestro catálogo', 'kyrya' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'excerpt', 'thumbnail', 'custom-fields', 'page-attributes' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-screenoptions',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => __( 'productos-index', 'kyrya' ),
		'rewrite'				=> array(
									'slug'			=> __( 'productos', 'kyrya' ),
									'with_front'	=> true,
		),
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
		'taxonomies'			=> array('categoria_producto', 'coleccion'),
		'show_in_rest' 			=> true,
	);
	register_post_type( 'producto', $args );

}
add_action( 'init', 'custom_post_type_productos', 0 );

}

if ( ! function_exists('custom_post_type_componente') ) {

// Register Custom Post Type
function custom_post_type_componente() {

	$labels = array(
		'name'                  => _x( 'Componentes', 'Post Type General Name', 'kyrya' ),
		'singular_name'         => _x( 'Componente', 'Post Type Singular Name', 'kyrya' ),
		'menu_name'             => __( 'Componentes', 'kyrya-admin' ),
		'name_admin_bar'        => __( 'Componentes', 'kyrya-admin' ),
		'add_new'               => __( 'Añadir nuevo Componente', 'kyrya-admin' ),
		'new_item'              => __( 'Nuevo Componente', 'kyrya-admin' ),
		'edit_item'             => __( 'Editar Componente', 'kyrya-admin' ),
		'update_item'           => __( 'Actualizar Componente', 'kyrya-admin' ),
		'view_item'             => __( 'Ver Componente', 'kyrya-admin' ),
		'view_items'            => __( 'Ver Componentes', 'kyrya-admin' ),
	);
	$args = array(
		'label'                 => __( 'Componente', 'kyrya' ),
		// 'description'           => __( 'Nuestro catálogo', 'kyrya' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'excerpt', 'thumbnail', 'custom-fields', 'page-attributes' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-screenoptions',
		'show_in_admin_bar'     => false,
		'show_in_nav_menus'     => false,
		'can_export'            => true,
		'has_archive'           => false,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
		'taxonomies'			=> array('categoria_componente', 'coleccion'),
		'show_in_rest' 			=> true,
	);
	register_post_type( 'componente', $args );

}
add_action( 'init', 'custom_post_type_componente', 0 );

}

if ( ! function_exists('custom_post_type_opcion_productos') ) {

// Register Custom Post Type
function custom_post_type_opcion_productos() {

	$labels = array(
		'name'                  => _x( 'Opciones de producto', 'Post Type General Name', 'kyrya' ),
		'singular_name'         => _x( 'Opción de producto', 'Post Type Singular Name', 'kyrya' ),
		'menu_name'             => __( 'Opciones de producto', 'kyrya-admin' ),
		'name_admin_bar'        => __( 'Opciones de producto', 'kyrya-admin' ),
		'add_new'               => __( 'Añadir nueva Opción de producto', 'kyrya-admin' ),
		'new_item'              => __( 'Nueva Opción de producto', 'kyrya-admin' ),
		'edit_item'             => __( 'Editar Opción de producto', 'kyrya-admin' ),
		'update_item'           => __( 'Actualizar Opción de producto', 'kyrya-admin' ),
		'view_item'             => __( 'Ver Opción de producto', 'kyrya-admin' ),
		'view_items'            => __( 'Ver Opciones de producto', 'kyrya-admin' ),
	);
	$args = array(
		'label'                 => __( 'Opción de producto', 'kyrya' ),
		// 'description'           => __( 'Nuestro catálogo', 'kyrya' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'thumbnail' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-image-filter',
		'show_in_admin_bar'     => false,
		'show_in_nav_menus'     => false,
		'can_export'            => true,
		'has_archive'           => false,
		'exclude_from_search'   => true,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
		// 'taxonomies'			=> array('categoria_producto'),
		'show_in_rest' 			=> true,
	);
	register_post_type( 'opcion_producto', $args );

}
add_action( 'init', 'custom_post_type_opcion_productos', 0 );

}

if ( ! function_exists('custom_post_type_acabados') ) {

// Register Custom Post Type
function custom_post_type_acabados() {

	$labels = array(
		'name'                  => _x( 'Acabados', 'Post Type General Name', 'kyrya' ),
		'singular_name'         => _x( 'Acabado', 'Post Type Singular Name', 'kyrya' ),
		'menu_name'             => __( 'Acabados', 'kyrya-admin' ),
		'name_admin_bar'        => __( 'Acabados', 'kyrya-admin' ),
		'add_new'               => __( 'Añadir nuevo Acabado', 'kyrya-admin' ),
		'new_item'              => __( 'Nuevo Acabado', 'kyrya-admin' ),
		'edit_item'             => __( 'Editar Acabado', 'kyrya-admin' ),
		'update_item'           => __( 'Actualizar Acabado', 'kyrya-admin' ),
		'view_item'             => __( 'Ver Acabado', 'kyrya-admin' ),
		'view_items'            => __( 'Ver Acabados', 'kyrya-admin' ),
	);
	$args = array(
		'label'                 => __( 'Acabado', 'kyrya' ),
		'description'           => __( 'Todas las posibilidades', 'kyrya' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'thumbnail', 'custom-fields' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-admin-appearance',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => false,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
		'taxonomies'			=> array('categoria_acabado', 'coleccion'),
		'show_in_rest' 			=> true,
	);
	register_post_type( 'acabado', $args );

}
add_action( 'init', 'custom_post_type_acabados', 0 );

}


if ( ! function_exists('custom_post_type_aperturas') ) {

// Register Custom Post Type
function custom_post_type_aperturas() {

	$labels = array(
		'name'                  => _x( 'Aperturas', 'Post Type General Name', 'kyrya' ),
		'singular_name'         => _x( 'Apertura', 'Post Type Singular Name', 'kyrya' ),
		'menu_name'             => __( 'Aperturas', 'kyrya-admin' ),
		'name_admin_bar'        => __( 'Aperturas', 'kyrya-admin' ),
		'add_new'               => __( 'Añadir nueva Apertura', 'kyrya-admin' ),
		'new_item'              => __( 'Nueva Apertura', 'kyrya-admin' ),
		'edit_item'             => __( 'Editar Apertura', 'kyrya-admin' ),
		'update_item'           => __( 'Actualizar Apertura', 'kyrya-admin' ),
		'view_item'             => __( 'Ver Apertura', 'kyrya-admin' ),
		'view_items'            => __( 'Ver Aperturas', 'kyrya-admin' ),
	);
	$args = array(
		'label'                 => __( 'Apertura', 'kyrya' ),
		'description'           => __( '', 'kyrya' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'excerpt', 'thumbnail', 'custom-fields' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-editor-expand',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => false,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
		'taxonomies'			=> array('tipo_apertura'),
		'show_in_rest' 			=> true,
	);
	register_post_type( 'apertura', $args );

}
// add_action( 'init', 'custom_post_type_aperturas', 0 );

}




if ( ! function_exists('cat_slide_function') ) {

// Register Custom Taxonomy
function cat_slide_function() {

	$labels = array(
		'name'                       => _x( 'Categorías de Slides', 'Taxonomy General Name', 'kyrya' ),
		'singular_name'              => _x( 'Categoría de Slide', 'Taxonomy Singular Name', 'kyrya' ),
		'menu_name'                  => __( 'Categorías de Slides', 'kyrya-admin' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => false,
		'show_tagcloud'              => false,
		'show_in_rest' 				=> true,
	);
	register_taxonomy( 'cat_slide', array( 'slide' ), $args );

}
add_action( 'init', 'cat_slide_function', 0 );

}

if ( ! function_exists('categoria_producto_function') ) {

// Register Custom Taxonomy
function categoria_producto_function() {

	$labels = array(
		'name'                       => _x( 'Categorías de producto', 'Taxonomy General Name', 'kyrya' ),
		'singular_name'              => _x( 'Categoría de producto', 'Taxonomy Singular Name', 'kyrya' ),
		'menu_name'                  => __( 'Categorías de producto', 'kyrya-admin' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => false,
		'show_in_rest' 				=> true,
		'rewrite'					=> ['slug' => 'tipo-producto', 'with_front' => false]
	);
	register_taxonomy( 'categoria_producto', array( 'producto' ), $args );

}
add_action( 'init', 'categoria_producto_function', 0 );

}

if ( ! function_exists('categoria_componente_function') ) {

// Register Custom Taxonomy
function categoria_componente_function() {

	$labels = array(
		'name'                       => _x( 'Categorías de Componente', 'Taxonomy General Name', 'kyrya' ),
		'singular_name'              => _x( 'Categoría de Componente', 'Taxonomy Singular Name', 'kyrya' ),
		'menu_name'                  => __( 'Categorías de Componente', 'kyrya-admin' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => false,
		'show_tagcloud'              => false,
		'show_in_rest' 			=> true,
		'rewrite'					=> ['slug' => 'componentes/tipo', 'with_front' => false]
	);
	register_taxonomy( 'categoria_componente', array( 'componente' ), $args );

}
add_action( 'init', 'categoria_componente_function', 0 );

}

if ( ! function_exists('coleccion_tax_function') ) {

// Register Custom Taxonomy
function coleccion_tax_function() {

	$labels = array(
		'name'                       => _x( 'Series', 'Taxonomy General Name', 'kyrya' ),
		'singular_name'              => _x( 'Serie', 'Taxonomy Singular Name', 'kyrya' ),
		'menu_name'                  => __( 'Series', 'kyrya-admin' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => false,
		'show_in_rest' 			=> true,
		'rewrite'					=> ['slug' => 'series', 'with_front' => false]
	);
	register_taxonomy( 'coleccion', array( 'composicion', 'producto', 'componente', 'acabado' ), $args );

}
add_action( 'init', 'coleccion_tax_function', 0 );

}

if ( ! function_exists('categoria_acabado_tax_function') ) {

// Register Custom Taxonomy
function categoria_acabado_tax_function() {

	$labels = array(
		'name'                       => _x( 'Categorías de acabados', 'Taxonomy General Name', 'kyrya' ),
		'singular_name'              => _x( 'Categoría de acabados', 'Taxonomy Singular Name', 'kyrya' ),
		'menu_name'                  => __( 'Categorías de acabados', 'kyrya-admin' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => false,
		'show_in_rest' 			=> true,
	);
	register_taxonomy( 'categoria_acabado', array( 'acabado' ), $args );

}
add_action( 'init', 'categoria_acabado_tax_function', 0 );

}

if ( ! function_exists('tipo_apertura_tax_function') ) {

// Register Custom Taxonomy
function tipo_apertura_tax_function() {

	$labels = array(
		'name'                       => _x( 'Tipos de Apertura', 'Taxonomy General Name', 'kyrya' ),
		'singular_name'              => _x( 'Tipo de Apertura', 'Taxonomy Singular Name', 'kyrya' ),
		'menu_name'                  => __( 'Tipos de Apertura', 'kyrya-admin' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => false,
		'show_in_rest' 			=> true,
	);
	register_taxonomy( 'tipo_apertura', array( 'apertura' ), $args );

}
add_action( 'init', 'tipo_apertura_tax_function', 0 );

}



function wpb_change_title_text( $title ){
     $screen = get_current_screen();
  
     if  ( 'portfolio_page' == $screen->post_type ) {
          $title = 'Título del proyecto';
     } elseif  ( 'slide' == $screen->post_type ) {
          $title = 'Título de la slide';
     } elseif  ( 'team' == $screen->post_type ) {
          $title = 'Nombre y apellidos';
     } elseif ( 'acabado' == $screen->post_type ) {
          $title = 'Nombre del acabado y código';
     } elseif ( 'composicion' == $screen->post_type ) {
          $title = 'Número de la composición, por ejemplo Ambiente XXX';
     }  
  
     return $title;
}
add_filter( 'enter_title_here', 'wpb_change_title_text' );



// ADD NEW COLUMN
add_filter('manage_posts_columns', 'sumun_columns_head');
add_filter('manage_pages_columns', 'sumun_columns_head');
add_action('manage_posts_custom_column', 'sumun_columns_content', 10, 2);
add_action('manage_pages_custom_column', 'sumun_columns_content', 10, 2);
function sumun_columns_head($defaults) {
	// $defaults = array('featured_image' => 'Imagen') + $defaults;
    $defaults['featured_image'] = 'Imagen';
    $defaults['extracto'] = 'Resumen';
    $defaults['tablas'] = 'Tablas';

    return $defaults;
}
 
// SHOW THE FEATURED IMAGE
function sumun_columns_content($column_name, $post_ID) {
    if ($column_name == 'featured_image') {
    	echo '<div style="height:100px;">' . get_the_post_thumbnail( $post_ID, array(80,80) ) . '</div>';

    }
    if ($column_name == 'extracto') {
    	$post = get_post($post_ID);
    	echo $post->post_excerpt;
    }
    if ($column_name == 'tablas') {
    	$tablas_ids = get_post_meta( $post_ID, 'tablas', true );
    	if($tablas_ids) {
	    	foreach ($tablas_ids as $img_id) {
	    		echo '<a href="'.wp_get_attachment_image_url( $img_id, 'large' ).'" target="_blank">' . wp_get_attachment_image( $img_id, array(100,100) ) . '</a>';
	    	}
	    }
    	// echo implode(', ', $tablas_ids);

    }
}

function filter_productos_by_taxonomies( $post_type, $which ) {

	// Apply this only on a specific post type
	// if ( 'car' !== $post_type )
	// 	return;


	// A list of taxonomy slugs to filter by
	// $taxonomies = array( 'manufacturer', 'model', 'transmission', 'doors', 'color' );
	$taxonomies = get_object_taxonomies( $post_type );
	if (($key = array_search('acabado', $taxonomies)) !== false) {
	    unset($taxonomies[$key]);
	}

	foreach ( $taxonomies as $taxonomy_slug ) {

		// Retrieve taxonomy data
		$taxonomy_obj = get_taxonomy( $taxonomy_slug );
		$taxonomy_name = $taxonomy_obj->labels->name;

		// Retrieve taxonomy terms
		$terms = get_terms( $taxonomy_slug );

		// Display filter HTML
		echo "<select name='{$taxonomy_slug}' id='{$taxonomy_slug}' class='postform'>";
		echo '<option value="">' . sprintf( esc_html__( 'Todos los %s' ), $taxonomy_name ) . '</option>';
		foreach ( $terms as $term ) {
			printf(
				'<option value="%1$s" %2$s>%3$s (%4$s)</option>',
				$term->slug,
				( ( isset( $_GET[$taxonomy_slug] ) && ( $_GET[$taxonomy_slug] == $term->slug ) ) ? ' selected="selected"' : '' ),
				$term->name,
				$term->count
			);
		}
		echo '</select>';
	}

}
add_action( 'restrict_manage_posts', 'filter_productos_by_taxonomies' , 10, 2);
?>