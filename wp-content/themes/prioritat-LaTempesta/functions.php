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
	$deps = array( 'slick-script-async' );

	wp_enqueue_style( 'child-understrap-styles', get_stylesheet_directory_uri() . $theme_styles, array(), $the_theme->get( 'Version' ) );
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'child-understrap-scripts-async', get_stylesheet_directory_uri() . $theme_scripts, $deps, $the_theme->get( 'Version' ), true );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );



/**
 * Enqueue libraries
 *  - Slick
 */
function prt_load_libraries() {
    $slick_style = 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css';
    $slick_script = 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js';

    // Homepage
    if ( is_front_page() ) {
        wp_enqueue_style( 'slick-style', $slick_style );
        wp_enqueue_script( 'slick-script-async', $slick_script, array( 'jquery' ), null, true );
    }


}
add_action( 'wp_enqueue_scripts', 'prt_load_libraries' );



/**
 * Add async or defer attributes to scripts whose $handle contains 'async' or 'defer'
 * when registered via wp_register_script or wp_enqueue_script
 *
 * @param $tag {string} - The <script> tag for the enqueued script.
 * @param $handle {string} - The script's registered handle.
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
	return $post_excerpt;
}



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
