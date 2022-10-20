<?php
/**
 * Single post partial template
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<a href="<?= site_url( '/#projectes' ) ?>" class="projectes-nav-links small mt-4">
	<?= __( 'Inici', 'prioritat' ) ?> <span class="dot dot-secondary"></span> <?= __( 'Què fem', 'prioritat' ) ?>
</a>

<article <?php post_class( 'projecte my-4' ); ?> id="post-<?php the_ID(); ?>">

	<header class="entry-header">

		<?php the_title( '<h1 class="fs-2 entry-title">', '</h1>' ); ?>

	</header><!-- .entry-header -->

	<div class="projecte__image-wrapper my-4">
		<?= get_the_post_thumbnail( $post->ID, 'full' ); ?>

		<div class="dot-pattern p-2 pt-5">
			<img class="inline-svg" src="<?= get_stylesheet_directory_uri() ?>/images/dots.svg">
		</div>
	</div>

	<div class="entry-content">

		<?php
		the_content();
		understrap_link_pages();
		?>

	</div><!-- .entry-content -->

	<footer class="entry-footer">

		<?php understrap_entry_footer(); ?>

	</footer><!-- .entry-footer -->

</article><!-- #post-## -->
