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
 * Enqueue jQuery
 */
function prt_enqueue_jquery() {
	wp_enqueue_script( 'jquery' );
}
add_action( 'wp_enqueue_scripts', 'prt_enqueue_jquery', 5 );


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

	// Prevent CSS & JS caching when they are modified
	$timestamp_styles = filemtime( get_stylesheet_directory() . $theme_styles );
	$timestamp_scripts = filemtime( get_stylesheet_directory() . $theme_scripts );

	wp_enqueue_style( 'child-understrap-styles', get_stylesheet_directory_uri() . $theme_styles, array(), $the_theme->get( 'Version' ) . '-' . $timestamp_styles );
	// wp_enqueue_script( 'jquery' );
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
		wp_enqueue_script( 'gsap', $gsap );
        wp_enqueue_script( 'gsap-scrollTrigger', $gsap_scrollTrigger, array(), null, false );
	}

	// Candidature page
	if ( is_page_template( 'page-templates/candidature-template.php' ) ) {
		wp_enqueue_script( 'gsap', $gsap );
        wp_enqueue_script( 'gsap-scrollTrigger', $gsap_scrollTrigger, array(), null, false );
	}

	// Present page
	if ( is_page_template( 'page-templates/present-template.php' ) ) {
		wp_enqueue_style( 'slick-style', $slick_style );
		wp_enqueue_script( 'slick-script', $slick_script, array( 'jquery' ), null, true );
		wp_enqueue_script( 'masonry-async', $masonry, array(), null, true );
	}

}
add_action( 'wp_enqueue_scripts', 'prt_load_libraries', 8 );



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



/**
 * Create a shortcode to display the site URL in wpcf7 with an optional 'path' parameter
 */
function prt_wpcf7_add_form_tag_site_url() {
	wpcf7_add_form_tag(
		'site_url', 
		'prt_wpcf7_site_url_form_tag_handler', 
		array( 
			'name-attr' => true 
		) 
	);
}
add_action( 'wpcf7_init', 'prt_wpcf7_add_form_tag_site_url' );



/**
 * Generate URL relative to the WordPress site
 */
function prt_wpcf7_site_url_form_tag_handler( $tag ) {
	$path = '';

	if ( is_array( $tag->values ) ) {
		foreach ( $tag->values as $value ) {
			$path .= '/' . $value;
		}

	} elseif ( ! empty( $tag->values ) ) {
		$path = $tag->values;
	}
	

	$url = site_url( $path );

	return $url;	
}



/**
 * Generates a custom options page
 */
add_action('acf/init', 'my_acf_op_init');
function my_acf_op_init() {

    if( function_exists('acf_add_options_page') ) {

        // Register options page.
        $option_page = acf_add_options_page(array(
            'page_title'    => __( 'Opcions de personalització', 'prioritat' ),
            'menu_title'    => __( 'Personalització', 'prioritat' ),
            'menu_slug'     => 'theme-general-settings',
            'redirect'      => true,
        ));

		// Add sub page.
        $social_media_page = acf_add_options_sub_page(array(
            'page_title'  => __( 'Xarxes socials', 'prioritat' ),
            'menu_title'  => __( 'Xarxes socials', 'prioritat' ),
			'menu_slug'   => 'theme-social-settings',
            'parent_slug' => $option_page['menu_slug'],
        ));
    }
}



/**
 * Generates the current year
 */
function prt_current_year_shortcode() {
	$year = date('Y');
	return $year;
}



/**
 * Generates the contact info section
 */
function prt_contact_info_shortcode() {
	ob_start();
	?>
	<section id="contact-info">

		<div class="contact-info-list">

			<?php 
			$contact_items = get_field( 'contact_items' );

			foreach ( $contact_items as $contact_item ) : ?>

				<div class="contact-block bg-<?= $contact_item['color'] ?> p-4 py-lg-5">
					
					<?= wp_get_attachment_image( $contact_item['icon_id'], 'medium', true, array( 'class' => 'contact-block__icon' ) ); ?>

					<h2 class="contact-block__title">
						<?= $contact_item['title'] ?>
					</h2>

					<div class="contact-block__text">
						<?= $contact_item['description'] ?>
					</div>

				</div>

			<?php endforeach; ?>

		</div>

	</section>

	<?php

	$output = ob_get_clean();

	return $output;
}



/**
 * Register custom shortcodes
 */
function prt_add_custom_shortcodes() {
	add_shortcode( 'current_year', 'prt_current_year_shortcode' );
	wpcf7_add_shortcode( 'contact_info', 'prt_contact_info_shortcode' );
}
add_action( 'init', 'prt_add_custom_shortcodes' );



/**
 * Enable current_year shortcode in wpcf7 email template
 */
function prt_current_year_mail_tag( $output, $name, $html ) {
	if ( 'current_year' == $name ) {
		$output = do_shortcode( "[$name]" );
	}
	return $output;
}
add_filter( 'wpcf7_special_mail_tags', 'prt_current_year_mail_tag', 10, 3 );


/**
 * Export extranet tasks via Nextcloud API
 */
function export_extranet_tasks() {
	// Get the username and password
	$username = sanitize_text_field( $_POST['username'] );
	$password = sanitize_text_field( $_POST['password'] );
	$url = sanitize_text_field( $_POST['url'] );

	// Add 'export' query param to the URL field
	$url = $url . '?export';

	$response = wp_remote_get( $url, array(
		'headers' => array(
			'Authorization' => 'Basic ' . base64_encode( $username . ':' . $password ),
		),
	) );

	$response = json_encode($response);

	echo $response;
	exit;
}

add_action( 'wp_ajax_export_extranet_tasks', 'export_extranet_tasks' );
add_action( 'wp_ajax_nopriv_export_extranet_tasks', 'export_extranet_tasks' );


// Add "Extranet" section to user profile screen
function add_extranet_section( $user ) {
?>
    <h2 class="my-3"><?= __( 'Extranet', 'prioritat' ); ?></h2>
	<p class="description">
		<?= __( 'Introdueix aquí les dades del teu usuari de la extranet, per tal de conectar les dues plataformes.', 'prioritat' ) ?>
	</p>
    <table class="form-table">
        <tr>
            <th><label for="extranet_username"><?= __( 'Nom d\'usuari o email', 'prioritat' ) ?></label></th>
            <td><input type="text" name="extranet_username" id="extranet_username" value="<?= esc_attr( get_the_author_meta( 'extranet_username', $user->ID ) ); ?>" class="regular-text" /></td>
        </tr>
    </table>
<?php
}
add_action( 'show_user_profile', 'add_extranet_section' );
add_action( 'edit_user_profile', 'add_extranet_section' );

// Save "Extranet" section data
function save_extranet_section( $user_id ) {
    if ( ! current_user_can( 'edit_user', $user_id ) ) {
        return false;
    }
    update_user_meta( $user_id, 'extranet_username', sanitize_text_field( $_POST['extranet_username'] ) );
}
add_action( 'personal_options_update', 'save_extranet_section' );
add_action( 'edit_user_profile_update', 'save_extranet_section' );
