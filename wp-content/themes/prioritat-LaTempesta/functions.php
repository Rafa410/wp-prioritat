<?php
/**
 * Understrap Child Theme functions and definitions
 *
 * @package UnderstrapChild
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;



/**
 * Removes the parent themes stylesheet and scripts from inc/enqueue.php
 */
function understrap_remove_scripts() {
	wp_dequeue_style( 'understrap-styles' );
	wp_deregister_style( 'understrap-styles' );

	wp_dequeue_script( 'understrap-scripts' );
	wp_deregister_script( 'understrap-scripts' );
}
add_action( 'wp_enqueue_scripts', 'understrap_remove_scripts', 20 );



/**
 * Enqueue our stylesheet and javascript file
 */
function theme_enqueue_styles() {

	// Get the theme data.
	$the_theme = wp_get_theme();

	$suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
	// Grab asset urls.
	$theme_styles  = "/css/child-theme{$suffix}.css";
	$theme_scripts = "/js/child-theme{$suffix}.js";

	// Define script dependencies
	// $deps = array( 'slick-script-async' );

	// Prevent CSS & JS caching when they are modified
	$timestamp_styles = filemtime( get_stylesheet_directory() . $theme_styles );
	$timestamp_scripts = filemtime( get_stylesheet_directory() . $theme_scripts );

	wp_enqueue_style( 'child-understrap-styles', get_stylesheet_directory_uri() . $theme_styles, array(), $the_theme->get( 'Version' ) . '-' . $timestamp_styles );
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'child-understrap-scripts-async', get_stylesheet_directory_uri() . $theme_scripts, array(), $the_theme->get( 'Version' ) . '-' . $timestamp_scripts, true );
	
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );



/**
 * Load Google Fonts
 */
function prt_load_google_fonts() {
	?>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
	<?php
}
add_action( 'wp_head', 'prt_load_google_fonts' );



function prt_ajax_url() {
	?>
	<script>
		var ajaxUrl = '<?= admin_url( 'admin-ajax.php' ) ?>';
	</script>
	<?php
}
add_action( 'wp_head', 'prt_ajax_url' );


/**
 * Enqueue libraries
 *  - Slick
 *  - animate.css
 *  - wow.js
 *  - GSAP
 * 		& ScrollTrigger
 *  - Masonry
 */
function prt_load_libraries() {
    $slick_style = 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css';
    $slick_script = 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js';

	$animate_css = 'https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css';
	$wow_js = 'https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js';

	$gsap = 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.2/gsap.min.js';
    $gsap_scrollTrigger = 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.2/ScrollTrigger.min.js';

	$masonry = 'https://unpkg.com/masonry-layout@4.2/dist/masonry.pkgd.min.js';

	wp_enqueue_style( 'animate-css', $animate_css );
	wp_enqueue_script( 'wow-js', $wow_js, array(), null, true );

    // Homepage
    if ( is_front_page() ) {
        wp_enqueue_style( 'slick-style', $slick_style );
        wp_enqueue_script( 'slick-script', $slick_script, array( 'jquery' ), null, true );
    }

	// Association page
	if ( is_page_template( 'page-templates/association-template.php' ) ) {
		wp_enqueue_style( 'slick-style', $slick_style );
        wp_enqueue_script( 'slick-script', $slick_script, array( 'jquery' ), null, true );
		wp_enqueue_script( 'gsap-async', $gsap );
        wp_enqueue_script( 'gsap-scrollTrigger-async', $gsap_scrollTrigger, array(), null, false );
	}

	// Candidature page
	if ( is_page_template( 'page-templates/candidature-template.php' ) ) {
		wp_enqueue_script( 'gsap-async', $gsap );
        wp_enqueue_script( 'gsap-scrollTrigger-async', $gsap_scrollTrigger, array(), null, false );
	}

	// Present page
	if ( is_page_template( 'page-templates/present-template.php' ) ) {
		wp_enqueue_style( 'slick-style', $slick_style );
		wp_enqueue_script( 'slick-script', $slick_script, array( 'jquery' ), null, true );
		wp_enqueue_script( 'masonry-async', $masonry, array(), null, true );
	}

}
add_action( 'wp_enqueue_scripts', 'prt_load_libraries' );



/**
 * Add async or defer attributes to scripts whose $handle contains 'async' or 'defer'
 * when registered via wp_register_script or wp_enqueue_script
 *
 * @param string $tag The <script> tag for the enqueued script.
 * @param string $handle The script's registered handle.
 *
 * @return mixed
 */
function prt_add_async_defer_attributes( $tag, $handle ) {
	if ( strpos( $handle, "async" ) ) {
		$tag = str_replace(' src', ' async="async" src', $tag);
    }
	
	if ( strpos( $handle, "defer" ) ) {
		$tag = str_replace(' src', ' defer="defer" src', $tag);
    }
	
	return $tag;
}
add_filter( 'script_loader_tag', 'prt_add_async_defer_attributes', 10, 2 );



/**
 * Load the child theme's text domain
 */
function add_child_theme_textdomain() {
	load_child_theme_textdomain( 'prioritat', get_stylesheet_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'add_child_theme_textdomain' );



/**
 * Overrides the theme_mod to default to Bootstrap 5
 *
 * This function uses the `theme_mod_{$name}` hook and
 * can be duplicated to override other theme settings.
 *
 * @param string $current_mod The current value of the theme_mod.
 * @return string
 */
function understrap_default_bootstrap_version( $current_mod ) {
	return 'bootstrap5';
}
add_filter( 'theme_mod_understrap_bootstrap_version', 'understrap_default_bootstrap_version', 20 );



/**
 * Loads javascript for showing customizer warning dialog.
 */
function understrap_child_customize_controls_js() {
	wp_enqueue_script(
		'understrap_child_customizer',
		get_stylesheet_directory_uri() . '/js/customizer-controls.js',
		array( 'customize-preview' ),
		'20130508',
		true
	);
}
add_action( 'customize_controls_enqueue_scripts', 'understrap_child_customize_controls_js' );



/**
 * Remove margin-top from HTML when logged in
 */
function prt_remove_admin_bar(){
	add_theme_support( 'admin-bar', array( 'callback' => '__return_false' ) );
}
add_action('after_setup_theme','prt_remove_admin_bar');



/**
 * Removes the custom read more link generated by Understrap to all excerpts
 * 
 * @override understrap/inc/extras.php:understrap_all_excerpts_get_more_link()
 *
 * @param string $post_excerpt Posts's excerpt.
 *
 * @return string
 */
function understrap_all_excerpts_get_more_link( $post_excerpt ) {
	// TODO: Only add [...] if the excerpt was automatically generated
	return $post_excerpt . ' [...]'; 
}


function prt_excerpt_length( $length ) { 
	return 40; 
} 
add_filter( 'excerpt_length', 'prt_excerpt_length');



/**
 * Generates HTML with the current post date.
 * 
 * @return string
 */
function prt_post_date() {
	$post_date = '<time class="entry-date published updated d-block my-2" datetime="%1$s">%2$s</time>';
	$post_date = sprintf(
		$post_date,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
	);
	return $post_date;
}



/**
 * Generates HTML with the current post categories
 * 
 * @param string $term The taxonomy term to use.
 * 
 * @return string
 */
function prt_post_category( $term ) {
	if ( $term ) {
		$categories = get_the_terms( get_the_ID(), $term );
	} else {
		$categories = get_the_category();
	}
	$separator = ', ';
	$categories_html = '';
	if ( ! empty( $categories ) ) {
		$categories_html .= '<div class="entry-categories fw-semibold small">';
		foreach( $categories as $category ) {
			$categories_html .= '<a class="category-link link-tertiary text-decoration-none" href="' . esc_url( get_category_link( $category->term_id ) ) . '" title="' . esc_attr( sprintf( __( 'Veure tots els artícles de la categoria %s', 'prioritat' ), $category->name ) ) . '">';
			$categories_html .= esc_html( $category->name ) . '</a>';

			if ( $category !== end( $categories ) ) {
				$categories_html .= $separator;
			}
		}
		$categories_html .= '</div>';
	}

	return $categories_html;
}

/**
 * Generates HTML with the current post tags
 * 
 * @return string
 */
function prt_post_tags() {
	$post_tags = get_the_tags();
	$tags_html = '';
	if ( $post_tags ) {
		$tags_html .= '<div class="entry-tags fw-semibold small">';
		$tags_html .= '<span class="me-2">' . __( 'Etiquetes:', 'prioritat' ) . '</span>';
		foreach ( $post_tags as $tag ) {
			$tag_link = get_tag_link( $tag->term_id );
			$tags_html .= "<a href='{$tag_link}' title='{$tag->name}' class='tag link-tertiary text-decoration-none'>";
			$tags_html .= "{$tag->name}</a>";
			
			if ( $tag !== end( $post_tags ) ) {
				$tags_html .= ', ';
			}
		}
		$tags_html .= '</div>';
	}
	return $tags_html;
}



/**
 * Generates a new menu location for the footer menu
 * 
 */
function prt_register_footer_menu() {
	register_nav_menu( 'footer-menu', __( 'Footer Menu', 'prioritat' ) );
}
add_action( 'after_setup_theme', 'prt_register_footer_menu' );



/**
 * Given a YouTube URL, returns the ID of the video
 */
function get_youtube_id_from_url( $url )  {
    preg_match( 
        '/(http(s|):|)\/\/(www\.|)yout(.*?)\/(embed\/|watch.*?v=|)([a-z_A-Z0-9\-]{11})/i', 
        $url, 
        $results
    );
    return $results[6];
}



/**
 * Add a custom column with the category name to the admin CPT list
 */
function prt_set_custom_noticies_columns($columns) {
	// Add column 'categoria' before 'date'
	unset( $columns['date'] );
	$columns['categoria'] = __( 'Categoria', 'prioritat' );
	$columns['date'] = __( 'Data', 'prioritat' );

	return $columns;

    // $columns['categoria'] = __( 'Categoria', 'prioritat' );

    return $columns;
}
add_filter( 'manage_noticies_posts_columns', 'prt_set_custom_noticies_columns' );



/**
 * Fill content of 'categoria' column in admin CPT list
 */
function prt_custom_noticies_column( $column, $post_id ) {
    switch ( $column ) {
        case 'categoria' :
            $terms = get_the_term_list( $post_id , 'categoria_noticies' , '' , ', ' , '' );
            if ( is_string( $terms ) ) {
                echo $terms;
			}
            break;
    }
}
add_action( 'manage_noticies_posts_custom_column' , 'prt_custom_noticies_column', 10, 2 );



/**
 * Allow filtering by category in admin CPT list
 */
function prt_noticies_taxonomy_filter() {
	global $typenow; // this variable stores the current custom post type

	if ( in_array( $typenow, array( 'noticies' ) ) ) {
		$taxonomy_names = array( 'categoria_noticies' );

		foreach ( $taxonomy_names as $single_taxonomy ) {
			$current_taxonomy = isset( $_GET[$single_taxonomy] ) ? $_GET[$single_taxonomy] : '';
			$taxonomy_object = get_taxonomy( $single_taxonomy );
			$taxonomy_name = strtolower( $taxonomy_object->labels->name );
			$taxonomy_terms = get_terms( $single_taxonomy );
			if ( count($taxonomy_terms) > 0 ) {
				echo "<select name='{$single_taxonomy}' id='{$single_taxonomy}' class='postform'>";
				echo "<option value=''>" . __( 'Totes les categories', 'prioritat' ) . "</option>";
				foreach ($taxonomy_terms as $single_term) {
					echo '<option value='. $single_term->slug, $current_taxonomy == $single_term->slug ? ' selected="selected"' : '','>' . $single_term->name .' (' . $single_term->count .')</option>'; 
				}
				echo "</select>";
			}
		}
	}
} 
add_action( 'restrict_manage_posts', 'prt_noticies_taxonomy_filter' );



/**
 * Allow filtering by Cronology in admin CPT 'timeline_events' list
 */
function prt_cronologia_taxonomy_filter() {
	global $typenow; // this variable stores the current custom post type

	if ( $typenow === 'timeline_events' ) {
		$taxonomy_names = array( 'cronologia' );

		foreach ( $taxonomy_names as $single_taxonomy ) {
			$current_taxonomy = isset( $_GET[$single_taxonomy] ) ? $_GET[$single_taxonomy] : '';
			$taxonomy_object = get_taxonomy( $single_taxonomy );
			$taxonomy_name = strtolower( $taxonomy_object->labels->name );
			$taxonomy_terms = get_terms( $single_taxonomy );
			if ( count($taxonomy_terms) > 0 ) {
				echo "<select name='{$single_taxonomy}' id='{$single_taxonomy}' class='postform'>";
				echo "<option value=''>" . __( 'Totes les categories', 'prioritat' ) . "</option>";
				foreach ($taxonomy_terms as $single_term) {
					echo '<option value='. $single_term->slug, $current_taxonomy == $single_term->slug ? ' selected="selected"' : '','>' . $single_term->name .' (' . $single_term->count .')</option>'; 
				}
				echo "</select>";
			}
		}
	}
} 
add_action( 'restrict_manage_posts', 'prt_cronologia_taxonomy_filter' );



/**
 * Load more CPT 'mitjans' with ajax button
 */
function load_more_mitjans() {
	$args = array(
		'post_type' => 'mitjans',
		'posts_per_page' => 12,
		'orderby' => 'date',
		'order' => 'DESC',
		'paged' => $_POST['paged'],
	);
	$ajaxMitjans = new WP_Query( $args );

	$max_pages = $ajaxMitjans->max_num_pages;

	if ( $ajaxMitjans->have_posts() ) {
		ob_start();

		while( $ajaxMitjans->have_posts() ) {
			$ajaxMitjans->the_post();
			?>
			<div class="col-sm-6 col-lg-4">
				<?php get_template_part( 'loop-templates/content', 'mitjans' ); ?>
			</div>
			<?php
		}

		$output = ob_get_contents();
    	ob_end_clean();
	}

	 $result = [
		'max' => $max_pages,
		'html' => $output,
	];

	echo json_encode($result);
	exit;
}
add_action('wp_ajax_load_more_mitjans', 'load_more_mitjans');
add_action('wp_ajax_nopriv_load_more_mitjans', 'load_more_mitjans');
