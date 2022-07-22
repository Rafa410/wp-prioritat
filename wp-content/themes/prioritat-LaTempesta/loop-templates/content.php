<?php
/**
 * Post rendering content according to caller of get_template_part
 *
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<header class="entry-header">
		
		<?php echo get_the_post_thumbnail( $post->ID, 'medium' ); ?>

		<?php if ( 'post' === get_post_type() ) : ?>

			<div class="entry-meta fw-bold text-tertiary small">
				<?= prt_post_date(); ?>
			</div><!-- .entry-meta -->

		<?php endif; ?>

		<?php
		the_title(
			sprintf(
				'<h3 class="entry-title"><a href="%s" class="text-decoration-none" rel="bookmark">',
				esc_url( get_permalink() )
			),
			'</a></h3>'
		);
		?>

	</header><!-- .entry-header -->


	<div class="entry-content lh-sm small">

		<?php the_excerpt(); ?>

	</div><!-- .entry-content -->

</article><!-- #post-## -->
