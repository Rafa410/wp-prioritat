<?php
/**
 * Post rendering content according to caller of get_template_part
 *
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<article <?php post_class( 'noticia' ); ?> id="noticia-<?php the_ID(); ?>">

	<header class="entry-header">
		
		<a href="<?= esc_url( get_permalink() ) ?>" class="d-block">
			<?= get_the_post_thumbnail( $post->ID, 'large' ); ?>
		</a>

			<div class="entry-meta fw-bold text-tertiary small">
				<?= prt_post_date(); ?>
			</div><!-- .entry-meta -->

		<?php
		the_title(
			sprintf(
				'<h3 class="entry-title"><a href="%s" class="text-decoration-none fw-bold" rel="bookmark">',
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
