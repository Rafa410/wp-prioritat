<?php
/**
 * The template for displaying search results pages
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();

$container = get_theme_mod( 'understrap_container_type' );

?>

<div class="wrapper" id="search-wrapper">

	<div class="<?php echo esc_attr( $container ); ?>" id="content" tabindex="-1">

		<div class="row">

			<!-- Do the left sidebar check and opens the primary div -->
			<?php get_template_part( 'global-templates/left-sidebar-check' ); ?>

			<main class="site-main" id="main">

				<?php if ( have_posts() ) : ?>

					<header class="page-header d-flex flex-column justify-content-end mb-5">

						<div class="header-content">

							<h1 class="page-title text-dark fs-2">
								<?php
								printf(
									/* translators: %s: query term */
									esc_html__( 'Resultats de la cerca: %s', 'prioritat' ),
									'<span>' . get_search_query() . '</span>'
								);
								?>
							</h1>

							<div class="dot-pattern p-2 pt-5">
								<img class="inline-svg text-muted" src="<?= get_stylesheet_directory_uri() ?>/images/dots.svg">
							</div>

						</div>

					</header><!-- .page-header -->
					
					<div class="post-list post-<?= get_post_type() ?>-list">

						<?php /* Start the Loop */ ?>
						<?php
						while ( have_posts() ) :
							the_post();

							/*
							* Run the loop for the search to output the results.
							* If you want to overload this in a child theme then include a file
							* called content-search.php and that will be used instead.
							*/
							get_template_part( 'loop-templates/content', 'search' );
						endwhile;
						?>

					</div>

				<?php else : ?>

					<?php get_template_part( 'loop-templates/content', 'none' ); ?>

				<?php endif; ?>

			</main><!-- #main -->

			<!-- The pagination component -->
			<?php understrap_pagination(); ?>

			<!-- Do the right sidebar check -->
			<?php get_template_part( 'global-templates/right-sidebar-check' ); ?>

		</div><!-- .row -->

	</div><!-- #content -->

</div><!-- #search-wrapper -->

<?php
get_footer();
