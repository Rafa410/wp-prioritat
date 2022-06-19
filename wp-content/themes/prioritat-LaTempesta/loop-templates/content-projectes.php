<?php
/**
 * Post rendering content according to caller of get_template_part
 *
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

?>

<article <?php post_class( 'project p-2' ); ?> id="project-<?php the_ID(); ?>">

	<?= get_the_post_thumbnail( $post->ID, 'medium' ) ?>

	<?php
	the_title(
		sprintf(
			'<h3 class="entry-title fw-bold"><a href="%s" class="text-decoration-none">',
			esc_url( get_permalink() )
		),
		'</a></h3>'
	);
	?>

	<strong><?= get_field('subtitle') ?></strong>

</article><!-- #post-## -->
