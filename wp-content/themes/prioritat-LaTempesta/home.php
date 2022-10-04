<?php
/**
 * The post archive template file
 *
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();

$container = get_theme_mod( 'understrap_container_type' );

$blog_ID = get_option( 'page_for_posts' );

?>

<?php if ( is_front_page() && is_home() ) : ?>
	<?php get_template_part( 'global-templates/hero' ); ?>
<?php endif; ?>

<div id="home-wrapper">

	<div class="container-fluid p-0" id="content" tabindex="-1">

		<div class="row">

			<!-- Do the left sidebar check and opens the primary div -->
			<?php get_template_part( 'global-templates/left-sidebar-check' ); ?>

			<main class="site-main" id="main">

				<header class="page-header py-4 <?php if ( ! has_post_thumbnail( $blog_ID ) ): ?>no-img<?php endif; ?>">

						<div class="page-image">
							<?= get_the_post_thumbnail( $blog_ID, 'full' ); ?>
						</div>

						<div class="container">
							<h1 class="page-title"><?= __( 'El blog', 'prioritat' ) ?></h1>
						</div>

						<div class="dot-pattern p-2 pt-5">
							<img class="inline-svg" src="<?= get_stylesheet_directory_uri() ?>/images/dots.svg">
						</div>

					</header>

					<div class="wrapper">

						<div class="<?php echo esc_attr( $container ); ?>">
		
							<div class="row">

								<div class="searchform-wrapper searchform-post my-3">
									<?php get_search_form( array(
										'echo' => true,
										'aria_label' => __( 'Articles', 'prioritat' ),
									) ); ?>
								</div>
		
								<div class="post-list post-archive">
				
									<?php
									if ( have_posts() ) {
										// Start the Loop.
										while ( have_posts() ) {
											the_post();
				
											/*
											* Include the Post-Format-specific template for the content.
											* If you want to override this in a child theme, then include a file
											* called content-___.php (where ___ is the Post Format name) and that will be used instead.
											*/
											get_template_part( 'loop-templates/content', get_post_type() );
										}
									} else {
										get_template_part( 'loop-templates/content', 'none' );
									}
									?>
				
								</div>
		
							</div>
		
						</div>

					</div>

			</main><!-- #main -->

			<!-- The pagination component -->
			<?php understrap_pagination(); ?>

			<!-- Do the right sidebar check -->
			<?php get_template_part( 'global-templates/right-sidebar-check' ); ?>

		</div><!-- .row -->

	</div><!-- #content -->

</div><!-- #index-wrapper -->

<?php
get_footer();
