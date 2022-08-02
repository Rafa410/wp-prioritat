<?php
/**
 * Post rendering content according to caller of get_template_part
 *
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<article <?php post_class( 'forum p-3' ); ?> id="forum-<?php the_ID(); ?>">

	<header class="entry-header">
		
		<?= get_the_post_thumbnail( $post->ID, 'medium' ) ?>

		<?php
		the_title(
			sprintf(
				'<h3 class="entry-title fw-bold w-75"><a href="%s" class="link-dark title-underline title-underline-dark text-decoration-none">',
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

		<a href="#" class="read-more btn btn-outline-dark">
			<?= __( 'Més info', 'prioritat' ) ?>
		</a>

	</footer><!-- .entry-footer -->

</article><!-- #post-## -->
