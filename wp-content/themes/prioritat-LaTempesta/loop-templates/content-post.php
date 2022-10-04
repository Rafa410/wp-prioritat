<?php
/**
 * Post rendering content according to caller of get_template_part
 *
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<div class="row">

		<div class="col-md-5">

			<div class="entry-thumbnail h-100 py-3">
				<a href="<?= esc_url( get_permalink() ) ?>" class="d-flex align-items-center h-100">
					<?php if ( has_post_thumbnail() ) : ?>
						<?= get_the_post_thumbnail( $post->ID, 'large' ) ?>
					<?php else : ?>
						<img src="<?= get_stylesheet_directory_uri() ?>/images/blog_prioritat.jpg" class="img-fluid w-50 mx-auto" alt="<?= __( 'El blog de Prioritat', 'prioritat' ) ?>">
					<?php endif; ?>
				</a>
			</div>

		</div>

		<div class="col-md-7 d-flex flex-column justify-content-center">

			<header class="entry-header">
				
				<div class="entry-meta fw-bold text-tertiary small mb-3">
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

			<footer class="entry-footer">
				<?= prt_post_tags(); ?>
			</footer><!-- .entry-footer -->

		</div>

	</div>

</article><!-- #post-## -->
