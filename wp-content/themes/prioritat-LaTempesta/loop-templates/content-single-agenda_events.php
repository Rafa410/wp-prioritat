<?php
/**
 * Single post partial template
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<a href="<?= site_url( '/participa#activitats' ) ?>" class="agenda_events-nav-links small mt-4">
	<?= __( 'Participa', 'prioritat' ) ?> <span class="dot dot-secondary"></span> <?= __( 'Activitats', 'prioritat' ) ?>
</a>

<article <?php post_class( 'activitat my-4' ); ?> id="post-<?php the_ID(); ?>">

	<header class="entry-header">

		<?php the_title( '<h1 class="fs-2 entry-title">', '</h1>' ); ?>

	</header><!-- .entry-header -->

	<div class="activitat__image-wrapper my-4">
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
