<?php 
function contenido_pagina($atts) {
	extract( shortcode_atts(
		array(
				'id' 	=> 0,
				'imagen'	=> 'no',
				'dominio'	=> false,

		), $atts)	
	);
	if ($dominio) {
		$api_url = $dominio . '/wp-json/wp/v2/pages/' . $id;
		$data = wp_remote_get( $api_url );
		$data_decode = json_decode( $data['body'] );

		// echo '<pre>'; print_r($data_decode); echo '</pre>';

		$content = $data_decode->content->rendered;
		return $content;
	} else {
		if ( 0 != $id) {
			$content_post = get_post($id);
			$content = $content_post->post_content;
			$content = '<div class="post-content-container">'.apply_filters('the_content', $content) .'</div>';
			if ('si' == $imagen) {
				$content = '<div class="entry-thumbnail">'.get_the_post_thumbnail($id, 'full') . '</div>' . $content;
			}
			return $content;
		}
	}
}
add_shortcode('contenido_pagina','contenido_pagina');

function home_url_shortcode() {
	return get_home_url();
}
add_shortcode('home_url','home_url_shortcode');

function theme_url_shortcode() {
	return get_stylesheet_directory_uri();
}
add_shortcode('theme_url','theme_url_shortcode');

function uploads_url_shortcode() {
	$upload_dir = wp_upload_dir();
	$uploads_url = $upload_dir['baseurl'];
	return $uploads_url;
}
add_shortcode('uploads_url','uploads_url_shortcode');

function year_shortcode() {
  $year = date('Y');
  return $year;
}
add_shortcode('year', 'year_shortcode');

function term_link_sh( $atts ) {
	extract( shortcode_atts(
		array(
				'id' 	=> 0,
		), $atts)	
	);
	$id = intval($id);
	return get_term_link( $id );
}
add_shortcode('cat_link', 'term_link_sh');

function post_link_sh( $atts ) {
	extract( shortcode_atts(
		array(
				'id' 	=> 0,
		), $atts)	
	);
	$id = intval($id);
	return get_the_permalink( $id );
}
add_shortcode('post_link', 'post_link_sh');

// Link Sumun
function link_sumun( $atts ) {

	// Attributes
	extract( shortcode_atts(
		array(
			'texto' => 'Diseño web: Sumun.net',
			'url'	=> 'https://sumun.net',
		), $atts )
	);

    $link = '<a href="'.$url.'" target="_blank">'.$texto.'</a>';
    if (is_front_page()) {
        return $link;
    }
    return $texto;
}
add_shortcode( 'link_sumun', 'link_sumun' );

function paginas_hijas() {
	global $post;
	if ( is_post_type_hierarchical( $post->post_type ) /*&& '' == $post->post_content */) {
		$args = array(
			'post_type'			=> array($post->post_type),
			'posts_per_page'	=> -1,
			'post_status'		=> 'publish',
			'orderby'			=> 'menu_order',
			'order'				=> 'ASC',
			'post_parent'		=> $post->ID,
		);
		$r = '';
		$query = new WP_Query($args);
		if ($query->have_posts() ) {
			$r .= '<div class="contenido-adicional mt-5">';
			// $r .= '<h3>'.__( 'Contenido en', 'sumun' ).' "'.$post->post_title.'"</h3>';
			// $r .= '<ul>';
			while($query->have_posts() ) {
				$query->the_post();
				// $r .= '<li>';
					$r .= '<a class="btn btn-primary btn-lg mr-2 mb-2 pagina-hija" href="'.get_permalink( get_the_ID() ).'" title="'.get_the_title().'" role="button" aria-pressed="false">'.get_the_title().'</a>';
				$r .= '</li>';
			}
			// $r .= '</ul>';
			// $r .= '</div>';
		} elseif(0 != $post->post_parent) {
			wp_reset_postdata();
			$current_post_id = get_the_ID();
			$args['post_parent'] = $post->post_parent;
			$query = new WP_Query($args);
			if ($query->have_posts() && $query->found_posts > 1 ) {
				$r .= '<div class="contenido-adicional">';
				while($query->have_posts() ) {
					$query->the_post();
					if ($current_post_id == get_the_ID()) {
						$r .= '<span class="btn btn-primary btn-sm mr-2 mb-2">'.get_the_title().'</span>';
					} else {
						$r .= '<a class="btn btn-outline-primary btn-sm mr-2 mb-2" href="'.get_permalink( get_the_ID() ).'" title="'.get_the_title().'" role="button" aria-pressed="false">'.get_the_title().'</a>';
					}
				}
				$r .= '</div>';
			}
		}
		wp_reset_postdata();
		return $r;
	}
}
add_shortcode( 'paginas_hijas', 'paginas_hijas' );

// add_filter('the_content', 'mostrar_paginas_hijas', 100);
function mostrar_paginas_hijas($content) {
	global $post;
	if (is_admin() || !is_singular() || !in_the_loop() || is_front_page() ) return $content;
	global $post;
	if (has_shortcode( $post->post_content, 'paginas_hijas' )) return $content;

	return $content . paginas_hijas();

}

function get_redes_sociales() {

	$r = '';
	
    $redes_sociales = array(
        'email' => 'envelope',
        'whatsapp' => 'whatsapp',
        'linkedin' => 'linkedin',
        'twitter' => 'twitter',
        'facebook' => 'facebook',
        'instagram' => 'instagram',
        'youtube' => 'youtube',
        'skype' => 'skype',
        'pinterest' => 'pinterest',
        'flickr' => 'flickr',
        'blog' => 'rss',
    );
    $r .= '<div class="redes-sociales">';

    foreach ($redes_sociales as $red => $fa_class) {
    	$url = get_theme_mod( $red, '' );
    	if( '' != $url) {
	    	$r .= '<a href="'.$url.'" target="_blank" rel="nofollow" title="'.sprintf( __( 'Abrir %s en otra pestaña', 'sumun' ), $red ).'"><span class="red-social '.$red.' fa fa-'.$fa_class.'"></span></a>';
    	}
    }

    // $r .= '<span class="follow-us">' . __( 'Follow us', 'sumun' ) . '</span>';

    $r .= '</div>';

    return $r;

}
add_shortcode( 'redes_sociales', 'get_redes_sociales' );

function get_info_basica_privacidad() {

	$r = '';
	
	$text = get_theme_mod( 'info_privacidad_formularios', '' );
	if( '' != $text) {
		$r .= '<div class="info-basica-privacidad">';
	    	$r .= wpautop( $text );
		$r .= '</div>';
	}

    return $r;

}
add_shortcode( 'info_basica_privacidad', 'get_info_basica_privacidad' );

function sitemap() {
	$pt_args = array(
		'has_archive'		=> true,
	);
	$pts = get_post_types( $pt_args );
	// if (isset($pts['rl_gallery'])) unset $pts['rl_gallery'];
	$pts = array_merge( array('page'), $pts, array('post') );
	$r = '';

	foreach ($pts as $pt) {
		$pto = get_post_type_object( $pt );
		$taxonomies = get_object_taxonomies( $pt );

		$posts_args = array(
				'post_type'			=> $pt,
				'posts_per_page'	=> -1,
				'orderby'			=> 'menu_order',
				'order'				=> 'asc',
		);

		$posts_q = new WP_Query($posts_args);
		if ($posts_q->have_posts()) {

			$r .= '<h3 class="mt-3">'.$pto->labels->name.'</h3>';
			if ($taxonomies) {
				foreach ($taxonomies as $tax) {
					$terms = get_terms( array('taxonomy' => $tax) );
					foreach ($terms as $term) {
						$r .= '<a href="'.get_term_link( $term ).'" class="btn btn-dark btn-sm mr-1 mb-1">'.$term->name.'</a>';
					}
				}
			}

			while ($posts_q->have_posts()) { $posts_q->the_post();
				$r .= '<a href="'.get_the_permalink().'" class="btn btn-outline-primary btn-sm mr-1 mb-1">'.get_the_title().'</a>';
			}
		}

		wp_reset_postdata();
	}

	return $r;
}
add_shortcode( 'sitemap', 'sitemap' );

function testimonios() {
	ob_start();
	get_template_part( 'global-templates/carousel-testimonios' );
	$r = ob_get_clean();

	return $r;
}
add_shortcode( 'testimonios', 'testimonios' );

function sumun_get_reusable_block( $block_id = '' ) {
    if ( empty( $block_id ) || (int) $block_id !== $block_id ) {
        return;
    }
    $content = get_post_field( 'post_content', $block_id );
    return apply_filters( 'the_content', $content );
}

function sumun_reusable_block( $block_id = '' ) {
    echo sumun_get_reusable_block( $block_id );
}

function sumun_reusable_block_shortcode( $atts ) {
    extract( shortcode_atts( array(
        'id' => '',
    ), $atts ) );
    if ( empty( $id ) || (int) $id !== $id ) {
        return;
    }
    $content = advent_get_reusable_block( $id );
    return $content;
}
add_shortcode( 'reusable', 'sumun_reusable_block_shortcode' );

function get_acabados( $atts ) {
    extract( shortcode_atts( array(
        'categoria' => false,
        'serie'		=> false,
    ), $atts ) );

    $r = '';

    $args = array(
    	'post_type'			=> 'acabado',
    	'posts_per_page'	=> -1,
    );

    if($serie) {
    	$args['tax_query'] = array(
    		array(
    			'taxonomy'		=> 'coleccion',
    			'fields'		=> 'ids',
    			'terms'			=> explode(',', $serie),
    		)
    	);
    }

	$categorias = get_terms( array( 'taxonomy' => 'categoria_acabado', 'hide_empty' => false ) );
	
	foreach ($categorias as $cat) {

		$args_2 = $args;
		$args_2['tax_query'][] = array(
									'taxonomy'		=> 'categoria_acabado',
									'fields'		=> 'ids',
									'terms'			=> $cat->term_id,
								);

		$q = new WP_Query($args_2);

		if($q->have_posts()) {

			$r .= '<p class="h4">'.$cat->name.'</p>';

			if( wp_is_mobile() ) {
				$r .= '<div class="wp-block-buttons is-style-outline mb-5 text-center"><a class="wp-block-button__link no-border-radius" data-toggle="collapse" href="#acabados-collapse" role="button" aria-expanded="false" aria-controls="acabados-collapse">'.__( 'Ver acabados', 'kyrya' ).'</a></div>';

				$r .= '<div class="collapse" id="acabados-collapse">';
			}

				$r .= '<div class="row">';

				while ($q->have_posts()) { $q->the_post();
					ob_start();
					get_template_part( 'loop-templates/content', 'acabado' );
					$r .= ob_get_clean();
				}

				$r .= '</div>';

			if( wp_is_mobile()) {
				$r .= '</div>'; // .collapse
			}
		}

    	wp_reset_postdata();

	}

    return $r;
}
add_shortcode( 'acabados', 'get_acabados' );

function get_componentes( $atts ) {
    extract( shortcode_atts( array(
        'serie' => false,
    ), $atts ) );

    $r = '';

    $args = array(
    	'post_type'			=> 'componente',
    	'posts_per_page'	=> -1,
    );

    if($serie) {
    	$args['tax_query'] = array(
    		array(
    			'taxonomy'		=> 'coleccion',
    			'fields'		=> 'ids',
    			'terms'			=> explode(',', $serie),
    		)
    	);
    }

	$term = get_term( $serie );

    $q = new WP_Query($args);

    if($q->have_posts()) {

    	$r .= '<div class="componentes wrapper is-shortcode">';

			if ( $serie ) {

				$r .= '<h2 class="has-text-align-center">'. sprintf( __( 'Técnicos de %s', 'kyrya' ), $term->name ) .'</h2>';

			} else {

				$r .= '<h2 class="has-text-align-center">'. __( 'Técnicos', 'kyrya' ) .'</h2>';

			}

	    	if( wp_is_mobile() ) {
	    		$r .= '<div class="wp-block-buttons is-style-outline mb-5"><a class="wp-block-button__link no-border-radius" data-toggle="collapse" href="#componentes-collapse" role="button" aria-expanded="false" aria-controls="componentes-collapse">'.__( 'Ver componentes', 'kyrya' ).'</a></div>';

	    		$r .= '<div class="collapse" id="componentes-collapse">';
	    	}

		    	$r .= '<div class="row">';

		    	while ($q->have_posts()) { $q->the_post();
		    		ob_start();
		    		get_template_part( 'loop-templates/content', 'componente' );
		    		$r .= ob_get_clean();
		    	}

		    	$r .= '</div>';

	    	if( wp_is_mobile()) {
	    		$r .= '</div>'; // .collapse
	    	}

    	$r .= '</div>';
    }

    wp_reset_postdata();

    return $r;
}
add_shortcode( 'componentes', 'get_componentes' );

function get_productos( $atts ) {
    extract( shortcode_atts( array(
        'serie' => false,
        'product_ids' => false,
    ), $atts ) );

    $r = '';

    if ( $product_ids ) {

    	$product_ids = explode(',', $product_ids);
    	$terms = array( false );

    } else {

	    $product_cat_tax = 'categoria_producto';
	    $terms = get_terms( array(
	    	'taxonomy' 	=> $product_cat_tax,
	    	'parent'	=> 0,
	    ));    

	}
    
    foreach( $terms as $term ) {

    	if ( $term ) {

	    	$tax_query = array( 
	    		'relation' => 'AND'
	    	);

		    if($serie) {

		    	$tax_query[] = array(
					    			'taxonomy'		=> 'coleccion',
					    			'terms'			=> explode(',', $serie),
					    		);
		    }

	    	$tax_query[] = array(
	    		'taxonomy'		=> $product_cat_tax,
	    		'terms'			=> array($term->term_id),
	    	);

		    $args = array(
		    	'post_type'			=> 'producto',
		    	'posts_per_page'	=> -1,
		    	'tax_query'			=> $tax_query,
		    );

		} else {

		    $args = array(
		    	'post_type'			=> 'producto',
		    	'posts_per_page'	=> -1,
		    	'post__in'			=> $product_ids,
		    	'orderby'			=> 'post__in',
		    );

		}

	    $q = new WP_Query($args);

	    if($q->have_posts()) {

	    	$r .= '<div class="productos wrapper is-shortcode">';

	    		if ($term) $r .= '<h2>'.$term->name.'</h2>';

		    	if( wp_is_mobile() ) {
		    		$r .= '<div class="wp-block-buttons is-style-outline mb-5"><a class="wp-block-button__link no-border-radius" data-toggle="collapse" href="#productos-collapse" role="button" aria-expanded="false" aria-controls="productos-collapse">'.__( 'Ver productos', 'kyrya' ).'</a></div>';

		    		$r .= '<div class="collapse" id="productos-collapse">';
		    	}

			    	$r .= '<div class="row no-gutters">';

			    	while ($q->have_posts()) { $q->the_post();
			    		ob_start();
			    		get_template_part( 'loop-templates/content', 'producto' );
			    		$r .= ob_get_clean();
			    	}

			    	$r .= '</div>';

		    	if( wp_is_mobile()) {
		    		$r .= '</div>'; // .collapse
		    	}

	    	$r .= '</div>';
	    }

	    wp_reset_postdata();

	}

    return $r;
}
add_shortcode( 'productos', 'get_productos' );


function get_ambientes( $atts ) {
    extract( shortcode_atts( array(
        'serie' => false,
    ), $atts ) );

    $r = '';

    $query_args = array(
    	'post_type'			=> 'composicion',
    	'posts_per_page'	=> -1,
    	'orderby'			=> 'menu_order',
    	'order'				=> 'ASC',
    	'meta_query'		=> array(
    								array(
    									'key'			=> 'destacado',
    									'value'			=> 1,
    								)
    	),
    );

    if($serie) {
    	$query_args['tax_query'] = array(
    		array(
    			'taxonomy'		=> 'coleccion',
    			'fields'		=> 'ids',
    			'terms'			=> explode(',', $serie),
    		)
    	);
    }

    $q = new WP_Query($query_args);

    if($q->have_posts()) {

    	$r .= '<div id="carousel-ambientes" class="carousel slide carousel-ambientes" data-ride="carousel">';
    	
	    	$r .= '<div class="carousel-inner">'; 	

		    	$indicators = '<ol class="carousel-indicators">';

			    	while ($q->have_posts()) { $q->the_post();
			    		global $post;

			    		$active_class = ( $q->current_post == 0 ) ? 'active' : '';
			    		$indicators .= '<li data-target="#carousel-ambientes" data-slide-to="'.$q->current_post.'" class="'.$active_class.'">';

			    		$r .= '<div class="carousel-item ' .$active_class.'">';

			    			$r .= get_the_post_thumbnail( get_the_ID(), 'full' );

			    			$r .= '<div class="carousel-caption">';

			    				// $excerpt = $post->post_excerpt;
			    				// if($excerpt) $excerpt = ' · ' . $excerpt;
			    				$mas_info = '<a href="'.get_the_permalink().'" title="'.get_the_title().'" class="btn btn-outline-white">'.get_the_title().'</a>';

			    				$r .= '<p>'.$mas_info.'</p>';
			    				// $r .= the_title( '<p class="h6">', $excerpt . '</p>', false );

		    				

			    			$r .= '</div>';

			    		$r .= '</div>';
		    		}

		    	$indicators .= '</ol>';
	    	
	    	$r .= '</div>';

    	$r .= $indicators;
    	// $r .= '	<a class="carousel-control-prev" href="#carousel-ambientes" role="button" data-slide="prev">
				 //    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
				 //    <span class="sr-only">Previous</span>
				 //  </a>
				 //  <a class="carousel-control-next" href="#carousel-ambientes" role="button" data-slide="next">
				 //    <span class="carousel-control-next-icon" aria-hidden="true"></span>
				 //    <span class="sr-only">Next</span>
				 //  </a>';
    	$r .= '</div>';

    }

    wp_reset_postdata();

    return $r;
}
add_shortcode( 'ambientes', 'get_ambientes' );

function get_blog( $atts ) {
    extract( shortcode_atts( array(

    ), $atts ) );

    $r = '';

    $query_args = array(
    	'post_type'			=> 'post',
    	'posts_per_page'	=> 4,
    );

    $q = new WP_Query($query_args);

    if($q->have_posts()) {

    	if( wp_is_mobile() ) {
    		$r .= '<div class="wp-block-buttons is-style-outline mb-5"><a class="wp-block-button__link no-border-radius" data-toggle="collapse" href="#blog-collapse" role="button" aria-expanded="false" aria-controls="blog-collapse">'.__( 'Últimas entradas del blog', 'kyrya' ).'</a></div>';

    		$r .= '<div class="collapse" id="blog-collapse">';
    	}

	    	$r .= '<div class="row no-gutters">';

	    	while ($q->have_posts()) { $q->the_post();
	    		ob_start();
	    		get_template_part( 'loop-templates/content', 'post' );
	    		$r .= ob_get_clean();
	    	}

	    	$r .= '</div>';

    	if( wp_is_mobile()) {
    		$r .= '</div>'; // .collapse
    	}
    }


    wp_reset_postdata();

    return $r;
}
add_shortcode( 'blog', 'get_blog' );



