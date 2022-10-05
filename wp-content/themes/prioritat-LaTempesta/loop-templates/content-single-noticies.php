<?php
/**
 * Single post partial template
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<article <?php post_class(); ?> id="noticia-<?php the_ID(); ?>">

	<header class="page-header d-flex flex-column justify-content-end align-items-start entry-header">

		<a href="<?= site_url( '/actualitat#noticies' ) ?>" class="noticies-nav-links small mb-3">
			<?= __( 'Actualitat', 'prioritat' ) ?> <span class="dot dot-tertiary"></span> <?= __( 'Notícies', 'prioritat' ) ?>
		</a>

		<?php the_title( '<h1 class="fs-2 entry-title">', '</h1>' ); ?>

		<div class="entry-meta small fw-semibold">

			<?= prt_post_date() ?>
			<?= prt_post_category( 'categoria_noticies' ) ?>

		</div><!-- .entry-meta -->

		<div class="dot-pattern p-2 pt-5">
			<img class="inline-svg text-tertiary" src="<?= get_stylesheet_directory_uri() ?>/images/dots.svg">
		</div>

	</header><!-- .entry-header -->

	<div class="post__image-wrapper my-4">
		<?= get_the_post_thumbnail( $post->ID, 'full' ); ?>
	</div>

	<div class="row justify-content-xl-between">

		<div class="col-lg-8 col-xl-7">

			<div class="entry-content">
		
				<?php
				the_content();
				// understrap_link_pages();
				?>
		
			</div><!-- .entry-content -->

			<footer class="entry-footer mt-5">

				<?php // understrap_entry_footer(); ?>

				<?= prt_post_tags(); ?>

			</footer><!-- .entry-footer -->

		</div>

		<div class="col-lg-4">

			<aside class="related-posts sticky-lg-top mt-4 mt-lg-0 p-3" aria-labelledby="related-posts-title">

				<h2 class="fs-3 fw-bold" id="related-posts-title">
					<?= __( 'Altres notícies', 'prioritat' ) ?>
				</h2>

				<div class="post-list">

					<?php
						// Query 2 related posts with the same category or tag as the current post
						$related_posts = new WP_Query( array(
							'post_type' => 'noticies',
							'posts_per_page' => 2,
							'post__not_in' => array( $post->ID ),
							'tag__in' => wp_get_post_tags( $post->ID, array( 'fields' => 'ids' ) ),
							'tax_query' => array(
								array(
									'taxonomy' => 'categoria_noticies',
									'field' => 'term_id',
									'terms' => wp_get_post_terms( $post->ID, 'categoria_noticies', array( 'fields' => 'ids' ) ),
								),
							),
							'orderby' => 'rand',
						) );

						if ( $related_posts->have_posts() ) {
							
							while ( $related_posts->have_posts() ) {
								$related_posts->the_post();
								get_template_part( 'loop-templates/content-related', get_post_type() );
							}
							
						} else {
							// If no related posts found, display the latest 2 posts
							$latest_posts = new WP_Query( array(
								'post_type' => 'noticies',
								'posts_per_page' => 2,
								'post__not_in' => array( $post->ID ),
								'orderby' => 'date',
								'order' => 'DESC',
							) );

							while ( $latest_posts->have_posts() ) {
								$latest_posts->the_post();
								get_template_part( 'loop-templates/content-related', get_post_type() );
							}
						}
					?>

				</div>

			</aside>

		</div>

	</div>

</article><!-- #post-## -->
