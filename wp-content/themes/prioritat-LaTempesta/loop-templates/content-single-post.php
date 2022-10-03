<?php
/**
 * Single post partial template
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<header class="page-header d-flex flex-column justify-content-end align-items-start entry-header">

		<a href="<?= get_post_type_archive_link( 'post' ) ?>" class="blog-link small mb-3">
			<?= __( 'Blog', 'prioritat' ) ?>
		</a>

		<?php the_title( '<h1 class="fs-2 entry-title">', '</h1>' ); ?>

		<div class="entry-meta small fw-semibold">

			<?php the_date(); ?>

		</div><!-- .entry-meta -->

		<div class="dot-pattern p-2 pt-5">
			<img class="inline-svg text-primary" src="<?= get_stylesheet_directory_uri() ?>/images/dots.svg">
		</div>

	</header><!-- .entry-header -->

	<div class="post__image-wrapper my-4">
		<?= get_the_post_thumbnail( $post->ID, 'full' ); ?>
	</div>

	<div class="row">

		<div class="col-lg-8">

			<div class="entry-content">
		
				<?php
				the_content();
				// understrap_link_pages();
				?>
		
			</div><!-- .entry-content -->

		</div>

	</div>

	<footer class="entry-footer">

		<?php // understrap_entry_footer(); ?>
		
		<!-- Tags -->

	</footer><!-- .entry-footer -->

</article><!-- #post-## -->
