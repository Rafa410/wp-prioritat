<?php
/**
 * CPT 'mitjans' partial template
 *
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$title = get_the_title();
$link = get_field( 'media_link' );

?>

<article <?php post_class( 'mitja' ); ?> id="mitja-<?php the_ID(); ?>">

	<a href="<?= esc_url( $link ) ?>" class="mitja__link text-decoration-none" target="_blank" rel="noopener">

		<div class="mitja__image ratio ratio-1x1">
			<?= get_the_post_thumbnail( $post->ID, 'medium' ); ?>
		</div>

		<div class="mitja__content">
			<h3 class="mitja__title entry-title fw-bold"><?= $title ?></h3>
			<div class="mitja__summary entry-content lh-sm small">
				<?= wp_trim_words( get_the_content(), 50, ' [...]' ) ?>
			</div>
		</div>

	</a>

</article><!-- #post-## -->
