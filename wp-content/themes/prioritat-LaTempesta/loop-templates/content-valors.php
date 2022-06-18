<?php
/**
 * Post rendering content according to caller of get_template_part
 *
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<article <?php post_class( 'value p-3' ); ?> id="value-<?php the_ID(); ?>">

	<header class="entry-header">
		
		<?= get_the_post_thumbnail( $post->ID, 'medium' ) ?>

		<?php
		the_title(
			sprintf(
				'<h3 class="entry-title"><a href="%s" class="text-decoration-none">',
				esc_url( get_permalink() )
			),
			'</a></h3>'
		);
		?>

	</header><!-- .entry-header -->

	<div class="entry-content lh-sm">

		<p><?= get_field('summary') ?></p>

	</div><!-- .entry-content -->

	<footer class="entry-footer mt-auto">

		<a href="#" class="read-more">
			<?= __( 'Més informació', 'prioritat' ) ?>
		</a>

	</footer><!-- .entry-footer -->

</article><!-- #post-## -->
