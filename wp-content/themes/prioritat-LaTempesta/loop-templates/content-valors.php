<?php
/**
 * Post rendering content according to caller of get_template_part
 *
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$index = $args['index'];

?>

<article <?php post_class( 'value p-3' ); ?> id="value-<?php the_ID(); ?>">

	<header class="entry-header">
		
		<?php if ( has_post_thumbnail() ) : ?>
			<div class="entry-thumbnail py-3">
				<?= get_the_post_thumbnail( $post->ID, 'medium' ) ?>
			</div>
		<?php endif; ?>

		<p class="text-muted text-uppercase fw-bold small my-2">
			<?= sprintf( __( 'Valor %d', 'prioritat' ), $index ) ?>
		</p>

		<?php
		the_title(
			sprintf(
				'<h3 class="entry-title title-underline title-underline-tertiary"><a href="%s" class="text-decoration-none link-dark">',
				esc_url( get_permalink() )
			),
			'</a></h3>'
		);
		?>

	</header><!-- .entry-header -->

	<div class="entry-content lh-sm">

		<p><?= get_field('summary') ?></p>

	</div><!-- .entry-content -->

	<footer class="entry-footer">

		<!-- <a href="#" class="read-more btn btn-sm btn-outline-dark">
			<?= __( 'Més info', 'prioritat' ) ?>
		</a> -->

	</footer><!-- .entry-footer -->

</article><!-- #post-## -->
