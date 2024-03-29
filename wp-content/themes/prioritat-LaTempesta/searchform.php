<?php
/**
 * The template for displaying search forms
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

global $wp;
global $wp_query;
global $custom_query;

$bootstrap_version = get_theme_mod( 'understrap_bootstrap_version', 'bootstrap4' );
$uid               = wp_unique_id( 's-' ); // The search form specific unique ID for the input.

$post_types = get_post_types( array(
	'public' => true,
	'publicly_queryable' => true,
	'exclude_from_search' => false,
), 'objects' );

// Map post types labels to post types slugs.
$posts_labels_map = array();
foreach ($post_types as $post_type) {
	$posts_labels_map[ strtolower( $post_type->labels->name )] = $post_type->name;
}
// Custom labels
// $posts_labels_map['articles'] = 'post';
$posts_labels_map['activitats'] = 'agenda_events';

$label = strtolower( $args['aria_label'] );
$aria_label = '';
$placeholder = '';

if ( isset( $args['aria_label'] ) && ! empty( $args['aria_label'] ) ) {
	$aria_label = 'aria-label="' . esc_attr( $args['aria_label'] ) . '"';
	$placeholder = sprintf( esc_attr_x( 'Cerca %s', 'placeholder', 'prioritat' ), $label );
	$post_type = null;
}

if ( is_home() ) {
	$url = get_permalink( get_option( 'page_for_posts' ) );
} elseif ( is_page_template( 'page-templates/present-template.php' ) ) {
	$url = get_pagenum_link( 1, false ) . '#noticies';
} else {
	$url = home_url( '/' );
}

$is_query = isset( $_GET['s'] ) || isset( $_GET['post_type'] ) || isset( $_GET['category_name'] );
$is_custom_query = isset( $_GET['search'] ) || isset( $_GET['category_name'] );
$is_search_page = is_search() || is_home() || $url === home_url( '/' );

?>

<form role="search" class="search-form" method="get" action="<?php echo esc_url( $url ); ?>" <?php echo $aria_label; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Escaped above. ?>>

	<label class="screen-reader-text" for="<?php echo $uid; ?>"><?php echo esc_html_x( 'Cercar per:', 'label', 'prioritat' ); ?></label>
	<div class="input-group">

		<div class="input-group-icon">
			<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" class="icon loading-icon" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid" aria-hidden="true">
				<circle cx="50" cy="50" fill="none" stroke="#419683" stroke-width="7" r="40" stroke-dasharray="188.49555921538757 64.83185307179586">
					<animateTransform attributeName="transform" type="rotate" repeatCount="indefinite" dur="1s" values="0 50 50;360 50 50" keyTimes="0;1"></animateTransform>
				</circle>
			</svg>
			<button type="submit" class="icon search-icon">
				<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
					<title><?= __( 'Cerca', 'prioritat' ); ?></title>
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
				</svg>
			</button>
		</div>

		<?php if ( isset( $posts_labels_map[$label] ) && $is_search_page ) : ?>
			<input type="hidden" name="post_type" value="<?= $posts_labels_map[$label] ?>">
		<?php endif; ?>

		<?php if ( $is_search_page ) : ?>
				<input type="search" class="field search-field form-control" id="<?php echo $uid; ?>" name="s" value="<?php the_search_query(); ?>" placeholder="<?php echo $placeholder; ?>">
		<?php else : ?>
			<input type="search" class="field search-field form-control" id="<?php echo $uid; ?>" name="search" value="<?php echo esc_attr( get_query_var( 'search' ) ); ?>" placeholder="<?php echo $placeholder; ?>">
		<?php endif; ?>

		<input type="submit" class="submit search-submit screen-reader-text" value="<?php echo esc_attr_x( 'Cerca', 'botó de cerca', 'prioritat' ); ?>">
	</div>
</form>

<?php if ( $is_query && $is_search_page && isset( $wp_query->found_posts ) ) : ?>
	<small class="search-results-count ms-3 text-muted">
		<?php
			printf( 
				esc_html( _n( '%s resultat', '%s resultats', $wp_query->found_posts, 'prioritat' ) ), 
				$wp_query->found_posts
			);
		?>
	</small>
<?php elseif ( $is_custom_query && isset( $custom_query->found_posts ) ) : ?>
	<small class="search-results-count ms-3 text-muted">
		<?php
			printf( 
				esc_html( _n( '%s resultat', '%s resultats', $custom_query->found_posts, 'prioritat' ) ), 
				$custom_query->found_posts
			);
		?>
	</small>
<?php endif; ?>

<?php
