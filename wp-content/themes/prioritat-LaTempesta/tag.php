<?php
/**
 * The template for displaying tag archive pages
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();

$container = get_theme_mod( 'understrap_container_type' );
?>

<div class="wrapper" id="tag-wrapper">

	<div class="<?php echo esc_attr( $container ); ?>" id="content" tabindex="-1">

		<div class="row">

			<!-- Do the left sidebar check -->
			<?php get_template_part( 'global-templates/left-sidebar-check' ); ?>

			<main class="site-main" id="main">

				<?php if ( have_posts() ) : ?>

					<header class="page-header d-flex flex-column justify-content-end mb-5">

						<div class="header-content">
							<?php
							the_archive_title( '<h1 class="page-title text-dark fs-2">', '</h1>' );
							the_archive_description( '<div class="taxonomy-description small">', '</div>' );
							?>
						</div>

						<div class="dot-pattern p-2 pt-5">
							<img class="inline-svg text-muted" src="<?= get_stylesheet_directory_uri() ?>/images/dots.svg">
						</div>
					</header><!-- .page-header -->

					<div class="post-list">

						<?php
						// Start the loop.
						while ( have_posts() ) {
							the_post();
	
							/*
							 * Include the Post-Format-specific template for the content.
							 * If you want to override this in a child theme, then include a file
							 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
							 */
							get_template_part( 'loop-templates/content', get_post_type() );
						}
						?>

					</div>

				<?php else : ?>

					<?php get_template_part( 'loop-templates/content', 'none' ); ?>
					
				<?php endif; ?>

			</main><!-- #main -->

			<?php
			// Display the pagination component.
			understrap_pagination();
			// Do the right sidebar check.
			get_template_part( 'global-templates/right-sidebar-check' );
			?>

		</div><!-- .row -->

	</div><!-- #content -->

</div><!-- #archive-wrapper -->

<?php
get_footer();
