<?php
/**
 * The template for displaying search forms
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

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
$posts_labels_map['articles'] = 'post';
$posts_labels_map['activitats'] = 'agenda_events';

$label = strtolower( $args['aria_label'] );
$aria_label = '';
$placeholder = '';

if ( isset( $args['aria_label'] ) && ! empty( $args['aria_label'] ) ) {
	$aria_label = 'aria-label="' . esc_attr( $args['aria_label'] ) . '"';
	$placeholder = sprintf( esc_attr_x( 'Cerca %s', 'placeholder', 'prioritat' ), $label );
	$post_type = null;
}


?>

<form role="search" class="search-form" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>" <?php echo $aria_label; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Escaped above. ?>>

	<label class="screen-reader-text" for="<?php echo $uid; ?>"><?php echo esc_html_x( 'Cercar per:', 'label', 'prioritat' ); ?></label>
	<div class="input-group">

		<div class="input-group-icon">
			<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" class="icon loading-icon" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid" aria-hidden="true">
				<circle cx="50" cy="50" fill="none" stroke="#419683" stroke-width="7" r="40" stroke-dasharray="188.49555921538757 64.83185307179586">
					<animateTransform attributeName="transform" type="rotate" repeatCount="indefinite" dur="1s" values="0 50 50;360 50 50" keyTimes="0;1"></animateTransform>
				</circle>
			</svg>
			<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" class="icon search-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
				<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
			</svg>
		</div>

		<?php if ( isset( $posts_labels_map[$label] ) ) : ?>
			<input type="hidden" name="post_type" value="<?= $posts_labels_map[$label] ?>">
		<?php endif; ?>
		<input type="search" class="field search-field form-control" id="<?php echo $uid; ?>" name="s" value="<?php the_search_query(); ?>" placeholder="<?php echo $placeholder; ?>">
		<input type="submit" class="submit search-submit screen-reader-text" name="submit" value="<?php echo esc_attr_x( 'Cerca', 'botó de cerca', 'prioritat' ); ?>">
	</div>
</form>
<?php
